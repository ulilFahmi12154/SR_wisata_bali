@extends('layouts.app')

@section('title', 'Input Preferensi Wisata')

@section('content')
@php
    $selectedInterest = request('interest', 'all');
    $selectedAmenities = collect(request('amenities', []))->map(fn ($value) => (string) $value)->all();
    $selectedBudget = (int) request('budget', 500000);
@endphp

<style>
    .pref-page {
        margin-top: 32px;
    }

    .pref-grid {
        display: grid;
        grid-template-columns: minmax(0, 1fr) minmax(0, 1.3fr);
        gap: 32px;
        align-items: start;
    }

    .pref-kicker {
        margin: 0 0 12px;
        color: #0b70c8;
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 0.8px;
        text-transform: uppercase;
    }

    .pref-title {
        margin: 0;
        color: #131d2c;
        font-size: 3.45rem;
        line-height: 1.03;
        letter-spacing: -1px;
        max-width: 460px;
    }

    .pref-title span {
        color: #0077c9;
    }

    .pref-description {
        margin: 16px 0 0;
        color: #4d5b6f;
        font-size: 1.05rem;
        line-height: 1.65;
        max-width: 500px;
    }

    .pref-highlight {
        margin-top: 28px;
        border-radius: 16px;
        overflow: hidden;
        position: relative;
        box-shadow: 0 18px 36px rgba(12, 38, 66, 0.2);
        min-height: 360px;
        background: #123;
    }

    .pref-highlight img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .pref-highlight::after {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(180deg, rgba(4, 16, 32, 0.04) 40%, rgba(4, 16, 32, 0.82) 100%);
    }

    .pref-highlight-info {
        position: absolute;
        left: 20px;
        right: 20px;
        bottom: 18px;
        z-index: 2;
        color: #fff;
    }

    .pref-highlight-location {
        margin: 0;
        font-size: 0.95rem;
        opacity: 0.9;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .pref-highlight-location img {
        width: 10px;
        height: 12px;
        flex-shrink: 0;
    }

    .pref-highlight-title {
        margin: 6px 0 0;
        font-size: 2rem;
        line-height: 1.1;
    }

    .pref-form-card {
        background: #fff;
        border: 1px solid #dfe8f5;
        border-top: 4px solid #0b70c8;
        border-radius: 14px;
        padding: 26px;
        box-shadow: 0 10px 26px rgba(17, 46, 79, 0.08);
    }

    .pref-group {
        margin-bottom: 22px;
    }

    .pref-label {
        margin: 0 0 12px;
        color: #182435;
        font-size: 1.08rem;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .pref-icon {
        width: 20px;
        height: 20px;
        flex-shrink: 0;
        object-fit: contain;
    }

    .pref-select {
        width: 100%;
        min-height: 50px;
        border: 1px solid #d6e1ef;
        border-radius: 10px;
        padding: 0 14px;
        font-size: 0.96rem;
        color: #1a283a;
        background: #f7fafd;
    }

    .pref-chip-list {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .pref-chip-option input {
        position: absolute;
        opacity: 0;
        pointer-events: none;
    }

    .pref-chip-option span {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 10px 18px;
        border-radius: 999px;
        border: 1px solid transparent;
        background: #e8edf2;
        color: #526175;
        font-size: 0.9rem;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .pref-chip-option input:checked + span {
        background: #25734b;
        color: #fff;
    }

    .pref-chip-option span:hover {
        border-color: #b9cde3;
        background: #f2f6fb;
    }

    .pref-slider-shell {
        margin-top: 10px;
    }

    .pref-budget-chip {
        display: inline-flex;
        margin-left: auto;
        background: #d8ebff;
        color: #0f66b5;
        border-radius: 999px;
        padding: 6px 12px;
        font-size: 0.82rem;
        font-weight: 700;
    }

    .pref-slider {
        width: 100%;
        margin-top: 12px;
        accent-color: #0b70c8;
    }

    .pref-budget-input {
        width: 90px;
        border: 1px solid #d6e1ef;
        border-radius: 10px;
        padding: 8px 12px;
        font-size: 0.9rem;
        color: #1a283a;
        background: #f7fafd;
        text-align: center;
    }

    .pref-scale {
        margin-top: 8px;
        display: flex;
        justify-content: space-between;
        font-size: 0.75rem;
        color: #76859b;
        font-weight: 700;
        letter-spacing: 0.4px;
    }

    .pref-amenities {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 10px;
    }

    .pref-check {
        display: flex;
        align-items: center;
        gap: 10px;
        background: #f5f9fd;
        border: 1px solid #dfebf8;
        border-radius: 10px;
        padding: 12px;
        color: #2f3f54;
        font-weight: 600;
    }

    .pref-check input {
        width: 16px;
        height: 16px;
        accent-color: #0b70c8;
    }

    .pref-submit {
        width: 100%;
        min-height: 54px;
        border: none;
        border-radius: 999px;
        cursor: pointer;
        background: linear-gradient(90deg, #006fb9 0%, #0b5ed7 100%);
        color: #fff;
        font-size: 1.16rem;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }

    .pref-submit-icon {
        width: 20px;
        height: 20px;
        object-fit: contain;
    }

    .pref-meta {
        margin: 12px 0 0;
        text-align: center;
        color: #7a8697;
        font-size: 0.82rem;
    }

    @media (max-width: 1080px) {
        .pref-grid {
            grid-template-columns: 1fr;
        }

        .pref-title {
            font-size: 2.7rem;
        }

        .pref-highlight {
            min-height: 320px;
        }
    }

    @media (max-width: 640px) {
        .pref-page {
            margin-top: 24px;
        }

        .pref-title {
            font-size: 2.2rem;
        }

        .pref-description {
            font-size: 0.94rem;
        }

        .pref-form-card {
            padding: 18px;
        }

        .pref-amenities {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="pref-page">
    <div class="pref-grid">
        <section aria-label="Intro halaman preferensi">
            <p class="pref-kicker">Recommendation Engine</p>
            <h1 class="pref-title">
                Craft Your <span>Perfect Bali</span> Escape.
            </h1>
            <p class="pref-description">
                Mesin kurasi kami mengubah preferensi perjalanan Anda menjadi rekomendasi destinasi yang terarah. Pilih wilayah, minat utama, dan fasilitas penting sesuai gaya liburan Anda.
            </p>

            <article class="pref-highlight" aria-label="Highlight destinasi">
                <img src="{{ asset('images/mos268mh-pt07rre.png') }}" alt="Pemandangan infinity pool di Bali">
                <div class="pref-highlight-info">
                    <p class="pref-highlight-location">
                        <img src="{{ asset('images/mos268mb-gnjc7oh.svg') }}" alt="" aria-hidden="true">
                        <span>Ubud Highlands</span>
                    </p>
                    <p class="pref-highlight-title">Curated Nature Retreats</p>
                </div>
            </article>
        </section>

        <section class="pref-form-card" aria-label="Form input preferensi">
            <form method="GET" action="{{ route('user.destinations') }}" x-data="{ budget: {{ $selectedBudget }} }">
                <div class="pref-group">
                    <p class="pref-label">
                        <img class="pref-icon" src="{{ asset('images/mos268mb-l3nqqp7.svg') }}" alt="" aria-hidden="true">
                        <span>Where do you want to explore?</span>
                    </p>
                    <select class="pref-select" name="regency" aria-label="Pilih kabupaten">
                        <option value="all" @selected(request('regency', 'all') === 'all')>All Districts</option>
                        <option value="badung" @selected(request('regency') === 'badung')>Badung</option>
                        <option value="gianyar" @selected(request('regency') === 'gianyar')>Gianyar</option>
                        <option value="bangli" @selected(request('regency') === 'bangli')>Bangli</option>
                        <option value="buleleng" @selected(request('regency') === 'buleleng')>Buleleng</option>
                    </select>
                </div>

                <div class="pref-group">
                    <p class="pref-label">
                        <img class="pref-icon" src="{{ asset('images/mos268mb-dab7w9w.svg') }}" alt="" aria-hidden="true">
                        <span>Primary Interest</span>
                    </p>
                    <div class="pref-chip-list" role="radiogroup" aria-label="Minat utama">
                        <label class="pref-chip-option">
                            <input type="radio" name="interest" value="all" @checked($selectedInterest === 'all')>
                            <span>All</span>
                        </label>
                        <label class="pref-chip-option">
                            <input type="radio" name="interest" value="nature" @checked($selectedInterest === 'nature')>
                            <span>Nature</span>
                        </label>
                        <label class="pref-chip-option">
                            <input type="radio" name="interest" value="culture" @checked($selectedInterest === 'culture')>
                            <span>Culture</span>
                        </label>
                        <label class="pref-chip-option">
                            <input type="radio" name="interest" value="beach" @checked($selectedInterest === 'beach')>
                            <span>Beach</span>
                        </label>
                        <label class="pref-chip-option">
                            <input type="radio" name="interest" value="culinary" @checked($selectedInterest === 'culinary')>
                            <span>Culinary</span>
                        </label>
                    </div>
                </div>

                <div class="pref-group">
                    <div style="display:flex; align-items:center; gap:10px; justify-content: space-between;">
                        <p class="pref-label" style="margin-bottom:0;">
                            <img class="pref-icon" src="{{ asset('images/mos268mb-zgiezb6.svg') }}" alt="" aria-hidden="true">
                            <span>Your Max Budget (IDR)</span>
                        </p>
                        <div style="display: flex; align-items: center; gap: 8px;">
                            <span style="font-weight: 700; color: #0b70c8;">Rp</span>
                            <input
                                class="pref-budget-input"
                                type="number"
                                name="budget"
                                min="0"
                                max="10000000"
                                step="10000"
                                inputmode="numeric"
                                x-model.number="budget"
                                style="width: 140px; text-align: left;"
                                aria-label="Nilai budget"
                            >
                        </div>
                    </div>
                    <div class="pref-slider-shell">
                        <input class="pref-slider" type="range" min="0" max="2000000" step="50000" x-model.number="budget" aria-label="Budget harian">
                        <div class="pref-scale">
                            <span>Rp 0</span>
                            <span>Rp 1.000.000</span>
                            <span>Rp 2.000.000+</span>
                        </div>
                    </div>
                </div>

                <div class="pref-group">
                    <p class="pref-label">
                        <img class="pref-icon" src="{{ asset('images/mos268mb-g9rqp6i.svg') }}" alt="" aria-hidden="true">
                        <span>Essential Amenities</span>
                    </p>
                    <div class="pref-amenities">
                        <label class="pref-check">
                            <input type="checkbox" name="amenities[]" value="parking" @checked(in_array('parking', $selectedAmenities, true))>
                            <span>Parking Area</span>
                        </label>
                        <label class="pref-check">
                            <input type="checkbox" name="amenities[]" value="wifi" @checked(in_array('wifi', $selectedAmenities, true))>
                            <span>High-speed Wifi</span>
                        </label>
                        <label class="pref-check">
                            <input type="checkbox" name="amenities[]" value="restroom" @checked(in_array('restroom', $selectedAmenities, true))>
                            <span>Clean Restrooms</span>
                        </label>
                        <label class="pref-check">
                            <input type="checkbox" name="amenities[]" value="restaurant" @checked(in_array('restaurant', $selectedAmenities, true))>
                            <span>On-site Restaurant</span>
                        </label>
                    </div>
                </div>

                <button class="pref-submit" type="submit">
                    <span>Cari Rekomendasi</span>
                    <img class="pref-submit-icon" src="{{ asset('images/mos268mb-dpv3btu.svg') }}" alt="" aria-hidden="true">
                </button>
                <p class="pref-meta">Powered by Curated Horizon AI • Personalizing 2,400+ Bali Destinations</p>
            </form>
        </section>
    </div>
</div>
@endsection