@extends('layouts.app')

@section('title', 'Destinations')

@push('styles')
<style>
    .dest-landing {
        margin-top: 28px;
    }

    .dest-hero-head {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 18px;
    }

    .dest-eyebrow {
        margin: 0;
        color: #0b5ed7;
        font-size: 0.67rem;
        font-weight: 700;
        letter-spacing: 1.2px;
        text-transform: uppercase;
    }

    .dest-main-title {
        margin: 8px 0 0;
        color: #1f2733;
        font-size: 3rem;
        line-height: 1.07;
        letter-spacing: -0.8px;
        max-width: 680px;
    }

    .dest-main-title span {
        color: #0b5ed7;
    }

    .dest-mode-switch {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 4px;
        background: #dbe2ea;
        border-radius: 999px;
        margin-top: 8px;
    }

    .dest-mode-btn {
        border: none;
        background: transparent;
        color: #4f5b70;
        font-size: 0.74rem;
        font-weight: 700;
        padding: 8px 14px;
        border-radius: 999px;
        cursor: pointer;
    }

    .dest-mode-btn.active {
        background: white;
        color: #0b5ed7;
        box-shadow: 0 4px 12px rgba(15, 32, 58, 0.1);
    }

    .dest-meta-row {
        margin-top: 18px;
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .dest-meta-chip {
        background: #e7edf4;
        border: 1px solid #d6dfe9;
        color: #3f4d62;
        font-size: 0.72rem;
        font-weight: 600;
        padding: 7px 10px;
        border-radius: 8px;
    }

    .dest-primary-grid {
        margin-top: 24px;
        display: grid;
        grid-template-columns: minmax(0, 2.08fr) minmax(0, 1fr);
        gap: 24px;
        align-items: stretch;
    }

    .dest-feature-card {
        display: grid;
        grid-template-columns: minmax(0, 1fr) minmax(0, 1fr);
        background: #f6f9fd;
        border: 1px solid #e0e8f2;
        border-radius: 12px;
        overflow: hidden;
        min-height: 480px;
    }

    .dest-feature-media {
        position: relative;
        height: 100%;
    }

    .dest-feature-media img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .dest-feature-badge {
        position: absolute;
        top: 24px;
        left: 24px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-size: 0.68rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.7px;
        color: #f4fbf7;
        background: #266449;
        border-radius: 999px;
        padding: 6px 16px;
    }

    .dest-badge-icon {
        width: 12px;
        height: 12px;
        flex-shrink: 0;
    }

    .dest-feature-content {
        padding: 32px;
        display: flex;
        flex-direction: column;
        gap: 24px;
    }

    .dest-feature-top {
        display: flex;
        flex-direction: column;
        gap: 14px;
    }

    .dest-feature-bottom {
        flex: 1;
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .dest-feature-title {
        margin: 0;
        color: #171c1f;
        font-size: 1.875rem;
        line-height: 1.2;
        display: flex;
        align-items: baseline;
        gap: 8px;
        flex-wrap: wrap;
    }

    .dest-feature-title span {
        color: #005d90;
        font-size: 1.5rem;
        font-weight: 800;
    }

    .dest-feature-subtitle {
        margin: 0;
        color: #404850;
        font-size: 1rem;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .dest-subtitle-icon {
        width: 12px;
        height: 14px;
        color: #005d90;
        flex-shrink: 0;
    }

    .dest-feature-description {
        margin: 0;
        color: #404850;
        line-height: 1.64;
        font-size: 0.9rem;
    }

    .dest-feature-stats {
        margin-top: 0;
        border-top: 1px solid #dfe7f1;
    }

    .dest-feature-stat {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 14px;
        padding: 11px 0;
        border-bottom: 1px solid #dfe7f1;
    }

    .dest-feature-stat span {
        color: #404850;
        font-size: 0.875rem;
        font-weight: 500;
    }

    .dest-feature-stat strong {
        color: #171c1f;
        font-size: 1rem;
        font-weight: 800;
        text-align: right;
        display: inline-flex;
        align-items: baseline;
        gap: 6px;
    }

    .dest-feature-stat small {
        color: #728097;
        font-size: 0.75rem;
        font-weight: 600;
    }

    .dest-rating-score {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        font-size: 1rem;
        line-height: 1;
        color: #171c1f;
    }

    .dest-rating-icon {
        width: 16px;
        height: 16px;
        color: #005d90;
        flex-shrink: 0;
        transform: translateY(1px);
    }

    .dest-feature-action {
        margin-top: auto;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        width: 100%;
        text-decoration: none;
        background: linear-gradient(90deg, #005d90 0%, #0077b6 100%);
        color: white;
        border-radius: 999px;
        padding: 16px 18px;
        font-size: 1rem;
        font-weight: 700;
        letter-spacing: 0.2px;
    }

    .dest-action-icon {
        width: 16px;
        height: 16px;
        flex-shrink: 0;
    }

    .dest-side-stack {
        display: grid;
        grid-template-rows: 1fr auto;
        gap: 24px;
        min-height: 480px;
    }

    .dest-ranking-card {
        background: #dce3eb;
        border: 1px solid #cfdae6;
        border-radius: 12px;
        padding: 24px;
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .dest-ranking-card h3 {
        margin: 0;
        color: #171c1f;
        font-size: 1.125rem;
        line-height: 1.4;
    }

    .dest-rank-item {
        margin-top: 0;
        background: #f4f7fb;
        border: 1px solid #d6e0ec;
        border-radius: 8px;
        padding: 12px;
    }

    .dest-rank-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 10px;
    }

    .dest-rank-label {
        display: inline-flex;
        align-items: center;
        gap: 9px;
        color: #171c1f;
        font-size: 0.875rem;
        font-weight: 700;
    }

    .dest-rank-id {
        width: 24px;
        height: 24px;
        border-radius: 7px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 0.67rem;
        font-weight: 700;
        color: #2e4f7d;
        background: #d7e4f4;
    }

    .dest-rank-score {
        color: #005d90;
        font-size: 0.75rem;
        font-weight: 800;
    }

    .dest-rank-bar {
        margin-top: 7px;
        width: 100%;
        height: 3px;
        border-radius: 999px;
        background: #d4ddea;
        overflow: hidden;
    }

    .dest-rank-fill {
        display: block;
        height: 100%;
        border-radius: inherit;
        background: #005d90;
    }

    .dest-insight-card {
        background: #d8e9e3;
        border: 1px solid #bfd7cd;
        border-left: 4px solid #1f7a4c;
        border-radius: 12px;
        padding: 24px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .dest-insight-card p {
        margin: 0;
        color: #404850;
        line-height: 1.64;
        font-size: 0.99rem;
    }

    .dest-insight-kicker {
        margin: 0 0 7px;
        color: #1f7a4c;
        font-size: 1rem;
        font-weight: 800;
        letter-spacing: 0.8px;
        text-transform: uppercase;
    }

    .dest-card-grid {
        margin-top: 16px;
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 24px;
        align-items: stretch;
    }

    .dest-mini-card {
        background: #f8fafc;
        border: 1px solid #dfe8f3;
        border-radius: 12px;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        min-height: 454px;
    }

    .dest-mini-media {
        position: relative;
        height: clamp(240px, 20vw, 340px);
        border-bottom: 1px solid #d7e0eb;
        overflow: hidden;
    }

    .dest-mini-media img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .dest-mini-media--rank3 img {
        object-position: center 20%;
    }

    .dest-mini-media--rank2 img {
        object-position: center 20%;
    }

    .dest-mini-rank {
        position: absolute;
        top: 10px;
        right: 10px;
        font-size: 0.62rem;
        font-weight: 700;
        color: #22517d;
        background: rgba(225, 239, 255, 0.94);
        border-radius: 999px;
        padding: 6px 9px;
    }

    .dest-mini-content {
        padding: 24px;
        display: flex;
        flex-direction: column;
        flex: 1;
    }

    .dest-mini-head {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 10px;
    }

    .dest-mini-head h4 {
        margin: 0;
        color: #171c1f;
        font-size: 1.25rem;
        line-height: 1.25;
        min-height: 28px;
    }

    .dest-mini-tag {
        flex-shrink: 0;
        background: #dff1ea;
        color: #226145;
        font-size: 0.58rem;
        font-weight: 800;
        letter-spacing: 0.6px;
        text-transform: uppercase;
        padding: 5px 8px;
        border-radius: 999px;
    }

    .dest-mini-location {
        margin: 6px 0 0;
        color: #637187;
        font-size: 0.75rem;
        min-height: 16px;
    }

    .dest-mini-meta {
        margin-top: 16px;
        padding-top: 16px;
        border-top: 1px solid #dbe4ef;
        display: flex;
        justify-content: space-between;
        gap: 12px;
    }

    .dest-mini-meta span {
        display: block;
        color: #6f7c92;
        font-size: 0.64rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .dest-mini-meta strong {
        color: #171c1f;
        font-size: 0.95rem;
    }

    .dest-mini-action {
        margin-top: auto;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        padding: 13px 14px;
        border: 1px solid #cad7e8;
        border-radius: 999px;
        text-decoration: none;
        color: #005d90;
        font-size: 0.875rem;
        font-weight: 700;
        letter-spacing: 0.2px;
        background: linear-gradient(180deg, #f8fbff 0%, #f2f6fb 100%);
        transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease, background 0.2s ease;
    }

    .dest-mini-action:hover {
        border-color: #005d90;
        background: linear-gradient(180deg, #ffffff 0%, #f8fbff 100%);
    }

    .dest-mini-action:focus-visible {
        outline: 3px solid rgba(0, 93, 144, 0.28);
        outline-offset: 2px;
    }

    .dest-final-cta {
        margin-top: 34px;
        background: #d7e1eb;
        border: 1px solid #cad5e2;
        border-radius: 16px;
        padding: 48px 22px;
        text-align: center;
    }

    .dest-final-cta h3 {
        margin: 0;
        color: #1f2733;
        font-size: 2.2rem;
    }

    .dest-final-cta p {
        margin: 12px auto 0;
        max-width: 600px;
        color: #4f5d73;
        line-height: 1.7;
        font-size: 0.95rem;
    }

    .dest-final-actions {
        margin-top: 24px;
        display: flex;
        justify-content: center;
        gap: 14px;
        flex-wrap: wrap;
    }

    .dest-final-primary,
    .dest-final-secondary {
        min-width: 178px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        padding: 12px 16px;
        border-radius: 999px;
        font-size: 0.84rem;
        font-weight: 700;
        border: 1px solid transparent;
        transition: all 0.2s ease;
    }

    .dest-final-primary {
        background: linear-gradient(90deg, #0b5ed7, #0a58ca);
        color: white;
    }

    .dest-final-secondary {
        background: #f2f6fb;
        border-color: #cad7e8;
        color: #244972;
    }

    .dest-feature-action:hover,
    .dest-mini-action:hover,
    .dest-final-primary:hover,
    .dest-final-secondary:hover {
        transform: translateY(-1px);
        box-shadow: 0 8px 18px rgba(15, 40, 70, 0.12);
    }

    @media (max-width: 1120px) {
        .dest-main-title {
            font-size: 2.5rem;
        }

        .dest-primary-grid {
            grid-template-columns: 1fr;
        }

        .dest-feature-card {
            min-height: 0;
        }

        .dest-feature-content {
            padding: 24px;
        }

        .dest-side-stack {
            min-height: 0;
            grid-template-columns: 1fr 1fr;
            grid-template-rows: auto;
            align-items: start;
        }

        .dest-ranking-card,
        .dest-insight-card {
            height: auto;
        }

        .dest-card-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .dest-mini-card {
            min-height: 0;
        }

        .dest-mini-media {
            height: clamp(240px, 28vw, 360px);
        }
    }

    @media (max-width: 860px) {
        .dest-landing {
            margin-top: 20px;
        }

        .dest-hero-head {
            flex-direction: column;
        }

        .dest-main-title {
            font-size: 2.1rem;
        }

        .dest-feature-card {
            grid-template-columns: 1fr;
        }

        .dest-feature-media {
            height: 290px;
            min-height: 290px;
        }

        .dest-feature-content {
            padding: 20px;
        }

        .dest-feature-title {
            font-size: 1.65rem;
        }

        .dest-feature-title span {
            font-size: 1.3rem;
        }

        .dest-side-stack {
            grid-template-columns: 1fr;
            grid-template-rows: auto;
            min-height: 0;
        }

        .dest-ranking-card,
        .dest-insight-card {
            height: auto;
        }

        .dest-card-grid {
            grid-template-columns: 1fr;
        }

        .dest-mini-media {
            height: clamp(220px, 44vw, 320px);
        }

        .dest-final-cta {
            padding: 34px 18px;
        }

        .dest-final-cta h3 {
            font-size: 1.72rem;
        }

        .dest-final-actions {
            flex-direction: column;
            align-items: center;
        }

        .dest-final-primary,
        .dest-final-secondary {
            width: 100%;
            max-width: 250px;
        }
    }

    @media (max-width: 520px) {
        .dest-main-title {
            font-size: 1.82rem;
        }

        .dest-meta-row {
            gap: 8px;
        }

        .dest-meta-chip {
            width: 100%;
        }

        .dest-feature-content {
            padding: 16px;
        }

        .dest-feature-title {
            font-size: 1.75rem;
        }

        .dest-feature-title span {
            font-size: 1.64rem;
        }

        .dest-mini-content {
            padding: 16px;
        }

        .dest-mini-head h4 {
            font-size: 1.28rem;
            min-height: 0;
        }

        .dest-mini-meta strong {
            font-size: 0.9rem;
        }
    }
</style>
@endpush

@section('content')

<div class="dest-landing">
    <section class="dest-hero-head">
        <div>
            <p class="dest-eyebrow">Mathematical Precision</p>
            <h1 class="dest-main-title">Your Curated Bali <span>Horizon</span></h1>
        </div>

        <div class="dest-mode-switch" role="tablist" aria-label="Result perspective mode">
            <button class="dest-mode-btn active" type="button" aria-selected="true">Top Ranked</button>
            <button class="dest-mode-btn" type="button" aria-selected="false">Near You</button>
        </div>
    </section>

    <div class="dest-meta-row">
        <span class="dest-meta-chip">SAW Methodology Applied</span>
        <span class="dest-meta-chip">TOPSIS Vector Normalization</span>
        <span class="dest-meta-chip">Live Data: Nov 2024</span>
    </div>

    <section class="dest-primary-grid">
        <article class="dest-feature-card">
            <div class="dest-feature-media">
                <span class="dest-feature-badge">
                    <svg class="dest-badge-icon" viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M12 3.6l2.06 4.17 4.6.67-3.33 3.24.79 4.58L12 14.1l-4.12 2.16.79-4.58-3.33-3.24 4.6-.67L12 3.6z" fill="currentColor"/>
                    </svg>
                    Peak Recommendation
                </span>
                <img src="https://images.unsplash.com/photo-1537953773345-d172ccf13cf1?auto=format&fit=crop&w=1000&q=80" alt="Uluwatu Temple at sunset">
            </div>

            <div class="dest-feature-content">
                <div class="dest-feature-top">
                    <h2 class="dest-feature-title">
                        Uluwatu Temple
                        <span>0.982</span>
                    </h2>
                    <p class="dest-feature-subtitle">
                        <svg class="dest-subtitle-icon" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M12 2.5c-3.87 0-7 3.1-7 6.93 0 5.02 7 12.07 7 12.07s7-7.05 7-12.07c0-3.83-3.13-6.93-7-6.93zm0 9.54a2.6 2.6 0 110-5.2 2.6 2.6 0 010 5.2z" fill="currentColor"/>
                        </svg>
                        <span>Pecatu, South Kuta</span>
                    </p>
                    <p class="dest-feature-description">
                        Perched on a 70-meter high cliff projecting into the sea, Uluwatu offers the most spiritually resonant sunset in Bali.
                        Scoring highest in atmosphere and cultural significance metrics.
                    </p>
                </div>

                <div class="dest-feature-bottom">
                    <div class="dest-feature-stats">
                        <div class="dest-feature-stat">
                            <span>Entry Fee</span>
                            <strong>IDR 50,000</strong>
                        </div>
                        <div class="dest-feature-stat">
                            <span>Traveler Rating</span>
                            <strong>
                                <span class="dest-rating-score">
                                    <svg class="dest-rating-icon" viewBox="0 0 24 24" aria-hidden="true">
                                        <path d="M12 3.6l2.06 4.17 4.6.67-3.33 3.24.79 4.58L12 14.1l-4.12 2.16.79-4.58-3.33-3.24 4.6-.67L12 3.6z" fill="currentColor"/>
                                    </svg>
                                    4.9
                                </span>
                                <small>(12.4k reviews)</small>
                            </strong>
                        </div>
                    </div>

                    <a class="dest-feature-action" href="{{ route('user.destinations.detail', ['id' => 1]) }}">
                        <span>View Experience Details</span>
                        <svg class="dest-action-icon" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M13.96 5.46l6.04 6.04-6.04 6.04-1.42-1.42 3.62-3.62H4v-2h12.16l-3.62-3.62 1.42-1.42z" fill="currentColor"/>
                        </svg>
                    </a>
                </div>
            </div>
        </article>

        <aside class="dest-side-stack">
            <section class="dest-ranking-card">
                <h3>Precision Rankings</h3>

                <article class="dest-rank-item">
                    <div class="dest-rank-top">
                        <div class="dest-rank-label">
                            <span class="dest-rank-id">01</span>
                            Uluwatu Temple
                        </div>
                        <span class="dest-rank-score">0.98</span>
                    </div>
                    <div class="dest-rank-bar"><span class="dest-rank-fill" style="width:98%;"></span></div>
                </article>

                <article class="dest-rank-item">
                    <div class="dest-rank-top">
                        <div class="dest-rank-label">
                            <span class="dest-rank-id">02</span>
                            Ubud Sacred Forest
                        </div>
                        <span class="dest-rank-score">0.92</span>
                    </div>
                    <div class="dest-rank-bar"><span class="dest-rank-fill" style="width:92%;"></span></div>
                </article>

                <article class="dest-rank-item">
                    <div class="dest-rank-top">
                        <div class="dest-rank-label">
                            <span class="dest-rank-id">03</span>
                            Seminyak Coastal
                        </div>
                        <span class="dest-rank-score">0.87</span>
                    </div>
                    <div class="dest-rank-bar"><span class="dest-rank-fill" style="width:87%;"></span></div>
                </article>
            </section>

            <section class="dest-insight-card">
                <p class="dest-insight-kicker">Top Value Find</p>
                <p>
                    Based on TOPSIS, Ubud offers the ideal compromise between cost and experiential quality for your profile.
                </p>
            </section>
        </aside>
    </section>

    <section class="dest-card-grid">
        <article class="dest-mini-card">
            <div class="dest-mini-media dest-mini-media--rank2">
                <img src="https://images.unsplash.com/photo-1535083783855-76ae62b2914e?auto=format&fit=crop&w=900&q=80" alt="Ubud Sacred Forest">
                <span class="dest-mini-rank">Rank #2</span>
            </div>

            <div class="dest-mini-content">
                <div class="dest-mini-head">
                    <h4>Ubud Sacred Forest</h4>
                    <span class="dest-mini-tag">High TOPSIS</span>
                </div>
                <p class="dest-mini-location">Ubud, Gianyar</p>

                <div class="dest-mini-meta">
                    <div>
                        <span>Price</span>
                        <strong>IDR 80,000</strong>
                    </div>
                    <div>
                        <span>Rating</span>
                        <strong>4.7</strong>
                    </div>
                </div>

                <a class="dest-mini-action" href="{{ route('user.destinations.detail', ['id' => 2]) }}">Explore Destination</a>
            </div>
        </article>

        <article class="dest-mini-card">
            <div class="dest-mini-media dest-mini-media--rank3">
                <img src="https://images.unsplash.com/photo-1537996194471-e657df975ab4?auto=format&fit=crop&w=900&q=80" alt="Seminyak coastline beach view">
                <span class="dest-mini-rank">Rank #3</span>
            </div>

            <div class="dest-mini-content">
                <div class="dest-mini-head">
                    <h4>Seminyak Coastal</h4>
                    <span class="dest-mini-tag">Lifestyle Choice</span>
                </div>
                <p class="dest-mini-location">Seminyak, Kuta</p>

                <div class="dest-mini-meta">
                    <div>
                        <span>Price</span>
                        <strong>Free Entry</strong>
                    </div>
                    <div>
                        <span>Rating</span>
                        <strong>4.6</strong>
                    </div>
                </div>

                <a class="dest-mini-action" href="{{ route('user.destinations.detail', ['id' => 3]) }}">Explore Destination</a>
            </div>
        </article>

        <article class="dest-mini-card">
            <div class="dest-mini-media">
                <img src="https://images.unsplash.com/photo-1531973576160-7125cd663d86?auto=format&fit=crop&w=900&q=80" alt="Tegallalang rice terrace fields">
                <span class="dest-mini-rank">Rank #4</span>
            </div>

            <div class="dest-mini-content">
                <div class="dest-mini-head">
                    <h4>Tegallalang Terrace</h4>
                    <span class="dest-mini-tag">Scenic High</span>
                </div>
                <p class="dest-mini-location">Tegallalang, Gianyar</p>

                <div class="dest-mini-meta">
                    <div>
                        <span>Price</span>
                        <strong>IDR 15,000</strong>
                    </div>
                    <div>
                        <span>Rating</span>
                        <strong>4.8</strong>
                    </div>
                </div>

                <a class="dest-mini-action" href="{{ route('user.destinations.detail', ['id' => 4]) }}">Explore Destination</a>
            </div>
        </article>
    </section>

    <section class="dest-final-cta">
        <h3>Not quite what you're looking for?</h3>
        <p>
            Our algorithm can refine results based on your specific criteria.
            Adjust your weights for price, distance, or cultural immersion and recalculate instantly.
        </p>

        <div class="dest-final-actions">
            <a class="dest-final-primary" href="{{ route('user.home') }}">Refine Criteria</a>
            <a class="dest-final-secondary" href="{{ route('contact') }}">Save Comparison</a>
        </div>
    </section>
</div>

@endsection
