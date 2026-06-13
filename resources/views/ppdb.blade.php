<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PPDB - SMP AL-AMANAH</title>
    
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
<body class="d-flex flex-column min-h-screen bg-light">

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

    <main class="container-fluid px-4 px-md-5 py-5">
        <div class="row justify-content-center">
            
            <!-- Main Tab Content Area -->
            <div class="col-lg-10">
                <div class="tab-content" id="ppdbTabContent">
                    
                    <!-- TAB: GELOMBANG -->
                    <div class="tab-pane fade {{ (!isset($tab) || $tab == 'gelombang') ? 'show active' : '' }}" id="gelombang" role="tabpanel">
                        
                        <div class="card border-0 shadow-sm p-5 p-md-5.5 rounded-4 bg-white mb-4">
                            <div class="mb-5">
                                <span class="badge bg-teal-light text-teal-primary px-3 py-2 rounded-pill fw-semibold mb-3">Informasi Jadwal &amp; Biaya</span>
                                <h2 class="fw-bold text-dark mb-3 fs-1">Gelombang Pendaftaran</h2>
                                <div class="bg-teal-primary rounded" style="width: 60px; height: 4px;"></div>
                            </div>

                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="card border border-light shadow-sm rounded-4 overflow-hidden bg-white h-100 card-hover">
                                        <div class="bg-teal-primary p-3.5 text-center text-white fw-extrabold text-uppercase tracking-wider" style="font-size: 14px;">
                                            Gelombang I
                                        </div>
                                        <div class="p-4 bg-teal-extra-light text-center border-bottom">
                                            <div class="badge bg-danger px-3.5 py-2 rounded-pill fw-bold mb-3 shadow-sm" style="font-size: 12px; letter-spacing: 0.5px;">
                                                <i class="bi bi-gift-fill me-1"></i> DISCOUNT {{ $sys_settings['gelombang1_diskon'] ?? '30%' }}
                                            </div>
                                            <h4 class="fw-bold text-dark mb-1" style="font-size: 15px;">Waktu Pendaftaran</h4>
                                            <p class="text-teal-primary fw-bold mb-0" style="font-size: 16px;">{{ $sys_settings['gelombang1_waktu'] ?? '13 Oktober 2025 - 28 Februari 2026' }}</p>
                                        </div>
                                        <div class="card-body p-3.5 text-center bg-light">
                                            <p class="text-secondary small mb-0 fw-medium">
                                                <i class="bi bi-clock me-1 text-teal-primary"></i> Tes Prestasi Akademik dilaksanakan saat mendaftar atau di hari Sabtu.
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="card border border-light shadow-sm rounded-4 overflow-hidden bg-white h-100 card-hover">
                                        <div class="bg-secondary p-3.5 text-center text-white fw-extrabold text-uppercase tracking-wider" style="font-size: 14px;">
                                            Gelombang II
                                        </div>
                                        <div class="p-4 bg-teal-extra-light text-center border-bottom">
                                            <div class="badge bg-warning text-dark px-3.5 py-2 rounded-pill fw-bold mb-3 shadow-sm" style="font-size: 12px; letter-spacing: 0.5px;">
                                                <i class="bi bi-gift-fill me-1"></i> DISCOUNT {{ $sys_settings['gelombang2_diskon'] ?? '20%' }}
                                            </div>
                                            <h4 class="fw-bold text-dark mb-1" style="font-size: 15px;">Waktu Pendaftaran</h4>
                                            <p class="text-teal-primary fw-bold mb-0" style="font-size: 16px;">{{ $sys_settings['gelombang2_waktu'] ?? '02 Maret 2026 - 11 Juli 2026' }}</p>
                                        </div>
                                        <div class="card-body p-3.5 text-center bg-light">
                                            <p class="text-secondary small mb-0 fw-medium">
                                                <i class="bi bi-clock me-1 text-teal-primary"></i> Tes Prestasi Akademik dilaksanakan saat mendaftar atau di hari Sabtu.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- TAB: JALUR -->
                    <div class="tab-pane fade {{ (isset($tab) && $tab == 'jalur') ? 'show active' : '' }}" id="jalur" role="tabpanel">
                        <div class="card border-0 shadow-sm p-5 p-md-5.5 rounded-4 bg-white mb-4">
                            <div class="text-center mb-5">
                                <span class="badge bg-teal-light text-teal-primary px-3 py-2 rounded-pill fw-semibold mb-3">Kategori Seleksi</span>
                                <h2 class="fw-bold text-dark mb-3 fs-1">Jalur Pendaftaran</h2>
                                <div class="bg-teal-primary rounded mx-auto" style="width: 60px; height: 4px;"></div>
                            </div>

                            <div class="row g-4">
                                <div class="col-lg-4">
                                    <div class="card border-0 shadow-sm rounded-4 p-4 h-100 bg-light text-center card-hover">
                                        <div class="bg-teal-extra-light rounded-circle mx-auto d-flex align-items-center justify-content-center text-teal-primary mb-3" style="width: 65px; height: 65px;">
                                            <i class="bi bi-mortarboard-fill fs-3"></i>
                                        </div>
                                        <h5 class="fw-bold text-dark mb-2.5">Jalur Reguler</h5>
                                        <p class="text-secondary small mb-3">Pendaftaran reguler bagi seluruh lulusan SD/MI berdasarkan nilai rapot rata-rata, tes pemetaan tertulis, dan wawancara.</p>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="card border-0 shadow-sm rounded-4 p-4 h-100 bg-white text-center border-top border-4 border-teal-primary shadow card-hover">
                                        <div class="bg-teal-primary rounded-circle mx-auto d-flex align-items-center justify-content-center text-white mb-3" style="width: 65px; height: 65px;">
                                            <i class="bi bi-trophy-fill fs-3"></i>
                                        </div>
                                        <h5 class="fw-bold text-dark mb-2.5">Jalur Prestasi</h5>
                                        <p class="text-secondary small mb-3">Apresiasi bagi siswa unggulan yang memiliki piagam/sertifikat perlombaan resmi minimal tingkat Kota/Kabupaten (Bebas tes tulis akademik).</p>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="card border-0 shadow-sm rounded-4 p-4 h-100 bg-light text-center card-hover">
                                        <div class="bg-teal-extra-light rounded-circle mx-auto d-flex align-items-center justify-content-center text-teal-primary mb-3" style="width: 65px; height: 65px;">
                                            <i class="bi bi-book-fill fs-3"></i>
                                        </div>
                                        <h5 class="fw-bold text-dark mb-2.5">Jalur Tahfidz</h5>
                                        <p class="text-secondary small mb-3">Jalur penuh berkah khusus bagi para penghafal Al-Qur'an (minimal hafal 3 Juz) melalui uji kelayakan sima'an dan beasiswa potongan SPP.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- TAB: SYARAT & PERLENGKAPAN -->
                    <div class="tab-pane fade {{ (isset($tab) && $tab == 'syarat') ? 'show active' : '' }}" id="syarat" role="tabpanel">
                        
                        <!-- 8 Syarat Pendaftaran -->
                        <div class="card border-0 shadow-sm p-5 p-md-5.5 rounded-4 bg-white mb-5">
                            <div class="mb-5">
                                <span class="badge bg-teal-light text-teal-primary px-3 py-2 rounded-pill fw-semibold mb-3">Administrasi PPDB</span>
                                <h2 class="fw-bold text-dark mb-3 fs-1">Syarat Pendaftaran</h2>
                                <div class="bg-teal-primary rounded" style="width: 60px; height: 4px;"></div>
                            </div>
                            
                            <div class="row g-4">
                                @php
                                    $syarat_list = [
                                        "Mengisi formulir pendaftaran secara online di portal PPDB SMP Al-Amanah.",
                                        "Fotokopi Akta Kelahiran/Surat Keterangan Lahir, Kartu Keluarga, dan KTP kedua orang tua masing-masing 2 lembar (diserahkan setelah mengisi formulir).",
                                        "Fotokopi Ijazah SD/MI yang telah dilegalisir masing-masing 2 lembar (diserahkan setelah menerima dari sekolah masing-masing).",
                                        "Fotokopi raport kelas IV, V semester ganjil-genap dan kelas VI semester ganjil dengan rata-rata nilai minimal 94 per semester (Khusus untuk pendaftar Jalur Prestasi Akademik).",
                                        "Memperoleh nilai kelulusan tes masuk tertulis potensi akademik SMP Al-Amanah minimal 78.",
                                        "Jalur Prestasi non-akademik wajib memiliki piagam Juara 1 tingkat Kabupaten/Kota, Juara 2 tingkat Provinsi, atau Juara 3 tingkat Nasional minimal satu tahun terakhir (melampirkan fotokopi sertifikat).",
                                        "Jalur Tahfiz minimal menghafal 3 Juz Al-Qur'an secara mutqin.",
                                        "Menyelesaikan pembayaran administrasi keuangan pendaftaran sesuai ketentuan gelombang."
                                    ];
                                @endphp
                                @foreach($syarat_list as $index => $s)
                                    <div class="col-12">
                                        <div class="p-4 rounded-4 bg-light d-flex gap-4 align-items-start border border-light card-hover" style="transition: all 0.2s;">
                                            <span class="badge bg-teal-primary rounded-circle d-flex align-items-center justify-content-center text-white p-2" style="width: 32px; height: 32px; font-size: 14px; min-width: 32px;">
                                                {{ $index + 1 }}
                                            </span>
                                            <p class="mb-0 text-dark fs-6 fw-medium" style="line-height: 1.75;">{{ $s }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- 5 Perlengkapan Sekolah Untuk Siswa -->
                        <div class="card border-0 shadow-sm p-5 p-md-5.5 rounded-4 bg-white">
                            <div class="mb-5">
                                <span class="badge bg-teal-light text-teal-primary px-3 py-2 rounded-pill fw-semibold mb-3">Perlengkapan Peserta Didik</span>
                                <h2 class="fw-bold text-dark mb-3 fs-1">Perlengkapan Sekolah Untuk Siswa</h2>
                                <div class="bg-teal-primary rounded" style="width: 60px; height: 4px;"></div>
                            </div>
                            <p class="text-secondary mb-4.5 fs-5" style="line-height: 1.95; letter-spacing: 0.15px;">Setiap calon siswa baru yang dinyatakan diterima akan memperoleh perlengkapan sekolah terintegrasi.</p>
                            <div class="row g-4">
                                <div class="col-md-6 col-lg-4">
                                    <div class="p-4.5 p-md-5 rounded-4 bg-light h-100 border border-light card-hover shadow-sm" style="transition: all 0.25s;">
                                        <span class="fs-1 mb-3.5 d-block text-teal-primary"><i class="bi bi-person-running"></i></span>
                                        <h5 class="fw-extrabold mb-3 text-dark fs-5">1. Seragam Olahraga</h5>
                                        <p class="text-secondary mb-0 fs-6 fw-medium" style="line-height: 1.7;">1 Stel seragam olahraga resmi SMP Al-Amanah.</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-8">
                                    <div class="p-4.5 p-md-5 rounded-4 bg-light h-100 border border-light card-hover shadow-sm" style="transition: all 0.25s;">
                                        <span class="fs-1 mb-3.5 d-block text-teal-primary"><i class="bi bi-tags-fill"></i></span>
                                        <h5 class="fw-extrabold mb-3 text-dark fs-5">2. Pakaian &amp; Seragam Sekolah</h5>
                                        <ul class="list-unstyled text-secondary mb-0 d-flex flex-column gap-3 mt-3 fs-6 fw-medium">
                                            <li class="d-flex align-items-start gap-2.5">
                                                <i class="bi bi-check-circle-fill text-teal-primary mt-1"></i>
                                                <span style="line-height: 1.6;">2.1. Batik: Putra (tangan pendek), Putri (tangan panjang) 1 potong.</span>
                                            </li>
                                            <li class="d-flex align-items-start gap-2.5">
                                                <i class="bi bi-check-circle-fill text-teal-primary mt-1"></i>
                                                <span style="line-height: 1.6;">2.2. Baju Koko busana muslim 1 potong.</span>
                                            </li>
                                            <li class="d-flex align-items-start gap-2.5">
                                                <i class="bi bi-check-circle-fill text-teal-primary mt-1"></i>
                                                <span style="line-height: 1.6;">2.3. Baju Putih tangan panjang putra-putri 1 potong.</span>
                                            </li>
                                            <li class="d-flex align-items-start gap-2.5">
                                                <i class="bi bi-check-circle-fill text-teal-primary mt-1"></i>
                                                <span style="line-height: 1.6;">2.4. Putri: 2 buah kerudung (putih dan biru) dan badge lokasi.</span>
                                            </li>
                                            <li class="d-flex align-items-start gap-2.5">
                                                <i class="bi bi-check-circle-fill text-teal-primary mt-1"></i>
                                                <span style="line-height: 1.6;">2.5. Putra: 2 buah dasi, peci, ikat pinggang dan badge lokasi.</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4">
                                    <div class="p-4.5 p-md-5 rounded-4 bg-light h-100 border border-light card-hover shadow-sm" style="transition: all 0.25s;">
                                        <span class="fs-1 mb-3.5 d-block text-teal-primary"><i class="bi bi-book-fill"></i></span>
                                        <h5 class="fw-extrabold mb-3 text-dark fs-5">3. Kartu &amp; Al-Qur'an</h5>
                                        <p class="text-secondary mb-0 fs-6 fw-medium" style="line-height: 1.7;">Pasfoto resmi, Mushaf Al-Qur'an hafalan, Kartu Pelajar, dan Kartu Perpustakaan digital.</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4">
                                    <div class="p-4.5 p-md-5 rounded-4 bg-light h-100 border border-light card-hover shadow-sm" style="transition: all 0.25s;">
                                        <span class="fs-1 mb-3.5 d-block text-teal-primary"><i class="bi bi-book-half"></i></span>
                                        <h5 class="fw-extrabold mb-3 text-dark fs-5">4. Buku LKS</h5>
                                        <p class="text-secondary mb-0 fs-6 fw-medium" style="line-height: 1.7;">Buku Lembar Kerja Siswa (LKS) lengkap untuk satu semester.</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4">
                                    <div class="p-4.5 p-md-5 rounded-4 bg-light h-100 border border-light card-hover shadow-sm" style="transition: all 0.25s;">
                                        <span class="fs-1 mb-3.5 d-block text-teal-primary"><i class="bi bi-folder-fill"></i></span>
                                        <h5 class="fw-extrabold mb-3 text-dark fs-5">5. Sampul Raport</h5>
                                        <p class="text-secondary mb-0 fs-6 fw-medium" style="line-height: 1.7;">Sampul khusus raport berlogo emas SMP Al-Amanah.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

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