@extends('layouts.app')

@section('body')
<div class="min-h-screen flex">

    {{-- ===== LEFT PANEL: Hero Image ===== --}}
    <div class="hidden lg:flex lg:w-1/2 relative overflow-hidden">
        {{-- Background image --}}
        <img
            src="{{ $heroBg ?? asset('images/destination/Destinasi_Wilayah_Bali.jpg') }}"
            alt="Destinasi Wisata Bali"
            class="absolute inset-0 w-full h-full object-cover"
        >

        {{-- Dark overlay gradient --}}
        <div class="absolute inset-0 bg-gradient-to-br from-brand-950/80 via-brand-900/60 to-transparent"></div>

        {{-- Decorative pattern overlay --}}
        <div class="absolute inset-0 opacity-10"
             style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 32px 32px;">
        </div>

        {{-- Content on hero --}}
        <div class="relative z-10 flex flex-col justify-between p-12 w-full">

            {{-- Logo --}}
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl bg-white/20 backdrop-blur-sm flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <span class="text-white font-display font-semibold text-xl tracking-wide">Jelajah Bali</span>
            </div>

            {{-- Hero tagline --}}
            <div class="space-y-4">
                <p class="text-brand-200 text-sm font-medium uppercase tracking-widest">
                    Sistem Rekomendasi Wisata
                </p>
                <h1 class="font-display text-white text-4xl xl:text-5xl leading-tight">
                    Temukan Sisi<br>
                    <span class="text-brand-300">Bali</span> yang<br>
                    Belum Terjamah.
                </h1>
                <p class="text-white/70 text-base max-w-sm leading-relaxed">
                    Rekomendasi destinasi personal berdasarkan preferensi perjalanan Anda.
                </p>

                {{-- Stats strip --}}
                <div class="flex gap-8 pt-4">
                    <div>
                        <div class="text-white font-display font-bold text-2xl">142K+</div>
                        <div class="text-white/60 text-xs mt-0.5">Wisatawan</div>
                    </div>
                    <div class="w-px bg-white/20"></div>
                    <div>
                        <div class="text-white font-display font-bold text-2xl">4,760</div>
                        <div class="text-white/60 text-xs mt-0.5">Destinasi</div>
                    </div>
                    <div class="w-px bg-white/20"></div>
                    <div>
                        <div class="text-white font-display font-bold text-2xl">24.5K</div>
                        <div class="text-white/60 text-xs mt-0.5">Ulasan</div>
                    </div>
                </div>
            </div>

            {{-- Bottom credit --}}
            <p class="text-white/40 text-xs">
                © {{ date('Y') }} Jelajah Bali. Hak cipta dilindungi.
            </p>
        </div>
    </div>

    {{-- ===== RIGHT PANEL: Form ===== --}}
    <div class="flex-1 flex flex-col min-h-screen bg-white">

        {{-- Mobile logo (shown only on small screens) --}}
        <div class="lg:hidden flex items-center gap-2 px-6 pt-6">
            <div class="w-8 h-8 rounded-lg bg-brand-600 flex items-center justify-center">
                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                </svg>
            </div>
            <span class="font-display font-semibold text-lg text-brand-800">Jelajah Bali</span>
        </div>

        {{-- Form area --}}
        <div class="flex-1 flex items-center justify-center px-6 py-10 lg:px-16">
            <div class="w-full max-w-md">

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

        {{-- Footer strip --}}
        <div class="px-6 py-4 text-center lg:text-left lg:px-16 border-t border-slate-100">
            <p class="text-slate-400 text-xs">
                Dengan masuk, Anda menyetujui
                <a href="#" class="text-brand-600 hover:underline">Syarat &amp; Ketentuan</a>
                dan
                <a href="#" class="text-brand-600 hover:underline">Kebijakan Privasi</a>
                kami.
            </p>
        </div>
    </div>

</div>
@endsection