@extends('layouts.app')

@section('title', 'Tentang Kami')

@section('content')

<div class="max-w-4xl mx-auto py-12">
    {{-- Header --}}
    <div class="mb-12 mt-8">
        <p class="text-brand-600 text-sm font-semibold tracking-widest uppercase mb-3">Tentang</p>
        <h1 class="font-display text-4xl font-bold text-slate-900 mb-4">
            Tentang <span class="text-brand-600">Jelajah Bali</span>
        </h1>
        <p class="text-slate-600 text-lg max-w-2xl">
            Jelajah Bali adalah platform rekomendasi wisata yang membantu pengguna memilih destinasi berdasarkan preferensi, budget, dan fasilitas yang tersedia.
        </p>
    </div>

    {{-- Content --}}
    <div class="space-y-8">
        {{-- Mission --}}
        <div class="bg-white rounded-xl p-8 border border-slate-200 shadow-md">
            <h2 class="text-2xl font-bold text-slate-900 mb-4">🎯 Misi Kami</h2>
            <p class="text-slate-600 leading-relaxed">
                Memberikan pengalaman yang praktis dan berbasis data untuk menemukan destinasi wisata paling sesuai di Bali dengan antarmuka yang lebih bersih dan ramah pengguna. Kami percaya bahwa setiap wisatawan memiliki preferensi unik, dan teknologi harus membantu mereka menemukan tempat sempurna tanpa kebingungan.
            </p>
        </div>

        {{-- Vision --}}
        <div class="bg-white rounded-xl p-8 border border-slate-200 shadow-md">
            <h2 class="text-2xl font-bold text-slate-900 mb-4">🌟 Visi Kami</h2>
            <p class="text-slate-600 leading-relaxed">
                Menjadi platform rekomendasi wisata terpercaya yang menghubungkan jutaan wisatawan dengan destinasi impian mereka di Bali. Kami ingin menciptakan ekosistem pariwisata yang berkelanjutan dan menguntungkan bagi semua pihak.
            </p>
        </div>

        {{-- Features --}}
        <div class="bg-white rounded-xl p-8 border border-slate-200 shadow-md">
            <h2 class="text-2xl font-bold text-slate-900 mb-6">✨ Fitur Unggulan</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="flex gap-4">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 rounded-lg bg-brand-100 flex items-center justify-center text-brand-600 text-xl">
                            🤖
                        </div>
                    </div>
                    <div>
                        <h3 class="font-semibold text-slate-900 mb-2">Mesin Rekomendasi Cerdas</h3>
                        <p class="text-sm text-slate-600">Algoritma AI yang mempelajari preferensi Anda untuk memberikan rekomendasi yang semakin akurat.</p>
                    </div>
                </div>
                <div class="flex gap-4">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 rounded-lg bg-brand-100 flex items-center justify-center text-brand-600 text-xl">
                            💰
                        </div>
                    </div>
                    <div>
                        <h3 class="font-semibold text-slate-900 mb-2">Filter Budget</h3>
                        <p class="text-sm text-slate-600">Temukan destinasi yang sesuai dengan budget Anda tanpa mengorbankan kualitas pengalaman.</p>
                    </div>
                </div>
                <div class="flex gap-4">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 rounded-lg bg-brand-100 flex items-center justify-center text-brand-600 text-xl">
                            🏨
                        </div>
                    </div>
                    <div>
                        <h3 class="font-semibold text-slate-900 mb-2">Detail Fasilitas</h3>
                        <p class="text-sm text-slate-600">Informasi lengkap tentang fasilitas yang tersedia di setiap destinasi wisata.</p>
                    </div>
                </div>
                <div class="flex gap-4">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 rounded-lg bg-brand-100 flex items-center justify-center text-brand-600 text-xl">
                            ⭐
                        </div>
                    </div>
                    <div>
                        <h3 class="font-semibold text-slate-900 mb-2">Rating & Review</h3>
                        <p class="text-sm text-slate-600">Baca pengalaman wisatawan lain untuk membantu Anda membuat keputusan terbaik.</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Team --}}
        <div class="bg-white rounded-xl p-8 border border-slate-200 shadow-md">
            <h2 class="text-2xl font-bold text-slate-900 mb-4">👥 Tim Kami</h2>
            <p class="text-slate-600 mb-6">
                Jelajah Bali dikembangkan oleh tim mahasiswa yang passionate tentang teknologi dan pariwisata. Kami bekerja sama untuk menciptakan solusi yang inovatif dan user-friendly.
            </p>
            <p class="text-slate-600">
                <strong>Kelompok 3 - Sistem Rekomendasi Wisata Bali</strong><br>
                Universitas [Nama Universitas] - 2026
            </p>
        </div>
    </div>
</div>

@endsection
