@extends('layouts.auth')

@section('title', 'Daftar Akun — Jelajah Bali')

@php $heroBg = asset('images/auth-register.jpg'); @endphp

@section('auth-content')

    {{-- Heading --}}
    <div class="mb-7">
        <h2 class="font-display text-3xl font-semibold text-slate-900 leading-tight">
            Mulai Petualangan<br>Anda di Bali 🌴
        </h2>
        <p class="text-slate-500 text-sm mt-2">
            Buat akun gratis dan dapatkan rekomendasi wisata personal.
        </p>
    </div>

    {{-- Register Form --}}
    <form action="{{ route('user.register') }}" method="POST" class="space-y-4" x-data="{ loading: false }" @submit="loading = true">
        @csrf

        {{-- Full name --}}
        <x-ui.input
            name="name"
            label="Nama Lengkap"
            type="text"
            placeholder="John Doe"
            autocomplete="name"
            required
            icon="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
        />

        {{-- Email --}}
        <x-ui.input
            name="email"
            label="Alamat Email"
            type="email"
            placeholder="nama@email.com"
            autocomplete="email"
            required
            icon="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
        />

        {{-- Password with strength indicator --}}
        <div class="space-y-1.5" x-data="{
            show: false,
            password: '',
            get strength() {
                if (!this.password) return 0;
                let s = 0;
                if (this.password.length >= 8) s++;
                if (/[A-Z]/.test(this.password)) s++;
                if (/[0-9]/.test(this.password)) s++;
                if (/[^A-Za-z0-9]/.test(this.password)) s++;
                return s;
            },
            get strengthLabel() {
                return ['', 'Lemah', 'Cukup', 'Kuat', 'Sangat Kuat'][this.strength];
            },
            get strengthColor() {
                return ['', 'bg-red-400', 'bg-amber-400', 'bg-brand-400', 'bg-emerald-500'][this.strength];
            },
        }">
            <label for="password" class="block text-sm font-medium text-slate-700">
                Password <span class="text-red-500">*</span>
            </label>

            <div class="relative">
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5">
                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75"
                              d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                </div>
                <input
                    :type="show ? 'text' : 'password'"
                    id="password"
                    name="password"
                    x-model="password"
                    placeholder="Min. 8 karakter"
                    autocomplete="new-password"
                    required
                    class="w-full rounded-xl border pl-11 pr-11 py-3 text-sm bg-slate-50/60 placeholder:text-slate-400
                           transition-all duration-150 focus:outline-none focus:ring-2 focus:bg-white
                           @error('password') border-red-300 focus:border-red-400 focus:ring-red-100
                           @else border-slate-200 focus:border-brand-500 focus:ring-brand-100 @enderror"
                >
                <button type="button" @click="show = !show"
                        class="absolute inset-y-0 right-0 flex items-center pr-3.5 text-slate-400 hover:text-slate-600 transition-colors"
                        tabindex="-1">
                    <svg x-show="!show" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75"
                              d="M15 12a3 3 0 11-6 0 3 3 0 016 0zM2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                    <svg x-show="show" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display:none">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75"
                              d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                    </svg>
                </button>
            </div>

            {{-- Strength bar --}}
            <div x-show="password.length > 0" class="space-y-1" style="display:none">
                <div class="flex gap-1">
                    <template x-for="i in 4" :key="i">
                        <div class="h-1 flex-1 rounded-full transition-all duration-300"
                             :class="i <= strength ? strengthColor : 'bg-slate-200'">
                        </div>
                    </template>
                </div>
                <p class="text-xs" :class="{
                    'text-red-500':    strength === 1,
                    'text-amber-500':  strength === 2,
                    'text-brand-600':  strength === 3,
                    'text-emerald-600':strength === 4,
                }">
                    Kekuatan: <span x-text="strengthLabel"></span>
                </p>
            </div>

            @error('password')
                <p class="text-xs text-red-500 flex items-center gap-1">
                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                    {{ $message }}
                </p>
            @enderror
        </div>

        {{-- Confirm password --}}
        <div class="space-y-1.5" x-data="{ show: false }">
            <label for="password_confirmation" class="block text-sm font-medium text-slate-700">
                Konfirmasi Password <span class="text-red-500">*</span>
            </label>
            <div class="relative">
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5">
                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75"
                              d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                </div>
                <input
                    :type="show ? 'text' : 'password'"
                    id="password_confirmation"
                    name="password_confirmation"
                    placeholder="Ulangi password"
                    autocomplete="new-password"
                    required
                    class="w-full rounded-xl border pl-11 pr-11 py-3 text-sm bg-slate-50/60 placeholder:text-slate-400
                           transition-all duration-150 focus:outline-none focus:ring-2 focus:bg-white
                           border-slate-200 focus:border-brand-500 focus:ring-brand-100"
                >
                <button type="button" @click="show = !show"
                        class="absolute inset-y-0 right-0 flex items-center pr-3.5 text-slate-400 hover:text-slate-600 transition-colors"
                        tabindex="-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75"
                              d="M15 12a3 3 0 11-6 0 3 3 0 016 0zM2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                </button>
            </div>
        </div>

        {{-- Terms --}}
        <div class="flex items-start gap-2 pt-1">
            <input
                type="checkbox"
                id="terms"
                name="terms"
                required
                class="mt-0.5 w-4 h-4 rounded border-slate-300 text-brand-600 focus:ring-brand-500 cursor-pointer"
            >
            <label for="terms" class="text-sm text-slate-600 leading-snug cursor-pointer">
                Saya menyetujui
                <a href="#" class="text-brand-600 hover:underline font-medium">Syarat &amp; Ketentuan</a>
                dan
                <a href="#" class="text-brand-600 hover:underline font-medium">Kebijakan Privasi</a>
            </label>
        </div>

        {{-- Submit --}}
        <x-ui.button type="submit" variant="primary" size="lg" :full-width="true" x-bind:disabled="loading">
            <span x-show="!loading">Buat Akun</span>
            <span x-show="loading" class="flex items-center gap-2" style="display:none">
                <svg class="animate-spin w-4 h-4" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/>
                </svg>
                Mendaftarkan...
            </span>
        </x-ui.button>

    </form>

    {{-- Login link --}}
    <p class="text-center text-sm text-slate-500 mt-6">
        Sudah punya akun?
        <a href="{{ route('user.login') }}" class="text-brand-600 font-medium hover:text-brand-700 hover:underline transition-colors">
            Masuk di sini
        </a>
    </p>

@endsection