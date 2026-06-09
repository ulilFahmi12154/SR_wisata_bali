<?php

namespace App\Services;

use App\Models\ActivityLog;
use App\Models\User;
use App\Models\Wisata;
use Illuminate\Support\Collection;

class RecommendationService
{
    public function recommendForUser(?User $user, int $limit = 12): Collection
    {
        $destinations = Wisata::query()
            ->with(['kategori', 'lokasi', 'fasilitas'])
            ->withCount('wantToGos')
            ->get();

        if ($destinations->isEmpty()) {
            return collect();
        }

        $facts = $this->forwardChaining($user);
        $candidates = $this->backwardChaining($destinations, $facts);

        if ($candidates->isEmpty()) {
            $candidates = $destinations;
        }

        return $this->rankWithSaw($candidates, $facts)
            ->take($limit)
            ->values();
    }

    public function forwardChaining(?User $user): array
    {
        $facts = [
            'categories' => [],
            'regions' => [],
            'price_category' => [],
            'budget_min' => null,
            'budget_max' => null,
            'has_preferences' => false,
            'has_activity' => false,
        ];

        if (!$user) {
            return $facts;
        }

        $user->loadMissing([
            'preference',
            'preferenceCategories.category',
            'wantToGos.wisata.kategori',
            'wantToGos.wisata.lokasi',
        ]);

        $preference = $user->preference;
        if ($preference) {
            $facts['has_preferences'] = true;
            $facts['budget_min'] = $preference->budget_min;
            $facts['budget_max'] = $preference->budget_max;

            if ($preference->preferred_region) {
                $this->addWeight($facts['regions'], $preference->preferred_region, 5);
            }

            if ($preference->price_category) {
                $this->addWeight($facts['price_category'], $preference->price_category, 3);
            }
        }

        foreach ($user->preferenceCategories as $preferenceCategory) {
            $categoryName = $preferenceCategory->category?->nama_kategori;
            if ($categoryName) {
                $this->addWeight($facts['categories'], $categoryName, (int) $preferenceCategory->weight);
            }
        }

        foreach ($user->wantToGos as $wantToGo) {
            $wisata = $wantToGo->wisata;
            if (!$wisata) {
                continue;
            }

            $facts['has_activity'] = true;
            $this->addWeight($facts['categories'], $wisata->kategori?->nama_kategori, 5);
            $this->addWeight($facts['regions'], $wisata->lokasi?->nama_kabupaten, 4);
        }

        $activityLogs = ActivityLog::query()
            ->with('wisata.kategori', 'wisata.lokasi')
            ->where('user_id', $user->id)
            ->whereNotNull('wisata_id')
            ->latest()
            ->limit(80)
            ->get();

        foreach ($activityLogs as $activityLog) {
            $wisata = $activityLog->wisata;
            if (!$wisata) {
                continue;
            }

            $facts['has_activity'] = true;
            $weight = (int) ($activityLog->weight ?: $this->activityWeight($activityLog->action_type));
            $this->addWeight($facts['categories'], $wisata->kategori?->nama_kategori, $weight);
            $this->addWeight($facts['regions'], $wisata->lokasi?->nama_kabupaten, max(1, (int) floor($weight / 2)));
        }

        return $facts;
    }

    public function backwardChaining(Collection $destinations, array $facts): Collection
    {
        if (!$facts['has_preferences'] && !$facts['has_activity']) {
            return $destinations;
        }

        return $destinations->filter(function (Wisata $destination) use ($facts) {
            $proofScore = 0;

            if ($this->categoryScore($destination, $facts) > 0) {
                $proofScore += 2;
            }

            if ($this->regionScore($destination, $facts) > 0) {
                $proofScore += 1;
            }

            if ($this->priceScore($destination, $facts) > 0) {
                $proofScore += 1;
            }

            if ((float) ($destination->rating ?? 0) >= 4.0) {
                $proofScore += 1;
            }

            return $proofScore > 0;
        });
    }

    public function rankWithSaw(Collection $destinations, array $facts): Collection
    {
        $rows = $destinations->map(function (Wisata $destination) use ($facts) {
            $activityScore = (float) $destination->activityLogs()
                ->whereIn('action_type', ['click_detail', 'visit_detail', 'want_to_go'])
                ->sum('weight');

            return [
                'destination' => $destination,
                'category' => $this->categoryScore($destination, $facts),
                'region' => $this->regionScore($destination, $facts),
                'price' => $this->priceScore($destination, $facts),
                'rating' => (float) ($destination->rating ?? 0),
                'activity' => $activityScore,
                'want' => (float) ($destination->want_to_gos_count ?? 0),
            ];
        });

        $maxValues = [
            'category' => max(1, (float) $rows->max('category')),
            'region' => max(1, (float) $rows->max('region')),
            'price' => max(1, (float) $rows->max('price')),
            'rating' => max(1, (float) $rows->max('rating')),
            'activity' => max(1, (float) $rows->max('activity')),
            'want' => max(1, (float) $rows->max('want')),
        ];

        $weights = $this->sawWeights($facts);

        return $rows->map(function (array $row) use ($maxValues, $weights, $facts) {
            $score = 0;
            foreach ($weights as $key => $weight) {
                $score += (($row[$key] ?? 0) / $maxValues[$key]) * $weight;
            }

            /** @var Wisata $destination */
            $destination = $row['destination'];
            $destination->skor_akhir = round($score, 6);
            $destination->alasan_rekomendasi = $this->recommendationReasons($destination, $facts);

            return $destination;
        })->sortByDesc('skor_akhir')->values();
    }

