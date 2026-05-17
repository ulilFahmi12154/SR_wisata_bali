@extends('layouts.app')

@section('title', 'Rekomendasi Destinasi')

@section('content')
@php
    $destinations = $destinations ?? collect();
    $topDestination = $destinations->first();
    $otherDestinations = $destinations->skip(1);
    $maxScore = $destinations->max('skor_akhir') ?: 0;

    $formatPrice = function ($amount) {
        $value = is_numeric($amount) ? (int) $amount : null;

        return $value && $value > 0
            ? 'Rp ' . number_format($value, 0, ',', '.')
            : 'Gratis';
    };

    $formatScore = fn ($score) => number_format((float) ($score ?? 0), 3);

    $destinationImage = function ($destination, $fallback = 'default bali.jpg') {
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
    @if($destinations->isEmpty())
        <section class="mt-6 overflow-hidden rounded-[2rem] border border-sky-100/80 bg-gradient-to-br from-white via-sky-50 to-amber-50/50 px-6 py-14 text-center shadow-[0_24px_70px_rgba(15,23,42,0.08)] animate-fade-up sm:px-10">
            <div class="mx-auto mb-6 flex h-16 w-16 items-center justify-center rounded-full border border-sky-100 bg-white/80 text-sky-700 shadow-sm">
                <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="M11 19a8 8 0 1 1 5.66-2.34L21 21l-1.5 1.5-4.34-4.34A7.96 7.96 0 0 1 11 19Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M8.4 11h5.2" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                </svg>
            </div>
            <p class="text-xs font-bold uppercase tracking-[0.28em] text-sky-700">Hasil Rekomendasi</p>
            <h1 class="mt-3 font-display text-3xl font-semibold leading-tight text-slate-950 sm:text-4xl">
                Destinasi tidak ditemukan
            </h1>
            <p class="mx-auto mt-4 max-w-xl text-base leading-7 text-slate-600">
                Coba ubah kata kunci, kabupaten, estimasi biaya, atau fasilitas yang Anda pilih agar kami bisa menemukan rekomendasi yang lebih sesuai.
            </p>
            <a href="{{ route('user.home') }}" class="mt-8 inline-flex items-center justify-center rounded-full bg-sky-700 px-6 py-3 text-sm font-bold text-white shadow-[0_14px_34px_rgba(3,105,161,0.22)] transition hover:-translate-y-0.5 hover:bg-sky-800 focus:outline-none focus:ring-4 focus:ring-sky-100">
                Atur Ulang Filter
            </a>
        </section>
    @else
        <section class="mt-4 grid gap-6 lg:grid-cols-[minmax(0,1fr)_auto] lg:items-end animate-fade-up">
            <div>
                <p class="inline-flex rounded-full border border-sky-100 bg-sky-50/80 px-4 py-2 text-xs font-bold uppercase tracking-[0.22em] text-sky-700">
                    Rekomendasi Wisata Bali
                </p>
                <h1 class="mt-5 max-w-3xl font-display text-4xl font-semibold leading-[1.04] text-slate-950 sm:text-5xl lg:text-6xl">
                    Hasil terbaik untuk perjalanan Anda.
                </h1>
                <p class="mt-5 max-w-2xl text-base leading-7 text-slate-600 sm:text-lg">
                    Destinasi diurutkan berdasarkan kecocokan preferensi, biaya, rating, dan fasilitas yang Anda pilih pada filter rekomendasi.
                </p>
            </div>

            <div class="flex flex-wrap gap-2 lg:justify-end">
                <span class="rounded-full border border-slate-200 bg-white/85 px-4 py-2 text-xs font-semibold text-slate-600 shadow-sm">Metode SAW</span>
                <span class="rounded-full border border-slate-200 bg-white/85 px-4 py-2 text-xs font-semibold text-slate-600 shadow-sm">{{ $destinations->count() }} hasil</span>
                <span class="rounded-full border border-amber-100 bg-amber-50/80 px-4 py-2 text-xs font-semibold text-amber-700 shadow-sm">Data sesuai filter</span>
            </div>
        </section>

        <section class="mt-8 grid gap-6 xl:grid-cols-[minmax(0,1.72fr)_minmax(300px,0.86fr)]">
            @if($topDestination)
                @php
                    $topImageUrl = $destinationImage($topDestination);
                    $topLocation = optional($topDestination->lokasi)->nama_kabupaten ?? 'Bali';
                    $topCategory = optional($topDestination->kategori)->nama_kategori ?? 'Destinasi';
                    $topDescription = $topDestination->deskripsi ?? $topDestination->keterangan ?? '';
                    $topEntryFee = $topDestination->harga_wni_min ?? $topDestination->harga_wna_min;
                    $topLink = route('user.destinations.detail', ['id' => $topDestination->id]);
                @endphp

                <article class="overflow-hidden rounded-[2rem] border border-sky-100/80 bg-white/90 shadow-[0_24px_70px_rgba(15,23,42,0.10)] backdrop-blur transition hover:-translate-y-1 hover:shadow-[0_30px_80px_rgba(15,23,42,0.13)] lg:grid lg:grid-cols-[minmax(0,1.08fr)_minmax(0,0.92fr)] animate-fade-up animate-delay-100">
                    <a href="{{ $topLink }}" class="group relative block min-h-[320px] overflow-hidden bg-slate-200 lg:min-h-[520px]" aria-label="Lihat detail {{ $topDestination->nama }}">
                        <img src="{{ $topImageUrl }}" alt="{{ $topDestination->nama }}" class="h-full w-full object-cover transition duration-700 group-hover:scale-[1.035]">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/50 via-slate-900/8 to-transparent"></div>
                        <div class="absolute left-5 top-5 flex flex-wrap gap-2">
                            <span class="rounded-full border border-white/30 bg-white/80 px-4 py-2 text-xs font-bold uppercase tracking-[0.16em] text-sky-800 shadow-sm backdrop-blur">
                                Rekomendasi Utama
                            </span>
                            <span class="rounded-full border border-white/30 bg-slate-950/25 px-4 py-2 text-xs font-bold uppercase tracking-[0.16em] text-white shadow-sm backdrop-blur">
                                {{ $topCategory }}
                            </span>
                        </div>
                    </a>

                    <div class="flex flex-col gap-6 p-6 sm:p-8">
                        <div>
                            <div class="flex flex-wrap items-center gap-2">
                                <span class="rounded-full bg-sky-50 px-3 py-1.5 text-xs font-bold text-sky-700">Skor {{ $formatScore($topDestination->skor_akhir ?? 0) }}</span>
                                <span class="rounded-full bg-amber-50 px-3 py-1.5 text-xs font-bold text-amber-700">Peringkat #1</span>
                            </div>
                            <h2 class="mt-4 font-display text-3xl font-semibold leading-tight text-slate-950 sm:text-4xl">
                                {{ $topDestination->nama }}
                            </h2>
                            <p class="mt-3 inline-flex items-center gap-2 text-sm font-semibold text-slate-500">
                                <svg class="h-4 w-4 text-sky-700" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                    <path d="M12 21s7-6.08 7-12A7 7 0 1 0 5 9c0 5.92 7 12 7 12Z" stroke="currentColor" stroke-width="1.8"/>
                                    <path d="M12 11.5A2.5 2.5 0 1 0 12 6a2.5 2.5 0 0 0 0 5.5Z" stroke="currentColor" stroke-width="1.8"/>
                                </svg>
                                {{ $topLocation }}, Bali
                            </p>
                            <p class="mt-5 text-base leading-7 text-slate-600">
                                {{ \Illuminate\Support\Str::limit($topDescription, 190) }}
                            </p>
                        </div>

                        <div class="grid gap-3 sm:grid-cols-2">
                            <div class="rounded-3xl border border-slate-200 bg-slate-50/80 p-4">
                                <span class="text-xs font-bold uppercase tracking-[0.18em] text-slate-400">Harga</span>
                                <strong class="mt-2 block text-lg font-bold text-slate-950">{{ $formatPrice($topEntryFee) }}</strong>
                            </div>
                            <div class="rounded-3xl border border-slate-200 bg-slate-50/80 p-4">
                                <span class="text-xs font-bold uppercase tracking-[0.18em] text-slate-400">Rating</span>
                                <strong class="mt-2 inline-flex items-center gap-1.5 text-lg font-bold text-slate-950">
                                    <svg class="h-4 w-4 text-amber-500" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                        <path d="m12 3.7 2.27 4.6 5.08.74-3.67 3.58.87 5.06L12 15.29l-4.55 2.39.87-5.06-3.67-3.58 5.08-.74L12 3.7Z"/>
                                    </svg>
                                    {{ $topDestination->rating ? number_format($topDestination->rating, 1) : 'Belum ada' }}
                                </strong>
                            </div>
                        </div>

                        <a href="{{ $topLink }}" class="mt-auto inline-flex w-full items-center justify-center gap-2 rounded-full bg-sky-700 px-6 py-3.5 text-sm font-bold text-white shadow-[0_16px_38px_rgba(3,105,161,0.22)] transition hover:-translate-y-0.5 hover:bg-sky-800 focus:outline-none focus:ring-4 focus:ring-sky-100">
                            Lihat Detail Destinasi
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                <path d="M5 12h14m-6-6 6 6-6 6" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                    </div>
                </article>
            @endif

            <aside class="space-y-4 animate-fade-up animate-delay-200">
                <section class="rounded-[2rem] border border-sky-100/80 bg-white/90 p-5 shadow-[0_20px_60px_rgba(15,23,42,0.08)]">
                    <div class="mb-4 flex items-center justify-between gap-4">
                        <h2 class="text-lg font-bold text-slate-950">Peringkat Teratas</h2>
                        <span class="rounded-full bg-sky-50 px-3 py-1 text-xs font-bold text-sky-700">Skor</span>
                    </div>

                    <div class="space-y-3">
                        @foreach($destinations->take(5) as $ranked)
                            @php
                                $score = $ranked->skor_akhir ?? 0;
                                $scorePercent = $maxScore > 0 ? min(100, max(0, ($score / $maxScore) * 100)) : 0;
                                $rankLink = route('user.destinations.detail', ['id' => $ranked->id]);
                            @endphp
                            <a href="{{ $rankLink }}" class="group block rounded-3xl border border-slate-100 bg-slate-50/70 p-4 transition hover:-translate-y-0.5 hover:border-sky-100 hover:bg-sky-50/70">
                                <div class="flex items-start justify-between gap-3">
                                    <div class="min-w-0">
                                        <span class="text-xs font-bold text-sky-700">#{{ sprintf('%02d', $loop->iteration) }}</span>
                                        <h3 class="mt-1 line-clamp-2 text-sm font-bold leading-snug text-slate-900 group-hover:text-sky-800">{{ $ranked->nama }}</h3>
                                    </div>
                                    <span class="shrink-0 rounded-full bg-white px-3 py-1 text-xs font-bold text-slate-700 shadow-sm">{{ $formatScore($score) }}</span>
                                </div>
                                <div class="mt-3 h-2 overflow-hidden rounded-full bg-slate-200/80">
                                    <span class="block h-full rounded-full bg-gradient-to-r from-sky-600 to-cyan-600" style="width: {{ $scorePercent }}%;"></span>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </section>

                <section class="rounded-[2rem] border border-amber-100 bg-gradient-to-br from-amber-50/90 via-white to-sky-50/80 p-5 shadow-[0_18px_54px_rgba(15,23,42,0.07)]">
                    <p class="text-xs font-bold uppercase tracking-[0.22em] text-amber-700">Catatan Rekomendasi</p>
                    <p class="mt-3 text-sm leading-6 text-slate-600">
                        Skor tertinggi menunjukkan destinasi yang paling mendekati preferensi Anda. Gunakan detail destinasi untuk melihat harga, fasilitas, dan lokasi sebelum berkunjung.
                    </p>
                </section>
            </aside>
        </section>

        @if($otherDestinations->isNotEmpty())
            <section id="pilihan-lain" class="mt-9 animate-fade-up animate-delay-300">
                <div class="mb-5 flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">
                    <div>
                        <p class="text-xs font-bold uppercase tracking-[0.22em] text-sky-700">Pilihan Lainnya</p>
                        <h2 class="mt-2 font-display text-3xl font-semibold text-slate-950">Destinasi sesuai preferensi</h2>
                    </div>
                    <p class="max-w-md text-sm leading-6 text-slate-500">
                        Bandingkan harga, rating, dan skor sebelum menentukan tempat yang paling cocok.
                    </p>
                </div>

                <div class="grid gap-5 md:grid-cols-2 xl:grid-cols-3">
                    @foreach($otherDestinations as $destination)
                        @php
                            $rankNumber = $loop->iteration + 1;
                            $imageUrl = $destinationImage($destination, 'default beach.jpeg');
                            $location = optional($destination->lokasi)->nama_kabupaten ?? 'Bali';
                            $category = optional($destination->kategori)->nama_kategori ?? 'Destinasi';
                            $price = $destination->harga_wni_min ?? $destination->harga_wna_min;
                            $detailLink = route('user.destinations.detail', ['id' => $destination->id]);
                        @endphp
                        <article class="group overflow-hidden rounded-[1.75rem] border border-sky-100/70 bg-white/90 shadow-[0_18px_50px_rgba(15,23,42,0.08)] transition hover:-translate-y-1 hover:shadow-[0_26px_70px_rgba(15,23,42,0.12)]">
                            <a href="{{ $detailLink }}" class="relative block h-56 overflow-hidden bg-slate-200" aria-label="Lihat detail {{ $destination->nama }}">
                                <img src="{{ $imageUrl }}" alt="{{ $destination->nama }}" class="h-full w-full object-cover transition duration-700 group-hover:scale-[1.04]">
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/40 via-transparent to-transparent"></div>
                                <span class="absolute left-4 top-4 rounded-full border border-white/30 bg-white/85 px-3 py-1.5 text-xs font-bold text-sky-800 shadow-sm backdrop-blur">Peringkat #{{ $rankNumber }}</span>
                                <span class="absolute bottom-4 left-4 rounded-full border border-white/30 bg-slate-950/25 px-3 py-1.5 text-xs font-bold text-white backdrop-blur">{{ $category }}</span>
                            </a>

                            <div class="p-5">
                                <div class="flex items-start justify-between gap-3">
                                    <div class="min-w-0">
                                        <h3 class="line-clamp-2 text-xl font-bold leading-snug text-slate-950 group-hover:text-sky-800">{{ $destination->nama }}</h3>
                                        <p class="mt-2 text-sm font-semibold text-slate-500">{{ $location }}, Bali</p>
                                    </div>
                                    <span class="shrink-0 rounded-full bg-sky-50 px-3 py-1.5 text-xs font-bold text-sky-700">Skor {{ $formatScore($destination->skor_akhir ?? 0) }}</span>
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

                                <a href="{{ $detailLink }}" class="mt-5 inline-flex w-full items-center justify-center rounded-full border border-sky-100 bg-sky-50 px-5 py-3 text-sm font-bold text-sky-800 transition hover:bg-sky-100 focus:outline-none focus:ring-4 focus:ring-sky-100">
                                    Lihat Detail
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>
            </section>
        @endif

        <section class="mt-10 rounded-[2rem] border border-sky-100 bg-gradient-to-br from-sky-50 via-white to-amber-50/70 p-6 text-center shadow-[0_22px_64px_rgba(15,23,42,0.08)] sm:p-8">
            <h2 class="font-display text-3xl font-semibold text-slate-950">Ingin menyesuaikan hasil?</h2>
            <p class="mx-auto mt-3 max-w-2xl text-sm leading-6 text-slate-600">
                Kembali ke filter untuk mengatur kabupaten, minat wisata, estimasi biaya, dan fasilitas sesuai rencana perjalanan Anda.
            </p>
            <div class="mt-6 flex flex-col items-center justify-center gap-3 sm:flex-row">
                <a href="{{ route('user.home') }}" class="inline-flex w-full items-center justify-center rounded-full bg-sky-700 px-6 py-3 text-sm font-bold text-white shadow-[0_14px_34px_rgba(3,105,161,0.22)] transition hover:-translate-y-0.5 hover:bg-sky-800 sm:w-auto">
                    Ubah Filter
                </a>
                @if($otherDestinations->isNotEmpty())
                    <a href="#pilihan-lain" class="inline-flex w-full items-center justify-center rounded-full border border-slate-200 bg-white/80 px-6 py-3 text-sm font-bold text-slate-700 transition hover:bg-white sm:w-auto">
                        Lihat Pilihan Lain
                    </a>
                @endif
            </div>
        </section>
    @endif
</div>
@endsection
