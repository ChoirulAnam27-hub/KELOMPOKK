<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Futsal Booking Pro - Booking Futsal Lebih Mudah</title>
    <meta name="description" content="Booking lapangan futsal premium dengan mudah dan cepat. Pilih tempat, tentukan jadwal, dan mainkan pertandingan terbaikmu.">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800|outfit:500,600,700,800&display=swap" rel="stylesheet" />
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Inter', sans-serif; }
        h1, h2, h3, .font-heading { font-family: 'Outfit', sans-serif; }

        /* ===== ROOT VARIABLES ===== */
        :root {
            --dark-bg: #0a1628;
            --dark-card: #0f1d32;
            --dark-surface: #132238;
            --accent-green: #2d8f4e;
            --accent-green-light: #3ba55d;
            --text-primary: #ffffff;
            --text-secondary: #94a3b8;
            --text-muted: #64748b;
            --border-color: rgba(255,255,255,0.08);
            --glass-bg: rgba(15,29,50,0.75);
            --glass-blur: 16px;
        }

        /* ===== HERO SECTION ===== */
        .hero-section {
            position: relative;
            min-height: 100vh;
            overflow: hidden;
            background-color: var(--dark-bg);
        }
        .hero-bg {
            position: absolute;
            inset: 0;
            z-index: 0;
        }
        .hero-bg img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
        }
        .hero-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(
                135deg,
                rgba(10,22,40,0.92) 0%,
                rgba(10,22,40,0.75) 40%,
                rgba(10,22,40,0.45) 70%,
                rgba(10,22,40,0.3) 100%
            );
            z-index: 1;
        }
        .hero-overlay::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 200px;
            background: linear-gradient(to top, var(--dark-bg), transparent);
        }
        .hero-content {
            position: relative;
            z-index: 10;
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 24px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ===== NAVBAR ===== */
        .navbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px 0;
            width: 100%;
        }
        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            color: var(--text-primary);
        }
        .navbar-brand .logo-icon {
            width: 40px;
            height: 40px;
        }
        .navbar-brand .logo-icon svg {
            width: 100%;
            height: 100%;
        }
        .brand-text {
            font-family: 'Outfit', sans-serif;
            font-size: 1.1rem;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            line-height: 1.2;
        }
        .brand-sub {
            font-size: 0.6rem;
            font-weight: 500;
            letter-spacing: 2px;
            color: var(--text-secondary);
            text-transform: uppercase;
        }
        .navbar-links {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .nav-link {
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 8px 16px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 500;
            color: var(--text-secondary);
            transition: all 0.25s ease;
        }
        .nav-link:hover {
            color: var(--text-primary);
            background: rgba(255,255,255,0.06);
        }
        .nav-link svg {
            width: 16px;
            height: 16px;
        }
        .nav-link-cta {
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,255,255,0.15);
            color: var(--text-primary);
            font-weight: 600;
            border-radius: 20px;
            padding: 8px 20px;
        }
        .nav-link-cta:hover {
            background: rgba(255,255,255,0.15);
            border-color: rgba(255,255,255,0.25);
        }

        /* ===== HERO MAIN CONTENT ===== */
        .hero-main {
            flex: 1;
            display: flex;
            align-items: center;
            padding: 80px 0 140px;
        }
        .hero-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            align-items: center;
            width: 100%;
        }
        .hero-text h1 {
            font-family: 'Outfit', sans-serif;
            font-size: clamp(2.5rem, 5vw, 3.8rem);
            font-weight: 800;
            line-height: 1.1;
            color: var(--text-primary);
            margin-bottom: 16px;
        }
        .hero-text p {
            font-size: 1rem;
            color: var(--text-secondary);
            line-height: 1.7;
            margin-bottom: 28px;
            max-width: 440px;
        }
        .btn-outline {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 28px;
            border: 1.5px solid rgba(255,255,255,0.25);
            border-radius: 28px;
            color: var(--text-primary);
            font-size: 0.9rem;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.3s ease;
            background: rgba(255,255,255,0.04);
        }
        .btn-outline:hover {
            background: rgba(255,255,255,0.1);
            border-color: rgba(255,255,255,0.4);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.3);
        }

        /* ===== HERO CAROUSEL DOTS ===== */
        .hero-dots {
            display: flex;
            gap: 8px;
            margin-top: 32px;
        }
        .hero-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: rgba(255,255,255,0.2);
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .hero-dot.active {
            background: var(--text-primary);
            box-shadow: 0 0 10px rgba(255,255,255,0.4);
        }

        /* ===== GALLERY MOSAIC ===== */
        .gallery-mosaic {
            display: grid;
            grid-template-columns: 1fr 1fr;
            grid-template-rows: auto auto;
            gap: 10px;
        }
        .gallery-item {
            border-radius: 14px;
            overflow: hidden;
            position: relative;
            border: 1px solid rgba(255,255,255,0.08);
        }
        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: transform 0.6s ease;
        }
        .gallery-item:hover img {
            transform: scale(1.08);
        }
        .gallery-main {
            grid-column: 1 / -1;
            height: 220px;
        }
        .gallery-small {
            height: 130px;
        }

        /* ===== SEARCH BAR ===== */
        .search-bar-wrapper {
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            z-index: 20;
            width: 100%;
            max-width: 1000px;
            padding: 0 24px;
        }
        .search-bar {
            background: var(--dark-card);
            border: 1px solid var(--border-color);
            border-radius: 20px;
            padding: 20px;
            display: grid;
            grid-template-columns: 1fr 1fr 1fr auto;
            gap: 16px;
            align-items: end;
            box-shadow: 0 -10px 40px rgba(0,0,0,0.4);
            transform: translateY(50%);
        }
        .search-field label {
            display: block;
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--text-secondary);
            margin-bottom: 8px;
            letter-spacing: 0.5px;
        }
        .search-field .input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }
        .search-field input,
        .search-field select {
            width: 100%;
            padding: 12px 14px;
            padding-right: 36px;
            background: var(--dark-surface);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            color: var(--text-primary);
            font-size: 0.9rem;
            font-family: 'Inter', sans-serif;
            outline: none;
            transition: all 0.25s ease;
            appearance: none;
            -webkit-appearance: none;
        }
        .search-field input::placeholder,
        .search-field select::placeholder {
            color: var(--text-muted);
        }
        .search-field input:focus,
        .search-field select:focus {
            border-color: var(--accent-green);
            box-shadow: 0 0 0 3px rgba(45,143,78,0.15);
        }
        .input-icon {
            position: absolute;
            right: 12px;
            color: var(--text-muted);
            pointer-events: none;
        }
        .input-icon svg {
            width: 18px;
            height: 18px;
        }
        .btn-search {
            padding: 14px 40px;
            background: var(--accent-green);
            color: white;
            border: none;
            border-radius: 14px;
            font-size: 0.95rem;
            font-weight: 600;
            font-family: 'Inter', sans-serif;
            cursor: pointer;
            transition: all 0.3s ease;
            white-space: nowrap;
        }
        .btn-search:hover {
            background: var(--accent-green-light);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(45,143,78,0.3);
        }

        /* ===== COURTS SECTION ===== */
        .courts-section {
            padding: 100px 0 60px;
            background: var(--dark-bg);
        }
        .container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 24px;
        }
        .section-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 40px;
        }
        .section-accent {
            width: 4px;
            height: 32px;
            border-radius: 4px;
            background: linear-gradient(to bottom, var(--accent-green), #1a6b3a);
        }
        .section-header h2 {
            font-family: 'Outfit', sans-serif;
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--text-primary);
        }

        /* ===== COURT CARDS ===== */
        .courts-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
            gap: 24px;
        }
        .court-card {
            background: var(--dark-card);
            border: 1px solid var(--border-color);
            border-radius: 20px;
            overflow: hidden;
            transition: all 0.4s ease;
            display: flex;
            flex-direction: column;
        }
        .court-card:hover {
            transform: translateY(-6px);
            border-color: rgba(45,143,78,0.3);
            box-shadow: 0 20px 50px rgba(0,0,0,0.35);
        }
        .court-card-image {
            position: relative;
            height: 200px;
            overflow: hidden;
            background: var(--dark-surface);
        }
        .court-card-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s ease;
        }
        .court-card:hover .court-card-image img {
            transform: scale(1.1);
        }
        .court-card-image .no-image {
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: var(--text-muted);
            background: linear-gradient(135deg, var(--dark-surface), var(--dark-bg));
        }
        .court-card-image .no-image svg {
            width: 48px;
            height: 48px;
            margin-bottom: 8px;
            opacity: 0.4;
        }
        .court-card-image .no-image span {
            font-size: 0.75rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            opacity: 0.6;
        }
        .court-price-badge {
            position: absolute;
            top: 14px;
            right: 14px;
            background: rgba(10,22,40,0.85);
            backdrop-filter: blur(8px);
            padding: 6px 14px;
            border-radius: 20px;
            border: 1px solid rgba(255,255,255,0.1);
        }
        .court-price-badge .price {
            font-size: 0.85rem;
            font-weight: 700;
            color: var(--text-primary);
        }
        .court-price-badge .per-hour {
            font-size: 0.65rem;
            font-weight: 400;
            color: var(--text-secondary);
        }
        .court-card-body {
            padding: 24px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }
        .court-type-tag {
            display: inline-block;
            padding: 4px 12px;
            background: rgba(45,143,78,0.1);
            border: 1px solid rgba(45,143,78,0.2);
            border-radius: 6px;
            font-size: 0.7rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--accent-green-light);
            margin-bottom: 10px;
        }
        .court-card-body h3 {
            font-family: 'Outfit', sans-serif;
            font-size: 1.35rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 4px;
            transition: color 0.3s ease;
        }
        .court-card:hover .court-card-body h3 {
            color: var(--accent-green-light);
        }
        .btn-booking {
            display: block;
            width: 100%;
            padding: 14px;
            margin-top: auto;
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 14px;
            color: var(--text-primary);
            font-size: 0.9rem;
            font-weight: 600;
            font-family: 'Inter', sans-serif;
            text-align: center;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .btn-booking:hover {
            background: var(--accent-green);
            border-color: var(--accent-green);
            box-shadow: 0 4px 20px rgba(45,143,78,0.3);
        }

        /* ===== EMPTY STATE ===== */
        .empty-state {
            background: var(--dark-card);
            border: 1px solid var(--border-color);
            border-radius: 24px;
            padding: 60px 24px;
            text-align: center;
        }
        .empty-icon {
            width: 72px;
            height: 72px;
            background: var(--dark-surface);
            border: 1px solid var(--border-color);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
        }
        .empty-icon svg {
            width: 36px;
            height: 36px;
            color: var(--text-muted);
        }
        .empty-state h3 {
            font-family: 'Outfit', sans-serif;
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 8px;
        }
        .empty-state p {
            color: var(--text-secondary);
            font-size: 0.9rem;
        }

        /* ===== FOOTER ===== */
        .site-footer {
            background: var(--dark-bg);
            border-top: 1px solid var(--border-color);
            padding: 32px 0;
            text-align: center;
        }
        .site-footer p {
            color: var(--text-muted);
            font-size: 0.85rem;
        }

        /* ===== ANIMATIONS ===== */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeInRight {
            from { opacity: 0; transform: translateX(40px); }
            to { opacity: 1; transform: translateX(0); }
        }
        @keyframes fadeInScale {
            from { opacity: 0; transform: scale(0.92); }
            to { opacity: 1; transform: scale(1); }
        }
        .anim-fade-up {
            animation: fadeInUp 0.8s cubic-bezier(0.16,1,0.3,1) forwards;
        }
        .anim-fade-up-delay {
            animation: fadeInUp 0.8s cubic-bezier(0.16,1,0.3,1) 0.15s forwards;
            opacity: 0;
        }
        .anim-fade-right {
            animation: fadeInRight 0.9s cubic-bezier(0.16,1,0.3,1) 0.3s forwards;
            opacity: 0;
        }
        .anim-fade-scale {
            animation: fadeInScale 0.7s cubic-bezier(0.16,1,0.3,1) 0.5s forwards;
            opacity: 0;
        }

        /* ===== MOBILE MENU ===== */
        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            color: var(--text-primary);
            cursor: pointer;
            padding: 8px;
        }
        .mobile-menu-btn svg {
            width: 28px;
            height: 28px;
        }
        .mobile-nav {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(10,22,40,0.97);
            backdrop-filter: blur(20px);
            z-index: 100;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 16px;
        }
        .mobile-nav.open {
            display: flex;
        }
        .mobile-nav a {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--text-primary);
            text-decoration: none;
            padding: 12px 24px;
            transition: color 0.2s;
        }
        .mobile-nav a:hover {
            color: var(--accent-green-light);
        }
        .mobile-nav-close {
            position: absolute;
            top: 24px;
            right: 24px;
            background: none;
            border: none;
            color: var(--text-primary);
            cursor: pointer;
        }
        .mobile-nav-close svg {
            width: 28px;
            height: 28px;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 1024px) {
            .hero-grid {
                grid-template-columns: 1fr;
                gap: 40px;
            }
            .gallery-mosaic {
                max-width: 500px;
            }
        }
        @media (max-width: 768px) {
            .navbar-links {
                display: none;
            }
            .mobile-menu-btn {
                display: block;
            }
            .hero-main {
                padding: 100px 0 160px;
            }
            .hero-text h1 {
                font-size: 2.2rem;
            }
            .gallery-mosaic {
                display: none;
            }
            .search-bar {
                grid-template-columns: 1fr;
                gap: 12px;
                padding: 16px;
            }
            .courts-grid {
                grid-template-columns: 1fr;
            }
            .courts-section {
                padding: 80px 0 40px;
            }
        }
        @media (max-width: 480px) {
            .hero-text h1 {
                font-size: 1.8rem;
            }
            .search-bar-wrapper {
                padding: 0 12px;
            }
        }
    </style>
