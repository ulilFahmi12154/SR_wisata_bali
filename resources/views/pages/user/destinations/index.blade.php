@extends('layouts.app')

@section('title', 'Daftar Destinasi Wisata')

@section('content')
@php
    $destinations = $destinations ?? collect();
    $destinationsPaginator = $destinationsPaginator ?? null;
    $totalDestinations = $totalDestinations ?? $destinations->count();
    $totalAvailableDestinations = $totalAvailableDestinations ?? $totalDestinations;
    $wantedWisataIds = collect($wantedWisataIds ?? []);
    $categories = $categories ?? collect();
    $locations = $locations ?? collect();
    $sortOptions = $sortOptions ?? [
        'terbaru' => 'Terbaru',
        'name_asc' => 'Nama A-Z',
        'rating_desc' => 'Rating Tertinggi',
        'harga_asc' => 'Harga Terendah',
        'harga_desc' => 'Harga Tertinggi',
    ];
    $filters = array_merge([
        'search' => request('search', ''),
        'kategori_id' => request('kategori_id'),
        'lokasi_id' => request('lokasi_id'),
        'sort' => request('sort', 'terbaru'),
    ], $filters ?? []);
    $hasCatalogFilters = $hasCatalogFilters ?? collect($filters)->filter(fn ($value) => filled($value) && $value !== 'terbaru')->isNotEmpty();
    $currentSortLabel = $sortOptions[$filters['sort']] ?? 'Terbaru';
    $detailContextQuery = collect(request()->query())
        ->merge(['from' => 'destinasi'])
        ->filter(fn ($value) => filled($value))
        ->all();

    $formatPrice = function ($amount) {
        $value = is_numeric($amount) ? (int) $amount : null;

        return $value && $value > 0
            ? 'Rp ' . number_format($value, 0, ',', '.')
            : 'Gratis';
    };

    $destinationImage = function ($destination, $fallback = 'default beach.jpeg') {
        $imagePath = trim((string) ($destination->image ?? ''));
        $fallbackPath = 'images/' . ltrim($fallback, '/');

        if ($imagePath === '') {
            return asset($fallbackPath);
        }

        if (preg_match('/^https?:\/\//', $imagePath)) {
            return $imagePath;
        }

        $normalized = str_replace('\\', '/', $imagePath);
        $normalized = preg_replace('#^/?public/#', '', $normalized);
        $normalized = ltrim($normalized, '/');

        $candidates = str_starts_with($normalized, 'images/')
            ? [$normalized]
            : [
                'images/' . $normalized,
                'images/destination/' . $normalized,
                $normalized,
            ];

        foreach ($candidates as $candidate) {
            if (file_exists(public_path($candidate))) {
                return asset($candidate);
            }
        }

        return asset($fallbackPath);
    };
@endphp

