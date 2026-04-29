@extends('layouts.landing')

@section('title', 'Jelajah Bali')

@section('content')

{{-- Hero Section --}}
<section class="landing-hero">
    <div class="landing-hero-content">
        <span class="landing-tag">INTELLIGENT RECOMMENDATION ENGINE</span>
        <h1>Sistem Rekomendasi Wisata <span class="landing-highlight">Pulau Bali</span></h1>
        <div class="landing-hero-buttons">
            <button class="landing-btn-primary">Mulai Cari Wisata →</button>
            <button class="landing-btn-secondary">Pelajari Metode</button>
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
        <p class="landing-features-desc">Menyeimbangkan preferensi subjektif Anda dengan perhitungan sistematis untuk hasil yang tidak hanya akurat, namun juga personal.</p>
    </div>

    <div class="landing-features-grid">
        <div class="landing-feature-card light">
            <div class="landing-feature-icon">☰</div>
            <h3>Rekomendasi Preferensi</h3>
            <p>Sesuaikan kriteria pencarian mulai dari budget, jenis aktivitas, hingga tingkat keramaian untuk mendapatkan hasil yang dipersonalisasi.</p>
            <div class="landing-feature-tags">
                <span>Budget-friendly</span>
                <span>Solo-suitable</span>
                <span>Cultural</span>
            </div>
        </div>

        <div class="landing-feature-card dark">
            <div class="landing-feature-icon">⇄</div>
            <h3>Similar Destinations</h3>
            <p>Temukan permata tersembunyi yang memiliki karakteristik serupa dengan destinasi favorit Anda melalui analisis kesamaan atribut.</p>
            <a href="#" class="landing-explore-link">EXPLORE NEARBY ↗</a>
        </div>

        <div class="landing-feature-card image-card">
            <div class="landing-feature-card-overlay">
                <span class="landing-card-badge">BALI EXPLORATION</span>
                <h3>Discover Tegalalang</h3>
                <span class="landing-card-rating">★ 9.6 Rating</span>
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

        <div class="landing-popular-card">
            <div class="landing-popular-img img-uluwatu">
                <span class="landing-pop-badge heritage">HERITAGE</span>
                <div class="landing-pop-match">● 88% MATCH</div>
            </div>
            <div class="landing-popular-info">
                <h4>Uluwatu Temple</h4>
                <p>Pecatu, South Kuta</p>
                <div class="landing-pop-tags">
                    <span>Coastal</span><span>Spiritual</span><span>Performance</span>
                </div>
                <div class="landing-pop-footer">
                    <div class="landing-pop-footer-item">
                        <span class="landing-pop-footer-label">PRICE</span>
                        <span class="landing-pop-footer-value">IDR 50,000</span>
                    </div>
                    <div class="landing-pop-footer-item align-end">
                        <span class="landing-pop-footer-label">RATING</span>
                        <span class="landing-pop-footer-value rating">4.7</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="landing-popular-card">
            <div class="landing-popular-img img-tirta">
                <span class="landing-pop-badge spiritual">SPIRITUAL</span>
                <div class="landing-pop-match">● 82% MATCH</div>
            </div>
            <div class="landing-popular-info">
                <h4>Tirta Empul</h4>
                <p>Manukaya, Tampaksiring</p>
                <div class="landing-pop-tags">
                    <span>Culture</span><span>Water</span><span>Healing</span>
                </div>
                <div class="landing-pop-footer">
                    <div class="landing-pop-footer-item">
                        <span class="landing-pop-footer-label">PRICE</span>
                        <span class="landing-pop-footer-value">IDR 80,000</span>
                    </div>
                    <div class="landing-pop-footer-item align-end">
                        <span class="landing-pop-footer-label">RATING</span>
                        <span class="landing-pop-footer-value rating">4.7</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="landing-popular-card">
            <div class="landing-popular-img img-ulundanu">
                <span class="landing-pop-badge landmark">LANDMARK</span>
                <div class="landing-pop-match">● 76% MATCH</div>
            </div>
            <div class="landing-popular-info">
                <h4>Ulun Danu Bratan</h4>
                <p>Candikuning, Baturiti</p>
                <div class="landing-pop-tags">
                    <span>Lakeside</span><span>Serene</span><span>Iconic</span>
                </div>
                <div class="landing-pop-footer">
                    <div class="landing-pop-footer-item">
                        <span class="landing-pop-footer-label">PRICE</span>
                        <span class="landing-pop-footer-value">Free Entry</span>
                    </div>
                    <div class="landing-pop-footer-item align-end">
                        <span class="landing-pop-footer-label">RATING</span>
                        <span class="landing-pop-footer-value rating">4.6</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="landing-popular-card">
            <div class="landing-popular-img img-tanahlot">
                <span class="landing-pop-badge nature">NATURE</span>
                <div class="landing-pop-match">● 74% MATCH</div>
            </div>
            <div class="landing-popular-info">
                <h4>Tanah Lot</h4>
                <p>Beraban, Tabanan</p>
                <div class="landing-pop-tags">
                    <span>Coastal</span><span>Sunset</span><span>Iconic</span>
                </div>
                <div class="landing-pop-footer">
                    <div class="landing-pop-footer-item">
                        <span class="landing-pop-footer-label">PRICE</span>
                        <span class="landing-pop-footer-value">IDR 15,000</span>
                    </div>
                    <div class="landing-pop-footer-item align-end">
                        <span class="landing-pop-footer-label">RATING</span>
                        <span class="landing-pop-footer-value rating">4.8</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="landing-popular-card">
            <div class="landing-popular-img img-ubud">
                <span class="landing-pop-badge culture">CULTURE</span>
                <div class="landing-pop-match">● 71% MATCH</div>
            </div>
            <div class="landing-popular-info">
                <h4>Ubud</h4>
                <p>Ubud, Gianyar</p>
                <div class="landing-pop-tags">
                    <span>Art</span><span>Forest</span><span>Wellness</span>
                </div>
                <div class="landing-pop-footer">
                    <div class="landing-pop-footer-item">
                        <span class="landing-pop-footer-label">PRICE</span>
                        <span class="landing-pop-footer-value">IDR 20,000</span>
                    </div>
                    <div class="landing-pop-footer-item align-end">
                        <span class="landing-pop-footer-label">RATING</span>
                        <span class="landing-pop-footer-value rating">4.5</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="landing-popular-card">
            <div class="landing-popular-img img-seminyak">
                <span class="landing-pop-badge nature">NATURE</span>
                <div class="landing-pop-match">● 68% MATCH</div>
            </div>
            <div class="landing-popular-info">
                <h4>Seminyak Beach</h4>
                <p>Seminyak, Kuta Utara</p>
                <div class="landing-pop-tags">
                    <span>Beach</span><span>Sunset</span><span>Lifestyle</span>
                </div>
                <div class="landing-pop-footer">
                    <div class="landing-pop-footer-item">
                        <span class="landing-pop-footer-label">PRICE</span>
                        <span class="landing-pop-footer-value">Free Entry</span>
                    </div>
                    <div class="landing-pop-footer-item align-end">
                        <span class="landing-pop-footer-label">RATING</span>
                        <span class="landing-pop-footer-value rating">4.6</span>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

{{-- CTA Section --}}
<section class="landing-cta-wrapper">
    <div class="landing-cta">
        <h2>Siap Menemukan Sisi Lain Bali?</h2>
        <p>Biarkan algoritma kami bekerja untuk Anda. Temukan destinasi yang benar-benar cocok dengan jiwa petualang Anda.</p>
        <div class="landing-cta-buttons">
            <a href="{{ route('destinations') }}" class="landing-cta-btn primary">Mulai Cari Wisata Sekarang</a>
            <a href="#" class="landing-cta-btn secondary">Lihat Demo Sistem</a>
        </div>
    </div>
</section>

@endsection