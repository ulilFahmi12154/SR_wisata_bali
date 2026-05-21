@extends('layouts.auth')

@section('title', 'Lupa Password - Jelajah Bali')

@section('auth-content')

    <div class="mb-8 animate-fade-up">
        <p class="mb-3 text-xs font-semibold uppercase tracking-widest text-sky-700">
            Bantuan Akun
        </p>

        <h2 class="font-display text-3xl font-semibold leading-tight text-slate-900">
            Lupa Password?
        </h2>

        <p class="mt-3 text-sm leading-relaxed text-slate-500">
            Masukkan email akun Anda. Kami akan mengirimkan tautan untuk mengatur ulang password.
        </p>
    </div>

    @if (session('status'))
        <div class="mb-5 rounded-2xl border border-emerald-100 bg-emerald-50/80 px-4 py-3 text-sm font-medium leading-relaxed text-emerald-800 shadow-sm shadow-emerald-100/60">
            {{ session('status') }}
        </div>
    @endif

    <form
        action="{{ route('password.email') }}"
        method="POST"
        class="space-y-5 animate-fade-up animate-delay-100"
        x-data="{ loading: false }"
        @submit="loading = true"
    >
        @csrf

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
                    <svg
                        class="h-3.5 w-3.5 flex-shrink-0"
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

        <button
            type="submit"
            class="flex h-12 w-full items-center justify-center gap-2 rounded-2xl border border-sky-600 bg-sky-700 text-sm font-semibold text-white shadow-[0_14px_32px_rgba(2,132,199,0.20)] transition-all duration-200 hover:-translate-y-0.5 hover:border-sky-700 hover:bg-sky-800 hover:shadow-[0_18px_38px_rgba(2,132,199,0.24)] focus:outline-none focus:ring-4 focus:ring-sky-100"
            x-bind:disabled="loading"
            x-bind:class="{ 'opacity-70 cursor-not-allowed hover:translate-y-0': loading }"
        >
            <span x-show="!loading">
                Kirim Tautan Reset
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

                Mengirim...
            </span>
        </button>
    </form>

    <p class="mt-6 text-center text-sm text-slate-500">
        Sudah ingat password?

        <a
            href="{{ route('user.login') }}"
            class="font-semibold text-sky-700 transition-colors hover:text-sky-800 hover:underline"
        >
            Kembali ke Login
        </a>
    </p>

@endsection
