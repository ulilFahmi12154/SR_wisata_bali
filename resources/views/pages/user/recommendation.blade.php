@extends('layouts.user')

@section('title', 'Hasil Rekomendasi')

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
        <span class="dest-meta-chip">
            <img src="{{ asset('images/movbyrmy-g9geong.svg') }}" alt="" class="inline-block h-3.5 w-3.5 mr-1.5 align-[-2px]">
            SAW Methodology Applied
        </span>
        <span class="dest-meta-chip">
            <img src="{{ asset('images/movbyrmy-d6m97v5.svg') }}" alt="" class="inline-block h-3.5 w-3.5 mr-1.5 align-[-2px]">
            TOPSIS Vector Normalization
        </span>
        <span class="dest-meta-chip">
            <img src="{{ asset('images/movbyrmy-j37pxmn.svg') }}" alt="" class="inline-block h-3.5 w-3.5 mr-1.5 align-[-2px]">
            Live Data: Nov 2024
        </span>
    </div>

    <section class="dest-primary-grid">
        <article class="dest-feature-card">
            <div class="dest-feature-media">
                <span class="dest-feature-badge">
                    <img src="{{ asset('images/movbyrmy-vr5gh2k.svg') }}" alt="" class="dest-badge-icon">
                    Peak Recommendation
                </span>
                <img src="{{ asset('images/movbyrn9-vx3yj9l.png') }}" alt="Uluwatu Temple at sunset">
            </div>

            <div class="dest-feature-content">
                <div class="dest-feature-top">
                    <h2 class="dest-feature-title">
                        Uluwatu Temple
                        <span>0.982</span>
                    </h2>
                    <p class="dest-feature-subtitle">
                        <img src="{{ asset('images/movbyrmy-7yijfgn.svg') }}" alt="" class="dest-subtitle-icon">
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
                                    <img src="{{ asset('images/movbyrmy-rzsyob7.svg') }}" alt="" class="dest-rating-icon">
                                    4.9
                                </span>
                                <small>(12.4k reviews)</small>
                            </strong>
                        </div>
                    </div>

                    <a class="dest-feature-action" href="{{ route('user.destinations.detail', ['id' => 1]) }}">
                        <span>View Experience Details</span>
                        <img src="{{ asset('images/movbyrmy-yh6qu76.svg') }}" alt="" class="dest-action-icon">
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
                <img src="{{ asset('images/movbyrn9-y885wrd.png') }}" alt="Ubud Sacred Forest">
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
                        <strong class="dest-rating-score">
                            <img src="{{ asset('images/movbyrmy-f378dwg.svg') }}" alt="" class="dest-rating-icon">
                            4.7
                        </strong>
                    </div>
                </div>

                <a class="dest-mini-action" href="{{ route('user.destinations.detail', ['id' => 2]) }}">Explore Destination</a>
            </div>
        </article>

        <article class="dest-mini-card">
            <div class="dest-mini-media dest-mini-media--rank3">
                <img src="{{ asset('images/movbyrn9-mdt1tcp.png') }}" alt="Seminyak coastline beach view">
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
                        <strong class="dest-rating-score">
                            <img src="{{ asset('images/movbyrmy-f378dwg.svg') }}" alt="" class="dest-rating-icon">
                            4.6
                        </strong>
                    </div>
                </div>

                <a class="dest-mini-action" href="{{ route('user.destinations.detail', ['id' => 3]) }}">Explore Destination</a>
            </div>
        </article>

        <article class="dest-mini-card">
            <div class="dest-mini-media">
                <img src="{{ asset('images/movbyrn9-uo1v0vf.png') }}" alt="Tegallalang rice terrace fields">
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
                        <strong class="dest-rating-score">
                            <img src="{{ asset('images/movbyrmy-f378dwg.svg') }}" alt="" class="dest-rating-icon">
                            4.8
                        </strong>
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
