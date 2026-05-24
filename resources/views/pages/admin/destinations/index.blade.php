@extends('layouts.app')

@section('topbar_title', 'Kelola Wisata')
@section('topbar_search_placeholder', 'Cari destinasi...')

@section('title', 'Kelola Wisata — Admin Jelajah')

@section('body')
<div class="min-h-screen bg-[#f8fafc] flex font-sans antialiased text-slate-800">

    {{-- SIDEBAR KOMPONEN --}}
    @include('components.admin.sidebar')

    {{-- KONTEN UTAMA --}}
    <main class="flex-1 pl-64 min-h-screen flex flex-col justify-between">
        
        <div class="p-8 max-w-7xl w-full mx-auto space-y-8">
            
            {{-- TOPBAR KOMPONEN --}}
            @include('components.admin.topbar')

            {{-- HEADER HALAMAN & BUTTON TAMBAH --}}
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h3 class="text-xl font-bold text-sky-900 tracking-tight">Daftar Destinasi Wisata</h3>
                    <p class="text-xs text-slate-400 mt-0.5">Menampilkan total destinasi aktif di wilayah Bali.</p>
                </div>
                <a href="{{ route('admin.destinations.create') }}" class="flex items-center gap-2 px-4 py-2.5 bg-[#1e617a] hover:bg-[#154558] text-white text-xs font-bold rounded-xl shadow-sm transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                    </svg>
                    Tambah Destinasi Baru
                </a>
            </div>

            {{-- TABEL DATA DESTINASI --}}
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50/70 border-b border-slate-100 text-[11px] font-bold text-slate-400 uppercase tracking-wider">
                                <th class="px-6 py-4">Nama Destinasi</th>
                                <th class="px-6 py-4">Kategori</th>
                                <th class="px-6 py-4">Lokasi</th>
                                <th class="px-6 py-4">Harga Tiket</th>
                                <th class="px-6 py-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50 text-xs">
                            {{-- Jalankan Loop Data Nyata dari Controller --}}
                            @forelse($destinations as $destination)
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                {{-- Kolom Nama & Foto --}}
                                <td class="px-6 py-4 flex items-center gap-4">
                                    <img src="{{ $destination->image ? asset('storage/' . $destination->image) : 'https://placehold.co/600x400' }}" class="w-12 h-12 rounded-xl object-cover border border-slate-100" alt="Thumb">
                                    <div>
                                        <h4 class="font-bold text-slate-800">{{ $destination->nama_wisata }}</h4>
                                        <p class="text-[10px] text-slate-400 font-medium tracking-wide mt-0.5">ID: DEST-{{ str_pad($destination->id, 3, '0', STR_PAD_LEFT) }}</p>
                                    </div>
                                </td>
                                {{-- Kolom Kategori dengan Badge Custom --}}
                                <td class="px-6 py-4">
                                    @span
                                    @php
                                        $badgeColor = match(strtolower($destination->kategori?->nama_kategori ?? '')) {
                                            'budaya' => 'bg-emerald-50 text-emerald-600',
                                            'alam' => 'bg-amber-50 text-amber-600',
                                            'pantai' => 'bg-sky-50 text-sky-600',
                                            default => 'bg-purple-50 text-purple-600'
                                        };
                                    @endphp
                                    <span class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider {{ $badgeColor }}">
                                        {{ $destination->kategori?->nama_kategori ?? 'Umum' }}
                                    </span>
                                </td>
                                {{-- Kolom Lokasi --}}
                                <td class="px-6 py-4 text-slate-500 font-medium">
                                    <span class="flex items-center gap-1">
                                        <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                        {{ $destination->lokasi?->nama_daerah ?? 'Bali' }}
                                    </span>
                                </td>
                                {{-- Kolom Harga Tiket --}}
                                <td class="px-6 py-4 font-bold text-sky-900">
                                    {{ $destination->harga_tiket == 0 ? 'Gratis' : 'Rp ' . number_format($destination->harga_tiket, 0, ',', '.') }}
                                </td>
                                {{-- Kolom Tombol Aksi --}}
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-center gap-3">
                                        <a href="{{ route('admin.destinations.edit', $destination->id) }}" class="p-1.5 text-slate-400 hover:text-sky-700 bg-slate-50 hover:bg-sky-50 rounded-lg transition-all" title="Edit">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-2.036a5 5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                            </svg>
                                        </a>
                                        <form action="{{ route('admin.destinations.destroy', $destination->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus destinasi ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-1.5 text-slate-400 hover:text-red-600 bg-slate-50 hover:bg-red-50 rounded-lg transition-all" title="Hapus">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-10 text-center text-slate-400 font-medium">Belum ada data destinasi wisata.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- PAGINATION PAD --}}
                @if($destinations->hasPages())
                <div class="px-6 py-4 border-t border-slate-50 bg-slate-50/30">
                    {{ $destinations->links() }}
                </div>
                @endif
            </div>

        </div>

        {{-- FOOTER --}}
        <footer class="w-full max-w-7xl mx-auto px-8 py-5 border-t border-slate-200/50 text-xs text-slate-400 flex flex-col sm:flex-row items-center justify-between gap-2">
            <div>© {{ date('Y') }} Jelajah Bali Management System.</div>
        </footer>

    </main>
</div>
@endsection