    private function sawWeights(array $facts): array
    {
        $weights = [
            'category' => 0.24,
            'region' => 0.16,
            'price' => 0.18,
            'rating' => 0.22,
            'activity' => 0.14,
            'want' => 0.06,
        ];

        if (!empty($facts['categories'])) {
            $weights['category'] += 0.08;
            $weights['rating'] -= 0.04;
            $weights['want'] -= 0.04;
        }

        if (!empty($facts['regions'])) {
            $weights['region'] += 0.05;
            $weights['rating'] -= 0.05;
        }

        if ($facts['budget_max'] || !empty($facts['price_category'])) {
            $weights['price'] += 0.06;
            $weights['activity'] -= 0.03;
            $weights['want'] -= 0.03;
        }

        $total = array_sum($weights) ?: 1;

        return collect($weights)
            ->map(fn ($weight) => max(0, $weight) / $total)
            ->all();
    }

    private function categoryScore(Wisata $destination, array $facts): float
    {
        $category = $destination->kategori?->nama_kategori;
        if (!$category || empty($facts['categories'])) {
            return empty($facts['categories']) ? 1.0 : 0.0;
        }

        return (float) ($facts['categories'][$this->key($category)] ?? 0);
    }

    private function regionScore(Wisata $destination, array $facts): float
    {
        $region = $destination->lokasi?->nama_kabupaten;
        if (!$region || empty($facts['regions'])) {
            return empty($facts['regions']) ? 1.0 : 0.0;
        }

        return (float) ($facts['regions'][$this->key($region)] ?? 0);
    }

    private function priceScore(Wisata $destination, array $facts): float
    {
        $price = $this->destinationPrice($destination);
        $budgetMin = $facts['budget_min'];
        $budgetMax = $facts['budget_max'];
        $preferredPriceCategories = $facts['price_category'];

        if (!$budgetMin && !$budgetMax && empty($preferredPriceCategories)) {
            return 1.0;
        }

        if ($price === null) {
            return 0.7;
        }

        $score = 0.0;
        if ($budgetMax && $price <= (int) $budgetMax) {
            $score += 2.0;
        }

        if ($budgetMin && $price >= (int) $budgetMin) {
            $score += 0.5;
        }

        $priceCategory = $this->priceCategory($price);
        $score += (float) ($preferredPriceCategories[$this->key($priceCategory)] ?? 0);

        return $score;
    }

    private function recommendationReasons(Wisata $destination, array $facts): array
    {
        $reasons = [];

        if ($this->categoryScore($destination, $facts) > 0 && !empty($facts['categories'])) {
            $reasons[] = 'Kategori sesuai minat Anda.';
        }

        if ($this->regionScore($destination, $facts) > 0 && !empty($facts['regions'])) {
            $reasons[] = 'Lokasi sesuai wilayah pilihan.';
        }

        if ($this->priceScore($destination, $facts) > 0 && ($facts['budget_max'] || !empty($facts['price_category']))) {
            $reasons[] = 'Harga sesuai preferensi budget.';
        }

        if ((float) ($destination->rating ?? 0) >= 4.0) {
            $reasons[] = 'Rating destinasi tergolong baik.';
        }

        return $reasons ?: ['Destinasi populer dari dataset wisata Bali.'];
    }

    private function destinationPrice(Wisata $destination): ?int
    {
        $price = $destination->harga_wni_min ?? $destination->harga_wna_min;

        return is_numeric($price) ? (int) $price : null;
    }

    private function priceCategory(int $price): string
    {
        if ($price <= 50000) {
            return 'murah';
        }

        if ($price <= 150000) {
            return 'sedang';
        }

        return 'mahal';
    }

    private function activityWeight(?string $type): int
    {
        return match ($type) {
            'want_to_go' => 5,
            'click_detail', 'visit_detail' => 2,
            'search' => 1,
            default => 1,
        };
    }

    private function addWeight(array &$target, ?string $name, int $weight): void
    {
        $key = $this->key($name);
        if ($key === '') {
            return;
        }

        $target[$key] = ($target[$key] ?? 0) + max(1, $weight);
    }

    private function key(?string $value): string
    {
        return strtolower(trim((string) $value));
    }
}
