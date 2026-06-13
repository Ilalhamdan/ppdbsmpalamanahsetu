<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontak - SMP AL-AMANAH</title>
    
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
    </style>
</head>
<body class="d-flex flex-column min-h-screen">

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
        
        <div class="mb-4">
            <span class="badge bg-teal-light text-teal-primary px-3 py-2 rounded-pill fw-semibold mb-2">Hubungi Kami</span>
            <h2 class="fw-bold text-dark mb-2">Informasi Kontak &amp; Lokasi</h2>
            <div class="bg-teal-primary rounded" style="width: 50px; height: 4px;"></div>
        </div>

        <div class="row g-4">
            
            <div class="col-lg-6 d-flex flex-column gap-3">
                
                <div class="card border-0 shadow-sm p-4 rounded-4 bg-white m-0">
                    <h4 class="h6 fw-bold text-teal-primary text-uppercase mb-2"><i class="bi bi-geo-alt-fill me-1"></i> Alamat Sekolah</h4>
                    <p class="text-secondary small mb-0" style="line-height: 1.6;">
                        {{ $sys_settings['kontak_alamat'] ?? 'Jl. Raya Al-Amanah No. 45, Al Bantani, Indonesia' }}
                    </p>
                </div>

                <div class="card border-0 shadow-sm p-4 rounded-4 bg-white m-0">
                    <h4 class="h6 fw-bold text-teal-primary text-uppercase mb-2"><i class="bi bi-telephone-fill me-1"></i> Hubungi Jalur Cepat</h4>
                    <p class="text-secondary small mb-1">Telp: {{ $sys_settings['kontak_telepon'] ?? '0813-8993-0005' }}</p>
                    <p class="text-secondary small mb-0">Email: {{ $sys_settings['kontak_email'] ?? 'info@smp-alamanah.sch.id' }}</p>
                </div>

                <div class="card border-0 shadow-sm p-4 rounded-4 bg-white m-0">
                    <h4 class="h6 fw-bold text-dark text-uppercase tracking-wider border-bottom pb-2 mb-3"><i class="bi bi-share-fill me-1"></i> Saluran Media Sosial</h4>
                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ $sys_settings['sosmed_instagram'] ?? 'https://www.instagram.com/smpalamanahsetu' }}" target="_blank" class="btn bg-teal-extra-light text-teal-primary fw-medium px-3 py-2 rounded-3 small text-decoration-none flex-fill text-center">
                            <i class="bi bi-instagram me-1"></i> Instagram
                        </a>
                        <a href="{{ $sys_settings['sosmed_tiktok'] ?? 'https://www.tiktok.com/@smpalamanahsetu' }}" target="_blank" class="btn bg-teal-extra-light text-teal-primary fw-medium px-3 py-2 rounded-3 small text-decoration-none flex-fill text-center">
                            <i class="bi bi-tiktok me-1"></i> TikTok
                        </a>
                        <a href="{{ $sys_settings['sosmed_facebook'] ?? 'https://www.facebook.com/smpalamanahsetu' }}" target="_blank" class="btn bg-teal-extra-light text-teal-primary fw-medium px-3 py-2 rounded-3 small text-decoration-none flex-fill text-center">
                            <i class="bi bi-facebook me-1"></i> Facebook
                        </a>
                        <a href="{{ $sys_settings['sosmed_youtube'] ?? 'https://www.youtube.com/@smpalamanahsetu' }}" target="_blank" class="btn bg-teal-extra-light text-teal-primary fw-medium px-3 py-2 rounded-3 small text-decoration-none flex-fill text-center">
                            <i class="bi bi-youtube me-1"></i> YouTube
                        </a>
                    </div>
                </div>

            </div>

            <div class="col-lg-6">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white p-2 h-100 d-flex align-items-stretch">
                   <iframe 
                        src="https://maps.google.com/maps?q=SMP%20Al%20Amanah%20Pamulang&t=&z=15&ie=UTF-8&iwloc=&output=embed" 
                        class="w-100 rounded-3 h-100" 
                        style="min-height: 400px; border:0;" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
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