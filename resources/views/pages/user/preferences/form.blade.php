@extends('layouts.app')

@section('title', $isEdit ? 'Edit Preferensi Wisata' : 'Personalisasi Wisata')

@section('content')
@php
    $preference = $preference ?? null;
    $selectedCategoryIds = collect(old('category_ids', $selectedCategoryIds ?? []))->map(fn ($id) => (int) $id)->all();
    $selectedRegion = old('preferred_region', $preference?->preferred_region);
    $selectedPriceCategory = old('price_category', $preference?->price_category ?: 'sedang');
    $priceBudgetRanges = [
        '' => ['min' => '', 'max' => ''],
        'murah' => ['min' => 0, 'max' => 50000],
        'sedang' => ['min' => 50000, 'max' => 500000],
        'mahal' => ['min' => 500000, 'max' => 10000000],
    ];
    $priceCategoryOptions = [
        '' => ['label' => 'Tidak dibatasi', 'description' => 'Cocok untuk semua pilihan harga.'],
        'murah' => ['label' => 'Murah', 'description' => 'Prioritaskan destinasi hemat.'],
        'sedang' => ['label' => 'Sedang', 'description' => 'Pilihan seimbang untuk mayoritas destinasi.'],
        'mahal' => ['label' => 'Premium', 'description' => 'Untuk pengalaman wisata lebih lengkap.'],
    ];
    $selectedBudgetRange = $priceBudgetRanges[$selectedPriceCategory] ?? $priceBudgetRanges['sedang'];
    $action = $isEdit ? route('preferences.update') : route('preferences.store');
@endphp

