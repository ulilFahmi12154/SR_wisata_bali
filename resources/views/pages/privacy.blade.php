@extends('layouts.app')

@section('title', 'Kebijakan Privasi Jelajah Bali')

@section('content')
<div class="mx-auto max-w-[1180px] animate-page-in">
    <section class="mt-4 overflow-hidden rounded-[2.25rem] border border-sky-100/80 bg-gradient-to-br from-white via-sky-50 to-amber-50/60 p-6 shadow-[0_26px_80px_rgba(15,23,42,0.08)] sm:p-8 lg:p-10 animate-fade-up">
        <div class="max-w-3xl">
            <p class="inline-flex rounded-full border border-sky-100 bg-sky-50/80 px-4 py-2 text-xs font-bold uppercase tracking-[0.22em] text-sky-700">
                Kebijakan Privasi
            </p>
            <h1 class="mt-5 font-display text-4xl font-semibold leading-[1.05] text-slate-950 sm:text-5xl lg:text-6xl">
                Kebijakan Privasi Jelajah Bali
            </h1>
            <p class="mt-5 text-base leading-8 text-slate-600 sm:text-lg">
                Halaman ini menjelaskan bagaimana data pengguna digunakan di Jelajah Bali, sistem rekomendasi wisata yang membantu Anda menemukan destinasi di Bali berdasarkan preferensi perjalanan.
            </p>
        </div>
    </section>

    <section class="mt-7 grid gap-5 md:grid-cols-2">
        <article class="rounded-[2rem] border border-sky-100/80 bg-white/90 p-6 shadow-[0_20px_60px_rgba(15,23,42,0.07)] animate-fade-up animate-delay-100">
            <div class="mb-5 flex h-12 w-12 items-center justify-center rounded-2xl bg-sky-50 text-sky-700">
                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="M12 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8Z" stroke="currentColor" stroke-width="1.8"/>
                    <path d="M4 20a8 8 0 0 1 16 0" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                </svg>
            </div>
            <h2 class="font-display text-2xl font-semibold text-slate-950">Data yang Kami Kumpulkan</h2>
            <p class="mt-3 text-sm leading-7 text-slate-600">
                Sistem dapat menggunakan data seperti nama, email, preferensi pencarian, filter rekomendasi, serta data penggunaan aplikasi yang diperlukan untuk menjalankan fitur Jelajah Bali.
            </p>
        </article>

        <article class="rounded-[2rem] border border-sky-100/80 bg-white/90 p-6 shadow-[0_20px_60px_rgba(15,23,42,0.07)] animate-fade-up animate-delay-100">
            <div class="mb-5 flex h-12 w-12 items-center justify-center rounded-2xl bg-amber-50 text-amber-700">
                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="M4 17.5 9 12l4 3 7-8.5" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M4 20h16" stroke="currentColor" stroke-width="1.9" stroke-linecap="round"/>
                </svg>
            </div>
            <h2 class="font-display text-2xl font-semibold text-slate-950">Penggunaan Data</h2>
            <p class="mt-3 text-sm leading-7 text-slate-600">
                Data digunakan untuk autentikasi akun, personalisasi rekomendasi destinasi, menampilkan hasil yang lebih relevan, dan membantu peningkatan kualitas sistem.
            </p>
        </article>

        <article class="rounded-[2rem] border border-sky-100/80 bg-white/90 p-6 shadow-[0_20px_60px_rgba(15,23,42,0.07)] animate-fade-up animate-delay-200">
            <div class="mb-5 flex h-12 w-12 items-center justify-center rounded-2xl bg-sky-50 text-sky-700">
                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="M12 3 5 6v5c0 4.4 2.9 8.4 7 10 4.1-1.6 7-5.6 7-10V6l-7-3Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/>
                    <path d="m9 12 2 2 4-4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <h2 class="font-display text-2xl font-semibold text-slate-950">Keamanan Data</h2>
            <p class="mt-3 text-sm leading-7 text-slate-600">
                Data pengguna digunakan untuk kebutuhan sistem dan tidak ditampilkan kepada pengguna lain. Kami menjaga agar informasi akun tetap digunakan sesuai kebutuhan fitur aplikasi.
            </p>
        </article>

        <article class="rounded-[2rem] border border-sky-100/80 bg-white/90 p-6 shadow-[0_20px_60px_rgba(15,23,42,0.07)] animate-fade-up animate-delay-200">
            <div class="mb-5 flex h-12 w-12 items-center justify-center rounded-2xl bg-amber-50 text-amber-700">
                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="M12 8v4" stroke="currentColor" stroke-width="1.9" stroke-linecap="round"/>
                    <path d="M12 16h.01" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"/>
                    <path d="M10.3 4.9 3.5 17a2 2 0 0 0 1.7 3h13.6a2 2 0 0 0 1.7-3L13.7 4.9a2 2 0 0 0-3.4 0Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/>
                </svg>
            </div>
            <h2 class="font-display text-2xl font-semibold text-slate-950">Batasan</h2>
            <p class="mt-3 text-sm leading-7 text-slate-600">
                Jelajah Bali merupakan project sistem rekomendasi wisata dan bukan layanan komersial resmi. Informasi dan rekomendasi digunakan sebagai bantuan perencanaan perjalanan.
            </p>
        </article>
    </section>

    <section class="mt-8 rounded-[2rem] border border-sky-100 bg-gradient-to-br from-sky-50 via-white to-amber-50/70 p-6 shadow-[0_22px_64px_rgba(15,23,42,0.08)] sm:p-8 animate-fade-up animate-delay-300">
        <div class="flex flex-col gap-5 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-xs font-bold uppercase tracking-[0.2em] text-sky-700">Kontak</p>
                <h2 class="mt-2 font-display text-3xl font-semibold text-slate-950">Ada pertanyaan tentang privasi?</h2>
                <p class="mt-3 max-w-2xl text-sm leading-6 text-slate-600">
                    Silakan gunakan informasi kontak yang tersedia di footer untuk menghubungi pengelola Jelajah Bali.
                </p>
            </div>
            <a href="{{ route('about') }}" class="inline-flex items-center justify-center rounded-full border border-slate-200 bg-white/80 px-6 py-3 text-sm font-bold text-slate-700 transition hover:bg-white">
                Tentang Sistem
            </a>
        </div>
    </section>
</div>
@endsection
