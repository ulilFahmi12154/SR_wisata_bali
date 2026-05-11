@extends('layouts.app')

@section('title', ($destination->nama ?? 'Destination') . ' - Detail')

@section('content')
@php
    $imagePath = $destination->image ?? '';
    $imageUrl = $imagePath 
        ? (preg_match('/^https?:\/\//', $imagePath) ? $imagePath : asset('images/destination/' . ltrim($imagePath, '/')))
        : 'https://images.unsplash.com/photo-1537953773345-d172ccf13cf1?auto=format&fit=crop&w=1200&q=80';
    
    $location = $destination->nama_kabupaten ?? 'Bali';
    $description = $destination->deskripsi ?? $destination->keterangan ?? 'No description available.';
    $entryFee = $destination->harga_wni_min ?? $destination->harga_wna_min;
    $rating = $destination->rating ? number_format($destination->rating, 1) : 'New';
    $category = $destination->nama_kategori ?? 'Destination';
    $operatingHours = $destination->jam_operasional ?? '08:00 - 18:00';
    $mapsLink = $destination->link ?? '#';
@endphp

<div class="destination-detail">
    <!-- Hero Section -->
    <section class="hero-banner" style="background-color: #171c1f; background-image: linear-gradient(180deg, rgba(23, 28, 31, 0) 0%, rgba(23, 28, 31, 0.8) 100%), url('{{ $imageUrl }}');">
        <div class="container hero-content">
            <div class="hero-meta">
                <span class="category-badge">{{ strtoupper($category) }}</span>
                <div class="rating">
                    <img src="{{ asset('images/mok69ali-fm56qoo.svg') }}" alt="Star icon" class="icon-star">
                    <span>{{ $rating }} (Traveler Rating)</span>
                </div>
            </div>
            <h1 class="hero-title">{{ $destination->nama }}</h1>
            <div class="hero-location">
                <img src="{{ asset('images/mok69ali-wgs75rk.svg') }}" alt="Location pin" class="icon-pin">
                <span>{{ $location }}, Bali</span>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <div class="container main-layout">
        <div class="content-left">
            <!-- Description Card -->
            <div class="card info-card">
                <h2 class="section-title">Precision Description</h2>
                <p class="description-text">
                    {{ $description }}
                </p>
                <div class="info-grid">
                    <div class="info-item">
                        <span class="info-label">ENTRANCE FEE</span>
                        <span class="info-value price">{{ $entryFee ? 'IDR ' . number_format($entryFee, 0, ',', '.') : 'Free Entry' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">BEST VISIT</span>
                        <span class="info-value">{{ $operatingHours }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">ACCESSIBILITY</span>
                        <span class="info-value">Easy Access</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">EST. DURATION</span>
                        <span class="info-value">2-4 Hours</span>
                    </div>
                </div>
            </div>

            <!-- Facilities Section -->
            <div class="card facilities-card">
                <div class="facilities-header">
                    <img src="{{ asset('images/mok69ali-ko6krcz.svg') }}" alt="Facilities icon" class="section-icon">
                    <h2 class="section-title-sm">Site Facilities</h2>
                </div>
                <div class="facilities-grid">
                    @forelse($facilities as $facility)
                        <div class="facility-item">
                            <div class="facility-icon-wrapper">
                                @php
                                    $facilityIcon = 'mok69ali-x9v3lix.svg'; // Default icon
                                    $fLower = strtolower($facility);
                                    if (str_contains($fLower, 'parkir')) $facilityIcon = 'mok69ali-wod7egb.svg';
                                    elseif (str_contains($fLower, 'toilet')) $facilityIcon = 'mok69ali-s3atnk2.svg';
                                    elseif (str_contains($fLower, 'toko') || str_contains($fLower, 'market')) $facilityIcon = 'mok69ali-jnu45vc.svg';
                                @endphp
                                <img src="{{ asset('images/' . $facilityIcon) }}" alt="{{ $facility }}">
                            </div>
                            <span>{{ $facility }}</span>
                        </div>
                    @empty
                        <p>No facilities listed.</p>
                    @endforelse
                </div>
            </div>
        </div>

        <aside class="content-right">
            <!-- Booking Sidebar -->
            <div class="card sidebar-card">
                <div class="sidebar-header">
                    <span class="sidebar-eyebrow">CURATED PACKAGE</span>
                    <h2 class="sidebar-title">Standard Access</h2>
                    <div class="sidebar-price">
                        <span class="price-amount">{{ $entryFee ? 'IDR ' . number_format($entryFee / 1000, 0) . 'k' : 'Free' }}</span>
                        <span class="price-unit">/person</span>
                    </div>
                </div>

                <div class="sidebar-features">
                    <div class="sidebar-feature">
                        <img src="{{ asset('images/mok69ali-rx1fx04.svg') }}" alt="Clock" class="feature-icon">
                        <div class="feature-text">
                            <span class="feature-label">OPERATING HOURS</span>
                            <span class="feature-value">{{ $operatingHours }}</span>
                        </div>
                    </div>
                    <div class="sidebar-feature">
                        <img src="{{ asset('images/mok69ali-0jd28pp.svg') }}" alt="Ticket" class="feature-icon">
                        <div class="feature-text">
                            <span class="feature-label">INSTANT ACCESS</span>
                            <span class="feature-value">Digital Entry Available</span>
                        </div>
                    </div>
                </div>

                <div class="sidebar-actions">
                    <button class="btn-book">Book Access Now</button>
                    <button class="btn-itinerary">Save to Itinerary</button>
                </div>

                <div class="map-preview">
                    <img src="https://images.unsplash.com/photo-1524661135-423995f22d0b?auto=format&fit=crop&w=500&q=60" alt="Map Preview" class="map-img">
                    <div class="map-overlay">
                        <a href="{{ $mapsLink }}" target="_blank" class="btn-maps">
                            <img src="{{ asset('images/mok69alj-1z3v3s6.svg') }}" alt="Maps icon">
                            <span>Open in Maps</span>
                        </a>
                    </div>
                </div>
            </div>
        </aside>
    </div>

    <!-- Recommendations Section -->
    <section class="container recommendations">
        <div class="recommendations-header">
            <div class="header-left">
                <span class="section-eyebrow">INTELLIGENT MATCHING</span>
                <h2 class="section-title-lg">Rekomendasi Serupa</h2>
            </div>
            <p class="header-right">
                Based on your interest in <strong>{{ $category }}</strong>, our horizon engine recommends these curated experiences.
            </p>
        </div>

        <div class="recommendations-grid">
            @foreach($recommendations as $rec)
                @php
                    $recImage = $rec->image ?? '';
                    $recImageUrl = $recImage 
                        ? (preg_match('/^https?:\/\//', $recImage) ? $recImage : asset('images/destination/' . ltrim($recImage, '/')))
                        : 'https://images.unsplash.com/photo-1537953773345-d172ccf13cf1?auto=format&fit=crop&w=500&q=80';
                    $recFee = $rec->harga_wni_min ?? $rec->harga_wna_min;
                @endphp
                <div class="rec-card" onclick="window.location='{{ route('user.destinations.detail', $rec->id) }}'" style="cursor: pointer;">
                    <div class="rec-media" style="background-image: url('{{ $recImageUrl }}');">
                        <span class="rec-badge">{{ strtoupper($rec->nama_kategori ?? 'BALI') }}</span>
                        <div class="rec-overlay">
                            <div class="rec-match">
                                <img src="{{ asset('images/mok69ali-w2uljcd.svg') }}" alt="Match icon">
                                <span>SIMILAR MATCH</span>
                            </div>
                            <h3 class="rec-title">{{ $rec->nama }}</h3>
                        </div>
                    </div>
                    <div class="rec-content">
                        <div class="rec-info">
                            <p class="rec-loc">{{ $rec->nama_kabupaten ?? 'Bali' }}</p>
                            <p class="rec-tags">{{ $rec->nama_kategori }} • Scenic • Explore</p>
                        </div>
                        <div class="rec-price">
                            <span class="price-val">{{ $recFee ? 'IDR ' . number_format($recFee / 1000, 0) . 'k' : 'Free' }}</span>
                            <span class="price-label">ACCESS</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
</div>

<style>
    .destination-detail {
        background: #f6fafe;
        padding-bottom: 80px;
    }

    .hero-banner {
        height: 760px;
        background-size: cover;
        background-position: center center;
        background-color: #171c1f; /* Fallback color */
        display: flex;
        align-items: flex-end;
        color: white;
        padding-bottom: 160px;
        margin-bottom: -140px;
        width: 100%;
        overflow: hidden;
    }

    .hero-content {
        max-width: 1400px;
        width: 100%;
        margin: 0 auto;
        padding: 0 40px;
    }

    .hero-meta {
        display: flex;
        align-items: center;
        gap: 16px;
        margin-bottom: 16px;
    }

    .category-badge {
        background: #b1f0ce;
        color: #0e5138;
        padding: 4px 16px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 600;
        letter-spacing: 0.6px;
    }

    .rating {
        display: flex;
        align-items: center;
        gap: 6px;
        color: #cde5ff;
        font-size: 14px;
        font-weight: 600;
    }

    .hero-title {
        font-size: 96px;
        font-weight: 800;
        margin: 0 0 16px 0;
        letter-spacing: -3px;
        line-height: 1;
    }

    .hero-location {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 18px;
        color: rgba(255, 255, 255, 0.9);
        font-weight: 500;
    }

    .main-layout {
        display: grid;
        grid-template-columns: 1fr 380px;
        gap: 32px;
        position: relative;
        z-index: 10;
    }

    .content-left {
        display: flex;
        flex-direction: column;
        gap: 32px;
    }

    .section-title {
        font-size: 28px;
        font-weight: 700;
        margin-bottom: 20px;
        color: #171c1f;
    }

    .description-text {
        font-size: 17px;
        line-height: 1.6;
        color: #404850;
        margin-bottom: 32px;
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
        gap: 24px;
        padding-top: 32px;
        border-top: 1px solid #bfc7d140;
    }

    .info-item {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .info-label {
        font-size: 11px;
        font-weight: 600;
        color: #707881;
        letter-spacing: 1px;
    }

    .info-value {
        font-size: 18px;
        font-weight: 600;
        color: #171c1f;
    }

    .info-value.price {
        color: #005d90;
    }

    /* Facilities */
    .facilities-card {
        background: #eaeef2 !important;
        padding: 40px !important;
    }

    .facilities-header {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 32px;
    }

    .section-title-sm {
        font-size: 20px;
        font-weight: 700;
        color: #171c1f;
        margin: 0;
    }

    .facilities-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
        gap: 24px;
    }

    .facility-item {
        background: white;
        padding: 24px 16px;
        border-radius: 12px;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 12px;
        text-align: center;
    }

    .facility-item span {
        font-size: 14px;
        font-weight: 600;
        color: #171c1f;
    }

    .facility-icon-wrapper {
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Sidebar */
    .sidebar-card {
        padding: 32px !important;
        position: sticky;
        top: 100px;
    }

    .sidebar-eyebrow {
        font-size: 12px;
        font-weight: 600;
        color: #707881;
        letter-spacing: 1.2px;
        display: block;
        margin-bottom: 8px;
    }

    .sidebar-title {
        font-size: 28px;
        font-weight: 700;
        margin: 0 0 12px 0;
    }

    .sidebar-price {
        display: flex;
        align-items: baseline;
        gap: 4px;
        margin-bottom: 24px;
    }

    .price-amount {
        font-size: 32px;
        font-weight: 700;
        color: #005d90;
    }

    .price-unit {
        font-size: 16px;
        color: #404850;
    }

    .sidebar-features {
        display: flex;
        flex-direction: column;
        gap: 16px;
        margin-bottom: 24px;
        padding: 16px 0;
    }

    .sidebar-feature {
        display: flex;
        align-items: center;
        gap: 16px;
        background: #f0f4f8;
        padding: 12px 16px;
        border-radius: 8px;
    }

    .feature-text {
        display: flex;
        flex-direction: column;
    }

    .feature-label {
        font-size: 10px;
        font-weight: 600;
        color: #707881;
    }

    .feature-value {
        font-size: 13px;
        font-weight: 600;
        color: #171c1f;
    }

    .sidebar-actions {
        display: flex;
        flex-direction: column;
        gap: 12px;
        margin-bottom: 24px;
    }

    .btn-book {
        background: linear-gradient(135deg, #005d90 0%, #0077b6 100%);
        color: white;
        border: none;
        padding: 16px;
        border-radius: 999px;
        font-size: 18px;
        font-weight: 600;
        cursor: pointer;
        box-shadow: 0 10px 15px -3px rgba(0, 93, 144, 0.2);
    }

    .btn-itinerary {
        background: transparent;
        border: 2px solid #bfc7d140;
        padding: 14px;
        border-radius: 999px;
        font-size: 18px;
        font-weight: 600;
        color: #171c1f;
        cursor: pointer;
    }

    .map-preview {
        border-radius: 12px;
        overflow: hidden;
        position: relative;
        height: 200px;
    }

    .map-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .map-overlay {
        position: absolute;
        inset: 0;
        background: rgba(0, 93, 144, 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .btn-maps {
        background: white;
        padding: 8px 16px;
        border-radius: 999px;
        display: flex;
        align-items: center;
        gap: 10px;
        text-decoration: none;
        color: #171c1f;
        font-size: 14px;
        font-weight: 600;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }

    /* Recommendations */
    .recommendations {
        margin-top: 80px;
    }

    .recommendations-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        margin-bottom: 48px;
    }

    .section-eyebrow {
        font-size: 14px;
        font-weight: 600;
        color: #005d90;
        letter-spacing: 2px;
        display: block;
        margin-bottom: 8px;
    }

    .section-title-lg {
        font-size: 48px;
        font-weight: 800;
        margin: 0;
        letter-spacing: -1.5px;
    }

    .header-right {
        max-width: 440px;
        font-size: 14px;
        line-height: 1.6;
        color: #404850;
        margin: 0;
    }

    .recommendations-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 32px;
    }

    .rec-card {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
    }

    .rec-media {
        height: 280px;
        background-size: cover;
        background-position: center;
        background-color: #2a343d; /* Fallback color */
        position: relative;
        padding: 16px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .rec-badge {
        position: relative;
        z-index: 5;
        background: rgba(0, 0, 0, 0.4);
        backdrop-filter: blur(4px);
        color: white;
        padding: 4px 12px;
        border-radius: 999px;
        font-size: 10px;
        font-weight: 700;
        align-self: flex-start;
        letter-spacing: 1px;
    }

    .rec-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(0deg, rgba(23, 28, 31, 0.9) 0%, rgba(23, 28, 31, 0) 100%);
        padding: 24px;
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .rec-match {
        display: flex;
        align-items: center;
        gap: 6px;
        color: #b1f0ce;
        font-size: 10px;
        font-weight: 700;
        letter-spacing: 1px;
    }

    .rec-title {
        color: white;
        font-size: 24px;
        font-weight: 700;
        margin: 0;
    }

    .rec-content {
        padding: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .rec-loc {
        font-size: 14px;
        font-weight: 600;
        color: #171c1f;
        margin-bottom: 2px;
    }

    .rec-tags {
        font-size: 12px;
        color: #707881;
        margin: 0;
    }

    .rec-price {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
    }

    .price-val {
        font-size: 18px;
        font-weight: 700;
        color: #005d90;
    }

    .price-label {
        font-size: 10px;
        font-weight: 700;
        color: #707881;
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .main-layout {
            grid-template-columns: 1fr;
        }

        .sidebar-card {
            position: static;
        }

        .recommendations-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .hero-title {
            font-size: 72px;
        }
    }

    @media (max-width: 768px) {
        .recommendations-grid {
            grid-template-columns: 1fr;
        }

        .recommendations-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 20px;
        }

        .hero-title {
            font-size: 48px;
        }

        .hero-banner {
            height: 520px;
        }
    }
</style>
@endsection