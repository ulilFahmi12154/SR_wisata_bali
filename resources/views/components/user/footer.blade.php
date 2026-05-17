<footer id="kontak" class="mt-0 border-t border-white/10 bg-slate-950 text-slate-300">
    <div class="mx-auto max-w-[1180px] px-4 py-12 sm:px-6 lg:px-8 lg:py-14">
        <div class="grid gap-10 md:grid-cols-[1.25fr_0.8fr_1fr]">
            {{-- Brand --}}
            <div class="max-w-md">
                <a href="{{ route('landingpage') }}" class="group inline-flex items-center gap-3 no-underline">
                    <span class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-2xl border border-sky-400/20 bg-sky-700 shadow-[0_16px_34px_rgba(2,132,199,0.24)] transition-transform duration-200 group-hover:-translate-y-0.5 group-hover:bg-sky-600">
                        <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </span>
                    <span class="font-display text-lg font-semibold tracking-normal text-white">Jelajah Bali</span>
                </a>

                <p class="mt-4 text-sm leading-7 text-slate-400">
                    Platform rekomendasi wisata yang membantu Anda merencanakan perjalanan Bali dengan pilihan destinasi yang lebih relevan, nyaman, dan sesuai preferensi.
                </p>
            </div>

            {{-- Links --}}
            <div>
                <h3 class="text-sm font-semibold uppercase tracking-[0.16em] text-slate-100">Menu</h3>
                <ul class="mt-4 space-y-3 text-sm">
                    <li>
                        <a href="{{ route('about') }}" class="transition hover:text-sky-300">Tentang</a>
                    </li>
                    <li>
                        @auth
                            <a href="{{ route('user.destinations') }}" class="transition hover:text-sky-300">Destinasi</a>
                        @else
                            <a href="{{ route('user.login') }}" class="transition hover:text-sky-300">Destinasi</a>
                        @endauth
                    </li>
                    <li>
                        <a href="{{ route('privacy') }}" class="transition hover:text-sky-300">Kebijakan Privasi</a>
                    </li>
                    <li>
                        <a href="{{ route('terms') }}" class="transition hover:text-sky-300">Ketentuan</a>
                    </li>
                </ul>
            </div>

            {{-- Contact --}}
            <div>
                <h3 class="text-sm font-semibold uppercase tracking-[0.16em] text-slate-100">Kontak</h3>
                <div class="mt-4 space-y-4">
                    <div class="flex items-center gap-3">
                        <span class="flex h-9 w-9 flex-shrink-0 items-center justify-center rounded-full border border-white/10 bg-white/[0.06]">
                            <svg class="h-4 w-4 text-sky-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </span>
                        <span class="text-sm text-slate-400">info@jelajahbali.com</span>
                    </div>

                    <div class="flex items-center gap-3">
                        <span class="flex h-9 w-9 flex-shrink-0 items-center justify-center rounded-full border border-white/10 bg-white/[0.06]">
                            <svg class="h-4 w-4 text-sky-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 011.94.82l-1.15 4.62a1 1 0 01-1.01.79H5.22a10.97 10.97 0 004.95 4.95l1.25-1.25a1 1 0 011.04-.26l4.62 1.15a1 1 0 01.82 1.94V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                        </span>
                        <span class="text-sm text-slate-400">+62 (123) 456-789</span>
                    </div>

                    <a href="https://bali.com/" target="_blank" rel="noopener" class="inline-flex items-center rounded-full border border-white/10 bg-white/[0.06] px-4 py-2 text-sm font-semibold text-slate-200 transition hover:border-sky-300/40 hover:bg-sky-400/10 hover:text-sky-200">
                        Panduan Bali &nearr;
                    </a>
                </div>
            </div>
        </div>

        <div class="mt-10 border-t border-white/10 pt-7 text-center">
            <p class="text-sm text-slate-400">&copy; {{ date('Y') }} Kelompok 2. Semua hak dilindungi.</p>
            <p class="mt-2 text-xs text-slate-500">Dibuat untuk perencanaan perjalanan Bali yang lebih cerdas.</p>
        </div>
    </div>
</footer>
