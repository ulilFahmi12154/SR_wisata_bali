@extends('layouts.app')

@section('title', 'Destinations')

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

                    <a class="dest-feature-action" href="{{ route('destination-detail') }}">
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

                <a class="dest-mini-action" href="{{ route('curations') }}">Explore Destination</a>
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

                <a class="dest-mini-action" href="{{ route('curations') }}">Explore Destination</a>
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

                <a class="dest-mini-action" href="{{ route('curations') }}">Explore Destination</a>
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
            <a class="dest-final-primary" href="{{ route('curations') }}">Refine Criteria</a>
            <a class="dest-final-secondary" href="{{ route('contact') }}">Save Comparison</a>
        </div>
    </section>
</div>

@endsection
