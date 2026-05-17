<header class="sticky top-0 z-50 border-b border-slate-200/70 bg-white/85 shadow-[0_14px_36px_rgba(15,23,42,0.06)] backdrop-blur-xl">
    <div class="mx-auto max-w-[1180px] px-4 sm:px-6 lg:px-8">
        <div class="flex min-h-[68px] items-center justify-between gap-4">
            {{-- Logo --}}
            <a href="{{ route('landingpage') }}" class="group flex min-w-0 items-center gap-3 no-underline">
                <span class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-2xl border border-sky-600/20 bg-sky-700 shadow-[0_12px_28px_rgba(2,132,199,0.20)] transition-transform duration-200 group-hover:-translate-y-0.5 group-hover:bg-sky-800">
                    <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </span>
                <span class="truncate font-display text-lg font-semibold tracking-normal text-slate-900">
                    Jelajah Bali
                </span>
            </a>

            <div class="flex min-w-0 items-center gap-2 sm:gap-4">
                {{-- Desktop Navigation --}}
                <nav class="hidden items-center gap-2 md:flex">
                    @auth
                        <a
                            href="{{ route('user.destinations') }}"
                            class="inline-flex min-h-10 items-center rounded-full px-3.5 text-sm font-semibold transition
                                   {{ request()->routeIs('user.destinations*') ? 'bg-sky-50 text-sky-700 shadow-[inset_0_0_0_1px_rgba(14,116,144,0.10)]' : 'text-slate-600 hover:bg-sky-50/80 hover:text-sky-800' }}"
                        >
                            Destinasi
                        </a>
                    @endauth

                    <a
                        href="{{ route('about') }}"
                        class="inline-flex min-h-10 items-center rounded-full px-3.5 text-sm font-semibold transition
                               {{ request()->routeIs('about') ? 'bg-sky-50 text-sky-700 shadow-[inset_0_0_0_1px_rgba(14,116,144,0.10)]' : 'text-slate-600 hover:bg-sky-50/80 hover:text-sky-800' }}"
                    >
                        Tentang
                    </a>
                </nav>

                {{-- Auth Section --}}
                @auth
                    @php
                        $userName = trim(auth()->user()->name ?? '');
                        $userName = $userName !== '' ? $userName : 'User';
                        $userInitial = mb_strtoupper(mb_substr($userName, 0, 1));
                    @endphp

                    <div class="flex items-center gap-2 sm:gap-3">
                        <a
                            href="{{ route('user.profile') }}"
                            class="flex h-10 w-10 items-center justify-center rounded-full border border-sky-100 bg-sky-50 text-sm font-bold text-sky-700 shadow-sm transition hover:-translate-y-0.5 hover:bg-sky-100"
                            title="Profil {{ $userName }}"
                            aria-label="Buka profil {{ $userName }}"
                        >
                            {{ $userInitial }}
                        </a>

                        <div x-data="{ showLogoutConfirm: false }" @keydown.escape.window="showLogoutConfirm = false">
                            <button
                                type="button"
                                @click="showLogoutConfirm = true"
                                class="inline-flex min-h-10 items-center rounded-full px-3.5 text-sm font-semibold text-slate-600 transition hover:bg-slate-100 hover:text-slate-900"
                            >
                                Keluar
                            </button>

                            <template x-teleport="body">
                                <div
                                    x-cloak
                                    x-show="showLogoutConfirm"
                                    x-transition.opacity
                                    class="fixed inset-0 z-[100] flex min-h-screen items-center justify-center overflow-y-auto bg-slate-950/35 px-4 py-8 backdrop-blur-sm"
                                    aria-labelledby="logout-confirm-title"
                                    aria-modal="true"
                                    role="dialog"
                                >
                                    <div class="absolute inset-0" @click="showLogoutConfirm = false" aria-hidden="true"></div>

                                    <div
                                        x-show="showLogoutConfirm"
                                        x-transition:enter="transition ease-out duration-200"
                                        x-transition:enter-start="opacity-0 translate-y-4 scale-95"
                                        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                                        x-transition:leave="transition ease-in duration-150"
                                        x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                                        x-transition:leave-end="opacity-0 translate-y-4 scale-95"
                                        class="relative my-auto w-full max-w-md overflow-hidden rounded-[2rem] border border-sky-100 bg-white p-6 text-left shadow-[0_28px_80px_rgba(15,23,42,0.22)]"
                                    >
                                        <div class="flex items-start gap-4">
                                            <div class="flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-2xl bg-sky-50 text-sky-700">
                                                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                                    <path d="M15 17.5 20.5 12 15 6.5" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round"/>
                                                    <path d="M20 12H9" stroke="currentColor" stroke-width="1.9" stroke-linecap="round"/>
                                                    <path d="M11 4H6.5A2.5 2.5 0 0 0 4 6.5v11A2.5 2.5 0 0 0 6.5 20H11" stroke="currentColor" stroke-width="1.9" stroke-linecap="round"/>
                                                </svg>
                                            </div>
                                            <div class="min-w-0">
                                                <h2 id="logout-confirm-title" class="font-display text-2xl font-semibold leading-tight text-slate-950">
                                                    Yakin ingin keluar?
                                                </h2>
                                                <p class="mt-3 text-sm leading-6 text-slate-600">
                                                    Sesi Anda akan diakhiri dan Anda perlu masuk kembali untuk menggunakan fitur rekomendasi wisata.
                                                </p>
                                            </div>
                                        </div>

                                        <div class="mt-7 flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">
                                            <button
                                                type="button"
                                                @click="showLogoutConfirm = false"
                                                class="inline-flex min-h-11 items-center justify-center rounded-full border border-slate-200 bg-white px-5 text-sm font-bold text-slate-700 transition hover:bg-sky-50 hover:text-sky-800"
                                            >
                                                Batal
                                            </button>

                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <button
                                                    type="submit"
                                                    class="inline-flex min-h-11 w-full items-center justify-center rounded-full bg-sky-700 px-5 text-sm font-bold text-white shadow-[0_14px_34px_rgba(3,105,161,0.22)] transition hover:-translate-y-0.5 hover:bg-sky-800 sm:w-auto"
                                                >
                                                    Keluar
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                @else
                    <div class="flex items-center gap-2">
                        <a
                            href="{{ route('user.register') }}"
                            class="hidden min-h-10 items-center rounded-full border border-slate-200 bg-white/75 px-4 text-sm font-semibold text-slate-700 shadow-sm transition hover:-translate-y-0.5 hover:border-sky-200 hover:bg-sky-50 hover:text-sky-800 sm:inline-flex"
                        >
                            Daftar
                        </a>

                        <a
                            href="{{ route('user.login') }}"
                            class="inline-flex min-h-10 items-center rounded-full border border-sky-700 bg-sky-700 px-4 text-sm font-bold text-white shadow-[0_14px_32px_rgba(2,132,199,0.18)] transition hover:-translate-y-0.5 hover:border-sky-800 hover:bg-sky-800 hover:shadow-[0_18px_38px_rgba(2,132,199,0.22)]"
                        >
                            Masuk
                        </a>
                    </div>
                @endauth
            </div>
        </div>

        <nav class="flex items-center gap-2 overflow-x-auto border-t border-slate-200/60 py-2 md:hidden">
            @auth
                <a
                    href="{{ route('user.destinations') }}"
                    class="inline-flex min-h-9 flex-shrink-0 items-center rounded-full px-3 text-sm font-semibold transition
                           {{ request()->routeIs('user.destinations*') ? 'bg-sky-50 text-sky-700 shadow-[inset_0_0_0_1px_rgba(14,116,144,0.10)]' : 'text-slate-600 hover:bg-sky-50/80 hover:text-sky-800' }}"
                >
                    Destinasi
                </a>
            @endauth

            <a
                href="{{ route('about') }}"
                class="inline-flex min-h-9 flex-shrink-0 items-center rounded-full px-3 text-sm font-semibold transition
                       {{ request()->routeIs('about') ? 'bg-sky-50 text-sky-700 shadow-[inset_0_0_0_1px_rgba(14,116,144,0.10)]' : 'text-slate-600 hover:bg-sky-50/80 hover:text-sky-800' }}"
            >
                Tentang
            </a>

            @guest
                <a
                    href="{{ route('user.register') }}"
                    class="inline-flex min-h-9 flex-shrink-0 items-center rounded-full border border-slate-200 bg-white/75 px-3 text-sm font-semibold text-slate-700 shadow-sm transition hover:border-sky-200 hover:bg-sky-50 hover:text-sky-800 sm:hidden"
                >
                    Daftar
                </a>
            @endguest
        </nav>
    </div>
</header>
