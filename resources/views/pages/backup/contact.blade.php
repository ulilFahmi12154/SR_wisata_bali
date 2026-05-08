@extends('layouts.app')

@section('title', 'Kontak')

@section('content')

<div class="max-w-4xl mx-auto py-12">
    {{-- Header --}}
    <div class="mb-12 mt-8">
        <p class="text-brand-600 text-sm font-semibold tracking-widest uppercase mb-3">KONTAK</p>
        <h1 class="font-display text-4xl font-bold text-slate-900 mb-4">
            Hubungi <span class="text-brand-600">Tim Kami</span>
        </h1>
        <p class="text-slate-600 text-lg max-w-2xl">
            Punya pertanyaan, masukan, atau ingin berkolaborasi? Silakan hubungi kami melalui kontak resmi berikut.
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
        {{-- Contact Info --}}
        <div class="bg-white rounded-xl p-8 border border-slate-200 shadow-md">
            <h2 class="text-2xl font-bold text-slate-900 mb-6">📍 Informasi Kontak</h2>
            <div class="space-y-4">
                <div>
                    <p class="text-sm text-slate-600 mb-1">Email</p>
                    <p class="text-lg font-semibold text-slate-900">hello@jelajahbali.app</p>
                </div>
                <div>
                    <p class="text-sm text-slate-600 mb-1">Telepon</p>
                    <p class="text-lg font-semibold text-slate-900">+62 361 000 111</p>
                </div>
                <div>
                    <p class="text-sm text-slate-600 mb-1">Alamat</p>
                    <p class="text-lg font-semibold text-slate-900">Denpasar, Bali, Indonesia</p>
                </div>
            </div>
        </div>

        {{-- Operating Hours --}}
        <div class="bg-white rounded-xl p-8 border border-slate-200 shadow-md">
            <h2 class="text-2xl font-bold text-slate-900 mb-6">🕐 Jam Operasional</h2>
            <div class="space-y-3">
                <div class="flex justify-between">
                    <p class="text-slate-600">Senin - Jumat</p>
                    <p class="font-semibold text-slate-900">09:00 - 18:00 WITA</p>
                </div>
                <div class="flex justify-between">
                    <p class="text-slate-600">Sabtu</p>
                    <p class="font-semibold text-slate-900">10:00 - 15:00 WITA</p>
                </div>
                <div class="flex justify-between">
                    <p class="text-slate-600">Minggu & Hari Libur</p>
                    <p class="font-semibold text-slate-900 text-red-600">Tutup</p>
                </div>
            </div>
            <a href="mailto:hello@jelajahbali.app" class="block w-full mt-6 px-6 py-3 bg-brand-600 text-white font-semibold rounded-lg hover:bg-brand-700 transition text-center">
                📧 Kirim Email
            </a>
        </div>
    </div>

    {{-- Contact Form --}}
    <div class="bg-white rounded-xl p-8 border border-slate-200 shadow-md">
        <h2 class="text-2xl font-bold text-slate-900 mb-6">✉️ Form Kontak</h2>
        <form class="space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Nama</label>
                    <input type="text" placeholder="Nama lengkap Anda" class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:ring-2 focus:ring-brand-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Email</label>
                    <input type="email" placeholder="email@example.com" class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:ring-2 focus:ring-brand-500">
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2">Subjek</label>
                <input type="text" placeholder="Subjek pesan Anda" class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:ring-2 focus:ring-brand-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2">Pesan</label>
                <textarea rows="5" placeholder="Tulis pesan Anda di sini..." class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:ring-2 focus:ring-brand-500"></textarea>
            </div>
            <button type="submit" class="w-full px-6 py-3 bg-brand-600 text-white font-semibold rounded-lg hover:bg-brand-700 transition">
                Kirim Pesan
            </button>
        </form>
    </div>
</div>

@endsection
