@extends('layouts.auth')

@section('title', 'Daftar Akun — Jelajah Bali')

@php
    $heroBg = asset('images/destination/Destinasi_Wilayah_Bali.jpg');
@endphp

@section('auth-content')

    {{-- Header --}}
    <div class="mb-8">
        <h2 class="font-display text-3xl font-semibold text-slate-900 leading-tight">
            Mulai Petualangan<br>Anda di Bali 🌴
        </h2>

        <p class="text-slate-500 text-sm mt-2">
            Buat akun gratis dan dapatkan rekomendasi wisata personal.
        </p>
    </div>

    {{-- Form --}}
    <form
        action="{{ route('user.register') }}"
        method="POST"
        class="space-y-5"
        x-data="{ loading: false }"
        @submit="loading = true"
    >
        @csrf

        {{-- Name --}}
        <x-ui.input
            name="name"
            label="Nama Lengkap"
            type="text"
            :value="old('name')"
            placeholder="John Doe"
            autocomplete="name"
            required
            pattern="^[A-Za-z\s]+$"
            data-pattern-message="Nama lengkap hanya boleh berisi huruf dan spasi."
            icon="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
        />

        {{-- Email --}}
        <x-ui.input
            name="email"
            label="Alamat Email"
            type="email"
            :value="old('email')"
            placeholder="nama@email.com"
            autocomplete="email"
            required
            icon="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
        />

        {{-- Password --}}
        <div
            class="space-y-1.5"
            x-data="{
                show: false,
                password: '',

                get strength() {
                    if (!this.password) return 0

                    let s = 0

                    if (this.password.length >= 8) s++
                    if (/[A-Z]/.test(this.password)) s++
                    if (/[0-9]/.test(this.password)) s++
                    if (/[^A-Za-z0-9]/.test(this.password)) s++

                    return s
                },

                get strengthLabel() {
                    return ['', 'Lemah', 'Cukup', 'Kuat', 'Sangat Kuat'][this.strength]
                },

                get strengthColor() {
                    return [
                        '',
                        'bg-red-400',
                        'bg-amber-400',
                        'bg-brand-400',
                        'bg-emerald-500'
                    ][this.strength]
                }
            }"
        >
            <label
                for="password"
                class="block text-sm font-medium text-slate-700"
            >
                Password
                <span class="text-red-500">*</span>
            </label>

            <div class="relative">

                {{-- Icon --}}
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5">
                    <svg
                        class="w-4 h-4 text-slate-400"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.75"
                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"
                        />
                    </svg>
                </div>

                {{-- Input --}}
                <input
                    :type="show ? 'text' : 'password'"
                    id="password"
                    name="password"
                    x-model="password"
                    placeholder="Min. 8 karakter"
                    autocomplete="new-password"
                    required
                    minlength="8"
                    data-label="Password"
                    oninvalid="const label = this.getAttribute('data-label') || 'Password'; let message = ''; if (this.validity.valueMissing) { message = label + ' wajib diisi.'; } else if (this.validity.tooShort) { message = label + ' minimal ' + this.minLength + ' karakter.'; } this.setCustomValidity(message);"
                    oninput="this.setCustomValidity('');"
                    class="w-full rounded-xl border border-slate-200
                           pl-11 pr-11 py-3 text-sm
                           bg-slate-50/60 placeholder:text-slate-400
                           transition-all duration-150
                           focus:outline-none focus:ring-2
                           focus:ring-brand-100 focus:border-brand-500
                           focus:bg-white"
                >

                {{-- Toggle --}}
                <button
                    type="button"
                    @click="show = !show"
                    class="absolute inset-y-0 right-0 flex items-center pr-3.5
                        text-slate-400 hover:text-slate-600 transition"
                >
                    {{-- Eye --}}
                    <svg
                        x-show="!show"
                        x-cloak
                        class="w-4 h-4"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.75"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.75"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5
                            c4.478 0 8.268 2.943 9.542 7
                            -1.274 4.057-5.064 7-9.542 7
                            -4.477 0-8.268-2.943-9.542-7z"
                        />
                    </svg>

                    {{-- Eye Off --}}
                    <svg
                        x-show="show"
                        x-cloak
                        class="w-4 h-4"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.75"
                            d="M3 3l18 18"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.75"
                            d="M10.584 10.587a2 2 0 102.829 2.828"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.75"
                            d="M9.363 5.365A9.466 9.466 0 0112 5
                            c4.478 0 8.268 2.943 9.542 7
                            a9.457 9.457 0 01-1.249 2.592"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.75"
                            d="M6.228 6.228A9.457 9.457 0 002.458 12
                            c1.274 4.057 5.064 7 9.542 7
                            a9.46 9.46 0 005.772-1.772"
                        />
                    </svg>
                </button>
            </div>

            {{-- Strength --}}
            <div
                x-show="password.length > 0"
                x-cloak
                class="space-y-1"
            >
                <div class="flex gap-1">
                    <template x-for="i in 4" :key="i">
                        <div
                            class="h-1 flex-1 rounded-full transition-all"
                            :class="i <= strength ? strengthColor : 'bg-slate-200'"
                        ></div>
                    </template>
                </div>

                <p
                    class="text-xs"
                    :class="{
                        'text-red-500': strength === 1,
                        'text-amber-500': strength === 2,
                        'text-brand-600': strength === 3,
                        'text-emerald-600': strength === 4
                    }"
                >
                    Kekuatan:
                    <span x-text="strengthLabel"></span>
                </p>
            </div>
        </div>

        {{-- Confirm Password --}}
        <x-ui.input
            name="password_confirmation"
            label="Konfirmasi Password"
            type="password"
            placeholder="Ulangi password"
            autocomplete="new-password"
            required
            minlength="8"
            icon="M12 15v2m6-6V7a6 6 0 10-12 0v4"
        />

        {{-- Terms --}}
        <div class="flex items-start gap-2">
            <input
                type="checkbox"
                id="terms"
                name="terms"
                required
                oninvalid="this.setCustomValidity('Anda harus menyetujui Syarat & Ketentuan.');"
                oninput="this.setCustomValidity('');"
                class="mt-1 w-4 h-4 rounded border-slate-300
                       text-brand-600 focus:ring-brand-500"
            >

            <label
                for="terms"
                class="text-sm text-slate-600 leading-relaxed"
            >
                Saya menyetujui
                <a href="#" class="text-brand-600 hover:underline font-medium">
                    Syarat & Ketentuan
                </a>
                dan
                <a href="#" class="text-brand-600 hover:underline font-medium">
                    Kebijakan Privasi
                </a>
            </label>
        </div>

        {{-- Submit --}}
        {{-- Submit --}}
        <div class="pt-2">
            <button
                type="submit"
                :disabled="loading"
                class="w-full rounded-xl bg-blue-600 hover:bg-blue-700
                    text-white py-3 font-medium transition duration-200
                    disabled:opacity-70 disabled:cursor-not-allowed
                    flex items-center justify-center gap-2"
            >
                {{-- Normal --}}
                <span x-show="!loading">
                    Buat Akun
                </span>

                {{-- Loading --}}
                <span
                    x-show="loading"
                    x-cloak
                    class="flex items-center gap-2"
                >
                    <svg
                        class="animate-spin w-4 h-4"
                        fill="none"
                        viewBox="0 0 24 24"
                    >
                        <circle
                            class="opacity-25"
                            cx="12"
                            cy="12"
                            r="10"
                            stroke="currentColor"
                            stroke-width="4"
                        />

                        <path
                            class="opacity-75"
                            fill="currentColor"
                            d="M4 12a8 8 0 018-8V0C5.373 
                            0 0 5.373 0 12h4z"
                        />
                    </svg>

                    Mendaftarkan...
                </span>
            </button>
        </div>
    </form>

    {{-- Login --}}
     {{-- Register --}}
    <p class="text-center text-sm text-slate-500 mt-4">
        Sudah punya akun?

        <a
            href="{{ route('user.login') }}"
            class="text-brand-600 font-medium hover:text-brand-700 hover:underline transition-colors"
        >
            Masuk sekarang
        </a>
    </p>

    {{-- Footer --}}
    <p class="text-center text-xs text-slate-400 mt-6 leading-relaxed">
        Dengan membuat akun, Anda dapat menyimpan destinasi favorit,
        mendapatkan rekomendasi wisata personal, dan menjelajahi Bali lebih mudah.
    </p>

@endsection