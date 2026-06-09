@extends('layouts.app')

@section('title', 'Profil Saya')

@section('content')
@php
    $user = $user ?? auth()->user();
    $userName = trim($user->name ?? '') ?: 'User';
    $userInitial = mb_strtoupper(mb_substr($userName, 0, 1));
    $joinedAt = $user->created_at ? $user->created_at->translatedFormat('d F Y') : 'Tanggal belum tersedia';
    $preference = $user->preference ?? null;
    $selectedCategoryIds = collect(old('category_ids', $selectedCategoryIds ?? []))->map(fn ($id) => (int) $id)->all();
@endphp

<div class="mx-auto max-w-[1180px] animate-page-in">
    <section class="mt-4">
        <p class="inline-flex rounded-full border border-sky-100 bg-sky-50/80 px-4 py-2 text-xs font-bold uppercase tracking-[0.22em] text-sky-700">
            Pengaturan Akun
        </p>
        <h1 class="mt-4 font-display text-4xl font-semibold leading-tight text-slate-950 sm:text-5xl">
            Kelola profil Anda.
        </h1>
        <p class="mt-3 max-w-2xl text-sm leading-6 text-slate-600">
            Perbarui identitas akun dan jaga keamanan akses Jelajah Bali Anda dari satu halaman yang rapi.
        </p>
    </section>

    <section class="mt-7 grid gap-6 lg:grid-cols-[340px_minmax(0,1fr)]">
        <aside class="animate-fade-up">
            <div class="overflow-hidden rounded-[2rem] border border-sky-100/80 bg-gradient-to-br from-white via-sky-50 to-amber-50/60 p-6 shadow-[0_24px_70px_rgba(15,23,42,0.08)]">
                <p class="text-xs font-bold uppercase tracking-[0.22em] text-sky-700">Ringkasan Akun</p>

                <div class="mt-6 flex flex-col items-center text-center">
                    <div class="flex h-24 w-24 items-center justify-center rounded-full border border-sky-100 bg-sky-700 text-4xl font-bold text-white shadow-[0_18px_44px_rgba(3,105,161,0.24)]">
                        {{ $userInitial }}
                    </div>

                    <h2 class="mt-5 break-words font-display text-3xl font-semibold leading-tight text-slate-950">
                        {{ $userName }}
                    </h2>
                    <p class="mt-2 break-all text-sm font-semibold text-slate-500">
                        {{ $user->email }}
                    </p>
                </div>

                <dl class="mt-7 divide-y divide-slate-200/80 rounded-[1.5rem] border border-white/80 bg-white/70 px-5 shadow-sm">
                    <div class="py-4">
                        <dt class="text-xs font-bold uppercase tracking-[0.18em] text-slate-400">Tanggal Bergabung</dt>
                        <dd class="mt-2 text-base font-bold text-slate-900">{{ $joinedAt }}</dd>
                    </div>
                    <div class="py-4">
                        <dt class="text-xs font-bold uppercase tracking-[0.18em] text-slate-400">Status Akun</dt>
                        <dd class="mt-2 text-base font-bold text-slate-900">Aktif</dd>
                    </div>
                </dl>
            </div>
        </aside>

        <main class="space-y-6">
            <section class="rounded-[2rem] border border-sky-100/80 bg-white/90 p-6 shadow-[0_24px_70px_rgba(15,23,42,0.08)] sm:p-8 animate-fade-up animate-delay-100">
                <div class="mb-7">
                    <p class="inline-flex rounded-full border border-sky-100 bg-sky-50/80 px-4 py-2 text-xs font-bold uppercase tracking-[0.22em] text-sky-700">
                        Informasi Profil
                    </p>
                    <h2 class="mt-4 font-display text-3xl font-semibold leading-tight text-slate-950">
                        Perbarui nama dan email.
                    </h2>
                    <p class="mt-3 max-w-2xl text-sm leading-6 text-slate-600">
                        Email yang tersimpan akan digunakan untuk masuk dan menerima tautan reset password.
                    </p>
                </div>

                @if(session('profile_status'))
                    <div class="mb-6 rounded-3xl border border-sky-100 bg-sky-50 px-5 py-4 text-sm font-semibold text-sky-800">
                        {{ session('profile_status') }}
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
                            class="min-h-14 w-full rounded-2xl border px-5 text-base font-semibold text-slate-900 placeholder-slate-400 shadow-sm transition focus:bg-white focus:outline-none focus:ring-4 {{ $errors->profile->has('name') ? 'border-red-300 bg-red-50/70 focus:border-red-300 focus:ring-red-100' : 'border-slate-200 bg-slate-50/80 focus:border-sky-300 focus:ring-sky-100' }}"
                            placeholder="Masukkan nama lengkap"
                        >
                        @error('name', 'profile')
                            <p class="mt-2 text-sm font-semibold text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="mb-2 block text-sm font-bold text-slate-700">
                            Alamat Email
                        </label>
                        <input
                            id="email"
                            name="email"
                            type="email"
                            value="{{ old('email', $user->email) }}"
                            autocomplete="email"
                            class="min-h-14 w-full rounded-2xl border px-5 text-base font-semibold text-slate-900 placeholder-slate-400 shadow-sm transition focus:bg-white focus:outline-none focus:ring-4 {{ $errors->profile->has('email') ? 'border-red-300 bg-red-50/70 focus:border-red-300 focus:ring-red-100' : 'border-slate-200 bg-slate-50/80 focus:border-sky-300 focus:ring-sky-100' }}"
                            placeholder="nama@email.com"
                        >
                        @error('email', 'profile')
                            <p class="mt-2 text-sm font-semibold text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div x-data="{ show: false }">
                        <label for="profile_current_password" class="mb-2 block text-sm font-bold text-slate-700">
                            Password Saat Ini
                        </label>
                        <div class="relative">
                            <input
                                id="profile_current_password"
                                name="current_password"
                                :type="show ? 'text' : 'password'"
                                autocomplete="current-password"
                                class="min-h-14 w-full rounded-2xl border px-5 pr-14 text-base font-semibold text-slate-900 placeholder-slate-400 shadow-sm transition focus:bg-white focus:outline-none focus:ring-4 {{ $errors->profile->has('current_password') ? 'border-red-300 bg-red-50/70 focus:border-red-300 focus:ring-red-100' : 'border-slate-200 bg-slate-50/80 focus:border-sky-300 focus:ring-sky-100' }}"
                                placeholder="Isi jika mengganti email"
                            >
                            <button
                                type="button"
                                @click="show = ! show"
                                class="absolute inset-y-0 right-3 my-auto flex h-10 w-10 items-center justify-center rounded-full text-slate-500 transition hover:bg-sky-50 hover:text-sky-700"
                                aria-label="Tampilkan atau sembunyikan password saat ini"
                            >
                                <svg x-show="!show" class="h-5 w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                    <path d="M2.5 12s3.5-6 9.5-6 9.5 6 9.5 6-3.5 6-9.5 6-9.5-6-9.5-6Z" stroke="currentColor" stroke-width="1.8"/>
                                    <path d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" stroke="currentColor" stroke-width="1.8"/>
                                </svg>
                                <svg x-cloak x-show="show" class="h-5 w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                    <path d="m4 4 16 16" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                                    <path d="M9.2 5.5A9.8 9.8 0 0 1 12 5c6 0 9.5 7 9.5 7a15.2 15.2 0 0 1-3 3.8M6.6 6.8C3.9 8.6 2.5 12 2.5 12s3.5 7 9.5 7c1.6 0 3-.4 4.2-1" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>
                        </div>
                        <p class="mt-2 text-sm leading-6 text-slate-500">
                            Masukkan password saat ini jika Anda ingin mengubah email.
                        </p>
                        @error('current_password', 'profile')
                            <p class="mt-2 text-sm font-semibold text-red-600">{{ $message }}</p>
                        @enderror
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
            </section>

            <section id="personalisasi-wisata" class="rounded-[2rem] border border-sky-100/80 bg-white/90 p-6 shadow-[0_24px_70px_rgba(15,23,42,0.08)] sm:p-8 animate-fade-up animate-delay-150">
                <div class="mb-7">
                    <p class="inline-flex rounded-full border border-sky-100 bg-sky-50/80 px-4 py-2 text-xs font-bold uppercase tracking-[0.22em] text-sky-700">
                        Personalisasi Wisata
                    </p>
                    <h2 class="mt-4 font-display text-3xl font-semibold leading-tight text-slate-950">
                        Preferensi wisata saya.
                    </h2>
                    <p class="mt-3 max-w-2xl text-sm leading-6 text-slate-600">
                        Preferensi ini membantu sistem menyesuaikan rekomendasi dengan wilayah, kategori, dan budget yang Anda sukai.
                    </p>
                </div>

                @if(session('preferences_status'))
                    <div class="mb-6 rounded-3xl border border-sky-100 bg-sky-50 px-5 py-4 text-sm font-semibold text-sky-800">
                        {{ session('preferences_status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('preferences.update') }}" class="space-y-5">
                    @csrf
                    @method('PATCH')

                    <div>
                        <label for="preferred_region" class="mb-2 block text-sm font-bold text-slate-700">Wilayah Preferensi</label>
                        <select id="preferred_region" name="preferred_region" class="min-h-14 w-full rounded-2xl border border-slate-200 bg-slate-50/80 px-5 text-sm font-semibold text-slate-900 shadow-sm transition focus:border-sky-300 focus:bg-white focus:outline-none focus:ring-4 focus:ring-sky-100">
                            <option value="">Semua wilayah</option>
                            @foreach($locations ?? collect() as $location)
                                <option value="{{ $location->nama_kabupaten }}" @selected(old('preferred_region', $preference?->preferred_region) === $location->nama_kabupaten)>
                                    {{ $location->nama_kabupaten }}
                                </option>
                            @endforeach
                        </select>
                        @error('preferred_region', 'preferences')
                            <p class="mt-2 text-sm font-semibold text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <p class="mb-3 block text-sm font-bold text-slate-700">Kategori Wisata Favorit</p>
                        <div class="grid gap-3 sm:grid-cols-2 lg:grid-cols-3">
                            @foreach($categories ?? collect() as $category)
                                <label class="flex min-h-12 cursor-pointer items-center gap-3 rounded-2xl border border-slate-200 bg-slate-50/80 px-4 text-sm font-bold text-slate-700 transition hover:border-sky-100 hover:bg-sky-50">
                                    <input type="checkbox" name="category_ids[]" value="{{ $category->id }}" class="h-4 w-4 accent-sky-700" @checked(in_array((int) $category->id, $selectedCategoryIds, true))>
                                    <span>{{ $category->nama_kategori }}</span>
                                </label>
                            @endforeach
                        </div>
                        @error('category_ids', 'preferences')
                            <p class="mt-2 text-sm font-semibold text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid gap-5 md:grid-cols-3">
                        <div>
                            <label for="price_category" class="mb-2 block text-sm font-bold text-slate-700">Kategori Harga</label>
                            <select id="price_category" name="price_category" class="min-h-14 w-full rounded-2xl border border-slate-200 bg-slate-50/80 px-5 text-sm font-semibold text-slate-900 shadow-sm transition focus:border-sky-300 focus:bg-white focus:outline-none focus:ring-4 focus:ring-sky-100">
                                <option value="">Tidak dibatasi</option>
                                <option value="murah" @selected(old('price_category', $preference?->price_category) === 'murah')>Murah</option>
                                <option value="sedang" @selected(old('price_category', $preference?->price_category) === 'sedang')>Sedang</option>
                                <option value="mahal" @selected(old('price_category', $preference?->price_category) === 'mahal')>Premium</option>
                            </select>
                            @error('price_category', 'preferences')
                                <p class="mt-2 text-sm font-semibold text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="budget_min" class="mb-2 block text-sm font-bold text-slate-700">Budget Minimum</label>
                            <input id="budget_min" name="budget_min" type="number" min="0" max="10000000" step="10000" value="{{ old('budget_min', $preference?->budget_min) }}" class="min-h-14 w-full rounded-2xl border border-slate-200 bg-slate-50/80 px-5 text-sm font-semibold text-slate-900 shadow-sm transition focus:border-sky-300 focus:bg-white focus:outline-none focus:ring-4 focus:ring-sky-100" placeholder="0">
                            @error('budget_min', 'preferences')
                                <p class="mt-2 text-sm font-semibold text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="budget_max" class="mb-2 block text-sm font-bold text-slate-700">Budget Maksimum</label>
                            <input id="budget_max" name="budget_max" type="number" min="0" max="10000000" step="10000" value="{{ old('budget_max', $preference?->budget_max) }}" class="min-h-14 w-full rounded-2xl border border-slate-200 bg-slate-50/80 px-5 text-sm font-semibold text-slate-900 shadow-sm transition focus:border-sky-300 focus:bg-white focus:outline-none focus:ring-4 focus:ring-sky-100" placeholder="500000">
                            @error('budget_max', 'preferences')
                                <p class="mt-2 text-sm font-semibold text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <button type="submit" class="inline-flex min-h-12 w-full items-center justify-center rounded-full bg-sky-700 px-6 text-sm font-bold text-white shadow-[0_14px_34px_rgba(3,105,161,0.22)] transition hover:-translate-y-0.5 hover:bg-sky-800 focus:outline-none focus:ring-4 focus:ring-sky-100 sm:w-auto">
                        Simpan Preferensi Wisata
                    </button>
                </form>
            </section>

            <section class="rounded-[2rem] border border-sky-100/80 bg-white/90 p-6 shadow-[0_24px_70px_rgba(15,23,42,0.08)] sm:p-8 animate-fade-up animate-delay-200">
                <div class="mb-7">
                    <p class="inline-flex rounded-full border border-amber-100 bg-amber-50/80 px-4 py-2 text-xs font-bold uppercase tracking-[0.22em] text-amber-700">
                        Keamanan Akun
                    </p>
                    <h2 class="mt-4 font-display text-3xl font-semibold leading-tight text-slate-950">
                        Ubah password akun.
                    </h2>
                    <p class="mt-3 max-w-2xl text-sm leading-6 text-slate-600">
                        Gunakan password minimal 8 karakter dan simpan hanya untuk Anda.
                    </p>
                </div>

                @if(session('password_status'))
                    <div class="mb-6 rounded-3xl border border-sky-100 bg-sky-50 px-5 py-4 text-sm font-semibold text-sky-800">
                        {{ session('password_status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('user.profile.password.update') }}" class="space-y-5" x-data="{ showCurrent: false, showNew: false, showConfirm: false }">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="password_current_password" class="mb-2 block text-sm font-bold text-slate-700">
                            Password Saat Ini
                        </label>
                        <div class="relative">
                            <input
                                id="password_current_password"
                                name="current_password"
                                :type="showCurrent ? 'text' : 'password'"
                                autocomplete="current-password"
                                class="min-h-14 w-full rounded-2xl border px-5 pr-14 text-base font-semibold text-slate-900 placeholder-slate-400 shadow-sm transition focus:bg-white focus:outline-none focus:ring-4 {{ $errors->password->has('current_password') ? 'border-red-300 bg-red-50/70 focus:border-red-300 focus:ring-red-100' : 'border-slate-200 bg-slate-50/80 focus:border-sky-300 focus:ring-sky-100' }}"
                                placeholder="Masukkan password saat ini"
                            >
                            <button
                                type="button"
                                @click="showCurrent = ! showCurrent"
                                class="absolute inset-y-0 right-3 my-auto flex h-10 w-10 items-center justify-center rounded-full text-slate-500 transition hover:bg-sky-50 hover:text-sky-700"
                                aria-label="Tampilkan atau sembunyikan password saat ini"
                            >
                                <svg x-show="!showCurrent" class="h-5 w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                    <path d="M2.5 12s3.5-6 9.5-6 9.5 6 9.5 6-3.5 6-9.5 6-9.5-6-9.5-6Z" stroke="currentColor" stroke-width="1.8"/>
                                    <path d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" stroke="currentColor" stroke-width="1.8"/>
                                </svg>
                                <svg x-cloak x-show="showCurrent" class="h-5 w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                    <path d="m4 4 16 16" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                                    <path d="M9.2 5.5A9.8 9.8 0 0 1 12 5c6 0 9.5 7 9.5 7a15.2 15.2 0 0 1-3 3.8M6.6 6.8C3.9 8.6 2.5 12 2.5 12s3.5 7 9.5 7c1.6 0 3-.4 4.2-1" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>
                        </div>
                        @error('current_password', 'password')
                            <p class="mt-2 text-sm font-semibold text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid gap-5 md:grid-cols-2">
                        <div>
                            <label for="password" class="mb-2 block text-sm font-bold text-slate-700">
                                Password Baru
                            </label>
                            <div class="relative">
                                <input
                                    id="password"
                                    name="password"
                                    :type="showNew ? 'text' : 'password'"
                                    autocomplete="new-password"
                                    class="min-h-14 w-full rounded-2xl border px-5 pr-14 text-base font-semibold text-slate-900 placeholder-slate-400 shadow-sm transition focus:bg-white focus:outline-none focus:ring-4 {{ $errors->password->has('password') ? 'border-red-300 bg-red-50/70 focus:border-red-300 focus:ring-red-100' : 'border-slate-200 bg-slate-50/80 focus:border-sky-300 focus:ring-sky-100' }}"
                                    placeholder="Minimal 8 karakter"
                                >
                                <button
                                    type="button"
                                    @click="showNew = ! showNew"
                                    class="absolute inset-y-0 right-3 my-auto flex h-10 w-10 items-center justify-center rounded-full text-slate-500 transition hover:bg-sky-50 hover:text-sky-700"
                                    aria-label="Tampilkan atau sembunyikan password baru"
                                >
                                    <svg x-show="!showNew" class="h-5 w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                        <path d="M2.5 12s3.5-6 9.5-6 9.5 6 9.5 6-3.5 6-9.5 6-9.5-6-9.5-6Z" stroke="currentColor" stroke-width="1.8"/>
                                        <path d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" stroke="currentColor" stroke-width="1.8"/>
                                    </svg>
                                    <svg x-cloak x-show="showNew" class="h-5 w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                        <path d="m4 4 16 16" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                                        <path d="M9.2 5.5A9.8 9.8 0 0 1 12 5c6 0 9.5 7 9.5 7a15.2 15.2 0 0 1-3 3.8M6.6 6.8C3.9 8.6 2.5 12 2.5 12s3.5 7 9.5 7c1.6 0 3-.4 4.2-1" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </button>
                            </div>
                            @error('password', 'password')
                                <p class="mt-2 text-sm font-semibold text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password_confirmation" class="mb-2 block text-sm font-bold text-slate-700">
                                Konfirmasi Password Baru
                            </label>
                            <div class="relative">
                                <input
                                    id="password_confirmation"
                                    name="password_confirmation"
                                    :type="showConfirm ? 'text' : 'password'"
                                    autocomplete="new-password"
                                    class="min-h-14 w-full rounded-2xl border px-5 pr-14 text-base font-semibold text-slate-900 placeholder-slate-400 shadow-sm transition focus:bg-white focus:outline-none focus:ring-4 {{ $errors->password->has('password_confirmation') ? 'border-red-300 bg-red-50/70 focus:border-red-300 focus:ring-red-100' : 'border-slate-200 bg-slate-50/80 focus:border-sky-300 focus:ring-sky-100' }}"
                                    placeholder="Ulangi password baru"
                                >
                                <button
                                    type="button"
                                    @click="showConfirm = ! showConfirm"
                                    class="absolute inset-y-0 right-3 my-auto flex h-10 w-10 items-center justify-center rounded-full text-slate-500 transition hover:bg-sky-50 hover:text-sky-700"
                                    aria-label="Tampilkan atau sembunyikan konfirmasi password"
                                >
                                    <svg x-show="!showConfirm" class="h-5 w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                        <path d="M2.5 12s3.5-6 9.5-6 9.5 6 9.5 6-3.5 6-9.5 6-9.5-6-9.5-6Z" stroke="currentColor" stroke-width="1.8"/>
                                        <path d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" stroke="currentColor" stroke-width="1.8"/>
                                    </svg>
                                    <svg x-cloak x-show="showConfirm" class="h-5 w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                        <path d="m4 4 16 16" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                                        <path d="M9.2 5.5A9.8 9.8 0 0 1 12 5c6 0 9.5 7 9.5 7a15.2 15.2 0 0 1-3 3.8M6.6 6.8C3.9 8.6 2.5 12 2.5 12s3.5 7 9.5 7c1.6 0 3-.4 4.2-1" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </button>
                            </div>
                            @error('password_confirmation', 'password')
                                <p class="mt-2 text-sm font-semibold text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <p class="text-sm leading-6 text-slate-500">
                        Gunakan password minimal 8 karakter.
                    </p>

                    <button
                        type="submit"
                        class="inline-flex min-h-12 w-full items-center justify-center rounded-full bg-sky-700 px-6 text-sm font-bold text-white shadow-[0_14px_34px_rgba(3,105,161,0.22)] transition hover:-translate-y-0.5 hover:bg-sky-800 focus:outline-none focus:ring-4 focus:ring-sky-100 sm:w-auto"
                    >
                        Ubah Password
                    </button>
                </form>
            </section>
        </main>
    </section>
</div>
@endsection
