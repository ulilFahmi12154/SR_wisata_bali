@extends('layouts.auth')

@section('title', 'Masuk — Jelajah Bali')

@section('auth-content')

    {{-- Heading --}}
    <div class="mb-8">
        <h2 class="font-display text-3xl font-semibold text-slate-900 leading-tight">
            Selamat Datang<br>Kembali 👋
        </h2>

        <p class="text-slate-500 text-sm mt-2">
            Masuk untuk melanjutkan perjalanan Anda di Bali.
        </p>
    </div>

    {{-- Login Form --}}
    <form
        action="{{ route('user.login') }}"
        method="POST"
        class="space-y-5"
        x-data="{ loading: false }"
        @submit="loading = true"
    >
        @csrf

        {{-- Email --}}
        <x-ui.input
            name="email"
            label="Alamat Email"
            type="email"
            placeholder="nama@email.com"
            autocomplete="email"
            :value="old('email')"
            required
            icon="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
        />

        {{-- Password --}}
        <div class="space-y-1.5">

            <div class="flex items-center justify-between">
                <label
                    for="password"
                    class="block text-sm font-medium text-slate-700"
                >
                    Password
                    <span class="text-red-500">*</span>
                </label>

                <a
                    href="{{ route('user.password.request') }}"
                    class="text-xs text-brand-600 hover:text-brand-700 hover:underline transition-colors"
                >
                    Lupa password?
                </a>
            </div>

            <div
                class="relative"
                x-data="{ show: false }"
            >
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
                    placeholder="••••••••"
                    autocomplete="current-password"
                    required
                    data-label="Password"
                    oninvalid="const label = this.getAttribute('data-label') || 'Password'; let message = ''; if (this.validity.valueMissing) { message = label + ' wajib diisi.'; } this.setCustomValidity(message);"
                    oninput="this.setCustomValidity('');"
                    class="w-full rounded-xl border pl-11 pr-11 py-3 text-sm bg-slate-50/60 placeholder:text-slate-400
                           transition-all duration-150 focus:outline-none focus:ring-2 focus:bg-white
                           @error('password')
                               border-red-300 focus:border-red-400 focus:ring-red-100
                           @else
                               border-slate-200 focus:border-brand-500 focus:ring-brand-100
                           @enderror"
                >

                {{-- Toggle --}}
                <button
                    type="button"
                    @click="show = !show"
                    class="absolute inset-y-0 right-0 flex items-center pr-3.5 text-slate-400 hover:text-slate-600 transition-colors"
                    tabindex="-1"
                    aria-label="Toggle password visibility"
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
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"
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
                            d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"
                        />
                    </svg>
                </button>
            </div>

            {{-- Error --}}
            @error('password')
                <p class="text-xs text-red-500 flex items-center gap-1">
                    <svg
                        class="w-3.5 h-3.5"
                        fill="currentColor"
                        viewBox="0 0 20 20"
                    >
                        <path
                            fill-rule="evenodd"
                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                            clip-rule="evenodd"
                        />
                    </svg>

                    {{ $message }}
                </p>
            @enderror
        </div>

        {{-- Remember --}}
        <div class="flex items-center gap-2">
            <input
                type="checkbox"
                id="remember"
                name="remember"
                class="w-4 h-4 rounded border-slate-300 text-brand-600 focus:ring-brand-500 cursor-pointer"
            >

            <label
                for="remember"
                class="text-sm text-slate-600 cursor-pointer select-none"
            >
                Ingat saya selama 30 hari
            </label>
        </div>

        {{-- Submit --}}
<button
    type="submit"
    class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-xl
           transition duration-200 flex items-center justify-center gap-2"
    x-bind:disabled="loading"
    x-bind:class="{ 'opacity-70 cursor-not-allowed': loading }"
>
    {{-- Normal text --}}
    <span x-show="!loading">
        Masuk
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
                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"
            />
        </svg>

        Memproses...
    </span>
</button>

    </form>

    {{-- Divider --}}
    <div class="my-6 flex items-center gap-4">
        <div class="flex-1 h-px bg-slate-200"></div>

        <span class="text-xs text-slate-400 font-medium">
            atau
        </span>

        <div class="flex-1 h-px bg-slate-200"></div>
    </div>

    {{-- Register --}}
    <p class="text-center text-sm text-slate-500 mt-4">
        Belum punya akun?

        <a
            href="{{ route('user.register') }}"
            class="text-brand-600 font-medium hover:text-brand-700 hover:underline transition-colors"
        >
            Daftar sekarang
        </a>
    </p>

@endsection