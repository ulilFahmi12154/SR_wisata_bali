@extends('layouts.app')

@section('body')
<div class="min-h-screen bg-gradient-to-br from-stone-50 via-sky-50 to-amber-50/40 text-slate-800 lg:flex">

    {{-- ===== LEFT PANEL: Hero Image ===== --}}
    <aside class="relative hidden min-h-screen overflow-hidden bg-slate-900 lg:flex lg:w-[48%] xl:w-1/2">
        {{-- Background image --}}
        <img
            src="{{ $heroBg ?? asset('images/destination/Destinasi_Wilayah_Bali.jpg') }}"
            alt="Destinasi Wisata Bali"
            class="absolute inset-0 h-full w-full scale-[1.02] object-cover brightness-[0.82] contrast-[0.92] saturate-[0.82]"
        >

        {{-- Soft image treatment --}}
        <div class="absolute inset-0 bg-gradient-to-br from-slate-950/35 via-slate-900/15 to-transparent"></div>
        <div class="absolute inset-0 bg-gradient-to-tr from-amber-100/20 via-stone-50/5 to-sky-100/10"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/28 via-transparent to-white/10"></div>
        <div class="absolute inset-0 opacity-[0.035] [background-image:radial-gradient(circle_at_2px_2px,white_1px,transparent_0)] [background-size:30px_30px]"></div>

        {{-- Content on hero --}}
        <div class="relative z-10 flex w-full flex-col justify-between p-10 xl:p-14">

            {{-- Logo --}}
            <div class="flex items-center gap-3">
                <div class="flex h-11 w-11 items-center justify-center rounded-2xl border border-white/10 bg-white/[0.07] backdrop-blur-sm">
                    <svg class="h-5 w-5 text-stone-50/85" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <span class="font-display text-xl font-semibold tracking-normal text-stone-50/90">Jelajah Bali</span>
            </div>

            {{-- Hero tagline --}}
            <div class="max-w-xl space-y-6">
                <div class="space-y-4">
                    <p class="text-sm font-semibold uppercase tracking-widest text-stone-100/70">
                        Sistem Rekomendasi Wisata
                    </p>
                    <h1 class="font-display text-4xl leading-tight text-stone-50/90 xl:text-5xl">
                        Temukan Sisi<br>
                        <span class="text-amber-100/85">Bali</span> yang<br>
                        Belum Terjamah.
                    </h1>
                    <p class="max-w-sm text-base leading-relaxed text-stone-100/70">
                        Rekomendasi destinasi personal berdasarkan preferensi perjalanan Anda.
                    </p>
                </div>

                {{-- Stats strip --}}
                <div class="grid max-w-md grid-cols-3 overflow-hidden rounded-3xl border border-white/10 bg-white/[0.18] shadow-[0_18px_48px_rgba(15,23,42,0.12)] backdrop-blur-xl">
                    <div class="px-4 py-4">
                        <div class="font-display text-2xl font-bold text-stone-50/90">142K+</div>
                        <div class="mt-1 text-xs text-stone-100/60">Wisatawan</div>
                    </div>
                    <div class="border-x border-white/[0.08] px-4 py-4">
                        <div class="font-display text-2xl font-bold text-stone-50/90">4,760</div>
                        <div class="mt-1 text-xs text-stone-100/60">Destinasi</div>
                    </div>
                    <div class="px-4 py-4">
                        <div class="font-display text-2xl font-bold text-stone-50/90">24.5K</div>
                        <div class="mt-1 text-xs text-stone-100/60">Ulasan</div>
                    </div>
                </div>
            </div>

            {{-- Bottom credit --}}
            <p class="text-xs text-stone-100/50">
                &copy; {{ date('Y') }} Jelajah Bali. Hak cipta dilindungi.
            </p>
        </div>
    </aside>

    {{-- ===== RIGHT PANEL: Form ===== --}}
    <main class="flex min-h-screen flex-1 flex-col">

        {{-- Form area --}}
        <div class="flex flex-1 items-center justify-center px-5 py-8 sm:px-8 lg:px-12 xl:px-16">
            <div class="w-full max-w-md">

                {{-- Mobile logo (shown only on small screens) --}}
                <div class="mb-8 flex items-center justify-center gap-3 lg:hidden">
                    <div class="flex h-10 w-10 items-center justify-center rounded-2xl bg-sky-600 shadow-sm shadow-sky-200">
                        <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        </svg>
                    </div>
                    <span class="font-display text-xl font-semibold text-slate-800">Jelajah Bali</span>
                </div>

                <div class="rounded-[2rem] border border-white/80 bg-white/85 p-6 shadow-[0_24px_64px_rgba(15,23,42,0.08)] shadow-sky-950/5 backdrop-blur sm:p-8">
                    {{-- Alert messages --}}
                    @if (session('success'))
                        <x-ui.alert type="success" :message="session('success')" class="mb-6" />
                    @endif
                    @if (session('error'))
                        <x-ui.alert type="error" :message="session('error')" class="mb-6" />
                    @endif
                    @if ($errors->any())
                        <x-ui.alert type="error" message="{{ $errors->first() }}" class="mb-6" />
                    @endif

                    {{-- Page content --}}
                    @yield('auth-content')
                </div>

            </div>
        </div>

        {{-- Footer strip --}}
        <div class="border-t border-sky-100/80 px-6 py-4 text-center lg:px-16 lg:text-left">
            <p class="text-xs leading-relaxed text-slate-500">
                Dengan masuk, Anda menyetujui
                <a href="#" class="font-medium text-sky-700 hover:text-sky-800 hover:underline">Syarat &amp; Ketentuan</a>
                dan
                <a href="#" class="font-medium text-sky-700 hover:text-sky-800 hover:underline">Kebijakan Privasi</a>
                kami.
            </p>
        </div>
    </main>

</div>
@endsection
