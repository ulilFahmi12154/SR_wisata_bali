@extends('layouts.admin')

@section('admin-content')
<div class="space-y-6">
    {{-- Page Header --}}
    <header class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm">
        <div class="flex flex-col gap-4 xl:flex-row xl:items-center xl:justify-between">
            <div class="space-y-2">
                <p class="text-sm uppercase tracking-[0.24em] text-slate-500">Tambah Destinasi Baru</p>
                <h1 class="text-3xl font-semibold tracking-tight text-slate-900">Buat Destinasi Wisata</h1>
                <p class="max-w-2xl text-sm leading-6 text-slate-500">Masukkan informasi lengkap destinasi wisata untuk ditambahkan ke sistem.</p>
            </div>
            <a href="{{ route('admin.destinations.index') }}" class="inline-flex items-center justify-center rounded-full border border-slate-200 bg-white px-5 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">Batal</a>
        </div>
    </header>

    <form method="POST" action="{{ route('admin.destinations.store') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div class="grid gap-6 xl:grid-cols-3">
            {{-- Main Form --}}
            <div class="xl:col-span-2 space-y-6">
                {{-- Basic Information --}}
                <div class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm">
                    <h2 class="text-xl font-semibold text-slate-900 mb-6">Informasi Dasar</h2>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-900 mb-2">Nama Destinasi *</label>
                            <input type="text"
                                   name="name"
                                   placeholder="Contoh: Pura Tanah Lot"
                                   required
                                   class="w-full px-4 py-2.5 rounded-lg border border-slate-200 bg-white text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-900 mb-2">Deskripsi Singkat *</label>
                            <textarea name="description"
                                      rows="3"
                                      placeholder="Deskripsi ringkas tentang destinasi..."
                                      required
                                      class="w-full px-4 py-2.5 rounded-lg border border-slate-200 bg-white text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"></textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-900 mb-2">Deskripsi Lengkap *</label>
                            <textarea name="long_description"
                                      rows="5"
                                      placeholder="Penjelasan detail tentang destinasi, sejarah, atraksi utama, dll..."
                                      required
                                      class="w-full px-4 py-2.5 rounded-lg border border-slate-200 bg-white text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"></textarea>
                        </div>

                        <div class="grid sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-slate-900 mb-2">Kategori *</label>
                                <select name="kategori_id" required class="w-full px-4 py-2.5 rounded-lg border border-slate-200 bg-white text-slate-900 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="">Pilih Kategori</option>
                                    <option value="1">Pantai</option>
                                    <option value="2">Gunung</option>
                                    <option value="3">Kuil</option>
                                    <option value="4">Seni & Budaya</option>
                                    <option value="5">Taman Hiburan</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-900 mb-2">Lokasi *</label>
                                <select name="lokasi_id" required class="w-full px-4 py-2.5 rounded-lg border border-slate-200 bg-white text-slate-900 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="">Pilih Lokasi</option>
                                    <option value="1">Bali Utara</option>
                                    <option value="2">Bali Timur</option>
                                    <option value="3">Bali Selatan</option>
                                    <option value="4">Bali Barat</option>
                                    <option value="5">Bali Tengah</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Location Details --}}
                <div class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm">
                    <h2 class="text-xl font-semibold text-slate-900 mb-6">Detail Lokasi</h2>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-900 mb-2">Alamat *</label>
                            <input type="text"
                                   name="address"
                                   placeholder="Masukkan alamat lengkap"
                                   required
                                   class="w-full px-4 py-2.5 rounded-lg border border-slate-200 bg-white text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                        <div class="grid sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-slate-900 mb-2">Latitude</label>
                                <input type="text"
                                       name="latitude"
                                       placeholder="-8.1234"
                                       class="w-full px-4 py-2.5 rounded-lg border border-slate-200 bg-white text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-900 mb-2">Longitude</label>
                                <input type="text"
                                       name="longitude"
                                       placeholder="115.1234"
                                       class="w-full px-4 py-2.5 rounded-lg border border-slate-200 bg-white text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-900 mb-2">Jam Buka</label>
                            <input type="text"
                                   name="opening_hours"
                                   placeholder="Contoh: 08:00 - 18:00"
                                   class="w-full px-4 py-2.5 rounded-lg border border-slate-200 bg-white text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-900 mb-2">Harga Tiket Masuk</label>
                            <input type="number"
                                   name="ticket_price"
                                   placeholder="0"
                                   min="0"
                                   class="w-full px-4 py-2.5 rounded-lg border border-slate-200 bg-white text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                    </div>
                </div>

                {{-- Media & Facilities --}}
                <div class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm">
                    <h2 class="text-xl font-semibold text-slate-900 mb-6">Media & Fasilitas</h2>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-900 mb-3">Gambar Utama *</label>
                            <div class="border-2 border-dashed border-slate-200 rounded-lg p-8 text-center hover:border-blue-500 hover:bg-blue-50 transition-colors cursor-pointer">
                                <svg class="w-8 h-8 text-slate-400 mx-auto mb-3" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <p class="text-sm text-slate-600">Klik untuk upload atau drag dan drop</p>
                                <input type="file" name="image" accept="image/*" class="hidden">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-900 mb-2">Fasilitas Tersedia</label>
                            <div class="grid sm:grid-cols-2 gap-3">
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="checkbox" name="facilities[]" value="parking" class="w-4 h-4 rounded border-slate-300">
                                    <span class="text-sm text-slate-700">Parkir</span>
                                </label>
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="checkbox" name="facilities[]" value="restaurant" class="w-4 h-4 rounded border-slate-300">
                                    <span class="text-sm text-slate-700">Restoran</span>
                                </label>
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="checkbox" name="facilities[]" value="toilet" class="w-4 h-4 rounded border-slate-300">
                                    <span class="text-sm text-slate-700">Toilet</span>
                                </label>
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="checkbox" name="facilities[]" value="wheelchair" class="w-4 h-4 rounded border-slate-300">
                                    <span class="text-sm text-slate-700">Akses Kursi Roda</span>
                                </label>
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="checkbox" name="facilities[]" value="wifi" class="w-4 h-4 rounded border-slate-300">
                                    <span class="text-sm text-slate-700">WiFi</span>
                                </label>
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="checkbox" name="facilities[]" value="guide" class="w-4 h-4 rounded border-slate-300">
                                    <span class="text-sm text-slate-700">Pemandu Wisata</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Sidebar --}}
            <div class="space-y-6">
                {{-- Publish Settings --}}
                <div class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm">
                    <h3 class="font-semibold text-slate-900 mb-4">Pengaturan Publikasi</h3>

                    <div class="space-y-4">
                        <label class="flex items-center gap-3 cursor-pointer">
                            <input type="checkbox" name="is_published" class="w-5 h-5 rounded border-slate-300">
                            <span class="text-sm font-medium text-slate-700">Publikasikan Sekarang</span>
                        </label>

                        <div class="pt-4 border-t border-slate-200">
                            <button type="submit" class="w-full px-4 py-2.5 rounded-full bg-slate-950 text-white font-medium hover:bg-slate-800 transition-colors">
                                Simpan Destinasi
                            </button>
                        </div>

                        <button type="reset" class="w-full px-4 py-2.5 rounded-full border border-slate-200 bg-white text-slate-700 font-medium hover:bg-slate-50 transition-colors">
                            Reset Form
                        </button>
                    </div>
                </div>

                {{-- Info Box --}}
                <div class="rounded-[2rem] border border-blue-200 bg-blue-50 p-6">
                    <h3 class="font-semibold text-blue-900 mb-3">Tips Pengisian</h3>
                    <ul class="text-xs text-blue-800 space-y-2">
                        <li class="flex gap-2">
                            <span class="font-bold">•</span>
                            <span>Pastikan nama destinasi unik dan deskriptif</span>
                        </li>
                        <li class="flex gap-2">
                            <span class="font-bold">•</span>
                            <span>Gunakan foto berkualitas tinggi (min 1MB)</span>
                        </li>
                        <li class="flex gap-2">
                            <span class="font-bold">•</span>
                            <span>Lengkapi semua informasi lokasi untuk pemetaan</span>
                        </li>
                        <li class="flex gap-2">
                            <span class="font-bold">•</span>
                            <span>Pilih kategori yang paling sesuai</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
