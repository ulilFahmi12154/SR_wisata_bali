@extends('layouts.admin')

@section('admin-content')
<div class="space-y-6">
    {{-- Page Header --}}
    <header class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm">
        <div class="flex flex-col gap-4 xl:flex-row xl:items-center xl:justify-between">
            <div class="space-y-2">
                <p class="text-sm uppercase tracking-[0.24em] text-slate-500">Edit Destinasi</p>
                <h1 class="text-3xl font-semibold tracking-tight text-slate-900">{{ $destination->name ?? 'Destinasi' }}</h1>
                <p class="max-w-2xl text-sm leading-6 text-slate-500">Perbarui informasi destinasi wisata di sini.</p>
            </div>
            <a href="{{ route('admin.destinations.index') }}" class="inline-flex items-center justify-center rounded-full border border-slate-200 bg-white px-5 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">Batal</a>
        </div>
    </header>

    <form method="POST" action="{{ route('admin.destinations.update', $destination->id) }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

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
                                   value="{{ $destination->name }}"
                                   required
                                   class="w-full px-4 py-2.5 rounded-lg border border-slate-200 bg-white text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-900 mb-2">Deskripsi Singkat *</label>
                            <textarea name="description"
                                      rows="3"
                                      required
                                      class="w-full px-4 py-2.5 rounded-lg border border-slate-200 bg-white text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ $destination->description }}</textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-900 mb-2">Deskripsi Lengkap *</label>
                            <textarea name="long_description"
                                      rows="5"
                                      required
                                      class="w-full px-4 py-2.5 rounded-lg border border-slate-200 bg-white text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ $destination->long_description }}</textarea>
                        </div>

                        <div class="grid sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-slate-900 mb-2">Kategori *</label>
                                <select name="kategori_id" required class="w-full px-4 py-2.5 rounded-lg border border-slate-200 bg-white text-slate-900 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="">Pilih Kategori</option>
                                    <option value="1" {{ ($destination->kategori_id ?? null) == 1 ? 'selected' : '' }}>Pantai</option>
                                    <option value="2" {{ ($destination->kategori_id ?? null) == 2 ? 'selected' : '' }}>Gunung</option>
                                    <option value="3" {{ ($destination->kategori_id ?? null) == 3 ? 'selected' : '' }}>Kuil</option>
                                    <option value="4" {{ ($destination->kategori_id ?? null) == 4 ? 'selected' : '' }}>Seni & Budaya</option>
                                    <option value="5" {{ ($destination->kategori_id ?? null) == 5 ? 'selected' : '' }}>Taman Hiburan</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-900 mb-2">Lokasi *</label>
                                <select name="lokasi_id" required class="w-full px-4 py-2.5 rounded-lg border border-slate-200 bg-white text-slate-900 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="">Pilih Lokasi</option>
                                    <option value="1" {{ ($destination->lokasi_id ?? null) == 1 ? 'selected' : '' }}>Bali Utara</option>
                                    <option value="2" {{ ($destination->lokasi_id ?? null) == 2 ? 'selected' : '' }}>Bali Timur</option>
                                    <option value="3" {{ ($destination->lokasi_id ?? null) == 3 ? 'selected' : '' }}>Bali Selatan</option>
                                    <option value="4" {{ ($destination->lokasi_id ?? null) == 4 ? 'selected' : '' }}>Bali Barat</option>
                                    <option value="5" {{ ($destination->lokasi_id ?? null) == 5 ? 'selected' : '' }}>Bali Tengah</option>
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
                                   value="{{ $destination->address }}"
                                   required
                                   class="w-full px-4 py-2.5 rounded-lg border border-slate-200 bg-white text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                        <div class="grid sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-slate-900 mb-2">Latitude</label>
                                <input type="text"
                                       name="latitude"
                                       value="{{ $destination->latitude }}"
                                       class="w-full px-4 py-2.5 rounded-lg border border-slate-200 bg-white text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-900 mb-2">Longitude</label>
                                <input type="text"
                                       name="longitude"
                                       value="{{ $destination->longitude }}"
                                       class="w-full px-4 py-2.5 rounded-lg border border-slate-200 bg-white text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-900 mb-2">Jam Buka</label>
                            <input type="text"
                                   name="opening_hours"
                                   value="{{ $destination->opening_hours }}"
                                   class="w-full px-4 py-2.5 rounded-lg border border-slate-200 bg-white text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-900 mb-2">Harga Tiket Masuk</label>
                            <input type="number"
                                   name="ticket_price"
                                   value="{{ $destination->ticket_price }}"
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
                            <label class="block text-sm font-medium text-slate-900 mb-3">Gambar Utama</label>
                            @if($destination->image_url)
                            <div class="mb-4 relative">
                                <img src="{{ $destination->image_url }}" alt="{{ $destination->name }}" class="w-full h-40 object-cover rounded-lg">
                                <p class="text-xs text-slate-500 mt-2">Klik pada kotak di bawah untuk mengganti gambar</p>
                            </div>
                            @endif
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
                                    <input type="checkbox" name="facilities[]" value="parking" class="w-4 h-4 rounded border-slate-300" {{ in_array('parking', $destination->facilities ?? []) ? 'checked' : '' }}>
                                    <span class="text-sm text-slate-700">Parkir</span>
                                </label>
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="checkbox" name="facilities[]" value="restaurant" class="w-4 h-4 rounded border-slate-300" {{ in_array('restaurant', $destination->facilities ?? []) ? 'checked' : '' }}>
                                    <span class="text-sm text-slate-700">Restoran</span>
                                </label>
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="checkbox" name="facilities[]" value="toilet" class="w-4 h-4 rounded border-slate-300" {{ in_array('toilet', $destination->facilities ?? []) ? 'checked' : '' }}>
                                    <span class="text-sm text-slate-700">Toilet</span>
                                </label>
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="checkbox" name="facilities[]" value="wheelchair" class="w-4 h-4 rounded border-slate-300" {{ in_array('wheelchair', $destination->facilities ?? []) ? 'checked' : '' }}>
                                    <span class="text-sm text-slate-700">Akses Kursi Roda</span>
                                </label>
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="checkbox" name="facilities[]" value="wifi" class="w-4 h-4 rounded border-slate-300" {{ in_array('wifi', $destination->facilities ?? []) ? 'checked' : '' }}>
                                    <span class="text-sm text-slate-700">WiFi</span>
                                </label>
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="checkbox" name="facilities[]" value="guide" class="w-4 h-4 rounded border-slate-300" {{ in_array('guide', $destination->facilities ?? []) ? 'checked' : '' }}>
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
                            <input type="checkbox" name="is_published" class="w-5 h-5 rounded border-slate-300" {{ ($destination->is_published ?? false) ? 'checked' : '' }}>
                            <span class="text-sm font-medium text-slate-700">Publikasikan</span>
                        </label>

                        <div class="pt-4 border-t border-slate-200 space-y-2">
                            <button type="submit" class="w-full px-4 py-2.5 rounded-full bg-slate-950 text-white font-medium hover:bg-slate-800 transition-colors">
                                Simpan Perubahan
                            </button>
                            <button type="button" class="w-full px-4 py-2.5 rounded-full border border-red-200 bg-red-50 text-red-600 font-medium hover:bg-red-100 transition-colors" onclick="if(confirm('Yakin ingin menghapus destinasi ini?')) { /* delete action */ }">
                                Hapus Destinasi
                            </button>
                        </div>
                    </div>
                </div>

                {{-- Info Box --}}
                <div class="rounded-[2rem] border border-emerald-200 bg-emerald-50 p-6">
                    <h3 class="font-semibold text-emerald-900 mb-3">Informasi</h3>
                    <ul class="text-xs text-emerald-800 space-y-2">
                        <li class="flex gap-2">
                            <span class="font-bold">•</span>
                            <span>Dibuat: {{ $destination->created_at?->format('d M Y H:i') }}</span>
                        </li>
                        <li class="flex gap-2">
                            <span class="font-bold">•</span>
                            <span>Diperbarui: {{ $destination->updated_at?->format('d M Y H:i') }}</span>
                        </li>
                        <li class="flex gap-2">
                            <span class="font-bold">•</span>
                            <span>Rating: {{ $destination->rating ?? '4.5' }} dari {{ $destination->review_count ?? 0 }} ulasan</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
