@extends('layouts.app')

@section('title', 'Dukungan Teknis IT — Jelajah Bali')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght=400;500;600;700&display=swap" rel="stylesheet">
<style>
    body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f4f7fc; }
</style>
@endpush

@section('body')
<div class="max-w-lg mx-auto px-4 py-12">
    <div class="bg-white p-6 md:p-8 rounded-2xl border border-gray-100 shadow-sm">
        <h1 class="text-xl font-bold text-gray-900 tracking-tight">Laporkan Masalah Sistem</h1>
        <p class="text-xs text-gray-400 mt-1">Mengalami kendala, *bug*, atau sistem lambat? Kirim tiket laporan ke tim pengembang.</p>

        <form action="#" method="POST" class="mt-6 space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-semibold text-gray-700 mb-1">Nama Pengembang / Admin</label>
                <input type="text" class="w-full text-xs px-3 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:border-[#0071a9] transition" value="Admin Jelajah" readonly>
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-700 mb-1">Tingkat Urgensi</label>
                <select class="w-full text-xs px-3 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:border-[#0071a9] transition text-gray-700">
                    <option value="low">Rendah (Saran Fitur / Typo Konten)</option>
                    <option value="medium" selected>Sedang (Gagal Upload Gambar / Salah Tampilan)</option>
                    <option value="high">Tinggi (Sistem Error 500 / Data Hilang)</option>
                </select>
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-700 mb-1">Detail Kendala</label>
                <textarea rows="4" class="w-full text-xs px-3 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:border-[#0071a9] transition placeholder-gray-400" placeholder="Tuliskan kronologi error secara singkat, sertakan kode error jika ada..."></textarea>
            </div>

            <button type="submit" class="w-full bg-[#0071a9] hover:bg-[#005e8c] text-white font-semibold text-xs py-2.5 rounded-xl transition shadow-sm">
                Kirim Tiket Laporan
            </button>
        </form>

        <div class="mt-6 border-t border-gray-50 pt-4 text-center">
            <p class="text-xs text-gray-400">Butuh respons cepat? Kontak via <a href="https://wa.me/628123456789" class="text-emerald-500 font-bold hover:underline">WhatsApp Dev Team</a></p>
        </div>
    </div>
    
    <div class="text-center mt-6">
        <a href="{{ route('admin.login') }}" class="text-xs font-semibold text-gray-400 hover:text-gray-600 transition">Batal & Kembali</a>
    </div>
</div>
@endsection