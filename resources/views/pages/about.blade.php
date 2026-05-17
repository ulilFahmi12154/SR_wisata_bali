@extends('layouts.app')

@section('title', 'Tentang Jelajah Bali')

@section('content')
<div class="mx-auto max-w-[1180px] animate-page-in">
    <section class="mt-4 overflow-hidden rounded-[2.25rem] border border-sky-100/80 bg-gradient-to-br from-white via-sky-50 to-amber-50/60 p-6 shadow-[0_26px_80px_rgba(15,23,42,0.08)] sm:p-8 lg:p-10 animate-fade-up">
        <div class="grid gap-8 lg:grid-cols-[minmax(0,1.25fr)_minmax(280px,0.75fr)] lg:items-center">
            <div>
                <p class="inline-flex rounded-full border border-sky-100 bg-sky-50/80 px-4 py-2 text-xs font-bold uppercase tracking-[0.22em] text-sky-700">
                    Tentang Sistem
                </p>
                <h1 class="mt-5 max-w-3xl font-display text-4xl font-semibold leading-[1.04] text-slate-950 sm:text-5xl lg:text-6xl">
                    Tentang Jelajah Bali
                </h1>
                <p class="mt-5 max-w-2xl text-base leading-8 text-slate-600 sm:text-lg">
                    Jelajah Bali adalah sistem rekomendasi wisata berbasis web yang membantu pengguna menemukan destinasi wisata di Bali sesuai preferensi perjalanan, mulai dari kategori, lokasi, biaya, fasilitas, hingga rating.
                </p>
            </div>

            <div class="rounded-[2rem] border border-white/70 bg-white/75 p-5 shadow-[0_18px_55px_rgba(15,23,42,0.08)] backdrop-blur">
                <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-sky-700 text-white shadow-[0_14px_34px_rgba(3,105,161,0.22)]">
                    <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M12 21s7-6.08 7-12A7 7 0 1 0 5 9c0 5.92 7 12 7 12Z" stroke="currentColor" stroke-width="1.8"/>
                        <path d="M12 11.5A2.5 2.5 0 1 0 12 6a2.5 2.5 0 0 0 0 5.5Z" stroke="currentColor" stroke-width="1.8"/>
                    </svg>
                </div>
                <h2 class="mt-5 text-xl font-bold text-slate-950">Sistem Pendukung Keputusan Wisata</h2>
                <p class="mt-3 text-sm leading-6 text-slate-600">
                    Rekomendasi bersifat bantuan pengambilan keputusan. Pengguna tetap dapat mempertimbangkan rencana, suasana, dan preferensi pribadi sebelum berkunjung.
                </p>
            </div>
        </div>
    </section>

    <section class="mt-7 grid gap-5 md:grid-cols-2">
        <article class="rounded-[2rem] border border-sky-100/80 bg-white/90 p-6 shadow-[0_20px_60px_rgba(15,23,42,0.07)] animate-fade-up animate-delay-100">
            <div class="mb-5 flex h-12 w-12 items-center justify-center rounded-2xl bg-sky-50 text-sky-700">
                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="M5 12.5 10 17 19 7" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <h2 class="font-display text-2xl font-semibold text-slate-950">Tujuan Sistem</h2>
            <p class="mt-3 text-sm leading-7 text-slate-600">
                Sistem ini dibuat untuk membantu pengguna memilih destinasi wisata, mengurangi kebingungan saat mencari tempat wisata, dan menyajikan rekomendasi yang lebih relevan berdasarkan kriteria yang tersedia.
            </p>
        </article>

        <article class="rounded-[2rem] border border-sky-100/80 bg-white/90 p-6 shadow-[0_20px_60px_rgba(15,23,42,0.07)] animate-fade-up animate-delay-100">
            <div class="mb-5 flex h-12 w-12 items-center justify-center rounded-2xl bg-amber-50 text-amber-700">
                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="M4 17.5 9 12l4 3 7-8.5" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M4 20h16" stroke="currentColor" stroke-width="1.9" stroke-linecap="round"/>
                </svg>
            </div>
            <h2 class="font-display text-2xl font-semibold text-slate-950">Metode SAW</h2>
            <p class="mt-3 text-sm leading-7 text-slate-600">
                Sistem ini menggunakan metode Simple Additive Weighting (SAW) untuk membantu mengurutkan destinasi berdasarkan beberapa kriteria. Setiap destinasi dinilai berdasarkan kriteria yang relevan, lalu sistem menghasilkan urutan rekomendasi yang paling sesuai.
            </p>
        </article>

        <article class="rounded-[2rem] border border-sky-100/80 bg-white/90 p-6 shadow-[0_20px_60px_rgba(15,23,42,0.07)] animate-fade-up animate-delay-200">
            <div class="mb-5 flex h-12 w-12 items-center justify-center rounded-2xl bg-sky-50 text-sky-700">
                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="M5 6h14M5 12h14M5 18h9" stroke="currentColor" stroke-width="1.9" stroke-linecap="round"/>
                </svg>
            </div>
            <h2 class="font-display text-2xl font-semibold text-slate-950">Fitur Utama</h2>
            <ul class="mt-4 space-y-3 text-sm leading-6 text-slate-600">
                <li class="rounded-2xl bg-slate-50 px-4 py-3">Pencarian dan filter destinasi wisata.</li>
                <li class="rounded-2xl bg-slate-50 px-4 py-3">Rekomendasi berdasarkan preferensi pengguna.</li>
                <li class="rounded-2xl bg-slate-50 px-4 py-3">Daftar destinasi populer dan detail informasi destinasi.</li>
                <li class="rounded-2xl bg-slate-50 px-4 py-3">Profil pengguna sederhana.</li>
            </ul>
        </article>

        <article class="rounded-[2rem] border border-sky-100/80 bg-white/90 p-6 shadow-[0_20px_60px_rgba(15,23,42,0.07)] animate-fade-up animate-delay-200">
            <div class="mb-5 flex h-12 w-12 items-center justify-center rounded-2xl bg-amber-50 text-amber-700">
                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="M6 4h12a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1Z" stroke="currentColor" stroke-width="1.8"/>
                    <path d="M8.5 8h7M8.5 12h7M8.5 16h4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                </svg>
            </div>
            <h2 class="font-display text-2xl font-semibold text-slate-950">Data Destinasi</h2>
            <p class="mt-3 text-sm leading-7 text-slate-600">
                Data destinasi mencakup informasi seperti nama destinasi, lokasi atau kabupaten, kategori, harga, fasilitas, rating, tautan peta, dan deskripsi jika tersedia. Informasi ini membantu sistem menyusun rekomendasi yang lebih mudah dipahami pengguna.
            </p>
        </article>
    </section>

    <section class="mt-8 rounded-[2rem] border border-sky-100 bg-gradient-to-br from-sky-50 via-white to-amber-50/70 p-6 text-center shadow-[0_22px_64px_rgba(15,23,42,0.08)] sm:p-8 animate-fade-up animate-delay-300">
        <h2 class="font-display text-3xl font-semibold text-slate-950">Siap menemukan destinasi yang cocok?</h2>
        <p class="mx-auto mt-3 max-w-2xl text-sm leading-6 text-slate-600">
            Mulai dari preferensi perjalanan Anda, lalu biarkan sistem membantu menyusun rekomendasi destinasi Bali yang paling relevan.
        </p>

        <div class="mt-6 flex flex-col items-center justify-center gap-3 sm:flex-row">
            @auth
                <a href="{{ route('user.home') }}" class="inline-flex w-full items-center justify-center rounded-full bg-sky-700 px-6 py-3 text-sm font-bold text-white shadow-[0_14px_34px_rgba(3,105,161,0.22)] transition hover:-translate-y-0.5 hover:bg-sky-800 sm:w-auto">
                    Mulai Cari Rekomendasi
                </a>
                <a href="{{ route('user.destinations') }}" class="inline-flex w-full items-center justify-center rounded-full border border-slate-200 bg-white/80 px-6 py-3 text-sm font-bold text-slate-700 transition hover:bg-white sm:w-auto">
                    Lihat Destinasi
                </a>
            @else
                <a href="{{ route('user.register') }}" class="inline-flex w-full items-center justify-center rounded-full bg-sky-700 px-6 py-3 text-sm font-bold text-white shadow-[0_14px_34px_rgba(3,105,161,0.22)] transition hover:-translate-y-0.5 hover:bg-sky-800 sm:w-auto">
                    Mulai Cari Wisata
                </a>
                <a href="{{ route('user.login') }}" class="inline-flex w-full items-center justify-center rounded-full border border-slate-200 bg-white/80 px-6 py-3 text-sm font-bold text-slate-700 transition hover:bg-white sm:w-auto">
                    Masuk
                </a>
            @endauth
        </div>
    </section>
</div>
@endsection
