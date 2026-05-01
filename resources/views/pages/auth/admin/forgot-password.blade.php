@extends('layouts.app')

@section('title', 'Reset Password Admin — Jelajah Bali')

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
    .dot-grid {
        background-image: radial-gradient(circle, rgba(255,255,255,0.08) 1px, transparent 1px);
        background-size: 28px 28px;
    }
</style>
@endpush

@section('body')
<div class="min-h-screen admin-bg relative flex items-center justify-center p-6 overflow-hidden">

    {{-- Background --}}
    <div class="absolute inset-0 dot-grid pointer-events-none"></div>
    <div class="absolute -top-24 -right-24 w-96 h-96 rounded-full bg-brand-600/20 blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-32 -left-16 w-80 h-80 rounded-full bg-brand-800/30 blur-3xl pointer-events-none"></div>

    {{-- Card --}}
    <div class="relative w-full max-w-sm card-glass rounded-3xl p-8 shadow-2xl">

        {{-- Back link --}}
        <a href="{{ route('admin.login') }}"
           class="inline-flex items-center gap-1.5 text-xs text-white/50 hover:text-white/80 transition-colors mb-7 group">
            <svg class="w-3.5 h-3.5 transition-transform group-hover:-translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali ke login admin
        </a>

        {{-- Icon --}}
        <div class="flex flex-col items-center mb-7">
            <div class="w-14 h-14 rounded-2xl bg-brand-700/60 border border-brand-500/30 flex items-center justify-center mb-4">
                <svg class="w-7 h-7 text-brand-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75"
                          d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                </svg>
            </div>
            <h2 class="text-white/90 font-semibold text-lg font-display">Reset Password Admin</h2>
            <p class="text-white/40 text-xs mt-1 text-center max-w-xs leading-relaxed">
                Masukkan email admin Anda untuk menerima instruksi reset password.
            </p>
        </div>

        {{-- Success --}}
        @if (session('status'))
            <div class="rounded-xl bg-emerald-500/15 border border-emerald-400/25 p-4 mb-5">
                <div class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-emerald-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <div>
                        <p class="text-emerald-300 text-sm font-medium">Email terkirim!</p>
                        <p class="text-emerald-400/80 text-xs mt-0.5">{{ session('status') }}</p>
                    </div>
                </div>
            </div>
        @endif

        {{-- Form --}}
        @unless (session('status'))
        <form action="{{ route('admin.password.email') }}" method="POST" class="space-y-4"
              x-data="{ loading: false }" @submit="loading = true">
            @csrf

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
                @error('email')
                    <p class="text-xs text-red-400 flex items-center gap-1">
                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <button
                type="submit"
                x-bind:disabled="loading"
                class="w-full flex items-center justify-center gap-2 bg-brand-600 hover:bg-brand-500
                       text-white font-medium text-sm rounded-xl py-3.5 mt-2
                       transition-all duration-150 shadow-lg shadow-brand-900/40
                       disabled:opacity-60 disabled:cursor-not-allowed focus:outline-none
                       focus:ring-2 focus:ring-brand-400 focus:ring-offset-2 focus:ring-offset-transparent"
            >
                <span x-show="!loading">Kirim Link Reset</span>
                <span x-show="loading" class="flex items-center gap-2" style="display:none">
                    <svg class="animate-spin w-4 h-4" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/>
                    </svg>
                    Mengirim...
                </span>
            </button>

        </form>
        @endunless

        {{-- Footer --}}
        <p class="mt-7 text-center text-white/25 text-xs">
            © {{ date('Y') }} Jelajah Bali · Admin System
        </p>

    </div>
</div>
@endsection