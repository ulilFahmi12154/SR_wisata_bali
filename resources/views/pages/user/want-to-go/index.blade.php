@extends('layouts.app')

@section('title', 'Destinasi Ingin Dikunjungi')

@section('content')
@php
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
            : ['images/' . $normalized, 'images/destination/' . $normalized, $normalized];

        foreach ($candidates as $candidate) {
            if (file_exists(public_path($candidate))) {
                return asset($candidate);
            }
        }

        return asset($fallbackPath);
    };
@endphp

<div class="mx-auto max-w-[1180px] animate-page-in">
    @if(session('status'))
        <div class="mb-5 rounded-3xl border border-sky-100 bg-sky-50 px-5 py-4 text-sm font-semibold text-sky-800">
            {{ session('status') }}
        </div>
    @endif

    <section class="mt-4 overflow-hidden rounded-[2.25rem] border border-sky-100/80 bg-gradient-to-br from-white via-sky-50 to-amber-50/60 p-6 shadow-[0_26px_80px_rgba(15,23,42,0.08)] sm:p-8 lg:p-10 animate-fade-up">
        <p class="inline-flex rounded-full border border-sky-100 bg-sky-50/80 px-4 py-2 text-xs font-bold uppercase tracking-[0.22em] text-sky-700">
            Want to Go
        </p>
        <h1 class="mt-5 max-w-3xl font-display text-4xl font-semibold leading-[1.04] text-slate-950 sm:text-5xl lg:text-6xl">
            Destinasi Ingin Dikunjungi
        </h1>
        <p class="mt-5 max-w-2xl text-base leading-7 text-slate-600 sm:text-lg">
            Kumpulan destinasi yang Anda simpan. Daftar ini juga membantu sistem menyesuaikan rekomendasi berikutnya.
        </p>
    </section>

    @if($wantToGos->isEmpty())
        <section class="mt-6 rounded-[2rem] border border-sky-100/80 bg-white/90 px-6 py-14 text-center shadow-[0_24px_70px_rgba(15,23,42,0.08)] animate-fade-up">
            <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-3xl bg-sky-50 text-sky-700">
                <svg class="h-8 w-8" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="M12 21s-7-4.9-7-11a4 4 0 0 1 7-2.65A4 4 0 0 1 19 10c0 6.1-7 11-7 11Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <h2 class="mt-5 font-display text-3xl font-semibold text-slate-950">Kamu belum menambahkan destinasi ke Want to Go.</h2>
            <p class="mx-auto mt-3 max-w-xl text-sm leading-6 text-slate-600">
                Tandai destinasi yang kamu minati agar rekomendasi berikutnya semakin sesuai.
            </p>
            <a href="{{ route('user.destinations') }}" class="mt-6 inline-flex items-center justify-center rounded-full bg-sky-700 px-6 py-3 text-sm font-bold text-white shadow-[0_14px_34px_rgba(3,105,161,0.22)] transition hover:-translate-y-0.5 hover:bg-sky-800">
                Jelajahi Destinasi
            </a>
        </section>
    @else
        <section class="mt-8 grid gap-5 md:grid-cols-2 xl:grid-cols-3">
            @foreach($wantToGos as $wantToGo)
                @php
                    $destination = $wantToGo->wisata;
                    $imageUrl = $destinationImage($destination);
                    $location = optional($destination->lokasi)->nama_kabupaten ?? 'Bali';
                    $category = optional($destination->kategori)->nama_kategori ?? 'Destinasi';
                    $description = $destination->deskripsi ?? $destination->keterangan ?? 'Deskripsi destinasi belum tersedia.';
                    $price = $destination->harga_wni_min ?? $destination->harga_wna_min;
                    $detailLink = route('user.destinations.detail', ['id' => $destination->id, 'from' => 'want-to-go']);
                @endphp

                <article class="group overflow-hidden rounded-[1.75rem] border border-sky-100/70 bg-white/90 shadow-[0_18px_50px_rgba(15,23,42,0.08)] transition hover:-translate-y-1 hover:shadow-[0_26px_70px_rgba(15,23,42,0.12)] animate-fade-up">
                    <a href="{{ $detailLink }}" class="relative block aspect-[4/3] overflow-hidden bg-slate-200" aria-label="Lihat detail {{ $destination->nama }}">
                        <img src="{{ $imageUrl }}" alt="{{ $destination->nama }}" class="h-full w-full object-cover object-center transition duration-700 group-hover:scale-[1.04]">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/42 via-transparent to-transparent"></div>
                        <span class="absolute left-4 top-4 rounded-full border border-white/30 bg-white/85 px-3 py-1.5 text-xs font-bold text-sky-800 shadow-sm backdrop-blur">
                            {{ $category }}
                        </span>
                    </a>

                    <div class="flex min-h-[304px] flex-col p-5">
                        <div>
                            <h2 class="line-clamp-2 text-xl font-bold leading-snug text-slate-950 group-hover:text-sky-800">
                                {{ $destination->nama }}
                            </h2>
                            <p class="mt-2 text-sm font-semibold text-slate-500">{{ $location }}, Bali</p>
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
                                <strong class="mt-1 block text-sm font-bold text-slate-900">{{ $destination->rating ? number_format($destination->rating, 1) : 'Belum ada' }}</strong>
                            </div>
                        </div>

                        <div class="mt-auto grid gap-2 pt-5">
                            <a href="{{ $detailLink }}" class="inline-flex w-full items-center justify-center rounded-full border border-sky-100 bg-sky-50 px-5 py-3 text-sm font-bold text-sky-800 transition hover:bg-sky-100">
                                Lihat Detail
                            </a>
                            <form method="POST" action="{{ route('destinations.want-to-go.toggle', ['destination' => $destination->id]) }}">
                                @csrf
                                <button type="submit" class="inline-flex w-full items-center justify-center rounded-full border border-amber-100 bg-amber-50 px-5 py-3 text-sm font-bold text-amber-700 transition hover:bg-amber-100">
                                    Hapus dari Daftar
                                </button>
                            </form>
                        </div>
                    </div>
                </article>
            @endforeach
        </section>

        @if($wantToGos->hasPages())
            <nav class="mt-8 rounded-[1.5rem] border border-sky-100 bg-white/85 px-4 py-4 shadow-[0_16px_45px_rgba(15,23,42,0.07)] animate-fade-up">
                {{ $wantToGos->links() }}
            </nav>
        @endif
    @endif
</div>
@endsection
