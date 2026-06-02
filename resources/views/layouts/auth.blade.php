@extends('layouts.app')

@section('body')
<div class="min-h-screen bg-gradient-to-br from-stone-50 via-sky-50 to-amber-50/40 text-slate-900 lg:flex">

    {{-- ===== LEFT PANEL: Hero Image ===== --}}
    <aside class="relative hidden min-h-screen overflow-hidden bg-slate-900 lg:flex lg:w-[48%] xl:w-1/2">
        {{-- Background image --}}
        <img
            src="{{ $heroBg ?? asset('images/destination/Destinasi_Wilayah_Bali.jpg') }}"
            alt="Destinasi Wisata Bali"
            class="absolute inset-0 h-full w-full scale-[1.03] object-cover brightness-[0.58] contrast-[1.04] saturate-[0.9]"
        >

        {{-- Soft image treatment --}}
        <div class="absolute inset-0 bg-gradient-to-r from-slate-950/78 via-slate-950/50 to-slate-950/18"></div>
        <div class="absolute inset-0 bg-gradient-to-br from-slate-950/32 via-transparent to-slate-950/18"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/42 via-transparent to-slate-950/12"></div>
        <div class="absolute inset-0 opacity-[0.025] [background-image:radial-gradient(circle_at_2px_2px,white_1px,transparent_0)] [background-size:30px_30px]"></div>

        {{-- Content on hero --}}
        <div class="relative z-10 flex min-h-screen w-full flex-col p-10 xl:p-14">

            <div class="space-y-14 xl:space-y-16">
                {{-- Logo --}}
                <div class="flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-2xl border border-white/25 bg-slate-950/30 backdrop-blur-sm">
                        <svg class="h-4 w-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <span class="font-display text-lg font-semibold tracking-normal text-white">Jelajah Bali</span>
                </div>

                {{-- Hero tagline --}}
                <div class="max-w-lg space-y-7">
                    <div class="space-y-4">
                        <p class="text-xs font-semibold uppercase tracking-[0.18em] text-white/80">
                            Sistem Rekomendasi Wisata
                        </p>
                        <h1 class="font-display text-[2.35rem] leading-[1.14] text-white xl:text-[2.7rem]">
                            Temukan Sisi<br>
                            <span class="text-amber-100">Bali</span> yang<br>
                            Belum Terjamah.
                        </h1>
                        <p class="max-w-sm text-sm leading-7 text-white/85 xl:text-[0.95rem]">
                            Rekomendasi destinasi personal berdasarkan preferensi perjalanan Anda.
                        </p>
                    </div>

                    {{-- Stats strip --}}
                    <div class="grid max-w-[25rem] grid-cols-3 overflow-hidden rounded-3xl border border-white/24 bg-slate-950/30 shadow-[0_18px_54px_rgba(15,23,42,0.18)] backdrop-blur-xl backdrop-saturate-150">
                        <div class="px-4 py-4">
                            <div class="font-display text-[1.45rem] font-bold leading-none text-white">142K+</div>
                            <div class="mt-1.5 text-xs font-medium text-white/75">Wisatawan</div>
                        </div>
                        <div class="border-x border-white/15 px-4 py-4">
                            <div class="font-display text-[1.45rem] font-bold leading-none text-white">4,760</div>
                            <div class="mt-1.5 text-xs font-medium text-white/75">Destinasi</div>
                        </div>
                        <div class="px-4 py-4">
                            <div class="font-display text-[1.45rem] font-bold leading-none text-white">24.5K</div>
                            <div class="mt-1.5 text-xs font-medium text-white/75">Ulasan</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Bottom credit --}}
            <p class="mt-auto pt-10 text-xs font-medium text-white/72">
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

                <div class="rounded-[2rem] border border-slate-200/70 bg-white/95 p-6 shadow-[0_24px_64px_rgba(15,23,42,0.10)] shadow-sky-950/5 backdrop-blur sm:p-8">
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
        <div class="border-t border-sky-100/80 bg-white/65 px-6 py-4 text-center lg:px-16 lg:text-left">
            <p class="text-xs leading-relaxed text-slate-600">
                Dengan masuk, Anda menyetujui
                <a href="{{ route('terms') }}" class="font-semibold text-sky-800 hover:text-sky-900 hover:underline">Syarat &amp; Ketentuan</a>
                dan
                <a href="{{ route('privacy') }}" class="font-semibold text-sky-800 hover:text-sky-900 hover:underline">Kebijakan Privasi</a>
                kami.
            </p>
        </div>
    </main>

</div>
@endsection
