@extends('layouts.app')

@section('title', 'Kebijakan Privasi Admin — Jelajah Bali')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght=400;500;600;700&display=swap" rel="stylesheet">
<style>
    body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f4f7fc; }
</style>
@endpush

@section('body')
<div class="max-w-3xl mx-auto px-4 py-12">
    <div class="bg-white p-8 md:p-10 rounded-2xl border border-gray-100 shadow-sm">
        <span class="text-[10px] font-bold text-[#0071a9] tracking-wider uppercase bg-blue-50 px-2.5 py-1 rounded-md">Aturan Internal</span>
        <h1 class="text-2xl font-bold text-gray-900 mt-3">Kebijakan Privasi & Keamanan Portal Admin</h1>
        <p class="text-xs text-gray-400 mt-1">Terakhir diperbarui: Juni 2026</p>
        
        <hr class="my-6 border-gray-100">

        <div class="space-y-6 text-sm text-gray-600 leading-relaxed">
            <section>
                <h3 class="font-bold text-gray-800 text-base mb-2">1. Pengumpulan Informasi Akun</h3>
                <p>Kami mencatat aktivitas log-in admin, termasuk alamat IP, tipe perangkat yang digunakan, dan waktu akses demi keamanan ekosistem manajemen Jelajah Bali. Kata sandi akun Anda dienkripsi penuh menggunakan algoritma *hash* standar industri (Bcrypt).</p>
            </section>

            <section>
                <h3 class="font-bold text-gray-800 text-base mb-2">2. Pengolahan Data Destinasi Wisata</h3>
                <p>Setiap data gambar, koordinat lokasi, dan deskripsi tempat wisata yang Anda unggah menjadi hak milik konten platform Jelajah Bali. Admin dilarang menyalahgunakan data pribadi *user* atau *kontributor* yang tertera di panel kelola user untuk kepentingan di luar operasional.</p>
            </section>

            <section>
                <h3 class="font-bold text-gray-800 text-base mb-2">3. Sesi & Cookie Keamanan</h3>
                <p>Fitur *"Keep me logged in"* menggunakan token enkripsi berbasis *cookie* di peramban Anda. Sesi ini akan otomatis kedaluwarsa dalam waktu yang telah ditentukan demi mencegah penyalahgunaan hak akses jika perangkat ditinggalkan.</p>
            </section>
        </div>

        <div class="mt-8 pt-6 border-t border-gray-100 flex justify-between items-center">
            <p class="text-xs text-gray-400">Ada pertanyaan hukum? Hubungi IT legal ekosistem.</p>
            <a href="{{ route('admin.login') }}" class="text-xs font-semibold text-[#0071a9] hover:underline">Saya Mengerti</a>
        </div>
    </div>
</div>
@endsection