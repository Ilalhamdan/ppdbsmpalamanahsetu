<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil - SMP AL-AMANAH</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Fonts (Inter) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
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

        /* Custom spacing helpers to ensure they render perfectly without relying on tailwind compilation */
        .p-3.5 { padding: 1.25rem !important; }
        .p-4.5 { padding: 2rem !important; }
        .p-5 { padding: 2.75rem !important; }
        .p-5.5 { padding: 3.5rem !important; }
        
        @media (min-width: 768px) {
            .p-md-5.5 { padding: 3.5rem !important; }
        }

        .mb-3.5 { margin-bottom: 1.25rem !important; }
        .mb-4.5 { margin-bottom: 2rem !important; }
        .my-4.5 { margin-top: 2rem !important; margin-bottom: 2rem !important; }

        .text-teal-primary { color: var(--teal-primary) !important; }
        .bg-teal-primary { background-color: var(--teal-primary) !important; }
        .bg-teal-light { background-color: var(--teal-light) !important; }
        .bg-teal-extra-light { background-color: var(--teal-extra-light) !important; }
        .border-teal-primary { border-color: var(--teal-primary) !important; }

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
            border: 1px solid var(--teal-primary) !important;
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

        .card-hover {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.05) !important;
        }
    </style>
</head>
<body class="d-flex flex-column">

    <!-- HEADER / NAVBAR -->
    <header class="bg-white border-bottom shadow-sm sticky-top" style="z-index: 1030;">
        <div class="container-fluid px-4 px-md-5 d-flex align-items-center justify-content-between" style="padding-top: 1.1rem; padding-bottom: 1.1rem;">
            
            <!-- School Brand with Premium Islamic Emblem -->
            <div class="d-flex align-items-center gap-3">
                <div class="d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; min-width: 48px;">
                    <img src="{{ asset('logo.png') }}" alt="Logo SMP Al-Amanah" style="width: 48px; height: 48px; object-fit: contain;">
                </div>
                <div>
                    <h1 class="mb-0 fw-extrabold text-dark tracking-wide" style="font-size: 16px; letter-spacing: 0.6px;">SMP AL-AMANAH</h1>
                    <p class="text-teal-primary mb-0 fw-semibold" style="font-size: 10px; letter-spacing: 1px;">SEKOLAH BERPRESTASI, BERAKHLAK MULIA</p>
                </div>
            </div>

            <!-- Navigation Menu -->
            <ul class="nav d-none d-md-flex align-items-center gap-4 fw-semibold" style="font-size: 14.5px; letter-spacing: 0.1px;">
                <li class="nav-item">
                    <a href="{{ url('/') }}" class="nav-link p-0 {{ Request::is('/') ? 'text-teal-primary border-bottom border-2 border-teal-primary pb-1' : 'text-secondary text-teal-hover' }}">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link p-0 {{ Request::is('profil*') ? 'text-teal-primary border-bottom border-2 border-teal-primary pb-1' : 'text-secondary text-teal-hover' }} dropdown-toggle" id="navbarDropdownProfil" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Profil
                    </a>
                    <ul class="dropdown-menu border-0 shadow-sm mt-2.5 rounded-3" aria-labelledby="navbarDropdownProfil">
                        <li><a class="dropdown-item px-3.5 py-2 text-secondary" href="{{ url('/profil/sejarah') }}">Sejarah</a></li>
                        <li><a class="dropdown-item px-3.5 py-2 text-secondary" href="{{ url('/profil/visi-misi') }}">Visi Misi</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/berita') }}" class="nav-link p-0 {{ Request::is('berita') ? 'text-teal-primary border-bottom border-2 border-teal-primary pb-1' : 'text-secondary text-teal-hover' }}">Berita</a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/galeri') }}" class="nav-link p-0 {{ Request::is('galeri') ? 'text-teal-primary border-bottom border-2 border-teal-primary pb-1' : 'text-secondary text-teal-hover' }}">Galeri</a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/kontak') }}" class="nav-link p-0 {{ Request::is('kontak') ? 'text-teal-primary border-bottom border-2 border-teal-primary pb-1' : 'text-secondary text-teal-hover' }}">Kontak</a>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link p-0 {{ Request::is('ppdb*') ? 'text-teal-primary border-bottom border-2 border-teal-primary pb-1' : 'text-secondary text-teal-hover' }} dropdown-toggle" id="navbarDropdownPPDB" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        PPDB
                    </a>
                    <ul class="dropdown-menu border-0 shadow-sm mt-2.5 rounded-3" aria-labelledby="navbarDropdownPPDB">
                        <li><a class="dropdown-item px-3.5 py-2 text-secondary" href="{{ url('/ppdb/gelombang') }}">Informasi Gelombang</a></li>
                        <li><a class="dropdown-item px-3.5 py-2 text-secondary" href="{{ url('/ppdb/jalur') }}">Jalur Pendaftaran</a></li>
                        <li><a class="dropdown-item px-3.5 py-2 text-secondary" href="{{ url('/ppdb/syarat') }}">Syarat &amp; Perlengkapan</a></li>
                    </ul>
                </li>
            </ul>

            <!-- Call to Actions -->
            <div class="d-none d-md-flex align-items-center gap-3">
                <a href="{{ route('login') }}" class="btn btn-outline-teal rounded-pill fw-semibold" style="padding: 0.55rem 1.45rem; font-size: 13.5px; letter-spacing: 0.1px; border: 1.5px solid var(--teal-primary); color: var(--teal-primary);">
                    Masuk Akun
                </a>
                <a href="{{ route('register') }}" class="btn btn-teal rounded-pill fw-semibold shadow-sm" style="padding: 0.55rem 1.45rem; font-size: 13.5px; letter-spacing: 0.1px;">
                    Registrasi
                </a>
            </div>
        </div>
    </header>

    <main class="container-fluid px-4 px-md-5 py-4">
        <div class="row justify-content-center">
            <div class="col-lg-10">

                {{-- TAB: SEJARAH --}}
                @if(!isset($tab) || $tab == 'sejarah')
                <div class="card border-0 shadow-sm p-4 p-md-4 rounded-4 bg-white">
                    <div class="mb-4">
                        <span class="badge bg-teal-light text-teal-primary px-3 py-2 rounded-pill fw-semibold mb-2">Profil Sekolah</span>
                        <h2 class="fw-bold text-dark mb-2 fs-2">Sejarah SMP Al-Amanah</h2>
                        <div class="bg-teal-primary rounded" style="width: 60px; height: 4px;"></div>
                    </div>
                    <p class="text-secondary mb-3 fs-5" style="line-height: 1.8; letter-spacing: 0.15px;">SMP Al-Amanah didirikan dengan misi luhur untuk menyediakan akses pendidikan menengah berkualitas yang mengintegrasikan kecerdasan intelektual dengan keluhuran akhlak. Berawal dari keterbatasan fasilitas, sekolah ini terus tumbuh berkat dedikasi para pendidik dan kepercayaan penuh dari masyarakat.</p>
                    <p class="text-secondary mb-3 fs-5" style="line-height: 1.8; letter-spacing: 0.15px;">Seiring berjalannya waktu, SMP Al-Amanah terus bertransformasi dengan menerapkan adaptasi kurikulum berbasis teknologi modern tanpa menanggalkan identitas karakter budi pekerti yang Islami, kokoh, dan berintegritas.</p>
                    <div class="card border-0 shadow-sm bg-teal-extra-light p-4 rounded-4">
                        <h5 class="fw-bold text-teal-primary mb-2" style="letter-spacing: 0.2px;">Perkembangan Digital</h5>
                        <p class="text-secondary mb-0 text-muted fs-6" style="line-height: 1.8;">Kini, kami mengadopsi penuh sistem administrasi dan pembelajaran berbasis awan, termasuk portal pendaftaran PPDB Online mandiri untuk memudahkan calon siswa baru.</p>
                    </div>
                </div>
                @endif

                {{-- TAB: VISI & MISI --}}
                @if(isset($tab) && $tab == 'visi-misi')
                <div class="card border-0 shadow-sm p-4 p-md-4 rounded-4 bg-white">
                    <div class="mb-4">
                        <span class="badge bg-teal-light text-teal-primary px-3 py-2 rounded-pill fw-semibold mb-2">Pedoman Sekolah</span>
                        <h2 class="fw-bold text-dark mb-2 fs-2">Visi &amp; Misi SMP Al-Amanah</h2>
                        <div class="bg-teal-primary rounded" style="width: 60px; height: 4px;"></div>
                    </div>
                    <div class="row g-4">
                        <div class="col-md-12 col-lg-6">
                            <div class="card border-0 shadow-sm p-4 rounded-4 bg-white border-start border-5 border-teal-primary h-100" style="background-color: var(--teal-extra-light) !important;">
                                <h4 class="h6 fw-extrabold text-teal-primary text-uppercase tracking-wider mb-3"><i class="bi bi-bullseye me-1"></i> VISI</h4>
                                <p class="text-dark fw-extrabold fs-4 mb-0" style="line-height: 1.6; letter-spacing: 0.2px;">"Menjadi lembaga yang seimbang antara IPTEK dan IMTAQ"</p>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-6">
                            <div class="card border-0 shadow-sm p-4 rounded-4 bg-white border h-100">
                                <h4 class="h6 fw-extrabold text-dark text-uppercase tracking-wider border-bottom pb-3 mb-3"><i class="bi bi-rocket-takeoff me-1"></i> MISI</h4>
                                <ol class="text-secondary ps-3 mb-0" style="line-height: 1.8; font-size: 15.5px; letter-spacing: 0.15px;">
                                    <li class="mb-3 fw-semibold text-dark">Membekali siswa dengan Ilmu Pengetahuan, Ketakwaan dan Berakhlakul Karimah.</li>
                                    <li class="mb-0 fw-semibold text-dark">Menyiapkan siswa yang memiliki keunggulan dalam Akademik maupun Non Akademik.</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                {{-- TAB: FASILITAS SEKOLAH --}}
                @if(isset($tab) && $tab == 'fasilitas')
                <div class="card border-0 shadow-sm p-4 p-md-4 rounded-4 bg-white">
                    <div class="mb-4">
                        <span class="badge bg-teal-light text-teal-primary px-3 py-2 rounded-pill fw-semibold mb-2">Sarana Prasarana</span>
                        <h2 class="fw-bold text-dark mb-2 fs-2">Fasilitas yang Tersedia</h2>
                        <div class="bg-teal-primary rounded" style="width: 60px; height: 4px;"></div>
                    </div>
                    <p class="text-secondary mb-3 fs-5" style="line-height: 1.8; letter-spacing: 0.15px;">SMP Al-Amanah berkomitmen memberikan lingkungan belajar yang kondusif, lengkap, dan modern guna mendukung perkembangan akademik dan keagamaan siswa:</p>
                    <div class="row g-4">
                        <div class="col-md-6 col-lg-4">
                            <div class="p-4 rounded-4 bg-light h-100 border-start border-5 border-teal-primary card-hover shadow-sm" style="transition: all 0.25s;">
                                <div class="fs-2 mb-3 text-teal-primary"><i class="bi bi-building"></i></div>
                                <h5 class="fw-extrabold text-dark mb-2" style="font-size: 16px; letter-spacing: 0.2px;">Gedung Sendiri</h5>
                                <p class="text-secondary mb-0 fs-6" style="line-height: 1.7; font-weight: 500;">Gedung milik sendiri yang kokoh terdiri dari 2 &amp; 4 lantai.</p>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="p-4 rounded-4 bg-light h-100 border-start border-5 border-teal-primary card-hover shadow-sm" style="transition: all 0.25s;">
                                <div class="fs-2 mb-3 text-teal-primary"><i class="bi bi-geo-alt-fill"></i></div>
                                <h5 class="fw-extrabold text-dark mb-2" style="font-size: 16px; letter-spacing: 0.2px;">Lokasi Strategis</h5>
                                <p class="text-secondary mb-0 fs-6" style="line-height: 1.7; font-weight: 500;">Terletak di tempat strategis yang aman dan tenang untuk KBM.</p>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="p-4 rounded-4 bg-light h-100 border-start border-5 border-teal-primary card-hover shadow-sm" style="transition: all 0.25s;">
                                <div class="fs-2 mb-3 text-teal-primary"><i class="bi bi-bus-front-fill"></i></div>
                                <h5 class="fw-extrabold text-dark mb-2" style="font-size: 16px; letter-spacing: 0.2px;">Akses Transportasi</h5>
                                <p class="text-secondary mb-0 fs-6" style="line-height: 1.7; font-weight: 500;">Sangat mudah dijangkau dari berbagai wilayah sekitar.</p>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="p-4 rounded-4 bg-light h-100 border-start border-5 border-teal-primary card-hover shadow-sm" style="transition: all 0.25s;">
                                <div class="fs-2 mb-3 text-teal-primary"><i class="bi bi-flask"></i></div>
                                <h5 class="fw-extrabold text-dark mb-2" style="font-size: 16px; letter-spacing: 0.2px;">Alat Praktikum Lengkap</h5>
                                <p class="text-secondary mb-0 fs-6" style="line-height: 1.7; font-weight: 500;">Laboratorium yang ditunjang media belajar interaktif digital.</p>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="p-4 rounded-4 bg-light h-100 border-start border-5 border-teal-primary card-hover shadow-sm" style="transition: all 0.25s;">
                                <div class="fs-2 mb-3 text-teal-primary"><i class="bi bi-dribbble"></i></div>
                                <h5 class="fw-extrabold text-dark mb-2" style="font-size: 16px; letter-spacing: 0.2px;">Sarana Olahraga</h5>
                                <p class="text-secondary mb-0 fs-6" style="line-height: 1.7; font-weight: 500;">Fasilitas lapangan olahraga lengkap (Basket, Voli, Futsal, dll.).</p>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="p-4 rounded-4 bg-light h-100 border-start border-5 border-teal-primary card-hover shadow-sm" style="transition: all 0.25s;">
                                <div class="fs-2 mb-3 text-teal-primary"><i class="bi bi-mortarboard-fill"></i></div>
                                <h5 class="fw-extrabold text-dark mb-2" style="font-size: 16px; letter-spacing: 0.2px;">Program Beasiswa</h5>
                                <p class="text-secondary mb-0 fs-6" style="line-height: 1.7; font-weight: 500;">Beasiswa khusus bagi siswa berprestasi &amp; subsidi silang.</p>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="p-4 rounded-4 bg-light h-100 border-start border-5 border-teal-primary card-hover shadow-sm" style="transition: all 0.25s;">
                                <div class="fs-2 mb-3 text-teal-primary"><i class="bi bi-person-workspace"></i></div>
                                <h5 class="fw-extrabold text-dark mb-2" style="font-size: 16px; letter-spacing: 0.2px;">Guru Tersertifikasi</h5>
                                <p class="text-secondary mb-0 fs-6" style="line-height: 1.7; font-weight: 500;">Dibina oleh dewan guru yang profesional, tersertifikasi &amp; berpengalaman.</p>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="p-4 rounded-4 bg-light h-100 border-start border-5 border-teal-primary card-hover shadow-sm" style="transition: all 0.25s;">
                                <div class="fs-2 mb-3 text-teal-primary"><i class="bi bi-moon-stars-fill"></i></div>
                                <h5 class="fw-extrabold text-dark mb-2" style="font-size: 16px; letter-spacing: 0.2px;">Boarding School</h5>
                                <p class="text-secondary mb-0 fs-6" style="line-height: 1.7; font-weight: 500;">Menyediakan asrama pondok pesantren modern bagi para santri.</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                {{-- TAB: EKSTRAKURIKULER & KBM --}}
                @if(isset($tab) && $tab == 'ekstrakurikuler')
                <div class="card border-0 shadow-sm p-4 p-md-4 rounded-4 bg-white">
                    <div class="mb-4">
                        <span class="badge bg-teal-light text-teal-primary px-3 py-2 rounded-pill fw-semibold mb-2">Program Sekolah</span>
                        <h2 class="fw-bold text-dark mb-2 fs-2">Kegiatan Belajar &amp; Ekstrakurikuler</h2>
                        <div class="bg-teal-primary rounded" style="width: 60px; height: 4px;"></div>
                    </div>
                    <!-- KBM Section -->
                    <div class="p-4 rounded-4 bg-teal-extra-light mb-4 border border-teal-primary border-opacity-15 shadow-sm">
                        <h5 class="fw-extrabold text-teal-primary mb-3 d-flex align-items-center gap-2">
                            <i class="bi bi-clock-fill"></i>
                            <span>Kegiatan Belajar Mengajar (KBM)</span>
                        </h5>
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <div class="bg-white p-3 rounded-4 shadow-sm border border-light text-center">
                                    <span class="text-muted small d-block mb-1 fw-semibold">Hari Belajar</span>
                                    <strong class="text-teal-dark fs-5">5 Hari Kerja (Senin - Jum'at)</strong>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="bg-white p-3 rounded-4 shadow-sm border border-light text-center">
                                    <span class="text-muted small d-block mb-1 fw-semibold">Waktu KBM</span>
                                    <strong class="text-teal-dark fs-5">07.00 - 14.30 WIB</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Ekstrakurikuler Grid -->
                    <h5 class="fw-bold text-dark mb-2 fs-5">Program Ekstrakurikuler</h5>
                    <p class="text-secondary small mb-3 fs-6">Kami menyediakan berbagai macam kegiatan non-akademik (ekstrakurikuler) terarah untuk menyalurkan dan mengasah minat bakat siswa:</p>
                    <div class="row g-4">
                        <div class="col-md-4">
                            <div class="card h-100 border border-light rounded-4 shadow-sm p-4 bg-white card-hover" style="transition: all 0.25s;">
                                <div class="text-teal-primary fs-3 mb-3"><i class="bi bi-award-fill"></i> <strong class="fs-5 text-dark d-block mt-2 fw-extrabold">Olahraga &amp; Bela Diri</strong></div>
                                <ul class="list-unstyled text-secondary d-flex flex-column gap-2 mb-0 fs-6 fw-medium">
                                    <li class="d-flex align-items-center gap-2"><i class="bi bi-check-circle-fill text-teal-primary"></i> Futsal</li>
                                    <li class="d-flex align-items-center gap-2"><i class="bi bi-check-circle-fill text-teal-primary"></i> Karate</li>
                                    <li class="d-flex align-items-center gap-2"><i class="bi bi-check-circle-fill text-teal-primary"></i> Taekwondo</li>
                                    <li class="d-flex align-items-center gap-2"><i class="bi bi-check-circle-fill text-teal-primary"></i> Pencak Silat</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card h-100 border border-light rounded-4 shadow-sm p-4 bg-white card-hover" style="transition: all 0.25s;">
                                <div class="text-teal-primary fs-3 mb-3"><i class="bi bi-music-note-beamed"></i> <strong class="fs-5 text-dark d-block mt-2 fw-extrabold">Seni &amp; Tradisional</strong></div>
                                <ul class="list-unstyled text-secondary d-flex flex-column gap-2 mb-0 fs-6 fw-medium">
                                    <li class="d-flex align-items-center gap-2"><i class="bi bi-check-circle-fill text-teal-primary"></i> Marawis</li>
                                    <li class="d-flex align-items-center gap-2"><i class="bi bi-check-circle-fill text-teal-primary"></i> Angklung</li>
                                    <li class="d-flex align-items-center gap-2"><i class="bi bi-check-circle-fill text-teal-primary"></i> Seni Musik</li>
                                    <li class="d-flex align-items-center gap-2"><i class="bi bi-check-circle-fill text-teal-primary"></i> Seni Karawitan</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card h-100 border border-light rounded-4 shadow-sm p-4 bg-white card-hover" style="transition: all 0.25s;">
                                <div class="text-teal-primary fs-3 mb-3"><i class="bi bi-book-half"></i> <strong class="fs-5 text-dark d-block mt-2 fw-extrabold">Keagamaan &amp; Bahasa</strong></div>
                                <ul class="list-unstyled text-secondary d-flex flex-column gap-2 mb-0 fs-6 fw-medium">
                                    <li class="d-flex align-items-center gap-2"><i class="bi bi-check-circle-fill text-teal-primary"></i> English Club</li>
                                    <li class="d-flex align-items-center gap-2"><i class="bi bi-check-circle-fill text-teal-primary"></i> Paskibra</li>
                                    <li class="d-flex align-items-center gap-2"><i class="bi bi-check-circle-fill text-teal-primary"></i> Tahfidz</li>
                                    <li class="d-flex align-items-center gap-2"><i class="bi bi-check-circle-fill text-teal-primary"></i> Tilawah <span class="text-muted">(Seni Qur'an)</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                {{-- TAB: PRESTASI SISWA --}}
                @if(isset($tab) && $tab == 'prestasi')
                <div class="card border-0 shadow-sm p-4 p-md-4 rounded-4 bg-white">
                    <div class="mb-4">
                        <span class="badge bg-teal-light text-teal-primary px-3 py-2 rounded-pill fw-semibold mb-2">Daftar Penghargaan</span>
                        <h2 class="fw-bold text-dark mb-2 fs-2">Prestasi Siswa SMP Al-Amanah</h2>
                        <div class="bg-teal-primary rounded" style="width: 60px; height: 4px;"></div>
                    </div>
                    <p class="text-secondary mb-3 fs-5" style="line-height: 1.8; letter-spacing: 0.15px;">Kami bangga mempersembahkan raihan prestasi gemilang putra-putri terbaik SMP Al-Amanah dalam berbagai ajang kompetisi bergengsi:</p>
                    <div class="row g-3">
                        @php
                            $prestasi_list = [
                                ["title" => "Juara 1 Kejuaraan Dayung POPDA Banten 2024", "icon" => "bi-trophy-fill", "level" => "Provinsi"],
                                ["title" => "Juara 1 Tingkat Nasional Pencak Silat kelas B SMP Putri Piala KSAD 2024", "icon" => "bi-award-fill", "level" => "Nasional"],
                                ["title" => "Juara 1 Pencak Silat antar pelajar Jampang Silat Competition 5", "icon" => "bi-award-fill", "level" => "Regional"],
                                ["title" => "Juara 1 Tanding Pencak Silat Championship II Se-Provinsi DKI Jakarta", "icon" => "bi-trophy-fill", "level" => "Provinsi"],
                                ["title" => "Juara 1 Kejuaraan Pencak Silat Piala Kartini & Piala Bung Karno - Kemenpora", "icon" => "bi-award-fill", "level" => "Nasional"],
                                ["title" => "Juara 1 Putra Kejuaraan Pencak Silat Cikal Open antar pelajar Se-Tangsel", "icon" => "bi-award-fill", "level" => "Kota"],
                                ["title" => "Juara 1 dan 2 Pencak Silat se-Bogor", "icon" => "bi-award-fill", "level" => "Regional"],
                                ["title" => "Juara 1 J-Club Pencak Silat Open Competition Se-Provinsi Banten", "icon" => "bi-trophy-fill", "level" => "Provinsi"],
                                ["title" => "Juara 1 Putra Kejuaraan Pencak Silat Pelajar Jakarta Championship 3 Open", "icon" => "bi-award-fill", "level" => "Provinsi"],
                                ["title" => "Juara 2 Tanding Putra Kejuaraan Pencak Silat Pelajar Prestasi Jawa Barat", "icon" => "bi-award-fill", "level" => "Provinsi"],
                                ["title" => "Juara 2 Pencak Silat Championship 1 - Tapcha 1 Tangerang Selatan", "icon" => "bi-award-fill", "level" => "Kota"],
                                ["title" => "Juara 1 MTQ Tk. Kecamatan Setu Kategori Tilawah Anak Putri", "icon" => "bi-moon-stars-fill", "level" => "Kecamatan"],
                                ["title" => "Juara 2 MTQ Tk. Kecamatan Setu Kategori Tilawah Anak Putra", "icon" => "bi-moon-stars-fill", "level" => "Kecamatan"],
                                ["title" => "Juara 2 MTQ Tk. Kecamatan Setu Kategori Tilawah Remaja Putri", "icon" => "bi-moon-stars-fill", "level" => "Kecamatan"],
                                ["title" => "Juara 1 O2SN Pencak Silat Tingkat Kecamatan Tahun 2025", "icon" => "bi-trophy-fill", "level" => "Kecamatan"],
                                ["title" => "Juara 1, 2 dan 3 Pencak Silat Internasional Muslim Gontor Tahun 2025", "icon" => "bi-globe-asia-australia", "level" => "Internasional"],
                                ["title" => "Juara 1 Taekwondo Kejati Banten Cup Tahun 2025", "icon" => "bi-award-fill", "level" => "Provinsi"],
                                ["title" => "Juara 2 Paskibra LKBB Spirit Se-Jabodetabek Tahun 2025", "icon" => "bi-award-fill", "level" => "Regional"],
                                ["title" => "Juara 1 Futsal Kharisma Bangsa School se-Jabodetabek Tahun 2025", "icon" => "bi-trophy-fill", "level" => "Regional"],
                                ["title" => "Juara Lomba FLS2N musik tradisional Tingkat Kota Tahun 2025", "icon" => "bi-music-note-beamed", "level" => "Kota"]
                            ];
                        @endphp
                        @foreach($prestasi_list as $key => $p)
                            <div class="col-md-6">
                                <div class="p-3 bg-light rounded-4 d-flex align-items-center gap-3 border border-light h-100 card-hover">
                                    <span class="fs-3 bg-white p-2 rounded-circle shadow-sm d-inline-flex align-items-center justify-content-center" style="width:48px;height:48px;color:var(--teal-primary);"><i class="bi {{ $p['icon'] }}"></i></span>
                                    <div>
                                        <span class="badge {{ $p['level'] == 'Nasional' || $p['level'] == 'Internasional' ? 'bg-danger' : ($p['level'] == 'Provinsi' ? 'bg-warning text-dark' : 'bg-teal-light text-teal-primary') }} py-1 px-2 rounded-pill fw-bold mb-1" style="font-size: 9.5px;">{{ $p['level'] }}</span>
                                        <h6 class="fw-bold mb-0 text-dark small" style="line-height: 1.45;">{{ $p['title'] }}</h6>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif

            </div>
        </div>
    </main>
    <!-- FOOTER SECTION -->

    <footer class="text-white py-5" style="background-color: #0d5d56; border-top: 4px solid var(--amber-accent);">
        <div class="container-fluid px-4 px-md-5">
            <div class="row g-4 justify-content-between">
                
                <div class="col-md-5">
                    <div class="d-flex align-items-center gap-2 mb-3.5">
                        <div class="rounded-circle bg-white d-flex align-items-center justify-content-center border border-2 border-warning" style="width: 42px; height: 42px; min-width: 42px;">
                            <img src="{{ asset('logo.png') }}" alt="Logo SMP Al-Amanah" style="width: 28px; height: 28px; object-fit: contain;">
                        </div>
                        <h4 class="mb-0 fw-bold text-white h5 tracking-wide">SMP AL-AMANAH</h4>
                    </div>
                    <p class="small text-white-50 lh-relaxed mb-3">
                        {{ $sys_settings['deskripsi_sekolah'] ?? 'Lembaga pendidikan menengah yang berdedikasi tinggi mewujudkan siswa berprestasi akademis gemilang yang bertumpu pada pondasi akhlakul karimah dan wawasan global terintegrasi.' }}
                    </p>
                    <div class="d-flex gap-2">
                        <a href="{{ $sys_settings['sosmed_facebook'] ?? 'https://www.facebook.com/smpalamanahsetu' }}" target="_blank" class="btn btn-sm btn-outline-light rounded-circle"><i class="bi bi-facebook"></i></a>
                        <a href="{{ $sys_settings['sosmed_instagram'] ?? 'https://www.instagram.com/smpalamanahsetu' }}" target="_blank" class="btn btn-sm btn-outline-light rounded-circle"><i class="bi bi-instagram"></i></a>
                        <a href="{{ $sys_settings['sosmed_youtube'] ?? 'https://www.youtube.com/@smpalamanahsetu' }}" target="_blank" class="btn btn-sm btn-outline-light rounded-circle"><i class="bi bi-youtube"></i></a>
                        <a href="{{ $sys_settings['sosmed_tiktok'] ?? 'https://www.tiktok.com/@smpalamanahsetu' }}" target="_blank" class="btn btn-sm btn-outline-light rounded-circle"><i class="bi bi-tiktok"></i></a>
                    </div>
                </div>

                <div class="col-md-3">
                    <h5 class="fw-bold mb-3 border-bottom border-white border-opacity-10 pb-2 text-warning">Tautan Cepat</h5>
                    <ul class="list-unstyled d-flex flex-column gap-2 small">
                        <li><a href="{{ url('/') }}" class="text-white-50 text-decoration-none text-white-hover">Home</a></li>
                        <li><a href="{{ url('/profil') }}" class="text-white-50 text-decoration-none text-white-hover">Profil Sekolah</a></li>
                        <li><a href="{{ url('/ppdb') }}" class="text-white-50 text-decoration-none text-white-hover">Informasi PPDB</a></li>
                        <li><a href="{{ url('/berita') }}" class="text-white-50 text-decoration-none text-white-hover">Berita Sekolah</a></li>
                        <li><a href="{{ url('/kontak') }}" class="text-white-50 text-decoration-none text-white-hover">Kontak Kami</a></li>
                    </ul>
                </div>

                <div class="col-md-4">
                    <h5 class="fw-bold mb-3 border-bottom border-white border-opacity-10 pb-2 text-warning">Hubungi Sekolah</h5>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
