@extends('layouts.admin')

@section('admin-content')
<div class="space-y-6">
    {{-- Page Header --}}
    <header class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm">
        <div class="flex flex-col gap-4 xl:flex-row xl:items-center xl:justify-between">
            <div class="space-y-2">
                <p class="text-sm uppercase tracking-[0.24em] text-slate-500">Manajemen Destinasi</p>
                <h1 class="text-3xl font-semibold tracking-tight text-slate-900">Kelola Destinasi</h1>
                <p class="max-w-2xl text-sm leading-6 text-slate-500">Tambah, edit, dan kelola semua destinasi wisata. Pantau kategori, fasilitas, dan rating setiap destinasi.</p>
            </div>
            <a href="{{ route('admin.destinations.create') }}" class="inline-flex items-center justify-center rounded-full bg-slate-950 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-slate-800">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                </svg>
                Tambah Destinasi Baru
            </a>
        </div>
    </header>

    {{-- Search and Filters --}}
    <div class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div class="flex-1">
                <input type="text"
                       placeholder="Cari nama destinasi..."
                       class="w-full px-4 py-2.5 rounded-lg border border-slate-200 bg-white text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
            <div class="flex gap-2">
                <select class="px-4 py-2.5 rounded-lg border border-slate-200 bg-white text-slate-900 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option>Kategori: Semua</option>
                    <option>Pantai</option>
                    <option>Gunung</option>
                    <option>Kuil</option>
                    <option>Seni & Budaya</option>
                </select>
                <select class="px-4 py-2.5 rounded-lg border border-slate-200 bg-white text-slate-900 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option>Status: Semua</option>
                    <option>Dipublikasikan</option>
                    <option>Draft</option>
                </select>
            </div>
        </div>
    </div>

    {{-- Destinations Table --}}
    <div class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="border-b border-slate-200">
                <tr class="text-left">
                    <th class="px-4 py-3 font-semibold text-slate-900">Nama Destinasi</th>
                    <th class="px-4 py-3 font-semibold text-slate-900">Kategori</th>
                    <th class="px-4 py-3 font-semibold text-slate-900">Lokasi</th>
                    <th class="px-4 py-3 font-semibold text-slate-900">Rating</th>
                    <th class="px-4 py-3 font-semibold text-slate-900">Status</th>
                    <th class="px-4 py-3 font-semibold text-slate-900">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200">
                @forelse($destinations ?? [] as $destination)
                <tr class="hover:bg-slate-50 transition-colors">
                    <td class="px-4 py-3">
                        <div class="flex items-center gap-3">
                            <img src="{{ $destination->image_url ?? 'https://via.placeholder.com/48' }}"
                                 alt="{{ $destination->name }}"
                                 class="w-10 h-10 rounded-lg object-cover">
                            <span class="font-medium text-slate-900">{{ $destination->name }}</span>
                        </div>
                    </td>
                    <td class="px-4 py-3 text-slate-600">
                        <span class="inline-block px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-700">
                            {{ $destination->kategori->name ?? 'Umum' }}
                        </span>
                    </td>
                    <td class="px-4 py-3 text-slate-600">{{ $destination->lokasi->nama_lokasi ?? '-' }}</td>
                    <td class="px-4 py-3">
                        <div class="flex items-center gap-1">
                            <svg class="w-4 h-4 text-amber-400" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                            </svg>
                            <span class="font-semibold text-slate-900">{{ $destination->rating ?? '4.5' }}</span>
                            <span class="text-slate-500 text-xs">({{ $destination->review_count ?? 0 }})</span>
                        </div>
                    </td>
                    <td class="px-4 py-3">
                        <span class="inline-block px-3 py-1 rounded-full text-xs font-medium {{ $destination->is_published ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-700' }}">
                            {{ $destination->is_published ? 'Dipublikasikan' : 'Draft' }}
                        </span>
                    </td>
                    <td class="px-4 py-3">
                        <div class="flex items-center gap-2">
                            <a href="{{ route('admin.destinations.show', $destination->id) }}" class="p-2 text-slate-600 hover:text-slate-900 hover:bg-slate-100 rounded-lg transition-colors" title="Lihat">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </a>
                            <a href="{{ route('admin.destinations.edit', $destination->id) }}" class="p-2 text-slate-600 hover:text-slate-900 hover:bg-slate-100 rounded-lg transition-colors" title="Edit">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </a>
                            <button class="p-2 text-red-600 hover:text-red-700 hover:bg-red-50 rounded-lg transition-colors" title="Hapus">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-4 py-8 text-center text-slate-500">
                        <div class="flex flex-col items-center gap-2">
                            <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <span>Tidak ada destinasi ditemukan</span>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Pagination --}}
        <div class="flex items-center justify-between mt-6 pt-6 border-t border-slate-200">
            <p class="text-sm text-slate-600">Menampilkan 1 hingga 10 dari 24 destinasi</p>
            <div class="flex gap-2">
                <button class="px-3 py-2 rounded-lg border border-slate-200 bg-white text-slate-700 hover:bg-slate-50 transition-colors text-sm">← Sebelumnya</button>
                <button class="px-3 py-2 rounded-lg border border-slate-200 bg-slate-950 text-white text-sm">1</button>
                <button class="px-3 py-2 rounded-lg border border-slate-200 bg-white text-slate-700 hover:bg-slate-50 transition-colors text-sm">2</button>
                <button class="px-3 py-2 rounded-lg border border-slate-200 bg-white text-slate-700 hover:bg-slate-50 transition-colors text-sm">Selanjutnya →</button>
            </div>
        </div>
    </div>
</div>
@endsection
