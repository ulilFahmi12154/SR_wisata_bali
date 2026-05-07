@extends('layouts.app')

@section('title', 'Admin Portal — Jelajah Bali')

@push('styles')
<style>
    .admin-bg {
        background: linear-gradient(135deg, #072a49 0%, #0b426e 40%, #005da1 100%);
    }
    .card-glass {
        background: rgba(255,255,255,0.04);
        backdrop-filter: blur(16px);
        border: 1px solid rgba(255,255,255,0.1);
    }
    .input-admin {
        background: rgba(255,255,255,0.07);
        border: 1px solid rgba(255,255,255,0.12);
        color: white;
    }
    .input-admin::placeholder { color: rgba(255,255,255,0.35); }
    .input-admin:focus {
        outline: none;
        background: rgba(255,255,255,0.1);
        border-color: rgba(255,255,255,0.35);
        box-shadow: 0 0 0 3px rgba(12,147,233,0.2);
    }
    /* dot-grid pattern */
    .dot-grid {
        background-image: radial-gradient(circle, rgba(255,255,255,0.08) 1px, transparent 1px);
        background-size: 28px 28px;
    }
</style>
@endpush

@section('body')
<div class="min-h-screen admin-bg relative flex items-center justify-center p-6 overflow-hidden">

    {{-- Background pattern --}}
    <div class="absolute inset-0 dot-grid pointer-events-none"></div>

    {{-- Decorative blobs --}}
    <div class="absolute -top-24 -right-24 w-96 h-96 rounded-full bg-brand-600/20 blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-32 -left-16 w-80 h-80 rounded-full bg-brand-800/30 blur-3xl pointer-events-none"></div>

    {{-- Card --}}
    <div class="relative w-full max-w-sm card-glass rounded-3xl p-8 shadow-2xl">

        {{-- Logo + badge --}}
        <div class="flex flex-col items-center mb-8">
            <div class="w-14 h-14 rounded-2xl bg-brand-600 shadow-lg shadow-brand-900/50 flex items-center justify-center mb-4">
                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
            </div>
            <h1 class="font-display text-white text-xl font-semibold tracking-wide">Jelajah Bali</h1>
            <span class="mt-1.5 text-xs font-medium text-brand-300 bg-brand-900/60 px-3 py-1 rounded-full border border-brand-700/50">
                Admin Portal
            </span>
        </div>

        {{-- Heading --}}
        <div class="text-center mb-7">
            <h2 class="text-white/90 font-semibold text-lg">Masuk ke Dashboard</h2>
            <p class="text-white/45 text-xs mt-1">Akses terbatas untuk administrator sistem</p>
        </div>

        {{-- Alert --}}
        @if (session('error') || $errors->any())
            <div class="mb-5 flex items-center gap-2 rounded-xl bg-red-500/15 border border-red-400/25 px-4 py-3">
                <svg class="w-4 h-4 text-red-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <p class="text-red-300 text-xs">
                    {{ session('error') ?? $errors->first() }}
                </p>
            </div>
        @endif

        {{-- Form --}}
        <form action="{{ route('admin.login') }}" method="POST" class="space-y-4"
              x-data="{ loading: false, showPass: false }" @submit="loading = true">
            @csrf

            {{-- Email --}}
            <div class="space-y-1.5">
                <label for="email" class="block text-xs font-medium text-white/60 uppercase tracking-wider">
                    Email Administrator
                </label>
                <div class="relative">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5">
                        <svg class="w-4 h-4 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75"
                                  d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="admin@jelajahbali.id"
                        autocomplete="email"
                        required
                        class="input-admin w-full rounded-xl pl-10 pr-4 py-3 text-sm transition-all duration-150"
                    >
                </div>
            </div>

            {{-- Password --}}
            <div class="space-y-1.5">
                <div class="flex items-center justify-between">
                    <label for="password" class="block text-xs font-medium text-white/60 uppercase tracking-wider">
                        Password
                    </label>
                    <a href="{{ route('admin.password.request') }}"
                       class="text-xs text-brand-300 hover:text-brand-200 transition-colors">
                        Lupa password?
                    </a>
                </div>
                <div class="relative">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5">
                        <svg class="w-4 h-4 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75"
                                  d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                    </div>
                    <input
                        :type="showPass ? 'text' : 'password'"
                        id="password"
                        name="password"
                        placeholder="••••••••••"
                        autocomplete="current-password"
                        required
                        class="input-admin w-full rounded-xl pl-10 pr-11 py-3 text-sm transition-all duration-150"
                    >
                    <button type="button" @click="showPass = !showPass"
                            class="absolute inset-y-0 right-0 flex items-center pr-3.5 text-white/30 hover:text-white/60 transition-colors"
                            tabindex="-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75"
                                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0zM2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </button>
                </div>
            </div>

            {{-- Submit --}}
            <div class="pt-2">
                <button
                    type="submit"
                    x-bind:disabled="loading"
                    class="w-full flex items-center justify-center gap-2 bg-brand-600 hover:bg-brand-500
                           active:bg-brand-700 text-white font-medium text-sm rounded-xl py-3.5
                           transition-all duration-150 shadow-lg shadow-brand-900/40
                           disabled:opacity-60 disabled:cursor-not-allowed focus:outline-none
                           focus:ring-2 focus:ring-brand-400 focus:ring-offset-2 focus:ring-offset-transparent"
                >
                    <span x-show="!loading">
                        <svg class="w-4 h-4 inline mr-1.5 -mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                        </svg>
                        Masuk ke Dashboard
                    </span>
                    <span x-show="loading" class="flex items-center gap-2" style="display:none">
                        <svg class="animate-spin w-4 h-4" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/>
                        </svg>
                        Memverifikasi...
                    </span>
                </button>
            </div>

        </form>

        {{-- Footer --}}
        <div class="mt-8 pt-6 border-t border-white/10 text-center">
            <p class="text-white/30 text-xs">
                Bukan admin?
                <a href="{{ route('user.login') }}" class="text-brand-300 hover:text-brand-200 transition-colors">
                    Masuk sebagai wisatawan
                </a>
            </p>
        </div>

    </div>

    {{-- Bottom credit --}}
    <p class="absolute bottom-4 text-white/20 text-xs">
        © {{ date('Y') }} Jelajah Bali · Sistem Rekomendasi Wisata Pulau Bali
    </p>

</div>
@endsection