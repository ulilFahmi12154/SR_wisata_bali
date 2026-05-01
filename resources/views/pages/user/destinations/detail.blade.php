@extends('layouts.app')

@section('title', 'Detail Destinasi')

@section('content')

<div class="max-w-5xl mx-auto py-8">
    {{-- Hero Section --}}
    <div class="relative bg-slate-300 rounded-2xl overflow-hidden h-96 mb-8 border border-slate-200">
        <div class="absolute inset-0 bg-gradient-to-br from-brand-500 to-brand-600 flex items-center justify-center">
            <svg class="w-32 h-32 text-white/20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
        </div>
    </div>

    {{-- Title & Rating --}}
    <div class="mb-8">
        <div class="flex items-start justify-between mb-3">
            <div>
                <h1 class="font-display text-4xl font-bold text-slate-900 mb-2">
                    Destinasi Wisata Impian
                </h1>
                <p class="text-slate-600">📍 Badung, Bali</p>
            </div>
            <div class="text-right">
                <div class="text-3xl font-bold text-yellow-500">⭐ 4.8</div>
                <p class="text-sm text-slate-600">(234 reviews)</p>
            </div>
        </div>
        <div class="flex gap-2">
            <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-sm font-medium">🏞️ Alam</span>
            <span class="px-3 py-1 bg-purple-100 text-purple-700 rounded-full text-sm font-medium">📸 Fotografi</span>
            <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm font-medium">🚶 Petualangan</span>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- Main Content --}}
        <div class="lg:col-span-2 space-y-8">
            {{-- Description --}}
            <section>
                <h2 class="text-2xl font-bold text-slate-900 mb-4">Deskripsi</h2>
                <p class="text-slate-600 leading-relaxed mb-4">
                    Destinasi wisata yang menakjubkan dengan pemandangan alam yang spektakuler. Tempat ini menawarkan pengalaman yang tak terlupakan dengan kombinasi keindahan alam, budaya lokal, dan fasilitas modern.
                </p>
                <p class="text-slate-600 leading-relaxed">
                    Dengan akses mudah dari pusat kota dan berbagai pilihan akomodasi, tempat ini menjadi salah satu destinasi pilihan wisatawan dari seluruh dunia.
                </p>
            </section>

            {{-- Highlights --}}
            <section>
                <h2 class="text-2xl font-bold text-slate-900 mb-4">Highlight</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="p-4 bg-slate-50 rounded-lg border border-slate-200">
                        <p class="font-semibold text-slate-900 mb-2">🌅 Pemandangan Spektakuler</p>
                        <p class="text-sm text-slate-600">Nikmati sunset yang memukau dengan pemandangan laut yang luas.</p>
                    </div>
                    <div class="p-4 bg-slate-50 rounded-lg border border-slate-200">
                        <p class="font-semibold text-slate-900 mb-2">🥾 Trek Hiking</p>
                        <p class="text-sm text-slate-600">Jalur hiking yang menantang dengan level kesulitan berbeda.</p>
                    </div>
                    <div class="p-4 bg-slate-50 rounded-lg border border-slate-200">
                        <p class="font-semibold text-slate-900 mb-2">🍽️ Kuliner Lokal</p>
                        <p class="text-sm text-slate-600">Cita rasa autentik Bali dengan resep turun-temurun.</p>
                    </div>
                    <div class="p-4 bg-slate-50 rounded-lg border border-slate-200">
                        <p class="font-semibold text-slate-900 mb-2">📸 Photo Spot</p>
                        <p class="text-sm text-slate-600">Tempat-tempat instagramable untuk abadikan kenangan.</p>
                    </div>
                </div>
            </section>

            {{-- Facilities --}}
            <section>
                <h2 class="text-2xl font-bold text-slate-900 mb-4">Fasilitas</h2>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                    <div class="flex items-center gap-2 p-3 bg-slate-50 rounded-lg">
                        <span class="text-xl">🅿️</span>
                        <span class="text-sm font-medium text-slate-700">Area Parkir</span>
                    </div>
                    <div class="flex items-center gap-2 p-3 bg-slate-50 rounded-lg">
                        <span class="text-xl">📶</span>
                        <span class="text-sm font-medium text-slate-700">WiFi</span>
                    </div>
                    <div class="flex items-center gap-2 p-3 bg-slate-50 rounded-lg">
                        <span class="text-xl">🚻</span>
                        <span class="text-sm font-medium text-slate-700">Toilet Bersih</span>
                    </div>
                    <div class="flex items-center gap-2 p-3 bg-slate-50 rounded-lg">
                        <span class="text-xl">🍽️</span>
                        <span class="text-sm font-medium text-slate-700">Restoran</span>
                    </div>
                    <div class="flex items-center gap-2 p-3 bg-slate-50 rounded-lg">
                        <span class="text-xl">🏥</span>
                        <span class="text-sm font-medium text-slate-700">First Aid</span>
                    </div>
                    <div class="flex items-center gap-2 p-3 bg-slate-50 rounded-lg">
                        <span class="text-xl">👨‍💼</span>
                        <span class="text-sm font-medium text-slate-700">Tour Guide</span>
                    </div>
                </div>
            </section>

            {{-- Reviews --}}
            <section>
                <h2 class="text-2xl font-bold text-slate-900 mb-4">Ulasan Pengunjung</h2>
                <div class="space-y-4">
                    <div class="p-4 border border-slate-200 rounded-lg">
                        <div class="flex items-center justify-between mb-2">
                            <p class="font-semibold text-slate-900">Budi Santoso</p>
                            <p class="text-yellow-500">⭐⭐⭐⭐⭐</p>
                        </div>
                        <p class="text-sm text-slate-600">Tempat yang sangat indah dan cocok untuk liburan keluarga. Pelayanan pegawainya ramah dan fasilitas lengkap.</p>
                    </div>
                    <div class="p-4 border border-slate-200 rounded-lg">
                        <div class="flex items-center justify-between mb-2">
                            <p class="font-semibold text-slate-900">Siti Nurhaliza</p>
                            <p class="text-yellow-500">⭐⭐⭐⭐</p>
                        </div>
                        <p class="text-sm text-slate-600">Pengalaman yang berkesan. Satu-satunya kekurangan adalah harganya sedikit mahal, tapi sebanding dengan kualitas.</p>
                    </div>
                </div>
            </section>
        </div>

        {{-- Sidebar --}}
        <div class="lg:col-span-1">
            {{-- Booking Card --}}
            <div class="bg-white border border-slate-200 rounded-xl p-6 shadow-md sticky top-24">
                <h3 class="text-xl font-bold text-slate-900 mb-4">Informasi Kunjungan</h3>
                
                <div class="space-y-4 mb-6">
                    <div>
                        <p class="text-sm text-slate-600 mb-1">Jam Buka</p>
                        <p class="font-semibold text-slate-900">08:00 - 18:00 WITA</p>
                    </div>
                    <div>
                        <p class="text-sm text-slate-600 mb-1">Harga Tiket</p>
                        <p class="font-semibold text-slate-900">Rp 50.000 - Rp 100.000</p>
                    </div>
                    <div>
                        <p class="text-sm text-slate-600 mb-1">Waktu Tempuh</p>
                        <p class="font-semibold text-slate-900">30 menit dari Denpasar</p>
                    </div>
                    <div>
                        <p class="text-sm text-slate-600 mb-1">Kontak</p>
                        <p class="font-semibold text-slate-900">+62 123 456 789</p>
                    </div>
                </div>

                <a href="#" class="block w-full px-6 py-3 bg-brand-600 text-white font-semibold rounded-lg hover:bg-brand-700 transition text-center mb-2">
                    Tambah ke Itinerary
                </a>
                <a href="#" class="block w-full px-6 py-3 border-2 border-brand-600 text-brand-600 font-semibold rounded-lg hover:bg-brand-50 transition text-center">
                    Bagikan
                </a>
            </div>
        </div>
    </div>
</div>

@endsection