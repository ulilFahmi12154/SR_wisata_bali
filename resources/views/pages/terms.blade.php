@extends('layouts.app')

@section('title', 'Syarat & Ketentuan Penggunaan')

@section('content')
<div class="mx-auto max-w-[1180px] animate-page-in">
    <section class="mt-4 overflow-hidden rounded-[2.25rem] border border-sky-100/80 bg-gradient-to-br from-white via-sky-50 to-amber-50/60 p-6 shadow-[0_26px_80px_rgba(15,23,42,0.08)] sm:p-8 lg:p-10 animate-fade-up">
        <div class="max-w-3xl">
            <p class="inline-flex rounded-full border border-sky-100 bg-sky-50/80 px-4 py-2 text-xs font-bold uppercase tracking-[0.22em] text-sky-700">
                Syarat &amp; Ketentuan
            </p>
            <h1 class="mt-5 font-display text-4xl font-semibold leading-[1.05] text-slate-950 sm:text-5xl lg:text-6xl">
                Syarat &amp; Ketentuan Penggunaan
            </h1>
            <p class="mt-5 text-base leading-8 text-slate-600 sm:text-lg">
                Dengan menggunakan Jelajah Bali, pengguna memahami aturan penggunaan aplikasi sebagai sistem rekomendasi wisata Bali berbasis preferensi.
            </p>
        </div>
    </section>

    <section class="mt-7 grid gap-5 md:grid-cols-2">
        <article class="rounded-[2rem] border border-sky-100/80 bg-white/90 p-6 shadow-[0_20px_60px_rgba(15,23,42,0.07)] animate-fade-up animate-delay-100">
            <div class="mb-5 flex h-12 w-12 items-center justify-center rounded-2xl bg-sky-50 text-sky-700">
                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="M5 6h14M5 12h14M5 18h9" stroke="currentColor" stroke-width="1.9" stroke-linecap="round"/>
                </svg>
            </div>
            <h2 class="font-display text-2xl font-semibold text-slate-950">Penggunaan Sistem</h2>
            <p class="mt-3 text-sm leading-7 text-slate-600">
                Sistem digunakan untuk mencari destinasi wisata Bali, membaca informasi destinasi, dan mendapatkan rekomendasi berdasarkan kriteria yang dipilih pengguna.
            </p>
        </article>

        <article class="rounded-[2rem] border border-sky-100/80 bg-white/90 p-6 shadow-[0_20px_60px_rgba(15,23,42,0.07)] animate-fade-up animate-delay-100">
            <div class="mb-5 flex h-12 w-12 items-center justify-center rounded-2xl bg-amber-50 text-amber-700">
                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="M12 20V10" stroke="currentColor" stroke-width="1.9" stroke-linecap="round"/>
                    <path d="m7 15 5 5 5-5" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M5 6h14" stroke="currentColor" stroke-width="1.9" stroke-linecap="round"/>
                </svg>
            </div>
            <h2 class="font-display text-2xl font-semibold text-slate-950">Rekomendasi</h2>
            <p class="mt-3 text-sm leading-7 text-slate-600">
                Rekomendasi bersifat bantuan pengambilan keputusan, bukan keputusan mutlak. Pengguna tetap disarankan mempertimbangkan preferensi pribadi sebelum berkunjung.
            </p>
        </article>

        <article class="rounded-[2rem] border border-sky-100/80 bg-white/90 p-6 shadow-[0_20px_60px_rgba(15,23,42,0.07)] animate-fade-up animate-delay-200">
            <div class="mb-5 flex h-12 w-12 items-center justify-center rounded-2xl bg-sky-50 text-sky-700">
                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="M4 17.5 9 12l4 3 7-8.5" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M4 20h16" stroke="currentColor" stroke-width="1.9" stroke-linecap="round"/>
                </svg>
            </div>
            <h2 class="font-display text-2xl font-semibold text-slate-950">Akurasi Data</h2>
            <p class="mt-3 text-sm leading-7 text-slate-600">
                Informasi destinasi seperti harga, rating, fasilitas, lokasi, dan jam operasional dapat berubah sesuai kondisi lapangan atau kebijakan tempat wisata.
            </p>
        </article>

        <article class="rounded-[2rem] border border-sky-100/80 bg-white/90 p-6 shadow-[0_20px_60px_rgba(15,23,42,0.07)] animate-fade-up animate-delay-200">
            <div class="mb-5 flex h-12 w-12 items-center justify-center rounded-2xl bg-amber-50 text-amber-700">
                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="M12 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8Z" stroke="currentColor" stroke-width="1.8"/>
                    <path d="M4 20a8 8 0 0 1 16 0" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                </svg>
            </div>
            <h2 class="font-display text-2xl font-semibold text-slate-950">Akun Pengguna</h2>
            <p class="mt-3 text-sm leading-7 text-slate-600">
                Pengguna bertanggung jawab menjaga akun, email, dan data login masing-masing agar tidak digunakan oleh pihak lain tanpa izin.
            </p>
        </article>

        <article class="rounded-[2rem] border border-sky-100/80 bg-white/90 p-6 shadow-[0_20px_60px_rgba(15,23,42,0.07)] animate-fade-up animate-delay-300">
            <div class="mb-5 flex h-12 w-12 items-center justify-center rounded-2xl bg-sky-50 text-sky-700">
                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="M12 8v4" stroke="currentColor" stroke-width="1.9" stroke-linecap="round"/>
                    <path d="M12 16h.01" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"/>
                    <path d="M10.3 4.9 3.5 17a2 2 0 0 0 1.7 3h13.6a2 2 0 0 0 1.7-3L13.7 4.9a2 2 0 0 0-3.4 0Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/>
                </svg>
            </div>
            <h2 class="font-display text-2xl font-semibold text-slate-950">Batasan Tanggung Jawab</h2>
            <p class="mt-3 text-sm leading-7 text-slate-600">
                Sistem tidak bertanggung jawab atas perubahan kondisi lapangan, harga tiket, jadwal operasional, atau kebijakan yang ditetapkan oleh pengelola tempat wisata.
            </p>
        </article>

        <article class="rounded-[2rem] border border-sky-100/80 bg-white/90 p-6 shadow-[0_20px_60px_rgba(15,23,42,0.07)] animate-fade-up animate-delay-300">
            <div class="mb-5 flex h-12 w-12 items-center justify-center rounded-2xl bg-amber-50 text-amber-700">
                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="M7 7h10v10H7z" stroke="currentColor" stroke-width="1.8"/>
                    <path d="M4 4h4M16 4h4M4 20h4M16 20h4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                </svg>
            </div>
            <h2 class="font-display text-2xl font-semibold text-slate-950">Perubahan Ketentuan</h2>
            <p class="mt-3 text-sm leading-7 text-slate-600">
                Ketentuan dapat diperbarui sesuai kebutuhan pengembangan aplikasi. Perubahan akan disesuaikan agar tetap relevan dengan penggunaan Jelajah Bali.
            </p>
        </article>
    </section>

    <section class="mt-8 rounded-[2rem] border border-sky-100 bg-gradient-to-br from-sky-50 via-white to-amber-50/70 p-6 text-center shadow-[0_22px_64px_rgba(15,23,42,0.08)] sm:p-8 animate-fade-up animate-delay-300">
        <h2 class="font-display text-3xl font-semibold text-slate-950">Gunakan Jelajah Bali dengan nyaman</h2>
        <p class="mx-auto mt-3 max-w-2xl text-sm leading-6 text-slate-600">
            Baca kebijakan privasi untuk memahami penggunaan data, lalu lanjutkan pencarian destinasi sesuai preferensi perjalanan Anda.
        </p>
        <div class="mt-6 flex flex-col items-center justify-center gap-3 sm:flex-row">
            <a href="{{ route('privacy') }}" class="inline-flex w-full items-center justify-center rounded-full border border-slate-200 bg-white/80 px-6 py-3 text-sm font-bold text-slate-700 transition hover:bg-white sm:w-auto">
                Lihat Kebijakan Privasi
            </a>
            @auth
                <a href="{{ route('user.home') }}" class="inline-flex w-full items-center justify-center rounded-full bg-sky-700 px-6 py-3 text-sm font-bold text-white shadow-[0_14px_34px_rgba(3,105,161,0.22)] transition hover:-translate-y-0.5 hover:bg-sky-800 sm:w-auto">
                    Mulai Cari Rekomendasi
                </a>
            @else
                <a href="{{ route('user.register') }}" class="inline-flex w-full items-center justify-center rounded-full bg-sky-700 px-6 py-3 text-sm font-bold text-white shadow-[0_14px_34px_rgba(3,105,161,0.22)] transition hover:-translate-y-0.5 hover:bg-sky-800 sm:w-auto">
                    Buat Akun
                </a>
            @endauth
        </div>
    </section>
</div>
@endsection
