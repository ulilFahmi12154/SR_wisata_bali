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
        position: relative;
        max-width: 1180px;
        margin: 18px auto 54px;
        padding: clamp(22px, 4vw, 36px);
        overflow: hidden;
        border: 1px solid rgba(203, 213, 225, 0.62);
        border-radius: 36px;
        background:
            radial-gradient(circle at 9% 8%, rgba(224, 242, 254, 0.86), transparent 34%),
            radial-gradient(circle at 92% 18%, rgba(254, 243, 199, 0.50), transparent 30%),
            linear-gradient(135deg, rgba(248, 251, 255, 0.96) 0%, rgba(241, 247, 251, 0.92) 58%, rgba(255, 250, 242, 0.86) 100%);
        box-shadow: 0 26px 76px rgba(15, 23, 42, 0.08);
    }

    .pref-grid {
        display: grid;
        grid-template-columns: minmax(0, 0.94fr) minmax(360px, 1.06fr);
        gap: clamp(26px, 4vw, 46px);
        align-items: center;
    }

    .pref-intro {
        min-width: 0;
    }

    .pref-kicker {
        display: inline-flex;
        align-items: center;
        width: fit-content;
        margin: 0 0 16px;
        padding: 8px 14px;
        border: 1px solid rgba(125, 211, 252, 0.42);
        border-radius: 999px;
        background: rgba(255, 255, 255, 0.72);
        color: #075985;
        box-shadow: 0 12px 30px rgba(14, 116, 144, 0.08);
        font-size: 0.68rem;
        font-weight: 800;
        letter-spacing: 0.14em;
        text-transform: uppercase;
        backdrop-filter: blur(12px);
    }

    .pref-title {
        margin: 0;
        max-width: 520px;
        color: #172033;
        font-family: 'Playfair Display', serif;
        font-size: clamp(2.75rem, 5vw, 4.25rem);
        font-weight: 700;
        line-height: 1.05;
        letter-spacing: 0;
    }

    .pref-title span {
        color: #0369a1;
        background: linear-gradient(135deg, #075985 0%, #0284c7 62%, #d97706 132%);
        background-clip: text;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        text-shadow: 0 14px 34px rgba(2, 132, 199, 0.10);
    }

    .pref-description {
        margin: 16px 0 0;
        max-width: 510px;
        color: #61718a;
        font-size: 1rem;
        line-height: 1.75;
    }

    .pref-highlight {
        position: relative;
        min-height: clamp(300px, 38vw, 420px);
        margin-top: 30px;
        overflow: hidden;
        border: 1px solid rgba(255, 255, 255, 0.72);
        border-radius: 30px;
        background: #dbeafe;
        box-shadow: 0 24px 68px rgba(15, 23, 42, 0.14);
        transition: transform 0.25s ease, box-shadow 0.25s ease;
    }

    .pref-highlight:hover {
        transform: translateY(-3px);
        box-shadow: 0 30px 80px rgba(15, 23, 42, 0.17);
    }

    .pref-highlight > img {
        position: absolute;
        inset: 0;
        display: block;
        width: 100%;
        height: 100%;
        object-fit: cover;
        transform: scale(1.01);
        transition: transform 0.5s ease;
    }

    .pref-highlight:hover > img {
        transform: scale(1.035);
    }

    .pref-highlight::after {
        content: '';
        position: absolute;
        inset: 0;
        background:
            linear-gradient(180deg, rgba(15, 23, 42, 0.02) 0%, rgba(15, 23, 42, 0.20) 48%, rgba(15, 23, 42, 0.68) 100%),
            linear-gradient(135deg, rgba(3, 105, 161, 0.14), rgba(245, 158, 11, 0.08));
    }

    .pref-highlight-info {
        position: absolute;
        z-index: 2;
        right: 22px;
        bottom: 22px;
        left: 22px;
        color: #fffaf0;
    }

    .pref-highlight-location {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        margin: 0;
        color: rgba(248, 250, 252, 0.82);
        font-size: 0.86rem;
        font-weight: 700;
    }

    .pref-highlight-location img {
        width: 10px;
        height: 12px;
        flex-shrink: 0;
        filter: brightness(0) invert(1);
        opacity: 0.82;
    }

    .pref-highlight-title {
        margin: 7px 0 0;
        max-width: 330px;
        color: #fffaf0;
        font-family: 'Playfair Display', serif;
        font-size: clamp(1.7rem, 3vw, 2.15rem);
        line-height: 1.14;
    }

    .pref-form-card {
        position: relative;
        min-width: 0;
        overflow: hidden;
        border: 1px solid rgba(203, 213, 225, 0.68);
        border-radius: 32px;
        background: rgba(255, 255, 255, 0.90);
        padding: clamp(22px, 3vw, 30px);
        box-shadow: 0 24px 68px rgba(15, 23, 42, 0.09);
        backdrop-filter: blur(16px);
        transition: transform 0.25s ease, box-shadow 0.25s ease, border-color 0.25s ease;
    }

    .pref-form-card::before {
        content: '';
        position: absolute;
        top: 0;
        right: 30px;
        left: 30px;
        height: 3px;
        border-radius: 0 0 999px 999px;
        background: linear-gradient(90deg, rgba(3, 105, 161, 0.12), rgba(3, 105, 161, 0.46), rgba(251, 191, 36, 0.24), rgba(3, 105, 161, 0.08));
    }

    .pref-form-card:hover {
        transform: translateY(-2px);
        border-color: rgba(125, 211, 252, 0.54);
        box-shadow: 0 30px 78px rgba(15, 23, 42, 0.12);
    }

    .pref-form-title {
        margin: 0 0 22px;
        color: #172033;
        font-size: 1.35rem;
        font-weight: 800;
        letter-spacing: 0;
    }

    .pref-group {
        margin-bottom: 22px;
    }

    .pref-label {
        display: flex;
        align-items: center;
        gap: 9px;
        margin: 0 0 10px;
        color: #2d3b4f;
        font-size: 1rem;
        font-weight: 800;
        line-height: 1.4;
    }

    .pref-icon {
        width: 20px;
        height: 20px;
        flex-shrink: 0;
        object-fit: contain;
        filter: saturate(0.7);
        opacity: 0.82;
    }

    .pref-field-caption,
    .pref-helper {
        color: #64748b;
        font-size: 0.85rem;
        line-height: 1.5;
    }

    .pref-field-caption {
        margin-bottom: 8px;
        font-weight: 700;
    }

    .pref-helper {
        margin-top: 3px;
    }

    .pref-select,
    .pref-budget-input {
        width: 100%;
        min-height: 52px;
        border: 1px solid rgba(203, 213, 225, 0.88);
        border-radius: 18px;
        background: rgba(241, 245, 249, 0.72);
        color: #172033;
        font-size: 0.95rem;
        box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.86);
        transition: border-color 0.2s ease, box-shadow 0.2s ease, background 0.2s ease;
    }

    .pref-select {
        padding: 0 15px;
    }

    .pref-select:focus,
    .pref-budget-input:focus {
        outline: none;
        border-color: rgba(3, 105, 161, 0.54);
        background: rgba(255, 255, 255, 0.92);
        box-shadow: 0 0 0 4px rgba(186, 230, 253, 0.42);
    }

    .pref-chip-list {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .pref-chip-option {
        position: relative;
    }

    .pref-chip-option input {
        position: absolute;
        opacity: 0;
        pointer-events: none;
    }

    .pref-chip-option span {
        display: inline-flex;
        min-height: 42px;
        align-items: center;
        justify-content: center;
        border: 1px solid rgba(203, 213, 225, 0.72);
        border-radius: 999px;
        background: rgba(248, 250, 252, 0.82);
        color: #536377;
        cursor: pointer;
        padding: 10px 17px;
        font-size: 0.88rem;
        font-weight: 800;
        box-shadow: 0 10px 24px rgba(15, 23, 42, 0.04);
        transition: transform 0.2s ease, border-color 0.2s ease, background 0.2s ease, color 0.2s ease, box-shadow 0.2s ease;
    }

    .pref-chip-option span:hover {
        transform: translateY(-1px);
        border-color: rgba(125, 211, 252, 0.62);
        background: rgba(224, 242, 254, 0.72);
        color: #075985;
    }

    .pref-chip-option input:checked + span {
        border-color: #0369a1;
        background: #0369a1;
        color: #ffffff;
        box-shadow: 0 14px 30px rgba(2, 132, 199, 0.18);
    }

    .pref-chip-option input:focus-visible + span {
        outline: 3px solid rgba(186, 230, 253, 0.72);
        outline-offset: 2px;
    }

    .pref-budget-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 14px;
    }

    .pref-budget-row .pref-label {
        margin-bottom: 0;
    }

    .pref-budget-control {
        display: flex;
        min-width: 185px;
        align-items: center;
        gap: 8px;
    }

    .pref-budget-prefix {
        color: #0369a1;
        font-size: 0.88rem;
        font-weight: 900;
    }

    .pref-budget-input {
        width: 145px;
        padding: 0 14px;
        text-align: left;
    }

    .pref-slider-shell {
        margin-top: 14px;
    }

    .pref-slider {
        width: 100%;
        height: 8px;
        margin-top: 14px;
        cursor: pointer;
        appearance: none;
        border-radius: 999px;
        background: linear-gradient(90deg, rgba(186, 230, 253, 0.92), rgba(226, 232, 240, 0.92));
        accent-color: #0369a1;
    }

    .pref-slider::-webkit-slider-thumb {
        width: 20px;
        height: 20px;
        appearance: none;
        border: 4px solid #ffffff;
        border-radius: 999px;
        background: #0369a1;
        box-shadow: 0 8px 20px rgba(2, 132, 199, 0.24);
    }

    .pref-slider::-moz-range-track {
        height: 8px;
        border-radius: 999px;
        background: linear-gradient(90deg, rgba(186, 230, 253, 0.92), rgba(226, 232, 240, 0.92));
    }

    .pref-slider::-moz-range-thumb {
        width: 14px;
        height: 14px;
        border: 4px solid #ffffff;
        border-radius: 999px;
        background: #0369a1;
        box-shadow: 0 8px 20px rgba(2, 132, 199, 0.24);
    }

    .pref-scale {
        display: flex;
        justify-content: space-between;
        gap: 8px;
        margin-top: 10px;
        color: #7b8ba1;
        font-size: 0.72rem;
        font-weight: 800;
        letter-spacing: 0.02em;
    }

    .pref-amenities {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 10px;
    }

    .pref-check {
        display: flex;
        min-width: 0;
        min-height: 52px;
        align-items: center;
        gap: 10px;
        border: 1px solid rgba(203, 213, 225, 0.72);
        border-radius: 18px;
        background: rgba(248, 250, 252, 0.78);
        color: #44536a;
        cursor: pointer;
        padding: 13px 14px;
        font-size: 0.9rem;
        font-weight: 700;
        transition: transform 0.2s ease, border-color 0.2s ease, background 0.2s ease, box-shadow 0.2s ease, color 0.2s ease;
    }

    .pref-check:hover {
        transform: translateY(-1px);
        border-color: rgba(125, 211, 252, 0.58);
        background: rgba(224, 242, 254, 0.58);
        color: #075985;
    }

    .pref-check:has(input:checked) {
        border-color: rgba(3, 105, 161, 0.46);
        background: rgba(224, 242, 254, 0.78);
        color: #075985;
        box-shadow: inset 0 0 0 1px rgba(3, 105, 161, 0.05);
    }

    .pref-check input {
        width: 17px;
        height: 17px;
        flex-shrink: 0;
        accent-color: #0369a1;
    }

    .pref-submit {
        display: inline-flex;
        width: 100%;
        min-height: 54px;
        align-items: center;
        justify-content: center;
        gap: 10px;
        border: 1px solid #0369a1;
        border-radius: 20px;
        background: linear-gradient(135deg, #0369a1 0%, #075985 100%);
        color: #ffffff;
        cursor: pointer;
        font-size: 1rem;
        font-weight: 800;
        box-shadow: 0 16px 34px rgba(2, 132, 199, 0.20);
        transition: transform 0.2s ease, box-shadow 0.2s ease, background 0.2s ease, border-color 0.2s ease;
    }

    .pref-submit:hover {
        transform: translateY(-1px);
        border-color: #075985;
        background: linear-gradient(135deg, #075985 0%, #0c4a6e 100%);
        box-shadow: 0 20px 42px rgba(2, 132, 199, 0.25);
    }

    .pref-submit:focus-visible {
        outline: 4px solid rgba(186, 230, 253, 0.70);
        outline-offset: 3px;
    }

    .pref-submit-icon {
        width: 18px;
        height: 18px;
        flex-shrink: 0;
        object-fit: contain;
        filter: brightness(0) invert(1);
    }

    .pref-meta {
        margin: 15px 0 0;
        color: #8794a7;
        text-align: center;
        font-size: 0.78rem;
        line-height: 1.6;
    }

    @media (max-width: 1080px) {
        .pref-page {
            margin-top: 14px;
            border-radius: 30px;
        }

        .pref-grid {
            grid-template-columns: 1fr;
        }

        .pref-intro {
            max-width: 760px;
        }

        .pref-highlight {
            min-height: 330px;
        }
    }

    @media (max-width: 720px) {
        .pref-page {
            margin-top: 8px;
            padding: 20px;
            border-radius: 26px;
        }

        .pref-title {
            font-size: clamp(2.35rem, 12vw, 3.2rem);
        }

        .pref-description {
            font-size: 0.95rem;
        }

        .pref-highlight {
            min-height: 285px;
            border-radius: 24px;
        }

        .pref-form-card {
            border-radius: 26px;
        }

        .pref-budget-row {
            align-items: flex-start;
            flex-direction: column;
        }

        .pref-budget-control {
            width: 100%;
        }

        .pref-budget-input {
            width: 100%;
        }

        .pref-amenities {
            grid-template-columns: 1fr;
        }

        .pref-scale {
            font-size: 0.66rem;
        }
    }

    @media (max-width: 440px) {
        .pref-page {
            padding: 16px;
        }

        .pref-chip-option span {
            min-height: 40px;
            padding: 9px 14px;
        }
    }

    .pref-highlight img {
        max-width: none;
    }

    @media (prefers-reduced-motion: reduce) {
        .pref-highlight,
        .pref-highlight > img,
        .pref-form-card,
        .pref-chip-option span,
        .pref-check,
        .pref-submit {
            transition: none;
        }
    }

</style>

<div class="pref-page animate-page-in">
    <div class="pref-grid">
        <section class="pref-intro animate-fade-up" aria-label="Intro halaman preferensi">
            <p class="pref-kicker">PERSONALISASI PERJALANAN</p>
            <h1 class="pref-title">
                Temukan <span>Liburan Bali</span> Terbaik.
            </h1>
            <p class="pref-description">
                Temukan destinasi impian Anda di Bali dengan algoritma perankingan yang akurat. Masukkan kriteria perjalanan Anda di bawah ini.
            </p>

            <article class="pref-highlight animate-fade-up animate-delay-100" aria-label="Highlight destinasi">
                <img src="{{ asset('images/mos268mh-pt07rre.png') }}" alt="Pemandangan infinity pool di Bali">
                <div class="pref-highlight-info">
                    <p class="pref-highlight-location">
                        <img src="{{ asset('images/mos268mb-gnjc7oh.svg') }}" alt="" aria-hidden="true">
                        <span>Kawasan Ubud</span>
                    </p>
                    <p class="pref-highlight-title">Destinasi Alam Pilihan</p>
                </div>
            </article>
        </section>

        <section class="pref-form-card animate-fade-up animate-delay-200" aria-label="Form input preferensi">
            <h2 class="pref-form-title">Filter Utama</h2>
            <form method="GET" action="{{ route('user.destinations') }}" x-data="{ budget: {{ $selectedBudget }} }">
                <div class="pref-group">
                    <p class="pref-label">
                        <img class="pref-icon" src="{{ asset('images/mos268mb-l3nqqp7.svg') }}" alt="" aria-hidden="true">
                        <span>Wilayah mana yang ingin Anda jelajahi?</span>
                    </p>
                    <div class="pref-field-caption">Kabupaten/Kota</div>
                    <select class="pref-select" name="regency" aria-label="Pilih kabupaten">
                        <option value="all" @selected(request('regency', 'all') === 'all')>Pilih Kabupaten</option>
                        <option value="badung" @selected(request('regency') === 'badung')>Badung</option>
                        <option value="gianyar" @selected(request('regency') === 'gianyar')>Gianyar</option>
                        <option value="bangli" @selected(request('regency') === 'bangli')>Bangli</option>
                        <option value="buleleng" @selected(request('regency') === 'buleleng')>Buleleng</option>
                    </select>
                </div>

                <div class="pref-group">
                    <p class="pref-label">
                        <img class="pref-icon" src="{{ asset('images/mos268mb-dab7w9w.svg') }}" alt="" aria-hidden="true">
                        <span>Ingin liburan seperti apa kali ini?</span>
                    </p>
                    <div class="pref-field-caption">Kategori Wisata</div>
                    <div class="pref-chip-list" role="radiogroup" aria-label="Minat utama">
                        <label class="pref-chip-option">
                            <input type="radio" name="interest" value="all" @checked($selectedInterest === 'all')>
                            <span>Semua</span>
                        </label>
                        <label class="pref-chip-option">
                            <input type="radio" name="interest" value="nature" @checked($selectedInterest === 'nature')>
                            <span>Alam</span>
                        </label>
                        <label class="pref-chip-option">
                            <input type="radio" name="interest" value="culture" @checked($selectedInterest === 'culture')>
                            <span>Budaya</span>
                        </label>
                        <label class="pref-chip-option">
                            <input type="radio" name="interest" value="beach" @checked($selectedInterest === 'beach')>
                            <span>Pantai</span>
                        </label>
                        <label class="pref-chip-option">
                            <input type="radio" name="interest" value="culinary" @checked($selectedInterest === 'culinary')>
                            <span>Kuliner</span>
                        </label>
                    </div>
                </div>

                <div class="pref-group">
                    <div class="pref-budget-row">
                        <p class="pref-label">
                            <img class="pref-icon" src="{{ asset('images/mos268mb-zgiezb6.svg') }}" alt="" aria-hidden="true">
                            <span>Estimasi Biaya Harian</span>
                        </p>
                        <div class="pref-budget-control">
                            <span class="pref-budget-prefix">Rp</span>
                            <input
                                class="pref-budget-input"
                                type="number"
                                name="budget"
                                min="0"
                                max="10000000"
                                step="10000"
                                inputmode="numeric"
                                x-model.number="budget"
                                aria-label="Nilai budget"
                            >
                        </div>
                    </div>
                    <div class="pref-helper">Atur pengeluaran maksimum per orang</div>
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
                        <span>Fasilitas Pendukung</span>
                    </p>
                    <div class="pref-field-caption">Pilih fasilitas yang wajib ada</div>
                    <div class="pref-amenities">
                        <label class="pref-check">
                            <input type="checkbox" name="amenities[]" value="parking" @checked(in_array('parking', $selectedAmenities, true))>
                            <span>Area Parkir</span>
                        </label>
                        <label class="pref-check">
                            <input type="checkbox" name="amenities[]" value="wifi" @checked(in_array('wifi', $selectedAmenities, true))>
                            <span>Wifi Cepat</span>
                        </label>
                        <label class="pref-check">
                            <input type="checkbox" name="amenities[]" value="restroom" @checked(in_array('restroom', $selectedAmenities, true))>
                            <span>Toilet Bersih</span>
                        </label>
                        <label class="pref-check">
                            <input type="checkbox" name="amenities[]" value="restaurant" @checked(in_array('restaurant', $selectedAmenities, true))>
                            <span>Restoran/Rumah Makan</span>
                        </label>
                    </div>
                </div>

                <button class="pref-submit" type="submit">
                    <span>Cari Rekomendasi</span>
                    <img class="pref-submit-icon" src="{{ asset('images/mos268mb-dpv3btu.svg') }}" alt="" aria-hidden="true">
                </button>
                <p class="pref-meta">Sistem Rekomendasi Wisata Bali &middot; Personalisasi rekomendasi dari koleksi destinasi terpilih.</p>
            </form>
        </section>
    </div>
</div>
@endsection