</head>
<body style="background-color: #0a1628; color: #ffffff; margin: 0;">

    <!-- ====== MOBILE NAV ====== -->
    <div class="mobile-nav" id="mobileNav">
        <button class="mobile-nav-close" onclick="document.getElementById('mobileNav').classList.remove('open')">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
        <a href="#courts">⚽ Jadwal</a>
        <a href="#courts">📍 Lokasi</a>
        @if (Route::has('login'))
            @auth
                <a href="{{ route('bookings.index') }}">📋 Riwayat Booking</a>
                <a href="{{ url('/dashboard') }}">🏠 Dashboard</a>
            @else
                <a href="{{ route('login') }}">Login</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}">Daftar</a>
                @endif
            @endauth
        @endif
    </div>

    <!-- ====== HERO SECTION ====== -->
    <section class="hero-section">
        <!-- Background Image -->
        <div class="hero-bg">
            <img src="{{ asset('images/hero-bg.png') }}" alt="Futsal Field" loading="eager">
        </div>
        <div class="hero-overlay"></div>

        <!-- Hero Content -->
        <div class="hero-content">
            <!-- Navbar -->
            <nav class="navbar">
                <a href="/" class="navbar-brand">
                    <div class="logo-icon">
                        <svg viewBox="0 0 48 48" fill="none">
                            <circle cx="24" cy="24" r="22" stroke="#3ba55d" stroke-width="2.5" fill="none"/>
                            <path d="M24 8 L30 18 L40 20 L32 28 L34 38 L24 33 L14 38 L16 28 L8 20 L18 18 Z" fill="#3ba55d" opacity="0.85"/>
                        </svg>
                    </div>
                    <div>
                        <div class="brand-text">FutsalPro</div>
                        <div class="brand-sub">Futsal Sport & Leisure</div>
                    </div>
                </a>

                <div class="navbar-links">
                    <a href="#courts" class="nav-link">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        Jadwal
                    </a>
                    <a href="#courts" class="nav-link">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        Lokasi
                    </a>
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ route('bookings.index') }}" class="nav-link">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                                Boking
                            </a>
                            <a href="{{ url('/dashboard') }}" class="nav-link nav-link-cta">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="nav-link">Login</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="nav-link nav-link-cta">Daftar</a>
                            @endif
                        @endauth
                    @endif
                </div>

                <button class="mobile-menu-btn" onclick="document.getElementById('mobileNav').classList.add('open')">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                </button>
            </nav>

            <!-- Hero Main -->
            <div class="hero-main">
                <div class="hero-grid">
                    <!-- Left: Text -->
                    <div class="hero-text anim-fade-up">
                        <h1>Boking Futsal Lebih Mudah</h1>
                        <p>Tempat futsal terbaik di kotamu. Booking online, pilih jadwal, dan mainkan pertandingan terbaikmu.</p>
                        <a href="#courts" class="btn-outline">
                            Info lebih banyak
                            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </a>
                        <div class="hero-dots">
                            <div class="hero-dot active"></div>
                            <div class="hero-dot"></div>
                            <div class="hero-dot"></div>
                            <div class="hero-dot"></div>
                        </div>
                    </div>

                    <!-- Right: Gallery Mosaic -->
                    <div class="gallery-mosaic anim-fade-right">
                        <div class="gallery-item gallery-main">
                            <img src="{{ asset('images/gallery-1.png') }}" alt="Lapangan Futsal" loading="lazy">
                        </div>
                        <div class="gallery-item gallery-small">
                            <img src="{{ asset('images/gallery-2.png') }}" alt="Lapangan Futsal" loading="lazy">
                        </div>
                        <div class="gallery-item gallery-small">
                            <img src="{{ asset('images/gallery-3.png') }}" alt="Lapangan Futsal" loading="lazy">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Search Bar -->
        <div class="search-bar-wrapper anim-fade-scale">
            <form class="search-bar" id="searchForm" onsubmit="handleSearch(event)">
                <div class="search-field">
                    <label>Main dimana?</label>
                    <div class="input-wrapper">
                        <select id="search-court" onchange="scrollToCourt(this.value)">
                            <option value="">Pilih lapangan...</option>
                            @foreach($courts as $court)
                                <option value="{{ $court->id }}">{{ $court->name }}</option>
                            @endforeach
                        </select>
                        <span class="input-icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </span>
                    </div>
                </div>
                <div class="search-field">
                    <label>Mulai Jam?</label>
                    <div class="input-wrapper">
                        <input type="time" id="search-start" placeholder="Mulai Jam?">
                        <span class="input-icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </span>
                    </div>
                </div>
                <div class="search-field">
                    <label>Selesai Jam?</label>
                    <div class="input-wrapper">
                        <input type="time" id="search-end" placeholder="Selesai Jam?">
                        <span class="input-icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </span>
                    </div>
                </div>
                <button type="submit" class="btn-search">Cari</button>
            </form>
        </div>
    </section>

    <!-- ====== COURTS SECTION ====== -->
    <section class="courts-section" id="courts">
        <div class="container">
            <div class="section-header">
                <span class="section-accent"></span>
                <h2>Daftar Lapangan</h2>
            </div>

            @if($courts->isEmpty())
                <div class="empty-state">
                    <div class="empty-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    </div>
                    <h3>Belum ada lapangan</h3>
                    <p>Silakan hubungi admin untuk menambahkan daftar lapangan futsal.</p>
                </div>
            @else
                <div class="courts-grid">
                    @foreach($courts as $court)
                        <div class="court-card" id="court-{{ $court->id }}">
                            <div class="court-card-image">
                                @if($court->photo)
                                    <img src="{{ Storage::url($court->photo) }}" alt="{{ $court->name }}">
                                @else
                                    <div class="no-image">
                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        <span>No Image</span>
                                    </div>
                                @endif
                                <div class="court-price-badge">
                                    <span class="price">Rp {{ number_format($court->price_per_hour, 0, ',', '.') }}</span>
                                    <span class="per-hour">/jam</span>
                                </div>
                            </div>
                            <div class="court-card-body">
                                <span class="court-type-tag">{{ $court->floor_type }}</span>
                                <h3>{{ $court->name }}</h3>
                                @if($court->location)
                                    <div style="margin-top: 8px; display: flex; align-items: flex-start; gap: 6px; color: var(--text-secondary); font-size: 0.85rem;">
                                        <svg style="width: 16px; height: 16px; flex-shrink: 0; margin-top: 2px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                        <span>{{ $court->location }}</span>
                                    </div>
                                @endif
                                <div style="margin-top: 20px;">
                                    <a href="{{ route('bookings.create', $court->id) }}" class="btn-booking">
                                        Booking Sekarang
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    <!-- ====== FOOTER ====== -->
    <footer class="site-footer">
        <p>&copy; {{ date('Y') }} Futsal Booking Pro. All rights reserved.</p>
    </footer>

    <script>
        // Search form handler – scrolls to the selected court or to courts section
        function handleSearch(e) {
            e.preventDefault();
            const courtId = document.getElementById('search-court').value;
            if (courtId) {
                const courtEl = document.getElementById('court-' + courtId);
                if (courtEl) {
                    courtEl.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    courtEl.style.transition = 'box-shadow 0.3s';
                    courtEl.style.boxShadow = '0 0 0 3px rgba(59,165,93,0.5), 0 20px 50px rgba(0,0,0,0.35)';
                    setTimeout(() => {
                        courtEl.style.boxShadow = '';
                    }, 2000);
                }
            } else {
                document.getElementById('courts').scrollIntoView({ behavior: 'smooth' });
            }
        }

        function scrollToCourt(courtId) {
            // Optional: auto-scroll on select change
        }

        // Carousel dots interaction (visual only)
        document.querySelectorAll('.hero-dot').forEach((dot, idx) => {
            dot.addEventListener('click', () => {
                document.querySelectorAll('.hero-dot').forEach(d => d.classList.remove('active'));
                dot.classList.add('active');
            });
        });

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            });
        });
    </script>
</body>
</html>
