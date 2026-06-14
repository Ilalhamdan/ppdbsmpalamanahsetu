<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMP AL-AMANAH PPDB - Official Portal</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Fonts (Inter) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    @vite(['resources/css/app.css'])

    <!-- Embed Fallback CSS in case Vite server isn't running -->
    <style>
        :root {
            --teal-primary: #0d9488;
            --teal-dark: #0f766e;
            --teal-light: #ccfbf1;
            --teal-extra-light: #f0fdfa;
            --amber-accent: #fef08a;
            --amber-accent-hover: #fde68a;
            --amber-text: #b45309;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
            color: #1e293b;
        }

        .text-teal-primary {
            color: var(--teal-primary) !important;
        }

        .bg-teal-primary {
            background-color: var(--teal-primary) !important;
        }

        .bg-teal-light {
            background-color: var(--teal-light) !important;
        }

        .bg-teal-extra-light {
            background-color: var(--teal-extra-light) !important;
        }

        .border-teal-primary {
            border-color: var(--teal-primary) !important;
        }

        .btn-teal {
            background-color: var(--teal-primary) !important;
            color: white !important;
            border: 1px solid var(--teal-primary) !important;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
        }

        .btn-teal:hover {
            background-color: var(--teal-dark) !important;
            border-color: var(--teal-dark) !important;
            color: white !important;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(13, 148, 136, 0.2);
        }

        .btn-outline-teal {
            color: var(--teal-primary) !important;
            border: 1.5px solid var(--teal-primary) !important;
            background-color: transparent !important;
            transition: all 0.3s ease !important;
        }

        .btn-outline-teal:hover {
            background-color: var(--teal-primary) !important;
            color: white !important;
        }

        .text-teal-hover {
            transition: color 0.2s ease-in-out;
        }

        .text-teal-hover:hover {
            color: var(--teal-primary) !important;
        }

        .hero-section {
            background: linear-gradient(135deg, #0d9488 0%, #0f766e 100%);
            position: relative;
            overflow: hidden;
        }

        /* Abstract glowing circles for hero background */
        .hero-section::before {
            content: '';
            position: absolute;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.08) 0%, transparent 70%);
            top: -100px;
            right: -100px;
            border-radius: 50%;
        }

        .hero-section::after {
            content: '';
            position: absolute;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.05) 0%, transparent 75%);
            bottom: -50px;
            left: -50px;
            border-radius: 50%;
        }

        .card-hover {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 30px -5px rgba(0, 0, 0, 0.08), 0 8px 16px -6px rgba(0, 0, 0, 0.08) !important;
        }

        .carousel-item-clickable {
            transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1) !important;
            cursor: pointer;
            text-decoration: none !important;
            display: block;
        }

        .carousel-item-clickable:hover {
            transform: scale(1.03) translateY(-2px);
            filter: brightness(1.08);
        }

        .carousel-control-prev:hover,
        .carousel-control-next:hover {
            background: rgba(255, 255, 255, 0.3) !important;
            border-color: rgba(255, 255, 255, 0.45) !important;
            transform: translateY(-50%) scale(1.1) !important;
        }

        .timeline-step {
            position: relative;
        }

        .timeline-step::after {
            content: '';
            position: absolute;
            top: 24px;
            left: 50%;
            width: 100%;
            height: 2px;
            background-color: var(--teal-light);
            z-index: 1;
        }

        .timeline-step:last-child::after {
            display: none;
        }

        @media (max-width: 767.98px) {
            .timeline-step::after {
                display: none;
            }
        }

        /* Mobile Menu Enhancements */
        .hover-text-teal:hover {
            color: var(--teal-primary) !important;
            padding-left: 4px;
            transition: all 0.2s ease;
        }
        
        .transition-transform {
            transition: transform 0.3s ease;
        }
        
        [aria-expanded="true"] .transition-transform {
            transform: rotate(180deg);
        }

        /* Fix Bootstrap & Tailwind .collapse conflict */
        .collapse.show {
            visibility: visible !important;
        }
    </style>
</head>

