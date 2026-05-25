@extends('layouts.app')

@section('topbar_title', 'Kelola Wisata')

@section('title', 'Edit Destinasi — Admin Jelajah')

@section('body')
<div class="min-h-screen bg-[#f8fafc] flex font-sans antialiased text-slate-800">

    @include('components.admin.sidebar')

    <main class="flex-1 pl-64 min-h-screen flex flex-col justify-between">
        
        <div class="p-8 max-w-7xl w-full mx-auto space-y-6">
            
            @include('components.admin.topbar')

            {{-- BREADCRUMB --}}
            <div>
                <a href="{{ route('admin.destinations.index') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-[#1e617a] hover:text-[#154558] transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    Kembali ke Kelola Wisata
                </a>
                <h3 class="text-xl font-bold text-sky-900 tracking-tight mt-2">Edit Destinasi: {{ $destination->nama_wisata }}</h3>
            </div>

            {{-- FORMULIR EDIT --}}
            <form action="{{ route('admin.destinations.update', $destination->id) }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                @csrf
                @method('PUT')
                
                {{-- BLOK KIRI --}}
                <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm lg:col-span-2 space-y-5">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Nama Destinasi Wisata</label>
                        <input type="text" name="nama_wisata" value="{{ old('nama_wisata', $destination->nama_wisata) }}" required class="w-full px-4 py-3 text-xs bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:border-sky-600 focus:bg-white transition-all">
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Kategori</label>
                            <select name="kategori_id" required class="w-full px-4 py-3 text-xs bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:border-sky-600 focus:bg-white transition-all">
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ $destination->kategori_id == $cat->id ? 'selected' : '' }}>{{ $cat->nama_kategori }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Lokasi Wilayah (Kabupaten)</label>
                            <select name="lokasi_id" required class="w-full px-4 py-3 text-xs bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:border-sky-600 focus:bg-white transition-all">
                                @foreach($locations as $loc)
                                    <option value="{{ $loc->id }}" {{ $destination->lokasi_id == $loc->id ? 'selected' : '' }}>{{ $loc->nama_daerah }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Harga Tiket Masuk (IDR)</label>
                        <input type="number" name="harga_tiket" value="{{ old('harga_tiket', $destination->harga_tiket) }}" required class="w-full px-4 py-3 text-xs bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:border-sky-600 focus:bg-white transition-all">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Deskripsi Lengkap</label>
                        <textarea name="deskripsi" rows="5" class="w-full px-4 py-3 text-xs bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:border-sky-600 focus:bg-white transition-all">{{ old('deskripsi', $destination->deskripsi) }}</textarea>
                    </div>
                </div>

                {{-- BLOK KANAN --}}
                <div class="space-y-6">
                    <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm space-y-4">
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Foto Media Utama</label>
                        
                        {{-- Pratinjau Gambar Lama --}}
                        @if($destination->image)
                        <div class="space-y-1">
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wide">Foto Aktif Saat Ini:</p>
                            <img src="{{ asset('storage/' . $destination->image) }}" class="w-full h-32 object-cover rounded-xl border border-slate-100 shadow-inner" alt="Preview">
                        </div>
                        @endif

                        <div class="border-2 border-dashed border-slate-200 rounded-2xl p-4 text-center hover:bg-slate-50/50 transition-all cursor-pointer relative group">
                            <input type="file" name="image" class="absolute inset-0 opacity-0 cursor-pointer" accept="image/*">
                            <div class="space-y-1.5 py-2">
                                <svg class="w-6 h-6 mx-auto text-slate-400 group-hover:text-sky-700 transition-colors" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99"/></svg>
                                <p class="text-xs font-bold text-slate-600">Ganti media gambar baru</p>
                                <p class="text-[10px] text-slate-400">Biarkan kosong jika tidak ingin diubah</p>
                            </div>
                        </div>
                    </div>

                    {{-- ACTION BUTTON --}}
                    <div class="bg-white p-4 rounded-2xl border border-slate-100 shadow-sm flex gap-3">
                        <button type="submit" class="flex-1 text-center py-3 bg-[#1e617a] hover:bg-[#154558] text-white text-xs font-bold rounded-xl shadow-sm transition-all">
                            Perbarui Data
                        </button>
                        <a href="{{ route('admin.destinations.index') }}" class="px-4 py-3 bg-slate-100 hover:bg-slate-200 text-slate-500 text-xs font-bold rounded-xl text-center transition-all">
                            Batal
                        </a>
                    </div>
                </div>

            </form>
        </div>

    </main>
</div>
@endsection