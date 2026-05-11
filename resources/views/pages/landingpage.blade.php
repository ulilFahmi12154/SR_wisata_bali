@extends('layouts.landing')

@section('title', 'Jelajah Bali')

@section('content')

{{-- Hero Section --}}
<section class="landing-hero">
    <div class="landing-hero-content">
        <span class="landing-tag">SISTEM PENDUKUNG KEPUTUSAN WISATA</span>
        <h1>Sistem Rekomendasi Wisata <span class="landing-highlight">Pulau Bali</span></h1>

        <div class="landing-hero-buttons">
            <a href="{{ route('user.home') }}" class="landing-btn-primary">
                Mulai Cari Wisata →
            </a>

            <button class="landing-btn-secondary">
                Pelajari Metode SAW
            </button>
        </div>
    </div>
</section>


{{-- Features Section --}}
<section class="landing-features">

    <div class="landing-features-header">

        <div class="landing-features-left">
            <span class="landing-section-tag">FITUR UTAMA</span>
            <h2>Keputusan Perjalanan Cerdas</h2>
        </div>

        <p class="landing-features-desc">
            Menggabungkan kriteria preferensi Anda dengan perhitungan algoritma SAW
            untuk memberikan hasil rekomendasi yang objektif dan personal.
        </p>

    </div>


    <div class="landing-features-grid">

        <div class="landing-feature-card light">

            <div class="landing-feature-icon">☰</div>

            <h3>Analisis Multi-Kriteria</h3>

            <p>
                Perhitungan matang berdasarkan berbagai kriteria mulai dari budget,
                fasilitas, hingga rating untuk mendapatkan hasil terbaik.
            </p>

            <div class="landing-feature-tags">
                <span>Hemat Biaya</span>
                <span>Fasilitas Lengkap</span>
                <span>Rating Tinggi</span>
            </div>

        </div>


        <div class="landing-feature-card dark">

            <div class="landing-feature-icon">⇄</div>

            <h3>Destinasi Serupa</h3>

            <p>
                Temukan tempat wisata lain yang memiliki karakteristik
                serupa melalui analisis data atribut yang mendalam.
            </p>

            <a href="{{ route('user.home') }}" class="landing-explore-link">
                MULAI JELAJAH ↗
            </a>

        </div>


        <div class="landing-feature-card image-card">

            <div class="landing-feature-card-overlay">

                <span class="landing-card-badge">
                    EKSPLORASI BALI
                </span>

                <h3>Keindahan Tegalalang</h3>

                <span class="landing-card-rating">
                    ★ 4.8 Rating
                </span>

            </div>

        </div>

    </div>

</section>


{{-- Wisata Terpopuler --}}
<section class="landing-popular">

    <div class="landing-popular-header">
        <h2>Wisata Terpopuler Saat Ini</h2>
        <p>Rekomendasi destinasi pilihan berdasarkan skor popularitas tertinggi.</p>
    </div>

    <div class="landing-popular-grid">

        @foreach ($wisataPopuler as $wisata)

            @php
                $imgPath = str_replace('/public/', '', $wisata->image);
                $imgUrl = asset(str_replace(' ', '%20', $imgPath));
            @endphp

            <div class="landing-popular-card">

                <div class="landing-popular-img"
                     style="background-image: url('{{ $imgUrl }}')">

                    <div class="landing-pop-match">
                        ● {{ round($wisata->popularity_score) }} SCORE
                    </div>

                </div>

                <div class="landing-popular-info">

                    <h4>{{ $wisata->nama }}</h4>

                    <p>
                        {{ $wisata->lokasi->nama_kabupaten ?? '-' }}
                    </p>

                    <div class="landing-pop-tags">

                        <span>
                            {{ $wisata->kategori->nama_kategori ?? '-' }}
                        </span>

                        <span>
                            Rating {{ $wisata->rating }}
                        </span>

                    </div>

                    <div class="landing-pop-footer">

                        <div class="landing-pop-footer-item">
                            <span class="landing-pop-footer-label">
                                PRICE
                            </span>

                            <span class="landing-pop-footer-value">
                                IDR {{ number_format($wisata->harga_wni_min) }}
                            </span>
                        </div>

                        <div class="landing-pop-footer-item align-end">
                            <span class="landing-pop-footer-label">
                                RATING
                            </span>

                            <span class="landing-pop-footer-value rating">
                                {{ $wisata->rating }}
                            </span>
                        </div>

                    </div>

                </div>

            </div>

        @endforeach

    </div>

</section>


{{-- CTA Section --}}
<section class="landing-cta-wrapper">

    <div class="landing-cta">

        <h2>Siap Menemukan Sisi Lain Bali?</h2>

        <p>
            Biarkan algoritma kami bekerja untuk Anda.
            Temukan destinasi yang benar-benar cocok
            dengan jiwa petualang Anda.
        </p>

        <div class="landing-cta-buttons">

            <a href="{{ route('user.home') }}"
               class="landing-cta-btn primary">
                Mulai Cari Wisata Sekarang
            </a>

            <a href="#"
               class="landing-cta-btn secondary">
                Lihat Demo Sistem
            </a>

        </div>

    </div>

</section>

@endsection