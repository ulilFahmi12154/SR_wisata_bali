@extends('layouts.app')

@section('title', 'Eksplorasi Wisata')

@section('content')
@php
    $user = $user ?? auth()->user();
    $preference = $user?->preference;
    $firstCategoryName = strtolower((string) ($user?->preferenceCategories?->first()?->category?->nama_kategori ?? ''));
    $selectedRegency = match (true) {
        str_contains(strtolower((string) $preference?->preferred_region), 'badung') => 'badung',
        str_contains(strtolower((string) $preference?->preferred_region), 'gianyar') => 'gianyar',
        str_contains(strtolower((string) $preference?->preferred_region), 'bangli') => 'bangli',
        str_contains(strtolower((string) $preference?->preferred_region), 'buleleng') => 'buleleng',
        default => 'all',
    };
    $selectedInterest = match (true) {
        str_contains($firstCategoryName, 'pantai') => 'beach',
        str_contains($firstCategoryName, 'alam') => 'nature',
        str_contains($firstCategoryName, 'budaya') || str_contains($firstCategoryName, 'pura') => 'culture',
        str_contains($firstCategoryName, 'kuliner') => 'culinary',
        default => 'all',
    };
    $selectedBudget = (int) ($preference?->budget_max ?? 500000);
    $selectedAmenities = [];
@endphp

<style>
    .explore-icon {
        width: 20px;
        height: 20px;
        flex-shrink: 0;
        object-fit: contain;
        filter: saturate(0.7);
        opacity: 0.82;
    }

    .explore-slider {
        width: 100%;
        height: 8px;
        margin-top: 16px;
        cursor: pointer;
        appearance: none;
        border-radius: 999px;
        background: linear-gradient(90deg, rgba(186, 230, 253, 0.92), rgba(226, 232, 240, 0.92));
        accent-color: #0369a1;
    }

    .explore-slider::-webkit-slider-thumb {
        width: 20px;
        height: 20px;
        appearance: none;
        border: 4px solid #ffffff;
        border-radius: 999px;
        background: #0369a1;
        box-shadow: 0 8px 20px rgba(2, 132, 199, 0.24);
    }

    .explore-slider::-moz-range-track {
        height: 8px;
        border-radius: 999px;
        background: linear-gradient(90deg, rgba(186, 230, 253, 0.92), rgba(226, 232, 240, 0.92));
    }

    .explore-slider::-moz-range-thumb {
        width: 14px;
        height: 14px;
        border: 4px solid #ffffff;
        border-radius: 999px;
        background: #0369a1;
        box-shadow: 0 8px 20px rgba(2, 132, 199, 0.24);
    }

    @media (prefers-reduced-motion: reduce) {
        .explore-slider {
            transition: none;
        }
    }
</style>

