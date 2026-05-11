@extends('layouts.landing')

@section('title', 'Jelajah Bali')

@section('content')

{{-- Hero Section --}}
<section class="landing-hero">
    <div class="landing-hero-content">
        <span class="landing-tag">INTELLIGENT RECOMMENDATION ENGINE</span>
        <h1>Sistem Rekomendasi Wisata <span class="landing-highlight">Pulau Bali</span></h1>

        <div class="landing-hero-buttons">
            <a href="{{ route('user.destinations') }}" class="landing-btn-primary">
                Mulai Cari Wisata →
            </a>

            <button class="landing-btn-secondary">
                Pelajari Metode
            </button>
        </div>
    </div>
</section>


{{-- Features Section --}}
<section class="landing-features">

    <div class="landing-features-header">

        <div class="landing-features-left">
            <span class="landing-section-tag">CORE CAPABILITIES</span>
            <h2>Fitur Cerdas Unggulan</h2>
        </div>

        <p class="landing-features-desc">
            Menyeimbangkan preferensi subjektif Anda dengan perhitungan sistematis
            untuk hasil yang tidak hanya akurat, namun juga personal.
        </p>

    </div>


    <div class="landing-features-grid">

        <div class="landing-feature-card light">

            <div class="landing-feature-icon">☰</div>

            <h3>Rekomendasi Preferensi</h3>

            <p>
                Sesuaikan kriteria pencarian mulai dari budget,
                jenis aktivitas, hingga tingkat keramaian
                untuk mendapatkan hasil yang dipersonalisasi.
            </p>

            <div class="landing-feature-tags">
                <span>Budget-friendly</span>
                <span>Solo-suitable</span>
                <span>Cultural</span>
            </div>

        </div>


        <div class="landing-feature-card dark">

            <div class="landing-feature-icon">⇄</div>

            <h3>Similar Destinations</h3>

            <p>
                Temukan permata tersembunyi yang memiliki karakteristik
                serupa dengan destinasi favorit Anda melalui analisis
                kesamaan atribut.
            </p>

            <a href="#" class="landing-explore-link">
                EXPLORE NEARBY ↗
            </a>

        </div>


        <div class="landing-feature-card image-card">

            <div class="landing-feature-card-overlay">

                <span class="landing-card-badge">
                    BALI EXPLORATION
                </span>

                <h3>Discover Tegalalang</h3>

                <span class="landing-card-rating">
                    ★ 9.6 Rating
                </span>

            </div>

        </div>

    </div>

</section>


{{-- Wisata Terpopuler --}}
<section class="landing-popular">

    <div class="landing-popular-header">
        <h2>Wisata Terpopuler Saat Ini</h2>
        <p>horizon engine recommends these curated experiences.</p>
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

            <a href="{{ route('user.destinations') }}"
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