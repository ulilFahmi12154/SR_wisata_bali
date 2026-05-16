@extends('layouts.auth')

@section('title', 'Daftar Akun - Jelajah Bali')

@php
    $heroBg = asset('images/destination/Destinasi_Wilayah_Bali.jpg');
@endphp

@section('auth-content')

    {{-- Header --}}
    <div class="mb-7">
        <p class="mb-3 text-xs font-semibold uppercase tracking-widest text-sky-700">
            Daftar Akun
        </p>

        <h2 class="font-display text-3xl font-semibold leading-tight text-slate-900">
            Mulai Petualangan<br>Anda di Bali
        </h2>

        <p class="mt-3 text-sm leading-relaxed text-slate-500">
            Buat akun gratis dan dapatkan rekomendasi wisata personal.
        </p>
    </div>

    {{-- Form --}}
    <form
        action="{{ route('user.register.process') }}"
        method="POST"
        class="space-y-4"
        x-data="{ loading: false }"
        @submit="loading = true"
    >
        @csrf

        {{-- Name --}}
        <div class="space-y-2">
            <label
                for="name"
                class="block text-sm font-semibold text-slate-700"
            >
                Nama Lengkap
                <span class="text-red-500">*</span>
            </label>

            <div class="relative">
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5">
                    <svg
                        class="h-4 w-4 text-slate-400"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.75"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                        />
                    </svg>
                </div>

                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name') }}"
                    placeholder="John Doe"
                    autocomplete="name"
                    required
                    pattern="^[A-Za-z\s]+$"
                    data-label="Nama Lengkap"
                    data-pattern-message="Nama lengkap hanya boleh berisi huruf dan spasi."
                    oninvalid="const label = this.getAttribute('data-label') || 'Nama Lengkap'; let message = ''; if (this.validity.valueMissing) { message = label + ' wajib diisi.'; } else if (this.validity.patternMismatch) { message = this.getAttribute('data-pattern-message') || ('Format ' + label.toLowerCase() + ' tidak sesuai.'); } this.setCustomValidity(message);"
                    oninput="this.setCustomValidity('');"
                    class="h-12 w-full rounded-2xl border pl-11 pr-4 text-sm text-slate-800 shadow-sm shadow-slate-200/40 transition-all duration-200 placeholder:text-slate-400 focus:outline-none focus:ring-4
                           @error('name')
                               border-red-300 bg-red-50/60 focus:border-red-400 focus:bg-white focus:ring-red-100
                           @else
                               border-slate-200 bg-slate-50/70 focus:border-sky-400 focus:bg-white focus:ring-sky-100
                           @enderror"
                >
            </div>

            @error('name')
                <p class="flex items-center gap-1.5 text-xs text-red-500">
                    <svg class="h-3.5 w-3.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                    {{ $message }}
                </p>
            @enderror
        </div>

        {{-- Email --}}
        <div class="space-y-2">
            <label
                for="email"
                class="block text-sm font-semibold text-slate-700"
            >
                Alamat Email
                <span class="text-red-500">*</span>
            </label>

            <div class="relative">
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5">
                    <svg
                        class="h-4 w-4 text-slate-400"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.75"
                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                        />
                    </svg>
                </div>

                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="nama@email.com"
                    autocomplete="email"
                    required
                    data-label="Alamat Email"
                    oninvalid="const label = this.getAttribute('data-label') || 'Email'; let message = ''; if (this.validity.valueMissing) { message = label + ' wajib diisi.'; } else if (this.validity.typeMismatch) { message = 'Format email tidak valid.'; } this.setCustomValidity(message);"
                    oninput="this.setCustomValidity('');"
                    class="h-12 w-full rounded-2xl border pl-11 pr-4 text-sm text-slate-800 shadow-sm shadow-slate-200/40 transition-all duration-200 placeholder:text-slate-400 focus:outline-none focus:ring-4
                           @error('email')
                               border-red-300 bg-red-50/60 focus:border-red-400 focus:bg-white focus:ring-red-100
                           @else
                               border-slate-200 bg-slate-50/70 focus:border-sky-400 focus:bg-white focus:ring-sky-100
                           @enderror"
                >
            </div>

            @error('email')
                <p class="flex items-center gap-1.5 text-xs text-red-500">
                    <svg class="h-3.5 w-3.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                    {{ $message }}
                </p>
            @enderror
        </div>

        {{-- Password --}}
        <div
            class="space-y-2"
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
                        'bg-sky-500',
                        'bg-emerald-500'
                    ][this.strength]
                }
            }"
        >
            <label
                for="password"
                class="block text-sm font-semibold text-slate-700"
            >
                Password
                <span class="text-red-500">*</span>
            </label>

            <div class="relative">
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5">
                    <svg
                        class="h-4 w-4 text-slate-400"
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
                    class="h-12 w-full rounded-2xl border pl-11 pr-11 text-sm text-slate-800 shadow-sm shadow-slate-200/40 transition-all duration-200 placeholder:text-slate-400 focus:outline-none focus:ring-4
                           @error('password')
                               border-red-300 bg-red-50/60 focus:border-red-400 focus:bg-white focus:ring-red-100
                           @else
                               border-slate-200 bg-slate-50/70 focus:border-sky-400 focus:bg-white focus:ring-sky-100
                           @enderror"
                >

                <button
                    type="button"
                    @click="show = !show"
                    class="absolute inset-y-0 right-0 flex items-center pr-3.5 text-slate-400 transition-colors hover:text-slate-600"
                    tabindex="-1"
                    aria-label="Toggle password visibility"
                >
                    <svg
                        x-show="!show"
                        x-cloak
                        class="h-4 w-4"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>

                    <svg
                        x-show="show"
                        x-cloak
                        class="h-4 w-4"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                    </svg>
                </button>
            </div>

            @error('password')
                <p class="flex items-center gap-1.5 text-xs text-red-500">
                    <svg class="h-3.5 w-3.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                    {{ $message }}
                </p>
            @enderror

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
                        'text-sky-700': strength === 3,
                        'text-emerald-600': strength === 4
                    }"
                >
                    Kekuatan:
                    <span x-text="strengthLabel"></span>
                </p>
            </div>
        </div>

        {{-- Confirm Password --}}
        <div
            class="space-y-2"
            x-data="{ show: false }"
        >
            <label
                for="password_confirmation"
                class="block text-sm font-semibold text-slate-700"
            >
                Konfirmasi Password
                <span class="text-red-500">*</span>
            </label>

            <div class="relative">
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5">
                    <svg
                        class="h-4 w-4 text-slate-400"
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

                <input
                    :type="show ? 'text' : 'password'"
                    id="password_confirmation"
                    name="password_confirmation"
                    placeholder="Ulangi password"
                    autocomplete="new-password"
                    required
                    minlength="8"
                    data-label="Konfirmasi Password"
                    oninvalid="const label = this.getAttribute('data-label') || 'Konfirmasi Password'; let message = ''; if (this.validity.valueMissing) { message = label + ' wajib diisi.'; } else if (this.validity.tooShort) { message = label + ' minimal ' + this.minLength + ' karakter.'; } this.setCustomValidity(message);"
                    oninput="this.setCustomValidity('');"
                    class="h-12 w-full rounded-2xl border pl-11 pr-11 text-sm text-slate-800 shadow-sm shadow-slate-200/40 transition-all duration-200 placeholder:text-slate-400 focus:outline-none focus:ring-4
                           @error('password_confirmation')
                               border-red-300 bg-red-50/60 focus:border-red-400 focus:bg-white focus:ring-red-100
                           @else
                               border-slate-200 bg-slate-50/70 focus:border-sky-400 focus:bg-white focus:ring-sky-100
                           @enderror"
                >

                <button
                    type="button"
                    @click="show = !show"
                    class="absolute inset-y-0 right-0 flex items-center pr-3.5 text-slate-400 transition-colors hover:text-slate-600"
                    tabindex="-1"
                    aria-label="Toggle password visibility"
                >
                    <svg
                        x-show="!show"
                        x-cloak
                        class="h-4 w-4"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>

                    <svg
                        x-show="show"
                        x-cloak
                        class="h-4 w-4"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                    </svg>
                </button>
            </div>

            @error('password_confirmation')
                <p class="flex items-center gap-1.5 text-xs text-red-500">
                    <svg class="h-3.5 w-3.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                    {{ $message }}
                </p>
            @enderror
        </div>

        {{-- Terms --}}
        <div class="flex items-start gap-3 pt-1">
            <input
                type="checkbox"
                id="terms"
                name="terms"
                required
                oninvalid="this.setCustomValidity('Anda harus menyetujui Syarat & Ketentuan.');"
                oninput="this.setCustomValidity('');"
                class="mt-1 h-4 w-4 flex-shrink-0 cursor-pointer rounded border-slate-300 text-sky-600 focus:ring-2 focus:ring-sky-200 focus:ring-offset-0"
            >

            <label
                for="terms"
                class="text-sm leading-relaxed text-slate-600"
            >
                Saya menyetujui
                <a href="#" class="font-semibold text-sky-700 transition-colors hover:text-sky-800 hover:underline">
                    Syarat &amp; Ketentuan
                </a>
                dan
                <a href="#" class="font-semibold text-sky-700 transition-colors hover:text-sky-800 hover:underline">
                    Kebijakan Privasi
                </a>
            </label>
        </div>

        @error('terms')
            <p class="flex items-center gap-1.5 text-xs text-red-500">
                <svg class="h-3.5 w-3.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                </svg>
                {{ $message }}
            </p>
        @enderror

        {{-- Submit --}}
        <button
            type="submit"
            class="flex h-12 w-full items-center justify-center gap-2 rounded-2xl border border-sky-600 bg-sky-700 text-sm font-semibold text-white shadow-[0_14px_32px_rgba(2,132,199,0.20)] transition-all duration-200 hover:-translate-y-0.5 hover:border-sky-700 hover:bg-sky-800 hover:shadow-[0_18px_38px_rgba(2,132,199,0.24)] focus:outline-none focus:ring-4 focus:ring-sky-100"
            x-bind:disabled="loading"
            x-bind:class="{ 'opacity-70 cursor-not-allowed hover:translate-y-0': loading }"
        >
            <span x-show="!loading">
                Buat Akun
            </span>

            <span
                x-show="loading"
                x-cloak
                class="flex items-center gap-2"
            >
                <svg
                    class="h-4 w-4 animate-spin"
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
                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"
                    />
                </svg>

                Mendaftarkan...
            </span>
        </button>
    </form>

    {{-- Login --}}
    <p class="mt-6 text-center text-sm text-slate-500">
        Sudah punya akun?

        <a
            href="{{ route('user.login') }}"
            class="font-semibold text-sky-700 transition-colors hover:text-sky-800 hover:underline"
        >
            Masuk sekarang
        </a>
    </p>

    {{-- Footer --}}
    <p class="mt-5 text-center text-xs leading-relaxed text-slate-400">
        Simpan destinasi favorit, dapatkan rekomendasi personal, dan jelajahi Bali lebih mudah.
    </p>

@endsection
