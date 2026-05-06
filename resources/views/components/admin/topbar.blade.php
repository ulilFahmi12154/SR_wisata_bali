{{-- Top Navigation Bar for Admin Panel --}}
<div class="sticky top-0 z-40 bg-white border-b border-slate-200 shadow-sm">
    <div class="flex items-center justify-between px-6 py-4">
        {{-- Breadcrumbs --}}
        <nav class="flex items-center gap-2 text-sm">
            <a href="{{ route('admin.dashboard') }}" class="text-slate-600 hover:text-slate-900 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
            </a>
            @if(!request()->routeIs('admin.dashboard'))
                <span class="text-slate-300">/</span>
                <span class="text-slate-600 font-medium">{{ $breadcrumb ?? Request::path() }}</span>
            @endif
        </nav>

        {{-- Right Section: Notifications & User Menu --}}
        <div class="flex items-center gap-4">
            {{-- Notifications --}}
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open"
                        class="relative p-2 text-slate-600 hover:text-slate-900 hover:bg-slate-100 rounded-lg transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                    </svg>
                    <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                </button>

                {{-- Notifications Dropdown --}}
                <div x-show="open"
                     @click.outside="open = false"
                     x-transition
                     class="absolute right-0 mt-2 w-80 bg-white border border-slate-200 rounded-xl shadow-lg p-3 space-y-3">
                    <div class="font-semibold text-slate-900 text-sm">Notifikasi</div>

                    <div class="space-y-2 max-h-64 overflow-y-auto">
                        <div class="p-3 bg-blue-50 border border-blue-200 rounded-lg">
                            <p class="text-sm font-medium text-slate-900">Destinasi Baru</p>
                            <p class="text-xs text-slate-600 mt-1">Tambahan destinasi telah ditambahkan ke sistem</p>
                            <p class="text-xs text-slate-400 mt-2">5 menit yang lalu</p>
                        </div>
                        <div class="p-3 bg-emerald-50 border border-emerald-200 rounded-lg">
                            <p class="text-sm font-medium text-slate-900">Pengguna Baru</p>
                            <p class="text-xs text-slate-600 mt-1">3 pengguna baru telah mendaftar</p>
                            <p class="text-xs text-slate-400 mt-2">15 menit yang lalu</p>
                        </div>
                        <div class="p-3 bg-amber-50 border border-amber-200 rounded-lg">
                            <p class="text-sm font-medium text-slate-900">Review Menunggu</p>
                            <p class="text-xs text-slate-600 mt-1">Ada 5 ulasan destinasi menunggu persetujuan</p>
                            <p class="text-xs text-slate-400 mt-2">1 jam yang lalu</p>
                        </div>
                    </div>

                    <button class="w-full text-center py-2 text-sm text-blue-600 hover:text-blue-700 font-medium">
                        Lihat Semua Notifikasi
                    </button>
                </div>
            </div>

            {{-- Separator --}}
            <div class="w-px h-6 bg-slate-200"></div>

            {{-- User Menu --}}
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open"
                        class="flex items-center gap-2 p-1.5 rounded-lg hover:bg-slate-100 transition-colors">
                    <img src="{{ Auth::user()->avatar_url ?? 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->name ?? 'Admin').'&background=2E86C1&color=fff&size=80' }}"
                         alt="{{ Auth::user()->name ?? 'Admin' }}"
                         class="w-8 h-8 rounded-full">
                    <div class="text-left hidden sm:block">
                        <p class="text-sm font-medium text-slate-900">{{ Auth::user()->name ?? 'Admin' }}</p>
                        <p class="text-xs text-slate-500">Administrator</p>
                    </div>
                    <svg :class="open ? 'rotate-180' : ''" class="w-4 h-4 text-slate-600 transition-transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                    </svg>
                </button>

                {{-- User Dropdown Menu --}}
                <div x-show="open"
                     @click.outside="open = false"
                     x-transition
                     class="absolute right-0 mt-2 w-56 bg-white border border-slate-200 rounded-xl shadow-lg overflow-hidden">

                    <div class="p-4 bg-slate-50 border-b border-slate-200">
                        <p class="text-sm font-semibold text-slate-900">{{ Auth::user()->name ?? 'Admin' }}</p>
                        <p class="text-xs text-slate-500 mt-1">{{ Auth::user()->email ?? 'admin@example.com' }}</p>
                    </div>

                    <div class="p-2 space-y-1">
                        <a href="#" class="flex items-center gap-3 px-3 py-2 text-sm text-slate-700 hover:bg-slate-100 rounded-lg transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            <span>Profil Saya</span>
                        </a>
                        <a href="#" class="flex items-center gap-3 px-3 py-2 text-sm text-slate-700 hover:bg-slate-100 rounded-lg transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <span>Pengaturan</span>
                        </a>
                    </div>

                    <div class="p-2 border-t border-slate-200">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full flex items-center gap-3 px-3 py-2 text-sm text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                </svg>
                                <span>Keluar</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