<body class="d-flex flex-column min-h-screen">

    <!-- HEADER / NAVBAR -->
    <header class="bg-white border-bottom shadow-sm sticky-top" style="z-index: 1030;">
        <div class="container-fluid px-4 px-md-5 d-flex align-items-center justify-content-between"
            style="padding-top: 1.1rem; padding-bottom: 1.1rem;">

            <!-- School Brand with Premium Islamic Emblem -->
            <a href="{{ url('/') }}" class="d-flex align-items-center gap-2 gap-md-3 text-decoration-none">
                <div class="d-flex align-items-center justify-content-center"
                    style="width: 48px; height: 48px; min-width: 48px;">
                    <img src="{{ asset('logo.png') }}" alt="Logo SMP Al-Amanah"
                        style="width: 48px; height: 48px; object-fit: contain;">
                </div>
                <div class="d-flex flex-column justify-content-center">
                    <h1 class="mb-0 fw-extrabold text-dark tracking-wide text-truncate"
                        style="font-size: 16px; letter-spacing: 0.6px; line-height: 1.2; max-width: 220px;">SMP AL-AMANAH</h1>
                    <p class="text-teal-primary mb-0 fw-semibold d-none d-sm-block" style="font-size: 10px; letter-spacing: 1px;">SEKOLAH BERPRESTASI, BERAKHLAK MULIA</p>
                    <p class="text-teal-primary mb-0 fw-semibold d-block d-sm-none" style="font-size: 10px; letter-spacing: 1px;">BERPRESTASI & BERAKHLAK</p>
                </div>
            </a>

            <!-- Mobile Hamburger Button -->
            <button class="btn d-md-none border-0 bg-transparent p-0" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#mobileMenu" aria-controls="mobileMenu" aria-label="Toggle navigation" style="box-shadow: none;">
                <i class="bi bi-list fs-1 text-teal-primary"></i>
            </button>

            <!-- Navigation Menu (Desktop) -->
            <ul class="nav d-none d-md-flex align-items-center gap-4 fw-semibold"
                style="font-size: 14.5px; letter-spacing: 0.1px;">
                <li class="nav-item">
                    <a href="{{ url('/') }}"
                        class="nav-link p-0 {{ Request::is('/') ? 'text-teal-primary border-bottom border-2 border-teal-primary pb-1' : 'text-secondary text-teal-hover' }}">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a href="#"
                        class="nav-link p-0 {{ Request::is('profil*') ? 'text-teal-primary border-bottom border-2 border-teal-primary pb-1' : 'text-secondary text-teal-hover' }} dropdown-toggle"
                        id="navbarDropdownProfil" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Profil
                    </a>
                    <ul class="dropdown-menu border-0 shadow-sm mt-2.5 rounded-3"
                        aria-labelledby="navbarDropdownProfil">
                        <li><a class="dropdown-item px-3.5 py-2 text-secondary"
                                href="{{ url('/profil/sejarah') }}">Sejarah</a></li>
                        <li><a class="dropdown-item px-3.5 py-2 text-secondary"
                                href="{{ url('/profil/visi-misi') }}">Visi Misi</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/berita') }}"
                        class="nav-link p-0 {{ Request::is('berita') ? 'text-teal-primary border-bottom border-2 border-teal-primary pb-1' : 'text-secondary text-teal-hover' }}">Berita</a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/galeri') }}"
                        class="nav-link p-0 {{ Request::is('galeri') ? 'text-teal-primary border-bottom border-2 border-teal-primary pb-1' : 'text-secondary text-teal-hover' }}">Galeri</a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/kontak') }}"
                        class="nav-link p-0 {{ Request::is('kontak') ? 'text-teal-primary border-bottom border-2 border-teal-primary pb-1' : 'text-secondary text-teal-hover' }}">Kontak</a>
                </li>
                <li class="nav-item dropdown">
                    <a href="#"
                        class="nav-link p-0 {{ Request::is('ppdb*') ? 'text-teal-primary border-bottom border-2 border-teal-primary pb-1' : 'text-secondary text-teal-hover' }} dropdown-toggle"
                        id="navbarDropdownPPDB" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        PPDB
                    </a>
                    <ul class="dropdown-menu border-0 shadow-sm mt-2.5 rounded-3" aria-labelledby="navbarDropdownPPDB">
                        <li><a class="dropdown-item px-3.5 py-2 text-secondary"
                                href="{{ url('/ppdb/gelombang') }}">Informasi Gelombang</a></li>
                        <li><a class="dropdown-item px-3.5 py-2 text-secondary" href="{{ url('/ppdb/jalur') }}">Jalur
                                Pendaftaran</a></li>
                        <li><a class="dropdown-item px-3.5 py-2 text-secondary" href="{{ url('/ppdb/syarat') }}">Syarat
                                &amp; Perlengkapan</a></li>
                    </ul>
                </li>
            </ul>

            <!-- Call to Actions (Desktop) -->
            <div class="d-none d-md-flex align-items-center gap-3">
                <a href="{{ route('login') }}" class="btn btn-outline-teal rounded-pill fw-semibold"
                    style="padding: 0.55rem 1.45rem; font-size: 13.5px; letter-spacing: 0.1px; border: 1.5px solid var(--teal-primary); color: var(--teal-primary);">
                    Masuk Akun
                </a>
                <a href="{{ route('register') }}" class="btn btn-teal rounded-pill fw-semibold shadow-sm"
                    style="padding: 0.55rem 1.45rem; font-size: 13.5px; letter-spacing: 0.1px;">
                    Registrasi
                </a>
            </div>
        </div>
    </header>

    <!-- Offcanvas Mobile Menu (Modern App-like) -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="mobileMenu" aria-labelledby="mobileMenuLabel" style="width: 280px; border-radius: 24px 0 0 24px; border-left: none; box-shadow: -10px 0 40px rgba(0,0,0,0.1);">
        <div class="offcanvas-header border-bottom border-opacity-10 py-4 px-4">
            <h6 class="offcanvas-title fw-extrabold text-teal-primary text-uppercase tracking-wider mb-0" id="mobileMenuLabel" style="font-size: 13px; letter-spacing: 1px;">Menu Navigasi</h6>
            <button type="button" class="btn-close shadow-none bg-light rounded-circle p-2 m-0" data-bs-dismiss="offcanvas" aria-label="Close" style="width: 32px; height: 32px;"></button>
        </div>
        <div class="offcanvas-body d-flex flex-column px-3 py-4">
            <!-- Mobile Nav Links -->
            <ul class="nav flex-column fw-semibold mb-4 w-100" style="font-size: 14.5px;">
                <li class="nav-item mb-1">
                    <a href="{{ url('/') }}" class="nav-link px-3 py-2.5 rounded-3 d-flex align-items-center gap-3 text-dark {{ Request::is('/') ? 'bg-teal-extra-light text-teal-primary fw-bold' : '' }}">
                        <i class="bi bi-house-door {{ Request::is('/') ? 'text-teal-primary' : 'text-secondary' }} fs-5"></i> Home
                    </a>
                </li>
                <li class="nav-item mb-1">
                    <a class="nav-link px-3 py-2.5 rounded-3 text-dark d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href="#collapseProfilMobile" role="button" aria-expanded="false" aria-controls="collapseProfilMobile">
                        <span class="d-flex align-items-center gap-3"><i class="bi bi-building text-secondary fs-5"></i> Profil</span>
                        <i class="bi bi-chevron-down small text-secondary transition-transform"></i>
                    </a>
                    <div class="collapse" id="collapseProfilMobile">
                        <ul class="list-unstyled ms-5 mt-1 mb-2 d-flex flex-column gap-1">
                            <li><a href="{{ url('/profil/sejarah') }}" class="text-decoration-none text-secondary small d-block py-1.5 hover-text-teal">Sejarah Sekolah</a></li>
                            <li><a href="{{ url('/profil/visi-misi') }}" class="text-decoration-none text-secondary small d-block py-1.5 hover-text-teal">Visi &amp; Misi</a></li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item mb-1">
                    <a href="{{ url('/berita') }}" class="nav-link px-3 py-2.5 rounded-3 d-flex align-items-center gap-3 text-dark {{ Request::is('berita') ? 'bg-teal-extra-light text-teal-primary fw-bold' : '' }}">
                        <i class="bi bi-newspaper {{ Request::is('berita') ? 'text-teal-primary' : 'text-secondary' }} fs-5"></i> Berita
                    </a>
                </li>
                <li class="nav-item mb-1">
                    <a href="{{ url('/galeri') }}" class="nav-link px-3 py-2.5 rounded-3 d-flex align-items-center gap-3 text-dark {{ Request::is('galeri') ? 'bg-teal-extra-light text-teal-primary fw-bold' : '' }}">
                        <i class="bi bi-images {{ Request::is('galeri') ? 'text-teal-primary' : 'text-secondary' }} fs-5"></i> Galeri
                    </a>
                </li>
                <li class="nav-item mb-1">
                    <a href="{{ url('/kontak') }}" class="nav-link px-3 py-2.5 rounded-3 d-flex align-items-center gap-3 text-dark {{ Request::is('kontak') ? 'bg-teal-extra-light text-teal-primary fw-bold' : '' }}">
                        <i class="bi bi-telephone {{ Request::is('kontak') ? 'text-teal-primary' : 'text-secondary' }} fs-5"></i> Kontak
                    </a>
                </li>
                <li class="nav-item mb-1">
                    <a class="nav-link px-3 py-2.5 rounded-3 text-dark d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href="#collapsePPDBMobile" role="button" aria-expanded="false" aria-controls="collapsePPDBMobile">
                        <span class="d-flex align-items-center gap-3"><i class="bi bi-mortarboard text-secondary fs-5"></i> PPDB</span>
                        <i class="bi bi-chevron-down small text-secondary transition-transform"></i>
                    </a>
                    <div class="collapse" id="collapsePPDBMobile">
                        <ul class="list-unstyled ms-5 mt-1 mb-2 d-flex flex-column gap-1">
                            <li><a href="{{ url('/ppdb/gelombang') }}" class="text-decoration-none text-secondary small d-block py-1.5 hover-text-teal">Info Gelombang</a></li>
                            <li><a href="{{ url('/ppdb/jalur') }}" class="text-decoration-none text-secondary small d-block py-1.5 hover-text-teal">Jalur Pendaftaran</a></li>
                            <li><a href="{{ url('/ppdb/syarat') }}" class="text-decoration-none text-secondary small d-block py-1.5 hover-text-teal">Syarat Dokumen</a></li>
                        </ul>
                    </div>
                </li>
            </ul>

            <!-- Mobile CTA -->
            <div class="mt-auto pt-3 border-top border-opacity-10 d-flex flex-column gap-2.5">
                <a href="{{ route('login') }}" class="btn btn-outline-teal rounded-pill fw-semibold py-2 d-flex justify-content-center align-items-center gap-2">
                    <i class="bi bi-box-arrow-in-right"></i> Masuk Akun
                </a>
                <a href="{{ route('register') }}" class="btn btn-teal rounded-pill fw-semibold py-2 d-flex justify-content-center align-items-center gap-2 shadow-sm">
                    <i class="bi bi-person-plus"></i> Registrasi
                </a>
            </div>
        </div>
    </div>

    <main class="flex-grow-1">

        <!-- HERO SECTION -->
        <section class="hero-section py-5 text-white d-flex align-items-center" style="min-height: 520px; background-color: #0d9488;">
            <div class="container-fluid px-4 px-md-5 relative" style="z-index: 10;">
                <div class="row align-items-center g-5">
                    <div class="col-lg-7 text-start">
                        <span
                            class="badge bg-warning text-dark px-3.5 py-2 rounded-pill fw-bold mb-3 shadow-sm text-uppercase tracking-wider"
                            style="font-size: 11px;">
                            <i class="bi bi-stars me-1"></i> {{ $sys_settings['pengumuman_header'] ?? 'PPDB Online TA 2026/2027 Telah Dibuka' }}
                        </span>
                        <h2 class="display-5 fw-extrabold mb-3 text-white tracking-tight lh-sm"
                            style="text-shadow: 0 2px 4px rgba(0,0,0,0.15);">
                            Membentuk Generasi Unggul,<br>
                            <span class="text-warning">Cerdas &amp; Berakhlak Qur'ani</span>
                        </h2>
                        <p class="fs-6 text-white-50 fw-light mb-4.5 lh-relaxed" style="max-width: 660px;">
                            Selamat Datang di Portal Penerimaan Peserta Didik Baru (PPDB) Online SMP Al-Amanah.
                            Daftarkan putra-putri terbaik Anda secara online, praktis, transparan, dan pantau progres
                            pendaftaran langsung dari dashboard Anda.
                        </p>
                        <div class="d-flex flex-wrap gap-3 pt-2">
                            @auth
                                <a href="{{ url('/dashboard') }}"
                                    class="btn btn-warning text-dark fw-bold px-4 py-2.5 rounded-pill shadow d-inline-flex align-items-center gap-2 hover-up">
                                    <span>Buka Dashboard Siswa</span>
                                    <i class="bi bi-speedometer2"></i>
                                </a>
                            @else
                                <a href="{{ route('register') }}"
                                    class="btn btn-warning text-dark fw-bold px-4 py-2.5 rounded-pill shadow d-inline-flex align-items-center gap-2 hover-up">
                                    <span>Daftar Calon Siswa</span>
                                    <i class="bi bi-person-plus-fill"></i>
                                </a>
                                <a href="{{ url('/ppdb/gelombang') }}"
                                    class="btn btn-outline-light fw-semibold px-4 py-2.5 rounded-pill d-inline-flex align-items-center gap-2 border-2">
                                    <span>Lihat Jadwal &amp; Biaya</span>
                                    <i class="bi bi-info-circle"></i>
                                </a>
                            @endauth
                        </div>
                    </div>

                    <!-- Carousel Slider on the side (Dynamic from DB) -->
                    <div class="col-lg-5 d-none d-lg-flex justify-content-center text-center">
                        @if(isset($sliders) && $sliders->count() > 0)
                            <div id="heroInfoCarousel"
                                class="carousel slide position-relative p-4 rounded-5 bg-white bg-opacity-10 backdrop-blur border border-white border-opacity-15 shadow-lg"
                                style="width: 360px; height: 360px;">

                                <!-- Carousel Indicators -->
                                <div class="carousel-indicators mb-0" style="bottom: 15px;">
                                    @foreach($sliders as $i => $slider)
                                        <button type="button" data-bs-target="#heroInfoCarousel" data-bs-slide-to="{{ $i }}" {!! $i === 0 ? 'class="active" aria-current="true"' : '' !!}
                                            aria-label="Slide {{ $i + 1 }}"
                                            style="width: 8px; height: 8px; border-radius: 50%;"></button>
                                    @endforeach
                                </div>

                                <div class="carousel-inner w-100 h-100">
                                    @foreach($sliders as $i => $slider)
                                        <div class="carousel-item {{ $i === 0 ? 'active' : '' }} w-100 h-100">
                                            <a href="javascript:void(0)"
                                                data-lightbox-src="{{ asset($slider->gambar) }}"
                                                class="w-100 h-100 d-block text-decoration-none carousel-lightbox-trigger">
                                                <div
                                                    class="d-flex flex-column align-items-center justify-content-center p-3 h-100">
                                                    <div class="rounded-5 d-flex flex-column align-items-center justify-content-center w-100 h-100 overflow-hidden position-relative"
                                                        style="border-radius: 24px !important; background: #0d9488;">
                                                        <img src="{{ asset($slider->gambar) }}" alt="{{ $slider->judul }}"
                                                            style="width:100%;height:100%;object-fit:cover;border-radius:24px;">
                                                        <!-- Overlay label -->
                                                        <div class="position-absolute bottom-0 start-0 end-0 p-3"
                                                            style="background: linear-gradient(transparent, rgba(0,0,0,0.6)); border-radius: 0 0 24px 24px;">
                                                            <h4 class="h6 fw-bold text-white mb-1 text-start">
                                                                {{ $slider->judul }}</h4>
                                                            @if($slider->deskripsi)
                                                                <p class="text-white-50 mb-0 text-start"
                                                                    style="font-size:11px;line-height:1.4;">
                                                                    {{ Str::limit($slider->deskripsi, 70) }}</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>

                                <!-- Carousel Controls (Prev/Next Arrows) -->
                                @if($sliders->count() > 1)
                                    <button class="carousel-control-prev" type="button" data-bs-target="#heroInfoCarousel"
                                        data-bs-slide="prev"
                                        style="width: 38px; height: 38px; background: rgba(255,255,255,0.15); border-radius: 50%; top: 50%; transform: translateY(-50%); left: -19px; border: 1.5px solid rgba(255,255,255,0.25); backdrop-filter: blur(5px); transition: all 0.3s ease;">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"
                                            style="width: 14px; height: 14px; filter: drop-shadow(0 1px 2px rgba(0,0,0,0.15));"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#heroInfoCarousel"
                                        data-bs-slide="next"
                                        style="width: 38px; height: 38px; background: rgba(255,255,255,0.15); border-radius: 50%; top: 50%; transform: translateY(-50%); right: -19px; border: 1.5px solid rgba(255,255,255,0.25); backdrop-filter: blur(5px); transition: all 0.3s ease;">
                                        <span class="carousel-control-next-icon" aria-hidden="true"
                                            style="width: 14px; height: 14px; filter: drop-shadow(0 1px 2px rgba(0,0,0,0.15));"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
        <!-- STATS SECTION (OVERLAPPING HERO) -->
        <section class="position-relative pb-5" style="z-index: 20; margin-top: -45px;">
            <div class="container-fluid px-4 px-md-5">
                <div class="bg-white rounded-4 shadow-lg border p-4">
                    <div class="row g-4 text-center">
                        <div class="col-6 col-md-3 border-end-md">
                            <div class="p-2">
                                <span class="d-block display-6 fw-bold text-teal-primary mb-1">3</span>
                                <span class="text-muted fw-medium small text-uppercase tracking-wider">Jalur
                                    Seleksi</span>
                            </div>
                        </div>
                        <div class="col-6 col-md-3 border-end-md">
                            <div class="p-2">
                                <span class="d-block display-6 fw-bold text-teal-primary mb-1">Aktif</span>
                                <span class="text-muted fw-medium small text-uppercase tracking-wider">{{ $sys_settings['gelombang_aktif'] ?? 'Gelombang 1' }}</span>
                            </div>
                        </div>
                        <div class="col-6 col-md-3 border-end-md">
                            <div class="p-2">
                                <span class="d-block display-6 fw-bold text-teal-primary mb-1">100%</span>
                                <span class="text-muted fw-medium small text-uppercase tracking-wider">Proses
                                    Online</span>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="p-2">
                                <span class="d-block display-6 fw-bold text-warning mb-1">{{ $sys_settings['kuota_kursi'] ?? 'Terbatas' }}</span>
                                <span class="text-muted fw-medium small text-uppercase tracking-wider">Kuota
                                    Kursi</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ALUR PENDAFTARAN -->
        <section class="py-5 bg-white">
            <div class="container-fluid px-4 px-md-5">
                <div class="text-center mb-5">
                    <span class="badge bg-teal-light text-teal-primary px-3 py-2 rounded-pill fw-semibold mb-2">Panduan
                        PPDB</span>
                    <h3 class="fw-bold text-dark mb-2">5 Langkah Alur Pendaftaran</h3>
                    <div class="bg-teal-primary rounded mx-auto" style="width: 50px; height: 4px;"></div>
                </div>

                <div
                    class="d-flex flex-column flex-lg-row align-items-stretch justify-content-center gap-2 text-center">

                    <!-- Step 1 -->
                    <div class="flex-fill bg-light p-4 rounded-4 border-0 card-hover d-flex flex-column align-items-center justify-content-start shadow-sm"
                        style="min-width: 200px;">
                        <div class="bg-teal-primary text-white rounded-circle d-flex align-items-center justify-content-center mb-3 shadow-sm"
                            style="width: 50px; height: 50px; min-width: 50px;">
                            <i class="bi bi-person-plus fs-4"></i>
                        </div>
                        <h5 class="fw-bold text-dark h6 mb-2">1. Daftar Akun</h5>
                        <p class="text-muted small mb-0 lh-base">Buat akun calon siswa dengan email/nomor WA aktif.</p>
                    </div>

                    <!-- Arrow 1 -->
                    <div
                        class="d-flex align-items-center justify-content-center text-teal-primary py-1 py-lg-0 opacity-75">
                        <i class="bi bi-arrow-right fs-4 d-none d-lg-block"></i>
                        <i class="bi bi-arrow-down fs-4 d-lg-none"></i>
                    </div>

                    <!-- Step 2 -->
                    <div class="flex-fill bg-light p-4 rounded-4 border-0 card-hover d-flex flex-column align-items-center justify-content-start shadow-sm"
                        style="min-width: 200px;">
                        <div class="bg-teal-primary text-white rounded-circle d-flex align-items-center justify-content-center mb-3 shadow-sm"
                            style="width: 50px; height: 50px; min-width: 50px;">
                            <i class="bi bi-file-earmark-text fs-4"></i>
                        </div>
                        <h5 class="fw-bold text-dark h6 mb-2">2. Isi Formulir</h5>
                        <p class="text-muted small mb-0 lh-base">Lengkapi formulir biodata diri, berkas &amp; nilai
                            rapor.</p>
                    </div>

                    <!-- Arrow 2 -->
                    <div
                        class="d-flex align-items-center justify-content-center text-teal-primary py-1 py-lg-0 opacity-75">
                        <i class="bi bi-arrow-right fs-4 d-none d-lg-block"></i>
                        <i class="bi bi-arrow-down fs-4 d-lg-none"></i>
                    </div>

                    <!-- Step 3 -->
                    <div class="flex-fill bg-light p-4 rounded-4 border-0 card-hover d-flex flex-column align-items-center justify-content-start shadow-sm"
                        style="min-width: 200px;">
                        <div class="bg-teal-primary text-white rounded-circle d-flex align-items-center justify-content-center mb-3 shadow-sm"
                            style="width: 50px; height: 50px; min-width: 50px;">
                            <i class="bi bi-shield-check fs-4"></i>
                        </div>
                        <h5 class="fw-bold text-dark h6 mb-2">3. Verifikasi</h5>
                        <p class="text-muted small mb-0 lh-base">Panitia PPDB memeriksa kelengkapan berkas fisik &amp;
                            digital.</p>
                    </div>

                    <!-- Arrow 3 -->
                    <div
                        class="d-flex align-items-center justify-content-center text-teal-primary py-1 py-lg-0 opacity-75">
                        <i class="bi bi-arrow-right fs-4 d-none d-lg-block"></i>
                        <i class="bi bi-arrow-down fs-4 d-lg-none"></i>
                    </div>

                    <!-- Step 4 -->
                    <div class="flex-fill bg-light p-4 rounded-4 border-0 card-hover d-flex flex-column align-items-center justify-content-start shadow-sm"
                        style="min-width: 200px;">
                        <div class="bg-teal-primary text-white rounded-circle d-flex align-items-center justify-content-center mb-3 shadow-sm"
                            style="width: 50px; height: 50px; min-width: 50px;">
                            <i class="bi bi-journal-check fs-4"></i>
                        </div>
                        <h5 class="fw-bold text-dark h6 mb-2">4. Tes Seleksi</h5>
                        <p class="text-muted small mb-0 lh-base">Ikuti ujian tulis akademik secara online/offline &amp;
                            mengaji.</p>
                    </div>

                    <!-- Arrow 4 -->
                    <div
                        class="d-flex align-items-center justify-content-center text-teal-primary py-1 py-lg-0 opacity-75">
                        <i class="bi bi-arrow-right fs-4 d-none d-lg-block"></i>
                        <i class="bi bi-arrow-down fs-4 d-lg-none"></i>
                    </div>

                    <!-- Step 5 -->
                    <div class="flex-fill bg-light p-4 rounded-4 border-0 card-hover d-flex flex-column align-items-center justify-content-start shadow-sm"
                        style="min-width: 200px;">
                        <div class="bg-teal-primary text-white rounded-circle d-flex align-items-center justify-content-center mb-3 shadow-sm"
                            style="width: 50px; height: 50px; min-width: 50px;">
                            <i class="bi bi-trophy fs-4"></i>
                        </div>
                        <h5 class="fw-bold text-dark h6 mb-2">5. Kelulusan</h5>
                        <p class="text-muted small mb-0 lh-base">Pantau pengumuman hasil secara instan lewat dashboard.
                        </p>
                    </div>

                </div>
            </div>
        </section>

        <!-- JALUR SELEKSI -->
        <section class="py-5 bg-light">
            <div class="container-fluid px-4 px-md-5">
                <div class="text-center mb-5">
                    <span class="badge bg-teal-light text-teal-primary px-3 py-2 rounded-pill fw-semibold mb-2">Kategori
                        Masuk</span>
                    <h3 class="fw-bold text-dark mb-2">Pilihan Jalur Pendaftaran</h3>
                    <div class="bg-teal-primary rounded mx-auto" style="width: 50px; height: 4px;"></div>
                </div>

                <div class="row g-4">
                    <div class="col-lg-4">
                        <div class="card border-0 shadow-sm rounded-4 p-4 h-100 bg-white text-center card-hover">
                            <div class="bg-teal-light text-teal-primary rounded-circle mx-auto d-flex align-items-center justify-content-center mb-3.5"
                                style="width: 65px; height: 65px;">
                                <i class="bi bi-mortarboard-fill fs-3"></i>
                            </div>
                            <h4 class="fw-bold text-dark h5 mb-2.5">Jalur Reguler</h4>
                            <p class="text-secondary small mb-0">Jalur umum menggunakan rata-rata nilai rapor Sekolah
                                Dasar/MI, ditunjang tes pemetaan kompetensi akademik dasar.</p>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div
                            class="card border-0 shadow-sm rounded-4 p-4 h-100 bg-white text-center card-hover border-top border-4 border-teal-primary">
                            <div class="bg-teal-primary text-white rounded-circle mx-auto d-flex align-items-center justify-content-center mb-3.5 shadow"
                                style="width: 65px; height: 65px;">
                                <i class="bi bi-trophy-fill fs-3"></i>
                            </div>
                            <h4 class="fw-bold text-dark h5 mb-2.5">Jalur Prestasi</h4>
                            <p class="text-secondary small mb-0">Apresiasi khusus bebas tes tulis bagi siswa SD yang
                                memiliki piagam/sertifikat kejuaraan akademik atau non-akademik minimal tingkat
                                Kota/Kabupaten.</p>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="card border-0 shadow-sm rounded-4 p-4 h-100 bg-white text-center card-hover">
                            <div class="bg-teal-light text-teal-primary rounded-circle mx-auto d-flex align-items-center justify-content-center mb-3.5"
                                style="width: 65px; height: 65px;">
                                <i class="bi bi-book-fill fs-3"></i>
                            </div>
                            <h4 class="fw-bold text-dark h5 mb-2.5">Jalur Tahfidz</h4>
                            <p class="text-secondary small mb-0">Beasiswa khusus pembebasan biaya/SPP bulanan bagi para
                                penghafal Al-Qur'an (minimal hafal juz 30 &amp; juz lainnya) lewat uji kelayakan
                                sima'an.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <!-- FOOTER SECTION -->
    <footer class="text-white py-5" style="background-color: #0d5d56; border-top: 4px solid var(--amber-accent);">
        <div class="container-fluid px-4 px-md-5">
            <div class="row g-4 justify-content-between">

                <div class="col-md-5 mb-4 mb-md-0">
                    <div class="d-flex align-items-center gap-2 mb-3.5">
                        <div class="rounded-circle bg-white d-flex align-items-center justify-content-center border border-2 border-warning"
                            style="width: 42px; height: 42px; min-width: 42px;">
                            <img src="{{ asset('logo.png') }}" alt="Logo SMP Al-Amanah"
                                style="width: 28px; height: 28px; object-fit: contain;">
                        </div>
                        <h4 class="mb-0 fw-bold text-white h5 tracking-wide">SMP AL-AMANAH</h4>
                    </div>
                    <p class="small text-white-50 lh-relaxed mb-4 text-start">
                        {{ $sys_settings['deskripsi_sekolah'] ?? 'Lembaga pendidikan menengah yang berdedikasi tinggi mewujudkan siswa berprestasi akademis gemilang yang bertumpu pada pondasi akhlakul karimah dan wawasan global terintegrasi.' }}
                    </p>
                    <div class="d-flex justify-content-start gap-2">
                        <a href="{{ $sys_settings['sosmed_facebook'] ?? 'https://www.facebook.com/smpalamanahsetu' }}" target="_blank"
                            class="btn btn-sm btn-outline-light rounded-circle hover-scale"><i
                                class="bi bi-facebook"></i></a>
                        <a href="{{ $sys_settings['sosmed_instagram'] ?? 'https://www.instagram.com/smpalamanahsetu' }}" target="_blank"
                            class="btn btn-sm btn-outline-light rounded-circle hover-scale"><i
                                class="bi bi-instagram"></i></a>
                        <a href="{{ $sys_settings['sosmed_youtube'] ?? 'https://www.youtube.com/@smpalamanahsetu' }}" target="_blank"
                            class="btn btn-sm btn-outline-light rounded-circle hover-scale"><i
                                class="bi bi-youtube"></i></a>
                        <a href="{{ $sys_settings['sosmed_tiktok'] ?? 'https://www.tiktok.com/@smpalamanahsetu' }}" target="_blank"
                            class="btn btn-sm btn-outline-light rounded-circle hover-scale"><i
                                class="bi bi-tiktok"></i></a>
                    </div>
                </div>

                <div class="col-md-3 mb-4 mb-md-0">
                    <h5 class="fw-bold mb-3 border-bottom border-white border-opacity-10 pb-2 text-warning">Tautan Cepat
                    </h5>
                    <ul class="list-unstyled d-flex flex-column gap-2 small">
                        <li><a href="{{ url('/') }}"
                                class="text-white-50 text-decoration-none text-white-hover">Home</a></li>
                        <li><a href="{{ url('/profil') }}"
                                class="text-white-50 text-decoration-none text-white-hover">Profil Sekolah</a></li>
                        <li><a href="{{ url('/ppdb') }}"
                                class="text-white-50 text-decoration-none text-white-hover">Informasi PPDB</a></li>
                        <li><a href="{{ url('/berita') }}"
                                class="text-white-50 text-decoration-none text-white-hover">Berita Sekolah</a></li>
                        <li><a href="{{ url('/kontak') }}"
                                class="text-white-50 text-decoration-none text-white-hover">Kontak Kami</a></li>
                    </ul>
                </div>

                <div class="col-md-4 mb-4 mb-md-0">
                    <h5 class="fw-bold mb-3 border-bottom border-white border-opacity-10 pb-2 text-warning">Hubungi
                        Sekolah</h5>
                    <ul class="list-unstyled d-flex flex-column gap-3 small text-white-50">
                        <li class="d-flex align-items-start gap-2.5">
                            <i class="bi bi-geo-alt-fill text-warning mt-0.5"></i>
                            <span>{{ $sys_settings['kontak_alamat'] ?? 'Jl. Raya Al-Amanah No. 45, Al Bantani, Indonesia' }}</span>
                        </li>
                        <li class="d-flex align-items-center gap-2.5">
                            <i class="bi bi-envelope-fill text-warning"></i>
                            <span>{{ $sys_settings['kontak_email'] ?? 'info@smp-alamanah.sch.id' }}</span>
                        </li>
                        <li class="d-flex align-items-center gap-2.5">
                            <i class="bi bi-telephone-fill text-warning"></i>
                            <span>{{ $sys_settings['kontak_telepon'] ?? '0813-8993-0005' }}</span>
                        </li>
                    </ul>
                </div>

            </div>

            <div class="border-top border-white border-opacity-10 mt-5 pt-4 text-center text-white-50 small">
                <p class="mb-0">&copy; {{ $sys_settings['tahun_sekarang'] ?? '2026' }} {{ $sys_settings['nama_sekolah'] ?? 'SMP Al-Amanah' }}. All Rights Reserved. Crafted for PPDB Online Portal.</p>
            </div>
        </div>
    </footer>

    <!-- Lightbox Modal for Carousel Slider -->
    <div id="imageLightboxModal" class="lightbox-modal" onclick="closeImageModal(event)">
        <div class="lightbox-content" onclick="event.stopPropagation()">
            <button class="lightbox-close-btn" onclick="closeImageModal(event)">
                <i class="bi bi-x-lg"></i>
            </button>
            <img id="lightboxImage" src="" alt="Lightbox View">
        </div>
    </div>

    <style>
        .lightbox-modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.65);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            z-index: 9999;
            display: none;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .lightbox-modal.show {
            display: flex;
            opacity: 1;
        }

        .lightbox-content {
            background: #ffffff;
            padding: 16px;
            border-radius: 28px;
            position: relative;
            max-width: 90%;
            max-height: 85vh;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.4);
            transform: scale(0.9);
            transition: transform 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .lightbox-modal.show .lightbox-content {
            transform: scale(1);
        }

        .lightbox-content img {
            max-width: 100%;
            max-height: 75vh;
            object-fit: contain;
            border-radius: 20px;
            display: block;
        }

        .lightbox-close-btn {
            position: absolute;
            top: -16px;
            right: -16px;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: #ffffff;
            border: none;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 10010;
            font-size: 16px;
            color: #1e293b;
            transition: transform 0.2s ease, background-color 0.2s ease;
        }

        .lightbox-close-btn:hover {
            transform: scale(1.1);
            background: #f1f5f9;
        }
    </style>

    <script>
        function openImageModal(imgSrc) {
            const modal = document.getElementById('imageLightboxModal');
            const img = document.getElementById('lightboxImage');
            img.src = imgSrc;
            modal.style.display = 'flex';
            // Trigger reflow for transition
            modal.offsetHeight;
            modal.classList.add('show');
            document.body.style.overflow = 'hidden';
        }

        function closeImageModal(event) {
            if (event) {
                event.preventDefault();
                event.stopPropagation();
            }
            const modal = document.getElementById('imageLightboxModal');
            modal.classList.remove('show');
            setTimeout(() => {
                modal.style.display = 'none';
                document.getElementById('lightboxImage').src = '';
                document.body.style.overflow = '';
            }, 300);
        }

        // Initialize carousel and add drag/swipe support
        document.addEventListener("DOMContentLoaded", function () {
            const carouselEl = document.getElementById('heroInfoCarousel');
            if (carouselEl) {
                // Initialize Bootstrap Carousel explicitly
                const carousel = new bootstrap.Carousel(carouselEl, {
                    interval: 4000,
                    ride: 'carousel',
                    wrap: true
                });

                let startX = 0;
                let startY = 0;
                let isDragging = false;
                let wasDragged = false;

                // Touch support
                carouselEl.addEventListener('touchstart', (e) => {
                    startX = e.touches[0].clientX;
                    startY = e.touches[0].clientY;
                    isDragging = true;
                    wasDragged = false;
                }, { passive: true });

                carouselEl.addEventListener('touchmove', (e) => {
                    if (!isDragging) return;
                    const diffX = Math.abs(e.touches[0].clientX - startX);
                    const diffY = Math.abs(e.touches[0].clientY - startY);
                    if (diffX > 10 || diffY > 10) {
                        wasDragged = true;
                    }
                }, { passive: true });

                carouselEl.addEventListener('touchend', (e) => {
                    if (!isDragging) return;
                    const endX = e.changedTouches[0].clientX;
                    const diffX = startX - endX;
                    if (wasDragged && Math.abs(diffX) > 50) {
                        if (diffX > 0) {
                            carousel.next();
                        } else {
                            carousel.prev();
                        }
                    }
                    isDragging = false;
                }, { passive: true });

                // Mouse/Desktop Drag Support
                carouselEl.addEventListener('mousedown', (e) => {
                    if (e.target.closest('.carousel-control-prev') ||
                        e.target.closest('.carousel-control-next') ||
                        e.target.closest('.carousel-indicators')) {
                        return;
                    }
                    startX = e.clientX;
                    startY = e.clientY;
                    isDragging = true;
                    wasDragged = false;
                    carouselEl.style.cursor = 'grabbing';
                });

                carouselEl.addEventListener('mousemove', (e) => {
                    if (!isDragging) return;
                    const diffX = Math.abs(e.clientX - startX);
                    const diffY = Math.abs(e.clientY - startY);
                    if (diffX > 10 || diffY > 10) {
                        wasDragged = true;
                    }
                });

                window.addEventListener('mouseup', (e) => {
                    if (!isDragging) return;
                    carouselEl.style.cursor = 'grab';
                    isDragging = false;

                    const endX = e.clientX;
                    const diffX = startX - endX;
                    if (wasDragged && Math.abs(diffX) > 50) {
                        if (diffX > 0) {
                            carousel.next();
                        } else {
                            carousel.prev();
                        }
                    }
                });

                // Set initial grab cursor
                carouselEl.style.cursor = 'grab';

                // Intercept clicks on links inside the carousel if the user dragged
                carouselEl.addEventListener('click', (e) => {
                    const trigger = e.target.closest('.carousel-lightbox-trigger');
                    if (trigger) {
                        if (wasDragged) {
                            e.preventDefault();
                            e.stopPropagation();
                            wasDragged = false; // Reset the flag
                            return;
                        }
                        const imgSrc = trigger.getAttribute('data-lightbox-src');
                        if (imgSrc) {
                            openImageModal(imgSrc);
                        }
                    }
                });
            }
        });
    </script>

    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>