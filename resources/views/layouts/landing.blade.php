<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        /* ============================================
           CSS TEMANMU — diambil dari layouts/app.blade.php
           ============================================ */
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background: #f5f7fa;
        }

        .container {
            width: 90%;
            margin: auto;
        }

        .site-header {
            position: sticky;
            top: 0;
            z-index: 30;
            background: rgba(255, 255, 255, 0.95);
            border-bottom: 1px solid #e3eaf5;
            backdrop-filter: blur(8px);
        }

        .header-shell {
            display: flex;
            align-items: center;
            gap: 18px;
            min-height: 86px;
        }

        .brand-mark {
            text-decoration: none;
            color: #1a1a1a;
            font-size: 20px;
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        .site-nav {
            margin-left: auto;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .nav-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #2f3a4d;
            text-decoration: none;
            font-size: 0.94rem;
            font-weight: 600;
            padding: 10px 14px;
            border-radius: 999px;
            border: 1px solid transparent;
            transition: all 0.2s ease;
        }

        .nav-link:hover {
            color: #0b5ed7;
            background: #edf4ff;
            border-color: #d8e7ff;
        }

        .nav-link.is-active {
            color: #0b5ed7;
            background: #e7f1ff;
            border-color: #b7d2ff;
            box-shadow: 0 5px 14px rgba(11, 94, 215, 0.16);
        }

        .profile-avatar {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            font-size: 0.93rem;
            font-weight: 700;
            letter-spacing: 0.9px;
            color: white;
            background: linear-gradient(135deg, #0b5ed7, #1f7a4c);
            box-shadow: 0 10px 22px rgba(11, 94, 215, 0.24);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .profile-avatar:hover {
            transform: translateY(-1px);
            box-shadow: 0 13px 25px rgba(11, 94, 215, 0.28);
        }

        .menu-toggle {
            display: none;
            width: 44px;
            height: 44px;
            padding: 0;
            border-radius: 12px;
            border: 1px solid #dce7f7;
            background: white;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            gap: 5px;
            cursor: pointer;
        }

        .menu-toggle span {
            width: 18px;
            height: 2px;
            border-radius: 2px;
            background: #24334d;
        }

        .nav-link:focus-visible,
        .profile-avatar:focus-visible,
        .menu-toggle:focus-visible {
            outline: 3px solid rgba(11, 94, 215, 0.28);
            outline-offset: 2px;
        }

        /* Footer */
        .site-footer {
            margin-top: 80px;
            padding: 34px 0 20px;
            border-top: 1px solid #dde5f1;
            background: linear-gradient(180deg, #f9fbff 0%, #f5f7fa 100%);
            color: #5a6578;
            font-size: 14px;
        }

        .footer-shell {
            display: flex;
            flex-direction: column;
            gap: 26px;
        }

        .footer-top {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 40px;
        }

        .footer-brand {
            max-width: 460px;
        }

        .footer-logo {
            text-decoration: none;
            color: #1a1a1a;
            font-size: 1.15rem;
            font-weight: 700;
            letter-spacing: 0.3px;
        }

        .footer-tagline {
            margin: 12px 0 0;
            color: #5a6578;
            line-height: 1.75;
        }

        .footer-columns {
            display: flex;
            gap: 36px;
            flex-wrap: wrap;
        }

        .footer-column {
            min-width: 165px;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .footer-column h4 {
            margin: 0 0 2px;
            color: #2b374a;
            font-size: 0.78rem;
            letter-spacing: 0.8px;
            font-weight: 700;
            text-transform: uppercase;
        }

        .footer-link {
            text-decoration: none;
            color: #4f5b70;
            font-weight: 600;
            transition: color 0.2s ease, transform 0.2s ease;
        }

        .footer-link:hover {
            color: #0b5ed7;
            transform: translateX(1px);
        }

        .footer-bottom {
            border-top: 1px solid #dce5f3;
            padding-top: 16px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 14px;
        }

        .footer-copy,
        .footer-meta {
            margin: 0;
            color: #687486;
            font-size: 0.86rem;
        }

        .footer-meta {
            font-weight: 600;
        }

        /* Responsive header */
        @media (max-width: 860px) {
            .header-shell {
                min-height: auto;
                padding: 14px 0;
                gap: 12px;
                flex-wrap: wrap;
            }

            .menu-toggle {
                display: inline-flex;
                margin-left: auto;
            }

            .site-nav {
                order: 4;
                width: 100%;
                display: none;
                flex-direction: column;
                align-items: stretch;
                margin: 8px 0 4px;
                padding: 10px;
                gap: 8px;
                border: 1px solid #dce7f7;
                border-radius: 16px;
                background: white;
                box-shadow: 0 12px 30px rgba(20, 45, 80, 0.08);
            }

            .site-nav.open {
                display: flex;
            }

            .nav-link {
                width: 100%;
                justify-content: flex-start;
                border-radius: 12px;
                padding: 12px 14px;
            }

            .profile-avatar {
                width: 40px;
                height: 40px;
                font-size: 0.84rem;
            }

            .site-footer {
                margin-top: 60px;
                padding: 28px 0 18px;
            }

            .footer-top {
                flex-direction: column;
                gap: 22px;
            }

            .footer-columns {
                width: 100%;
                gap: 18px;
            }

            .footer-column {
                min-width: calc(50% - 10px);
            }

            .footer-bottom {
                flex-direction: column;
                align-items: flex-start;
            }
        }

        @media (max-width: 520px) {
            .footer-column {
                min-width: 100%;
            }
        }

        /* ============================================
           CSS LANDING — khusus halaman landing
           ============================================ */

        /* ── Hero ── */
        .landing-hero {
            height: 100vh;
            display: flex;
            align-items: flex-end;
            padding: 0 60px 160px;
            background-image:
                linear-gradient(
                    to right,
                    rgba(255,255,255,0.92) 0%,
                    rgba(255,255,255,0.75) 30%,
                    rgba(255,255,255,0.2) 55%,
                    rgba(255,255,255,0.0) 75%
                ),
                url('/images/landingbg.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .landing-hero-content {
            max-width: 560px;
        }

        .landing-tag {
            display: inline-block;
            background: #dcfce7;
            border: 1px solid #bbf7d0;
            color: #166534;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 11px;
            letter-spacing: 1px;
            margin-bottom: 18px;
            font-weight: 600;
        }

        .landing-hero-content h1 {
            font-size: 72px;
            margin: 0 0 32px;
            line-height: 1.05;
            font-weight: 900;
            color: #1e293b;
            letter-spacing: -2px;
        }

        .landing-highlight {
            color: #0ea5e9;
        }

        .landing-hero-buttons {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .landing-btn-primary {
            background: #0ea5e9;
            color: white;
            padding: 16px 36px;
            border-radius: 30px;
            font-size: 17px;
            border: none;
            cursor: pointer;
            font-weight: 700;
            transition: background 0.2s;
        }

        .landing-btn-primary:hover {
            background: #0284c7;
        }

        .landing-btn-secondary {
            background: transparent;
            color: #1e293b;
            border: none;
            font-size: 16px;
            cursor: pointer;
            padding: 0 8px;
            text-decoration: underline;
            text-underline-offset: 4px;
            font-weight: 600;
            margin-left: 12px;
        }

        /* ── Features ── */
        .landing-features {
            padding: 80px 60px;
            background: white;
        }

        .landing-features-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-bottom: 40px;
            gap: 40px;
        }

        .landing-features-left {
            flex-shrink: 0;
        }

        .landing-section-tag {
            font-size: 11px;
            letter-spacing: 1.5px;
            color: #0ea5e9;
            font-weight: 600;
        }

        .landing-features-left h2 {
            font-size: 32px;
            margin: 8px 0 0;
            color: #1e293b;
        }

        .landing-features-desc {
            max-width: 400px;
            color: #64748b;
            font-size: 14px;
            line-height: 1.7;
            margin: 0;
        }

        .landing-features-grid {
            display: grid;
            grid-template-columns: 1fr 1fr 1.2fr;
            gap: 20px;
        }

        .landing-feature-card {
            border-radius: 20px;
            padding: 32px;
            min-height: 280px;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .landing-feature-card.light {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
        }

        .landing-feature-card.dark {
            background: #0f172a;
            color: white;
        }

        .landing-feature-card.dark p {
            color: rgba(255,255,255,0.65);
            font-size: 14px;
            line-height: 1.6;
        }

        .landing-feature-card.image-card {
            background-image: url('/images/landingbg.png');
            background-size: cover;
            background-position: center;
            padding: 0;
            overflow: hidden;
            position: relative;
            min-height: 280px;
        }

        .landing-feature-card-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 24px;
            background: linear-gradient(to top, rgba(0,0,0,0.75), transparent);
            color: white;
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .landing-feature-card-overlay h3 {
            margin: 0;
            font-size: 20px;
            color: white;
        }

        .landing-card-badge {
            font-size: 10px;
            letter-spacing: 1px;
            color: rgba(255,255,255,0.7);
        }

        .landing-card-rating {
            font-size: 12px;
            color: #fbbf24;
        }

        .landing-feature-icon {
            font-size: 20px;
            background: white;
            width: 44px;
            height: 44px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            flex-shrink: 0;
        }

        .landing-feature-card.dark .landing-feature-icon {
            background: #1e293b;
            color: white;
        }

        .landing-feature-card h3 {
            font-size: 18px;
            margin: 0;
            color: #1e293b;
        }

        .landing-feature-card.dark h3 {
            color: white;
        }

        .landing-feature-card p {
            font-size: 14px;
            color: #64748b;
            line-height: 1.6;
            margin: 0;
        }

        .landing-feature-tags {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
            margin-top: auto;
        }

        .landing-feature-tags span {
            background: #e0f2fe;
            color: #0369a1;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
        }

        .landing-explore-link {
            margin-top: auto;
            color: #38bdf8;
            font-size: 12px;
            letter-spacing: 1px;
            text-decoration: none;
            font-weight: 600;
        }

        /* ── Popular ── */
        .landing-popular {
            padding: 80px 60px;
            background: #f8fafc;
        }

        .landing-popular-header {
            margin-bottom: 32px;
        }

        .landing-popular-header h2 {
            font-size: 28px;
            margin: 0 0 6px;
            color: #1e293b;
        }

        .landing-popular-header p {
            color: #64748b;
            font-size: 14px;
            margin: 0;
        }

        .landing-popular-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .landing-popular-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 16px rgba(0,0,0,0.07);
            display: flex;
            flex-direction: column;
        }

        .landing-popular-img {
            height: 220px;
            background-size: cover;
            background-position: center;
            position: relative;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            padding: 12px;
            flex-shrink: 0;
        }

        .img-uluwatu  { background-image: url('/images/Uluwatu Temple.png'); }
        .img-tirta    { background-image: url('/images/Tirta Empul.png'); }
        .img-ulundanu { background-image: url('/images/Pura Ulun Danu.png'); }
        .img-tanahlot { background-image: url('/images/Tanah Lot Temple.png'); }
        .img-ubud     { background-image: url('/images/Ubud Monkey Forest.png'); }
        .img-seminyak { background-image: url('/images/Seminyak Beach.png'); }

        .landing-pop-badge {
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1px;
            padding: 4px 10px;
            border-radius: 20px;
            color: white;
            height: fit-content;
        }

        .landing-pop-badge.heritage  { background: #7c3aed; }
        .landing-pop-badge.spiritual { background: #059669; }
        .landing-pop-badge.landmark  { background: #0369a1; }
        .landing-pop-badge.nature    { background: #d97706; }
        .landing-pop-badge.culture   { background: #db2777; }

        .landing-pop-match {
            font-size: 11px;
            color: white;
            background: rgba(0,0,0,0.45);
            padding: 4px 10px;
            border-radius: 20px;
            height: fit-content;
        }

        .landing-popular-info {
            padding: 16px;
            display: flex;
            flex-direction: column;
            flex: 1;
        }

        .landing-popular-info h4 {
            margin: 0 0 3px;
            font-size: 16px;
            font-weight: 700;
            color: #1e293b;
        }

        .landing-popular-info > p {
            color: #64748b;
            font-size: 12px;
            margin: 0 0 10px;
        }

        .landing-pop-tags {
            display: flex;
            gap: 6px;
            flex-wrap: wrap;
            margin-bottom: 12px;
        }

        .landing-pop-tags span {
            background: #f1f5f9;
            color: #475569;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 11px;
        }

        .landing-pop-footer {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            padding-top: 10px;
            border-top: 1px solid #f1f5f9;
            margin-top: auto;
        }

        .landing-pop-footer-item {
            display: flex;
            flex-direction: column;
            gap: 3px;
        }

        .landing-pop-footer-item.align-end {
            align-items: flex-end;
        }

        .landing-pop-footer-label {
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 0.8px;
            color: #94a3b8;
            text-transform: uppercase;
        }

        .landing-pop-footer-value {
            font-weight: 700;
            color: #1e293b;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 3px;
        }

        .landing-pop-footer-value.rating::before {
            content: '★';
            color: #f59e0b;
            font-size: 14px;
        }

        /* ── CTA ── */
        .landing-cta-wrapper {
            padding: 60px;
            background: #f8fafc;
            display: flex;
            justify-content: center;
        }

        .landing-cta {
            background: #1a6cb8;
            padding: 70px 80px;
            text-align: center;
            color: white;
            border-radius: 28px;
            width: 100%;
            max-width: 860px;
        }

        .landing-cta h2 {
            font-size: 42px;
            margin: 0 0 16px;
            font-weight: 800;
            letter-spacing: -0.5px;
        }

        .landing-cta p {
            font-size: 15px;
            color: rgba(255,255,255,0.85);
            margin: 0 auto 36px;
            line-height: 1.6;
            max-width: 460px;
        }

        .landing-cta-buttons {
            display: flex;
            justify-content: center;
            gap: 16px;
            flex-wrap: wrap;
        }

        .landing-cta-btn {
            padding: 14px 32px;
            border-radius: 30px;
            font-size: 15px;
            cursor: pointer;
            font-weight: 600;
            border: none;
            text-decoration: none;
            display: inline-block;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .landing-cta-btn.primary {
            background: white;
            color: #1a6cb8;
            font-weight: 700;
        }

        .landing-cta-btn.secondary {
            background: transparent;
            color: white;
            border: 2px solid rgba(255,255,255,0.5);
        }

        .landing-cta-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 18px rgba(15,40,70,0.12);
        }
    </style>
</head>

<body>

    @include('partials.header')

    @yield('content')

    @include('partials.footer')

</body>

</html>