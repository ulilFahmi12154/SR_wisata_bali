@extends('layouts.app')

@section('title', 'Pusat Bantuan Admin — Jelajah Bali')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght=400;500;600;700&display=swap" rel="stylesheet">
<style>
    body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f4f7fc; }
</style>
@endpush

@section('body')
<div class="max-w-4xl mx-auto px-4 py-12">
    {{-- Header --}}
    <div class="text-center mb-10">
        <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Ada yang bisa kami bantu, Admin?</h1>
        <p class="text-gray-500 text-sm mt-2">Temukan panduan cepat dan jawaban atas kendala teknis pengelolaan dashboard.</p>
    </div>

    {{-- Kategori Bantuan --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-10">
        <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm">
            <div class="w-10 h-10 rounded-xl bg-blue-50 text-[#0071a9] flex items-center justify-center mb-3">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
            </div>
            <h3 class="font-bold text-gray-800 text-sm">Kelola Destinasi</h3>
            <p class="text-xs text-gray-400 mt-1">Panduan menambah, mengubah, dan menghapus data konten wisata Bali.</p>
        </div>
        <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm">
            <div class="w-10 h-10 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center mb-3">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
            </div>
            <h3 class="font-bold text-gray-800 text-sm">Manajemen User</h3>
            <p class="text-xs text-gray-400 mt-1">Mengatur hak akses kontributor, verifikasi akun, dan blokir akun.</p>
        </div>
        <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm">
            <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center mb-3">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 002 2h2a2 2 0 002-2"/></svg>
            </div>
            <h3 class="font-bold text-gray-800 text-sm">Metrik Analitik</h3>
            <p class="text-xs text-gray-400 mt-1">Memahami grafik tren kunjungan, diagram donat, dan ekspor laporan.</p>
        </div>
    </div>

    {{-- FAQ Section --}}
    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm space-y-4">
        <h2 class="text-base font-bold text-gray-800 mb-2">Pertanyaan Sering Diajukan (FAQ)</h2>
        
        <div class="border-b border-gray-100 pb-3">
            <h4 class="font-semibold text-sm text-gray-800">Bagaimana jika grafik analitik tidak memuat data terbaru?</h4>
            <p class="text-xs text-gray-500 mt-1">Coba lakukan *hard refresh* (Ctrl + F5) atau periksa filter tanggal di pojok kanan atas dashboard untuk memastikan rentang waktu sudah benar.</p>
        </div>
        <div class="border-b border-gray-100 pb-3">
            <h4 class="font-semibold text-sm text-gray-800">Bagaimana cara memberikan hak akses ke admin baru?</h4>
            <p class="text-xs text-gray-500 mt-1">Buka menu **Kelola User**, klik tombol *Add New Admin*, masukkan email instansi mereka, lalu atur peran sebagai Super Admin atau Moderator.</p>
        </div>
    </div>

    <div class="text-center mt-8">
        <a href="{{ route('admin.login') }}" class="text-xs font-semibold text-[#0071a9] hover:underline">&larr; Kembali ke Portal</a>
    </div>
</div>
@endsection