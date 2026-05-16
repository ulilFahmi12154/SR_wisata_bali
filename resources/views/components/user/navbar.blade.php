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
                    <div class="flex items-center gap-2 sm:gap-3">
                        <a
                            href="{{ route('user.profile') }}"
                            class="flex h-10 w-10 items-center justify-center rounded-full border border-sky-100 bg-sky-50 text-sm font-bold text-sky-700 shadow-sm transition hover:-translate-y-0.5 hover:bg-sky-100"
                            aria-label="Profil pengguna"
                        >
                            {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
                        </a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button
                                type="submit"
                                class="inline-flex min-h-10 items-center rounded-full px-3.5 text-sm font-semibold text-slate-600 transition hover:bg-slate-100 hover:text-slate-900"
                            >
                                Keluar
                            </button>
                        </form>
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
