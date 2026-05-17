@extends('layouts.app')

@section('title', ($destination->nama ?? 'Detail Destinasi') . ' - Detail')

@section('content')
@php
    $destinationImage = function ($item, $fallback = 'default bali.jpg') {
        $imagePath = trim((string) ($item->image ?? ''));
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

    $formatRange = function ($min, $max = null) {
        $minValue = is_numeric($min) ? (int) $min : null;
        $maxValue = is_numeric($max) ? (int) $max : null;

        if ((!$minValue || $minValue <= 0) && (!$maxValue || $maxValue <= 0)) {
            return 'Gratis';
        }

        if ($minValue && $maxValue && $maxValue > $minValue) {
            return 'Rp ' . number_format($minValue, 0, ',', '.') . ' - Rp ' . number_format($maxValue, 0, ',', '.');
        }

        return 'Rp ' . number_format($minValue ?: $maxValue, 0, ',', '.');
    };

    $imageUrl = $destinationImage($destination);
    $location = $destination->nama_kabupaten ?? 'Bali';
    $description = $destination->deskripsi ?? $destination->keterangan ?? 'Deskripsi destinasi belum tersedia.';
    $category = $destination->nama_kategori ?? 'Destinasi';
    $operatingHours = $destination->jam_operasional ?: 'Jam operasional belum tersedia';
    $rating = $destination->rating ? number_format($destination->rating, 1) : null;
    $mapsLink = $destination->link ?? null;
    $hasMapsLink = $mapsLink && $mapsLink !== '#';
    $priceWni = $formatRange($destination->harga_wni_min ?? null, $destination->harga_wni_max ?? null);
    $priceWna = $formatRange($destination->harga_wna_min ?? null, $destination->harga_wna_max ?? null);
@endphp

<div class="mx-auto max-w-[1180px] animate-page-in">
    <div class="mb-5 mt-2 flex flex-wrap items-center justify-between gap-3 animate-fade-up">
        <a href="{{ route('user.destinations') }}" class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white/85 px-4 py-2 text-sm font-bold text-slate-600 shadow-sm transition hover:border-sky-100 hover:bg-sky-50 hover:text-sky-800">
            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                <path d="M19 12H5m6 6-6-6 6-6" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            Kembali ke Destinasi
        </a>
        <span class="rounded-full border border-sky-100 bg-sky-50/80 px-4 py-2 text-xs font-bold uppercase tracking-[0.2em] text-sky-700">
            Detail Destinasi
        </span>
    </div>

    <section class="overflow-hidden rounded-[2.25rem] border border-sky-100/80 bg-white/90 shadow-[0_26px_80px_rgba(15,23,42,0.11)] backdrop-blur lg:grid lg:grid-cols-[minmax(0,1.1fr)_minmax(0,0.9fr)] animate-fade-up animate-delay-100">
        <div class="relative min-h-[360px] overflow-hidden bg-slate-200 lg:min-h-[600px]">
            <img src="{{ $imageUrl }}" alt="{{ $destination->nama }}" class="h-full w-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-t from-slate-950/45 via-slate-900/8 to-transparent"></div>
            <div class="absolute bottom-6 left-6 right-6 flex flex-wrap gap-2">
                <span class="rounded-full border border-white/30 bg-white/85 px-4 py-2 text-xs font-bold uppercase tracking-[0.16em] text-sky-800 shadow-sm backdrop-blur">{{ $category }}</span>
                <span class="rounded-full border border-white/25 bg-slate-950/25 px-4 py-2 text-xs font-bold uppercase tracking-[0.16em] text-white backdrop-blur">{{ $location }}</span>
            </div>
        </div>

        <div class="flex flex-col justify-between gap-8 p-6 sm:p-8 lg:p-10">
            <div>
                <div class="flex flex-wrap items-center gap-2">
                    <span class="rounded-full bg-sky-50 px-3 py-1.5 text-xs font-bold text-sky-700">Wisata Bali</span>
                    <span class="inline-flex items-center gap-1.5 rounded-full bg-amber-50 px-3 py-1.5 text-xs font-bold text-amber-700">
                        <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                            <path d="m12 3.7 2.27 4.6 5.08.74-3.67 3.58.87 5.06L12 15.29l-4.55 2.39.87-5.06-3.67-3.58 5.08-.74L12 3.7Z"/>
                        </svg>
                        Rating {{ $rating ?? 'Belum ada' }}
                    </span>
                </div>

                <h1 class="mt-5 font-display text-4xl font-semibold leading-[1.04] text-slate-950 sm:text-5xl">
                    {{ $destination->nama }}
                </h1>
                <p class="mt-4 inline-flex items-center gap-2 text-sm font-semibold text-slate-500">
                    <svg class="h-4 w-4 text-sky-700" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M12 21s7-6.08 7-12A7 7 0 1 0 5 9c0 5.92 7 12 7 12Z" stroke="currentColor" stroke-width="1.8"/>
                        <path d="M12 11.5A2.5 2.5 0 1 0 12 6a2.5 2.5 0 0 0 0 5.5Z" stroke="currentColor" stroke-width="1.8"/>
                    </svg>
                    {{ $location }}, Bali
                </p>

                <p class="mt-6 text-base leading-7 text-slate-600">
                    {{ \Illuminate\Support\Str::limit($description, 280) }}
                </p>
            </div>

            <div class="grid gap-3 sm:grid-cols-2">
                <div class="rounded-3xl border border-slate-200 bg-slate-50/80 p-4">
                    <span class="block text-xs font-bold uppercase tracking-[0.18em] text-slate-400">Harga WNI</span>
                    <strong class="mt-2 block text-lg font-bold text-slate-950">{{ $priceWni }}</strong>
                </div>
                <div class="rounded-3xl border border-slate-200 bg-slate-50/80 p-4">
                    <span class="block text-xs font-bold uppercase tracking-[0.18em] text-slate-400">Jam Buka</span>
                    <strong class="mt-2 block text-lg font-bold text-slate-950">{{ $operatingHours }}</strong>
                </div>
            </div>

            <div class="flex flex-col gap-3 sm:flex-row">
                @if($hasMapsLink)
                    <a href="{{ $mapsLink }}" target="_blank" rel="noopener noreferrer" class="inline-flex flex-1 items-center justify-center gap-2 rounded-full bg-sky-700 px-6 py-3.5 text-sm font-bold text-white shadow-[0_16px_38px_rgba(3,105,161,0.22)] transition hover:-translate-y-0.5 hover:bg-sky-800 focus:outline-none focus:ring-4 focus:ring-sky-100">
                        <svg class="h-4 w-4 shrink-0" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path d="M12 21s7-6.08 7-12A7 7 0 1 0 5 9c0 5.92 7 12 7 12Z" stroke="currentColor" stroke-width="1.8"/>
                            <path d="M12 11.5A2.5 2.5 0 1 0 12 6a2.5 2.5 0 0 0 0 5.5Z" stroke="currentColor" stroke-width="1.8"/>
                        </svg>
                        Buka di Google Maps
                    </a>
                @endif
                <a href="{{ route('user.home') }}" class="inline-flex flex-1 items-center justify-center rounded-full border border-slate-200 bg-white px-6 py-3.5 text-sm font-bold text-slate-700 transition hover:bg-sky-50 hover:text-sky-800">
                    Ubah Preferensi
                </a>
            </div>
        </div>
    </section>

    <section class="mt-7 grid gap-6 lg:grid-cols-[minmax(0,1fr)_360px]">
        <div class="space-y-6">
            <article class="rounded-[2rem] border border-sky-100/80 bg-white/90 p-6 shadow-[0_20px_60px_rgba(15,23,42,0.08)] animate-fade-up animate-delay-200 sm:p-8">
                <p class="text-xs font-bold uppercase tracking-[0.22em] text-sky-700">Deskripsi</p>
                <h2 class="mt-3 font-display text-3xl font-semibold text-slate-950">Tentang destinasi ini</h2>
                <p class="mt-4 text-base leading-8 text-slate-600">
                    {{ $description }}
                </p>
            </article>

            <article class="rounded-[2rem] border border-sky-100/80 bg-gradient-to-br from-sky-50/70 via-white to-amber-50/60 p-6 shadow-[0_20px_60px_rgba(15,23,42,0.07)] animate-fade-up animate-delay-300 sm:p-8">
                <div class="flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">
                    <div>
                        <p class="text-xs font-bold uppercase tracking-[0.22em] text-sky-700">Fasilitas</p>
                        <h2 class="mt-3 font-display text-3xl font-semibold text-slate-950">Fasilitas tersedia</h2>
                    </div>
                    <p class="max-w-sm text-sm leading-6 text-slate-500">Gunakan daftar ini untuk menyesuaikan kebutuhan perjalanan Anda.</p>
                </div>

                <div class="mt-6 flex flex-wrap gap-3">
                    @forelse($facilities as $facility)
                        <span class="inline-flex items-center rounded-full border border-sky-100 bg-white/85 px-4 py-2 text-sm font-semibold text-slate-700 shadow-sm">
                            {{ $facility }}
                        </span>
                    @empty
                        <p class="rounded-3xl border border-slate-200 bg-white/75 px-5 py-4 text-sm font-semibold text-slate-500">
                            Fasilitas belum tersedia.
                        </p>
                    @endforelse
                </div>
            </article>
        </div>

        <aside class="space-y-6">
            <article class="rounded-[2rem] border border-sky-100/80 bg-white/90 p-6 shadow-[0_20px_60px_rgba(15,23,42,0.08)] lg:sticky lg:top-24">
                <p class="text-xs font-bold uppercase tracking-[0.22em] text-sky-700">Ringkasan</p>
                <h2 class="mt-3 font-display text-2xl font-semibold text-slate-950">Informasi kunjungan</h2>

                <div class="mt-5 space-y-3">
                    <div class="rounded-3xl border border-slate-200 bg-slate-50/80 p-4">
                        <span class="block text-xs font-bold uppercase tracking-[0.18em] text-slate-400">Harga WNI</span>
                        <strong class="mt-2 block text-lg font-bold text-slate-950">{{ $priceWni }}</strong>
                    </div>
                    <div class="rounded-3xl border border-slate-200 bg-slate-50/80 p-4">
                        <span class="block text-xs font-bold uppercase tracking-[0.18em] text-slate-400">Harga WNA</span>
                        <strong class="mt-2 block text-lg font-bold text-slate-950">{{ $priceWna }}</strong>
                    </div>
                    <div class="rounded-3xl border border-slate-200 bg-slate-50/80 p-4">
                        <span class="block text-xs font-bold uppercase tracking-[0.18em] text-slate-400">Kategori</span>
                        <strong class="mt-2 block text-lg font-bold text-slate-950">{{ $category }}</strong>
                    </div>
                    <div class="rounded-3xl border border-slate-200 bg-slate-50/80 p-4">
                        <span class="block text-xs font-bold uppercase tracking-[0.18em] text-slate-400">Rating</span>
                        <strong class="mt-2 inline-flex items-center gap-1.5 text-lg font-bold text-slate-950">
                            <svg class="h-4 w-4 text-amber-500" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                <path d="m12 3.7 2.27 4.6 5.08.74-3.67 3.58.87 5.06L12 15.29l-4.55 2.39.87-5.06-3.67-3.58 5.08-.74L12 3.7Z"/>
                            </svg>
                            {{ $rating ?? 'Belum ada' }}
                        </strong>
                    </div>
                </div>
            </article>
        </aside>
    </section>

    @if($recommendations->isNotEmpty())
        <section class="mt-10 animate-fade-up animate-delay-300">
            <div class="mb-5 flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <p class="text-xs font-bold uppercase tracking-[0.22em] text-sky-700">Destinasi Serupa</p>
                    <h2 class="mt-2 font-display text-3xl font-semibold text-slate-950">Rekomendasi destinasi lainnya</h2>
                </div>
                <p class="max-w-md text-sm leading-6 text-slate-500">
                    Pilihan lain dengan kategori yang masih berdekatan dengan destinasi ini.
                </p>
            </div>

            <div class="grid gap-5 md:grid-cols-2 xl:grid-cols-3">
                @foreach($recommendations as $rec)
                    @php
                        $recImageUrl = $destinationImage($rec, 'default beach.jpeg');
                        $recFee = $rec->harga_wni_min ?? $rec->harga_wna_min;
                        $recLink = route('user.destinations.detail', $rec->id);
                    @endphp
                    <article class="group overflow-hidden rounded-[1.75rem] border border-sky-100/70 bg-white/90 shadow-[0_18px_50px_rgba(15,23,42,0.08)] transition hover:-translate-y-1 hover:shadow-[0_26px_70px_rgba(15,23,42,0.12)]">
                        <a href="{{ $recLink }}" class="relative block h-56 overflow-hidden bg-slate-200" aria-label="Lihat detail {{ $rec->nama }}">
                            <img src="{{ $recImageUrl }}" alt="{{ $rec->nama }}" class="h-full w-full object-cover transition duration-700 group-hover:scale-[1.04]">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-950/45 via-transparent to-transparent"></div>
                            <span class="absolute left-4 top-4 rounded-full border border-white/30 bg-white/85 px-3 py-1.5 text-xs font-bold text-sky-800 shadow-sm backdrop-blur">{{ $rec->nama_kategori ?? 'Destinasi' }}</span>
                        </a>

                        <div class="p-5">
                            <h3 class="line-clamp-2 text-xl font-bold leading-snug text-slate-950 group-hover:text-sky-800">{{ $rec->nama }}</h3>
                            <p class="mt-2 text-sm font-semibold text-slate-500">{{ $rec->nama_kabupaten ?? 'Bali' }}, Bali</p>
                            <div class="mt-5 flex items-center justify-between gap-3 rounded-2xl bg-slate-50 p-3">
                                <div>
                                    <span class="block text-[0.68rem] font-bold uppercase tracking-[0.16em] text-slate-400">Harga</span>
                                    <strong class="mt-1 block text-sm font-bold text-slate-900">{{ $formatRange($recFee, null) }}</strong>
                                </div>
                                <a href="{{ $recLink }}" class="rounded-full bg-sky-50 px-4 py-2 text-xs font-bold text-sky-800 transition hover:bg-sky-100">Lihat Detail</a>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        </section>
    @endif
</div>
@endsection
