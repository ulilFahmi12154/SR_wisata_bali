<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background: #f5f7fa;
        }

        .container {
            width: 90%;
            margin: auto;
        }

        .flex {
            display: flex;
        }

        .between {
            justify-content: space-between;
            align-items: center;
        }

        .card {
            background: white;
            border-radius: 16px;
            padding: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        }

        .btn-primary {
            background: linear-gradient(90deg, #0b5ed7, #0a58ca);
            color: white;
            padding: 15px;
            border: none;
            border-radius: 30px;
            width: 100%;
            font-weight: bold;
            cursor: pointer;
        }

        .hero-title {
            font-size: 42px;
            font-weight: bold;
        }

        .blue {
            color: #0b5ed7;
        }

        .grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            margin-top: 40px;
        }

        .chip {
            padding: 8px 16px;
            border-radius: 20px;
            background: #eee;
            cursor: pointer;
        }

        .chip.active {
            background: #1f7a4c;
            color: white;
        }

        footer {
            margin-top: 80px;
        }

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

        .footer-link.external {
            display: inline-flex;
            align-items: center;
            gap: 6px;
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

        .footer-logo:focus-visible,
        .footer-link:focus-visible {
            outline: 3px solid rgba(11, 94, 215, 0.25);
            outline-offset: 2px;
            border-radius: 8px;
        }

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
            /* atau 50%, 60% sesuai keinginan */
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
            /* color: #0a58ca;
            font-size: 1.42rem;
            font-weight: 700;
            letter-spacing: 0.2px;
            text-decoration: none;
            white-space: nowrap; */
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

            .footer-column {
                min-width: 100%;
            }
        }
    </style>
</head>

<body>

    @include('partials.header')

    <div class="container">
        @yield('content')
    </div>

    @include('partials.footer')

</body>

</html>
