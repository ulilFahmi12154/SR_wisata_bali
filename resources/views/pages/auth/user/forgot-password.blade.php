@extends('layouts.auth')

@section('title', 'Lupa Password — Jelajah Bali')

@section('auth-content')

    {{-- Back link --}}
    <a href="{{ route('user.login') }}"
       class="inline-flex items-center gap-1.5 text-sm text-slate-500 hover:text-brand-600 transition-colors mb-8 group">
        <svg class="w-4 h-4 transition-transform group-hover:-translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
        </svg>
        Kembali ke halaman masuk
    </a>

    {{-- Icon --}}
    <div class="w-14 h-14 rounded-2xl bg-brand-100 flex items-center justify-center mb-6">
        <svg class="w-7 h-7 text-brand-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75"
                  d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
        </svg>
    </div>

    {{-- Heading --}}
    <div class="mb-7">
        <h2 class="font-display text-3xl font-semibold text-slate-900">
            Lupa Password?
        </h2>
        <p class="text-slate-500 text-sm mt-2 leading-relaxed">
            Tidak masalah. Masukkan email Anda dan kami akan mengirimkan link untuk mengatur ulang password.
        </p>
    </div>

    {{-- Success state --}}
    @if (session('status'))
        <div class="rounded-2xl bg-emerald-50 border border-emerald-200 p-5 space-y-3">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-emerald-100 flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-emerald-800">Email terkirim!</p>
                    <p class="text-xs text-emerald-600 mt-0.5">{{ session('status') }}</p>
                </div>
            </div>
            <p class="text-xs text-emerald-700 pl-13">
                Periksa folder spam jika email tidak muncul dalam beberapa menit.
            </p>
        </div>

        <div class="mt-6 text-center">
            <a href="{{ route('user.login') }}" class="text-sm text-brand-600 font-medium hover:underline">
                Kembali ke halaman masuk →
            </a>
        </div>

    @else
        {{-- Form --}}
        <form action="{{ route('user.password.email') }}" method="POST" class="space-y-5"
              x-data="{ loading: false }" @submit="loading = true">
            @csrf

            <x-ui.input
                name="email"
                label="Alamat Email"
                type="email"
                placeholder="nama@email.com"
                autocomplete="email"
                required
                icon="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
            />

            <x-ui.button type="submit" variant="primary" size="lg" :full-width="true" x-bind:disabled="loading">
                <span x-show="!loading">Kirim Link Reset Password</span>
                <span x-show="loading" class="flex items-center gap-2" style="display:none">
                    <svg class="animate-spin w-4 h-4" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/>
                    </svg>
                    Mengirim...
                </span>
            </x-ui.button>

        </form>
    @endif

@endsection