<div class="mx-auto max-w-[1180px] animate-page-in">
    <section class="mt-4 overflow-hidden rounded-[2.25rem] border border-sky-100/80 bg-gradient-to-br from-white via-sky-50 to-amber-50/60 p-6 shadow-[0_26px_80px_rgba(15,23,42,0.08)] sm:p-8 lg:p-10 animate-fade-up">
        <div class="grid gap-6 lg:grid-cols-[minmax(0,1fr)_auto] lg:items-end">
            <div>
                <p class="inline-flex rounded-full border border-sky-100 bg-sky-50/80 px-4 py-2 text-xs font-bold uppercase tracking-[0.22em] text-sky-700">
                    Katalog Wisata Bali
                </p>
                <h1 class="mt-5 max-w-3xl font-display text-4xl font-semibold leading-[1.04] text-slate-950 sm:text-5xl lg:text-6xl">
                    Daftar Destinasi Wisata
                </h1>
                <p class="mt-5 max-w-2xl text-base leading-7 text-slate-600 sm:text-lg">
                    Jelajahi seluruh destinasi wisata Bali dengan pencarian, filter ringan, dan urutan katalog. Untuk rekomendasi personal berdasarkan preferensi perjalanan, gunakan halaman Home.
                </p>
            </div>

            <div class="flex flex-wrap gap-2 lg:justify-end">
                <a href="{{ route('user.home') }}" class="rounded-full border border-amber-100 bg-amber-50/80 px-4 py-2 text-xs font-bold text-amber-700 shadow-sm transition hover:bg-amber-100">
                    Lihat Rekomendasi Personal
                </a>
            </div>
        </div>
    </section>

    <section class="mt-6 rounded-[2rem] border border-sky-100/80 bg-white/90 p-5 shadow-[0_20px_60px_rgba(15,23,42,0.07)] animate-fade-up animate-delay-100 sm:p-6">
        <div class="mb-5 flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="text-xs font-bold uppercase tracking-[0.22em] text-sky-700">Filter Katalog</p>
                <h2 class="mt-2 font-display text-2xl font-semibold text-slate-950">Temukan destinasi lebih cepat.</h2>
            </div>
            <p class="text-sm leading-6 text-slate-500">
                Filter memakai URL, sehingga hasil bisa dibagikan.
            </p>
        </div>

        <form method="GET" action="{{ route('user.destinations') }}" class="grid gap-4 xl:grid-cols-[minmax(220px,1.35fr)_minmax(170px,0.9fr)_minmax(170px,0.9fr)_minmax(160px,0.8fr)_auto]">
            <div>
                <label for="search" class="mb-2 block text-sm font-bold text-slate-700">Cari Destinasi</label>
                <input
                    id="search"
                    name="search"
                    type="search"
                    value="{{ $filters['search'] }}"
                    placeholder="Cari nama destinasi..."
                    class="min-h-14 w-full rounded-2xl border border-slate-200 bg-slate-50/80 px-5 text-sm font-semibold text-slate-900 placeholder-slate-400 shadow-sm transition focus:border-sky-300 focus:bg-white focus:outline-none focus:ring-4 focus:ring-sky-100"
                >
            </div>

            <div>
                <label for="kategori_id" class="mb-2 block text-sm font-bold text-slate-700">Kategori</label>
                <select
                    id="kategori_id"
                    name="kategori_id"
                    class="min-h-14 w-full rounded-2xl border border-slate-200 bg-slate-50/80 px-5 text-sm font-semibold text-slate-900 shadow-sm transition focus:border-sky-300 focus:bg-white focus:outline-none focus:ring-4 focus:ring-sky-100"
                >
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" @selected((int) $filters['kategori_id'] === (int) $category->id)>
                            {{ $category->nama_kategori }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="lokasi_id" class="mb-2 block text-sm font-bold text-slate-700">Kabupaten/Kota</label>
                <select
                    id="lokasi_id"
                    name="lokasi_id"
                    class="min-h-14 w-full rounded-2xl border border-slate-200 bg-slate-50/80 px-5 text-sm font-semibold text-slate-900 shadow-sm transition focus:border-sky-300 focus:bg-white focus:outline-none focus:ring-4 focus:ring-sky-100"
                >
                    <option value="">Semua Kabupaten</option>
                    @foreach($locations as $location)
                        <option value="{{ $location->id }}" @selected((int) $filters['lokasi_id'] === (int) $location->id)>
                            {{ $location->nama_kabupaten }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="sort" class="mb-2 block text-sm font-bold text-slate-700">Urutkan</label>
                <select
                    id="sort"
                    name="sort"
                    class="min-h-14 w-full rounded-2xl border border-slate-200 bg-slate-50/80 px-5 text-sm font-semibold text-slate-900 shadow-sm transition focus:border-sky-300 focus:bg-white focus:outline-none focus:ring-4 focus:ring-sky-100"
                >
                    @foreach($sortOptions as $sortValue => $sortLabel)
                        <option value="{{ $sortValue }}" @selected($filters['sort'] === $sortValue)>
                            {{ $sortLabel }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex flex-col gap-3 sm:flex-row xl:items-end">
                <button
                    type="submit"
                    class="inline-flex min-h-14 items-center justify-center rounded-full bg-sky-700 px-6 text-sm font-bold text-white shadow-[0_14px_34px_rgba(3,105,161,0.22)] transition hover:-translate-y-0.5 hover:bg-sky-800 focus:outline-none focus:ring-4 focus:ring-sky-100"
                >
                    Terapkan Filter
                </button>
                <a
                    href="{{ route('user.destinations') }}"
                    class="inline-flex min-h-14 items-center justify-center rounded-full border border-slate-200 bg-white px-6 text-sm font-bold text-slate-700 transition hover:bg-sky-50 hover:text-sky-800"
                >
                    Reset
                </a>
            </div>
        </form>
    </section>

    <section class="mt-6 flex flex-col gap-4 rounded-[1.75rem] border border-sky-100 bg-white/85 p-5 shadow-[0_16px_45px_rgba(15,23,42,0.06)] animate-fade-up animate-delay-200 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <p class="text-sm font-bold text-slate-900">
                @if($hasCatalogFilters)
                    {{ number_format($totalDestinations, 0, ',', '.') }} hasil ditemukan
                @else
                    {{ number_format($totalAvailableDestinations, 0, ',', '.') }} destinasi tersedia
                @endif
            </p>
            <p class="mt-1 text-sm leading-6 text-slate-600">
                @if(filled($filters['search']))
                    Hasil pencarian untuk: <span class="font-bold text-sky-800">"{{ $filters['search'] }}"</span>.
                @elseif($hasCatalogFilters)
                    Menampilkan hasil sesuai filter katalog.
                @else
                    Menampilkan katalog semua destinasi wisata Bali.
                @endif
            </p>
        </div>

        <div class="flex flex-wrap gap-2">
            <span class="rounded-full border border-sky-100 bg-sky-50 px-4 py-2 text-xs font-bold text-sky-700">
                Urutan: {{ $currentSortLabel }}
            </span>
        </div>
    </section>

    @if($destinations->isEmpty())
        <section class="mt-6 rounded-[2rem] border border-sky-100/80 bg-white/90 px-6 py-14 text-center shadow-[0_24px_70px_rgba(15,23,42,0.08)] animate-fade-up">
            <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-3xl bg-sky-50 text-sky-700">
                <svg class="h-8 w-8" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="m21 21-4.35-4.35" stroke="currentColor" stroke-width="1.9" stroke-linecap="round"/>
                    <path d="M11 18a7 7 0 1 0 0-14 7 7 0 0 0 0 14Z" stroke="currentColor" stroke-width="1.9"/>
                </svg>
            </div>
            <h2 class="mt-5 font-display text-3xl font-semibold text-slate-950">Destinasi tidak ditemukan</h2>
            <p class="mx-auto mt-3 max-w-xl text-sm leading-6 text-slate-600">
                Coba ubah kata kunci, kategori, atau lokasi pencarian Anda.
            </p>
            <a href="{{ route('user.destinations') }}" class="mt-6 inline-flex items-center justify-center rounded-full bg-sky-700 px-6 py-3 text-sm font-bold text-white shadow-[0_14px_34px_rgba(3,105,161,0.22)] transition hover:-translate-y-0.5 hover:bg-sky-800">
                Reset Filter
            </a>
        </section>
    @else
        <section class="mt-8 grid gap-5 md:grid-cols-2 xl:grid-cols-3">
            @foreach($destinations as $destination)
                @php
                    $imageUrl = $destinationImage($destination);
                    $location = optional($destination->lokasi)->nama_kabupaten ?? 'Bali';
                    $category = optional($destination->kategori)->nama_kategori ?? 'Destinasi';
                    $description = $destination->deskripsi ?? $destination->keterangan ?? 'Deskripsi destinasi belum tersedia.';
                    $price = $destination->harga_wni_min ?? $destination->harga_wna_min;
                    $detailLink = route('user.destinations.detail', array_merge(['id' => $destination->id], $detailContextQuery));
                @endphp

                <article class="group overflow-hidden rounded-[1.75rem] border border-sky-100/70 bg-white/90 shadow-[0_18px_50px_rgba(15,23,42,0.08)] transition hover:-translate-y-1 hover:shadow-[0_26px_70px_rgba(15,23,42,0.12)] animate-fade-up" style="animation-delay: {{ min($loop->index * 45, 270) }}ms">
                    <a href="{{ $detailLink }}" class="relative block aspect-[4/3] overflow-hidden bg-slate-200" aria-label="Lihat detail {{ $destination->nama }}">
                        <img src="{{ $imageUrl }}" alt="{{ $destination->nama }}" class="h-full w-full object-cover object-center transition duration-700 group-hover:scale-[1.04]">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/42 via-transparent to-transparent"></div>
                        <span class="absolute left-4 top-4 rounded-full border border-white/30 bg-white/85 px-3 py-1.5 text-xs font-bold text-sky-800 shadow-sm backdrop-blur">
                            {{ $category }}
                        </span>
                    </a>

                    <div class="flex min-h-[286px] flex-col p-5">
                        <div>
                            <h2 class="line-clamp-2 text-xl font-bold leading-snug text-slate-950 group-hover:text-sky-800">
                                {{ $destination->nama }}
                            </h2>
                            <p class="mt-2 inline-flex items-center gap-2 text-sm font-semibold text-slate-500">
                                <svg class="h-4 w-4 text-sky-700" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                    <path d="M12 21s7-6.08 7-12A7 7 0 1 0 5 9c0 5.92 7 12 7 12Z" stroke="currentColor" stroke-width="1.8"/>
                                    <path d="M12 11.5A2.5 2.5 0 1 0 12 6a2.5 2.5 0 0 0 0 5.5Z" stroke="currentColor" stroke-width="1.8"/>
                                </svg>
                                {{ $location }}, Bali
                            </p>
                            <p class="mt-4 line-clamp-3 text-sm leading-6 text-slate-600">
                                {{ \Illuminate\Support\Str::limit($description, 130) }}
                            </p>
                        </div>

                        <div class="mt-5 grid grid-cols-2 gap-3">
                            <div class="rounded-2xl bg-slate-50 p-3">
                                <span class="block text-[0.68rem] font-bold uppercase tracking-[0.16em] text-slate-400">Harga</span>
                                <strong class="mt-1 block text-sm font-bold text-slate-900">{{ $formatPrice($price) }}</strong>
                            </div>
                            <div class="rounded-2xl bg-slate-50 p-3">
                                <span class="block text-[0.68rem] font-bold uppercase tracking-[0.16em] text-slate-400">Rating</span>
                                <strong class="mt-1 inline-flex items-center gap-1 text-sm font-bold text-slate-900">
                                    <svg class="h-3.5 w-3.5 text-amber-500" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                        <path d="m12 3.7 2.27 4.6 5.08.74-3.67 3.58.87 5.06L12 15.29l-4.55 2.39.87-5.06-3.67-3.58 5.08-.74L12 3.7Z"/>
                                    </svg>
                                    {{ $destination->rating ? number_format($destination->rating, 1) : 'Belum ada' }}
                                </strong>
                            </div>
                        </div>

                        <div class="mt-auto grid gap-2">
                            <a href="{{ $detailLink }}" class="inline-flex w-full items-center justify-center rounded-full border border-sky-100 bg-sky-50 px-5 py-3 text-sm font-bold text-sky-800 transition hover:bg-sky-100 focus:outline-none focus:ring-4 focus:ring-sky-100">
                                Lihat Detail
                            </a>
                            <form method="POST" action="{{ route('destinations.want-to-go.toggle', ['destination' => $destination->id]) }}" data-want-to-go-form data-wisata-id="{{ $destination->id }}">
                                @csrf
                                @php $isWanted = $wantedWisataIds->contains((int) $destination->id); @endphp
                                <button type="submit" data-want-to-go-button data-is-wanted="{{ $isWanted ? 'true' : 'false' }}" class="want-to-go-button {{ $isWanted ? 'is-wanted' : '' }} inline-flex w-full items-center justify-center rounded-full border px-5 py-3 text-sm font-bold transition">
                                    {{ $isWanted ? 'Tersimpan' : 'Ingin Dikunjungi' }}
                                </button>
                            </form>
                        </div>
                    </div>
                </article>
            @endforeach
        </section>

        @if($destinationsPaginator && $destinationsPaginator->hasPages())
            <nav class="mt-8 flex flex-col items-center justify-between gap-4 rounded-[1.5rem] border border-sky-100 bg-white/85 px-4 py-4 shadow-[0_16px_45px_rgba(15,23,42,0.07)] animate-fade-up sm:flex-row" aria-label="Navigasi halaman destinasi">
                <p class="text-sm font-semibold text-slate-500">
                    Halaman {{ number_format($destinationsPaginator->currentPage(), 0, ',', '.') }} dari {{ number_format($destinationsPaginator->lastPage(), 0, ',', '.') }}
                </p>

                <div class="flex flex-wrap justify-center gap-2">
                    @if($destinationsPaginator->onFirstPage())
                        <span class="inline-flex cursor-not-allowed items-center rounded-full border border-slate-200 bg-slate-50 px-4 py-2 text-sm font-bold text-slate-300">Sebelumnya</span>
                    @else
                        <a href="{{ $destinationsPaginator->previousPageUrl() }}" class="inline-flex items-center rounded-full border border-slate-200 bg-white px-4 py-2 text-sm font-bold text-slate-600 transition hover:border-sky-100 hover:bg-sky-50 hover:text-sky-800">Sebelumnya</a>
                    @endif

                    @php $lastRenderedPage = 0; @endphp
                    @foreach(range(1, $destinationsPaginator->lastPage()) as $page)
                        @if($page === 1 || $page === $destinationsPaginator->lastPage() || abs($page - $destinationsPaginator->currentPage()) <= 1)
                            @if($lastRenderedPage && $page > $lastRenderedPage + 1)
                                <span class="inline-flex items-center px-2 py-2 text-sm font-bold text-slate-400">...</span>
                            @endif

                            @if($page === $destinationsPaginator->currentPage())
                                <span class="inline-flex h-10 min-w-10 items-center justify-center rounded-full bg-sky-700 px-3 text-sm font-bold text-white shadow-[0_10px_24px_rgba(3,105,161,0.20)]">{{ $page }}</span>
                            @else
                                <a href="{{ $destinationsPaginator->url($page) }}" class="inline-flex h-10 min-w-10 items-center justify-center rounded-full border border-slate-200 bg-white px-3 text-sm font-bold text-slate-600 transition hover:border-sky-100 hover:bg-sky-50 hover:text-sky-800">{{ $page }}</a>
                            @endif

                            @php $lastRenderedPage = $page; @endphp
                        @endif
                    @endforeach

                    @if($destinationsPaginator->hasMorePages())
                        <a href="{{ $destinationsPaginator->nextPageUrl() }}" class="inline-flex items-center rounded-full border border-slate-200 bg-white px-4 py-2 text-sm font-bold text-slate-600 transition hover:border-sky-100 hover:bg-sky-50 hover:text-sky-800">Berikutnya</a>
                    @else
                        <span class="inline-flex cursor-not-allowed items-center rounded-full border border-slate-200 bg-slate-50 px-4 py-2 text-sm font-bold text-slate-300">Berikutnya</span>
                    @endif
                </div>
            </nav>
        @endif
    @endif
</div>
@endsection
