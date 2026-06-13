<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berita & Kegiatan - SMP AL-AMANAH</title>
    <meta name="description" content="Berita dan kegiatan terbaru SMP Al-Amanah. Ikuti perkembangan sekolah, prestasi siswa, informasi PPDB, dan kegiatan akademik.">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Fonts (Inter) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    @vite(['resources/css/app.css'])

    <style>
        :root {
            --teal-primary: #0d9488;
            --teal-dark: #0f766e;
            --teal-light: #ccfbf1;
            --teal-extra-light: #f0fdfa;
            --amber-accent: #fef08a;
        }
        
        body { font-family: 'Inter', sans-serif; background-color: #f8fafc; color: #1e293b; }

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
        .text-teal-hover { transition: color 0.2s ease-in-out; }
        .text-teal-hover:hover { color: var(--teal-primary) !important; }

        /* Search Bar */
        .search-wrapper { position: relative; }
        .search-wrapper .bi-search {
            position: absolute; left: 14px; top: 50%; transform: translateY(-50%);
            color: #94a3b8; font-size: 15px; pointer-events: none;
        }
        .search-input {
            padding-left: 42px; border-radius: 12px; border: 1.5px solid #e2e8f0;
            font-size: 14px; height: 46px; background: #fff;
            transition: all 0.2s;
        }
        .search-input:focus {
            border-color: var(--teal-primary); box-shadow: 0 0 0 3px rgba(13,148,136,0.12);
            outline: none;
        }

        /* Filter Pills */
        .filter-pill {
            border: 1.5px solid #e2e8f0; background: #fff; color: #475569;
            border-radius: 20px; padding: 5px 16px; font-size: 12.5px; font-weight: 600;
            cursor: pointer; transition: all 0.2s; white-space: nowrap;
        }
        .filter-pill:hover, .filter-pill.active {
            background: var(--teal-primary); color: #fff; border-color: var(--teal-primary);
        }

        /* News Card */
        .news-card {
            background: #fff; border-radius: 16px; border: none;
            box-shadow: 0 2px 12px rgba(15, 118, 110, 0.07);
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            overflow: hidden; cursor: pointer; height: 100%;
            display: flex; flex-direction: column;
        }
        .news-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 28px rgba(13, 148, 136, 0.14);
        }
        .news-card .card-body {
            display: flex; flex-direction: column; flex-grow: 1;
        }
        .news-card .read-more-link {
            margin-top: auto;
        }
        .news-thumb {
            width: 100%; height: 200px; object-fit: contain; background-color: #fafafa;
            border-bottom: 1px solid #f1f5f9;
        }
        .news-thumb-placeholder {
            width: 100%; height: 200px;
            background: linear-gradient(135deg, var(--teal-light) 0%, #a7f3d0 100%);
            display: flex; align-items: center; justify-content: center;
            color: var(--teal-primary); font-weight: 600; font-size: 14px;
        }
        .kategori-badge {
            font-size: 10.5px; font-weight: 700; padding: 3px 10px;
            border-radius: 20px; background: var(--teal-extra-light);
            color: var(--teal-primary); border: 1px solid var(--teal-light);
            text-transform: uppercase; letter-spacing: 0.3px;
        }
        .read-more-link {
            color: var(--teal-primary); font-weight: 600; font-size: 13px;
            text-decoration: none; transition: all 0.2s;
            display: inline-flex; align-items: center; gap: 4px;
        }
        .read-more-link:hover { color: var(--teal-dark); gap: 8px; }

        /* Empty State */
        .empty-state {
            text-align: center; padding: 80px 20px;
        }
        .empty-state-icon { font-size: 64px; margin-bottom: 16px; opacity: 0.4; }

        /* Detail Modal */
        .modal-berita { display: none; position: fixed; inset: 0; z-index: 9999; }
        .modal-berita.show { display: flex; align-items: flex-start; justify-content: center; }
        .modal-berita-backdrop {
            position: absolute; inset: 0;
            background: rgba(0,0,0,0.55); backdrop-filter: blur(4px);
        }
        .modal-berita-box {
            position: relative; z-index: 1; background: #fff;
            border-radius: 20px; width: 860px; max-width: 95vw;
            max-height: 92vh; overflow-y: auto;
            margin: 4vh auto;
            box-shadow: 0 24px 64px rgba(0,0,0,0.18);
            animation: slideUp 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(24px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .modal-hero-img {
            width: 100%; height: 320px; object-fit: cover;
            border-radius: 20px 20px 0 0;
        }
        .modal-hero-placeholder {
            width: 100%; height: 200px;
            background: linear-gradient(135deg, var(--teal-light), #a7f3d0);
            border-radius: 20px 20px 0 0;
            display: flex; align-items: center; justify-content: center;
            font-size: 48px;
        }
        .modal-galeri img {
            width: 100%; height: 160px; object-fit: cover;
            border-radius: 10px; border: 1px solid #e2e8f0;
            cursor: pointer; transition: all 0.2s;
        }
        .modal-galeri img:hover { transform: scale(1.03); box-shadow: 0 4px 12px rgba(0,0,0,0.12); }
        .article-body {
            font-size: 15px; line-height: 1.85; color: #374151;
            white-space: pre-wrap; word-wrap: break-word;
        }

        /* Image Lightbox */
        .lightbox { display: none; position: fixed; inset: 0; z-index: 19999; background: rgba(0,0,0,0.9); align-items: center; justify-content: center; }
        .lightbox.show { display: flex; }
        .lightbox img { max-width: 90vw; max-height: 90vh; border-radius: 8px; }

        /* No results */
        .no-result-state { text-align: center; padding: 60px 20px; }
    </style>
</head>
<body class="d-flex flex-column" style="min-height:100vh;">

    <!-- HEADER / NAVBAR -->
    <header class="bg-white border-bottom shadow-sm sticky-top" style="z-index: 1030;">
        <div class="container-fluid px-4 px-md-5 d-flex align-items-center justify-content-between" style="padding-top: 1.1rem; padding-bottom: 1.1rem;">
            
            <div class="d-flex align-items-center gap-3">
                <div class="d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; min-width: 48px;">
                    <img src="{{ asset('logo.png') }}" alt="Logo SMP Al-Amanah" style="width: 48px; height: 48px; object-fit: contain;">
                </div>
                <div>
                    <h1 class="mb-0 fw-extrabold text-dark" style="font-size: 16px; letter-spacing: 0.6px;">SMP AL-AMANAH</h1>
                    <p class="text-teal-primary mb-0 fw-semibold" style="font-size: 10px; letter-spacing: 1px;">SEKOLAH BERPRESTASI, BERAKHLAK MULIA</p>
                </div>
            </div>

            <ul class="nav d-none d-md-flex align-items-center gap-4 fw-semibold" style="font-size: 14.5px;">
                <li class="nav-item">
                    <a href="{{ url('/') }}" class="nav-link p-0 {{ Request::is('/') ? 'text-teal-primary border-bottom border-2 border-teal-primary pb-1' : 'text-secondary text-teal-hover' }}">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link p-0 {{ Request::is('profil*') ? 'text-teal-primary border-bottom border-2 border-teal-primary pb-1' : 'text-secondary text-teal-hover' }} dropdown-toggle" id="navbarDropdownProfil" role="button" data-bs-toggle="dropdown" aria-expanded="false">Profil</a>
                    <ul class="dropdown-menu border-0 shadow-sm rounded-3" aria-labelledby="navbarDropdownProfil">
                        <li><a class="dropdown-item py-2 text-secondary" href="{{ url('/profil/sejarah') }}">Sejarah</a></li>
                        <li><a class="dropdown-item py-2 text-secondary" href="{{ url('/profil/visi-misi') }}">Visi Misi</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/berita') }}" class="nav-link p-0 text-teal-primary border-bottom border-2 border-teal-primary pb-1">Berita</a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/galeri') }}" class="nav-link p-0 text-secondary text-teal-hover">Galeri</a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/kontak') }}" class="nav-link p-0 text-secondary text-teal-hover">Kontak</a>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link p-0 {{ Request::is('ppdb*') ? 'text-teal-primary border-bottom border-2 border-teal-primary pb-1' : 'text-secondary text-teal-hover' }} dropdown-toggle" id="navbarDropdownPPDB" role="button" data-bs-toggle="dropdown" aria-expanded="false">PPDB</a>
                    <ul class="dropdown-menu border-0 shadow-sm rounded-3" aria-labelledby="navbarDropdownPPDB">
                        <li><a class="dropdown-item py-2 text-secondary" href="{{ url('/ppdb/gelombang') }}">Informasi Gelombang</a></li>
                        <li><a class="dropdown-item py-2 text-secondary" href="{{ url('/ppdb/jalur') }}">Jalur Pendaftaran</a></li>
                        <li><a class="dropdown-item py-2 text-secondary" href="{{ url('/ppdb/syarat') }}">Syarat & Perlengkapan</a></li>
                    </ul>
                </li>
            </ul>

            <div class="d-none d-md-flex align-items-center gap-3">
                <a href="{{ route('login') }}" class="btn btn-outline-teal rounded-pill fw-semibold" style="padding: 0.55rem 1.45rem; font-size: 13.5px; border: 1.5px solid var(--teal-primary);">Masuk Akun</a>
                <a href="{{ route('register') }}" class="btn btn-teal rounded-pill fw-semibold shadow-sm" style="padding: 0.55rem 1.45rem; font-size: 13.5px;">Registrasi</a>
            </div>
        </div>
    </header>

    <main class="flex-grow-1">
        <div class="container-fluid px-4 px-md-5 py-5">

            {{-- PAGE HEADER --}}
            <div class="mb-5">
                <span class="badge px-3 py-2 rounded-pill fw-semibold mb-2" style="background:var(--teal-extra-light);color:var(--teal-primary);font-size:12px;">Informasi Terbaru</span>
                <h2 class="fw-bold text-dark mb-2" style="font-size:28px;">Berita &amp; Kegiatan Sekolah</h2>
                <div class="bg-teal-primary rounded mb-3" style="width: 50px; height: 4px;"></div>
                <p class="text-muted" style="font-size:14px;max-width:520px;">Ikuti perkembangan terkini SMP Al-Amanah — mulai dari prestasi siswa, kegiatan sekolah, hingga informasi PPDB terbaru.</p>
            </div>

            {{-- SEARCH & FILTER BAR --}}
            <div class="d-flex flex-column flex-md-row gap-3 align-items-md-center mb-5">
                {{-- Search Box --}}
                <div class="search-wrapper flex-grow-1" style="max-width: 440px;">
                    <i class="bi bi-search"></i>
                    <input type="text" id="searchBerita" class="form-control search-input"
                        placeholder="Cari judul atau isi berita..."
                        oninput="filterBerita()" autocomplete="off">
                </div>
                {{-- Category Filters --}}
                <div class="d-flex flex-wrap gap-2" id="filterPills">
                    <button class="filter-pill active" data-kategori="Semua" onclick="setFilterKategori('Semua', this)">Semua</button>
                    <button class="filter-pill" data-kategori="PPDB" onclick="setFilterKategori('PPDB', this)">PPDB</button>
                    <button class="filter-pill" data-kategori="Prestasi" onclick="setFilterKategori('Prestasi', this)">Prestasi</button>
                    <button class="filter-pill" data-kategori="Kegiatan" onclick="setFilterKategori('Kegiatan', this)">Kegiatan</button>
                    <button class="filter-pill" data-kategori="Fasilitas" onclick="setFilterKategori('Fasilitas', this)">Fasilitas</button>
                    <button class="filter-pill" data-kategori="Akademik" onclick="setFilterKategori('Akademik', this)">Akademik</button>
                    <button class="filter-pill" data-kategori="Pengumuman" onclick="setFilterKategori('Pengumuman', this)">Pengumuman</button>
                </div>
                {{-- Count Info --}}
                <div class="text-muted ms-auto text-nowrap" style="font-size:12.5px;" id="beritaCountInfo"></div>
            </div>

            {{-- BERITA GRID --}}
            <div class="row g-4" id="beritaGrid">
                {{-- Rendered by JavaScript --}}
            </div>

            {{-- EMPTY STATE --}}
            <div id="beritaEmptyState" class="empty-state" style="display:none;">
                <div class="empty-state-icon"><i class="bi bi-newspaper" style="font-size: 48px; color: var(--teal-primary);"></i></div>
                <h5 class="fw-bold text-dark">Belum Ada Berita</h5>
                <p class="text-muted" style="font-size:14px;">Belum ada berita yang dipublikasikan. Cek kembali nanti.</p>
            </div>

            <div id="beritaNoResult" class="no-result-state" style="display:none;">
                <div style="font-size:48px;opacity:0.3;color:var(--teal-primary);"><i class="bi bi-search"></i></div>
                <h5 class="fw-bold text-dark mt-3">Berita Tidak Ditemukan</h5>
                <p class="text-muted" style="font-size:14px;">Coba kata kunci lain atau pilih kategori berbeda.</p>
                <button class="btn btn-outline-teal rounded-pill mt-2" onclick="resetFilter()" style="font-size:13px;">Reset Pencarian</button>
            </div>

        </div>
    </main>

    <!-- FOOTER -->
    <footer class="text-white py-5 mt-auto" style="background-color: #0d5d56; border-top: 4px solid var(--amber-accent);">
        <div class="container-fluid px-4 px-md-5">
            <div class="row g-4 justify-content-between">
                <div class="col-md-5">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <div class="rounded-circle bg-white d-flex align-items-center justify-content-center border border-2 border-warning" style="width: 42px; height: 42px; min-width: 42px;">
                            <img src="{{ asset('logo.png') }}" alt="Logo SMP Al-Amanah" style="width: 28px; height: 28px; object-fit: contain;">
                        </div>
                        <h4 class="mb-0 fw-bold text-white h5">SMP AL-AMANAH</h4>
                    </div>
                    <p class="small text-white-50 lh-lg mb-3">{{ $sys_settings['deskripsi_sekolah'] ?? 'Lembaga pendidikan menengah yang berdedikasi tinggi mewujudkan siswa berprestasi akademis gemilang yang bertumpu pada pondasi akhlakul karimah dan wawasan global terintegrasi.' }}</p>
                    <div class="d-flex gap-2">
                        <a href="{{ $sys_settings['sosmed_facebook'] ?? 'https://facebook.com/smpalamanahsetu' }}" target="_blank" class="btn btn-sm btn-outline-light rounded-circle"><i class="bi bi-facebook"></i></a>
                        <a href="{{ $sys_settings['sosmed_instagram'] ?? 'https://instagram.com/smpalamanahsetu' }}" target="_blank" class="btn btn-sm btn-outline-light rounded-circle"><i class="bi bi-instagram"></i></a>
                        <a href="{{ $sys_settings['sosmed_youtube'] ?? 'https://youtube.com/@smpalamanahsetu' }}" target="_blank" class="btn btn-sm btn-outline-light rounded-circle"><i class="bi bi-youtube"></i></a>
                        <a href="{{ $sys_settings['sosmed_tiktok'] ?? 'https://tiktok.com/@smpalamanahsetu' }}" target="_blank" class="btn btn-sm btn-outline-light rounded-circle"><i class="bi bi-tiktok"></i></a>
                    </div>
                </div>
                <div class="col-md-3">
                    <h5 class="fw-bold mb-3 border-bottom border-white border-opacity-10 pb-2 text-warning">Tautan Cepat</h5>
                    <ul class="list-unstyled d-flex flex-column gap-2 small">
                        <li><a href="{{ url('/') }}" class="text-white-50 text-decoration-none">Home</a></li>
                        <li><a href="{{ url('/profil') }}" class="text-white-50 text-decoration-none">Profil Sekolah</a></li>
                        <li><a href="{{ url('/ppdb') }}" class="text-white-50 text-decoration-none">Informasi PPDB</a></li>
                        <li><a href="{{ url('/berita') }}" class="text-white-50 text-decoration-none">Berita Sekolah</a></li>
                        <li><a href="{{ url('/kontak') }}" class="text-white-50 text-decoration-none">Kontak Kami</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5 class="fw-bold mb-3 border-bottom border-white border-opacity-10 pb-2 text-warning">Hubungi Sekolah</h5>
                    <ul class="list-unstyled d-flex flex-column gap-3 small text-white-50">
                        <li class="d-flex align-items-start gap-2"><i class="bi bi-geo-alt-fill text-warning mt-1"></i><span>{{ $sys_settings['kontak_alamat'] ?? 'Jl. Raya Al-Amanah No. 45, Al Bantani, Indonesia' }}</span></li>
                        <li class="d-flex align-items-center gap-2"><i class="bi bi-envelope-fill text-warning"></i><span>{{ $sys_settings['kontak_email'] ?? 'info@smp-alamanah.sch.id' }}</span></li>
                        <li class="d-flex align-items-center gap-2"><i class="bi bi-telephone-fill text-warning"></i><span>{{ $sys_settings['kontak_telepon'] ?? '0813-8993-0005' }}</span></li>
                    </ul>
                </div>
            </div>
            <div class="border-top border-white border-opacity-10 mt-5 pt-4 text-center text-white-50 small">
                <p class="mb-0">&copy; {{ $sys_settings['tahun_sekarang'] ?? '2026' }} {{ $sys_settings['nama_sekolah'] ?? 'SMP Al-Amanah' }}. All Rights Reserved. Crafted for PPDB Online Portal.</p>
            </div>
        </div>
    </footer>

    {{-- MODAL: DETAIL BERITA --}}
    <div class="modal-berita" id="modalDetailBerita">
        <div class="modal-berita-backdrop" onclick="tutupDetailBerita()"></div>
        <div class="modal-berita-box" id="modalDetailBeritaBox">
            {{-- Content injected by JS --}}
        </div>
    </div>

    {{-- LIGHTBOX: Full-size image --}}
    <div class="lightbox" id="lightbox" onclick="tutupLightbox()">
        <img id="lightboxImg" src="" alt="Preview Gambar">
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    // ===================== DATA =====================
    const BLOG_KEY = 'ppdb_blog_posts';
    let filterKategoriAktif = 'Semua';
    let currentDetailId = null;

    function getBlogPublished() {
        try {
            const all = JSON.parse(localStorage.getItem(BLOG_KEY)) || [];
            return all.filter(p => p.status === 'published')
                      .sort((a, b) => new Date(b.tanggal) - new Date(a.tanggal));
        } catch(e) { return []; }
    }

    // ===================== FORMAT HELPERS =====================
    function formatTanggal(tanggal) {
        if (!tanggal) return '–';
        const d = new Date(tanggal);
        return d.toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' });
    }
    function formatTanggalShort(tanggal) {
        if (!tanggal) return '–';
        const d = new Date(tanggal);
        return d.toLocaleDateString('id-ID', { day: 'numeric', month: 'short', year: 'numeric' });
    }

    // ===================== FILTER =====================
    function setFilterKategori(kategori, el) {
        filterKategoriAktif = kategori;
        document.querySelectorAll('.filter-pill').forEach(p => p.classList.remove('active'));
        if (el) el.classList.add('active');
        filterBerita();
    }

    function filterBerita() {
        const q = (document.getElementById('searchBerita')?.value || '').toLowerCase().trim();
        const posts = getBlogPublished();

        const filtered = posts.filter(p => {
            const matchKat = filterKategoriAktif === 'Semua' || p.kategori === filterKategoriAktif;
            const matchQ = !q || (p.judul||'').toLowerCase().includes(q)
                            || (p.ringkasan||'').toLowerCase().includes(q)
                            || (p.isi||'').toLowerCase().includes(q)
                            || (p.kategori||'').toLowerCase().includes(q);
            return matchKat && matchQ;
        });

        renderBerita(filtered, posts.length);
    }

    function resetFilter() {
        document.getElementById('searchBerita').value = '';
        filterKategoriAktif = 'Semua';
        document.querySelectorAll('.filter-pill').forEach(p => {
            p.classList.toggle('active', p.dataset.kategori === 'Semua');
        });
        filterBerita();
    }

    // ===================== RENDER CARDS =====================
    function renderBerita(posts, total) {
        const grid = document.getElementById('beritaGrid');
        const emptyState = document.getElementById('beritaEmptyState');
        const noResult = document.getElementById('beritaNoResult');
        const countInfo = document.getElementById('beritaCountInfo');

        grid.innerHTML = '';
        emptyState.style.display = 'none';
        noResult.style.display = 'none';

        if (total === 0) {
            emptyState.style.display = 'block';
            countInfo.textContent = '';
            return;
        }
        if (posts.length === 0) {
            noResult.style.display = 'block';
            countInfo.textContent = '';
            return;
        }

        countInfo.textContent = posts.length + ' berita ditemukan';

        posts.forEach(post => {
            const thumbHtml = post.gambar
                ? `<img src="${post.gambar}" class="news-thumb" alt="${post.judul}" onclick="bukaDetal('${post.id}')">`
                : `<div class="news-thumb-placeholder" onclick="bukaDetal('${post.id}')">
                        <div class="text-center px-3">
                            <span style="font-size:32px;opacity:0.5;display:block;margin-bottom:6px;"><i class="bi bi-newspaper"></i></span>
                            <span>${post.kategori || 'Berita Sekolah'}</span>
                        </div>
                   </div>`;

            const col = document.createElement('div');
            col.className = 'col-lg-4 col-md-6';
            col.innerHTML = `
                <div class="news-card" onclick="bukaDetal('${post.id}')">
                    ${thumbHtml}
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <span class="text-muted" style="font-size:12px;"><i class="bi bi-calendar-event me-1"></i> ${formatTanggalShort(post.tanggal)}</span>
                            <span class="text-muted" style="font-size:11px;">•</span>
                            <span class="kategori-badge">${post.kategori || 'Umum'}</span>
                        </div>
                        <h3 class="h5 fw-bold text-dark mb-2" style="line-height:1.35;font-size:15.5px;">${post.judul}</h3>
                        <p class="text-secondary mb-3" style="font-size:13px;line-height:1.6;display:-webkit-box;-webkit-line-clamp:3;-webkit-box-orient:vertical;overflow:hidden;">${post.ringkasan}</p>
                        <span class="read-more-link">Baca Selengkapnya <i class="bi bi-arrow-right"></i></span>
                    </div>
                </div>`;
            grid.appendChild(col);
        });
    }

    // ===================== DETAIL MODAL =====================
    function bukaDetal(id) {
        const posts = JSON.parse(localStorage.getItem(BLOG_KEY) || '[]');
        const post = posts.find(p => p.id === id);
        if (!post) return;
        currentDetailId = id;

        const modal = document.getElementById('modalDetailBerita');
        const box = document.getElementById('modalDetailBeritaBox');

        // Hero / Thumbnail
        const heroHtml = post.gambar
            ? `<img src="${post.gambar}" class="modal-hero-img" alt="${post.judul}">`
            : `<div class="modal-hero-placeholder"><i class="bi bi-newspaper text-muted" style="font-size: 48px;"></i></div>`;

        // Galeri tambahan
        let galeriHtml = '';
        if (post.gambarTambahan && post.gambarTambahan.length > 0) {
            galeriHtml = `
                <div class="px-4 pb-2">
                    <div class="fw-semibold mb-2" style="font-size:13px;color:#64748b;"><i class="bi bi-images me-1"></i> Galeri Foto (${post.gambarTambahan.length} gambar)</div>
                    <div class="row g-2 modal-galeri">
                        ${post.gambarTambahan.map((src, i) => `
                            <div class="col-4 col-md-3">
                                <img src="${src}" alt="Gambar ${i+1}" onclick="bukaLightbox('${src.replace(/'/g, "\\'")}')">
                            </div>
                        `).join('')}
                    </div>
                    <hr style="border-color:#f1f5f9;">
                </div>
            `;
        }

        box.innerHTML = `
            ${heroHtml}
            <div class="p-4 pb-2">
                <div class="d-flex align-items-center gap-2 flex-wrap mb-3">
                    <span class="kategori-badge" style="font-size:11px;">${post.kategori || 'Umum'}</span>
                    <span class="text-muted" style="font-size:12.5px;">&#128197; ${formatTanggal(post.tanggal)}</span>
                </div>
                <h2 class="fw-bold text-dark mb-3" style="font-size:22px;line-height:1.3;">${post.judul}</h2>
                <p class="text-secondary mb-4" style="font-size:14px;line-height:1.7;border-left:4px solid var(--teal-primary);padding-left:14px;background:#f0fdfa;padding:12px 14px;border-radius:0 8px 8px 0;">${post.ringkasan}</p>
                <hr style="border-color:#f1f5f9;">
            </div>
            ${galeriHtml}
            <div class="px-4 pb-5">
                <div class="article-body">${post.isi || ''}</div>
            </div>
            <div class="px-4 pb-5 pt-0">
                <button class="btn btn-outline-teal rounded-pill fw-semibold" onclick="tutupDetailBerita()" style="font-size:13px;padding:8px 24px;">
                    <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar Berita
                </button>
            </div>
        `;

        modal.classList.add('show');
        document.body.style.overflow = 'hidden';
    }

    function tutupDetailBerita() {
        document.getElementById('modalDetailBerita').classList.remove('show');
        document.body.style.overflow = '';
        currentDetailId = null;
    }

    // ===================== LIGHTBOX =====================
    function bukaLightbox(src) {
        document.getElementById('lightboxImg').src = src;
        document.getElementById('lightbox').classList.add('show');
    }
    function tutupLightbox() {
        document.getElementById('lightbox').classList.remove('show');
    }

    // ===================== KEYBOARD ESC =====================
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            tutupDetailBerita();
            tutupLightbox();
        }
    });

    // ===================== INIT =====================
    window.addEventListener('load', function() {
        filterBerita();
    });

    // Listen for localStorage changes (if admin updates in another tab)
    window.addEventListener('storage', function(e) {
        if (e.key === BLOG_KEY) {
            filterBerita();
        }
    });
    </script>
</body>
</html>