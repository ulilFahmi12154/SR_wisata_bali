@extends('layouts.app')

@section('title', 'Daftar Destinasi Wisata')

@section('content')
@php
    $destinations = $destinations ?? collect();
    $destinationsPaginator = $destinationsPaginator ?? null;
    $totalDestinations = $totalDestinations ?? $destinations->count();

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
                    Jelajahi berbagai destinasi wisata di Bali tanpa filter personal. Gunakan halaman Home jika ingin mendapatkan hasil rekomendasi berdasarkan preferensi perjalanan Anda.
                </p>
            </div>

            <div class="flex flex-wrap gap-2 lg:justify-end">
                <span class="rounded-full border border-slate-200 bg-white/85 px-4 py-2 text-xs font-semibold text-slate-600 shadow-sm">
                    {{ number_format($totalDestinations, 0, ',', '.') }} destinasi
                </span>
                <a href="{{ route('user.home') }}" class="rounded-full border border-amber-100 bg-amber-50/80 px-4 py-2 text-xs font-bold text-amber-700 shadow-sm transition hover:bg-amber-100">
                    Cari Rekomendasi
                </a>
            </div>
        </div>
    </section>

    @if($destinations->isEmpty())
        <section class="mt-6 rounded-[2rem] border border-sky-100/80 bg-white/90 px-6 py-14 text-center shadow-[0_24px_70px_rgba(15,23,42,0.08)] animate-fade-up">
            <h2 class="font-display text-3xl font-semibold text-slate-950">Destinasi tidak ditemukan</h2>
            <p class="mx-auto mt-3 max-w-xl text-sm leading-6 text-slate-600">
                Data destinasi belum tersedia untuk ditampilkan saat ini.
            </p>
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
                    $detailLink = route('user.destinations.detail', ['id' => $destination->id]);
                @endphp

                <article class="group overflow-hidden rounded-[1.75rem] border border-sky-100/70 bg-white/90 shadow-[0_18px_50px_rgba(15,23,42,0.08)] transition hover:-translate-y-1 hover:shadow-[0_26px_70px_rgba(15,23,42,0.12)] animate-fade-up">
                    <a href="{{ $detailLink }}" class="relative block h-56 overflow-hidden bg-slate-200" aria-label="Lihat detail {{ $destination->nama }}">
                        <img src="{{ $imageUrl }}" alt="{{ $destination->nama }}" class="h-full w-full object-cover transition duration-700 group-hover:scale-[1.04]">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/42 via-transparent to-transparent"></div>
                        <span class="absolute left-4 top-4 rounded-full border border-white/30 bg-white/85 px-3 py-1.5 text-xs font-bold text-sky-800 shadow-sm backdrop-blur">
                            {{ $category }}
                        </span>
                    </a>

                    <div class="flex min-h-[270px] flex-col p-5">
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

                        <a href="{{ $detailLink }}" class="mt-auto inline-flex w-full items-center justify-center rounded-full border border-sky-100 bg-sky-50 px-5 py-3 text-sm font-bold text-sky-800 transition hover:bg-sky-100 focus:outline-none focus:ring-4 focus:ring-sky-100">
                            Lihat Detail
                        </a>
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
