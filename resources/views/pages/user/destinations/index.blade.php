@extends('layouts.app')

@section('title', 'Destinasi Wisata')

@section('content')

<div class="max-w-7xl mx-auto">
    {{-- Header --}}
    <div class="mb-12 mt-8">
        <h1 class="font-display text-4xl font-bold text-slate-900 mb-3">
            Jelajahi Destinasi Bali
        </h1>
        <p class="text-slate-600 text-lg max-w-2xl">
            Temukan ribuan destinasi wisata menarik di Bali, dari pantai yang eksotis hingga pura bersejarah. Semuanya dikurasi khusus untuk pengalaman Anda.
        </p>
    </div>

    {{-- Filter Section --}}
    <div class="bg-white shadow-md rounded-lg p-6 mb-8 border border-slate-200">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2">Cari Destinasi</label>
                <input type="text" placeholder="Cari nama destinasi..." class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:ring-2 focus:ring-brand-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2">Kategori</label>
                <select class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:ring-2 focus:ring-brand-500">
                    <option value="">Semua Kategori</option>
                    <option value="nature">Alam</option>
                    <option value="culture">Budaya</option>
                    <option value="beach">Pantai</option>
                    <option value="culinary">Kuliner</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2">Urutkan Berdasarkan</label>
                <select class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:ring-2 focus:ring-brand-500">
                    <option value="popular">Paling Populer</option>
                    <option value="rating">Rating Tertinggi</option>
                    <option value="newest">Terbaru Ditambahkan</option>
                </select>
            </div>
        </div>
    </div>

    {{-- Destinations Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
        @forelse([1, 2, 3, 4, 5, 6] as $i)
        <div class="group bg-white rounded-xl shadow-md hover:shadow-xl transition overflow-hidden border border-slate-200">
            {{-- Image --}}
            <div class="relative overflow-hidden bg-slate-200 h-48">
                <div class="absolute inset-0 bg-gradient-to-br from-brand-500 to-brand-600 flex items-center justify-center">
                    <svg class="w-16 h-16 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
            </div>

            {{-- Content --}}
            <div class="p-4">
                <div class="flex items-start justify-between mb-2">
                    <div class="flex-1">
                        <h3 class="font-semibold text-slate-900 group-hover:text-brand-600 transition line-clamp-2">
                            Destinasi Wisata Menarik {{ $i }}
                        </h3>
                        <p class="text-xs text-slate-500 mt-1">📍 Badung, Bali</p>
                    </div>
                    <div class="ml-2 px-2 py-1 bg-yellow-100 rounded text-yellow-700 text-xs font-semibold">
                        ⭐ 4.{{ $i }}
                    </div>
                </div>

                <p class="text-sm text-slate-600 mb-4 line-clamp-2">
                    Destinasi wisata yang indah dengan pemandangan menakjubkan dan fasilitas lengkap untuk kenyamanan Anda.
                </p>

                <div class="flex items-center justify-between pt-3 border-t border-slate-200">
                    <div class="flex gap-1">
                        <span class="px-2 py-1 bg-slate-100 text-slate-700 text-xs rounded">🏞️ Alam</span>
                        <span class="px-2 py-1 bg-slate-100 text-slate-700 text-xs rounded">📸 Foto</span>
                    </div>
                    <a href="{{ route('user.destinations.detail', ['id' => $i]) }}" class="text-brand-600 hover:text-brand-700 font-semibold text-sm">
                        Lihat →
                    </a>
                </div>
            </div>
        </div>
        @empty
        @endforelse
    </div>

    {{-- Pagination --}}
    <div class="flex justify-center items-center gap-2 mb-12">
        <button class="px-4 py-2 border border-slate-300 rounded-lg hover:bg-slate-100 transition">← Sebelumnya</button>
        <button class="px-4 py-2 bg-brand-600 text-white rounded-lg">1</button>
        <button class="px-4 py-2 border border-slate-300 rounded-lg hover:bg-slate-100 transition">2</button>
        <button class="px-4 py-2 border border-slate-300 rounded-lg hover:bg-slate-100 transition">3</button>
        <button class="px-4 py-2 border border-slate-300 rounded-lg hover:bg-slate-100 transition">Berikutnya →</button>
    </div>
</div>

@endsection