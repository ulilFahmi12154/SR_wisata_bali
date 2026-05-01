@php
    $routePrefix = auth()->check() ? 'user.' : '';
@endphp

<header class="sticky top-0 z-50 bg-white shadow-sm border-b border-slate-200">
    <div class="max-w-7xl mx-auto px-4 md:px-6 py-4">
        <div class="flex items-center justify-between">
            {{-- Logo --}}
            <a href="@if(auth()->check()){{ route('user.destinations') }}@else{{ route('about') }}@endif" class="flex items-center gap-2">
                <div class="w-9 h-9 rounded-lg bg-brand-600 flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <span class="font-display font-semibold text-xl text-slate-900">Jelajah Bali</span>
            </a>

            {{-- Desktop Navigation --}}
            <nav class="hidden md:flex items-center gap-8">
                @auth
                <a href="{{ route('user.destinations') }}" 
                   class="text-sm font-medium {{ request()->routeIs('user.destinations') ? 'text-brand-600' : 'text-slate-600 hover:text-slate-900' }} transition">
                    Destinasi
                </a>
                @endauth
                <a href="{{ route('about') }}" 
                   class="text-sm font-medium {{ request()->routeIs('about') ? 'text-brand-600' : 'text-slate-600 hover:text-slate-900' }} transition">
                    Tentang
                </a>
            </nav>

            {{-- Auth Section --}}
            @auth
                <div class="flex items-center gap-4">
                    <a href="{{ route('user.profile') }}" class="w-10 h-10 rounded-full bg-brand-100 flex items-center justify-center text-brand-600 font-semibold hover:bg-brand-200 transition">
                        {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="hidden md:block">
                        @csrf
                        <button type="submit" class="text-sm font-medium text-slate-600 hover:text-slate-900 transition">
                            Keluar
                        </button>
                    </form>
                </div>
            @else
                <a href="{{ route('login') }}" class="px-4 py-2 bg-brand-600 text-white rounded-lg text-sm font-medium hover:bg-brand-700 transition">
                    Masuk
                </a>
            @endauth
        </div>
    </div>
</header>