<div class="mx-auto max-w-[1180px] animate-page-in">
    @if(session('status'))
        <div class="mb-5 rounded-3xl border border-sky-100 bg-sky-50 px-5 py-4 text-sm font-semibold text-sky-800">
            {{ session('status') }}
        </div>
    @endif

    <div class="mb-5 mt-2 flex flex-wrap items-center justify-between gap-3 animate-fade-up">
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('user.home') }}" class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white/85 px-4 py-2 text-sm font-bold text-slate-600 shadow-sm transition hover:border-sky-100 hover:bg-sky-50 hover:text-sky-800">
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="M19 12H5m6 6-6-6 6-6" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Kembali ke Beranda
            </a>
            @if($user?->onboarding_completed)
                <a href="{{ route('user.profile', ['section' => 'preferences']) }}" class="inline-flex items-center rounded-full border border-sky-100 bg-sky-50/85 px-4 py-2 text-sm font-bold text-sky-800 shadow-sm transition hover:bg-sky-100">
                    Edit Preferensi
                </a>
            @endif
        </div>
        <span class="rounded-full border border-sky-100 bg-sky-50/80 px-4 py-2 text-xs font-bold uppercase tracking-[0.2em] text-sky-700">
            Eksplorasi Wisata
        </span>
    </div>

    <section class="overflow-hidden rounded-[2.25rem] border border-sky-100/80 bg-gradient-to-br from-sky-50/90 via-white to-amber-50/70 p-6 shadow-[0_26px_80px_rgba(15,23,42,0.10)] animate-fade-up sm:p-8 lg:p-10">
        <div class="grid gap-8 lg:grid-cols-[minmax(0,0.92fr)_minmax(360px,1.08fr)] lg:items-center">
            <section aria-label="Intro eksplorasi wisata">
                <p class="inline-flex rounded-full border border-sky-100 bg-white/75 px-4 py-2 text-xs font-bold uppercase tracking-[0.2em] text-sky-700 shadow-sm">
                    Personalisasi Perjalanan
                </p>
                <h1 class="mt-6 max-w-xl font-display text-5xl font-semibold leading-[1.04] text-slate-950 sm:text-6xl">
                    Temukan <span class="text-sky-700">Liburan Bali</span> Terbaik.
                </h1>
                <p class="mt-5 max-w-xl text-base leading-8 text-slate-600">
                    {{ $user?->onboarding_completed
                        ? 'Gunakan filter ini untuk mencari rekomendasi lain tanpa mengubah preferensi utama yang sudah tersimpan.'
                        : 'Pilih preferensi perjalanan Anda untuk mendapatkan rekomendasi destinasi yang sesuai.' }}
                </p>

                <article class="relative mt-8 min-h-[310px] overflow-hidden rounded-[1.75rem] border border-white/80 bg-slate-200 shadow-[0_24px_68px_rgba(15,23,42,0.14)] sm:min-h-[380px]">
                    <img src="{{ asset('images/mos268mh-pt07rre.png') }}" alt="Pemandangan infinity pool di Bali" class="absolute inset-0 h-full w-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950/70 via-slate-900/15 to-transparent"></div>
                    <div class="absolute bottom-6 left-6 right-6 text-white">
                        <p class="inline-flex items-center gap-2 text-sm font-bold text-white/85">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                <path d="M12 21s7-6.08 7-12A7 7 0 1 0 5 9c0 5.92 7 12 7 12Z" stroke="currentColor" stroke-width="1.8"/>
                                <path d="M12 11.5A2.5 2.5 0 1 0 12 6a2.5 2.5 0 0 0 0 5.5Z" stroke="currentColor" stroke-width="1.8"/>
                            </svg>
                            Kawasan Ubud
                        </p>
                        <h2 class="mt-2 font-display text-3xl font-semibold leading-tight">Destinasi Alam Pilihan</h2>
                    </div>
                </article>
            </section>

            <section class="relative overflow-hidden rounded-[2rem] border border-sky-100/80 bg-white/90 p-6 shadow-[0_24px_68px_rgba(15,23,42,0.09)] sm:p-8" aria-label="Form eksplorasi rekomendasi">
                <div class="absolute left-8 right-8 top-0 h-1 rounded-b-full bg-gradient-to-r from-sky-100 via-sky-600/40 to-amber-200"></div>
                <h2 class="text-2xl font-bold text-slate-950">Filter Utama</h2>

                <form method="POST" action="{{ route('user.recommendations.process') }}" class="mt-7 space-y-6" x-data="{ budget: {{ $selectedBudget }} }">
                    @csrf

                    <div>
                        <p class="mb-3 flex items-center gap-3 text-base font-bold text-slate-700">
                            <img class="explore-icon" src="{{ asset('images/mos268mb-l3nqqp7.svg') }}" alt="" aria-hidden="true">
                            Wilayah mana yang ingin Anda jelajahi?
                        </p>
                        <label for="explore_regency" class="mb-2 block text-sm font-bold text-slate-500">Kabupaten/Kota</label>
                        <select id="explore_regency" class="min-h-14 w-full rounded-2xl border border-slate-200 bg-slate-50/80 px-5 text-sm font-semibold text-slate-900 shadow-sm transition focus:border-sky-300 focus:bg-white focus:outline-none focus:ring-4 focus:ring-sky-100" name="regency" aria-label="Pilih kabupaten">
                            <option value="all" @selected($selectedRegency === 'all')>Pilih Kabupaten</option>
                            <option value="badung" @selected($selectedRegency === 'badung')>Badung</option>
                            <option value="gianyar" @selected($selectedRegency === 'gianyar')>Gianyar</option>
                            <option value="bangli" @selected($selectedRegency === 'bangli')>Bangli</option>
                            <option value="buleleng" @selected($selectedRegency === 'buleleng')>Buleleng</option>
                        </select>
                    </div>

                    <div>
                        <p class="mb-3 flex items-center gap-3 text-base font-bold text-slate-700">
                            <img class="explore-icon" src="{{ asset('images/mos268mb-dab7w9w.svg') }}" alt="" aria-hidden="true">
                            Ingin liburan seperti apa kali ini?
                        </p>
                        <p class="mb-3 text-sm font-bold text-slate-500">Kategori Wisata</p>
                        <div class="flex flex-wrap gap-3" role="radiogroup" aria-label="Minat utama">
                            @foreach([
                                'all' => 'Semua',
                                'nature' => 'Alam',
                                'culture' => 'Budaya',
                                'beach' => 'Pantai',
                                'culinary' => 'Kuliner',
                            ] as $value => $label)
                                <label class="relative">
                                    <input type="radio" name="interest" value="{{ $value }}" class="peer sr-only" @checked($selectedInterest === $value)>
                                    <span class="inline-flex min-h-11 cursor-pointer items-center justify-center rounded-full border border-slate-200 bg-slate-50 px-5 text-sm font-bold text-slate-600 shadow-sm transition hover:border-sky-200 hover:bg-sky-50 hover:text-sky-800 peer-checked:border-sky-700 peer-checked:bg-sky-700 peer-checked:text-white">
                                        {{ $label }}
                                    </span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div>
                        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                            <p class="flex items-center gap-3 text-base font-bold text-slate-700">
                                <img class="explore-icon" src="{{ asset('images/mos268mb-zgiezb6.svg') }}" alt="" aria-hidden="true">
                                Estimasi Biaya Harian
                            </p>
                            <div class="flex min-h-14 w-full items-center gap-3 rounded-2xl border border-slate-200 bg-slate-50/80 px-4 shadow-sm focus-within:border-sky-300 focus-within:bg-white focus-within:ring-4 focus-within:ring-sky-100 sm:w-[190px]">
                                <span class="text-sm font-black text-sky-700">Rp</span>
                                <input
                                    class="min-h-12 w-full bg-transparent text-sm font-semibold text-slate-900 focus:outline-none"
                                    type="number"
                                    name="budget"
                                    min="0"
                                    max="10000000"
                                    step="10000"
                                    inputmode="numeric"
                                    x-model.number="budget"
                                    aria-label="Nilai budget"
                                >
                            </div>
                        </div>
                        <p class="mt-3 text-sm leading-6 text-slate-500">Atur pengeluaran maksimum per orang</p>
                        <input class="explore-slider" type="range" min="0" max="2000000" step="50000" x-model.number="budget" aria-label="Budget harian">
                        <div class="mt-3 flex justify-between gap-3 text-xs font-bold text-slate-400">
                            <span>Rp 0</span>
                            <span>Rp 1.000.000</span>
                            <span>Rp 2.000.000+</span>
                        </div>
                    </div>

                    <div>
                        <p class="mb-3 flex items-center gap-3 text-base font-bold text-slate-700">
                            <img class="explore-icon" src="{{ asset('images/mos268mb-g9rqp6i.svg') }}" alt="" aria-hidden="true">
                            Fasilitas Pendukung
                        </p>
                        <p class="mb-3 text-sm font-bold text-slate-500">Pilih fasilitas yang wajib ada</p>
                        <div class="grid gap-3 sm:grid-cols-2">
                            @foreach([
                                'parking' => 'Area Parkir',
                                'wifi' => 'Wifi Cepat',
                                'restroom' => 'Toilet Bersih',
                                'restaurant' => 'Restoran/Rumah Makan',
                            ] as $value => $label)
                                <label class="flex min-h-14 cursor-pointer items-center gap-3 rounded-2xl border border-slate-200 bg-slate-50/75 px-4 py-3 text-sm font-bold text-slate-600 transition hover:border-sky-200 hover:bg-sky-50 hover:text-sky-800">
                                    <input type="checkbox" name="amenities[]" value="{{ $value }}" class="h-4 w-4 rounded border-slate-300 text-sky-700 focus:ring-sky-200" @checked(in_array($value, $selectedAmenities, true))>
                                    <span>{{ $label }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <button class="inline-flex min-h-14 w-full items-center justify-center gap-3 rounded-2xl bg-sky-700 px-6 text-sm font-bold text-white shadow-[0_16px_34px_rgba(2,132,199,0.20)] transition hover:-translate-y-0.5 hover:bg-sky-800 focus:outline-none focus:ring-4 focus:ring-sky-100" type="submit">
                        <span>Cari Rekomendasi</span>
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path d="M5 12h14m-6-6 6 6-6 6" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                    <p class="text-center text-xs font-semibold leading-6 text-slate-400">
                        Pencarian ini hanya untuk eksplorasi dan tidak menyimpan ulang preferensi utama.
                    </p>
                </form>
            </section>
        </div>
    </section>
</div>
@endsection
