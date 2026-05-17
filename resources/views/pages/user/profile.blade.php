@extends('layouts.app')

@section('title', 'Profil Saya')

@section('content')
@php
    $user = auth()->user();
    $userName = trim($user->name ?? '') ?: 'User';
    $userInitial = mb_strtoupper(mb_substr($userName, 0, 1));
    $joinedAt = $user->created_at ? $user->created_at->translatedFormat('d F Y') : 'Tanggal belum tersedia';
@endphp

<div class="mx-auto max-w-[1040px] animate-page-in">
    <section class="mt-4 grid gap-6 lg:grid-cols-[360px_minmax(0,1fr)]">
        <aside class="animate-fade-up">
            <div class="overflow-hidden rounded-[2rem] border border-sky-100/80 bg-gradient-to-br from-white via-sky-50 to-amber-50/60 p-6 shadow-[0_24px_70px_rgba(15,23,42,0.08)]">
                <div class="flex flex-col items-center text-center">
                    <div class="flex h-24 w-24 items-center justify-center rounded-full border border-sky-100 bg-sky-700 text-4xl font-bold text-white shadow-[0_18px_44px_rgba(3,105,161,0.24)]">
                        {{ $userInitial }}
                    </div>

                    <p class="mt-5 text-xs font-bold uppercase tracking-[0.24em] text-sky-700">Profil Pengguna</p>
                    <h1 class="mt-2 font-display text-3xl font-semibold leading-tight text-slate-950">
                        {{ $userName }}
                    </h1>
                    <p class="mt-2 break-all text-sm font-semibold text-slate-500">
                        {{ $user->email }}
                    </p>
                </div>

                <div class="mt-7 space-y-3">
                    <div class="rounded-3xl border border-slate-200 bg-white/75 p-4">
                        <span class="block text-xs font-bold uppercase tracking-[0.18em] text-slate-400">Tanggal Bergabung</span>
                        <strong class="mt-2 block text-base font-bold text-slate-900">{{ $joinedAt }}</strong>
                    </div>
                    <div class="rounded-3xl border border-slate-200 bg-white/75 p-4">
                        <span class="block text-xs font-bold uppercase tracking-[0.18em] text-slate-400">Status Akun</span>
                        <strong class="mt-2 block text-base font-bold text-slate-900">Aktif</strong>
                    </div>
                </div>
            </div>
        </aside>

        <main class="animate-fade-up animate-delay-100">
            <div class="rounded-[2rem] border border-sky-100/80 bg-white/90 p-6 shadow-[0_24px_70px_rgba(15,23,42,0.08)] sm:p-8">
                <div class="mb-7">
                    <p class="inline-flex rounded-full border border-sky-100 bg-sky-50/80 px-4 py-2 text-xs font-bold uppercase tracking-[0.22em] text-sky-700">
                        Edit Profil
                    </p>
                    <h2 class="mt-4 font-display text-3xl font-semibold leading-tight text-slate-950 sm:text-4xl">
                        Perbarui nama lengkap Anda.
                    </h2>
                    <p class="mt-3 max-w-2xl text-sm leading-6 text-slate-600">
                        Nama ini akan dipakai untuk inisial avatar di navbar dan identitas akun Anda.
                    </p>
                </div>

                @if(session('status'))
                    <div class="mb-6 rounded-3xl border border-sky-100 bg-sky-50 px-5 py-4 text-sm font-semibold text-sky-800">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('user.profile.update') }}" class="space-y-5">
                    @csrf
                    @method('PATCH')

                    <div>
                        <label for="name" class="mb-2 block text-sm font-bold text-slate-700">
                            Nama Lengkap
                        </label>
                        <input
                            id="name"
                            name="name"
                            type="text"
                            value="{{ old('name', $userName) }}"
                            autocomplete="name"
                            class="min-h-14 w-full rounded-2xl border {{ $errors->has('name') ? 'border-red-300 bg-red-50/70' : 'border-slate-200 bg-slate-50/80' }} px-5 text-base font-semibold text-slate-900 placeholder-slate-400 shadow-sm transition focus:border-sky-300 focus:bg-white focus:outline-none focus:ring-4 focus:ring-sky-100"
                            placeholder="Masukkan nama lengkap"
                        >
                        @error('name')
                            <p class="mt-2 text-sm font-semibold text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="mb-2 block text-sm font-bold text-slate-700">
                            Alamat Email
                        </label>
                        <input
                            id="email"
                            type="email"
                            value="{{ $user->email }}"
                            readonly
                            class="min-h-14 w-full cursor-not-allowed rounded-2xl border border-slate-200 bg-slate-100/80 px-5 text-base font-semibold text-slate-500 shadow-sm"
                        >
                        <p class="mt-2 text-sm leading-6 text-slate-500">
                            Email belum dapat diubah pada versi profil ini.
                        </p>
                    </div>

                    <div class="flex flex-col gap-3 pt-2 sm:flex-row">
                        <button
                            type="submit"
                            class="inline-flex min-h-12 flex-1 items-center justify-center rounded-full bg-sky-700 px-6 text-sm font-bold text-white shadow-[0_14px_34px_rgba(3,105,161,0.22)] transition hover:-translate-y-0.5 hover:bg-sky-800 focus:outline-none focus:ring-4 focus:ring-sky-100"
                        >
                            Simpan Perubahan
                        </button>
                        <a
                            href="{{ route('user.home') }}"
                            class="inline-flex min-h-12 flex-1 items-center justify-center rounded-full border border-slate-200 bg-white px-6 text-sm font-bold text-slate-700 transition hover:bg-sky-50 hover:text-sky-800"
                        >
                            Kembali ke Beranda
                        </a>
                    </div>
                </form>
            </div>
        </main>
    </section>
</div>
@endsection
