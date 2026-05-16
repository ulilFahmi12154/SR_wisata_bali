<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&family=DM+Sans&display=swap" rel="stylesheet">

    {{-- Tailwind CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- App assets --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Alpine --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        :root {
            --landing-ink: #142033;
            --landing-muted: #61718a;
            --landing-line: #dbe6f2;
            --landing-sky: #0369a1;
            --landing-sky-soft: #e0f2fe;
            --landing-cream: #fff7ed;
            --landing-card: rgba(255, 255, 255, 0.86);
            --landing-shadow: 0 24px 70px rgba(15, 23, 42, 0.09);
        }

        * {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            margin: 0;
            font-family: 'DM Sans', 'Segoe UI', sans-serif;
            background: linear-gradient(180deg, #f7fbff 0%, #f4f8fb 48%, #fffaf2 100%);
            color: var(--landing-ink);
        }

        .landing-page {
            min-height: 100vh;
            overflow-x: hidden;
        }

        .landing-page .font-display,
        .landing-page h1,
        .landing-page h2 {
            font-family: 'Playfair Display', serif;
        }

        /* Navbar, scoped to landing only */
        .landing-page > header {
            background: rgba(255, 255, 255, 0.78);
            border-bottom: 1px solid rgba(203, 213, 225, 0.62);
            box-shadow: 0 14px 36px rgba(15, 23, 42, 0.06);
            backdrop-filter: blur(18px);
        }

        .landing-page > header > div {
            max-width: 1180px;
            padding-left: 24px;
            padding-right: 24px;
        }

        .landing-page > header > div > div {
            min-height: 68px;
            align-items: center;
        }

        .landing-page > header > div > div > a:first-child {
            gap: 12px;
            text-decoration: none;
        }

        .landing-page > header > div > div > a:first-child > div {
            width: 40px;
            height: 40px;
            border-radius: 16px;
            background: linear-gradient(135deg, #0284c7 0%, #0f766e 100%);
            box-shadow: 0 12px 28px rgba(2, 132, 199, 0.18);
        }

        .landing-page > header > div > div > a:first-child span {
            color: var(--landing-ink);
            font-size: 1.08rem;
            letter-spacing: 0;
        }

        .landing-page > header nav {
            gap: 18px;
        }

        .landing-page > header nav a {
            display: inline-flex;
            align-items: center;
            min-height: 38px;
            padding: 8px 13px;
            border-radius: 999px;
            color: #475569;
            transition: color 0.2s ease, background 0.2s ease, box-shadow 0.2s ease;
        }

        .landing-page > header nav a:hover {
            color: #075985;
            background: rgba(224, 242, 254, 0.72);
            box-shadow: inset 0 0 0 1px rgba(14, 116, 144, 0.08);
        }

        .landing-page > header a[href*="login"] {
            border-radius: 999px;
            background: #0369a1;
            color: white;
            padding: 10px 18px;
            font-weight: 700;
            box-shadow: 0 14px 32px rgba(2, 132, 199, 0.18);
            transition: transform 0.2s ease, background 0.2s ease, box-shadow 0.2s ease;
        }

        .landing-page > header a[href*="login"]:hover {
            background: #075985;
            transform: translateY(-1px);
            box-shadow: 0 18px 38px rgba(2, 132, 199, 0.22);
        }

        /* Hero */
        .landing-hero {
            min-height: calc(100vh - 68px);
            display: flex;
            align-items: center;
            padding: 84px 60px 96px;
            position: relative;
            isolation: isolate;
            background-image:
                linear-gradient(105deg, rgba(248, 250, 252, 0.94) 0%, rgba(248, 250, 252, 0.78) 34%, rgba(241, 245, 249, 0.28) 58%, rgba(255, 247, 237, 0.08) 100%),
                linear-gradient(18deg, rgba(15, 23, 42, 0.14) 0%, rgba(14, 116, 144, 0.08) 42%, rgba(251, 191, 36, 0.10) 100%),
                url('/images/landingbg.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .landing-hero::after {
            content: '';
            position: absolute;
            inset: auto 0 0;
            height: 140px;
            z-index: -1;
            background: linear-gradient(180deg, rgba(247, 251, 255, 0), #f7fbff 88%);
        }

        .landing-hero-content {
            width: min(620px, 100%);
            margin-left: max(0px, calc((100vw - 1180px) / 2));
        }

        .landing-tag,
        .landing-section-tag {
            display: inline-flex;
            align-items: center;
            width: fit-content;
            border-radius: 999px;
            font-size: 0.68rem;
            font-weight: 800;
            letter-spacing: 0.14em;
            text-transform: uppercase;
        }

        .landing-tag {
            margin-bottom: 20px;
            padding: 8px 14px;
            color: #075985;
            background: rgba(255, 255, 255, 0.68);
            border: 1px solid rgba(125, 211, 252, 0.45);
            box-shadow: 0 12px 30px rgba(14, 116, 144, 0.09);
            backdrop-filter: blur(12px);
        }

        .landing-hero-content h1 {
            max-width: 680px;
            margin: 0 0 28px;
            color: #172033;
            font-size: clamp(3rem, 6vw, 4.75rem);
            font-weight: 700;
            line-height: 1.04;
            letter-spacing: 0;
        }

        .landing-highlight {
            color: #0369a1;
            text-shadow: 0 12px 34px rgba(2, 132, 199, 0.12);
        }

        .landing-hero-buttons,
        .landing-cta-buttons {
            display: flex;
            align-items: center;
            gap: 14px;
            flex-wrap: wrap;
        }

        .landing-btn-primary,
        .landing-cta-btn.primary {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 50px;
            padding: 14px 24px;
            border-radius: 18px;
            border: 1px solid #0369a1;
            background: #0369a1;
            color: white;
            text-decoration: none;
            font-size: 0.95rem;
            font-weight: 800;
            box-shadow: 0 16px 34px rgba(2, 132, 199, 0.20);
            transition: transform 0.2s ease, background 0.2s ease, box-shadow 0.2s ease;
        }

        .landing-btn-primary:hover,
        .landing-cta-btn.primary:hover {
            background: #075985;
            transform: translateY(-1px);
            box-shadow: 0 20px 44px rgba(2, 132, 199, 0.24);
        }

        .landing-btn-secondary {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 48px;
            padding: 12px 18px;
            border-radius: 18px;
            color: #334155;
            background: rgba(255, 255, 255, 0.66);
            border: 1px solid rgba(203, 213, 225, 0.76);
            text-decoration: none;
            font-size: 0.94rem;
            font-weight: 700;
            box-shadow: 0 12px 30px rgba(15, 23, 42, 0.06);
            backdrop-filter: blur(12px);
            transition: transform 0.2s ease, color 0.2s ease, border-color 0.2s ease, background 0.2s ease;
        }

        .landing-btn-secondary:hover {
            color: #075985;
            border-color: rgba(56, 189, 248, 0.45);
            background: rgba(255, 255, 255, 0.82);
            transform: translateY(-1px);
        }

        /* Features */
        .landing-features {
            scroll-margin-top: 92px;
            padding: 72px 60px;
            background: linear-gradient(180deg, #f7fbff 0%, #f1f7fb 100%);
        }

        .landing-features-header,
        .landing-popular-header {
            max-width: 1180px;
            margin: 0 auto;
        }

        .landing-features-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            gap: 40px;
            margin-bottom: 32px;
        }

        .landing-section-tag {
            color: #0369a1;
            margin-bottom: 10px;
        }

        .landing-features-left h2,
        .landing-popular-header h2 {
            margin: 0;
            color: var(--landing-ink);
            font-size: clamp(2rem, 3vw, 2.55rem);
            font-weight: 700;
            line-height: 1.12;
        }

        .landing-features-desc,
        .landing-popular-header p {
            max-width: 430px;
            margin: 0;
            color: var(--landing-muted);
            font-size: 0.95rem;
            line-height: 1.75;
        }

        .landing-features-grid {
            max-width: 1180px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr 1fr 1.16fr;
            gap: 22px;
        }

        .landing-feature-card {
            min-height: 292px;
            display: flex;
            flex-direction: column;
            gap: 14px;
            border-radius: 28px;
            padding: 30px;
            border: 1px solid rgba(203, 213, 225, 0.68);
            box-shadow: 0 20px 58px rgba(15, 23, 42, 0.07);
            overflow: hidden;
        }

        .landing-feature-card.light {
            background: rgba(255, 255, 255, 0.86);
        }

        .landing-feature-card.dark {
            color: #f8fafc;
            background:
                linear-gradient(135deg, rgba(15, 23, 42, 0.94), rgba(14, 69, 94, 0.90)),
                linear-gradient(135deg, rgba(251, 191, 36, 0.12), transparent);
            border-color: rgba(148, 163, 184, 0.26);
            box-shadow: 0 24px 66px rgba(15, 23, 42, 0.13);
        }

        .landing-feature-icon {
            width: 46px;
            height: 46px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            border-radius: 16px;
            color: #0369a1;
            background: rgba(224, 242, 254, 0.82);
            border: 1px solid rgba(125, 211, 252, 0.34);
            font-size: 1.1rem;
            font-weight: 800;
        }

        .landing-feature-card.dark .landing-feature-icon {
            color: #e0f2fe;
            background: rgba(255, 255, 255, 0.10);
            border-color: rgba(255, 255, 255, 0.14);
        }

        .landing-feature-card h3 {
            margin: 0;
            color: #172033;
            font-size: 1.18rem;
            line-height: 1.3;
        }

        .landing-feature-card.dark h3 {
            color: #f8fafc;
        }

        .landing-feature-card p {
            margin: 0;
            color: #64748b;
            font-size: 0.91rem;
            line-height: 1.72;
        }

        .landing-feature-card.dark p {
            color: rgba(241, 245, 249, 0.72);
        }

        .landing-feature-tags {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
            margin-top: auto;
        }

        .landing-feature-tags span,
        .landing-pop-tags span {
            border-radius: 999px;
            background: rgba(224, 242, 254, 0.78);
            border: 1px solid rgba(125, 211, 252, 0.32);
            color: #075985;
            font-size: 0.74rem;
            font-weight: 700;
            padding: 6px 11px;
        }

        .landing-explore-link {
            width: fit-content;
            margin-top: auto;
            color: #bae6fd;
            text-decoration: none;
            font-size: 0.78rem;
            letter-spacing: 0.13em;
            font-weight: 800;
            transition: color 0.2s ease, transform 0.2s ease;
        }

        .landing-explore-link:hover {
            color: #fef3c7;
            transform: translateX(2px);
        }

        .landing-feature-card.image-card {
            position: relative;
            min-height: 292px;
            padding: 0;
            background-image: url('/images/landingbg.png');
            background-size: cover;
            background-position: center;
        }

        .landing-feature-card.image-card::before {
            content: '';
            position: absolute;
            inset: 0;
            background:
                linear-gradient(180deg, rgba(15, 23, 42, 0.04) 0%, rgba(15, 23, 42, 0.34) 48%, rgba(15, 23, 42, 0.76) 100%),
                linear-gradient(135deg, rgba(3, 105, 161, 0.18), rgba(245, 158, 11, 0.12));
        }

        .landing-feature-card-overlay {
            position: absolute;
            inset: auto 0 0;
            padding: 26px;
            color: #f8fafc;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .landing-feature-card-overlay h3 {
            margin: 0;
            color: #fffaf0;
            font-size: 1.3rem;
            line-height: 1.25;
        }

        .landing-card-badge {
            width: fit-content;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.16);
            border: 1px solid rgba(255, 255, 255, 0.18);
            color: rgba(255, 255, 255, 0.78);
            font-size: 0.68rem;
            font-weight: 800;
            letter-spacing: 0.12em;
            padding: 6px 10px;
        }

        .landing-card-rating {
            color: #fde68a;
            font-size: 0.83rem;
            font-weight: 800;
        }

        /* Popular destinations */
        .landing-popular {
            padding: 72px 60px;
            background:
                radial-gradient(circle at top left, rgba(224, 242, 254, 0.78), transparent 32%),
                linear-gradient(180deg, #f1f7fb 0%, #f8fbff 100%);
        }

        .landing-popular-header {
            margin-bottom: 30px;
        }

        .landing-popular-header h2 {
            margin-bottom: 10px;
        }

        .landing-popular-grid {
            max-width: 1180px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 22px;
        }

        .landing-popular-card {
            display: flex;
            min-width: 0;
            flex-direction: column;
            overflow: hidden;
            border-radius: 28px;
            background: rgba(255, 255, 255, 0.88);
            border: 1px solid rgba(203, 213, 225, 0.70);
            box-shadow: 0 20px 58px rgba(15, 23, 42, 0.075);
            transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
        }

        .landing-popular-card:hover {
            transform: translateY(-3px);
            border-color: rgba(125, 211, 252, 0.52);
            box-shadow: 0 26px 72px rgba(15, 23, 42, 0.10);
        }

        .landing-popular-img {
            position: relative;
            height: 232px;
            display: flex;
            align-items: flex-start;
            justify-content: flex-end;
            flex-shrink: 0;
            padding: 14px;
            background-size: cover;
            background-position: center;
        }

        .landing-popular-img::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, rgba(15, 23, 42, 0.08), rgba(15, 23, 42, 0.22));
            pointer-events: none;
        }

        .landing-pop-match {
            position: relative;
            z-index: 1;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            width: fit-content;
            min-height: 30px;
            border-radius: 999px;
            padding: 6px 11px;
            color: #f8fafc;
            background: rgba(15, 23, 42, 0.42);
            border: 1px solid rgba(255, 255, 255, 0.20);
            font-size: 0.68rem;
            font-weight: 800;
            letter-spacing: 0.08em;
            backdrop-filter: blur(12px);
        }

        .landing-pop-match span {
            color: #bae6fd;
            font-size: 0.58rem;
        }

        .landing-popular-info {
            display: flex;
            flex: 1;
            flex-direction: column;
            padding: 20px;
        }

        .landing-popular-info h4 {
            margin: 0 0 5px;
            color: var(--landing-ink);
            font-size: 1.05rem;
            line-height: 1.35;
        }

        .landing-popular-info > p {
            margin: 0 0 14px;
            color: #64748b;
            font-size: 0.82rem;
            line-height: 1.45;
        }

        .landing-pop-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-bottom: 16px;
        }

        .landing-pop-tags span:last-child {
            background: rgba(255, 247, 237, 0.92);
            border-color: rgba(251, 191, 36, 0.32);
            color: #92400e;
        }

        .landing-pop-footer {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 12px;
            margin-top: auto;
            padding-top: 14px;
            border-top: 1px solid rgba(226, 232, 240, 0.82);
        }

        .landing-pop-footer-item {
            display: flex;
            flex-direction: column;
            gap: 4px;
            min-width: 0;
        }

        .landing-pop-footer-item.align-end {
            align-items: flex-end;
            text-align: right;
        }

        .landing-pop-footer-label {
            color: #94a3b8;
            font-size: 0.64rem;
            font-weight: 800;
            letter-spacing: 0.12em;
            text-transform: uppercase;
        }

        .landing-pop-footer-value {
            display: flex;
            align-items: center;
            gap: 4px;
            color: #172033;
            font-size: 0.88rem;
            font-weight: 800;
        }

        .landing-pop-footer-value.rating::before {
            content: '\2605';
            color: #f59e0b;
            font-size: 0.86rem;
        }

        /* CTA */
        .landing-cta-wrapper {
            display: flex;
            justify-content: center;
            padding: 54px 60px 72px;
            background: linear-gradient(180deg, #f8fbff 0%, #fff7ed 100%);
        }

        .landing-cta {
            position: relative;
            width: 100%;
            max-width: 920px;
            overflow: hidden;
            border-radius: 34px;
            padding: 58px 56px;
            text-align: center;
            color: #f8fafc;
            background:
                linear-gradient(135deg, rgba(12, 74, 110, 0.94) 0%, rgba(15, 118, 110, 0.88) 56%, rgba(30, 64, 175, 0.78) 100%),
                linear-gradient(135deg, rgba(254, 243, 199, 0.16), transparent);
            border: 1px solid rgba(255, 255, 255, 0.18);
            box-shadow: 0 28px 78px rgba(15, 23, 42, 0.14);
        }

        .landing-cta::before {
            content: '';
            position: absolute;
            inset: 0;
            background:
                radial-gradient(circle at 14% 16%, rgba(254, 243, 199, 0.22), transparent 26%),
                radial-gradient(circle at 82% 14%, rgba(186, 230, 253, 0.20), transparent 30%);
            pointer-events: none;
        }

        .landing-cta h2,
        .landing-cta p,
        .landing-cta-buttons {
            position: relative;
            z-index: 1;
        }

        .landing-cta h2 {
            margin: 0 0 14px;
            color: #fffaf0;
            font-size: clamp(2rem, 4vw, 3rem);
            font-weight: 700;
            line-height: 1.12;
        }

        .landing-cta p {
            max-width: 520px;
            margin: 0 auto 28px;
            color: rgba(248, 250, 252, 0.78);
            font-size: 0.97rem;
            line-height: 1.75;
        }

        .landing-cta-buttons {
            justify-content: center;
        }

        .landing-cta-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 50px;
            border-radius: 18px;
            padding: 14px 24px;
            text-decoration: none;
            font-size: 0.95rem;
            font-weight: 800;
            transition: transform 0.2s ease, box-shadow 0.2s ease, background 0.2s ease, border-color 0.2s ease;
        }

        .landing-cta-btn.primary {
            background: #f8fafc;
            border: 1px solid rgba(255, 255, 255, 0.72);
            color: #075985;
            box-shadow: 0 18px 42px rgba(15, 23, 42, 0.18);
        }

        .landing-cta-btn.secondary {
            color: #f8fafc;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.28);
            backdrop-filter: blur(12px);
        }

        .landing-cta-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 18px 42px rgba(15, 23, 42, 0.18);
        }

        /* Footer, scoped to landing only */
        .landing-page > footer {
            margin-top: 0;
            background: #111827;
            border-top: 1px solid rgba(148, 163, 184, 0.18);
        }

        .landing-page > footer > div {
            max-width: 1180px;
        }

        .landing-page > footer .bg-brand-600 {
            background: linear-gradient(135deg, #0284c7, #0f766e);
            border-radius: 14px;
        }

        .landing-page > footer a:hover {
            color: #7dd3fc;
        }

        @media (max-width: 1024px) {
            .landing-hero {
                min-height: 720px;
                padding: 76px 34px 82px;
                background-position: center;
            }

            .landing-features,
            .landing-popular {
                padding: 62px 34px;
            }

            .landing-features-header {
                align-items: flex-start;
                flex-direction: column;
                gap: 16px;
            }

            .landing-features-grid {
                grid-template-columns: 1fr 1fr;
            }

            .landing-feature-card.image-card {
                grid-column: span 2;
            }

            .landing-popular-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 768px) {
            .landing-page > header > div {
                padding-left: 18px;
                padding-right: 18px;
            }

            .landing-page > header > div > div {
                min-height: 64px;
            }

            .landing-page > header nav {
                gap: 12px;
            }

            .landing-hero {
                min-height: 620px;
                padding: 68px 22px 70px;
                background-image:
                    linear-gradient(180deg, rgba(248, 250, 252, 0.94) 0%, rgba(248, 250, 252, 0.82) 50%, rgba(248, 250, 252, 0.62) 100%),
                    linear-gradient(18deg, rgba(15, 23, 42, 0.10) 0%, rgba(14, 116, 144, 0.08) 42%, rgba(251, 191, 36, 0.10) 100%),
                    url('/images/landingbg.png');
            }

            .landing-hero-content {
                margin-left: 0;
            }

            .landing-hero-content h1 {
                font-size: clamp(2.35rem, 12vw, 3.45rem);
                margin-bottom: 24px;
            }

            .landing-hero-buttons,
            .landing-cta-buttons {
                align-items: stretch;
                flex-direction: column;
            }

            .landing-btn-primary,
            .landing-btn-secondary,
            .landing-cta-btn {
                width: 100%;
            }

            .landing-features,
            .landing-popular {
                padding: 54px 22px;
            }

            .landing-features-grid,
            .landing-popular-grid {
                grid-template-columns: 1fr;
            }

            .landing-feature-card.image-card {
                grid-column: auto;
            }

            .landing-popular-img {
                height: 218px;
            }

            .landing-cta-wrapper {
                padding: 46px 22px 58px;
            }

            .landing-cta {
                border-radius: 28px;
                padding: 42px 22px;
            }
        }

        @media (max-width: 520px) {
            .landing-page > header > div > div {
                gap: 12px;
            }

            .landing-page > header a[href*="login"] {
                padding: 9px 14px;
            }

            .landing-tag {
                font-size: 0.62rem;
                letter-spacing: 0.10em;
            }

            .landing-feature-card {
                min-height: 0;
                border-radius: 24px;
                padding: 24px;
            }

            .landing-feature-card.image-card {
                min-height: 270px;
            }

            .landing-popular-card {
                border-radius: 24px;
            }

            .landing-pop-footer {
                align-items: flex-start;
                flex-direction: column;
            }

            .landing-pop-footer-item.align-end {
                align-items: flex-start;
                text-align: left;
            }
        }
    </style>
</head>

<body class="landing-page">

    <x-user.navbar />

    @yield('content')

    <x-user.footer />

</body>

</html>
