@extends('layouts.app')

@section('topbar_title', 'Dashboard')

@section('title', 'Dashboard — Admin Jelajah')

@section('body')
<div class="flex-1 flex flex-col min-h-screen bg-gray-50/50">

    {{-- MEMANGGIL SIDEBAR KOMPONEN --}}
    @include('components.admin.sidebar')

    {{-- KONTEN UTAMA (Kanan) --}}
    <main class="flex-1 pl-64 min-h-screen flex flex-col justify-between">
        
        <div class="p-8 max-w-7xl w-full mx-auto space-y-8">
            
            {{-- MEMANGGIL TOPBAR KOMPONEN --}}
            @include('components.admin.topbar')

            {{-- 3 COUNTER STATS CARDS --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                {{-- Card 1: Total User --}}
                <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between">
                    <div class="space-y-1">
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Total User</p>
                        <h3 class="text-2xl font-extrabold text-slate-800">{{ number_format($stats['total_user']) }}</h3>
                        <p class="text-[10px] text-emerald-600 font-bold flex items-center gap-0.5">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 10.5L12 3m0 0l7.5 7.5M12 3v18"/></svg>
                            {{ $stats['persentase_user_baru'] }}
                        </p>
                    </div>
                    <div class="p-4 bg-slate-50 rounded-xl text-slate-500">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                </div>

                {{-- Card 2: Total Wisata --}}
                <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between">
                    <div class="space-y-1">
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Total Wisata</p>
                        <h3 class="text-2xl font-extrabold text-slate-800">{{ $stats['total_wisata'] }}</h3>
                        <p class="text-[10px] text-slate-400 font-medium">Aktif & Terverifikasi</p>
                    </div>
                    <div class="p-4 bg-emerald-50 text-emerald-600 rounded-xl">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                </div>

                {{-- Card 3: Total Kunjungan --}}
                <div class="bg-[#1e617a] p-6 rounded-2xl text-white shadow-md flex items-center justify-between">
                    <div class="space-y-1">
                        <p class="text-[10px] font-bold text-sky-200 uppercase tracking-wider">Total Kunjungan</p>
                        <h3 class="text-2xl font-extrabold">{{ $stats['total_kunjungan'] }}</h3>
                        <p class="text-[10px] text-sky-200/80 font-medium">Interaksi 24 jam terakhir</p>
                    </div>
                    <div class="p-4 bg-white/10 rounded-xl text-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </div>
                </div>
            </div>

            {{-- DUA BLOK UTAMA BAWAH (Grid 3:2) --}}
            <div class="grid grid-cols-1 lg:grid-cols-5 gap-6">
                
                {{-- KIRI: Destinasi Terpopuler --}}
                <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm lg:col-span-3 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="font-bold text-slate-800 text-sm tracking-tight">Destinasi Terpopuler</h3>
                            <a href="{{ route('admin.destinations.index') }}" class="text-xs font-semibold text-slate-500 hover:text-sky-700 flex items-center gap-1 transition-colors">
                                Lihat Semua 
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                            </a>
                        </div>

                        <div class="space-y-5">
                            @foreach($popularDestinations as $dest)
                            <div class="flex items-center gap-4">
                                <div class="relative w-16 h-12 flex-shrink-0 rounded-lg overflow-hidden group">
                                    <img src="{{ $dest['image'] }}" class="w-full h-full object-cover" alt="Image">
                                    <span class="absolute top-1 left-1 text-[8px] font-extrabold px-1 py-0.5 rounded @if($loop->first) bg-amber-500 text-white @else bg-slate-800/85 text-slate-100 @endif">
                                        {{ $dest['rank'] }}
                                    </span>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center justify-between text-xs mb-1.5">
                                        <div>
                                            <h4 class="font-bold text-slate-800 truncate">{{ $dest['name'] }}</h4>
                                            <p class="text-[10px] text-slate-400 flex items-center gap-0.5 mt-0.5">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                                {{ $dest['location'] }}
                                            </p>
                                        </div>
                                        <span class="font-bold text-slate-700">{{ $dest['views'] }} <span class="text-[10px] font-normal text-slate-400">views</span></span>
                                    </div>
                                    <div class="w-full bg-slate-100 h-1.5 rounded-full overflow-hidden">
                                        <div class="bg-[#1e617a] h-full rounded-full transition-all duration-500" style="width: {{ $dest['percentage'] }}%"></div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- KANAN: Aktivitas Terkini --}}
                <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm lg:col-span-2 flex flex-col justify-between">
                    <div>
                        <div class="mb-5">
                            <h3 class="font-bold text-slate-800 text-sm tracking-tight">Aktivitas Terkini</h3>
                            <p class="text-[11px] text-slate-400 mt-0.5">Riwayat aksi user dalam sistem</p>
                        </div>

                        <div class="relative pl-6 border-l-2 border-slate-100 space-y-6 ml-2.5">
                            @foreach($activities as $act)
                            <div class="relative">
                                <span class="absolute -left-[35px] top-0.5 p-1 rounded-full bg-white border shadow-sm">
                                    @if($act['icon'] == 'search')
                                        <svg class="w-3 h-3 text-sky-600" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                                    @elseif($act['icon'] == 'login')
                                        <svg class="w-3 h-3 text-emerald-600" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                    @elseif($act['icon'] == 'register')
                                        <svg class="w-3 h-3 text-amber-600" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                                    @else
                                        <svg class="w-3 h-3 text-purple-600" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                    @endif
                                </span>
                                <div class="text-xs leading-relaxed">
                                    <p class="text-slate-600">
                                        <span class="font-bold text-slate-800">{{ $act['user'] }}</span> {{ $act['action'] }}
                                    </p>
                                    <span class="text-[10px] text-slate-400 font-medium block mt-0.5">{{ $act['time'] }}</span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <button class="w-full mt-5 text-center text-xs font-semibold text-slate-400 hover:text-slate-600 py-2.5 border border-dashed border-slate-200 rounded-xl hover:bg-slate-50 transition-all">
                        Lihat Selengkapnya
                    </button>
                </div>
            </div>
        </div>

        {{-- FOOTER BAWAH --}}
        <footer class="w-full max-w-7xl mx-auto px-8 py-5 border-t border-slate-200/50 text-xs text-slate-400 flex flex-col sm:flex-row items-center justify-between gap-2">
            <div class="flex items-center gap-4">
                <span class="flex items-center gap-1.5 text-emerald-600 font-semibold">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span> System Online
                </span>
                <span>v2.4.0 (Petualangan Update)</span>
            </div>
            <div>© {{ date('Y') }} Jelajah Bali Management System.</div>
        </footer>

    </main>
</div>
@endsection