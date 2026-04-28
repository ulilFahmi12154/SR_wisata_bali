@extends('layouts.app')

@section('title', 'Contact')

@section('content')

<div style="margin-top:40px;">
    <p style="color:#0b5ed7; font-weight:700; letter-spacing:1px; font-size:12px;">CONTACT</p>

    <div class="hero-title">
        Hubungi <span class="blue">Tim Kami</span>
    </div>

    <p style="max-width:780px; color:#4f5b70;">
        Punya pertanyaan, masukan, atau ingin berkolaborasi? Silakan hubungi kami melalui kontak resmi berikut.
    </p>
</div>

<div class="grid" style="margin-top:30px;">
    <div class="card">
        <h3>Informasi Kontak</h3>
        <p style="color:#5a6578; margin-bottom:8px;">Email: hello@jelajahbali.app</p>
        <p style="color:#5a6578; margin-bottom:8px;">Phone: +62 361 000 111</p>
        <p style="color:#5a6578; margin-bottom:0;">Address: Denpasar, Bali, Indonesia</p>
    </div>

    <div class="card">
        <h3>Jam Operasional</h3>
        <p style="color:#5a6578; margin-bottom:8px;">Senin - Jumat: 09.00 - 18.00 WITA</p>
        <p style="color:#5a6578; margin-bottom:8px;">Sabtu: 10.00 - 15.00 WITA</p>
        <p style="color:#5a6578; margin-bottom:20px;">Minggu & Hari Libur: Tutup</p>

        <a class="btn-primary" href="mailto:hello@jelajahbali.app" style="display:inline-flex; justify-content:center; align-items:center; text-decoration:none; max-width:220px;">
            Kirim Email
        </a>
    </div>
</div>

@endsection
