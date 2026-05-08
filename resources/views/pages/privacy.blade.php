@extends('layouts.app')

@section('title', 'Kebijakan Privasi')

@section('content')

<div class="max-w-4xl mx-auto py-12">
    <div class="mb-8 mt-8">
        <p class="text-brand-600 text-sm font-semibold tracking-widest uppercase mb-3">KEBIJAKAN PRIVASI</p>
        <h1 class="font-display text-4xl font-bold text-slate-900 mb-4">
            Kebijakan <span class="text-brand-600">Privasi</span>
        </h1>
        <p class="text-slate-600 text-lg max-w-2xl">
            Dokumen ini menjelaskan data apa yang dikumpulkan oleh Jelajah Bali, bagaimana data digunakan, dan pilihan pengguna terkait privasi.
        </p>
    </div>

    <div class="bg-white rounded-xl p-8 border border-slate-200 shadow-md space-y-8">
        <div>
            <h2 class="text-2xl font-bold text-slate-900 mb-4">📊 Data yang Dikumpulkan</h2>
            <ul class="text-slate-600 space-y-3 list-disc list-inside leading-relaxed">
                <li>Preferensi wisata seperti minat, anggaran, dan fasilitas yang dipilih.</li>
                <li>Data teknis dasar seperti waktu akses dan jenis perangkat untuk evaluasi performa.</li>
                <li>Informasi kontak yang Anda kirim secara sukarela melalui halaman Contact.</li>
            </ul>
        </div>

        <div>
            <h2 class="text-2xl font-bold text-slate-900 mb-4">🔄 Penggunaan Data</h2>
            <ul class="text-slate-600 space-y-3 list-disc list-inside leading-relaxed">
                <li>Menyusun rekomendasi destinasi yang lebih relevan untuk Anda.</li>
                <li>Meningkatkan kualitas pengalaman pengguna dan stabilitas sistem.</li>
                <li>Merespons pertanyaan atau masukan dari pengguna dengan cepat.</li>
                <li>Menganalisis tren penggunaan untuk pengembangan fitur baru.</li>
            </ul>
        </div>

        <div>
            <h2 class="text-2xl font-bold text-slate-900 mb-4">🔒 Keamanan Data</h2>
            <p class="text-slate-600 leading-relaxed">
                Kami berkomitmen melindungi data pribadi Anda dengan menggunakan enkripsi tingkat enterprise dan protokol keamanan terkini. Namun, tidak ada sistem yang benar-benar 100% aman. Jika Anda mencurigai ada pelanggaran keamanan, segera hubungi kami.
            </p>
        </div>

        <div>
            <h2 class="text-2xl font-bold text-slate-900 mb-4">👤 Hak Pengguna</h2>
            <p class="text-slate-600 leading-relaxed mb-3">
                Anda memiliki hak untuk:
            </p>
            <ul class="text-slate-600 space-y-2 list-disc list-inside">
                <li>Mengakses data pribadi yang kami simpan</li>
                <li>Meminta penghapusan data Anda</li>
                <li>Mengubah preferensi privasi kapan saja</li>
            </ul>
        </div>

        <div class="bg-slate-50 p-4 rounded-lg border border-slate-200">
            <p class="text-sm text-slate-600">
                <strong>Terakhir diperbarui:</strong> 27 April 2026
            </p>
        </div>
    </div>
</div>

@endsection
