@extends('layouts.user')

@section('title', 'Hasil Rekomendasi')

@section('content')
<div class="mx-auto max-w-[1180px] animate-page-in">
    <section class="mt-4 overflow-hidden rounded-[2rem] border border-sky-100/80 bg-gradient-to-br from-white via-sky-50 to-amber-50/60 px-6 py-14 text-center shadow-[0_24px_70px_rgba(15,23,42,0.08)] animate-fade-up sm:px-10">
        <div class="mx-auto mb-6 flex h-16 w-16 items-center justify-center rounded-full border border-sky-100 bg-white/80 text-sky-700 shadow-sm">
            <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                <path d="M12 3v18m7-9H5" stroke="currentColor" stroke-width="1.9" stroke-linecap="round"/>
            </svg>
        </div>
        <p class="text-xs font-bold uppercase tracking-[0.28em] text-sky-700">Rekomendasi Wisata</p>
        <h1 class="mt-3 font-display text-3xl font-semibold leading-tight text-slate-950 sm:text-4xl">
            Mulai dari preferensi perjalanan Anda
        </h1>
        <p class="mx-auto mt-4 max-w-xl text-base leading-7 text-slate-600">
            Isi filter perjalanan terlebih dahulu agar sistem bisa menghitung rekomendasi destinasi Bali yang paling sesuai.
        </p>
        <div class="mt-8 flex flex-col items-center justify-center gap-3 sm:flex-row">
            <a href="{{ route('user.home') }}" class="inline-flex w-full items-center justify-center rounded-full bg-sky-700 px-6 py-3 text-sm font-bold text-white shadow-[0_14px_34px_rgba(3,105,161,0.22)] transition hover:-translate-y-0.5 hover:bg-sky-800 sm:w-auto">
                Isi Preferensi
            </a>
            <a href="{{ route('user.destinations') }}" class="inline-flex w-full items-center justify-center rounded-full border border-slate-200 bg-white/80 px-6 py-3 text-sm font-bold text-slate-700 transition hover:bg-white sm:w-auto">
                Lihat Destinasi
            </a>
        </div>
    </section>
</div>
@endsection
