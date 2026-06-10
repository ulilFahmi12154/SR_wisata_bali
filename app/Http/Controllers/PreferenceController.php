<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Lokasi;
use App\Models\UserPreference;
use App\Models\UserPreferenceCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class PreferenceController extends Controller
{
    public function create(Request $request): View
    {
        return view('pages.user.preferences.form', $this->formData($request, false));
    }

    public function store(Request $request): RedirectResponse
    {
        if ($request->has('skip')) {
            return redirect()
                ->route('user.home')
                ->with('status', 'Personalisasi dilewati. Anda tetap bisa mengisinya dari halaman profil.');
        }

        $this->savePreferences($request);

        return redirect()
            ->route('user.home')
            ->with('status', 'Personalisasi berhasil disimpan.');
    }

    public function edit(Request $request): View
    {
        return view('pages.user.preferences.form', $this->formData($request, true));
    }

    public function update(Request $request): RedirectResponse
    {
        $this->savePreferences($request);

        return back()->with('preferences_status', 'Preferensi wisata berhasil diperbarui.');
    }

    private function savePreferences(Request $request): void
    {
        $validated = $request->validateWithBag('preferences', [
            'preferred_region' => ['nullable', 'string', 'max:120'],
            'category_ids' => ['required', 'array', 'min:1'],
            'category_ids.*' => ['integer', Rule::exists('kategori', 'id')],
            'price_category' => ['nullable', Rule::in(['murah', 'sedang', 'mahal'])],
        ], [
            'category_ids.required' => 'Pilih minimal satu kategori wisata.',
            'category_ids.min' => 'Pilih minimal satu kategori wisata.',
            'category_ids.*.exists' => 'Kategori wisata tidak valid.',
            'price_category.in' => 'Kategori harga tidak valid.',
        ]);

        $user = $request->user();
        $budgetRange = $this->budgetRangeForPriceCategory($validated['price_category'] ?? null);

        UserPreference::updateOrCreate(
            ['user_id' => $user->id],
            [
                'preferred_region' => $validated['preferred_region'] ?? null,
                'price_category' => $validated['price_category'] ?? null,
                'budget_min' => $budgetRange['min'],
                'budget_max' => $budgetRange['max'],
            ]
        );

        UserPreferenceCategory::where('user_id', $user->id)->delete();
        foreach (array_values($validated['category_ids']) as $index => $categoryId) {
            UserPreferenceCategory::create([
                'user_id' => $user->id,
                'category_id' => $categoryId,
                'weight' => max(3, 5 - $index),
            ]);
        }

        $user->forceFill([
            'onboarding_completed' => true,
            'preferences_completed_at' => $user->preferences_completed_at ?? now(),
        ])->save();
    }

    private function formData(Request $request, bool $isEdit): array
    {
        $user = $request->user()->loadMissing(['preference', 'preferenceCategories']);

        return [
            'user' => $user,
            'preference' => $user->preference,
            'selectedCategoryIds' => $user->preferenceCategories->pluck('category_id')->all(),
            'categories' => Kategori::query()->orderBy('nama_kategori')->get(),
            'locations' => Lokasi::query()->orderBy('nama_kabupaten')->get(),
            'isEdit' => $isEdit,
        ];
    }

    private function budgetRangeForPriceCategory(?string $priceCategory): array
    {
        return match ($priceCategory) {
            'murah' => ['min' => 0, 'max' => 50000],
            'sedang' => ['min' => 50000, 'max' => 500000],
            'mahal' => ['min' => 500000, 'max' => 10000000],
            default => ['min' => null, 'max' => null],
        };
    }
}