<div class="mx-auto max-w-[980px] animate-page-in">
    <section class="mt-4 rounded-[2rem] border border-sky-100/80 bg-gradient-to-br from-white via-sky-50 to-amber-50/60 p-6 shadow-[0_24px_70px_rgba(15,23,42,0.08)] sm:p-8">
        <p class="inline-flex rounded-full border border-sky-100 bg-sky-50/80 px-4 py-2 text-xs font-bold uppercase tracking-[0.22em] text-sky-700">
            Personalisasi Wisata
        </p>
        <h1 class="mt-4 font-display text-4xl font-semibold leading-tight text-slate-950 sm:text-5xl">
            {{ $isEdit ? 'Perbarui preferensi Anda.' : 'Bantu kami mengenal gaya perjalanan Anda.' }}
        </h1>
        <p class="mt-4 max-w-2xl text-sm leading-6 text-slate-600">
            Preferensi ini dipakai untuk menyusun rekomendasi wisata dari dataset lokal dan aktivitas Anda di aplikasi.
        </p>
    </section>

    <section class="mt-6 rounded-[2rem] border border-sky-100/80 bg-white/90 p-6 shadow-[0_20px_60px_rgba(15,23,42,0.08)] sm:p-8">
        @if($errors->preferences->any())
            <div class="mb-6 rounded-3xl border border-red-100 bg-red-50 px-5 py-4 text-sm font-semibold leading-6 text-red-700">
                Periksa kembali input preferensi Anda.
            </div>
        @endif

        <form method="POST" action="{{ $action }}" class="space-y-6">
            @csrf
            @if($isEdit)
                @method('PATCH')
            @endif

            <div>
                <label for="preferred_region" class="mb-2 block text-sm font-bold text-slate-700">Wilayah Preferensi</label>
                <select id="preferred_region" name="preferred_region" class="min-h-14 w-full rounded-2xl border border-slate-200 bg-slate-50/80 px-5 text-sm font-semibold text-slate-900 shadow-sm transition focus:border-sky-300 focus:bg-white focus:outline-none focus:ring-4 focus:ring-sky-100">
                    <option value="">Semua wilayah</option>
                    @foreach($locations as $location)
                        <option value="{{ $location->nama_kabupaten }}" @selected($selectedRegion === $location->nama_kabupaten)>
                            {{ $location->nama_kabupaten }}
                        </option>
                    @endforeach
                </select>
                @error('preferred_region', 'preferences')
                    <p class="mt-2 text-sm font-semibold text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <p class="mb-3 block text-sm font-bold text-slate-700">Kategori Wisata Favorit</p>
                <div class="grid gap-3 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach($categories as $category)
                        <label class="flex min-h-14 cursor-pointer items-center gap-3 rounded-2xl border border-slate-200 bg-slate-50/80 px-4 text-sm font-bold text-slate-700 transition hover:border-sky-100 hover:bg-sky-50">
                            <input type="checkbox" name="category_ids[]" value="{{ $category->id }}" class="h-4 w-4 accent-sky-700" @checked(in_array((int) $category->id, $selectedCategoryIds, true))>
                            <span>{{ $category->nama_kategori }}</span>
                        </label>
                    @endforeach
                </div>
                @error('category_ids', 'preferences')
                    <p class="mt-2 text-sm font-semibold text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div
                x-data="{
                    priceCategory: @json($selectedPriceCategory),
                    ranges: @json($priceBudgetRanges)
                }"
            >
                <div class="mb-3 flex flex-col gap-1">
                    <p class="text-sm font-bold text-slate-700">Kategori Harga</p>
                    <p class="text-sm leading-6 text-slate-500">Pilih kategori harga. Rentang budget teknis akan diatur otomatis.</p>
                </div>
                <input type="hidden" name="budget_min" value="{{ $selectedBudgetRange['min'] }}" x-bind:value="ranges[priceCategory]?.min ?? ''">
                <input type="hidden" name="budget_max" value="{{ $selectedBudgetRange['max'] }}" x-bind:value="ranges[priceCategory]?.max ?? ''">

                <div class="grid gap-3 sm:grid-cols-2 lg:grid-cols-4" role="radiogroup" aria-label="Kategori harga">
                    @foreach($priceCategoryOptions as $value => $option)
                        <label class="relative">
                            <input
                                type="radio"
                                name="price_category"
                                value="{{ $value }}"
                                class="peer sr-only"
                                x-model="priceCategory"
                                @checked($selectedPriceCategory === $value)
                            >
                            <span class="flex min-h-24 cursor-pointer flex-col justify-center rounded-2xl border border-slate-200 bg-slate-50/80 px-4 py-3 text-sm font-bold text-slate-700 shadow-sm transition hover:border-sky-100 hover:bg-sky-50 peer-checked:border-sky-700 peer-checked:bg-sky-50 peer-checked:text-sky-800 peer-checked:shadow-[inset_0_0_0_1px_rgba(3,105,161,0.18)]">
                                <span>{{ $option['label'] }}</span>
                                <span class="mt-1 text-xs font-semibold leading-5 text-slate-500 peer-checked:text-sky-700">{{ $option['description'] }}</span>
                            </span>
                        </label>
                    @endforeach
                </div>
                @error('price_category', 'preferences')
                    <p class="mt-2 text-sm font-semibold text-red-600">{{ $message }}</p>
                @enderror
                @error('budget_min', 'preferences')
                    <p class="mt-2 text-sm font-semibold text-red-600">{{ $message }}</p>
                @enderror
                @error('budget_max', 'preferences')
                    <p class="mt-2 text-sm font-semibold text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex flex-col gap-3 pt-2 sm:flex-row">
                <button type="submit" class="inline-flex min-h-12 flex-1 items-center justify-center rounded-full bg-sky-700 px-6 text-sm font-bold text-white shadow-[0_14px_34px_rgba(3,105,161,0.22)] transition hover:-translate-y-0.5 hover:bg-sky-800">
                    Simpan Preferensi
                </button>

                @unless($isEdit)
                    <button type="submit" name="skip" value="1" formnovalidate class="inline-flex min-h-12 flex-1 items-center justify-center rounded-full border border-slate-200 bg-white px-6 text-sm font-bold text-slate-700 transition hover:bg-sky-50 hover:text-sky-800">
                        Lewati Dulu
                    </button>
                @endunless

                <a href="{{ route('user.home') }}" class="inline-flex min-h-12 flex-1 items-center justify-center rounded-full border border-slate-200 bg-white px-6 text-sm font-bold text-slate-700 transition hover:bg-sky-50 hover:text-sky-800">
                    Kembali
                </a>
            </div>
        </form>
    </section>
</div>
@endsection
