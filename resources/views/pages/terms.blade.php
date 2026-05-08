@extends('layouts.app')

@section('title', 'Syarat Penggunaan')

@section('content')

<div class="max-w-4xl mx-auto py-12">
    <div class="mb-8 mt-8">
        <p class="text-brand-600 text-sm font-semibold tracking-widest uppercase mb-3">SYARAT PENGGUNAAN</p>
        <h1 class="font-display text-4xl font-bold text-slate-900 mb-4">
            Syarat <span class="text-brand-600">Penggunaan</span>
        </h1>
        <p class="text-slate-600 text-lg max-w-2xl">
            Dengan menggunakan Jelajah Bali, Anda setuju pada ketentuan penggunaan berikut untuk menjaga pengalaman penggunaan tetap aman dan adil.
        </p>
    </div>

    <div class="bg-white rounded-xl p-8 border border-slate-200 shadow-md space-y-8">
        <div>
            <h2 class="text-2xl font-bold text-slate-900 mb-4">📋 Ketentuan Umum</h2>
            <ul class="text-slate-600 space-y-3 list-disc list-inside leading-relaxed">
                <li>Informasi rekomendasi bersifat panduan dan dapat berubah sesuai kondisi lapangan.</li>
                <li>Pengguna bertanggung jawab atas keputusan perjalanan yang diambil berdasarkan rekomendasi kami.</li>
                <li>Dilarang menggunakan platform untuk aktivitas yang melanggar hukum atau merugikan pihak lain.</li>
                <li>Anda wajib memberikan informasi yang akurat dan terkini dalam setiap interaksi.</li>
            </ul>
        </div>

        <div>
            <h2 class="text-2xl font-bold text-slate-900 mb-4">⚖️ Batasan Tanggung Jawab</h2>
            <ul class="text-slate-600 space-y-3 list-disc list-inside leading-relaxed">
                <li>Tim tidak menjamin ketersediaan destinasi, harga, atau layanan pihak ketiga.</li>
                <li>Tim tidak bertanggung jawab atas kerugian tidak langsung dari penggunaan platform.</li>
                <li>Kami tidak memberikan jaminan tentang keakuratan, kecukupan, atau relevansi informasi yang disediakan.</li>
            </ul>
        </div>

        <div>
            <h2 class="text-2xl font-bold text-slate-900 mb-4">🔐 Keamanan Akun</h2>
            <ul class="text-slate-600 space-y-3 list-disc list-inside leading-relaxed">
                <li>Pengguna bertanggung jawab menjaga kerahasiaan password dan akun mereka.</li>
                <li>Segera beritahu kami jika terjadi akses tidak sah ke akun Anda.</li>
                <li>Jangan bagikan informasi login Anda kepada pihak lain.</li>
            </ul>
        </div>

        <div>
            <h2 class="text-2xl font-bold text-slate-900 mb-4">🚫 Penggunaan Terlarang</h2>
            <p class="text-slate-600 leading-relaxed mb-3">
                Anda tidak boleh menggunakan platform untuk:
            </p>
            <ul class="text-slate-600 space-y-2 list-disc list-inside">
                <li>Aktivitas ilegal atau tidak bermoral</li>
                <li>Spam, harassment, atau ancaman terhadap pengguna lain</li>
                <li>Mengunggah malware atau konten berbahaya</li>
                <li>Melanggar hak cipta atau kekayaan intelektual</li>
            </ul>
        </div>

        <div>
            <h2 class="text-2xl font-bold text-slate-900 mb-4">✏️ Perubahan Layanan</h2>
            <p class="text-slate-600 leading-relaxed">
                Kami berhak memodifikasi atau menghentikan layanan kapan saja tanpa pemberitahuan sebelumnya. Kami juga berhak mengubah syarat dan ketentuan penggunaan sewaktu-waktu. Penggunaan berkelanjutan berarti Anda menerima perubahan tersebut.
            </p>
        </div>

        <div class="bg-slate-50 p-4 rounded-lg border border-slate-200">
            <p class="text-sm text-slate-600">
                <strong>Terakhir diperbarui:</strong> 27 April 2026
            </p>
        </div>
    </div>
</div>

@endsection
