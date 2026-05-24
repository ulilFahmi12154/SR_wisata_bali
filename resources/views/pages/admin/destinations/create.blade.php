@extends('layouts.app')

@section('title', 'Tambah Wisata Baru — Admin Jelajah')

@section('body')
<div class="min-h-screen bg-[#f8fafc] flex font-sans antialiased text-slate-800">

    @include('components.admin.sidebar')

    <main class="flex-1 pl-64 min-h-screen flex flex-col justify-between">
        
        <div class="p-8 max-w-7xl w-full mx-auto space-y-6">
            
            @include('components.admin.topbar')

            {{-- BREADCRUMB / BACK BUTTON --}}
            <div>
                <a href="{{ route('admin.destinations.index') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-[#1e617a] hover:text-[#154558] transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    Kembali ke Kelola Wisata
                </a>
                <h3 class="text-xl font-bold text-sky-900 tracking-tight mt-2">Form Tambah Destinasi</h3>
            </div>

            {{-- FORMULIR --}}
            <form action="{{ route('admin.destinations.store') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                @csrf
                
                {{-- BLOK KIRI: Detail Input Konten --}}
                <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm lg:col-span-2 space-y-5">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Nama Destinasi Wisata</label>
                        <input type="text" name="nama_wisata" value="{{ old('nama_wisata') }}" required placeholder="Contoh: Pura Luhur Uluwatu" class="w-full px-4 py-3 text-xs bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:border-sky-600 focus:bg-white transition-all">
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Kategori</label>
                            <select name="kategori_id" required class="w-full px-4 py-3 text-xs bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:border-sky-600 focus:bg-white transition-all">
                                <option value="" disabled selected>Pilih Kategori</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->nama_kategori }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Lokasi Wilayah (Kabupaten)</label>
                            <select name="lokasi_id" required class="w-full px-4 py-3 text-xs bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:border-sky-600 focus:bg-white transition-all">
                                <option value="" disabled selected>Pilih Lokasi</option>
                                @foreach($locations as $loc)
                                    <option value="{{ $loc->id }}">{{ $loc->nama_daerah }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Harga Tiket Masuk (IDR)</label>
                        <input type="number" name="harga_tiket" value="{{ old('harga_tiket', 0) }}" required placeholder="Isi 0 jika gratis" class="w-full px-4 py-3 text-xs bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:border-sky-600 focus:bg-white transition-all">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Deskripsi Lengkap</label>
                        <textarea name="deskripsi" rows="5" placeholder="Tuliskan daya tarik naratif, sejarah singkat, atau panduan berkunjung di sini..." class="w-full px-4 py-3 text-xs bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:border-sky-600 focus:bg-white transition-all">{{ old('deskripsi') }}</textarea>
                    </div>
                </div>

                {{-- BLOK KANAN: Upload Foto & Submit --}}
                <div class="space-y-6">
                    <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm space-y-4">
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Foto Media Utama</label>
                        
                        <div class="border-2 border-dashed border-slate-200 rounded-2xl p-4 text-center hover:bg-slate-50/50 transition-all cursor-pointer relative group">
                            <input type="file" name="image" class="absolute inset-0 opacity-0 cursor-pointer" accept="image/*">
                            <div class="space-y-1.5 py-4">
                                <svg class="w-8 h-8 mx-auto text-slate-400 group-hover:text-sky-700 transition-colors" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"/></svg>
                                <p class="text-xs font-bold text-slate-600">Klik atau seret foto ke sini</p>
                                <p class="text-[10px] text-slate-400">PNG, JPG atau JPEG maksimal 2MB</p>
                            </div>
                        </div>
                    </div>

                    {{-- TOMBOL SUBMIT AKSI --}}
                    <div class="bg-white p-4 rounded-2xl border border-slate-100 shadow-sm flex gap-3">
                        <button type="submit" class="flex-1 text-center py-3 bg-[#1e617a] hover:bg-[#154558] text-white text-xs font-bold rounded-xl shadow-sm transition-all">
                            Simpan Data
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