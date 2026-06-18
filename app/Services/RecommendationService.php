<?php

namespace App\Services;

use App\Models\ActivityLog;
use App\Models\User;
use App\Models\Wisata;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class RecommendationService
{
    private const HOME_MAX_DESTINATIONS = 8;
    private const HOME_CANDIDATE_LIMIT = 48;

    public function recommendForUser(?User $user, int $limit = 12): Collection
    {
        return $this->recommend($user, $limit, true, true);
    }

    public function recommendByPreference(?User $user, int $limit = 12): Collection
    {
        return $this->recommend($user, $limit, true, false);
    }

    public function recommendByActivity(?User $user, int $limit = 12): Collection
    {
        return $this->recommend($user, $limit, false, true);
    }

    public function recommendHomeByPreference(?User $user, int $limit = 6): Collection
    {
        return $this->recommend(
            $user,
            $this->homeLimit($limit),
            true,
            false,
            self::HOME_CANDIDATE_LIMIT,
            false,
            true
        );
    }

    public function recommendHomeByActivity(?User $user, int $limit = 6): Collection
    {
        return $this->recommend(
            $user,
            $this->homeLimit($limit),
            false,
            true,
            self::HOME_CANDIDATE_LIMIT,
            false,
            true
        );
    }

    public function getUserInterestSummary(?User $user, int $limit = 5): array
    {
        $facts = $this->forwardChaining($user, true, true);
        $items = collect($facts['categories'])
            ->sortDesc()
            ->take($limit)
            ->map(function (int|float $value, string $key) {
                $level = $this->interestLevel((int) $value);

                return [
                    'name' => $this->displayName($key),
                    'level' => $level,
                    'bar' => match ($level) {
                        'Tinggi' => 100,
                        'Sedang' => 66,
                        default => 38,
                    },
                ];
            })
            ->values();

        return [
            'items' => $items,
            'has_preferences' => (bool) $facts['has_preferences'],
            'has_activity' => (bool) $facts['has_activity'],
        ];
    }

    private function recommend(
        ?User $user,
        int $limit,
        bool $includePreferences,
        bool $includeActivity,
        ?int $candidateLimit = null,
        bool $includeFacilities = true,
        bool $homeColumns = false
    ): Collection
    {
        $limit = max(1, $limit);
        $facts = $this->forwardChaining($user, $includePreferences, $includeActivity);

        $destinationsQuery = $this->destinationQuery($facts, $includeFacilities, $homeColumns);

        if ($candidateLimit) {
            $this->applyHomeCandidateScope($destinationsQuery, $facts);
            $this->orderHomeCandidates($destinationsQuery);
            $destinationsQuery->limit(max($limit, $candidateLimit));
        }

        $destinations = $destinationsQuery->get();

        if ($destinations->isEmpty() && $candidateLimit) {
            $fallbackQuery = $this->destinationQuery($facts, $includeFacilities, $homeColumns);
            $this->orderHomeCandidates($fallbackQuery);

            $destinations = $fallbackQuery
                ->limit(max($limit, $candidateLimit))
                ->get();
        }

        if ($destinations->isEmpty()) {
            return collect();
        }

        $candidates = $this->backwardChaining($destinations, $facts);

        if ($candidates->isEmpty()) {
            $candidates = $destinations;
        }

        return $this->rankWithSaw($candidates, $facts)
            ->take($limit)
            ->values();
    }

    private function destinationQuery(array $facts, bool $includeFacilities, bool $homeColumns): Builder
    {
        $query = Wisata::query();

        if ($homeColumns) {
            $query->select([
                'id',
                'nama',
                'kategori_id',
                'lokasi_id',
                'harga_wni_min',
                'harga_wna_min',
                'rating',
                'image',
            ]);
        }

        $relations = $homeColumns
            ? ['kategori:id,nama_kategori', 'lokasi:id,nama_kabupaten']
            : ['kategori', 'lokasi'];

        if ($includeFacilities) {
            $relations[] = $homeColumns ? 'fasilitas:id,nama_fasilitas' : 'fasilitas';
        }

        return $query
            ->with($relations)
            ->withCount('wantToGos')
            ->withActivityScore($this->activityScoreUserId($facts));
    }

    private function applyHomeCandidateScope(Builder $query, array $facts): void
    {
        if (empty($facts['has_preferences']) && empty($facts['has_activity'])) {
            return;
        }

        $categoryKeys = array_keys($facts['categories']);
        $regionKeys = array_keys($facts['regions']);
        $hasPriceSignals = $facts['budget_min'] || $facts['budget_max'] || !empty($facts['price_category']);

        $query->where(function (Builder $query) use ($categoryKeys, $regionKeys, $facts, $hasPriceSignals) {
            if (!empty($categoryKeys)) {
                $query->orWhereHas('kategori', function (Builder $query) use ($categoryKeys) {
                    $this->whereNormalizedIn($query, 'nama_kategori', $categoryKeys);
                });
            }

            if (!empty($regionKeys)) {
                $query->orWhereHas('lokasi', function (Builder $query) use ($regionKeys) {
                    $this->whereNormalizedIn($query, 'nama_kabupaten', $regionKeys);
                });
            }

            if ($hasPriceSignals) {
                $query->orWhere(function (Builder $query) use ($facts) {
                    $this->applyPriceCandidateScope($query, $facts);
                });
            }

            $query->orWhere('rating', '>=', 4.0);
        });
    }

    private function applyPriceCandidateScope(Builder $query, array $facts): void
    {
        $priceColumn = 'COALESCE(harga_wni_min, harga_wna_min)';

        if ($facts['budget_max']) {
            $query->orWhereRaw("{$priceColumn} <= ?", [(int) $facts['budget_max']]);
        }

        if ($facts['budget_min']) {
            $query->orWhereRaw("{$priceColumn} >= ?", [(int) $facts['budget_min']]);
        }

        foreach (array_keys($facts['price_category']) as $priceCategory) {
            match ($priceCategory) {
                'murah' => $query->orWhereRaw("{$priceColumn} <= ?", [50000]),
                'sedang' => $query->orWhereRaw("{$priceColumn} BETWEEN ? AND ?", [50001, 150000]),
                'mahal' => $query->orWhereRaw("{$priceColumn} > ?", [150000]),
                default => null,
            };
        }

        $query->orWhere(function (Builder $query) {
            $query->whereNull('harga_wni_min')
                ->whereNull('harga_wna_min');
        });
    }

    private function orderHomeCandidates(Builder $query): void
    {
        $query
            ->orderByDesc('activity_score')
            ->orderByDesc('want_to_gos_count')
            ->orderByDesc('rating')
            ->orderBy('nama');
    }

    private function whereNormalizedIn(Builder $query, string $column, array $values): void
    {
        $query->where(function (Builder $query) use ($column, $values) {
            foreach (array_values($values) as $index => $value) {
                $method = $index === 0 ? 'whereRaw' : 'orWhereRaw';

                $query->{$method}("LOWER(TRIM({$column})) = ?", [$value]);
            }
        });
    }

    private function activityScoreUserId(array $facts): ?int
    {
        if (empty($facts['use_user_activity']) || empty($facts['user_id'])) {
            return null;
        }

        return (int) $facts['user_id'];
    }

    private function homeLimit(int $limit): int
    {
        return min(self::HOME_MAX_DESTINATIONS, max(1, $limit));
    }

    public function forwardChaining(?User $user, bool $includePreferences = true, bool $includeActivity = true): array
    {
        $facts = [
            'user_id' => $user?->id,
            'use_user_activity' => $includeActivity,
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

        $relations = [];
        if ($includePreferences) {
            $relations[] = 'preference:id,user_id,preferred_region,price_category,budget_min,budget_max';
            $relations[] = 'preferenceCategories:id,user_id,category_id,weight';
            $relations[] = 'preferenceCategories.category:id,nama_kategori';
        }
        if ($includeActivity) {
            $relations[] = 'wantToGos:id,user_id,wisata_id';
            $relations[] = 'wantToGos.wisata:id,kategori_id,lokasi_id';
            $relations[] = 'wantToGos.wisata.kategori:id,nama_kategori';
            $relations[] = 'wantToGos.wisata.lokasi:id,nama_kabupaten';
        }

        if (!empty($relations)) {
            $user->loadMissing($relations);
        }

        if ($includePreferences) {
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
        }

        if (!$includeActivity) {
            return $facts;
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
            ->with([
                'wisata:id,kategori_id,lokasi_id',
                'wisata.kategori:id,nama_kategori',
                'wisata.lokasi:id,nama_kabupaten',
            ])
            ->where('user_id', $user->id)
            ->whereNotNull('wisata_id')
            ->whereNotIn('action_type', ['want_to_go'])
            ->latest()
            ->limit(80)
            ->get(['id', 'user_id', 'wisata_id', 'action_type', 'weight', 'created_at']);

        foreach ($activityLogs as $activityLog) {
            $wisata = $activityLog->wisata;
            if (!$wisata) {
                continue;
            }

            $facts['has_activity'] = true;
            $weight = $this->activityLogWeight($activityLog);
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
            $activityScore = (float) ($destination->activity_score ?? 0);

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
            $destination->alasan_rekomendasi = $this->recommendationReasons($destination, $facts, (float) ($row['activity'] ?? 0));
            $destination->recommendation_reason = $destination->alasan_rekomendasi[0] ?? null;

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

    private function recommendationReasons(Wisata $destination, array $facts, float $activityScore = 0): array
    {
        $reasons = [];
        $category = $destination->kategori?->nama_kategori;
        $region = $destination->lokasi?->nama_kabupaten;

        if ($activityScore > 0 && !empty($facts['use_user_activity'])) {
            $reasons[] = 'Cocok untuk kamu karena kamu pernah menyimpan atau melihat destinasi serupa.';
        }

        if ($this->categoryScore($destination, $facts) > 0 && !empty($facts['categories']) && $category) {
            $reasons[] = "Cocok untuk kamu karena sesuai dengan minat {$category}.";
        }

        if ($this->regionScore($destination, $facts) > 0 && !empty($facts['regions']) && $region) {
            $reasons[] = "Direkomendasikan karena berada di wilayah {$region} yang kamu pilih.";
        }

        if ($this->priceScore($destination, $facts) > 0 && ($facts['budget_max'] || !empty($facts['price_category']))) {
            $reasons[] = 'Sesuai dengan preferensi harga kamu.';
        }

        if ((float) ($destination->rating ?? 0) >= 4.0) {
            $reasons[] = 'Memiliki ulasan yang baik dari data destinasi.';
        }

        return $reasons ?: ['Destinasi ini direkomendasikan karena memiliki kecocokan dengan preferensi wisata kamu.'];
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

    private function activityLogWeight(ActivityLog $activityLog): int
    {
        $storedWeight = (int) ($activityLog->weight ?: 0);
        $fallbackWeight = $this->activityWeight($activityLog->action_type);

        return match ($activityLog->action_type) {
            'click_detail', 'visit_detail' => max($storedWeight, 3),
            default => max(1, $storedWeight ?: $fallbackWeight),
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

    private function displayName(string $key): string
    {
        return collect(explode(' ', str_replace(['_', '-'], ' ', $key)))
            ->filter()
            ->map(fn (string $part) => mb_convert_case($part, MB_CASE_TITLE, 'UTF-8'))
            ->implode(' ');
    }

    private function interestLevel(int $value): string
    {
        if ($value >= 7) {
            return 'Tinggi';
        }

        if ($value >= 3) {
            return 'Sedang';
        }

        return 'Rendah';
    }
}
