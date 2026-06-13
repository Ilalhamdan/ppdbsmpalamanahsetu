<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeri - SMP AL-AMANAH</title>
    <meta name="description" content="Galeri foto fasilitas dan ekstrakurikuler SMP Al-Amanah — dokumentasi kegiatan, fasilitas sekolah, dan kegiatan siswa.">

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

        /* Filter Tabs */
        .filter-tab {
            border: 1.5px solid #e2e8f0; background: #fff; color: #475569;
            border-radius: 20px; padding: 6px 20px; font-size: 13px; font-weight: 600;
            cursor: pointer; transition: all 0.2s; white-space: nowrap;
        }
        .filter-tab:hover, .filter-tab.active {
            background: var(--teal-primary); color: #fff; border-color: var(--teal-primary);
        }

        /* Section Heading */
        .section-heading {
            font-size: 16px; font-weight: 700; color: var(--teal-dark);
            display: flex; align-items: center; gap: 8px; margin-bottom: 16px;
            padding-bottom: 10px; border-bottom: 2px solid var(--teal-light);
        }

        /* Gallery Card */
        .galeri-card {
            background: #fff;
            border-radius: 16px;
            border: none;
            box-shadow: 0 2px 12px rgba(15,118,110,0.07);
            overflow: hidden;
            cursor: pointer;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            height: 100%;
        }
        .galeri-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 14px 32px rgba(13,148,136,0.15);
        }
        .galeri-card-img {
            width: 100%; aspect-ratio: 1 / 1; object-fit: cover;
            border-bottom: 1px solid #f1f5f9; display: block;
        }
        .galeri-card-placeholder {
            width: 100%; aspect-ratio: 1 / 1;
            background: linear-gradient(135deg, var(--teal-light) 0%, #a7f3d0 100%);
            display: flex; flex-direction: column; align-items: center; justify-content: center;
            color: var(--teal-primary); font-weight: 600; font-size: 13px; gap: 8px;
        }
        .kategori-badge {
            font-size: 10.5px; font-weight: 700; padding: 3px 10px;
            border-radius: 20px; background: var(--teal-extra-light);
            color: var(--teal-primary); border: 1px solid var(--teal-light);
            text-transform: uppercase; letter-spacing: 0.3px;
        }
        .kategori-badge.ekstra {
            background: #f0fdf4; color: #15803d; border-color: #bbf7d0;
        }

        /* Empty State */
        .empty-state { text-align: center; padding: 60px 20px; }

        /* Lightbox */
        .lightbox {
            display: none; position: fixed; inset: 0; z-index: 19999;
            background: rgba(0,0,0,0.9); align-items: center; justify-content: center;
            flex-direction: column; gap: 12px;
        }
        .lightbox.show { display: flex; }
        .lightbox img { max-width: 90vw; max-height: 82vh; border-radius: 10px; object-fit: contain; }
        .lightbox-caption {
            color: #fff; font-size: 14px; font-weight: 600;
            background: rgba(0,0,0,0.5); padding: 6px 18px; border-radius: 20px;
        }
        .lightbox-close {
            position: fixed; top: 20px; right: 24px; background: rgba(255,255,255,0.15);
            color: #fff; border: none; border-radius: 50%; width: 40px; height: 40px;
            font-size: 20px; cursor: pointer; display: flex; align-items: center; justify-content: center;
            transition: background 0.2s;
        }
        .lightbox-close:hover { background: rgba(255,255,255,0.3); }
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
                    <h1 class="mb-0 fw-bold text-dark" style="font-size: 16px; letter-spacing: 0.6px;">SMP AL-AMANAH</h1>
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
                    <a href="{{ url('/berita') }}" class="nav-link p-0 {{ Request::is('berita') ? 'text-teal-primary border-bottom border-2 border-teal-primary pb-1' : 'text-secondary text-teal-hover' }}">Berita</a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/galeri') }}" class="nav-link p-0 text-teal-primary border-bottom border-2 border-teal-primary pb-1">Galeri</a>
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
                <span class="badge px-3 py-2 rounded-pill fw-semibold mb-2" style="background:var(--teal-extra-light);color:var(--teal-primary);font-size:12px;">Dokumentasi Sekolah</span>
                <h2 class="fw-bold text-dark mb-2" style="font-size:28px;">Galeri Fasilitas & Ekstrakurikuler</h2>
                <div class="bg-teal-primary rounded mb-3" style="width: 50px; height: 4px;"></div>
                <p class="text-muted" style="font-size:14px;max-width:520px;">Jelajahi foto-foto fasilitas unggulan dan kegiatan ekstrakurikuler SMP Al-Amanah yang mendukung tumbuh kembang siswa secara optimal.</p>
            </div>

            {{-- FILTER & SEARCH BAR --}}
            <div class="d-flex flex-column flex-md-row align-items-md-center gap-3 mb-5">
                {{-- Filter Tabs --}}
                <div class="d-flex flex-wrap gap-2" id="filterTabs">
                    <button class="filter-tab active" data-filter="Semua" onclick="setFilterGaleri('Semua', this)">Semua</button>
                    <button class="filter-tab" data-filter="Fasilitas" onclick="setFilterGaleri('Fasilitas', this)"><i class="bi bi-building me-1"></i> Fasilitas</button>
                    <button class="filter-tab" data-filter="Ekstrakurikuler" onclick="setFilterGaleri('Ekstrakurikuler', this)"><i class="bi bi-trophy me-1"></i> Ekstrakurikuler</button>
                </div>
                {{-- Search Box --}}
                <div class="ms-md-auto" style="position:relative;min-width:260px;max-width:340px;width:100%;">
                    <i class="bi bi-search" style="position:absolute;left:13px;top:50%;transform:translateY(-50%);color:#94a3b8;font-size:14px;pointer-events:none;"></i>
                    <input type="text" id="searchGaleriPublic" class="form-control" placeholder="Cari nama fasilitas atau ekstra..."
                        oninput="renderGaleriPublic()"
                        style="padding-left:38px;border-radius:12px;border:1.5px solid #e2e8f0;font-size:13.5px;height:42px;background:#fff;transition:all 0.2s;">
                </div>
                {{-- Count Info --}}
                <div class="text-muted text-nowrap" style="font-size:12.5px;" id="galeriCountInfo"></div>
            </div>

            {{-- FASILITAS SECTION --}}
            <div id="sectionFasilitas" class="mb-5">
                <div class="section-heading">
                    <span><i class="bi bi-building me-1"></i></span> Fasilitas Sekolah
                    <span id="countFasilitas" class="ms-auto text-muted fw-normal" style="font-size:12px;"></span>
                </div>
                <div class="row g-3 row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-5" id="gridFasilitas">
                    {{-- Rendered by JS --}}
                </div>
                <div id="emptyFasilitas" class="empty-state" style="display:none;">
                    <div style="font-size:56px;opacity:0.35;margin-bottom:12px;"><i class="bi bi-building text-muted"></i></div>
                    <h5 class="fw-bold text-dark">Belum Ada Data Fasilitas</h5>
                    <p class="text-muted" style="font-size:13px;">Data fasilitas sekolah akan tampil di sini setelah admin menambahkan melalui panel.</p>
                </div>
            </div>

            {{-- EKSTRAKURIKULER SECTION --}}
            <div id="sectionEkstrakurikuler">
                <div class="section-heading">
                    <span><i class="bi bi-trophy me-1"></i></span> Ekstrakurikuler
                    <span id="countEkstrakurikuler" class="ms-auto text-muted fw-normal" style="font-size:12px;"></span>
                </div>
                <div class="row g-3 row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-5" id="gridEkstrakurikuler">
                    {{-- Rendered by JS --}}
                </div>
                <div id="emptyEkstrakurikuler" class="empty-state" style="display:none;">
                    <div style="font-size:56px;opacity:0.35;margin-bottom:12px;"><i class="bi bi-trophy text-muted"></i></div>
                    <h5 class="fw-bold text-dark">Belum Ada Data Ekstrakurikuler</h5>
                    <p class="text-muted" style="font-size:13px;">Data ekstrakurikuler sekolah akan tampil di sini setelah admin menambahkan melalui panel.</p>
                </div>
            </div>

        </div>
    </main>

    <!-- FOOTER -->
    <footer class="text-white py-5 mt-auto" style="background-color: #0d5d56; border-top: 4px solid var(--amber-accent);">
        <div class="container-fluid px-4 px-md-5">
            <div class="row g-4 justify-content-between">
                <div class="col-lg-4 col-md-6">
                    <h5 class="fw-bold text-white mb-3" style="font-size: 16px;">SMP Al-Amanah</h5>
                    <p class="small text-white-50" style="line-height: 1.8;">
                        Sekolah Menengah Pertama Islam Terpadu terbaik dengan kurikulum nasional dan nilai-nilai Islami. Mewujudkan generasi berprestasi, berkarakter mulia, dan berwawasan global.
                    </p>
                </div>
            </div>
        </div>
    </footer>

    {{-- LIGHTBOX --}}
    <div class="lightbox" id="lightboxGaleri" onclick="tutupLightboxGaleri()">
        <button class="lightbox-close" onclick="tutupLightboxGaleri()"><i class="bi bi-x-lg"></i></button>
        <img id="lightboxGaleriImg" src="" alt="Preview Galeri">
        <div class="lightbox-caption" id="lightboxGaleriCaption"></div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    const GALERI_KEY = 'ppdb_gallery_items';
    let filterAktif = 'Semua';

    function getGaleriPublic() {
        try { return JSON.parse(localStorage.getItem(GALERI_KEY)) || []; } catch(e) { return []; }
    }

    function setFilterGaleri(filter, el) {
        filterAktif = filter;
        document.querySelectorAll('.filter-tab').forEach(t => t.classList.remove('active'));
        if (el) el.classList.add('active');

        const secFas = document.getElementById('sectionFasilitas');
        const secEks = document.getElementById('sectionEkstrakurikuler');

        if (filter === 'Fasilitas') {
            secFas.style.display = 'block';
            secEks.style.display = 'none';
        } else if (filter === 'Ekstrakurikuler') {
            secFas.style.display = 'none';
            secEks.style.display = 'block';
        } else {
            secFas.style.display = 'block';
            secEks.style.display = 'block';
        }
        renderGaleriPublic();
    }

    function renderGaleriPublic() {
        const all = getGaleriPublic();
        const q = (document.getElementById('searchGaleriPublic')?.value || '').toLowerCase().trim();

        // --- FASILITAS ---
        let fasilitas = all.filter(i => i.kategori === 'Fasilitas');
        if (q) fasilitas = fasilitas.filter(i => (i.nama || '').toLowerCase().includes(q));
        const gridFas = document.getElementById('gridFasilitas');
        const emptyFas = document.getElementById('emptyFasilitas');
        const countFas = document.getElementById('countFasilitas');

        if (fasilitas.length === 0) {
            gridFas.innerHTML = '';
            emptyFas.style.display = 'block';
            countFas.textContent = '';
        } else {
            emptyFas.style.display = 'none';
            countFas.textContent = fasilitas.length + ' item';
            gridFas.innerHTML = fasilitas.map(item => buildGaleriCard(item)).join('');
        }

        // --- EKSTRAKURIKULER ---
        let ekstra = all.filter(i => i.kategori === 'Ekstrakurikuler');
        if (q) ekstra = ekstra.filter(i => (i.nama || '').toLowerCase().includes(q));
        const gridEks = document.getElementById('gridEkstrakurikuler');
        const emptyEks = document.getElementById('emptyEkstrakurikuler');
        const countEks = document.getElementById('countEkstrakurikuler');

        if (ekstra.length === 0) {
            gridEks.innerHTML = '';
            emptyEks.style.display = 'block';
            countEks.textContent = '';
        } else {
            emptyEks.style.display = 'none';
            countEks.textContent = ekstra.length + ' item';
            gridEks.innerHTML = ekstra.map(item => buildGaleriCard(item)).join('');
        }

        // --- TOTAL COUNT INFO ---
        const total = fasilitas.length + ekstra.length;
        const countInfo = document.getElementById('galeriCountInfo');
        if (countInfo) countInfo.textContent = q ? total + ' hasil ditemukan' : '';
    }

    function buildGaleriCard(item) {
        const isEkstra = item.kategori === 'Ekstrakurikuler';
        const safeName = (item.nama || '').replace(/'/g, "\\'");

        const fotoHtml = item.foto
            ? `<img src="${item.foto}" alt="${item.nama}" class="galeri-card-img" onclick="bukaLightboxGaleri('${item.foto.replace(/'/g,"\\'")}', '${safeName}')">`
            : `<div class="galeri-card-placeholder" onclick="void(0)">
                    <span style="font-size:40px;opacity:0.5;">${isEkstra ? '<i class="bi bi-trophy text-muted"></i>' : '<i class="bi bi-building text-muted"></i>'}</span>
                    <span>${isEkstra ? 'Foto Ekstrakurikuler' : 'Foto Fasilitas'}</span>
               </div>`;

        return `
        <div class="col">
            <div class="galeri-card">
                ${fotoHtml}
                <div class="p-3">
                    <span class="kategori-badge ${isEkstra ? 'ekstra' : ''}">${item.kategori}</span>
                    <h3 class="h6 fw-bold text-dark mb-0 mt-2" style="line-height:1.35;">${item.nama}</h3>
                </div>
            </div>
        </div>`;
    }

    function bukaLightboxGaleri(src, caption) {
        document.getElementById('lightboxGaleriImg').src = src;
        document.getElementById('lightboxGaleriCaption').textContent = caption;
        document.getElementById('lightboxGaleri').classList.add('show');
        document.body.style.overflow = 'hidden';
    }

    function tutupLightboxGaleri() {
        document.getElementById('lightboxGaleri').classList.remove('show');
        document.body.style.overflow = '';
    }

    document.addEventListener('keydown', e => { if (e.key === 'Escape') tutupLightboxGaleri(); });

    window.addEventListener('load', renderGaleriPublic);
    window.addEventListener('storage', e => { if (e.key === GALERI_KEY) renderGaleriPublic(); });
    </script>
</body>
</html>