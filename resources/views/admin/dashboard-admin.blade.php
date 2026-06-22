<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - PPDB SMP AL-AMANAH</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    @vite(['resources/css/app.css'])

    <style>
        :root {
            --toska-50: #f0fdfa;
            --toska-100: #ccfbf1;
            --toska-200: #99f6e4;
            --toska-400: #2dd4bf;
            --toska-500: #14b8a6;
            --toska-600: #0d9488;
            --toska-700: #0f766e;
            --toska-800: #115e59;
            --toska-900: #134e4a;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--toska-50);
            color: #1e293b;
            overflow-x: hidden;
        }

        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-thumb {
            background: var(--toska-300, #5eead4);
            border-radius: 4px;
        }

        /* Sidebar */
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(180deg, var(--toska-800) 0%, var(--toska-900) 100%);
            border-right: 1px solid var(--toska-700);
            z-index: 1030;
            box-shadow: 4px 0 24px rgba(13, 148, 136, 0.15);
        }

        .sidebar .nav-link {
            color: var(--toska-200);
            font-weight: 500;
            padding: 0.75rem 1.1rem;
            border-radius: 0.5rem;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            border-left: 3px solid transparent;
            font-size: 13px;
        }

        .sidebar .nav-link:hover {
            background: rgba(45, 212, 191, 0.1);
            color: #fff;
            border-left-color: var(--toska-400);
            transform: translateX(2px);
        }

        .sidebar .nav-link.active {
            background: rgba(20, 184, 166, 0.2);
            color: #fff;
            font-weight: 600;
            border-left-color: var(--toska-400);
        }

        .submenu-item {
            padding-left: 2.6rem !important;
            font-size: 12px;
        }

        /* Topbar */
        .topbar-header {
            background: #fff;
            border-bottom: 1px solid var(--toska-100);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.04);
        }

        /* Cards */
        .card-kustom-toska {
            background: linear-gradient(135deg, var(--toska-700) 0%, var(--toska-800) 100%);
            color: #fff;
            border-radius: 14px;
            padding: 18px 20px;
            border: none;
            box-shadow: 0 4px 14px rgba(13, 148, 136, 0.18);
            transition: all 0.2s;
        }

        .card-kustom-toska:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(13, 148, 136, 0.25);
        }

        .card-kustom-toska h5 {
            font-size: 11.5px;
            font-weight: 600;
            color: var(--toska-200);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 4px;
        }

        .card-value {
            font-size: 28px;
            font-weight: 800;
            color: #fff;
            line-height: 1;
        }

        .card-icon-circle {
            width: 48px;
            height: 48px;
            background: rgba(255, 255, 255, 0.12);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            flex-shrink: 0;
        }

        /* Panel */
        .panel-kustom {
            background: #fff;
            border: 1px solid var(--toska-100);
            border-radius: 14px;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(13, 148, 136, 0.04);
            margin-bottom: 20px;
        }

        .panel-title {
            font-size: 14px;
            font-weight: 700;
            color: var(--toska-800);
            border-bottom: 1px solid var(--toska-100);
            padding-bottom: 10px;
            margin-bottom: 14px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* Table */
        .table-kustom thead th {
            background-color: var(--toska-50);
            color: var(--toska-800);
            font-size: 11.5px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 2px solid var(--toska-100);
            padding: 10px 14px;
        }

        .table-kustom tbody td {
            font-size: 12.5px;
            padding: 10px 14px;
            vertical-align: middle;
            border-bottom: 1px solid #f1f5f9;
        }

        .table-kustom tbody tr:hover {
            background-color: var(--toska-50);
        }

        .table-kustom tbody tr:last-child td {
            border-bottom: none;
        }

        /* Badges */
        .badge-success {
            background: #dcfce7;
            color: #16a34a;
            border: 1px solid #bbf7d0;
        }

        .badge-warning {
            background: #fef9c3;
            color: #b45309;
            border: 1px solid #fde68a;
        }

        .badge-danger {
            background: #fee2e2;
            color: #dc2626;
            border: 1px solid #fecdd3;
        }

        .badge-info {
            background: #e0f2fe;
            color: #0369a1;
            border: 1px solid #bae6fd;
        }

        .badge-secondary {
            background: #f1f5f9;
            color: #475569;
            border: 1px solid #e2e8f0;
        }

        .status-badge {
            font-size: 10px;
            font-weight: 600;
            padding: 3px 10px;
            border-radius: 20px;
        }

        /* Filter Card */
        .card-filter {
            background: #fff;
            border: 1px solid var(--toska-100);
            border-radius: 12px;
            padding: 14px 16px;
        }

        .card-filter h6 {
            font-size: 10.5px;
            font-weight: 700;
            color: var(--toska-800);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
        }

        .card-filter .form-control,
        .card-filter .form-select {
            border-color: var(--toska-100);
            font-size: 13px;
            padding: 7px 12px;
            border-radius: 8px;
        }

        .card-filter .form-control:focus,
        .card-filter .form-select:focus {
            border-color: var(--toska-400);
            box-shadow: 0 0 0 3px rgba(45, 212, 191, 0.15);
        }

        /* Buttons */
        .btn-toska {
            background: linear-gradient(135deg, var(--toska-600), var(--toska-700));
            color: #fff;
            border: none;
            font-weight: 600;
            font-size: 12.5px;
            border-radius: 8px;
        }

        .btn-toska:hover {
            background: linear-gradient(135deg, var(--toska-500), var(--toska-600));
            color: #fff;
        }

        .btn-icon {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background: var(--toska-50);
            border: 1px solid var(--toska-100);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            cursor: pointer;
            position: relative;
            transition: all 0.2s;
        }

        .btn-icon:hover {
            background: var(--toska-100);
        }

        /* SPA sections */
        .spa-section {
            display: none;
        }

        .spa-section.active {
            display: block;
        }

        /* Profile Avatar */
        .profile-avatar {
            width: 38px;
            height: 38px;
            background: linear-gradient(135deg, var(--toska-600), var(--toska-800));
            color: #fff;
            font-size: 13px;
            font-weight: 700;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Modal backdrop */
        .custom-modal-backdrop {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 10000;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(3px);
        }

        .custom-modal-box {
            background: #fff;
            border-radius: 16px;
            padding: 28px;
            width: 480px;
            max-width: 95vw;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
            animation: fadeInUp 0.2s ease;
        }

        /* Notification Panel */
        .admin-notif-panel {
            position: fixed;
            top: 62px;
            right: 20px;
            width: 340px;
            background: #fff;
            border-radius: 14px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
            border: 1px solid #e2e8f0;
            z-index: 2000;
            display: none;
        }

        .admin-notif-panel.show {
            display: block;
        }

        .notif-item {
            padding: 12px 16px;
            border-bottom: 1px solid #f1f5f9;
            cursor: pointer;
            transition: background 0.15s;
        }

        .notif-item.unread {
            background: #f0fdf4;
        }

        .notif-item:hover {
            background: #f8fafc;
        }

        .notif-count-badge {
            position: absolute;
            top: -4px;
            right: -4px;
            background: #ef4444;
            color: #fff;
            font-size: 9px;
            font-weight: 700;
            border-radius: 10px;
            padding: 1px 5px;
            min-width: 18px;
            text-align: center;
            border: 1.5px solid #fff;
            display: none;
        }

        .notif-count-badge.show {
            display: block;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(12px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /* ===== HAMBURGER BUTTON (hanya mobile) ===== */
        .hamburger-btn-admin {
            display: none;
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background: #f0fdfa;
            border: 1px solid var(--toska-200, #99f6e4);
            align-items: center;
            justify-content: center;
            font-size: 18px;
            cursor: pointer;
            color: var(--toska-700);
            transition: all 0.2s;
            flex-shrink: 0;
        }
        .hamburger-btn-admin:hover {
            background: var(--toska-100, #ccfbf1);
            border-color: var(--toska-400, #2dd4bf);
        }

        /* ===== SIDEBAR OVERLAY ADMIN ===== */
        .sidebar-overlay-admin {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.45);
            z-index: 1029;
            backdrop-filter: blur(2px);
        }
        .sidebar-overlay-admin.active { display: block; }

        /* ===== RESPONSIVE MOBILE ADMIN ===== */
        @media (max-width: 768px) {

            /* --- Sidebar: overlay mode --- */
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                z-index: 1030;
            }
            .sidebar.open {
                transform: translateX(0);
                box-shadow: 6px 0 30px rgba(0, 0, 0, 0.25);
            }

            /* --- Main content: no left margin --- */
            .flex-grow-1[style*="margin-left"] {
                margin-left: 0 !important;
            }

            /* --- Topbar --- */
            .topbar-header {
                padding: 0.6rem 0.85rem;
                gap: 8px;
            }
            .topbar-header h1 {
                font-size: 14px !important;
            }
            .topbar-header .text-muted {
                display: none;
            }

            /* --- Tampilkan hamburger --- */
            .hamburger-btn-admin {
                display: flex;
            }

            /* --- Card stats: 2 kolom --- */
            .row.g-3 > .col-md-3 {
                flex: 0 0 50%;
                max-width: 50%;
            }

            /* --- Panel konten: padding lebih kecil --- */
            .p-4 {
                padding: 0.85rem !important;
            }

            /* --- Tabel: horizontal scroll --- */
            .table-responsive {
                overflow-x: auto;
            }

            /* --- Form grid: vertikal --- */
            .row > .col-md-4,
            .row > .col-md-5,
            .row > .col-md-6,
            .row > .col-md-8,
            .row > .col-md-12,
            .row > .col-lg-5,
            .row > .col-lg-7 {
                flex: 0 0 100%;
                max-width: 100%;
            }

            /* --- Filter card: stack --- */
            .card-filter {
                margin-bottom: 0.5rem;
            }

            /* --- Notif panel admin: full width --- */
            .admin-notif-panel {
                width: calc(100vw - 24px);
                right: 12px;
                left: 12px;
            }

            /* --- Chart canvas: full width --- */
            #chartJalur {
                max-width: 100%;
            }

            /* --- Modal: full width --- */
            .custom-modal-box {
                width: 95vw;
                padding: 18px;
            }

            /* --- Topbar reset data btn --- */
            .topbar-header .btn-sm {
                font-size: 10px !important;
                padding: 3px 7px !important;
            }
        }

        /* ===== TABLET ADMIN (768px - 1024px) ===== */
        @media (min-width: 769px) and (max-width: 1024px) {
            .sidebar {
                width: 220px;
            }
            .flex-grow-1[style*="margin-left"] {
                margin-left: 220px !important;
            }
            .row.g-3 > .col-md-3 {
                flex: 0 0 50%;
                max-width: 50%;
            }
        }
    </style>
</head>

<body>

    {{-- Sidebar Overlay (mobile) --}}
    <div class="sidebar-overlay-admin" id="sidebarOverlayAdmin" onclick="closeSidebarAdmin()"></div>

    <div class="container-fluid p-0">
        <div class="d-flex">

            {{-- ===================== SIDEBAR ===================== --}}
            <div class="sidebar px-3 py-4 position-fixed start-0 top-0 bottom-0 text-white"
                style="width:270px;height:100%;overflow-y:auto;">
                <div class="d-flex align-items-center gap-3 mb-4 px-2">
                    <div class="rounded p-1 d-flex align-items-center justify-content-center bg-white"
                        style="width:42px;height:42px;min-width:42px;">
                        <img src="{{ asset('logo.png') }}" alt="Logo"
                            style="width:100%;height:100%;object-fit:contain;">
                    </div>
                    <div>
                        <h2 class="fw-bold text-white mb-0" style="font-size:14.5px;">PPDB AL-AMANAH</h2>
                        <span
                            style="font-size:10px;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:#5eead4;">Panel
                            Administrator</span>
                    </div>
                </div>
                <hr class="border-secondary opacity-25 mb-3">

                <ul class="nav flex-column gap-1">
                    <li class="nav-item">
                        <a class="nav-link active" id="linkAdminDashboard" href="#"
                            onclick="switchSection('AdminDashboard');return false;">
                            <i class="bi bi-grid-1x2-fill me-3 fs-5"></i> Dashboard Utama
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex justify-content-between align-items-center"
                            id="linkPendaftaranDropdown" href="#"
                            onclick="toggleMenu('menuPendaftaranSub','pendaftaranCaret');return false;">
                            <div class="d-flex align-items-center"><i
                                    class="bi bi-file-earmark-text-fill me-3 fs-5"></i> Pendaftaran</div>
                            <span id="pendaftaranCaret" style="font-size:9px;"><i class="bi bi-chevron-down"></i></span>
                        </a>
                        <ul class="nav flex-column gap-1 mt-1" id="menuPendaftaranSub"
                            style="max-height:0;opacity:0;overflow:hidden;padding-left:8px;transition:max-height 0.3s,opacity 0.3s;">
                            <li><a class="nav-link submenu-item" id="linkDataPendaftar" href="#"
                                    onclick="switchSection('DataPendaftar');return false;">• Data Pendaftar</a></li>
                            <li><a class="nav-link submenu-item" id="linkVerifikasiFormulir" href="#"
                                    onclick="switchSection('VerifikasiFormulir');return false;">• Verifikasi
                                    Formulir</a></li>
                            <li><a class="nav-link submenu-item" id="linkVerifikasiBerkas" href="#"
                                    onclick="switchSection('VerifikasiBerkas');return false;">• Verifikasi Berkas</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="linkPembayaranAdmin" href="#"
                            onclick="switchSection('PembayaranAdmin');return false;">
                            <i class="bi bi-credit-card-2-back-fill me-3 fs-5"></i> Pembayaran
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="linkSeleksiAdmin" href="#"
                            onclick="switchSection('SeleksiAdmin');return false;">
                            <i class="bi bi-award-fill me-3 fs-5"></i> Penilaian &amp; Seleksi
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="linkKelolaBerita" href="#"
                            onclick="switchSection('KelolaBerita');return false;">
                            <i class="bi bi-newspaper me-3 fs-5"></i> Kelola Berita
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="linkKelolaKontenHome" href="#"
                            onclick="switchSection('KelolaKontenHome');return false;">
                            <i class="bi bi-house-heart-fill me-3 fs-5"></i> Konten Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="linkKelolaGaleri" href="#"
                            onclick="switchSection('KelolaGaleri');return false;">
                            <i class="bi bi-images me-3 fs-5"></i> Kelola Galeri
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" id="linkPengaturanSistem" href="#"
                            onclick="switchSection('PengaturanSistem');return false;">
                            <i class="bi bi-gear-fill me-3 fs-5"></i> Pengaturan Sistem
                        </a>
                    </li>
                    <li class="nav-item mt-4 pt-3 border-top border-secondary border-opacity-25">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a class="nav-link text-danger" href="{{ route('logout') }}"
                                onclick="event.preventDefault();this.closest('form').submit();"
                                style="font-weight:600;">
                                <i class="bi bi-box-arrow-right me-3 fs-5"></i> Keluar Panel
                            </a>
                        </form>
                    </li>
                </ul>

                <div class="mt-auto pt-5 px-2">
                    <div class="bg-dark bg-opacity-25 rounded-3 p-3 text-center"
                        style="border:1px solid rgba(94,234,212,0.15);">
                        <span class="d-block fw-bold" style="font-size:10px;letter-spacing:0.5px;color:#5eead4;">TAHUN
                            AJARAN</span>
                        <span class="text-white fw-bold d-block"
                            style="font-size:12px;">{{ $sys_settings['tahun_ajaran_tampil'] ?? '2026 / 2027' }}</span>
                    </div>
                </div>
            </div>

            {{-- ===================== MAIN CONTENT ===================== --}}
            <div class="flex-grow-1" style="margin-left:270px;min-height:100vh;overflow-x:hidden;">

                {{-- TOPBAR --}}
                <div class="topbar-header d-flex justify-content-between align-items-center px-3 px-md-4 py-3 sticky-top">
                    <div class="d-flex align-items-center flex-grow-1 text-truncate pe-2">
                        {{-- Hamburger button (hanya tampil di mobile) --}}
                        <button class="hamburger-btn-admin me-2" id="hamburgerBtnAdmin" type="button" onclick="toggleSidebarAdmin()" aria-label="Buka Menu">
                            <i class="bi bi-list"></i>
                        </button>
                        <div class="text-truncate">
                            <h1 class="fw-bold text-dark mb-0 text-truncate" id="currentPageTitle"
                                style="font-size:18px;color:var(--toska-900) !important;">Dashboard Utama</h1>
                            <span class="text-muted d-none d-md-block" style="font-size:11px;font-weight:500;">PPDB SMP AL-AMANAH | Sistem
                                Terintegrasi</span>
                        </div>
                    </div>
                    
                    <div class="d-flex align-items-center gap-2 gap-md-3">
                        <button class="btn btn-sm btn-outline-danger d-flex align-items-center gap-1"
                            onclick="if(confirm('Semua sisa data simulasi di browser Anda akan dihapus untuk memulai pengujian dari awal. Lanjutkan?')) { localStorage.clear(); window.location.reload(); }"
                            style="font-weight:600; border-radius:8px; font-size:11px; padding: 4px 8px;"
                            title="Bersihkan sisa data simulasi di browser">
                            <i class="bi bi-trash3-fill"></i> <span class="d-none d-sm-inline">Reset</span>
                        </button>
                        <div class="btn-icon position-relative" onclick="toggleAdminNotif()" style="width: 34px; height: 34px; font-size: 15px;">
                            <span><i class="bi bi-bell"></i></span>
                            <span id="adminNotifBadge" class="notif-count-badge">0</span>
                        </div>
                        <div class="d-flex align-items-center gap-2 ps-2 ps-md-3 border-start border-light-subtle">
                            <div class="profile-avatar" style="width: 34px; height: 34px; font-size: 12px;">AD</div>
                            <div class="d-none d-sm-block">
                                <h6 class="fw-bold text-dark mb-0" style="font-size:13px;">{{ $siswa->name }}</h6>
                                <span class="text-muted d-block" style="font-size:10px;font-weight:600;">Panitia
                                    PPDB</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ADMIN NOTIF PANEL --}}
                <div class="admin-notif-panel" id="adminNotifPanel">
                    <div class="d-flex justify-content-between align-items-center px-4 py-3 border-bottom">
                        <span class="fw-bold" style="font-size:13.5px;"><i class="bi bi-bell-fill me-1 text-teal"></i>
                            Notifikasi Admin</span>
                        <button class="btn btn-sm btn-link text-secondary p-0" onclick="markAllAdminRead()"
                            style="font-size:11px;">Tandai semua dibaca</button>
                    </div>
                    <div id="adminNotifList" style="max-height:340px;overflow-y:auto;">
                        <div class="text-center py-4 text-muted" style="font-size:12.5px;" id="adminNotifEmpty">
                            <i class="bi bi-bell-slash text-muted mb-2" style="font-size:24px;display:block;"></i> Belum
                            ada notifikasi
                        </div>
                    </div>
                </div>

                {{-- ==================== CONTENT VIEWS ==================== --}}
                <div class="p-4">

                    {{-- ===== DASHBOARD UTAMA ===== --}}
                    <div id="sectionAdminDashboard" class="spa-section active">
                        <div class="row g-3 mb-4">
                            <div class="col-md-3">
                                <div class="card-kustom-toska d-flex align-items-center justify-content-between">
                                    <div>
                                        <h5>Total Pendaftar</h5>
                                        <div class="card-value" id="statTotalPendaftar">0</div>
                                    </div>
                                    <div class="card-icon-circle"><i class="bi bi-people-fill text-white"></i></div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card-kustom-toska d-flex align-items-center justify-content-between"
                                    style="background:linear-gradient(135deg,#1d4ed8,#1e40af);">
                                    <div>
                                        <h5>Formulir Dikirim</h5>
                                        <div class="card-value" id="statFormulirDikirim">0</div>
                                    </div>
                                    <div class="card-icon-circle"><i
                                            class="bi bi-file-earmark-text-fill text-white"></i></div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card-kustom-toska d-flex align-items-center justify-content-between"
                                    style="background:linear-gradient(135deg,#15803d,#166534);">
                                    <div>
                                        <h5>Formulir Disetujui</h5>
                                        <div class="card-value" id="statFormulirDisetujui">0</div>
                                    </div>
                                    <div class="card-icon-circle"><i class="bi bi-check-circle-fill text-white"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card-kustom-toska d-flex align-items-center justify-content-between"
                                    style="background:linear-gradient(135deg,#d97706,#b45309);">
                                    <div>
                                        <h5>Berkas Disetujui</h5>
                                        <div class="card-value" id="statBerkasDisetujui">0</div>
                                    </div>
                                    <div class="card-icon-circle"><i class="bi bi-folder-fill text-white"></i></div>
                                </div>
                            </div>
                        </div>

                        <div class="row g-4">
                            <div class="col-md-8">
                                <div class="panel-kustom">
                                    <div class="panel-title"><i class="bi bi-bar-chart-line-fill me-1"></i> Rekap
                                        Pendaftaran Per Jalur</div>
                                    <canvas id="chartJalur" height="200"></canvas>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="panel-kustom">
                                    <div class="panel-title"><i class="bi bi-lightning-charge-fill me-1"></i> Aktivitas
                                        Terbaru</div>
                                    <div id="recentActivity" style="max-height:280px;overflow-y:auto;">
                                        <div class="text-center text-muted py-4" style="font-size:12.5px;">Belum ada
                                            aktivitas terbaru</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="panel-kustom mt-4">
                            <div class="panel-title"><i class="bi bi-clipboard-check-fill me-1"></i> Alur Verifikasi
                            </div>
                            <div class="row g-3">
                                <div class="col-md-3">
                                    <div class="text-center p-3 rounded-3"
                                        style="background:#eff6ff;border:1px solid #bfdbfe;">
                                        <i class="bi bi-1-circle-fill text-primary mb-2"
                                            style="font-size:24px;display:block;"></i>
                                        <div class="fw-bold text-primary" style="font-size:13px;">Data Pendaftar</div>
                                        <div class="text-muted" style="font-size:11px;">Lihat semua pendaftar masuk
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="text-center p-3 rounded-3"
                                        style="background:#f0fdf4;border:1px solid #bbf7d0;">
                                        <i class="bi bi-2-circle-fill text-success mb-2"
                                            style="font-size:24px;display:block;"></i>
                                        <div class="fw-bold text-success" style="font-size:13px;">Verifikasi Formulir
                                        </div>
                                        <div class="text-muted" style="font-size:11px;">Review dan setujui/tolak
                                            formulir</div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="text-center p-3 rounded-3"
                                        style="background:#fefce8;border:1px solid #fde68a;">
                                        <i class="bi bi-3-circle-fill text-warning mb-2"
                                            style="font-size:24px;display:block;"></i>
                                        <div class="fw-bold text-warning" style="font-size:13px;">Verifikasi Berkas
                                        </div>
                                        <div class="text-muted" style="font-size:11px;">Periksa kelengkapan dokumen
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="text-center p-3 rounded-3"
                                        style="background:var(--toska-50);border:1px solid var(--toska-200);">
                                        <i class="bi bi-check-circle-fill text-success mb-2"
                                            style="font-size:24px;display:block;"></i>
                                        <div class="fw-bold" style="font-size:13px;color:var(--toska-700);">Akses Kartu
                                            Terbuka</div>
                                        <div class="text-muted" style="font-size:11px;">Siswa bisa cetak kartu ujian
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- ===== DATA PENDAFTAR ===== --}}
                    <div id="sectionDataPendaftar" class="spa-section">
                        <div class="row g-3 mb-4">
                            <div class="col-md-4">
                                <div class="card-filter">
                                    <h6><i class="bi bi-search me-1"></i> Pencarian</h6>
                                    <input type="text" id="searchPendaftar" class="form-control"
                                        placeholder="Cari nama..." onkeyup="renderTablePendaftar()">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card-filter">
                                    <h6><i class="bi bi-funnel-fill me-1"></i> Filter Jalur</h6>
                                    <select id="filterJalurPendaftar" class="form-select"
                                        onchange="renderTablePendaftar()">
                                        <option value="Semua">Semua Jalur</option>
                                        <option value="Reguler">Reguler</option>
                                        <option value="Prestasi">Prestasi</option>
                                        <option value="Tahfidz">Tahfidz</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card-filter">
                                    <h6><i class="bi bi-funnel-fill me-1"></i> Filter Status</h6>
                                    <select id="filterStatusPendaftar" class="form-select"
                                        onchange="renderTablePendaftar()">
                                        <option value="Semua">Semua Status</option>
                                        <option value="Terkirim">Formulir Dikirim</option>
                                        <option value="Disetujui">Formulir Disetujui</option>
                                        <option value="Perlu Revisi">Perlu Revisi</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="panel-kustom">
                            <div class="panel-title d-flex justify-content-between align-items-center">
                                <span><i class="bi bi-people-fill me-1"></i> Daftar Calon Siswa Baru</span>
                                <a href="{{ route('admin.pendaftar.export') }}" class="btn btn-sm btn-success px-3"
                                    style="border-radius:8px; font-weight:bold; background:#10b981; border:none;">
                                    <i class="bi bi-file-earmark-excel-fill me-1"></i> Unduh Data Excel
                                </a>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-kustom text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Pendaftar</th>
                                            <th>Jalur</th>
                                            <th>Tgl Daftar</th>
                                            <th>Status Formulir</th>
                                            <th>Status Berkas</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tableDataPendaftarBody">
                                        <tr>
                                            <td colspan="7" class="text-center text-muted py-4">Belum ada data pendaftar
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    {{-- ===== VERIFIKASI FORMULIR ===== --}}
                    <div id="sectionVerifikasiFormulir" class="spa-section">
                        <div class="row g-3 mb-4">
                            <div class="col-md-5">
                                <div class="card-filter">
                                    <h6><i class="bi bi-search me-1"></i> Pencarian Formulir</h6>
                                    <input type="text" id="searchVerifForm" class="form-control"
                                        placeholder="Cari nama pendaftar..." onkeyup="renderVerifikasiFormulir()">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card-filter">
                                    <h6><i class="bi bi-funnel-fill me-1"></i> Filter Status</h6>
                                    <select id="filterStatusForm" class="form-select"
                                        onchange="renderVerifikasiFormulir()">
                                        <option value="Semua">Semua Status</option>
                                        <option value="Menunggu">Menunggu Review</option>
                                        <option value="Disetujui">Disetujui</option>
                                        <option value="Perlu Revisi">Perlu Revisi</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card-filter">
                                    <h6><i class="bi bi-funnel-fill me-1"></i> Filter Jalur</h6>
                                    <select id="filterJalurForm" class="form-select"
                                        onchange="renderVerifikasiFormulir()">
                                        <option value="Semua">Semua</option>
                                        <option value="Reguler">Reguler</option>
                                        <option value="Prestasi">Prestasi</option>
                                        <option value="Tahfidz">Tahfidz</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="panel-kustom">
                            <div class="panel-title"><i class="bi bi-file-earmark-text me-1"></i> Verifikasi Formulir
                                Pendaftaran</div>
                            <div class="table-responsive">
                                <table class="table table-kustom">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Jalur</th>
                                            <th>Asal Sekolah</th>
                                            <th>Status</th>
                                            <th>Catatan Admin</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tableVerifikasiFormulirBody">
                                        <tr>
                                            <td colspan="6" class="text-center text-muted py-4">Belum ada formulir masuk
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    {{-- ===== VERIFIKASI BERKAS ===== --}}
                    <div id="sectionVerifikasiBerkas" class="spa-section">
                        <div class="row g-3 mb-4">
                            <div class="col-md-5">
                                <div class="card-filter">
                                    <h6><i class="bi bi-search me-1"></i> Pencarian</h6>
                                    <input type="text" id="searchVerifBerkas" class="form-control"
                                        placeholder="Cari nama pendaftar..." onkeyup="renderVerifikasiBerkas()">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card-filter">
                                    <h6><i class="bi bi-folder-fill me-1"></i> Status Berkas</h6>
                                    <select id="filterStatusBerkas" class="form-select"
                                        onchange="renderVerifikasiBerkas()">
                                        <option value="Semua">Semua Status</option>
                                        <option value="Menunggu">Menunggu Review</option>
                                        <option value="Disetujui">Disetujui</option>
                                        <option value="Perlu Revisi">Perlu Revisi</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card-filter">
                                    <h6><i class="bi bi-funnel-fill me-1"></i> Jalur</h6>
                                    <select id="filterJalurBerkas" class="form-select"
                                        onchange="renderVerifikasiBerkas()">
                                        <option value="Semua">Semua</option>
                                        <option value="Reguler">Reguler</option>
                                        <option value="Prestasi">Prestasi</option>
                                        <option value="Tahfidz">Tahfidz</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="panel-kustom">
                            <div class="panel-title"><i class="bi bi-folder2-open me-1"></i> Verifikasi Berkas
                                Persyaratan</div>
                            <div class="table-responsive">
                                <table class="table table-kustom">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Jalur</th>
                                            <th>Berkas Diunggah</th>
                                            <th>Status</th>
                                            <th>Catatan Admin</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tableVerifikasiBerkasBody">
                                        <tr>
                                            <td colspan="6" class="text-center text-muted py-4">Belum ada berkas masuk
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    {{-- ===== PEMBAYARAN ===== --}}
                    <div id="sectionPembayaranAdmin" class="spa-section">
                        <div class="row g-3 mb-4">
                            <div class="col-md-5">
                                <div class="card-filter">
                                    <h6><i class="bi bi-search me-1"></i> Pencarian</h6>
                                    <input type="text" id="searchPembayaran" class="form-control"
                                        placeholder="Cari nama..." onkeyup="renderPembayaran()">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card-filter">
                                    <h6><i class="bi bi-credit-card-fill me-1"></i> Status Pembayaran</h6>
                                    <select id="filterStatusBayar" class="form-select" onchange="renderPembayaran()">
                                        <option value="Semua">Semua</option>
                                        <option value="Menunggu Konfirmasi">Menunggu Konfirmasi</option>
                                        <option value="Lunas">Lunas</option>
                                        <option value="Belum Bayar">Belum Bayar</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="panel-kustom">
                            <div class="panel-title"><i class="bi bi-credit-card-fill me-1"></i> Data Pembayaran
                                Pendaftar</div>
                            <div class="table-responsive">
                                <table class="table table-kustom text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Jalur</th>
                                            <th>Status Bayar</th>
                                            <th>Bukti Transfer</th>
                                            <th>Catatan Admin</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tablePembayaranBody">
                                        <tr>
                                            <td colspan="4" class="text-center text-muted py-4">Belum ada data
                                                pembayaran</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    {{-- ===== SELEKSI ===== --}}
                    <div id="sectionSeleksiAdmin" class="spa-section">
                        <div class="panel-kustom">
                            <div class="panel-title"><i class="bi bi-trophy-fill me-1"></i> Penilaian &amp; Seleksi
                                Akhir</div>
                            <div class="table-responsive">
                                <table class="table table-kustom text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>Nama Pendaftar &amp; Nilai</th>
                                            <th>Jalur</th>
                                            <th>Hasil Seleksi</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tableSeleksiBody">
                                        <tr>
                                            <td colspan="4" class="text-center text-muted py-4">Belum ada pendaftar yang
                                                siap diseleksi</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    {{-- ===== KELOLA KONTEN HOME ===== --}}
                    <div id="sectionKelolaKontenHome" class="spa-section">

                        {{-- TOP BAR --}}
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div>
                                <h5 class="fw-bold mb-1" style="font-size:16px;color:var(--toska-800);"><i
                                        class="bi bi-house-heart-fill me-1"></i> Kelola Konten Home</h5>
                                <p class="text-muted mb-0" style="font-size:12px;">Upload dan atur gambar yang tampil di
                                    carousel slide halaman utama (Home) website sekolah.</p>
                            </div>
                            <button class="btn btn-toska px-4 py-2" onclick="openFormSliderBaru()"
                                style="border-radius:10px;font-size:13px;">
                                <i class="bi bi-plus-circle me-2"></i>Tambah Gambar Slider
                            </button>
                        </div>

                        {{-- INFO BANNER --}}
                        <div class="p-3 mb-4 rounded-3 d-flex align-items-center gap-3"
                            style="background:#eff6ff;border:1px solid #bfdbfe;">
                            <i class="bi bi-info-circle-fill text-primary fs-4"></i>
                            <div style="font-size:12.5px;">
                                <strong>Cara Kerja:</strong> Jika <strong>tidak ada gambar</strong> yang diunggah atau
                                diaktifkan, carousel di halaman Home akan <strong>otomatis disembunyikan</strong>.
                                Jika ada gambar aktif, carousel akan tampil dan bergeser sesuai urutan yang Anda
                                tentukan.
                            </div>
                        </div>

                        {{-- FORM TAMBAH / EDIT --}}
                        <div id="sliderFormPanel" class="panel-kustom mb-4" style="display:none;">
                            <div class="panel-title" id="sliderFormTitle"><i class="bi bi-image me-1"></i> Tambah Gambar
                                Slider Baru</div>
                            <div class="row g-3">
                                {{-- Kolom Kiri: Preview Gambar --}}
                                <div class="col-lg-5">
                                    <label class="form-label fw-semibold" style="font-size:12.5px;"><i
                                            class="bi bi-image me-1"></i> Pilih Gambar <span
                                            class="text-danger">*</span></label>
                                    <input type="file" id="sliderInputGambar" accept="image/*" class="form-control mb-2"
                                        style="border-radius:8px;font-size:12.5px;"
                                        onchange="previewSliderGambar(this)">
                                    <div id="sliderPreviewBox" style="display:none; position:relative;">
                                        <img id="sliderPreviewImg" src="" alt="Preview"
                                            style="width:100%;height:220px;object-fit:cover;border-radius:12px;border:2px solid var(--toska-200);">
                                        <button type="button"
                                            class="btn btn-sm btn-danger position-absolute top-0 end-0 m-1"
                                            onclick="hapusPreviewSlider()" style="border-radius:6px;font-size:11px;"><i
                                                class="bi bi-x"></i></button>
                                    </div>
                                    <div class="text-muted mt-1" style="font-size:11px;">Format JPG/PNG/WEBP, disarankan
                                        ukuran 800x600px atau lebih besar. Aspect ratio 4:3 atau 16:9 terbaik.</div>
                                </div>
                                {{-- Kolom Kanan: Metadata --}}
                                <div class="col-lg-7">
                                    <div class="p-3 rounded-3"
                                        style="background:#f8fafc;border:1px solid var(--toska-100);">
                                        <div class="mb-3">
                                            <label class="form-label fw-semibold" style="font-size:12px;"><i
                                                    class="bi bi-type me-1"></i> Judul Slide <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" id="sliderInputJudul" class="form-control"
                                                placeholder="Contoh: Kegiatan PPDB 2026"
                                                style="font-size:13px;border-radius:8px;">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label fw-semibold" style="font-size:12px;"><i
                                                    class="bi bi-text-paragraph me-1"></i> Deskripsi (Opsional)</label>
                                            <textarea id="sliderInputDeskripsi" class="form-control" rows="2"
                                                placeholder="Keterangan singkat gambar..."
                                                style="font-size:13px;border-radius:8px;resize:none;"></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label fw-semibold" style="font-size:12px;"><i
                                                    class="bi bi-link-45deg me-1"></i> Link URL (Opsional)</label>
                                            <input type="text" id="sliderInputLink" class="form-control"
                                                placeholder="Contoh: /ppdb/gelombang"
                                                style="font-size:13px;border-radius:8px;">
                                            <div class="form-text" style="font-size:11px;">Slide akan bisa diklik dan
                                                menuju URL ini jika diisi.</div>
                                        </div>
                                        <div class="row g-2 mb-3">
                                            <div class="col-6">
                                                <label class="form-label fw-semibold" style="font-size:12px;"><i
                                                        class="bi bi-sort-numeric-up me-1"></i> Urutan Tampil</label>
                                                <input type="number" id="sliderInputUrutan" class="form-control"
                                                    value="0" min="0" style="font-size:13px;border-radius:8px;">
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label fw-semibold" style="font-size:12px;"><i
                                                        class="bi bi-toggle-on me-1"></i> Status</label>
                                                <select id="sliderInputAktif" class="form-select"
                                                    style="font-size:13px;border-radius:8px;">
                                                    <option value="1">Aktif (Tampil di Home)</option>
                                                    <option value="0">Nonaktif (Disembunyikan)</option>
                                                </select>
                                            </div>
                                        </div>
                                        <input type="hidden" id="sliderEditId" value="">
                                        <input type="hidden" id="sliderGambarBase64" value="">
                                        <div class="d-flex gap-2 mt-3">
                                            <button class="btn btn-toska flex-fill fw-bold" onclick="simpanSlider()"
                                                style="border-radius:8px;font-size:13px;"><i
                                                    class="bi bi-save me-1"></i>Simpan Slider</button>
                                            <button class="btn btn-outline-secondary" onclick="tutupFormSlider()"
                                                style="border-radius:8px;font-size:13px;">Batal</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- DAFTAR SLIDER --}}
                        <div class="panel-kustom">
                            <div class="panel-title d-flex justify-content-between align-items-center">
                                <span><i class="bi bi-grid-3x2-gap-fill me-1"></i> Daftar Gambar Slider</span>
                                <span class="badge" id="sliderCountBadge"
                                    style="background:var(--toska-600);font-size:11px;border-radius:8px;padding:4px 10px;">0
                                    Slider</span>
                            </div>
                            <div id="sliderGridContainer" class="row g-3">
                                <div class="col-12 text-center py-5 text-muted" id="sliderEmptyState">
                                    <i class="bi bi-images mb-2" style="font-size:40px;display:block;opacity:0.3;"></i>
                                    <div style="font-size:13px;">Belum ada gambar slider. Klik <strong>"Tambah Gambar
                                            Slider"</strong> untuk memulai.</div>
                                    <div style="font-size:11.5px;margin-top:4px;">Carousel di halaman Home akan kosong
                                        (tidak tampil) jika tidak ada slider aktif.</div>
                                </div>
                            </div>
                        </div>

                    </div>{{-- /sectionKelolaKontenHome --}}

                    {{-- ===== KELOLA BERITA ===== --}}
                    <div id="sectionKelolaBerita" class="spa-section">


                        {{-- TOP BAR: Tombol tambah & info --}}
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div>
                                <h5 class="fw-bold mb-1" style="font-size:16px;color:var(--toska-800);"><i
                                        class="bi bi-newspaper me-1"></i> Manajemen Berita Sekolah</h5>
                                <p class="text-muted mb-0" style="font-size:12px;">Buat, edit, dan kelola semua berita &
                                    kegiatan sekolah yang tampil di halaman publik.</p>
                            </div>
                            <button class="btn btn-toska px-4 py-2" onclick="openFormBlogBaru()"
                                style="border-radius:10px;font-size:13px;">
                                <i class="bi bi-plus-circle me-2"></i>Tulis Berita Baru
                            </button>
                        </div>

                        {{-- FORM TAMBAH / EDIT --}}
                        <div id="blogFormPanel" class="panel-kustom mb-4" style="display:none;">
                            <div class="panel-title" id="blogFormTitle"><i class="bi bi-pencil-square me-1"></i> Tulis
                                Berita Baru</div>

                            <div class="row g-3">
                                {{-- Kolom Kiri: Konten --}}
                                <div class="col-lg-8">
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold" style="font-size:12.5px;">Judul Berita
                                            <span class="text-danger">*</span></label>
                                        <input type="text" id="blogInputJudul" class="form-control"
                                            placeholder="Masukkan judul berita yang menarik..."
                                            style="font-size:13.5px;font-weight:600;border-radius:10px;">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold" style="font-size:12.5px;">Ringkasan /
                                            Teaser <span class="text-danger">*</span></label>
                                        <textarea id="blogInputRingkasan" class="form-control" rows="3"
                                            placeholder="Tulis ringkasan singkat berita (tampil di halaman daftar berita)..."
                                            style="font-size:13px;border-radius:10px;resize:vertical;"></textarea>
                                        <div class="form-text" style="font-size:11px;">Maksimal 200 karakter disarankan.
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold" style="font-size:12.5px;">Isi Artikel
                                            Lengkap <span class="text-danger">*</span></label>
                                        <textarea id="blogInputIsi" class="form-control" rows="12"
                                            placeholder="Tulis isi artikel lengkap di sini. Gunakan baris baru untuk paragraf baru..."
                                            style="font-size:13px;border-radius:10px;resize:vertical;line-height:1.7;"></textarea>
                                    </div>

                                    {{-- Upload Gambar Tambahan --}}
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold" style="font-size:12.5px;"><i
                                                class="bi bi-images me-1"></i> Gambar Tambahan (Opsional)</label>
                                        <div class="d-flex align-items-center gap-2 mb-2">
                                            <input type="file" id="blogInputGambarTambahan" accept="image/*" multiple
                                                class="form-control form-control-sm"
                                                style="border-radius:8px;font-size:12px;">
                                        </div>
                                        <div id="previewGambarTambahan" class="d-flex flex-wrap gap-2 mt-2"></div>
                                        <div class="form-text" style="font-size:11px;">Bisa pilih beberapa gambar
                                            sekaligus. Gambar akan tampil sebagai galeri di halaman detail berita.</div>
                                    </div>
                                </div>

                                {{-- Kolom Ranan: Metadata --}}
                                <div class="col-lg-4">
                                    <div class="p-3 rounded-3"
                                        style="background:#f8fafc;border:1px solid var(--toska-100);">
                                        <div class="mb-3">
                                            <label class="form-label fw-semibold" style="font-size:12px;"><i
                                                    class="bi bi-calendar-event me-1"></i> Tanggal Berita <span
                                                    class="text-danger">*</span></label>
                                            <input type="date" id="blogInputTanggal"
                                                class="form-control form-control-sm"
                                                style="border-radius:8px;font-size:13px;">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label fw-semibold" style="font-size:12px;"><i
                                                    class="bi bi-tag-fill me-1"></i> Kategori <span
                                                    class="text-danger">*</span></label>
                                            <select id="blogInputKategori" class="form-select form-select-sm"
                                                style="border-radius:8px;font-size:13px;">
                                                <option value="">-- Pilih Kategori --</option>
                                                <option value="PPDB">PPDB</option>
                                                <option value="Prestasi">Prestasi</option>
                                                <option value="Fasilitas">Fasilitas</option>
                                                <option value="Ekstrakurikuler">Ekstrakurikuler</option>
                                                <option value="Kegiatan">Kegiatan</option>
                                                <option value="Pengumuman">Pengumuman</option>
                                                <option value="Akademik">Akademik</option>
                                                <option value="Lainnya">Lainnya</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label fw-semibold" style="font-size:12px;"><i
                                                    class="bi bi-image me-1"></i> Gambar Thumbnail Utama</label>
                                            <input type="file" id="blogInputGambar" accept="image/*"
                                                class="form-control form-control-sm mb-2"
                                                style="border-radius:8px;font-size:12px;"
                                                onchange="previewThumbnail(this)">
                                            <div id="previewThumbnailBox" style="display:none;">
                                                <img id="previewThumbnailImg" src="" alt="Preview"
                                                    style="width:100%;height:auto;max-height:220px;object-fit:contain;background-color:#f8fafc;border-radius:8px;border:1px solid #e2e8f0;">
                                                <button type="button" class="btn btn-sm btn-outline-danger mt-1 w-100"
                                                    onclick="hapusThumbnail()"
                                                    style="font-size:11px;border-radius:6px;"><i
                                                        class="bi bi-trash me-1"></i> Hapus Gambar</button>
                                            </div>
                                            <div class="form-text" style="font-size:11px;">Jika kosong, akan ditampilkan
                                                placeholder teal.</div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label fw-semibold" style="font-size:12px;"><i
                                                    class="bi bi-megaphone-fill me-1"></i> Status Publikasi</label>
                                            <select id="blogInputStatus" class="form-select form-select-sm"
                                                style="border-radius:8px;font-size:13px;">
                                                <option value="published">Publikasikan (Tampil di Halaman Berita)
                                                </option>
                                                <option value="draft">Simpan sebagai Draft (Tersembunyi)</option>
                                            </select>
                                        </div>

                                        <input type="hidden" id="blogEditId" value="">
                                        <input type="hidden" id="blogThumbnailBase64" value="">
                                        <input type="hidden" id="blogGambarTambahanBase64" value="[]">

                                        <div class="d-flex gap-2 mt-3">
                                            <button class="btn btn-toska flex-fill fw-bold" onclick="simpanBerita()"
                                                style="border-radius:8px;font-size:13px;"><i
                                                    class="bi bi-save me-1"></i>Simpan Berita</button>
                                            <button class="btn btn-outline-secondary" onclick="tutupFormBlog()"
                                                style="border-radius:8px;font-size:13px;">Batal</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- DAFTAR BERITA --}}
                        <div class="panel-kustom">
                            <div class="panel-title d-flex justify-content-between align-items-center flex-wrap gap-2">
                                <span><i class="bi bi-list-task me-1"></i> Daftar Semua Berita</span>
                                <div style="max-width: 320px; width: 100%;">
                                    <input type="text" id="searchDaftarBerita" class="form-control form-control-sm"
                                        placeholder="Cari judul, kategori, atau ringkasan..."
                                        onkeyup="renderDaftarBerita()"
                                        style="border-radius:8px; font-size:12px; border-color:var(--toska-200);">
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-kustom">
                                    <thead>
                                        <tr>
                                            <th style="width:40%;">Judul Berita</th>
                                            <th>Tanggal</th>
                                            <th>Kategori</th>
                                            <th>Status</th>
                                            <th>Gambar</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tableDaftarBeritaBody">
                                        <tr>
                                            <td colspan="6" class="text-center text-muted py-5">
                                                <div style="font-size:32px;"><i class="bi bi-newspaper text-muted"></i>
                                                </div>
                                                <div style="font-size:13px;">Belum ada berita. Klik "Tulis Berita Baru"
                                                    untuk memulai.</div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>{{-- /sectionKelolaBerita --}}

                    {{-- ===== KELOLA GALERI ===== --}}
                    <div id="sectionKelolaGaleri" class="spa-section">

                        {{-- TOP BAR --}}
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div>
                                <h5 class="fw-bold mb-1" style="font-size:16px;color:var(--toska-800);"><i
                                        class="bi bi-images me-1"></i> Manajemen Galeri Sekolah</h5>
                                <p class="text-muted mb-0" style="font-size:12px;">Kelola foto fasilitas dan
                                    ekstrakurikuler yang tampil di halaman galeri publik.</p>
                            </div>
                            <button class="btn btn-toska px-4 py-2" onclick="openFormGaleriBaru()"
                                style="border-radius:10px;font-size:13px;">
                                <i class="bi bi-plus-circle me-2"></i>Tambah Galeri Baru
                            </button>
                        </div>

                        {{-- FORM TAMBAH / EDIT --}}
                        <div id="galeriFormPanel" class="panel-kustom mb-4" style="display:none;">
                            <div class="panel-title" id="galeriFormTitle"><i class="bi bi-plus-circle me-1"></i> Tambah
                                Galeri Baru</div>
                            <div class="row g-4 align-items-start">
                                {{-- Kolom Kiri: Upload Foto --}}
                                <div class="col-lg-5">
                                    <label class="form-label fw-semibold" style="font-size:12.5px;"><i
                                            class="bi bi-image me-1"></i> Foto <span
                                            class="text-danger">*</span></label>
                                    <input type="file" id="galeriInputFoto" accept="image/*" class="form-control mb-2"
                                        style="border-radius:8px;font-size:12.5px;" onchange="previewGaleriFoto(this)">
                                    <div id="previewGaleriFotoBox" style="display:none;">
                                        <img id="previewGaleriFotoImg" src="" alt="Preview"
                                            style="width:100%;height:auto;max-height:260px;object-fit:contain;background:#f8fafc;border-radius:10px;border:1.5px solid var(--toska-100);">
                                        <button type="button" class="btn btn-sm btn-outline-danger mt-2 w-100"
                                            onclick="hapusFotoGaleri()" style="font-size:11px;border-radius:6px;"><i
                                                class="bi bi-trash me-1"></i> Hapus Foto</button>
                                    </div>
                                    <div id="galeriNoFotoPlaceholder"
                                        class="d-flex flex-column align-items-center justify-content-center"
                                        style="height:180px;background:var(--toska-50);border:2px dashed var(--toska-200);border-radius:10px;color:var(--toska-600);font-size:13px;">
                                        <span style="font-size:36px;margin-bottom:8px;"><i
                                                class="bi bi-camera text-muted"></i></span>
                                        <span>Pilih foto untuk pratinjau</span>
                                    </div>
                                    <div class="form-text mt-1" style="font-size:11px;">Format: JPG, PNG, WEBP. Foto
                                        akan tersimpan sebagai data gambar.</div>
                                    <input type="hidden" id="galeriFotoBase64" value="">
                                    <input type="hidden" id="galeriEditId" value="">
                                </div>
                                {{-- Kolom Kanan: Data --}}
                                <div class="col-lg-7">
                                    <div class="p-4 rounded-3"
                                        style="background:#f8fafc;border:1px solid var(--toska-100);">
                                        <div class="mb-3">
                                            <label class="form-label fw-semibold" style="font-size:12.5px;"><i
                                                    class="bi bi-file-earmark-text me-1"></i> Nama Fasilitas /
                                                Ekstrakurikuler <span class="text-danger">*</span></label>
                                            <input type="text" id="galeriInputNama" class="form-control"
                                                placeholder="Contoh: Laboratorium IPA, Pramuka, Lapangan Basket..."
                                                style="font-size:13px;border-radius:8px;">
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label fw-semibold" style="font-size:12.5px;"><i
                                                    class="bi bi-tag-fill me-1"></i> Kategori <span
                                                    class="text-danger">*</span></label>
                                            <select id="galeriInputKategori" class="form-select"
                                                style="font-size:13px;border-radius:8px;">
                                                <option value="">-- Pilih Kategori --</option>
                                                <option value="Fasilitas">Fasilitas</option>
                                                <option value="Ekstrakurikuler">Ekstrakurikuler</option>
                                            </select>
                                        </div>
                                        <div class="d-flex gap-2">
                                            <button class="btn btn-toska flex-fill fw-bold" onclick="simpanGaleri()"
                                                style="border-radius:8px;font-size:13px;"><i
                                                    class="bi bi-save me-1"></i>Simpan</button>
                                            <button class="btn btn-outline-secondary" onclick="tutupFormGaleri()"
                                                style="border-radius:8px;font-size:13px;">Batal</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- DAFTAR GALERI (Fasilitas) --}}
                        <div class="panel-kustom mb-4">
                            <div class="panel-title d-flex justify-content-between align-items-center flex-wrap gap-2">
                                <span><i class="bi bi-building me-1"></i> Daftar Fasilitas</span>
                                <div style="max-width:280px;width:100%;">
                                    <input type="text" id="searchGaleriFasilitas" class="form-control form-control-sm"
                                        placeholder="Cari nama fasilitas..." onkeyup="renderDaftarGaleri()"
                                        style="border-radius:8px;font-size:12px;border-color:var(--toska-200);">
                                </div>
                            </div>
                            <div class="row g-3" id="gridGaleriFasilitas">
                                <div class="col-12 text-center text-muted py-4" id="fasilitasEmptyState"
                                    style="font-size:13px;">
                                    <div style="font-size:36px;"><i class="bi bi-building text-muted"></i></div>
                                    <div class="mt-2">Belum ada data fasilitas.</div>
                                </div>
                            </div>
                        </div>

                        {{-- DAFTAR GALERI (Ekstrakurikuler) --}}
                        <div class="panel-kustom">
                            <div class="panel-title d-flex justify-content-between align-items-center flex-wrap gap-2">
                                <span><i class="bi bi-trophy-fill me-1"></i> Daftar Ekstrakurikuler</span>
                                <div style="max-width:280px;width:100%;">
                                    <input type="text" id="searchGaleriEkstrakurikuler"
                                        class="form-control form-control-sm" placeholder="Cari nama ekstrakurikuler..."
                                        onkeyup="renderDaftarGaleri()"
                                        style="border-radius:8px;font-size:12px;border-color:var(--toska-200);">
                                </div>
                            </div>
                            <div class="row g-3" id="gridGaleriEkstrakurikuler">
                                <div class="col-12 text-center text-muted py-4" id="ekstrakurikulerEmptyState"
                                    style="font-size:13px;">
                                    <div style="font-size:36px;"><i class="bi bi-trophy text-muted"></i></div>
                                    <div class="mt-2">Belum ada data ekstrakurikuler.</div>
                                </div>
                            </div>
                        </div>

                    </div>{{-- /sectionKelolaGaleri --}}

                    {{-- ===== PENGATURAN SISTEM ===== --}}
                    <div id="sectionPengaturanSistem" class="spa-section">
                        <div class="panel-kustom mb-4">
                            <div class="panel-title"><i class="bi bi-gear-fill me-1"></i> Pengaturan Sistem & Tampilan
                            </div>
                            <p class="text-muted" style="font-size:12.5px;">Atur informasi umum yang akan ditampilkan di
                                seluruh halaman website.</p>

                            <form action="{{ route('admin.settings.update') }}" method="POST">
                                @csrf
                                <div class="row g-4 mt-2">
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold" style="font-size:13px;">Tahun Ajaran
                                            (Sistem)</label>
                                        <input type="text" name="tahun_ajaran" class="form-control"
                                            value="{{ $sys_settings['tahun_ajaran'] ?? '2026/2027' }}"
                                            placeholder="Contoh: 2026/2027">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold" style="font-size:13px;">Tahun Ajaran
                                            (Tampilan Banner)</label>
                                        <input type="text" name="tahun_ajaran_tampil" class="form-control"
                                            value="{{ $sys_settings['tahun_ajaran_tampil'] ?? '2026 / 2027' }}"
                                            placeholder="Contoh: 2026 / 2027">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold" style="font-size:13px;">Tahun Sekarang
                                            (Footer)</label>
                                        <input type="text" name="tahun_sekarang" class="form-control"
                                            value="{{ $sys_settings['tahun_sekarang'] ?? '2026' }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold" style="font-size:13px;">Nama
                                            Sekolah</label>
                                        <input type="text" name="nama_sekolah" class="form-control"
                                            value="{{ $sys_settings['nama_sekolah'] ?? 'SMP Al-Amanah' }}">
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label fw-semibold" style="font-size:13px;">Teks Pengumuman
                                            PPDB (Landing Page)</label>
                                        <input type="text" name="pengumuman_header" class="form-control"
                                            value="{{ $sys_settings['pengumuman_header'] ?? 'PPDB Online TA 2026/2027 Telah Dibuka' }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold" style="font-size:13px;">Status
                                            Pendaftaran</label>
                                        <select name="ppdb_status" class="form-select">
                                            <option value="Buka" {{ ($sys_settings['ppdb_status'] ?? '') == 'Buka' ? 'selected' : '' }}>Buka</option>
                                            <option value="Tutup" {{ ($sys_settings['ppdb_status'] ?? '') == 'Tutup' ? 'selected' : '' }}>Tutup</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold" style="font-size:13px;">Gelombang
                                            Aktif</label>
                                        <select name="gelombang_aktif" class="form-select">
                                            <option value="Gelombang 1" {{ ($sys_settings['gelombang_aktif'] ?? '') == 'Gelombang 1' ? 'selected' : '' }}>Gelombang 1</option>
                                            <option value="Gelombang 2" {{ ($sys_settings['gelombang_aktif'] ?? '') == 'Gelombang 2' ? 'selected' : '' }}>Gelombang 2</option>
                                            <option value="Gelombang 3" {{ ($sys_settings['gelombang_aktif'] ?? '') == 'Gelombang 3' ? 'selected' : '' }}>Gelombang 3</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold" style="font-size:13px;">Tanggal Ujian
                                            Masuk (Kartu Peserta)</label>
                                        <input type="text" name="tanggal_ujian" class="form-control"
                                            value="{{ $sys_settings['tanggal_ujian'] ?? 'Sabtu, 6 Juni 2026' }}"
                                            placeholder="Contoh: Sabtu, 6 Juni 2026">
                                    </div>

                                    <div class="col-12 mt-3">
                                        <h6 class="fw-bold mb-2 border-bottom pb-2">Pengaturan Waktu & Diskon Gelombang
                                            Pendaftaran</h6>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold" style="font-size:13px;">Waktu Gelombang
                                            1</label>
                                        <input type="text" name="gelombang1_waktu" class="form-control"
                                            value="{{ $sys_settings['gelombang1_waktu'] ?? '13 Oktober 2025 - 28 Februari 2026' }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold" style="font-size:13px;">Diskon Gelombang
                                            1</label>
                                        <input type="text" name="gelombang1_diskon" class="form-control"
                                            value="{{ $sys_settings['gelombang1_diskon'] ?? '30%' }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold" style="font-size:13px;">Waktu Gelombang
                                            2</label>
                                        <input type="text" name="gelombang2_waktu" class="form-control"
                                            value="{{ $sys_settings['gelombang2_waktu'] ?? '02 Maret 2026 - 11 Juli 2026' }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold" style="font-size:13px;">Diskon Gelombang
                                            2</label>
                                        <input type="text" name="gelombang2_diskon" class="form-control"
                                            value="{{ $sys_settings['gelombang2_diskon'] ?? '20%' }}">
                                    </div>

                                    <div class="col-12 mt-3">
                                        <h6 class="fw-bold mb-2 border-bottom pb-2">Pengaturan Kontak & Media Sosial
                                            (Footer)</h6>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label fw-semibold" style="font-size:13px;">Deskripsi Singkat
                                            Sekolah (Footer)</label>
                                        <textarea name="deskripsi_sekolah" class="form-control"
                                            rows="3">{{ $sys_settings['deskripsi_sekolah'] ?? 'Lembaga pendidikan menengah yang berdedikasi tinggi mewujudkan siswa berprestasi akademis gemilang yang bertumpu pada pondasi akhlakul karimah dan wawasan global terintegrasi.' }}</textarea>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold" style="font-size:13px;"><i
                                                class="bi bi-facebook text-primary"></i> Facebook URL</label>
                                        <input type="text" name="sosmed_facebook" class="form-control"
                                            value="{{ $sys_settings['sosmed_facebook'] ?? 'https://www.facebook.com/smpalamanahsetu' }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold" style="font-size:13px;"><i
                                                class="bi bi-instagram text-danger"></i> Instagram URL</label>
                                        <input type="text" name="sosmed_instagram" class="form-control"
                                            value="{{ $sys_settings['sosmed_instagram'] ?? 'https://www.instagram.com/smpalamanahsetu' }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold" style="font-size:13px;"><i
                                                class="bi bi-youtube text-danger"></i> YouTube URL</label>
                                        <input type="text" name="sosmed_youtube" class="form-control"
                                            value="{{ $sys_settings['sosmed_youtube'] ?? 'https://www.youtube.com/@smpalamanahsetu' }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold" style="font-size:13px;"><i
                                                class="bi bi-tiktok text-dark"></i> TikTok URL</label>
                                        <input type="text" name="sosmed_tiktok" class="form-control"
                                            value="{{ $sys_settings['sosmed_tiktok'] ?? 'https://www.tiktok.com/@smpalamanahsetu' }}">
                                    </div>
                                    <div class="col-md-8"></div>
                                    <div class="col-md-12">
                                        <label class="form-label fw-semibold" style="font-size:13px;">Alamat
                                            Sekolah</label>
                                        <input type="text" name="kontak_alamat" class="form-control"
                                            value="{{ $sys_settings['kontak_alamat'] ?? 'Jl. Raya Al-Amanah No. 45, Al Bantani, Indonesia' }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold" style="font-size:13px;">Email
                                            Kontak</label>
                                        <input type="text" name="kontak_email" class="form-control"
                                            value="{{ $sys_settings['kontak_email'] ?? 'info@smp-alamanah.sch.id' }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold" style="font-size:13px;">Nomor
                                            Telepon/WA</label>
                                        <input type="text" name="kontak_telepon" class="form-control"
                                            value="{{ $sys_settings['kontak_telepon'] ?? '0813-8993-0005' }}">
                                    </div>

                                    <div class="col-md-12 mt-4 text-end">
                                        <button type="submit" class="btn btn-toska px-5 py-2"
                                            style="border-radius:10px; font-weight:bold;">
                                            <i class="bi bi-save me-2"></i> Simpan Pengaturan
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>{{-- /sectionPengaturanSistem --}}



                </div>{{-- /p-4 --}}
            </div>{{-- /flex-grow-1 --}}
        </div>{{-- /d-flex --}}
    </div>{{-- /container-fluid --}}

    {{-- ==================== MODAL: TOLAK / BELUM VALID FORMULIR ==================== --}}
    <div class="custom-modal-backdrop" id="modalTolakFormulir" style="z-index: 10100;">
        <div class="custom-modal-box">
            <div class="d-flex align-items-center gap-2 mb-3">
                <span style="font-size:22px;"><i class="bi bi-x-circle text-danger"></i></span>
                <h5 class="fw-bold m-0" style="font-size:16px;">Tolak Formulir &amp; Beri Catatan</h5>
            </div>
            <p class="text-muted mb-3" style="font-size:12.5px;">Formulir pendaftar: <strong
                    id="tolakFormNama">-</strong></p>
            <div class="mb-3">
                <label class="form-label fw-semibold" style="font-size:12.5px;">Catatan untuk Pendaftar <span
                        class="text-danger">*</span></label>
                <textarea id="inputCatatanFormulir" class="form-control" rows="4"
                    placeholder="Contoh: NIK tidak sesuai KK, mohon periksa ulang nomor 16 digit..."
                    style="font-size:13px;border-radius:10px;resize:vertical;"></textarea>
                <div class="form-text" style="font-size:11px;">Catatan ini akan ditampilkan langsung di dashboard calon
                    siswa.</div>
            </div>
            <div class="d-flex gap-2 justify-content-end">
                <button class="btn btn-secondary px-4" onclick="closeTolakFormulirModal()"
                    style="border-radius:20px;font-size:12.5px;">Batal</button>
                <button class="btn btn-danger px-4 fw-bold" onclick="confirmTolakFormulir()"
                    style="border-radius:20px;font-size:12.5px;">Kirim Catatan &amp; Konfirmasi</button>
            </div>
        </div>
    </div>

    {{-- ==================== MODAL: TOLAK / BELUM VALID BERKAS ==================== --}}
    <div class="custom-modal-backdrop" id="modalTolakBerkas" style="z-index: 10100;">
        <div class="custom-modal-box">
            <div class="d-flex align-items-center gap-2 mb-3">
                <span style="font-size:22px;"><i class="bi bi-folder-x text-danger"></i></span>
                <h5 class="fw-bold m-0" style="font-size:16px;">Tolak Berkas &amp; Beri Catatan</h5>
            </div>
            <p class="text-muted mb-3" style="font-size:12.5px;">Berkas pendaftar: <strong
                    id="tolakBerkasNama">-</strong></p>
            <div class="mb-3">
                <label class="form-label fw-semibold" style="font-size:12.5px;">Kekurangan / Alasan <span
                        class="text-danger">*</span></label>
                <textarea id="inputCatatanBerkas" class="form-control" rows="4"
                    placeholder="Contoh: Scan KK tidak terbaca, Pas foto latar tidak sesuai ketentuan (harus merah/biru)..."
                    style="font-size:13px;border-radius:10px;resize:vertical;"></textarea>
                <div class="form-text" style="font-size:11px;">Catatan ini akan ditampilkan langsung di dashboard calon
                    siswa.</div>
            </div>
            <div class="d-flex gap-2 justify-content-end">
                <button class="btn btn-secondary px-4" onclick="closeTolakBerkasModal()"
                    style="border-radius:20px;font-size:12.5px;">Batal</button>
                <button class="btn btn-danger px-4 fw-bold" onclick="confirmTolakBerkas()"
                    style="border-radius:20px;font-size:12.5px;">Kirim Catatan &amp; Konfirmasi</button>
            </div>
        </div>
    </div>

    {{-- ==================== MODAL: TOLAK PEMBAYARAN ==================== --}}
    <div class="custom-modal-backdrop" id="modalTolakPembayaran" style="z-index: 10100; display: none;">
        <div class="custom-modal-box">
            <div class="d-flex align-items-center gap-2 mb-3">
                <span style="font-size:22px;"><i class="bi bi-x-circle text-danger"></i></span>
                <h5 class="fw-bold m-0" style="font-size:16px;">Tolak Pembayaran &amp; Beri Catatan</h5>
            </div>
            <p class="text-muted mb-3" style="font-size:12.5px;">Pembayaran pendaftar: <strong
                    id="tolakPembayaranNama">-</strong></p>
            <div class="mb-3">
                <label class="form-label fw-semibold" style="font-size:12.5px;">Catatan / Alasan Pembayaran Belum Masuk
                    <span class="text-danger">*</span></label>
                <textarea id="inputCatatanPembayaran" class="form-control" rows="4"
                    placeholder="Contoh: Uang belum masuk ke rekening kami, harap periksa kembali bukti transfer Anda atau upload ulang..."
                    style="font-size:13px;border-radius:10px;resize:vertical;"></textarea>
                <div class="form-text" style="font-size:11px;">Catatan ini akan ditampilkan langsung di dashboard calon
                    siswa.</div>
            </div>
            <div class="d-flex gap-2 justify-content-end">
                <button class="btn btn-secondary px-4" onclick="closeTolakPembayaranModal()"
                    style="border-radius:20px;font-size:12.5px;">Batal</button>
                <button class="btn btn-danger px-4 fw-bold" onclick="confirmTolakPembayaran()"
                    style="border-radius:20px;font-size:12.5px;">Kirim Catatan &amp; Tandai Belum Bayar</button>
            </div>
        </div>
    </div>

    {{-- ==================== MODAL: REVIEW FORMULIR ==================== --}}
    <div class="custom-modal-backdrop" id="modalDetailFormulir">
        <div class="custom-modal-box"
            style="width:750px;max-width:95vw; border-radius:16px; box-shadow:0 20px 50px rgba(13,148,136,0.15);">
            <div class="d-flex align-items-center justify-content-between mb-3 pb-2 border-bottom">
                <h5 class="fw-bold m-0 text-teal-800"
                    style="font-size:16.5px; display:flex; align-items:center; gap:8px;">
                    <span><i class="bi bi-file-earmark-text me-1"></i> Review Isi Formulir Pendaftaran</span>
                </h5>
                <button onclick="closeModalFormulir()" class="btn btn-sm btn-outline-secondary rounded-pill"
                    style="font-size:12px; padding:4px 12px;">Tutup</button>
            </div>
            <div id="modalFormulirContent" style="max-height:70vh;overflow-y:auto;padding-right:8px;"></div>
        </div>
    </div>

    {{-- ==================== MODAL: REVIEW BERKAS (FULL SCREEN-ISH) ==================== --}}
    <div class="custom-modal-backdrop" id="modalReviewBerkas">
        <div class="custom-modal-box"
            style="width:95vw; max-width:1400px; height:90vh; display:flex; flex-direction:column; border-radius:16px; box-shadow:0 20px 50px rgba(13,148,136,0.2); padding:24px;">
            <div class="d-flex align-items-center justify-content-between mb-3 pb-2 border-bottom flex-shrink-0">
                <h5 class="fw-bold m-0 text-teal-800"
                    style="font-size:17px; display:flex; align-items:center; gap:8px;">
                    <span><i class="bi bi-folder2-open me-1"></i> Portal Review Berkas Dokumen Siswa</span>
                    <span class="badge bg-teal-100 text-teal-800 border border-teal-200"
                        style="font-size:10px; border-radius:12px; padding:3px 10px;">Layar Lebar / Fullscreen
                        Mode</span>
                </h5>
                <button onclick="closeModalBerkas()" class="btn btn-sm btn-outline-secondary rounded-pill"
                    style="font-size:12px; padding:4px 12px;">Tutup</button>
            </div>
            <div id="modalBerkasContent"
                style="flex:1; overflow-y:auto; padding-right:8px; display:flex; flex-direction:column;"></div>
        </div>
    </div>

    {{-- ==================== MODAL: KIRIM CATATAN ==================== --}}
    <div class="custom-modal-backdrop" id="modalKirimCatatan">
        <div class="custom-modal-box">
            <div class="d-flex align-items-center gap-2 mb-3">
                <span style="font-size:22px;"><i class="bi bi-pencil-square text-primary"></i></span>
                <h5 class="fw-bold m-0" style="font-size:16px;">Kirim Catatan ke Pendaftar</h5>
            </div>
            <div class="mb-2 p-2 rounded-3" style="background:#f5f3ff;border:1px solid #e0e7ff;">
                <div style="font-size:11.5px;color:#4f46e5;">Pendaftar: <strong id="catatanNama">-</strong>
                    &nbsp;|&nbsp; Bagian: <strong id="catatanType">-</strong></div>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold" style="font-size:12.5px;">Isi Catatan <span
                        class="text-danger">*</span></label>
                <textarea id="inputCatatanKirim" class="form-control" rows="5"
                    placeholder="Tuliskan catatan, instruksi, atau information yang perlu diketahui pendaftar..."
                    style="font-size:13px;border-radius:10px;resize:vertical;"></textarea>
                <div class="form-text" style="font-size:11px;">Catatan akan langsung tampil di dashboard siswa tanpa
                    mengubah status verifikasi.</div>
            </div>
            <div class="d-flex gap-2 justify-content-end">
                <button class="btn btn-secondary px-4" onclick="closeCatatanModal()"
                    style="border-radius:20px;font-size:12.5px;">Batal</button>
                <button class="btn px-4 fw-bold text-white" onclick="confirmKirimCatatan()"
                    style="border-radius:20px;font-size:12.5px;background:linear-gradient(135deg,#6366f1,#4f46e5);border:none;"><i
                        class="bi bi-pencil-square me-1"></i> Kirim Catatan</button>
            </div>
        </div>
    </div>

    {{-- ==================== MODAL: INPUT NILAI UJIAN ==================== --}}
    <div class="custom-modal-backdrop" id="modalInputNilai" style="z-index: 10100;">
        <div class="custom-modal-box" style="width: 500px; max-height: 90vh; overflow-y: auto;">
            <div class="d-flex align-items-center gap-2 mb-3">
                <span style="font-size:22px;"><i class="bi bi-journal-check text-teal"></i></span>
                <h5 class="fw-bold m-0" style="font-size:16px;">Input Nilai Ujian Seleksi</h5>
            </div>
            <p class="text-muted mb-3" style="font-size:12.5px;">Calon Siswa: <strong id="nilaiSiswaNama">-</strong></p>

            <input type="hidden" id="nilaiSiswaId">

            <div class="row g-3 mb-4">
                <div class="col-6">
                    <label class="form-label fw-semibold" style="font-size:12px;">Pendidik Agama Islam (PAI) <span
                            class="text-danger">*</span></label>
                    <input type="number" id="inputNilaiPai" class="form-control form-control-sm" min="0" max="100"
                        placeholder="0-100" style="border-radius:8px;">
                </div>
                <div class="col-6">
                    <label class="form-label fw-semibold" style="font-size:12px;">Bahasa Indonesia <span
                            class="text-danger">*</span></label>
                    <input type="number" id="inputNilaiInd" class="form-control form-control-sm" min="0" max="100"
                        placeholder="0-100" style="border-radius:8px;">
                </div>
                <div class="col-6">
                    <label class="form-label fw-semibold" style="font-size:12px;">IPA <span
                            class="text-danger">*</span></label>
                    <input type="number" id="inputNilaiIpa" class="form-control form-control-sm" min="0" max="100"
                        placeholder="0-100" style="border-radius:8px;">
                </div>
                <div class="col-6">
                    <label class="form-label fw-semibold" style="font-size:12px;">IPS <span
                            class="text-danger">*</span></label>
                    <input type="number" id="inputNilaiIps" class="form-control form-control-sm" min="0" max="100"
                        placeholder="0-100" style="border-radius:8px;">
                </div>
                <div class="col-6">
                    <label class="form-label fw-semibold" style="font-size:12px;">Matematika <span
                            class="text-danger">*</span></label>
                    <input type="number" id="inputNilaiMat" class="form-control form-control-sm" min="0" max="100"
                        placeholder="0-100" style="border-radius:8px;">
                </div>
                <div class="col-6">
                    <label class="form-label fw-semibold" style="font-size:12px;">Baca Tulis Al-Qur'an (BTQ) <span
                            class="text-danger">*</span></label>
                    <input type="number" id="inputNilaiBtq" class="form-control form-control-sm" min="0" max="100"
                        placeholder="0-100" style="border-radius:8px;">
                </div>
            </div>

            <div class="d-flex gap-2 justify-content-end">
                <button class="btn btn-secondary px-4" onclick="closeNilaiModal()"
                    style="border-radius:20px;font-size:12.5px;">Batal</button>
                <button class="btn btn-toska px-4 fw-bold" onclick="saveNilaiUjian()"
                    style="border-radius:20px;font-size:12.5px;"><i class="bi bi-save me-1"></i> Simpan Nilai</button>
            </div>
        </div>
    </div>

    {{-- ==================== SUCCESS TOAST ==================== --}}
    <div id="toastAdmin"
        style="display:none;position:fixed;bottom:24px;right:24px;z-index:20000;background:#fff;border-radius:12px;box-shadow:0 8px 24px rgba(0,0,0,0.12);border:1px solid #e2e8f0;padding:14px 18px;min-width:280px;animation:fadeInUp 0.25s ease;">
        <div class="d-flex align-items-center gap-3">
            <span id="toastIcon" style="font-size:20px;"><i class="bi bi-check-circle-fill text-success"></i></span>
            <div>
                <div id="toastTitle" class="fw-bold" style="font-size:13.5px;"></div>
                <div id="toastMsg" class="text-muted" style="font-size:11.5px;margin-top:2px;"></div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // ==================== CONSTANTS ====================
        const ADMIN_NOTIF_KEY = 'ppdb_admin_notif';
        const DB_PENDAFTAR_COUNT = {{ $dbPendaftarCount ?? 0 }};
        const CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]')?.content || '';

        // ===== DATA PENDAFTAR: Dibaca dari PHP (database MySQL), bukan localStorage =====
        // Setiap record mewakili satu calon siswa beserta status pendaftarannya
        @php
            $formattedPendaftar = ($pendaftar ?? collect())->map(function($cs) {
                $p = $cs->pendaftaran;
                $pb = $p?->pembayaran;
                $bk = $p?->berkas;
                $ortu = $cs->dataOrangtua;

                $uploadedFiles = [];
                if ($bk) {
                    if ($bk->file_kartu_keluarga) $uploadedFiles['KK'] = asset('storage/' . $bk->file_kartu_keluarga);
                    if ($bk->file_akta_kelahiran) $uploadedFiles['Akta'] = asset('storage/' . $bk->file_akta_kelahiran);
                    if ($bk->file_ijazah_rapor) $uploadedFiles['Rapor'] = asset('storage/' . $bk->file_ijazah_rapor);
                    if ($bk->file_pas_foto) $uploadedFiles['Foto'] = asset('storage/' . $bk->file_pas_foto);
                    if ($bk->file_sertifikat_prestasi) $uploadedFiles['Sertifikat'] = asset('storage/' . $bk->file_sertifikat_prestasi);
                    if ($bk->file_surat_hafalan) $uploadedFiles['KetHafalan'] = asset('storage/' . $bk->file_surat_hafalan);
                }
                if ($pb && $pb->bukti_transfer_manual) {
                    $uploadedFiles['BuktiTransfer'] = asset('storage/' . $pb->bukti_transfer_manual);
                }

                return [
                    'id'                  => (string) $cs->user_id,
                    'calonSiswaId'        => (string) $cs->id,
                    'nama'                => $cs->user->name ?? '',
                    'email'               => $cs->user->email ?? '',
                    'jalur'               => $p?->jurusan_pilihan ?? '',
                    'noUrut'              => $p?->no_pendaftaran ?? '',
                    'tanggalDaftar'       => $p?->tanggal_daftar
                                              ? \Carbon\Carbon::parse($p->tanggal_daftar)->format('d/m/Y')
                                              : ($p?->created_at ? $p->created_at->format('d/m/Y') : ''),
                    'statusFormulir'      => $cs->status_formulir === 'Terkirim' ? 'Terkirim' : ($p ? 'Terkirim' : 'Belum'),
                    'statusFormulirAdmin' => $p?->status_formulir_admin ?? 'Menunggu',
                    'catatanFormulirAdmin'=> $p?->catatan_formulir_admin ?? '',
                    'statusBerkas'        => $cs->status_berkas === 'Terkirim' ? 'Terkirim' : ($bk ? 'Terkirim' : 'Belum'),
                    'statusBerkasAdmin'   => $p?->status_berkas_admin ?? 'Menunggu',
                    'catatanBerkasAdmin'  => $p?->catatan_berkas_admin ?? '',
                    'statusPembayaran'    => $pb?->status_pembayaran ?? 'Belum Bayar',
                    'catatanPembayaran'   => $pb?->catatan_pembayaran ?? '',
                    'buktiTransferManual' => $pb?->bukti_transfer_manual ?? '',
                    'namaPengirim'        => $pb?->nama_pengirim ?? '',
                    'nilaiUjian'          => $p?->nilai_ujian ?? null,
                    'hasilSeleksi'        => $p?->hasil_seleksi ?? '',
                    'formData'            => [
                        'inputNama'              => $cs->user->name ?? '',
                        'inputGender'            => $cs->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan',
                        'inputTinggiBadan'       => $cs->tinggi_badan,
                        'inputGolDarah'          => $cs->gol_darah,
                        'inputTempatLahir'       => $cs->tempat_lahir,
                        'inputTanggalLahir'      => $cs->tanggal_lahir,
                        'inputAgama'             => $cs->agama,
                        'inputAnakKe'            => $cs->anak_ke,
                        'inputJumlahSaudara'     => $cs->jumlah_saudara,
                        'inputSaudaraLaki'       => $cs->saudara_laki,
                        'inputSaudaraPerempuan'  => $cs->saudara_perempuan,
                        'inputSaudaraMenikah'    => $cs->saudara_menikah,
                        'inputAlamatJalan'       => $cs->alamat_jalan,
                        'inputAlamatRTRW'        => $cs->alamat_rt_rw,
                        'inputAlamatDesa'        => $cs->alamat_desa,
                        'inputAlamatKecamatan'   => $cs->alamat_kecamatan,
                        'inputAlamatKabupaten'   => $cs->alamat_kabupaten,
                        'inputNoHpSiswa'         => $cs->no_hp_siswa,
                        'inputAsalSekolah'       => $cs->asal_sekolah,
                        'inputAlamatSekolah'     => $cs->alamat_sekolah,
                        'inputNISN'              => $cs->nisn,
                        'inputNIK'               => $cs->nik,
                        'inputNamaAyah'          => $ortu->nama_ayah ?? '',
                        'inputStatusAyah'        => $ortu->status_ayah ?? '',
                        'inputNamaIbu'           => $ortu->nama_ibu ?? '',
                        'inputStatusIbu'         => $ortu->status_ibu ?? '',
                        'inputPendidikanAyah'    => $ortu->pendidikan_ayah ?? '',
                        'inputPendidikanIbu'     => $ortu->pendidikan_ibu ?? '',
                        'inputAlamatOrtu'        => $ortu->alamat_ortu ?? '',
                        'inputNoHpOrtu'          => $ortu->no_hp_ayah ?? '',
                        'inputPekerjaanAyah'     => $ortu->pekerjaan_ayah ?? '',
                        'inputPekerjaanIbu'      => $ortu->pekerjaan_ibu ?? '',
                        'inputNamaWali'          => $ortu->nama_wali ?? '',
                        'inputAlamatWali'        => $ortu->alamat_wali ?? '',
                        'inputNoHpWali'          => $ortu->no_hp_wali ?? '',
                        'inputPekerjaanWali'     => $ortu->pekerjaan_wali ?? '',
                    ],
                    'uploadedFiles'       => $uploadedFiles,
                ];
            })->values();
        @endphp
        const DB_PENDAFTAR = @json($formattedPendaftar);

        // Override lokal: menyimpan perubahan status yang dilakukan admin di sesi ini
        // (sebelum halaman di-refresh). Key = user_id
        let _localOverride = {};

        let currentTolakId = null;
        let currentTolakStatus = 'Ditolak';
        let adminNotifOpen = false;
        let chartInstance = null;
        let currentActiveDetailSiswaId = null;
        let reviewedPayments = {};

        // ==================== STATE HELPERS ====================
        // getPendaftar() sekarang membaca dari DB_PENDAFTAR (server), dengan override lokal diterapkan
        function getPendaftar() {
            return DB_PENDAFTAR.map(p => {
                const ov = _localOverride[p.id] || {};
                return Object.assign({}, p, ov);
            });
        }

        // Terapkan override lokal tanpa menyimpan ke localStorage
        function applyLocalOverride(userId, data) {
            _localOverride[userId] = Object.assign(_localOverride[userId] || {}, data);
        }
        function getAdminNotifs() {
            try { return JSON.parse(localStorage.getItem(ADMIN_NOTIF_KEY)) || []; } catch (e) { return []; }
        }
        function addAdminNotif(notif) {
            const notifs = getAdminNotifs();
            notif.id = Date.now(); notif.waktu = new Date().toLocaleString('id-ID'); notif.dibaca = false;
            notifs.unshift(notif);
            localStorage.setItem(ADMIN_NOTIF_KEY, JSON.stringify(notifs));
            renderAdminNotif();
        }
        function markAllAdminRead() {
            const notifs = getAdminNotifs().map(n => ({ ...n, dibaca: true }));
            localStorage.setItem(ADMIN_NOTIF_KEY, JSON.stringify(notifs));
            renderAdminNotif();
        }

        // ==================== SECTION SWITCHING ====================
        function switchSection(name) {
            document.querySelectorAll('.spa-section').forEach(s => s.classList.remove('active'));
            document.querySelectorAll('.sidebar .nav-link').forEach(l => l.classList.remove('active'));

            const sectionMap = {
                'AdminDashboard': 'sectionAdminDashboard',
                'DataPendaftar': 'sectionDataPendaftar',
                'VerifikasiFormulir': 'sectionVerifikasiFormulir',
                'VerifikasiBerkas': 'sectionVerifikasiBerkas',
                'PembayaranAdmin': 'sectionPembayaranAdmin',
                'SeleksiAdmin': 'sectionSeleksiAdmin',
                'KelolaBerita': 'sectionKelolaBerita',
                'KelolaKontenHome': 'sectionKelolaKontenHome',
                'KelolaGaleri': 'sectionKelolaGaleri',
                'PengaturanSistem': 'sectionPengaturanSistem'
            };
            const linkMap = {
                'AdminDashboard': 'linkAdminDashboard',
                'DataPendaftar': 'linkDataPendaftar',
                'VerifikasiFormulir': 'linkVerifikasiFormulir',
                'VerifikasiBerkas': 'linkVerifikasiBerkas',
                'PembayaranAdmin': 'linkPembayaranAdmin',
                'SeleksiAdmin': 'linkSeleksiAdmin',
                'KelolaBerita': 'linkKelolaBerita',
                'KelolaKontenHome': 'linkKelolaKontenHome',
                'KelolaGaleri': 'linkKelolaGaleri',
                'PengaturanSistem': 'linkPengaturanSistem'
            };
            const titles = {
                'AdminDashboard': 'Dashboard Utama',
                'DataPendaftar': 'Data Pendaftar',
                'VerifikasiFormulir': 'Verifikasi Formulir',
                'VerifikasiBerkas': 'Verifikasi Berkas',
                'PembayaranAdmin': 'Pembayaran',
                'SeleksiAdmin': 'Penilaian & Seleksi',
                'KelolaBerita': 'Kelola Berita',
                'KelolaKontenHome': 'Kelola Konten Home',
                'KelolaGaleri': 'Kelola Galeri',
                'PengaturanSistem': 'Pengaturan Sistem'
            };

            const sEl = document.getElementById(sectionMap[name]);
            if (sEl) sEl.classList.add('active');
            const lEl = document.getElementById(linkMap[name]);
            if (lEl) lEl.classList.add('active');

            const t = document.getElementById('currentPageTitle');
            if (t) t.textContent = titles[name] || name;

            // Open submenu if pendaftaran sub-items are selected
            if (['DataPendaftar', 'VerifikasiFormulir', 'VerifikasiBerkas'].includes(name)) {
                toggleMenu('menuPendaftaranSub', 'pendaftaranCaret', true);
            }

            // Render data for each section
            if (name === 'DataPendaftar') renderTablePendaftar();
            if (name === 'VerifikasiFormulir') renderVerifikasiFormulir();
            if (name === 'VerifikasiBerkas') renderVerifikasiBerkas();
            if (name === 'PembayaranAdmin') renderPembayaran();
            if (name === 'SeleksiAdmin') renderSeleksi();
            if (name === 'KelolaBerita') renderDaftarBerita();
            if (name === 'KelolaKontenHome') renderDaftarSlider();
            if (name === 'KelolaGaleri') renderDaftarGaleri();
            if (name === 'AdminDashboard') { updateDashboardStats(); renderChart(); renderRecentActivity(); }


            adminNotifOpen = false;
            const panel = document.getElementById('adminNotifPanel');
            if (panel) panel.classList.remove('show');
        }

        function toggleMenu(id, caretId, forceOpen) {
            const el = document.getElementById(id);
            const caret = document.getElementById(caretId);
            if (!el) return;
            const isOpen = el.style.maxHeight !== '0px' && el.style.maxHeight !== '';
            if (forceOpen && isOpen) return;
            if (!isOpen || forceOpen) {
                el.style.maxHeight = '200px';
                el.style.opacity = '1';
                if (caret) caret.style.transform = 'rotate(180deg)';
            } else {
                el.style.maxHeight = '0px';
                el.style.opacity = '0';
                if (caret) caret.style.transform = '';
            }
        }

        // ==================== BADGE HELPERS ====================
        // ==================== BADGE HELPERS ====================
        function statusBadge(status) {
            const map = {
                'Menunggu': `<span class="status-badge badge-warning"><i class="bi bi-hourglass-split me-1"></i> Menunggu Review</span>`,
                'Disetujui': `<span class="status-badge badge-success"><i class="bi bi-check-circle-fill me-1"></i> Disetujui</span>`,
                'Belum Valid': `<span class="status-badge" style="background:#fff7ed;color:#c2410c;border:1px solid #fed7aa;"><i class="bi bi-exclamation-triangle-fill me-1"></i> Belum Valid</span>`,
                'Ditolak': `<span class="status-badge badge-danger"><i class="bi bi-x-circle-fill me-1"></i> Ditolak</span>`,
                'Perlu Revisi': `<span class="status-badge" style="background:#fff7ed;color:#c2410c;border:1px solid #fed7aa;"><i class="bi bi-exclamation-triangle-fill me-1"></i> Belum Valid</span>`,
                'Belum': `<span class="status-badge badge-secondary">– Belum</span>`,
                'Terkirim': `<span class="status-badge badge-info"><i class="bi bi-send-fill me-1"></i> Dikirim</span>`,
                'Lunas': `<span class="status-badge badge-success"><i class="bi bi-check-circle-fill me-1"></i> Lunas</span>`,
                'Menunggu Konfirmasi': `<span class="status-badge badge-warning"><i class="bi bi-hourglass-split me-1"></i> Menunggu Konfirmasi</span>`,
                'Belum Bayar': `<span class="status-badge badge-secondary">– Belum Bayar</span>`,
                'Lulus': `<span class="status-badge badge-success"><i class="bi bi-check-circle-fill me-1"></i> Lulus</span>`,
                'Tidak Lulus': `<span class="status-badge badge-danger"><i class="bi bi-x-circle-fill me-1"></i> Tidak Lulus</span>`,
            };
            return map[status] || `<span class="status-badge badge-secondary">${status || '–'}</span>`;
        }

        function jalurBadge(jalur) {
            const map = { 'Reguler': 'badge-info', 'Prestasi': 'badge-warning', 'Tahfidz': 'badge-success' };
            return `<span class="status-badge ${map[jalur] || 'badge-secondary'}">${jalur || '–'}</span>`;
        }

        // ==================== RENDER: DATA PENDAFTAR ====================
        function getFilteredPendaftar(searchId, jalurId, statusId) {
            const q = (document.getElementById(searchId)?.value || '').toLowerCase();
            const jalur = document.getElementById(jalurId)?.value || 'Semua';
            const status = document.getElementById(statusId)?.value || 'Semua';

            return getPendaftar().filter(p => {
                const matchSearch = !q || (p.nama || '').toLowerCase().includes(q);
                const matchJalur = jalur === 'Semua' || p.jalur === jalur;
                const matchStatus = status === 'Semua' || p.statusFormulir === status || p.statusFormulirAdmin === status;
                return matchSearch && matchJalur && matchStatus;
            });
        }

        function renderTablePendaftar() {
            const data = getFilteredPendaftar('searchPendaftar', 'filterJalurPendaftar', 'filterStatusPendaftar');
            const tbody = document.getElementById('tableDataPendaftarBody');
            if (!tbody) return;

            if (data.length === 0) {
                tbody.innerHTML = '<tr><td colspan="7" class="text-center text-muted py-4" style="font-size:13px;"><i class="bi bi-inbox me-1"></i> Belum ada data pendaftar</td></tr>';
                return;
            }

            tbody.innerHTML = data.map((p, i) => `
        <tr>
            <td class="text-muted" style="font-size:12px;">${i + 1}</td>
            <td>
                <div class="fw-semibold text-dark" style="font-size:13px;">${p.nama}</div>
                <div class="text-muted" style="font-size:11px;">${p.noUrut || '–'} · ${p.email || ''}</div>
            </td>
            <td>${jalurBadge(p.jalur)}</td>
            <td class="text-muted" style="font-size:12px;">${p.tanggalDaftar || '–'}</td>
            <td>${statusBadge(p.statusFormulirAdmin || p.statusFormulir || 'Belum')}</td>
            <td>${statusBadge(p.statusBerkasAdmin || p.statusBerkas || 'Belum')}</td>
            <td>
                <button class="btn btn-sm btn-outline-primary me-1" onclick="openFormulirDetailModal('${p.id}')" style="border-radius:20px;font-size:11px;padding:3px 10px;">Detail</button>
                <button class="btn btn-sm btn-danger fw-bold" onclick="hapusCalonSiswa('${p.id}', '${p.nama.replace(/'/g, "\\'")}')" style="border-radius:20px;font-size:11px;padding:3px 10px;border:none;background:#dc2626;color:#fff;">
                    <i class="bi bi-trash me-1"></i> Hapus
                </button>
            </td>
        </tr>
    `).join('');
        }

        // ==================== RENDER: VERIFIKASI FORMULIR ====================
        function renderVerifikasiFormulir() {
            const q = (document.getElementById('searchVerifForm')?.value || '').toLowerCase();
            const jalur = document.getElementById('filterJalurForm')?.value || 'Semua';
            const status = document.getElementById('filterStatusForm')?.value || 'Semua';

            const data = getPendaftar().filter(p => {
                if (p.statusFormulir !== 'Terkirim' && !['Belum Valid', 'Ditolak', 'Disetujui'].includes(p.statusFormulirAdmin)) return false;
                const matchQ = !q || (p.nama || '').toLowerCase().includes(q);
                const matchJ = jalur === 'Semua' || p.jalur === jalur;
                const normStatus = p.statusFormulirAdmin || 'Menunggu';
                const matchS = status === 'Semua' || normStatus === status;
                return matchQ && matchJ && matchS;
            });

            const tbody = document.getElementById('tableVerifikasiFormulirBody');
            if (!tbody) return;

            if (data.length === 0) {
                tbody.innerHTML = '<tr><td colspan="7" class="text-center text-muted py-4" style="font-size:13px;"><i class="bi bi-inbox me-1"></i> Belum ada formulir yang perlu diverifikasi</td></tr>';
                return;
            }

            tbody.innerHTML = data.map(p => {
                const fd = p.formData || {};
                const adminStatus = p.statusFormulirAdmin || 'Menunggu';
                const sudahFinal = adminStatus === 'Disetujui' || adminStatus === 'Ditolak';
                return `
        <tr>
            <td>
                <div class="fw-semibold text-dark" style="font-size:13px;">${p.nama}</div>
                <div class="text-muted" style="font-size:11px;">${p.noUrut || '–'} &bull; ${p.jalur || '–'}</div>
            </td>
            <td>${jalurBadge(p.jalur)}</td>
            <td style="font-size:12.5px;">${fd.inputAsalSekolah || '–'}</td>
            <td>
                <select class="form-select form-select-sm fw-bold" onchange="ubahStatusFormulir('${p.id}', this.value)" style="font-size:11px; border-radius:20px; padding:3px 10px; cursor:pointer; width:125px; ${getStatusSelectStyle(adminStatus)}">
                    <option value="Menunggu" ${adminStatus === 'Menunggu' ? 'selected' : ''}>Menunggu</option>
                    <option value="Disetujui" ${adminStatus === 'Disetujui' ? 'selected' : ''}>Disetujui</option>
                    <option value="Belum Valid" ${adminStatus === 'Belum Valid' ? 'selected' : ''}>Belum Valid</option>
                    <option value="Ditolak" ${adminStatus === 'Ditolak' ? 'selected' : ''}>Ditolak</option>
                </select>
            </td>
            <td style="font-size:11px;max-width:180px;">
                ${p.catatanFormulirAdmin
                        ? `<span class="d-block" style="color:#c2410c;line-height:1.4;">${p.catatanFormulirAdmin.substring(0, 60)}${p.catatanFormulirAdmin.length > 60 ? '...' : ''}</span>`
                        : '<span class="text-muted">–</span>'}
            </td>
            <td>
                <button class="btn btn-sm btn-outline-primary mb-1" onclick="openFormulirDetailModal('${p.id}')" style="border-radius:20px;font-size:10.5px;padding:3px 10px;"><i class="bi bi-search me-1"></i> Review Formulir</button>
                <button class="btn btn-sm mb-1" onclick="openCatatanModal('${p.id}','${p.nama.replace(/'/g, "\\'")}','formulir')" style="border-radius:20px;font-size:10.5px;padding:3px 10px;border:1px solid #6366f1;color:#6366f1;background:#f5f3ff;"><i class="bi bi-pencil-square me-1"></i> Kirim Catatan</button>
            </td>
        </tr>`;
            }).join('');
        }

        // ==================== RENDER: VERIFIKASI BERKAS ====================
        function renderVerifikasiBerkas() {
            const q = (document.getElementById('searchVerifBerkas')?.value || '').toLowerCase();
            const jalur = document.getElementById('filterJalurBerkas')?.value || 'Semua';
            const status = document.getElementById('filterStatusBerkas')?.value || 'Semua';

            const data = getPendaftar().filter(p => {
                if (p.statusBerkas !== 'Terkirim' && !['Belum Valid', 'Ditolak', 'Disetujui'].includes(p.statusBerkasAdmin)) return false;
                const matchQ = !q || (p.nama || '').toLowerCase().includes(q);
                const matchJ = jalur === 'Semua' || p.jalur === jalur;
                const matchS = status === 'Semua' || (p.statusBerkasAdmin || 'Menunggu') === status;
                return matchQ && matchJ && matchS;
            });

            const tbody = document.getElementById('tableVerifikasiBerkasBody');
            if (!tbody) return;

            if (data.length === 0) {
                tbody.innerHTML = '<tr><td colspan="7" class="text-center text-muted py-4" style="font-size:13px;"><i class="bi bi-inbox me-1"></i> Belum ada berkas yang perlu diverifikasi</td></tr>';
                return;
            }

            tbody.innerHTML = data.map(p => {
                const uf = p.uploadedFiles || {};
                const allKeys = Object.keys(uf).filter(k => uf[k]);
                const berkasStr = allKeys.length > 0 ? allKeys.join(', ') : '–';
                const adminStatus = p.statusBerkasAdmin || 'Menunggu';

                const wajib = ['KK', 'Akta', 'Rapor', 'Foto'];
                if (p.jalur === 'Prestasi') wajib.push('Sertifikat');
                if (p.jalur === 'Tahfidz') wajib.push('KetHafalan');
                const complete = wajib.every(k => uf[k]);
                const sudahFinal = adminStatus === 'Disetujui' || adminStatus === 'Ditolak';

                return `
        <tr>
            <td>
                <div class="fw-semibold text-dark" style="font-size:13px;">${p.nama}</div>
                <div class="text-muted" style="font-size:11px;">${p.noUrut || '–'}</div>
            </td>
            <td>${jalurBadge(p.jalur)}</td>
            <td style="font-size:11.5px;max-width:160px;">
                <span class="text-dark" title="${berkasStr}">${berkasStr.substring(0, 35)}${berkasStr.length > 35 ? '...' : ''}</span>
                ${!complete ? '<br><span class="text-danger" style="font-size:10px;"><i class="bi bi-exclamation-circle-fill me-1"></i> Berkas tidak lengkap</span>' : '<br><span class="text-success" style="font-size:10px;"><i class="bi bi-check-circle-fill me-1"></i> Lengkap</span>'}
            </td>
            <td>
                <select class="form-select form-select-sm fw-bold" onchange="ubahStatusBerkas('${p.id}', this.value)" style="font-size:11px; border-radius:20px; padding:3px 10px; cursor:pointer; width:125px; ${getStatusSelectStyle(adminStatus)}">
                    <option value="Menunggu" ${adminStatus === 'Menunggu' ? 'selected' : ''}>Menunggu</option>
                    <option value="Disetujui" ${adminStatus === 'Disetujui' ? 'selected' : ''}>Disetujui</option>
                    <option value="Belum Valid" ${adminStatus === 'Belum Valid' ? 'selected' : ''}>Belum Valid</option>
                    <option value="Ditolak" ${adminStatus === 'Ditolak' ? 'selected' : ''}>Ditolak</option>
                </select>
            </td>
            <td style="font-size:11px;max-width:160px;">
                ${p.catatanBerkasAdmin
                        ? `<span style="color:#c2410c;line-height:1.4;">${p.catatanBerkasAdmin.substring(0, 55)}${p.catatanBerkasAdmin.length > 55 ? '...' : ''}</span>`
                        : '<span class="text-muted">–</span>'}
            </td>
            <td>
                <button class="btn btn-sm btn-outline-primary mb-1" onclick="openBerkasReviewModal('${p.id}')" style="border-radius:20px;font-size:10.5px;padding:3px 10px;"><i class="bi bi-eye me-1"></i> Review Berkas</button>
                <button class="btn btn-sm mb-1" onclick="openCatatanModal('${p.id}','${p.nama.replace(/'/g, "\\'")}','berkas')" style="border-radius:20px;font-size:10.5px;padding:3px 10px;border:1px solid #6366f1;color:#6366f1;background:#f5f3ff;"><i class="bi bi-pencil-square me-1"></i> Kirim Catatan</button>
            </td>
        </tr>`;
            }).join('');
        }

        // ==================== RENDER: PEMBAYARAN ====================
        function renderPembayaran() {
            const q = (document.getElementById('searchPembayaran')?.value || '').toLowerCase();
            const status = document.getElementById('filterStatusBayar')?.value || 'Semua';

            const data = getPendaftar().filter(p => {
                const matchQ = !q || (p.nama || '').toLowerCase().includes(q);
                const payStatus = p.statusPembayaran || 'Belum Bayar';
                const matchS = status === 'Semua' || payStatus === status;
                return matchQ && matchS;
            });

            const tbody = document.getElementById('tablePembayaranBody');
            if (!tbody) return;

            if (data.length === 0) {
                tbody.innerHTML = '<tr><td colspan="6" class="text-center text-muted py-4" style="font-size:13px;"><i class="bi bi-inbox me-1"></i> Belum ada data pembayaran</td></tr>';
                return;
            }

            tbody.innerHTML = data.map(p => {
                const payStatus = p.statusPembayaran || 'Belum Bayar';
                const hasBukti = (p.uploadedFiles && p.uploadedFiles.BuktiTransfer) || p.buktiTransferManual;
                const catatan = p.catatanPembayaran || '–';
                const isReviewed = reviewedPayments[p.id] === true;

                return `
        <tr>
            <td>
                <div class="fw-semibold" style="font-size:13px;">${p.nama}</div>
                <div class="text-muted" style="font-size:11px;">${p.noUrut || '–'}</div>
            </td>
            <td>${jalurBadge(p.jalur)}</td>
            <td>${statusBadge(payStatus)}</td>
            <td>
                ${hasBukti ? `
                <div class="d-flex flex-column gap-1">
                    <div class="text-dark fw-semibold" style="font-size:11.5px;">Atas Nama: <span class="text-teal">${p.namaPengirim || '–'}</span></div>
                    <div class="d-flex gap-1 mt-1">
                        <button class="btn btn-sm btn-outline-primary" onclick="adminPreviewFile('${p.id}', 'BuktiTransfer'); markPaymentReviewed('${p.id}');" style="border-radius:20px;font-size:10.5px;padding:3px 10px;">
                            <i class="bi bi-eye me-1"></i> Review
                        </button>
                        <button class="btn btn-sm btn-outline-success" onclick="adminDownloadFile('${p.id}', 'BuktiTransfer')" style="border-radius:20px;font-size:10.5px;padding:3px 10px;">
                            <i class="bi bi-download me-1"></i> Unduh
                        </button>
                    </div>
                </div>
                ` : `<span class="text-muted" style="font-size:11.5px;">– Midtrans / Belum upload</span>`}
            </td>
            <td style="font-size:11.5px; max-width: 150px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;" title="${catatan}">
                ${catatan}
            </td>
            <td>
                ${payStatus === 'Menunggu Konfirmasi' ? `
                <div class="d-flex flex-column gap-1">
                    <div class="d-flex gap-1">
                        <button class="btn btn-sm btn-success fw-bold" onclick="konfirmasiPembayaran('${p.id}')" style="border-radius:20px;font-size:11px;padding:4px 12px;border:none;background:#16a34a;color:#fff;" ${!isReviewed ? 'disabled style="opacity: 0.55; cursor: not-allowed; border-radius:20px;font-size:11px;padding:4px 12px;border:none;background:#16a34a;color:#fff;"' : ''}>
                            <i class="bi bi-check-circle me-1"></i> Konfirmasi Lunas
                        </button>
                        <button class="btn btn-sm btn-danger fw-bold" onclick="openTolakPembayaranModal('${p.id}', '${p.nama.replace(/'/g, "\\'")}')" style="border-radius:20px;font-size:11px;padding:4px 12px;border:none;background:#dc2626;color:#fff;" ${!isReviewed ? 'disabled style="opacity: 0.55; cursor: not-allowed; border-radius:20px;font-size:11px;padding:4px 12px;border:none;background:#dc2626;color:#fff;"' : ''}>
                            <i class="bi bi-x-circle me-1"></i> Belum Bayar
                        </button>
                    </div>
                    ${!isReviewed ? `
                    <div class="text-danger mt-1" style="font-size: 9.5px; font-weight: 500;">
                        <i class="bi bi-exclamation-triangle-fill"></i> Review bukti terlebih dahulu
                    </div>
                    ` : ''}
                </div>` : payStatus === 'Lunas' ? `
                <div class="d-flex gap-1 align-items-center">
                    <span class="text-success fw-bold" style="font-size:11px;"><i class="bi bi-check-circle-fill me-1"></i> Sudah Lunas</span>
                    <button class="btn btn-sm btn-link text-danger p-0 ms-2" onclick="ubahStatusPembayaranManual('${p.id}', 'Belum Bayar')" style="font-size:11px;text-decoration:none;"><i class="bi bi-arrow-counterclockwise"></i> Reset</button>
                </div>
                ` : `
                <div class="d-flex gap-1 align-items-center">
                    <span class="text-muted" style="font-size:11px;">– Belum bayar</span>
                    <button class="btn btn-sm btn-outline-success" onclick="konfirmasiPembayaran('${p.id}')" style="border-radius:20px;font-size:10px;padding:2px 8px;"><i class="bi bi-check-circle"></i> Tandai Lunas</button>
                </div>
                `}
            </td>
        </tr>`;
            }).join('');
        }

        function markPaymentReviewed(siswaId) {
            reviewedPayments[siswaId] = true;
            renderPembayaran();
        }

        // ==================== RENDER: SELEKSI ====================
        function renderSeleksi() {
            const data = getPendaftar().filter(p => p.statusFormulirAdmin === 'Disetujui' && p.statusBerkasAdmin === 'Disetujui');
            const tbody = document.getElementById('tableSeleksiBody');
            if (!tbody) return;

            if (data.length === 0) {
                tbody.innerHTML = '<tr><td colspan="4" class="text-center text-muted py-4" style="font-size:13px;"><i class="bi bi-inbox me-1"></i> Belum ada pendaftar yang siap diseleksi</td></tr>';
                return;
            }

            tbody.innerHTML = data.map(p => {
                const hasil = p.hasilSeleksi || '';
                const nilai = p.nilaiUjian || null;

                let studentCellContent = '';
                if (nilai) {
                    studentCellContent = `
                <div class="d-flex align-items-center flex-wrap gap-2">
                    <span class="fw-bold text-dark">${p.nama}</span>
                    <span class="badge badge-info py-1 px-2 fw-medium" style="font-size:10.5px; border-radius:6px; background-color: var(--toska-50) !important; color: var(--toska-800) !important; border: 1px solid var(--toska-200) !important;">
                        PAI: ${nilai.pai !== undefined ? nilai.pai : '-'} | Ind: ${nilai.ind} | IPA: ${nilai.ipa} | IPS: ${nilai.ips !== undefined ? nilai.ips : '-'} | Mat: ${nilai.mat} | BTQ: ${nilai.btq}
                    </span>
                </div>
            `;
                } else {
                    studentCellContent = `
                <div class="d-flex align-items-center flex-wrap gap-2">
                    <span class="fw-bold text-dark">${p.nama}</span>
                    <span class="badge py-1 px-2 fw-semibold" style="font-size:10.5px; border-radius:6px; background-color: #fef2f2 !important; color: #dc2626 !important; border: 1px solid #fca5a5 !important;">
                        <i class="bi bi-exclamation-triangle-fill me-1"></i> Nilai belum diinput
                    </span>
                </div>
            `;
                }

                return `
        <tr>
            <td style="font-size:13px; vertical-align: middle;">
                ${studentCellContent}
            </td>
            <td>${jalurBadge(p.jalur)}</td>
            <td>${hasil ? statusBadge(hasil) : '<span class="text-muted" style="font-size:11.5px;">– Belum ditentukan</span>'}</td>
            <td>
                ${!nilai ? `
                <button class="btn btn-sm btn-toska px-3 py-1.5" onclick="openNilaiModal('${p.id}')" style="border-radius:20px; font-size:11.5px; font-weight:600;"><i class="bi bi-pencil-square me-1"></i> Input Nilai</button>
                ` : `
                ${!hasil ? `
                <button class="btn btn-sm btn-success me-1" onclick="setHasilSeleksi('${p.id}','Lulus')" style="border-radius:20px;font-size:11px;padding:3px 10px;border:none;background:#16a34a;color:#fff;"><i class="bi bi-check-circle-fill me-1"></i> Lulus</button>
                <button class="btn btn-sm btn-danger me-2" onclick="setHasilSeleksi('${p.id}','Tidak Lulus')" style="border-radius:20px;font-size:11px;padding:3px 10px;"><i class="bi bi-x-circle-fill me-1"></i> Tidak Lulus</button>
                ` : `<span class="text-muted me-2" style="font-size:11.5px;">Sudah ditentukan</span>`}
                
                <button class="btn btn-sm btn-outline-secondary px-2.5 py-1" onclick="openNilaiModal('${p.id}')" style="border-radius:20px; font-size:10.5px; font-weight: 500;"><i class="bi bi-pencil-square me-1"></i> ${hasil ? 'Edit Nilai' : 'Edit'}</button>
                ${hasil ? `<button class="btn btn-sm btn-link text-warning ms-1" onclick="resetHasilSeleksi('${p.id}')" style="font-size:11.5px; text-decoration:none; padding: 0;"><i class="bi bi-arrow-counterclockwise me-1"></i> Reset</button>` : ''}
                `}
            </td>
        </tr>`;
            }).join('');
        }

        function getStatusSelectStyle(status) {
            if (status === 'Disetujui') {
                return 'background-color: #dcfce7; color: #16a34a; border-color: #86efac;';
            } else if (status === 'Belum Valid') {
                return 'background-color: #fff7ed; color: #ea580c; border-color: #fdba74;';
            } else if (status === 'Ditolak') {
                return 'background-color: #fef2f2; color: #dc2626; border-color: #fca5a5;';
            }
            return 'background-color: #f1f5f9; color: #475569; border-color: #cbd5e1;';
        }

        function ubahStatusFormulir(id, status, nama) {
            if (status === 'Disetujui') {
                setujuiFormulir(id);
            } else if (status === 'Belum Valid') {
                belumValidFormulir(id, nama);
            } else if (status === 'Ditolak') {
                openTolakFormulirModal(id, nama);
            } else if (status === 'Menunggu') {
                // Reset ke Menunggu — simpan lokal untuk sesi ini
                applyLocalOverride(id, { statusFormulirAdmin: 'Menunggu', catatanFormulirAdmin: '' });
                const p = getPendaftar().find(x => x.id === id);
                if (p) addAdminNotif({ tipe: 'formulir_reset', pesan: 'Formulir ' + p.nama + ' dikembalikan ke Menunggu.', emoji: '<i class="bi bi-hourglass-split text-warning"></i>' });
                showToast('<i class="bi bi-hourglass-split text-warning"></i>', 'Status Di-reset', 'Status formulir dikembalikan ke Menunggu.');
                renderVerifikasiFormulir(); updateDashboardStats(); refreshDetailModalBadges();
            }
        }

        function ubahStatusBerkas(id, status, nama) {
            if (status === 'Disetujui') {
                setujuiBerkas(id);
            } else if (status === 'Belum Valid') {
                belumValidBerkas(id, nama);
            } else if (status === 'Ditolak') {
                openTolakBerkasModal(id, nama);
            } else if (status === 'Menunggu') {
                fetch('/admin/berkas/reset/' + id, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF_TOKEN }
                })
                .then(r => r.json())
                .then(data => {
                    if (data.success) {
                        applyLocalOverride(id, { statusBerkasAdmin: 'Menunggu', catatanBerkasAdmin: '' });
                        const p = getPendaftar().find(x => x.id === id);
                        if (p) addAdminNotif({ tipe: 'berkas_reset', pesan: 'Berkas ' + p.nama + ' dikembalikan ke Menunggu.', emoji: '<i class="bi bi-hourglass-split text-warning"></i>' });
                        showToast('<i class="bi bi-hourglass-split text-warning"></i>', 'Status Di-reset', 'Status berkas dikembalikan ke Menunggu.');
                        renderVerifikasiBerkas(); updateDashboardStats(); refreshDetailModalBadges();
                    }
                });
            }
        }

        // ==================== ACTIONS: SETUJUI / BELUM VALID / TOLAK ====================
        function setujuiFormulir(id) {
            const p = getPendaftar().find(x => x.id === id);
            if (!p) return;
            fetch('/admin/formulir/setujui/' + id, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF_TOKEN }
            })
            .then(r => r.json())
            .then(data => {
                if (data.success) {
                    applyLocalOverride(id, { statusFormulirAdmin: 'Disetujui', catatanFormulirAdmin: '' });
                    addAdminNotif({ tipe: 'formulir_setujui', pesan: 'Formulir ' + p.nama + ' berhasil disetujui.', emoji: '<i class="bi bi-check-circle-fill text-success"></i>' });
                    addRecentActivity({ text: 'Formulir ' + p.nama + ' disetujui', emoji: '<i class="bi bi-check-circle-fill text-success"></i>', time: new Date().toLocaleTimeString('id-ID') });
                    showToast('<i class="bi bi-check-circle-fill text-success"></i>', 'Formulir Disetujui', 'Notifikasi terkirim ke ' + p.nama);
                    renderVerifikasiFormulir(); updateDashboardStats(); refreshDetailModalBadges();
                } else {
                    alert('Gagal menyetujui formulir: ' + (data.message || 'Terjadi kesalahan'));
                }
            })
            .catch(() => alert('Koneksi gagal saat menyetujui formulir.'));
        }

        function belumValidFormulir(id, nama) {
            // Open tolak modal with 'Belum Valid' preset
            currentTolakId = id;
            currentTolakStatus = 'Belum Valid';
            const el = document.getElementById('tolakFormNama');
            if (el) el.textContent = nama + ' (Belum Valid)';
            const inp = document.getElementById('inputCatatanFormulir');
            if (inp) inp.value = '';
            const modalEl = document.getElementById('modalTolakFormulir');
            if (modalEl) {
                modalEl.style.display = 'flex';
                const h5 = modalEl.querySelector('h5');
                if (h5) h5.innerHTML = '<i class="bi bi-exclamation-triangle-fill text-warning me-1"></i> Tandai Formulir Belum Valid';
            }
        }

        function confirmTolakFormulir() {
            const catatan = document.getElementById('inputCatatanFormulir').value.trim();
            if (!catatan) { document.getElementById('inputCatatanFormulir').style.borderColor = '#ef4444'; return; }

            const p = getPendaftar().find(x => x.id === currentTolakId);
            if (!p) return;
            const newStatus = currentTolakStatus || 'Ditolak';

            fetch('/admin/formulir/tolak/' + currentTolakId, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF_TOKEN },
                body: JSON.stringify({ catatan: catatan })
            })
            .then(r => r.json())
            .then(data => {
                if (data.success) {
                    applyLocalOverride(currentTolakId, { statusFormulirAdmin: newStatus, catatanFormulirAdmin: catatan, statusFormulir: 'Belum' });
                    addAdminNotif({ tipe: 'formulir_tolak', pesan: 'Formulir ' + p.nama + ' ' + newStatus + ': ' + catatan.substring(0, 50), emoji: newStatus === 'Belum Valid' ? '<i class="bi bi-exclamation-triangle-fill text-warning"></i>' : '<i class="bi bi-x-circle-fill text-danger"></i>' });
                    addRecentActivity({ text: 'Formulir ' + p.nama + ': ' + newStatus, emoji: '<i class="bi bi-x-circle-fill text-danger"></i>', time: new Date().toLocaleTimeString('id-ID') });
                    closeTolakFormulirModal();
                    showToast(newStatus === 'Belum Valid' ? '<i class="bi bi-exclamation-triangle-fill text-warning"></i>' : '<i class="bi bi-x-circle-fill text-danger"></i>', 'Formulir ' + newStatus, 'Catatan dikirim ke ' + p.nama);
                    renderVerifikasiFormulir(); updateDashboardStats(); refreshDetailModalBadges();
                } else {
                    alert('Gagal menolak formulir: ' + (data.message || 'Terjadi kesalahan'));
                }
            })
            .catch(() => alert('Koneksi gagal saat menolak formulir.'));
        }

        function setujuiBerkas(id) {
            const p = getPendaftar().find(x => x.id === id);
            if (!p) return;
            fetch('/admin/berkas/setujui/' + id, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF_TOKEN }
            })
            .then(r => r.json())
            .then(data => {
                if (data.success) {
                    applyLocalOverride(id, { statusBerkasAdmin: 'Disetujui', catatanBerkasAdmin: '' });
                    addAdminNotif({ tipe: 'berkas_setujui', pesan: 'Berkas ' + p.nama + ' disetujui!', emoji: '<i class="bi bi-folder-fill text-warning"></i>' });
                    addRecentActivity({ text: 'Berkas ' + p.nama + ' disetujui', emoji: '<i class="bi bi-folder-fill text-warning"></i>', time: new Date().toLocaleTimeString('id-ID') });
                    showToast('<i class="bi bi-folder-fill text-warning"></i>', 'Berkas Disetujui', p.nama + ' — berkas valid');
                    renderVerifikasiBerkas(); updateDashboardStats(); refreshDetailModalBadges();
                } else {
                    alert('Gagal menyetujui berkas: ' + (data.message || 'Terjadi kesalahan'));
                }
            })
            .catch(() => alert('Koneksi gagal saat menyetujui berkas.'));
        }

        function belumValidBerkas(id, nama) {
            currentTolakId = id;
            currentTolakStatus = 'Belum Valid';
            const el = document.getElementById('tolakBerkasNama');
            if (el) el.textContent = nama + ' (Belum Valid)';
            const inp = document.getElementById('inputCatatanBerkas');
            if (inp) inp.value = '';
            const modalEl = document.getElementById('modalTolakBerkas');
            if (modalEl) {
                modalEl.style.display = 'flex';
                const h5 = modalEl.querySelector('h5');
                if (h5) h5.innerHTML = '<i class="bi bi-exclamation-triangle-fill text-warning me-1"></i> Tandai Berkas Belum Valid';
            }
        }

        function confirmTolakBerkas() {
            const catatan = document.getElementById('inputCatatanBerkas').value.trim();
            if (!catatan) { document.getElementById('inputCatatanBerkas').style.borderColor = '#ef4444'; return; }

            const p = getPendaftar().find(x => x.id === currentTolakId);
            if (!p) return;
            const newStatus = currentTolakStatus || 'Ditolak';

            fetch('/admin/berkas/tolak/' + currentTolakId, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF_TOKEN },
                body: JSON.stringify({ catatan: catatan })
            })
            .then(r => r.json())
            .then(data => {
                if (data.success) {
                    applyLocalOverride(currentTolakId, { statusBerkasAdmin: newStatus, catatanBerkasAdmin: catatan, statusBerkas: 'Belum' });
                    addAdminNotif({ tipe: 'berkas_tolak', pesan: 'Berkas ' + p.nama + ' ' + newStatus + ': ' + catatan.substring(0, 50), emoji: newStatus === 'Belum Valid' ? '<i class="bi bi-exclamation-triangle-fill text-warning"></i>' : '<i class="bi bi-x-circle-fill text-danger"></i>' });
                    addRecentActivity({ text: 'Berkas ' + p.nama + ': ' + newStatus, emoji: '<i class="bi bi-x-circle-fill text-danger"></i>', time: new Date().toLocaleTimeString('id-ID') });
                    closeTolakBerkasModal();
                    showToast(newStatus === 'Belum Valid' ? '<i class="bi bi-exclamation-triangle-fill text-warning"></i>' : '<i class="bi bi-x-circle-fill text-danger"></i>', 'Berkas ' + newStatus, 'Catatan dikirim ke ' + p.nama);
                    renderVerifikasiBerkas(); updateDashboardStats(); refreshDetailModalBadges();
                } else {
                    alert('Gagal menolak berkas: ' + (data.message || 'Terjadi kesalahan'));
                }
            })
            .catch(() => alert('Koneksi gagal saat menolak berkas.'));
        }

        function konfirmasiPembayaran(id) {
            const p = getPendaftar().find(x => x.id === id);
            if (!p) return;

            fetch('/admin/payment/confirm-lunas/' + id, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF_TOKEN }
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    applyLocalOverride(id, { statusPembayaran: 'Lunas', catatanPembayaran: '' });
                    addAdminNotif({ tipe: 'pembayaran_lunas', pesan: 'Pembayaran ' + p.nama + ' dikonfirmasi lunas.', emoji: '<i class="bi bi-credit-card-fill text-primary"></i>' });
                    addRecentActivity({ text: 'Pembayaran ' + p.nama + ' dikonfirmasi lunas', emoji: '<i class="bi bi-credit-card-fill text-primary"></i>', time: new Date().toLocaleTimeString('id-ID') });
                    showToast('<i class="bi bi-credit-card-fill text-primary"></i>', 'Pembayaran Dikonfirmasi!', p.nama + ' — Kartu ujian terbuka!');
                    renderPembayaran(); updateDashboardStats();
                } else {
                    alert('Gagal mengonfirmasi pembayaran: ' + (data.error || 'Terjadi kesalahan'));
                }
            })
            .catch(() => alert('Terjadi kesalahan koneksi saat mengonfirmasi pembayaran.'));
        }

        let currentPembayaranTolakId = null;
        function openTolakPembayaranModal(id, nama) {
            currentPembayaranTolakId = id;
            document.getElementById('tolakPembayaranNama').textContent = nama;
            document.getElementById('inputCatatanPembayaran').value = '';
            document.getElementById('inputCatatanPembayaran').style.borderColor = '';
            document.getElementById('modalTolakPembayaran').style.display = 'flex';
        }
        function closeTolakPembayaranModal() {
            currentPembayaranTolakId = null;
            document.getElementById('modalTolakPembayaran').style.display = 'none';
        }
        function confirmTolakPembayaran() {
            const catatan = document.getElementById('inputCatatanPembayaran').value.trim();
            if (!catatan) { document.getElementById('inputCatatanPembayaran').style.borderColor = '#ef4444'; return; }

            const p = getPendaftar().find(x => x.id === currentPembayaranTolakId);
            if (!p) return;

            fetch('/admin/payment/reject/' + currentPembayaranTolakId, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF_TOKEN },
                body: JSON.stringify({ catatan: catatan })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    applyLocalOverride(currentPembayaranTolakId, { statusPembayaran: 'Belum Bayar', catatanPembayaran: catatan });
                    addAdminNotif({ tipe: 'pembayaran_tolak', pesan: 'Pembayaran ' + p.nama + ' ditolak: ' + catatan.substring(0, 50), emoji: '<i class="bi bi-x-circle-fill text-danger"></i>' });
                    addRecentActivity({ text: 'Pembayaran ' + p.nama + ' ditolak', emoji: '<i class="bi bi-x-circle-fill text-danger"></i>', time: new Date().toLocaleTimeString('id-ID') });
                    closeTolakPembayaranModal();
                    showToast('<i class="bi bi-x-circle-fill text-danger"></i>', 'Pembayaran Ditolak', 'Catatan terkirim ke ' + p.nama);
                    renderPembayaran(); updateDashboardStats();
                } else {
                    alert('Gagal menolak pembayaran: ' + (data.error || 'Terjadi kesalahan'));
                }
            })
            .catch(() => alert('Terjadi kesalahan koneksi saat memproses penolakan pembayaran.'));
        }

        function ubahStatusPembayaranManual(id, status) {
            if (status === 'Belum Bayar') {
                const p = getPendaftar().find(x => x.id === id);
                openTolakPembayaranModal(id, p ? p.nama : '');
            }
        }

        function hapusCalonSiswa(id, nama) {
            if (!confirm('Apakah Anda yakin ingin menghapus data pendaftar ' + nama + '? Semua data formulir, berkas, dan pembayaran yang bersangkutan akan dihapus permanen.')) {
                return;
            }

            // Kirim request DELETE ke backend MySQL
            fetch('/admin/pendaftar/delete/' + id, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
                .then(res => res.json())
                .then(data => {
                    // Hapus data dari override lokal
                    delete _localOverride[id];

                    // Reload halaman agar data DB terupdate (data sudah dihapus dari server)
                    addAdminNotif({ tipe: 'pendaftar_dihapus', pesan: 'Data pendaftar ' + nama + ' telah dihapus permanen.', emoji: '<i class="bi bi-trash-fill text-danger"></i>' });
                    addRecentActivity({ text: 'Menghapus pendaftar: ' + nama, emoji: '<i class="bi bi-trash-fill text-danger"></i>', time: new Date().toLocaleTimeString('id-ID') });
                    showToast('<i class="bi bi-trash-fill text-danger"></i>', 'Data Dihapus!', 'Data calon siswa ' + nama + ' telah dihapus.');

                    // Reload halaman setelah 1,5 detik agar DB_PENDAFTAR diperbarui
                    setTimeout(() => location.reload(), 1500);
                })
                .catch(err => {
                    console.error(err);
                    alert('Gagal menghapus data. Pastikan server berjalan dan coba lagi.');
                });
        }

        // Kirim catatan terpisah tanpa mengubah status
        let currentCatatanId = null, currentCatatanType = null;
        function openCatatanModal(id, nama, type) {
            currentCatatanId = id;
            currentCatatanType = type;
            const p = getPendaftar().find(x => x.id === id);
            const existingCatatan = type === 'formulir' ? (p?.catatanFormulirAdmin || '') : (p?.catatanBerkasAdmin || '');
            const modal = document.getElementById('modalKirimCatatan');
            const nameEl = document.getElementById('catatanNama');
            const typeEl = document.getElementById('catatanType');
            const inp = document.getElementById('inputCatatanKirim');
            if (nameEl) nameEl.textContent = nama;
            if (typeEl) typeEl.innerHTML = type === 'formulir' ? '<i class="bi bi-file-earmark-text me-1"></i> Formulir' : '<i class="bi bi-folder-fill me-1"></i> Berkas';
            if (inp) inp.value = existingCatatan;
            if (modal) modal.style.display = 'flex';
        }
        function closeCatatanModal() {
            currentCatatanId = null;
            currentCatatanType = null;
            const modal = document.getElementById('modalKirimCatatan');
            if (modal) modal.style.display = 'none';
        }
        function confirmKirimCatatan() {
            const catatan = document.getElementById('inputCatatanKirim').value.trim();
            if (!catatan) { document.getElementById('inputCatatanKirim').style.borderColor = '#ef4444'; return; }
            const adminState = getAdminState();
            const p = adminState.pendaftar.find(x => x.id === currentCatatanId);
            if (!p) return;
            if (currentCatatanType === 'formulir') {
                p.catatanFormulirAdmin = catatan;
                updateSiswaState(currentCatatanId, { catatanFormulirAdmin: catatan });
            } else {
                p.catatanBerkasAdmin = catatan;
                updateSiswaState(currentCatatanId, { catatanBerkasAdmin: catatan });
            }
            saveAdminState(adminState);
            closeCatatanModal();
            showToast('<i class="bi bi-pencil-square text-primary"></i>', 'Catatan Terkirim', 'Catatan dikirim ke ' + p.nama);
            renderVerifikasiFormulir();
            renderVerifikasiBerkas();
        }

        function setHasilSeleksi(id, hasil) {
            const adminState = getAdminState();
            const p = adminState.pendaftar.find(x => x.id === id);
            if (!p) return;
            p.hasilSeleksi = hasil;
            saveAdminState(adminState);
            updateSiswaState(id, { hasilSeleksi: hasil });
            showToast(hasil === 'Lulus' ? '<i class="bi bi-check-circle-fill text-success"></i>' : '<i class="bi bi-x-circle-fill text-danger"></i>', 'Hasil Seleksi Ditetapkan', p.nama + ': ' + hasil);
            renderSeleksi();
        }

        function resetHasilSeleksi(id) {
            const adminState = getAdminState();
            const p = adminState.pendaftar.find(x => x.id === id);
            if (!p) return;
            p.hasilSeleksi = '';
            saveAdminState(adminState);
            updateSiswaState(id, { hasilSeleksi: '' });
            showToast('<i class="bi bi-arrow-counterclockwise text-warning"></i>', 'Hasil Seleksi Di-reset', 'Status seleksi untuk ' + p.nama + ' telah dikembalikan.');
            renderSeleksi();
        }

        function openNilaiModal(id) {
            const adminState = getAdminState();
            const p = adminState.pendaftar.find(x => x.id === id);
            if (!p) return;

            document.getElementById('nilaiSiswaId').value = id;
            document.getElementById('nilaiSiswaNama').textContent = p.nama;

            const nilai = p.nilaiUjian || {};
            document.getElementById('inputNilaiPai').value = nilai.pai !== undefined ? nilai.pai : '';
            document.getElementById('inputNilaiInd').value = nilai.ind !== undefined ? nilai.ind : '';
            document.getElementById('inputNilaiIpa').value = nilai.ipa !== undefined ? nilai.ipa : '';
            document.getElementById('inputNilaiIps').value = nilai.ips !== undefined ? nilai.ips : '';
            document.getElementById('inputNilaiMat').value = nilai.mat !== undefined ? nilai.mat : '';
            document.getElementById('inputNilaiBtq').value = nilai.btq !== undefined ? nilai.btq : '';

            document.getElementById('modalInputNilai').style.display = 'flex';
        }

        // Close modal helper
        function closeNilaiModal() {
            document.getElementById('modalInputNilai').style.display = 'none';
        }

        function saveNilaiUjian() {
            const id = document.getElementById('nilaiSiswaId').value;
            const adminState = getAdminState();
            const p = adminState.pendaftar.find(x => x.id === id);
            if (!p) return;

            const pai = document.getElementById('inputNilaiPai').value.trim();
            const ind = document.getElementById('inputNilaiInd').value.trim();
            const ipa = document.getElementById('inputNilaiIpa').value.trim();
            const ips = document.getElementById('inputNilaiIps').value.trim();
            const mat = document.getElementById('inputNilaiMat').value.trim();
            const btq = document.getElementById('inputNilaiBtq').value.trim();

            if (pai === '' || ind === '' || ipa === '' || ips === '' || mat === '' || btq === '') {
                showToast('<i class="bi bi-exclamation-triangle-fill text-warning"></i>', 'Nilai Wajib Diisi', 'PAI, Bahasa Indonesia, IPA, IPS, Matematika, dan BTQ wajib diisi.');
                return;
            }

            const nPai = Number(pai);
            const nInd = Number(ind);
            const nIpa = Number(ipa);
            const nIps = Number(ips);
            const nMat = Number(mat);
            const nBtq = Number(btq);

            if (nPai < 0 || nPai > 100 || nInd < 0 || nInd > 100 || nIpa < 0 || nIpa > 100 || nIps < 0 || nIps > 100 || nMat < 0 || nMat > 100 || nBtq < 0 || nBtq > 100) {
                showToast('<i class="bi bi-exclamation-triangle-fill text-warning"></i>', 'Nilai Tidak Valid', 'Semua nilai harus bernilai antara 0 - 100.');
                return;
            }

            p.nilaiUjian = {
                pai: nPai,
                ind: nInd,
                ipa: nIpa,
                ips: nIps,
                mat: nMat,
                btq: nBtq
            };

            saveAdminState(adminState);
            updateSiswaState(id, { nilaiUjian: p.nilaiUjian });

            addRecentActivity({
                text: 'Menginput nilai ujian seleksi untuk ' + p.nama,
                emoji: '<i class="bi bi-journal-check text-teal"></i>',
                time: new Date().toLocaleTimeString('id-ID')
            });

            closeNilaiModal();
            showToast('<i class="bi bi-journal-check text-teal"></i>', 'Nilai Berhasil Disimpan', 'Nilai ujian ' + p.nama + ' telah disimpan.');
            renderSeleksi();
        }

        // Update siswa state (via shared localStorage key per siswa)
        function updateSiswaState(siswaId, updates) {
            const key = 'ppdbState_' + siswaId;
            let state = {};
            try { state = JSON.parse(localStorage.getItem(key)) || {}; } catch (e) { }
            state = Object.assign(state, updates);
            localStorage.setItem(key, JSON.stringify(state));
        }

        // ==================== MODAL HELPERS ====================
        function openTolakFormulirModal(id, nama) {
            currentTolakId = id;
            document.getElementById('tolakFormNama').textContent = nama;
            document.getElementById('inputCatatanFormulir').value = '';
            document.getElementById('inputCatatanFormulir').style.borderColor = '';
            document.getElementById('modalTolakFormulir').style.display = 'flex';
        }
        function closeTolakFormulirModal() {
            currentTolakId = null;
            document.getElementById('modalTolakFormulir').style.display = 'none';
            renderVerifikasiFormulir();
        }

        function openTolakBerkasModal(id, nama) {
            currentTolakId = id;
            document.getElementById('tolakBerkasNama').textContent = nama;
            document.getElementById('inputCatatanBerkas').value = '';
            document.getElementById('inputCatatanBerkas').style.borderColor = '';
            document.getElementById('modalTolakBerkas').style.display = 'flex';
        }
        function closeTolakBerkasModal() {
            currentTolakId = null;
            document.getElementById('modalTolakBerkas').style.display = 'none';
            renderVerifikasiBerkas();
        }

        function getFileLabel(k) {
            const labels = {
                'KK': 'Scan Kartu Keluarga (KK)',
                'Akta': 'Scan Akta Kelahiran',
                'Rapor': 'Scan Rapor Nilai',
                'Foto': 'Pas Foto Resmi 3x4',
                'Sertifikat': 'Sertifikat Prestasi',
                'Rekomen': 'Surat Rekomendasi',
                'KetHafalan': 'Keterangan Hafalan',
                'KetLembaga': 'Keterangan Lembaga'
            };
            return labels[k] || k;
        }

        function previewSimulatedFile(type, name, siswaId) {
            document.querySelectorAll('.btn-preview-file').forEach(btn => {
                btn.style.background = 'linear-gradient(135deg,#0d9488,#0f766e)';
            });
            const activeBtn = document.getElementById('btnPreview_' + type);
            if (activeBtn) activeBtn.style.background = 'linear-gradient(135deg,#4f46e5,#3730a3)';

            const previewPanel = document.getElementById('documentPreviewPanel');
            if (!previewPanel) return;

            previewPanel.style.borderStyle = 'solid';
            previewPanel.style.borderColor = '#e2e8f0';
            previewPanel.style.background = '#f8fafc';
            previewPanel.style.textAlign = 'left';
            previewPanel.style.alignItems = 'stretch';
            previewPanel.style.justifyContent = 'flex-start';

            let content = '';

            if (type === 'Foto') {
                let photoSrc = '';
                try {
                    const state = JSON.parse(localStorage.getItem('ppdbState_' + siswaId)) || {};
                    photoSrc = state.cardPhotoSrc || '';
                } catch (e) { }

                content = `
            <div style="background:#fff;border-radius:12px;box-shadow:0 4px 12px rgba(0,0,0,0.06);padding:24px;text-align:center;height:100%;display:flex;flex-direction:column;align-items:center;justify-content:center;">
                <div style="font-size:13.5px;font-weight:700;color:#0f766e;margin-bottom:12px;text-transform:uppercase;letter-spacing:0.5px;">Pas Foto Calon Siswa (3x4)</div>
                <div style="width:45mm;height:60mm;border:3px solid #e2e8f0;border-radius:6px;overflow:hidden;box-shadow:0 6px 16px rgba(0,0,0,0.15);background:${photoSrc ? '#fff' : '#2563eb'};display:flex;align-items:center;justify-content:center;position:relative;">
                    ${photoSrc
                        ? `<img src="${photoSrc}" style="width:100%;height:100%;object-fit:cover;">`
                        : `<div style="text-align:center;color:#fff;"><i class="bi bi-person text-white" style="font-size:42px;display:block;margin-bottom:8px;"></i><div style="font-size:10px;font-weight:700;letter-spacing:1px;line-height:1.2;">PAS FOTO<br>BACKGROUND BIRU</div></div>`
                    }
                </div>
                <div style="margin-top:16px;font-size:13px;color:#64748b;">Nama: <strong>${name}</strong></div>
            </div>
        `;
            } else if (type === 'KK') {
                content = `
            <div style="background:#fff;border-radius:12px;box-shadow:0 6px 16px rgba(0,0,0,0.06);padding:28px;border:1.5px solid #cbd5e1;font-family:sans-serif;color:#1e293b;line-height:1.4;">
                <div style="text-align:center;border-bottom:2.5px solid #1e293b;padding-bottom:12px;margin-bottom:16px;">
                    <div style="font-size:12px;font-weight:800;letter-spacing:1px;">REPUBLIK INDONESIA</div>
                    <div style="font-size:16px;font-weight:900;color:#1e3a8a;margin:3px 0;">KARTU KELUARGA</div>
                    <div style="font-size:11.5px;color:#475569;font-weight:600;">No. 3201234567890012</div>
                </div>
                <table style="width:100%;font-size:11.5px;border-collapse:collapse;margin-bottom:16px;">
                    <tr style="border-bottom:2px solid #cbd5e1;background:#f8fafc;font-weight:700;color:#334155;text-align:left;">
                        <td style="padding:8px 6px;width:8%;">No</td>
                        <td style="padding:8px 6px;width:37%;">Nama Lengkap</td>
                        <td style="padding:8px 6px;width:35%;">NIK</td>
                        <td style="padding:8px 6px;width:20%;">Hubungan</td>
                    </tr>
                    <tr style="border-bottom:1px solid #e2e8f0;">
                        <td style="padding:8px 6px;">1</td>
                        <td style="padding:8px 6px;"><strong>${name}</strong></td>
                        <td style="padding:8px 6px;font-family:monospace;letter-spacing:0.5px;">3201234567890001</td>
                        <td style="padding:8px 6px;color:#2563eb;font-weight:700;font-size:10.5px;">ANAK</td>
                    </tr>
                    <tr style="border-bottom:1px solid #e2e8f0;">
                        <td style="padding:8px 6px;">2</td>
                        <td style="padding:8px 6px;">Supriyadi (Simulasi)</td>
                        <td style="padding:8px 6px;font-family:monospace;letter-spacing:0.5px;">3201234567890002</td>
                        <td style="padding:8px 6px;font-weight:600;">KEPALA KELUARGA</td>
                    </tr>
                </table>
                <div style="display:flex;justify-content:space-between;align-items:flex-end;font-size:10.5px;margin-top:20px;color:#475569;">
                    <div>
                        <div>Dikeluarkan: Banten</div>
                        <div>Tanggal: 12-05-2018</div>
                    </div>
                    <div style="text-align:center;">
                        <div style="font-weight:700;color:#1e293b;margin-bottom:2px;">KEPALA DINAS DUKCAPIL</div>
                        <div style="font-family:'Courier New',monospace;font-size:10px;color:#16a34a;border:1.5px solid #16a34a;padding:2px 6px;margin:5px 0;display:inline-block;border-radius:4px;font-weight:bold;transform:rotate(-3deg);background:#f0fdf4;">SIGNED & VERIFIED</div>
                        <div style="text-decoration:underline;font-weight:700;color:#1e293b;">Drs. H. Mulyono, M.Si</div>
                    </div>
                </div>
            </div>
        `;
            } else if (type === 'Akta') {
                content = `
            <div style="background:#fffbeb;border-radius:12px;box-shadow:0 6px 16px rgba(0,0,0,0.06);padding:30px;border:2px solid #d97706;font-family:sans-serif;color:#1e293b;position:relative;line-height:1.5;">
                <div style="position:absolute;top:15px;right:15px;font-size:24px;opacity:0.08;font-weight:bold;letter-spacing:1px;">INDONESIA</div>
                <div style="text-align:center;margin-bottom:20px;border-bottom:1px solid rgba(217,119,6,0.2);padding-bottom:12px;">
                    <div style="font-size:13.5px;font-weight:900;color:#92400e;letter-spacing:1px;">PENCATATAN SIPIL</div>
                    <div style="font-size:11px;font-weight:700;color:#64748b;letter-spacing:0.5px;">CITIZENSHIP REGISTRY</div>
                    <div style="font-size:16px;font-weight:900;color:#b45309;margin-top:6px;letter-spacing:1.5px;">AKTA KELAHIRAN</div>
                    <div style="font-size:9.5px;color:#d97706;font-weight:bold;margin-top:2px;letter-spacing:0.5px;">BIRTH CERTIFICATE</div>
                </div>
                <div style="font-size:12.5px;line-height:1.8;margin-bottom:20px;padding-left:14px;border-left:3px solid #d97706;color:#334155;">
                    Bahwa di <strong style="color:#92400e;">TANGERANG</strong> pada tanggal <strong style="color:#92400e;">15 OKTOBER 2012</strong> telah lahir seorang anak:<br>
                    <span style="font-size:15px;font-weight:800;color:#92400e;display:block;margin:6px 0;text-transform:uppercase;letter-spacing:0.5px;">${name}</span>
                    dari pasangan suami istri sah:<br>
                    Ayah: <strong style="color:#1e293b;">Ahmad Supriyadi</strong> &nbsp;|&nbsp; Ibu: <strong style="color:#1e293b;">Siti Aminah</strong>.
                </div>
                <div style="display:flex;justify-content:space-between;align-items:center;font-size:10.5px;margin-top:24px;border-top:1.5px solid rgba(217,119,6,0.25);padding-top:14px;">
                    <span style="color:#d97706;font-weight:800;font-size:9.5px;letter-spacing:0.5px;">KEMENTERIAN DALAM NEGERI</span>
                    <div style="text-align:right;color:#475569;">
                        <div>Pejabat Pencatatan Sipil</div>
                        <div style="font-family:'Courier New',monospace;font-weight:bold;color:#10b981;border:1px solid #10b981;border-radius:4px;padding:2px 6px;margin:4px 0;display:inline-block;background:#ecfdf5;font-size:9px;">STAMPED SECURE</div>
                        <div style="font-weight:700;color:#1e293b;">Dra. Hj. Wahyuni, M.AP</div>
                    </div>
                </div>
            </div>
        `;
            } else if (type === 'Rapor') {
                content = `
            <div style="background:#fff;border-radius:12px;box-shadow:0 6px 16px rgba(0,0,0,0.06);padding:26px;border:1.5px solid #cbd5e1;font-family:sans-serif;color:#1e293b;line-height:1.4;">
                <div style="text-align:center;margin-bottom:16px;border-bottom:1.5px solid #e2e8f0;padding-bottom:10px;">
                    <div style="font-size:13.5px;font-weight:800;text-transform:uppercase;color:#0f766e;letter-spacing:0.5px;">LAPORAN HASIL BELAJAR SISWA (RAPOR)</div>
                    <div style="font-size:11px;color:#64748b;font-weight:500;">Sekolah Dasar / Madrasah Ibtidaiyah Asal</div>
                </div>
                <div style="font-size:11.5px;margin-bottom:12px;display:flex;justify-content:space-between;color:#475569;font-weight:600;">
                    <div>Nama Lengkap: <strong style="color:#1e293b;">${name}</strong></div>
                    <div>Kelas: VI (Enam) &bull; Semester II</div>
                </div>
                <table style="width:100%;font-size:11.5px;border-collapse:collapse;margin-bottom:14px;border:1.5px solid #cbd5e1;">
                    <tr style="background:#f1f5f9;font-weight:700;color:#334155;text-align:center;border-bottom:2px solid #cbd5e1;">
                        <td style="padding:8px;border:1px solid #cbd5e1;width:10%;">No</td>
                        <td style="padding:8px;border:1px solid #cbd5e1;width:50%;text-align:left;">Mata Pelajaran</td>
                        <td style="padding:8px;border:1px solid #cbd5e1;width:20%;">Nilai Angka</td>
                        <td style="padding:8px;border:1px solid #cbd5e1;width:20%;">Predikat</td>
                    </tr>
                    <tr>
                        <td style="padding:8px;border:1px solid #cbd5e1;text-align:center;color:#64748b;">1</td>
                        <td style="padding:8px;border:1px solid #cbd5e1;">Pendidikan Agama Islam</td>
                        <td style="padding:8px;border:1px solid #cbd5e1;text-align:center;font-weight:700;font-size:12px;color:#0f766e;">92</td>
                        <td style="padding:8px;border:1px solid #cbd5e1;text-align:center;color:#16a34a;font-weight:700;font-size:10.5px;">Sangat Baik (A)</td>
                    </tr>
                    <tr>
                        <td style="padding:8px;border:1px solid #cbd5e1;text-align:center;color:#64748b;">2</td>
                        <td style="padding:8px;border:1px solid #cbd5e1;">Bahasa Indonesia</td>
                        <td style="padding:8px;border:1px solid #cbd5e1;text-align:center;font-weight:700;font-size:12px;color:#0f766e;">88</td>
                        <td style="padding:8px;border:1px solid #cbd5e1;text-align:center;color:#16a34a;font-weight:700;font-size:10.5px;">Baik (B)</td>
                    </tr>
                    <tr>
                        <td style="padding:8px;border:1px solid #cbd5e1;text-align:center;color:#64748b;">3</td>
                        <td style="padding:8px;border:1px solid #cbd5e1;">Matematika</td>
                        <td style="padding:8px;border:1px solid #cbd5e1;text-align:center;font-weight:700;font-size:12px;color:#0f766e;">90</td>
                        <td style="padding:8px;border:1px solid #cbd5e1;text-align:center;color:#16a34a;font-weight:700;font-size:10.5px;">Sangat Baik (A)</td>
                    </tr>
                    <tr>
                        <td style="padding:8px;border:1px solid #cbd5e1;text-align:center;color:#64748b;">4</td>
                        <td style="padding:8px;border:1px solid #cbd5e1;">Ilmu Pengetahuan Alam (IPA)</td>
                        <td style="padding:8px;border:1px solid #cbd5e1;text-align:center;font-weight:700;font-size:12px;color:#0f766e;">95</td>
                        <td style="padding:8px;border:1px solid #cbd5e1;text-align:center;color:#16a34a;font-weight:700;font-size:10.5px;">Sangat Baik (A)</td>
                    </tr>
                </table>
                <div style="margin-top:16px;text-align:right;font-size:11px;color:#475569;">
                    <div>Mengetahui, Wali Kelas VI</div>
                    <div style="height:10mm;"></div>
                    <div style="font-weight:700;text-decoration:underline;color:#1e293b;font-size:11.5px;">Sumantri, S.Pd</div>
                </div>
            </div>
        `;
            } else {
                content = `
            <div style="background:#fff;border-radius:12px;box-shadow:0 6px 16px rgba(0,0,0,0.06);padding:30px;border:2px dashed #0d9488;font-family:sans-serif;color:#1e293b;text-align:center;line-height:1.5;">
                <i class="bi bi-file-earmark-check text-teal" style="font-size:42px;display:block;margin-bottom:12px;"></i>
                <h5 style="font-size:14px;font-weight:700;color:#0d9488;text-transform:uppercase;margin-bottom:8px;letter-spacing:0.5px;">${getFileLabel(type)}</h5>
                <p style="font-size:12.5px;color:#64748b;line-height:1.6;max-width:400px;margin:0 auto 12px;">Dokumen penunjang persyaratan berhasil diulas. Berkas atas nama <strong>${name}</strong> valid sesuai standar PPDB Al-Amanah.</p>
                <div style="font-family:'Courier New',monospace;font-size:10px;font-weight:bold;color:#4f46e5;border:1.5px solid #4f46e5;border-radius:4px;margin-top:10px;display:inline-block;background:#f5f3ff;">DOKUMEN VALID &bull; PPDB 2026</div>
            </div>
        `;
            }

            previewPanel.innerHTML = content;
        }

        function openFormulirDetailModal(id) {
            currentActiveDetailSiswaId = id;
            const p = getPendaftar().find(x => x.id === id);
            if (!p) return;
            const fd = p.formData || {};

            const content = `
    <!-- Header Status Action -->
    <div class="d-flex align-items-center justify-content-between p-3 mb-4 rounded-3 border" style="background: linear-gradient(to right, #f0fdf4, #dcfce7); border-color: #86efac !important; box-shadow: 0 4px 15px rgba(22,163,74,0.1);">
        <div class="d-flex align-items-center gap-3">
            <div style="width: 48px; height: 48px; background: #fff; border-radius: 12px; display: flex; align-items: center; justify-content: center; box-shadow: 0 2px 8px rgba(0,0,0,0.05); color: #16a34a; font-size: 24px;">
                <i class="bi bi-shield-check"></i>
            </div>
            <div>
                <div class="fw-bold text-success" style="font-size: 14px; letter-spacing: 0.5px; text-transform: uppercase;">Status Verifikasi Formulir</div>
                <div class="text-success mt-1" style="font-size: 11.5px; opacity: 0.9;">Tinjau seluruh data dengan teliti sebelum menyetujui.</div>
            </div>
        </div>
        <div class="d-flex flex-column align-items-end">
            <span class="mb-2" id="detailFormStatusBadge">${statusBadge(p.statusFormulirAdmin || p.statusFormulir || 'Menunggu')}</span>
            <select id="detailFormSelect" class="form-select form-select-sm fw-bold shadow-sm" onchange="ubahStatusFormulir('${p.id}', this.value)" style="font-size: 12px; border-radius: 8px; cursor: pointer; min-width: 140px; ${getStatusSelectStyle(p.statusFormulirAdmin || 'Menunggu')}">
                <option value="Menunggu" ${(p.statusFormulirAdmin || 'Menunggu') === 'Menunggu' ? 'selected' : ''}>Menunggu</option>
                <option value="Disetujui" ${(p.statusFormulirAdmin || 'Menunggu') === 'Disetujui' ? 'selected' : ''}>Disetujui</option>
                <option value="Belum Valid" ${(p.statusFormulirAdmin || 'Menunggu') === 'Belum Valid' ? 'selected' : ''}>Belum Valid</option>
                <option value="Ditolak" ${(p.statusFormulirAdmin || 'Menunggu') === 'Ditolak' ? 'selected' : ''}>Ditolak</option>
            </select>
        </div>
    </div>

    <!-- Main Data Grid -->
    <div class="row g-4">
        <!-- Biodata Section -->
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-4" style="background: #fff; overflow: hidden;">
                <div class="card-header border-0 py-3" style="background: #f8fafc; border-bottom: 2px solid #e2e8f0 !important;">
                    <h6 class="m-0 fw-bold" style="color: #0f766e; font-size: 14px;">
                        <i class="bi bi-person-badge-fill me-2" style="font-size: 16px;"></i>Biodata Lengkap Calon Siswa
                    </h6>
                </div>
                <div class="card-body p-4">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="d-flex flex-column gap-3">
                                <div class="d-flex flex-column">
                                    <span class="text-muted fw-semibold text-uppercase" style="font-size: 10px; letter-spacing: 0.5px;">Nama Lengkap</span>
                                    <span class="text-dark fw-bold" style="font-size: 14px;">${fd.inputNama || p.nama}</span>
                                </div>
                                <div class="d-flex gap-4">
                                    <div class="d-flex flex-column flex-grow-1">
                                        <span class="text-muted fw-semibold text-uppercase" style="font-size: 10px; letter-spacing: 0.5px;">Nomor Induk Kependudukan (NIK)</span>
                                        <span class="text-dark fw-semibold" style="font-size: 13px; font-family: monospace;">${fd.inputNIK || 'Belum diisi'}</span>
                                    </div>
                                    <div class="d-flex flex-column flex-grow-1">
                                        <span class="text-muted fw-semibold text-uppercase" style="font-size: 10px; letter-spacing: 0.5px;">NISN</span>
                                        <span class="text-dark fw-semibold" style="font-size: 13px; font-family: monospace;">${fd.inputNISN || 'Belum diisi'}</span>
                                    </div>
                                </div>
                                <div class="d-flex gap-4">
                                    <div class="d-flex flex-column flex-grow-1">
                                        <span class="text-muted fw-semibold text-uppercase" style="font-size: 10px; letter-spacing: 0.5px;">Tempat, Tanggal Lahir</span>
                                        <span class="text-dark fw-medium" style="font-size: 13px;">${fd.inputTempatLahir || '-'}, ${fd.inputTanggalLahir || '-'}</span>
                                    </div>
                                    <div class="d-flex flex-column flex-grow-1">
                                        <span class="text-muted fw-semibold text-uppercase" style="font-size: 10px; letter-spacing: 0.5px;">Jenis Kelamin</span>
                                        <span class="text-dark fw-medium" style="font-size: 13px;">${fd.inputGender === 'L' ? '<i class="bi bi-gender-male text-primary"></i> Laki-laki' : fd.inputGender === 'P' ? '<i class="bi bi-gender-female text-danger"></i> Perempuan' : (fd.inputGender || '-')}</span>
                                    </div>
                                </div>
                                <div class="d-flex gap-4">
                                    <div class="d-flex flex-column flex-grow-1">
                                        <span class="text-muted fw-semibold text-uppercase" style="font-size: 10px; letter-spacing: 0.5px;">Agama</span>
                                        <span class="text-dark fw-medium" style="font-size: 13px;">${fd.inputAgama || '-'}</span>
                                    </div>
                                    <div class="d-flex flex-column flex-grow-1">
                                        <span class="text-muted fw-semibold text-uppercase" style="font-size: 10px; letter-spacing: 0.5px;">Fisik (Tinggi / Darah)</span>
                                        <span class="text-dark fw-medium" style="font-size: 13px;">${fd.inputTinggiBadan ? fd.inputTinggiBadan + ' cm' : '-'} / Gol. ${fd.inputGolDarah || '-'}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 border-start" style="border-color: #f1f5f9 !important;">
                            <div class="d-flex flex-column gap-3 ps-md-3">
                                <div class="p-3 rounded bg-light border border-light-subtle">
                                    <div class="text-muted fw-semibold text-uppercase mb-2" style="font-size: 10px; letter-spacing: 0.5px;">Informasi Keluarga Inti</div>
                                    <div class="d-flex gap-4">
                                        <div class="text-dark" style="font-size: 12.5px;">Anak ke: <strong class="text-primary" style="font-size: 14px;">${fd.inputAnakKe || '-'}</strong> dari <strong class="text-primary" style="font-size: 14px;">${fd.inputJumlahSaudara || '-'}</strong> saudara</div>
                                    </div>
                                    <div class="d-flex flex-wrap gap-2 mt-2" style="font-size: 11px;">
                                        <span class="badge bg-white text-dark border"><i class="bi bi-gender-male text-primary"></i> Laki-laki: ${fd.inputSaudaraLaki || '0'}</span>
                                        <span class="badge bg-white text-dark border"><i class="bi bi-gender-female text-danger"></i> Perempuan: ${fd.inputSaudaraPerempuan || '0'}</span>
                                        <span class="badge bg-white text-dark border"><i class="bi bi-heart-fill text-warning"></i> Menikah: ${fd.inputSaudaraMenikah || '0'}</span>
                                    </div>
                                </div>
                                <div class="d-flex flex-column">
                                    <span class="text-muted fw-semibold text-uppercase" style="font-size: 10px; letter-spacing: 0.5px;">Alamat Domisili Lengkap</span>
                                    <span class="text-dark" style="font-size: 12.5px; line-height: 1.6;">
                                        <i class="bi bi-geo-alt text-danger me-1"></i> Jl. (Alamat Lengakp) ${fd.inputAlamatJalan || '-'}, RT/RW ${fd.inputAlamatRTRW || '-'}<br>
                                        Desa/Kel: ${fd.inputAlamatDesa || '-'}, Kec: ${fd.inputAlamatKecamatan || '-'}<br>
                                        Kab/Kota: ${fd.inputAlamatKabupaten || '-'}
                                    </span>
                                </div>
                                <div class="d-flex flex-column mt-2">
                                    <span class="text-muted fw-semibold text-uppercase" style="font-size: 10px; letter-spacing: 0.5px;">Kontak Siswa</span>
                                    <span class="text-dark fw-bold" style="font-size: 13px;"><i class="bi bi-telephone-fill text-success me-1"></i> ${fd.inputNoHpSiswa || '-'}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Asal Sekolah Section -->
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-4" style="background: #fff; overflow: hidden;">
                <div class="card-header border-0 py-3" style="background: #fffbeb; border-bottom: 2px solid #fde68a !important;">
                    <h6 class="m-0 fw-bold" style="color: #b45309; font-size: 14px;">
                        <i class="bi bi-building me-2" style="font-size: 16px;"></i>Data Asal Sekolah
                    </h6>
                </div>
                <div class="card-body p-4">
                    <div class="row g-3">
                        <div class="col-md-5">
                            <div class="d-flex flex-column">
                                <span class="text-muted fw-semibold text-uppercase" style="font-size: 10px; letter-spacing: 0.5px;">Nama Sekolah Asal</span>
                                <span class="text-dark fw-bold" style="font-size: 14px;">${fd.inputAsalSekolah || '-'}</span>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="d-flex flex-column">
                                <span class="text-muted fw-semibold text-uppercase" style="font-size: 10px; letter-spacing: 0.5px;">Alamat Sekolah Asal</span>
                                <span class="text-dark" style="font-size: 13px;"><i class="bi bi-geo-alt-fill text-muted me-1"></i> ${fd.inputAlamatSekolah || '-'}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Orang Tua & Wali Section -->
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-4" style="background: #fff; overflow: hidden;">
                <div class="card-header border-0 py-3" style="background: #eff6ff; border-bottom: 2px solid #bfdbfe !important;">
                    <h6 class="m-0 fw-bold" style="color: #1d4ed8; font-size: 14px;">
                        <i class="bi bi-people-fill me-2" style="font-size: 16px;"></i>Data Orang Tua & Wali
                    </h6>
                </div>
                <div class="card-body p-0">
                    <div class="row g-0">
                        <div class="col-md-6 p-4 border-end border-bottom" style="border-color: #f1f5f9 !important;">
                            <div class="d-flex align-items-center gap-2 mb-3">
                                <i class="bi bi-person-fill text-primary" style="font-size: 18px;"></i>
                                <span class="fw-bold text-dark" style="font-size: 13.5px;">Data Ayah Kandung</span>
                            </div>
                            <div class="d-flex flex-column gap-2" style="font-size: 12.5px;">
                                <div class="d-flex justify-content-between"><span class="text-muted">Nama:</span> <span class="fw-bold text-dark">${fd.inputNamaAyah || '-'}</span></div>
                                <div class="d-flex justify-content-between"><span class="text-muted">Status:</span> <span class="badge bg-light text-dark border">${fd.inputStatusAyah || '-'}</span></div>
                                <div class="d-flex justify-content-between"><span class="text-muted">Pendidikan:</span> <span class="text-dark">${fd.inputPendidikanAyah || '-'}</span></div>
                                <div class="d-flex justify-content-between"><span class="text-muted">Pekerjaan:</span> <span class="text-dark">${fd.inputPekerjaanAyah || '-'}</span></div>
                            </div>
                        </div>
                        <div class="col-md-6 p-4 border-bottom" style="border-color: #f1f5f9 !important;">
                            <div class="d-flex align-items-center gap-2 mb-3">
                                <i class="bi bi-person-fill text-danger" style="font-size: 18px;"></i>
                                <span class="fw-bold text-dark" style="font-size: 13.5px;">Data Ibu Kandung</span>
                            </div>
                            <div class="d-flex flex-column gap-2" style="font-size: 12.5px;">
                                <div class="d-flex justify-content-between"><span class="text-muted">Nama:</span> <span class="fw-bold text-dark">${fd.inputNamaIbu || '-'}</span></div>
                                <div class="d-flex justify-content-between"><span class="text-muted">Status:</span> <span class="badge bg-light text-dark border">${fd.inputStatusIbu || '-'}</span></div>
                                <div class="d-flex justify-content-between"><span class="text-muted">Pendidikan:</span> <span class="text-dark">${fd.inputPendidikanIbu || '-'}</span></div>
                                <div class="d-flex justify-content-between"><span class="text-muted">Pekerjaan:</span> <span class="text-dark">${fd.inputPekerjaanIbu || '-'}</span></div>
                            </div>
                        </div>
                        <div class="col-12 p-4 border-bottom" style="background: #f8fafc; border-color: #f1f5f9 !important;">
                            <div class="row g-3">
                                <div class="col-md-8">
                                    <span class="text-muted fw-semibold text-uppercase d-block mb-1" style="font-size: 10px;">Alamat Orang Tua</span>
                                    <span class="text-dark" style="font-size: 12.5px;"><i class="bi bi-geo-alt text-muted me-1"></i> ${fd.inputAlamatOrtu || '-'}</span>
                                </div>
                                <div class="col-md-4">
                                    <span class="text-muted fw-semibold text-uppercase d-block mb-1" style="font-size: 10px;">No. Telp / HP Orang Tua</span>
                                    <span class="fw-bold text-dark" style="font-size: 13px;"><i class="bi bi-telephone-fill text-success me-1"></i> ${fd.inputNoHpOrtu || '-'}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 p-4">
                            <div class="d-flex align-items-center gap-2 mb-3">
                                <i class="bi bi-person-lines-fill text-secondary" style="font-size: 18px;"></i>
                                <span class="fw-bold text-dark" style="font-size: 13.5px;">Data Wali Siswa <span class="text-muted fw-normal" style="font-size: 11px;">(Diisi jika tinggal dengan wali)</span></span>
                            </div>
                            <div class="row g-3" style="font-size: 12.5px;">
                                <div class="col-md-4">
                                    <span class="text-muted fw-semibold text-uppercase d-block mb-1" style="font-size: 10px;">Nama Wali</span>
                                    <span class="text-dark fw-bold">${fd.inputNamaWali || '-'}</span>
                                </div>
                                <div class="col-md-4">
                                    <span class="text-muted fw-semibold text-uppercase d-block mb-1" style="font-size: 10px;">Pekerjaan Wali</span>
                                    <span class="text-dark">${fd.inputPekerjaanWali || '-'}</span>
                                </div>
                                <div class="col-md-4">
                                    <span class="text-muted fw-semibold text-uppercase d-block mb-1" style="font-size: 10px;">No. HP Wali</span>
                                    <span class="text-dark fw-bold"><i class="bi bi-telephone-fill text-muted me-1"></i> ${fd.inputNoHpWali || '-'}</span>
                                </div>
                                <div class="col-12">
                                    <span class="text-muted fw-semibold text-uppercase d-block mb-1" style="font-size: 10px;">Alamat Wali</span>
                                    <span class="text-dark"><i class="bi bi-geo-alt text-muted me-1"></i> ${fd.inputAlamatWali || '-'}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-4 pt-3 border-top text-center">
        <button onclick="closeModalFormulir()" class="btn btn-secondary px-5 fw-bold" style="border-radius: 20px; font-size: 13px; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">Selesai Review & Tutup</button>
    </div>
    `;

            document.getElementById('modalFormulirContent').innerHTML = content;
            document.getElementById('modalDetailFormulir').style.display = 'flex';
        }

        function closeModalFormulir() {
            currentActiveDetailSiswaId = null;
            document.getElementById('modalDetailFormulir').style.display = 'none';
        }

        // IndexedDB File Store Helpers for Admin
        const DB_NAME = 'PPDBFileStore';
        const DB_VERSION = 1;
        const STORE_NAME = 'files';

        function getDB() {
            return new Promise((resolve, reject) => {
                const request = indexedDB.open(DB_NAME, DB_VERSION);
                request.onupgradeneeded = function (e) {
                    const db = e.target.result;
                    if (!db.objectStoreNames.contains(STORE_NAME)) {
                        db.createObjectStore(STORE_NAME);
                    }
                };
                request.onsuccess = function (e) {
                    resolve(e.target.result);
                };
                request.onerror = function (e) {
                    reject(e.target.error);
                };
            });
        }

        function getFileDB(key) {
            return getDB().then(db => {
                return new Promise((resolve, reject) => {
                    const transaction = db.transaction([STORE_NAME], 'readonly');
                    const store = transaction.objectStore(STORE_NAME);
                    const request = store.get(key);
                    request.onsuccess = (e) => resolve(e.target.result || null);
                    request.onerror = (e) => reject(e.target.error);
                });
            });
        }

        function openBerkasReviewModal(id) {
            currentActiveDetailSiswaId = id;
            const p = getPendaftar().find(x => x.id === id);
            if (!p) return;
            const uf = p.uploadedFiles || {};

            const content = `
    <!-- Verification Action Section -->
    <div class="border rounded-3 p-3 mb-3 flex-shrink-0" style="background:#f0fdfa; border-color:#99f6e4 !important; box-shadow: 0 4px 12px rgba(13,148,136,0.06);">
        <div class="fw-bold mb-2 text-teal-800" style="font-size:13.5px; display:flex; align-items:center; gap:6px;">
            <span><i class="bi bi-folder-check me-1"></i> Verifikasi Status Berkas Persyaratan</span>
            <span class="badge bg-teal-600 text-white" style="font-size:9.5px; border-radius:10px;">Aksi Cepat Admin</span>
        </div>
        <div class="p-3 rounded bg-white border shadow-sm">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="fw-bold text-secondary" style="font-size:12px;"><i class="bi bi-folder2 me-1"></i> Status Berkas Saat Ini:</span>
                <span id="detailBerkasStatusBadge">${statusBadge(p.statusBerkasAdmin || p.statusBerkas || 'Menunggu')}</span>
            </div>
            <select id="detailBerkasSelect" class="form-select form-select-sm fw-bold text-dark" onchange="ubahStatusBerkas('${p.id}', this.value)" style="font-size:12px; border-radius:8px; padding:5px 10px; cursor:pointer; ${getStatusSelectStyle(p.statusBerkasAdmin || 'Menunggu')}">
                <option value="Menunggu" ${(p.statusBerkasAdmin || 'Menunggu') === 'Menunggu' ? 'selected' : ''}>Menunggu</option>
                <option value="Disetujui" ${(p.statusBerkasAdmin || 'Menunggu') === 'Disetujui' ? 'selected' : ''}>Disetujui</option>
                <option value="Belum Valid" ${(p.statusBerkasAdmin || 'Menunggu') === 'Belum Valid' ? 'selected' : ''}>Belum Valid</option>
                <option value="Ditolak" ${(p.statusBerkasAdmin || 'Menunggu') === 'Ditolak' ? 'selected' : ''}>Ditolak</option>
            </select>
        </div>
    </div>

    <!-- Review Berkas Panel -->
    <div class="border rounded-3 p-3 d-flex flex-column flex-grow-1" style="background:#f8fafc; min-height:0;">
        <div class="fw-bold mb-3 flex-shrink-0" style="font-size:14px;color:#0f766e;display:flex;align-items:center;gap:6px;">
            <span><i class="bi bi-folder-fill me-1"></i> Berkas Pendaftar: <strong>${p.nama}</strong> &bull; Jalur: <strong>${p.jalur}</strong></span>
        </div>

        <div class="d-flex flex-column gap-2">
            ${Object.keys(uf).filter(k => uf[k]).map(k => {
                // uf[k] is now an object { name, mime, size } or legacy boolean true
                const meta = (typeof uf[k] === 'object') ? uf[k] : null;
                const fileName = meta ? meta.name : '';
                const fileMime = meta ? meta.mime : '';
                const isPdf = fileMime === 'application/pdf';
                const iconClass = isPdf ? 'bi-file-earmark-pdf text-danger' : 'bi-file-earmark-image text-primary';
                return `
                <div class="d-flex align-items-center justify-content-between p-2 rounded-3 border" style="background:#fff;border-color:#e2e8f0;">
                    <div style="display:flex;align-items:center;gap:8px;">
                        <i class="bi ${iconClass}" style="font-size:18px;"></i>
                        <div>
                            <span class="fw-semibold text-dark" style="font-size:12px;">${getFileLabel(k)}</span>
                            ${fileName
                        ? `<div style="font-size:10px;color:#64748b;max-width:220px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;" title="${fileName}">${fileName}</div>`
                        : '<div style="font-size:10px;color:#94a3b8;">Nama file tidak tersedia</div>'
                    }
                        </div>
                    </div>
                    <div class="d-flex gap-1">
                        <button onclick="adminPreviewFile('${p.id}', '${k}')" class="btn btn-sm btn-outline-primary" style="font-size:11px; border-radius:15px; padding:3px 12px; display:inline-flex; align-items:center; gap:4px;">
                            <i class="bi bi-eye"></i> Review
                        </button>
                        <button onclick="adminDownloadFile('${p.id}', '${k}')" class="btn btn-sm btn-outline-success" style="font-size:11px; border-radius:15px; padding:3px 12px; display:inline-flex; align-items:center; gap:4px;">
                            <i class="bi bi-download"></i> Unduh
                        </button>
                    </div>
                </div>`;
            }).join('') || '<div class="text-muted py-3 text-center" style="font-size:13px;"><i class="bi bi-inbox me-2"></i>Belum ada berkas yang diunggah</div>'}
        </div>

        <div class="mt-3 p-2 rounded-2" style="background:#f0fdf4;border:1px solid #bbf7d0;font-size:11px;color:#166534;">
            <i class="bi bi-info-circle me-1"></i>
            <strong>Info:</strong> Berkas tersimpan dengan aman di database browser IndexedDB. Anda dapat langsung melihat (Review) di tab baru atau mengunduhnya (Unduh) untuk kebutuhan pemberkasan sekolah.
        </div>
    </div>
    `;

            document.getElementById('modalBerkasContent').innerHTML = content;
            document.getElementById('modalReviewBerkas').style.display = 'flex';
        }

        function adminPreviewFile(siswaId, type) {
            getFileDB(siswaId + '_' + type).then(entry => {
                if (!entry || !entry.fileBlob) {
                    alert('File belum tersedia di browser ini.\n\nPenyebab:\n• Siswa mengunggah berkas menggunakan perangkat/browser lain, atau\n• Data file di browser ini telah terhapus.\n\nPastikan proses simulasi dilakukan pada browser yang sama.');
                    return;
                }
                const url = URL.createObjectURL(entry.fileBlob);
                const newTab = window.open();
                if (!newTab) {
                    alert('Pop-up diblokir oleh browser. Izinkan pop-up untuk domain ini lalu coba lagi.');
                    return;
                }
                if (entry.mime === 'application/pdf') {
                    newTab.document.write('<html><head><title>' + entry.name + '</title><style>body{margin:0;padding:0;}</style></head><body><embed src="' + url + '" type="application/pdf" width="100%" height="100%" style="height:100vh;border:none;"/></body></html>');
                } else {
                    newTab.document.write('<html><head><title>' + entry.name + '</title><style>body{margin:0;background:#1a1a2e;display:flex;align-items:center;justify-content:center;min-height:100vh;}</style></head><body><img src="' + url + '" style="max-width:100%;max-height:100vh;object-fit:contain;box-shadow:0 4px 30px rgba(0,0,0,0.5);"/></body></html>');
                }
                newTab.document.close();
            }).catch(err => {
                console.error(err);
                alert('Gagal membuka berkas.');
            });
        }

        function adminDownloadFile(siswaId, type) {
            getFileDB(siswaId + '_' + type).then(entry => {
                if (!entry || !entry.fileBlob) {
                    alert('File tidak ditemukan.');
                    return;
                }
                const url = URL.createObjectURL(entry.fileBlob);
                const a = document.createElement('a');
                a.href = url;
                a.download = entry.name || (type + '.dat');
                document.body.appendChild(a);
                a.click();
                document.body.removeChild(a);
                setTimeout(() => URL.revokeObjectURL(url), 100);
            }).catch(err => {
                console.error(err);
                alert('Gagal mengunduh berkas.');
            });
        }

        function closeModalBerkas() {
            currentActiveDetailSiswaId = null;
            document.getElementById('modalReviewBerkas').style.display = 'none';
        }

        function refreshDetailModalBadges() {
            if (!currentActiveDetailSiswaId) return;
            const p = getPendaftar().find(x => x.id === currentActiveDetailSiswaId);
            if (!p) return;

            // 1. Sync Formulir Modal
            const formBadge = document.getElementById('detailFormStatusBadge');
            if (formBadge) formBadge.innerHTML = statusBadge(p.statusFormulirAdmin || p.statusFormulir || 'Menunggu');
            const formSelect = document.getElementById('detailFormSelect');
            if (formSelect) {
                formSelect.value = p.statusFormulirAdmin || 'Menunggu';
                formSelect.style.cssText = `font-size:12px; border-radius:8px; padding:5px 10px; cursor:pointer; ${getStatusSelectStyle(p.statusFormulirAdmin || 'Menunggu')}`;
            }

            // 2. Sync Berkas Modal
            const berkasBadge = document.getElementById('detailBerkasStatusBadge');
            if (berkasBadge) berkasBadge.innerHTML = statusBadge(p.statusBerkasAdmin || p.statusBerkas || 'Menunggu');
            const berkasSelect = document.getElementById('detailBerkasSelect');
            if (berkasSelect) {
                berkasSelect.value = p.statusBerkasAdmin || 'Menunggu';
                berkasSelect.style.cssText = `font-size:12px; border-radius:8px; padding:5px 10px; cursor:pointer; ${getStatusSelectStyle(p.statusBerkasAdmin || 'Menunggu')}`;
            }
        }

        // ==================== DASHBOARD STATS ====================
        function updateDashboardStats() {
            const data = getPendaftar();
            const el = id => document.getElementById(id);
            if (el('statTotalPendaftar')) el('statTotalPendaftar').textContent = data.length;
            if (el('statFormulirDikirim')) el('statFormulirDikirim').textContent = data.filter(p => p.statusFormulir === 'Terkirim' || p.statusFormulirAdmin !== 'Belum').length;
            if (el('statFormulirDisetujui')) el('statFormulirDisetujui').textContent = data.filter(p => p.statusFormulirAdmin === 'Disetujui').length;
            if (el('statBerkasDisetujui')) el('statBerkasDisetujui').textContent = data.filter(p => p.statusBerkasAdmin === 'Disetujui').length;
        }

        function renderChart() {
            const data = getPendaftar();
            const jalurCounts = { Reguler: 0, Prestasi: 0, Tahfidz: 0 };
            data.forEach(p => { if (jalurCounts[p.jalur] !== undefined) jalurCounts[p.jalur]++; });

            const canvas = document.getElementById('chartJalur');
            if (!canvas) return;
            if (chartInstance) { chartInstance.destroy(); chartInstance = null; }
            chartInstance = new Chart(canvas, {
                type: 'bar',
                data: {
                    labels: ['Reguler', 'Prestasi', 'Tahfidz'],
                    datasets: [{
                        label: 'Jumlah Pendaftar',
                        data: [jalurCounts.Reguler, jalurCounts.Prestasi, jalurCounts.Tahfidz],
                        backgroundColor: ['rgba(13,148,136,0.7)', 'rgba(251,191,36,0.7)', 'rgba(22,163,74,0.7)'],
                        borderColor: ['#0d9488', '#f59e0b', '#16a34a'],
                        borderWidth: 2,
                        borderRadius: 8,
                    }]
                },
                options: {
                    responsive: true,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: { beginAtZero: true, ticks: { stepSize: 1, font: { size: 11 } } },
                        x: { ticks: { font: { size: 12 } } }
                    }
                }
            });
        }

        function renderRecentActivity() {
            const acts = [];
            try { const a = JSON.parse(localStorage.getItem('ppdb_admin_activity')); if (Array.isArray(a)) acts.push(...a); } catch (e) { }
            const el = document.getElementById('recentActivity');
            if (!el) return;
            if (acts.length === 0) {
                el.innerHTML = '<div class="text-center text-muted py-4" style="font-size:12.5px;">Belum ada aktivitas</div>';
                return;
            }
            el.innerHTML = acts.slice(0, 8).map(a => `
        <div class="d-flex gap-2 py-2 border-bottom" style="border-color:#f1f5f9 !important;">
            <span style="font-size:16px;flex-shrink:0;">${a.emoji}</span>
            <div>
                <div style="font-size:12px;font-weight:500;color:#1e293b;">${a.text}</div>
                <div style="font-size:10.5px;color:#94a3b8;">${a.time}</div>
            </div>
        </div>
    `).join('');
        }

        function addRecentActivity(act) {
            let acts = [];
            try { acts = JSON.parse(localStorage.getItem('ppdb_admin_activity')) || []; } catch (e) { }
            acts.unshift(act);
            localStorage.setItem('ppdb_admin_activity', JSON.stringify(acts.slice(0, 20)));
        }

        // ==================== NOTIFICATIONS ====================
        function toggleAdminNotif() {
            adminNotifOpen = !adminNotifOpen;
            const panel = document.getElementById('adminNotifPanel');
            if (panel) panel.classList.toggle('show', adminNotifOpen);
        }

        function renderAdminNotif() {
            const notifs = getAdminNotifs();
            const list = document.getElementById('adminNotifList');
            const badge = document.getElementById('adminNotifBadge');

            const unread = notifs.filter(n => !n.dibaca).length;
            if (badge) {
                badge.textContent = unread;
                badge.classList.toggle('show', unread > 0);
            }

            if (!list) return;
            const displayed = notifs.slice(0, 10);
            if (displayed.length === 0) {
                list.innerHTML = '<div class="text-center py-4 text-muted" style="font-size:12.5px;"><span style="font-size:24px;display:block;margin-bottom:6px;"><i class="bi bi-bell-slash text-muted" style="font-size:24px;display:block;margin-bottom:6px;"></i></span>Belum ada notifikasi</div>';
                return;
            }
            list.innerHTML = displayed.map(n => `
        <div class="notif-item ${n.dibaca ? '' : 'unread'}">
            <div class="d-flex gap-2">
                <span style="font-size:16px;flex-shrink:0;">${n.emoji || '<i class="bi bi-bell-fill"></i>'}</span>
                <div>
                    <div style="font-size:12px;font-weight:${n.dibaca ? '500' : '600'};color:${n.dibaca ? '#64748b' : '#1e293b'};">${n.pesan}</div>
                    <div style="font-size:10.5px;color:#94a3b8;">${n.waktu}</div>
                </div>
            </div>
        </div>
    `).join('');
        }

        // ==================== TOAST ====================
        function showToast(icon, title, msg) {
            const toast = document.getElementById('toastAdmin');
            const ti = document.getElementById('toastIcon');
            const tt = document.getElementById('toastTitle');
            const tm = document.getElementById('toastMsg');
            if (!toast) return;
            if (ti) ti.innerHTML = icon;
            if (tt) tt.textContent = title;
            if (tm) tm.textContent = msg;
            toast.style.display = 'block';
            setTimeout(() => { toast.style.display = 'none'; }, 3500);
        }

        // ==================== POLLING: CHECK FOR NEW PENDAFTAR ====================
        let lastPendaftarCount = 0;
        function pollForNewPendaftar() {
            const data = getPendaftar();
            if (data.length > lastPendaftarCount) {
                const newOnes = data.slice(lastPendaftarCount);
                newOnes.forEach(p => {
                    addAdminNotif({ tipe: 'pendaftar_baru', pesan: 'Pendaftar baru: ' + p.nama + ' (' + (p.jalur || 'Belum pilih jalur') + ')', emoji: '<i class="bi bi-person-plus-fill text-primary"></i>' });
                    addRecentActivity({ text: 'Pendaftar baru: ' + p.nama, emoji: '<i class="bi bi-person-plus-fill text-primary"></i>', time: new Date().toLocaleTimeString('id-ID') });
                });
                if (newOnes.length > 0) { updateDashboardStats(); renderChart(); renderRecentActivity(); }
            }
            data.forEach(p => {
                const key = 'ppdb_admin_seen_' + p.id;
                const seen = localStorage.getItem(key);
                const sig = (p.statusFormulir || '') + '|' + (p.statusBerkas || '') + '|' + (p.statusPembayaran || '');
                if (seen !== sig) {
                    localStorage.setItem(key, sig);
                    if (p.statusFormulir === 'Terkirim' && !seen?.includes('Terkirim')) {
                        addAdminNotif({ tipe: 'formulir_masuk', pesan: p.nama + ' mengirim formulir (' + (p.jalur || '') + ')', emoji: '<i class="bi bi-file-earmark-text-fill text-info"></i>' });
                    }
                    if (p.statusBerkas === 'Terkirim' && !(seen || '').includes('Terkirim|Terkirim')) {
                        addAdminNotif({ tipe: 'berkas_masuk', pesan: p.nama + ' mengunggah berkas', emoji: '<i class="bi bi-folder-fill text-warning"></i>' });
                    }
                    if (p.statusPembayaran === 'Menunggu Konfirmasi' && !seen?.includes('Menunggu Konfirmasi')) {
                        addAdminNotif({ tipe: 'pembayaran_masuk', pesan: p.nama + ' mengirim pembayaran (Menunggu Konfirmasi)', emoji: '<i class="bi bi-credit-card-fill text-success"></i>' });
                        showToast('<i class="bi bi-credit-card-fill text-success"></i>', 'Pembayaran Masuk!', p.nama + ' — Menunggu konfirmasi!');
                        updateDashboardStats();
                    }
                }
            });
            lastPendaftarCount = data.length;
        }

        // Close modals on backdrop click
        document.addEventListener('click', function (e) {
            ['modalTolakFormulir', 'modalTolakBerkas', 'modalDetailFormulir', 'modalReviewBerkas', 'modalTolakPembayaran'].forEach(id => {
                const el = document.getElementById(id);
                if (el && e.target === el) {
                    el.style.display = 'none';
                    currentActiveDetailSiswaId = null;
                }
            });
            const panel = document.getElementById('adminNotifPanel');
            const btn = document.querySelector('.btn-icon');
            if (panel && btn && !panel.contains(e.target) && !btn.contains(e.target)) {
                adminNotifOpen = false;
                panel.classList.remove('show');
            }
        });

        window.addEventListener('load', function () {
            // Jika database MySQL kosong (tidak ada calon siswa), bersihkan juga localStorage admin
            if (DB_PENDAFTAR_COUNT === 0) {
                const state = getAdminState();
                if (state.pendaftar && state.pendaftar.length > 0) {
                    state.pendaftar = [];
                    saveAdminState(state);
                }
            }

            const data = getPendaftar();
            lastPendaftarCount = data.length;

            updateDashboardStats();
            renderChart();
            renderAdminNotif();
            renderRecentActivity();

            setInterval(() => {
                pollForNewPendaftar();
                renderAdminNotif();
                // Refresh current active section
                const active = document.querySelector('.spa-section.active');
                if (active) {
                    if (active.id === 'sectionDataPendaftar') renderTablePendaftar();
                    if (active.id === 'sectionVerifikasiFormulir') renderVerifikasiFormulir();
                    if (active.id === 'sectionVerifikasiBerkas') renderVerifikasiBerkas();
                    if (active.id === 'sectionPembayaranAdmin') renderPembayaran();
                    if (active.id === 'sectionSeleksiAdmin') renderSeleksi();
                    if (active.id === 'sectionAdminDashboard') { updateDashboardStats(); }
                    if (active.id === 'sectionKelolaBerita') renderDaftarBerita();
                    if (active.id === 'sectionKelolaGaleri') renderDaftarGaleri();
                }
            }, 3000);
        });

        // ==================== BLOG / KELOLA BERITA ====================
        const BLOG_KEY = 'ppdb_blog_posts';

        function getBlogData() {
            try { return JSON.parse(localStorage.getItem(BLOG_KEY)) || []; } catch (e) { return []; }
        }
        function saveBlogData(posts) {
            localStorage.setItem(BLOG_KEY, JSON.stringify(posts));
        }

        function openFormBlogBaru() {
            document.getElementById('blogEditId').value = '';
            document.getElementById('blogInputJudul').value = '';
            document.getElementById('blogInputRingkasan').value = '';
            document.getElementById('blogInputIsi').value = '';
            document.getElementById('blogInputKategori').value = '';
            document.getElementById('blogInputStatus').value = 'published';
            document.getElementById('blogThumbnailBase64').value = '';
            document.getElementById('blogGambarTambahanBase64').value = '[]';
            document.getElementById('blogInputGambar').value = '';
            document.getElementById('blogInputGambarTambahan').value = '';
            document.getElementById('previewThumbnailBox').s    // Set today as default date
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('blogInputTanggal').value = today;
            document.getElementById('blogFormTitle').innerHTML = '<i class="bi bi-pencil-square me-1"></i> Tulis Berita Baru';
            const panel = document.getElementById('blogFormPanel');
            panel.style.display = 'block';
            panel.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }

        function openFormEditBlog(id) {
            const posts = getBlogData();
            const post = posts.find(p => p.id === id);
            if (!post) return;
            document.getElementById('blogEditId').value = id;
            document.getElementById('blogInputJudul').value = post.judul || '';
            document.getElementById('blogInputRingkasan').value = post.ringkasan || '';
            document.getElementById('blogInputIsi').value = post.isi || '';
            document.getElementById('blogInputKategori').value = post.kategori || '';
            document.getElementById('blogInputTanggal').value = post.tanggal || '';
            document.getElementById('blogInputStatus').value = post.status || 'published';
            document.getElementById('blogThumbnailBase64').value = post.gambar || '';
            document.getElementById('blogGambarTambahanBase64').value = JSON.stringify(post.gambarTambahan || []);
            document.getElementById('blogInputGambar').value = '';
            document.getElementById('blogInputGambarTambahan').value = '';
            // Preview thumbnail
            const prevBox = document.getElementById('previewThumbnailBox');
            const prevImg = document.getElementById('previewThumbnailImg');
            if (post.gambar) {
                prevImg.src = post.gambar;
                prevBox.style.display = 'block';
            } else {
                prevBox.style.display = 'none';
            }
            // Preview tambahan
            renderPreviewGambarTambahan(post.gambarTambahan || []);
            document.getElementById('blogFormTitle').innerHTML = '<i class="bi bi-pencil me-1"></i> Edit Berita';
            const panel = document.getElementById('blogFormPanel');
            panel.style.display = 'block';
            panel.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }

        function tutupFormBlog() {
            document.getElementById('blogFormPanel').style.display = 'none';
        }

        function previewThumbnail(input) {
            if (!input.files || !input.files[0]) return;
            const file = input.files[0];
            const reader = new FileReader();
            reader.onload = function (e) {
                document.getElementById('blogThumbnailBase64').value = e.target.result;
                document.getElementById('previewThumbnailImg').src = e.target.result;
                document.getElementById('previewThumbnailBox').style.display = 'block';
            };
            reader.readAsDataURL(file);
        }

        function hapusThumbnail() {
            document.getElementById('blogThumbnailBase64').value = '';
            document.getElementById('blogInputGambar').value = '';
            document.getElementById('previewThumbnailBox').style.display = 'none';
        }

        function renderPreviewGambarTambahan(arr) {
            const container = document.getElementById('previewGambarTambahan');
            if (!container) return;
            if (!arr || arr.length === 0) { container.innerHTML = ''; return; }
            container.innerHTML = arr.map((src, i) => `
        <div style="position:relative;display:inline-block;">
            <img src="${src}" style="width:80px;height:60px;object-fit:cover;border-radius:8px;border:1px solid #e2e8f0;">
            <button type="button" onclick="hapusGambarTambahan(${i})" style="position:absolute;top:-6px;right:-6px;background:#ef4444;color:#fff;border:none;border-radius:50%;width:18px;height:18px;font-size:10px;cursor:pointer;line-height:1;display:flex;align-items:center;justify-content:center;"><i class="bi bi-x-lg" style="font-size: 8px;"></i></button>
        </div>
    `).join('');
        }

        function hapusGambarTambahan(index) {
            let arr = [];
            try { arr = JSON.parse(document.getElementById('blogGambarTambahanBase64').value) || []; } catch (e) { }
            arr.splice(index, 1);
            document.getElementById('blogGambarTambahanBase64').value = JSON.stringify(arr);
            renderPreviewGambarTambahan(arr);
        }

        // Handle multiple image uploads for additional images
        document.addEventListener('DOMContentLoaded', function () {
            const inputTambahan = document.getElementById('blogInputGambarTambahan');
            if (inputTambahan) {
                inputTambahan.addEventListener('change', function () {
                    if (!this.files || this.files.length === 0) return;
                    let existing = [];
                    try { existing = JSON.parse(document.getElementById('blogGambarTambahanBase64').value) || []; } catch (e) { }
                    let pending = this.files.length;
                    Array.from(this.files).forEach(file => {
                        const reader = new FileReader();
                        reader.onload = function (e) {
                            existing.push(e.target.result);
                            pending--;
                            if (pending === 0) {
                                document.getElementById('blogGambarTambahanBase64').value = JSON.stringify(existing);
                                renderPreviewGambarTambahan(existing);
                            }
                        };
                        reader.readAsDataURL(file);
                    });
                });
            }
        });

        function simpanBerita() {
            const judul = document.getElementById('blogInputJudul').value.trim();
            const ringkasan = document.getElementById('blogInputRingkasan').value.trim();
            const isi = document.getElementById('blogInputIsi').value.trim();
            const kategori = document.getElementById('blogInputKategori').value;
            const tanggal = document.getElementById('blogInputTanggal').value;
            const status = document.getElementById('blogInputStatus').value;
            const gambar = document.getElementById('blogThumbnailBase64').value;
            let gambarTambahan = [];
            try { gambarTambahan = JSON.parse(document.getElementById('blogGambarTambahanBase64').value) || []; } catch (e) { }

            if (!judul) { showToast('<i class="bi bi-exclamation-triangle-fill text-warning"></i>', 'Judul Wajib Diisi', 'Masukkan judul berita terlebih dahulu.'); document.getElementById('blogInputJudul').focus(); return; }
            if (!ringkasan) { showToast('<i class="bi bi-exclamation-triangle-fill text-warning"></i>', 'Ringkasan Wajib Diisi', 'Tulis ringkasan berita terlebih dahulu.'); document.getElementById('blogInputRingkasan').focus(); return; }
            if (!isi) { showToast('<i class="bi bi-exclamation-triangle-fill text-warning"></i>', 'Isi Artikel Wajib Diisi', 'Tulis isi artikel terlebih dahulu.'); document.getElementById('blogInputIsi').focus(); return; }
            if (!kategori) { showToast('<i class="bi bi-exclamation-triangle-fill text-warning"></i>', 'Kategori Wajib Dipilih', 'Pilih kategori berita terlebih dahulu.'); return; }
            if (!tanggal) { showToast('<i class="bi bi-exclamation-triangle-fill text-warning"></i>', 'Tanggal Wajib Diisi', 'Isi tanggal berita terlebih dahulu.'); return; }

            const posts = getBlogData();
            const editId = document.getElementById('blogEditId').value;

            if (editId) {
                const idx = posts.findIndex(p => p.id === editId);
                if (idx !== -1) {
                    posts[idx] = { ...posts[idx], judul, ringkasan, isi, kategori, tanggal, status, gambar, gambarTambahan, updatedAt: Date.now() };
                }
                saveBlogData(posts);
                showToast('<i class="bi bi-check-circle-fill text-success"></i>', 'Berita Diperbarui', '"' + judul + '" berhasil diperbarui.');
            } else {
                const newPost = { id: 'blog_' + Date.now(), judul, ringkasan, isi, kategori, tanggal, status, gambar, gambarTambahan, createdAt: Date.now(), updatedAt: Date.now() };
                posts.unshift(newPost);
                saveBlogData(posts);
                showToast('<i class="bi bi-check-circle-fill text-success"></i>', 'Berita Disimpan', '"' + judul + '" berhasil ' + (status === 'published' ? 'dipublikasikan' : 'disimpan sebagai draft') + '.');
            }

            tutupFormBlog();
            renderDaftarBerita();
        }

        function hapusBerita(id) {
            const posts = getBlogData();
            const post = posts.find(p => p.id === id);
            if (!post) return;
            if (!confirm('Yakin ingin menghapus berita "' + post.judul + '"? Tindakan ini tidak bisa dibatalkan.')) return;
            const newPosts = posts.filter(p => p.id !== id);
            saveBlogData(newPosts);
            showToast('<i class="bi bi-trash text-danger"></i>', 'Berita Dihapus', '"' + post.judul + '" telah dihapus.');
            renderDaftarBerita();
        }

        function toggleStatusBerita(id) {
            const posts = getBlogData();
            const post = posts.find(p => p.id === id);
            if (!post) return;
            post.status = post.status === 'published' ? 'draft' : 'published';
            post.updatedAt = Date.now();
            saveBlogData(posts);
            const msg = post.status === 'published' ? 'Berita dipublikasikan ke halaman berita.' : 'Berita disembunyikan (draft).';
            showToast(post.status === 'published' ? '<i class="bi bi-check-circle-fill text-success"></i>' : '<i class="bi bi-file-earmark-text text-secondary"></i>', 'Status Diubah', msg);
            renderDaftarBerita();
        }

        function formatTanggalAdmin(tanggal) {
            if (!tanggal) return '–';
            const d = new Date(tanggal);
            return d.toLocaleDateString('id-ID', { day: 'numeric', month: 'short', year: 'numeric' });
        }

        function renderDaftarBerita() {
            let posts = getBlogData();
            const q = (document.getElementById('searchDaftarBerita')?.value || '').toLowerCase().trim();
            if (q) {
                posts = posts.filter(post =>
                    (post.judul || '').toLowerCase().includes(q) ||
                    (post.kategori || '').toLowerCase().includes(q) ||
                    (post.ringkasan || '').toLowerCase().includes(q) ||
                    (post.isi || '').toLowerCase().includes(q)
                );
            }
            const tbody = document.getElementById('tableDaftarBeritaBody');
            if (!tbody) return;
            if (posts.length === 0) {
                tbody.innerHTML = `<tr><td colspan="6" class="text-center text-muted py-5">
            <div style="font-size:36px;"><i class="bi bi-newspaper text-muted"></i></div>
            <div style="font-size:13px;margin-top:8px;">${q ? 'Berita tidak ditemukan untuk pencarian "' + q + '".' : 'Belum ada berita. Klik "Tulis Berita Baru" untuk memulai.'}</div>
        </td></tr>`;
                return;
            }
            tbody.innerHTML = posts.map(post => {
                const thumbHtml = post.gambar
                    ? `<img src="${post.gambar}" style="width:56px;height:42px;object-fit:cover;border-radius:6px;border:1px solid #e2e8f0;">`
                    : `<div style="width:56px;height:42px;background:linear-gradient(135deg,#ccfbf1,#a7f3d0);border-radius:6px;display:flex;align-items:center;justify-content:center;font-size:18px;"><i class="bi bi-image text-muted"></i></div>`;
                const statusHtml = post.status === 'published'
                    ? `<span class="status-badge badge-success"><i class="bi bi-check-circle-fill me-1"></i> Published</span>`
                    : `<span class="status-badge badge-secondary"><i class="bi bi-file-earmark-text me-1"></i> Draft</span>`;
                const extraImgCount = (post.gambarTambahan || []).length;
                return `
        <tr>
            <td>
                <div class="fw-semibold text-dark" style="font-size:13px;line-height:1.3;">${post.judul}</div>
                <div class="text-muted" style="font-size:10.5px;margin-top:2px;">${(post.ringkasan || '').substring(0, 60)}${(post.ringkasan || '').length > 60 ? '...' : ''}</div>
            </td>
            <td style="font-size:12px;white-space:nowrap;">${formatTanggalAdmin(post.tanggal)}</td>
            <td><span class="status-badge badge-info" style="font-size:10px;">${post.kategori || '–'}</span></td>
            <td>${statusHtml}</td>
            <td>
                ${thumbHtml}
                ${extraImgCount > 0 ? `<div style="font-size:10px;color:#64748b;margin-top:2px;">+${extraImgCount} lainnya</div>` : ''}
            </td>
            <td>
                <div class="d-flex flex-column gap-1">
                    <button class="btn btn-sm btn-outline-primary" onclick="openFormEditBlog('${post.id}')" style="border-radius:8px;font-size:10.5px;padding:3px 10px;"><i class="bi bi-pencil me-1"></i> Edit</button>
                    <button class="btn btn-sm" onclick="toggleStatusBerita('${post.id}')" style="border-radius:8px;font-size:10.5px;padding:3px 10px;border:1px solid;${post.status === 'published' ? 'color:#b45309;border-color:#fde68a;background:#fef9c3;' : 'color:#16a34a;border-color:#bbf7d0;background:#dcfce7;'}">${post.status === 'published' ? '<i class="bi bi-file-earmark-text me-1"></i> Jadikan Draft' : '<i class="bi bi-check-circle-fill me-1"></i> Publish'}</button>
                    <button class="btn btn-sm btn-outline-danger" onclick="hapusBerita('${post.id}')" style="border-radius:8px;font-size:10.5px;padding:3px 10px;"><i class="bi bi-trash me-1"></i> Hapus</button>
                </div>
            </td>
        </tr>`;
            }).join('');
        }
    </script>

    <script>
        // ==================== GALERI / KELOLA GALERI ====================
        const GALERI_KEY = 'ppdb_gallery_items';

        function getGaleriData() {
            try { return JSON.parse(localStorage.getItem(GALERI_KEY)) || []; } catch (e) { return []; }
        }
        function saveGaleriData(items) {
            localStorage.setItem(GALERI_KEY, JSON.stringify(items));
        }

        function openFormGaleriBaru() {
            document.getElementById('galeriEditId').value = '';
            document.getElementById('galeriInputNama').value = '';
            document.getElementById('galeriInputKategori').value = '';
            document.getElementById('galeriFotoBase64').value = '';
            document.getElementById('galeriInputFoto').value = '';
            document.getElementById('previewGaleriFotoBox').style.display = 'none';
            document.getElementById('galeriNoFotoPlaceholder').style.display = 'flex';
            document.getElementById('galeriFormTitle').innerHTML = '<i class="bi bi-plus-circle me-1"></i> Tambah Galeri Baru';
            const panel = document.getElementById('galeriFormPanel');
            panel.style.display = 'block';
            panel.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }

        function openFormEditGaleri(id) {
            const items = getGaleriData();
            const item = items.find(i => i.id === id);
            if (!item) return;
            document.getElementById('galeriEditId').value = id;
            document.getElementById('galeriInputNama').value = item.nama || '';
            document.getElementById('galeriInputKategori').value = item.kategori || '';
            document.getElementById('galeriFotoBase64').value = item.foto || '';
            document.getElementById('galeriInputFoto').value = '';
            const prevBox = document.getElementById('previewGaleriFotoBox');
            const noPlaceholder = document.getElementById('galeriNoFotoPlaceholder');
            if (item.foto) {
                document.getElementById('previewGaleriFotoImg').src = item.foto;
                prevBox.style.display = 'block';
                noPlaceholder.style.display = 'none';
            } else {
                prevBox.style.display = 'none';
                noPlaceholder.style.display = 'flex';
            }
            document.getElementById('galeriFormTitle').innerHTML = '<i class="bi bi-pencil me-1"></i> Edit Galeri';
            const panel = document.getElementById('galeriFormPanel');
            panel.style.display = 'block';
            panel.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }

        function tutupFormGaleri() {
            document.getElementById('galeriFormPanel').style.display = 'none';
        }

        function previewGaleriFoto(input) {
            if (!input.files || !input.files[0]) return;
            const reader = new FileReader();
            reader.onload = function (e) {
                document.getElementById('galeriFotoBase64').value = e.target.result;
                document.getElementById('previewGaleriFotoImg').src = e.target.result;
                document.getElementById('previewGaleriFotoBox').style.display = 'block';
                document.getElementById('galeriNoFotoPlaceholder').style.display = 'none';
            };
            reader.readAsDataURL(input.files[0]);
        }

        function hapusFotoGaleri() {
            document.getElementById('galeriFotoBase64').value = '';
            document.getElementById('galeriInputFoto').value = '';
            document.getElementById('previewGaleriFotoBox').style.display = 'none';
            document.getElementById('galeriNoFotoPlaceholder').style.display = 'flex';
        }

        function simpanGaleri() {
            const nama = document.getElementById('galeriInputNama').value.trim();
            const kategori = document.getElementById('galeriInputKategori').value;
            const foto = document.getElementById('galeriFotoBase64').value;

            if (!nama) { showToast('<i class="bi bi-exclamation-triangle-fill text-warning"></i>', 'Nama Wajib Diisi', 'Masukkan nama fasilitas atau ekstrakurikuler.'); document.getElementById('galeriInputNama').focus(); return; }
            if (!kategori) { showToast('<i class="bi bi-exclamation-triangle-fill text-warning"></i>', 'Kategori Wajib Dipilih', 'Pilih kategori Fasilitas or Ekstrakurikuler.'); return; }

            const items = getGaleriData();
            const editId = document.getElementById('galeriEditId').value;

            if (editId) {
                const idx = items.findIndex(i => i.id === editId);
                if (idx !== -1) {
                    items[idx] = { ...items[idx], nama, kategori, foto, updatedAt: Date.now() };
                }
                saveGaleriData(items);
                showToast('<i class="bi bi-check-circle-fill text-success"></i>', 'Galeri Diperbarui', '"' + nama + '" berhasil diperbarui.');
            } else {
                const newItem = { id: 'galeri_' + Date.now(), nama, kategori, foto, createdAt: Date.now(), updatedAt: Date.now() };
                items.unshift(newItem);
                saveGaleriData(items);
                showToast('<i class="bi bi-check-circle-fill text-success"></i>', 'Galeri Ditambahkan', '"' + nama + '" berhasil ditambahkan ke galeri ' + kategori + '.');
            }

            tutupFormGaleri();
            renderDaftarGaleri();
        }

        function hapusGaleri(id) {
            const items = getGaleriData();
            const item = items.find(i => i.id === id);
            if (!item) return;
            if (!confirm('Yakin ingin menghapus "' + item.nama + '"? Tindakan ini tidak bisa dibatalkan.')) return;
            saveGaleriData(items.filter(i => i.id !== id));
            showToast('<i class="bi bi-trash text-danger"></i>', 'Galeri Dihapus', '"' + item.nama + '" telah dihapus dari galeri.');
            renderDaftarGaleri();
        }

        function renderDaftarGaleri() {
            const allItems = getGaleriData();

            // ---- FASILITAS ----
            const qFas = (document.getElementById('searchGaleriFasilitas')?.value || '').toLowerCase().trim();
            let fasilitas = allItems.filter(i => i.kategori === 'Fasilitas');
            if (qFas) fasilitas = fasilitas.filter(i => (i.nama || '').toLowerCase().includes(qFas));

            const gridFas = document.getElementById('gridGaleriFasilitas');
            if (gridFas) {
                if (fasilitas.length === 0) {
                    gridFas.innerHTML = `<div class="col-12 text-center text-muted py-4" style="font-size:13px;"><div style="font-size:36px;"><i class="bi bi-building text-muted"></i></div><div class="mt-2">${qFas ? 'Fasilitas tidak ditemukan untuk pencarian "' + qFas + '".' : 'Belum ada data fasilitas. Klik "Tambah Galeri Baru" untuk memulai.'}</div></div>`;
                } else {
                    gridFas.innerHTML = fasilitas.map(item => renderGaleriCard(item)).join('');
                }
            }

            // ---- EKSTRAKURIKULER ----
            const qEks = (document.getElementById('searchGaleriEkstrakurikuler')?.value || '').toLowerCase().trim();
            let ekstra = allItems.filter(i => i.kategori === 'Ekstrakurikuler');
            if (qEks) ekstra = ekstra.filter(i => (i.nama || '').toLowerCase().includes(qEks));

            const gridEks = document.getElementById('gridGaleriEkstrakurikuler');
            if (gridEks) {
                if (ekstra.length === 0) {
                    gridEks.innerHTML = `<div class="col-12 text-center text-muted py-4" style="font-size:13px;"><div style="font-size:36px;"><i class="bi bi-trophy text-muted"></i></div><div class="mt-2">${qEks ? 'Ekstrakurikuler tidak ditemukan untuk pencarian "' + qEks + '".' : 'Belum ada data ekstrakurikuler. Klik "Tambah Galeri Baru" untuk memulai.'}</div></div>`;
                } else {
                    gridEks.innerHTML = ekstra.map(item => renderGaleriCard(item)).join('');
                }
            }
        }

        function renderGaleriCard(item) {
            const fotoHtml = item.foto
                ? `<img src="${item.foto}" alt="${item.nama}" style="width:100%;height:160px;object-fit:cover;border-radius:10px 10px 0 0;">`
                : `<div style="width:100%;height:160px;background:linear-gradient(135deg,#ccfbf1,#a7f3d0);border-radius:10px 10px 0 0;display:flex;align-items:center;justify-content:center;font-size:36px;">${item.kategori === 'Fasilitas' ? '<i class="bi bi-building text-muted"></i>' : '<i class="bi bi-trophy text-muted"></i>'}</div>`;
            const badgeColor = item.kategori === 'Fasilitas' ? 'badge-info' : 'badge-success';
            return `
    <div class="col-lg-3 col-md-4 col-sm-6">
        <div class="card border-0 shadow-sm rounded-3 overflow-hidden" style="background:#fff;transition:all 0.2s;" onmouseover="this.style.transform='translateY(-3px)';this.style.boxShadow='0 8px 20px rgba(13,148,136,0.14)';" onmouseout="this.style.transform='';this.style.boxShadow='';">
            ${fotoHtml}
            <div class="p-3">
                <span class="status-badge ${badgeColor} mb-1" style="font-size:10px;">${item.kategori}</span>
                <div class="fw-semibold text-dark mt-1" style="font-size:13px;line-height:1.3;">${item.nama}</div>
            </div>
            <div class="px-3 pb-3 d-flex gap-2">
                <button class="btn btn-sm btn-outline-primary flex-fill" onclick="openFormEditGaleri('${item.id}')" style="border-radius:8px;font-size:11px;"><i class="bi bi-pencil me-1"></i> Edit</button>
                <button class="btn btn-sm btn-outline-danger flex-fill" onclick="hapusGaleri('${item.id}')" style="border-radius:8px;font-size:11px;"><i class="bi bi-trash me-1"></i> Hapus</button>
            </div>
        </div>
    </div>`;
        }
    </script>

    <script>
        // ==========================================
        // ===== KELOLA KONTEN HOME (SLIDER) ========
        // ==========================================

        const SLIDER_API_BASE = '/admin/home-slider';
        const SLIDER_CSRF = document.querySelector('meta[name="csrf-token"]') ? document.querySelector('meta[name="csrf-token"]').content : '';

        async function renderDaftarSlider() {
            const container = document.getElementById('sliderGridContainer');
            const emptyState = document.getElementById('sliderEmptyState');
            const badge = document.getElementById('sliderCountBadge');
            if (!container) return;

            try {
                const res = await fetch(SLIDER_API_BASE, { headers: { 'Accept': 'application/json', 'X-CSRF-TOKEN': SLIDER_CSRF } });
                const data = await res.json();

                badge.textContent = data.length + ' Slider';

                if (!data || data.length === 0) {
                    container.innerHTML = `<div class="col-12 text-center py-5 text-muted" id="sliderEmptyState">
                <i class="bi bi-images mb-2" style="font-size:40px;display:block;opacity:0.3;"></i>
                <div style="font-size:13px;">Belum ada gambar slider. Klik <strong>"Tambah Gambar Slider"</strong> untuk memulai.</div>
                <div style="font-size:11.5px;margin-top:4px;">Carousel di halaman Home akan kosong (tidak tampil) jika tidak ada slider aktif.</div>
            </div>`;
                    return;
                }

                container.innerHTML = data.map(s => renderSliderCard(s)).join('');
            } catch (e) {
                container.innerHTML = `<div class="col-12 text-center py-4 text-danger" style="font-size:13px;"><i class="bi bi-exclamation-triangle me-2"></i>Gagal memuat data slider. Coba refresh halaman.</div>`;
            }
        }

        function renderSliderCard(s) {
            const badgeClass = s.aktif ? 'badge-success' : 'badge-secondary';
            const badgeLabel = s.aktif ? 'Aktif' : 'Nonaktif';
            return `<div class="col-md-4 col-lg-3" id="sliderCard_${s.id}">
        <div class="card border rounded-4 shadow-sm overflow-hidden h-100" style="border-color:var(--toska-100)!important;">
            <div class="position-relative" style="height:160px;overflow:hidden;background:#0d9488;">
                <img src="/${s.gambar}" alt="${s.judul}" style="width:100%;height:100%;object-fit:cover;" onerror="this.src='';this.closest('.position-relative').style.background='#0d9488';">
                <span class="position-absolute top-0 start-0 m-2 status-badge ${badgeClass}">${badgeLabel}</span>
                <span class="position-absolute top-0 end-0 m-2 badge" style="background:rgba(0,0,0,0.5);color:#fff;border-radius:6px;font-size:10px;">Urutan ${s.urutan}</span>
            </div>
            <div class="p-3">
                <div class="fw-bold text-dark mb-1" style="font-size:13px;line-height:1.3;">${s.judul}</div>
                ${s.deskripsi ? `<div class="text-muted mb-2" style="font-size:11px;">${s.deskripsi.length > 60 ? s.deskripsi.substring(0, 60) + '...' : s.deskripsi}</div>` : ''}
                ${s.link_url ? `<div class="text-muted mb-2" style="font-size:10.5px;"><i class="bi bi-link-45deg"></i> ${s.link_url}</div>` : ''}
            </div>
            <div class="px-3 pb-3 d-flex gap-2 flex-wrap">
                <button class="btn btn-sm btn-toska flex-fill" onclick="openFormEditSlider(${s.id})" style="border-radius:8px;font-size:11px;"><i class="bi bi-pencil me-1"></i>Edit</button>
                <button class="btn btn-sm ${s.aktif ? 'btn-outline-warning' : 'btn-outline-success'} flex-fill" onclick="toggleAktifSlider(${s.id}, ${s.aktif ? 0 : 1})" style="border-radius:8px;font-size:11px;">
                    <i class="bi bi-${s.aktif ? 'eye-slash' : 'eye'} me-1"></i>${s.aktif ? 'Nonaktifkan' : 'Aktifkan'}
                </button>
                <button class="btn btn-sm btn-outline-danger" onclick="hapusSlider(${s.id}, '${s.judul.replace(/'/g, "\\\'")}')" style="border-radius:8px;font-size:11px;width:36px;"><i class="bi bi-trash"></i></button>
            </div>
        </div>
    </div>`;
        }

        function openFormSliderBaru() {
            document.getElementById('sliderEditId').value = '';
            document.getElementById('sliderInputJudul').value = '';
            document.getElementById('sliderInputDeskripsi').value = '';
            document.getElementById('sliderInputLink').value = '';
            document.getElementById('sliderInputUrutan').value = '0';
            document.getElementById('sliderInputAktif').value = '1';
            document.getElementById('sliderGambarBase64').value = '';
            document.getElementById('sliderInputGambar').value = '';
            document.getElementById('sliderPreviewBox').style.display = 'none';
            document.getElementById('sliderFormTitle').innerHTML = '<i class="bi bi-image me-1"></i> Tambah Gambar Slider Baru';
            document.getElementById('sliderFormPanel').style.display = 'block';
            document.getElementById('sliderFormPanel').scrollIntoView({ behavior: 'smooth', block: 'start' });
        }

        async function openFormEditSlider(id) {
            try {
                const res = await fetch(SLIDER_API_BASE, { headers: { 'Accept': 'application/json' } });
                const data = await res.json();
                const s = data.find(x => x.id == id);
                if (!s) return alert('Data tidak ditemukan!');

                document.getElementById('sliderEditId').value = s.id;
                document.getElementById('sliderInputJudul').value = s.judul;
                document.getElementById('sliderInputDeskripsi').value = s.deskripsi || '';
                document.getElementById('sliderInputLink').value = s.link_url || '';
                document.getElementById('sliderInputUrutan').value = s.urutan;
                document.getElementById('sliderInputAktif').value = s.aktif ? '1' : '0';
                document.getElementById('sliderGambarBase64').value = '';

                // Show existing image preview
                const previewBox = document.getElementById('sliderPreviewBox');
                const previewImg = document.getElementById('sliderPreviewImg');
                previewImg.src = '/' + s.gambar;
                previewBox.style.display = 'block';

                document.getElementById('sliderFormTitle').innerHTML = '<i class="bi bi-pencil-square me-1"></i> Edit Gambar Slider';
                document.getElementById('sliderFormPanel').style.display = 'block';
                document.getElementById('sliderFormPanel').scrollIntoView({ behavior: 'smooth', block: 'start' });
            } catch (e) {
                alert('Gagal memuat data slider!');
            }
        }

        function tutupFormSlider() {
            document.getElementById('sliderFormPanel').style.display = 'none';
        }

        function previewSliderGambar(input) {
            if (!input.files || !input.files[0]) return;
            const file = input.files[0];
            if (file.size > 5 * 1024 * 1024) { alert('Ukuran gambar maksimal 5MB!'); input.value = ''; return; }
            const reader = new FileReader();
            reader.onload = function (e) {
                document.getElementById('sliderPreviewImg').src = e.target.result;
                document.getElementById('sliderPreviewBox').style.display = 'block';
                document.getElementById('sliderGambarBase64').value = e.target.result;
            };
            reader.readAsDataURL(file);
        }

        function hapusPreviewSlider() {
            document.getElementById('sliderInputGambar').value = '';
            document.getElementById('sliderPreviewImg').src = '';
            document.getElementById('sliderPreviewBox').style.display = 'none';
            document.getElementById('sliderGambarBase64').value = '';
        }

        async function simpanSlider() {
            const judul = document.getElementById('sliderInputJudul').value.trim();
            const gambarBase64 = document.getElementById('sliderGambarBase64').value;
            const editId = document.getElementById('sliderEditId').value;

            if (!judul) { alert('Judul slide wajib diisi!'); document.getElementById('sliderInputJudul').focus(); return; }
            if (!editId && !gambarBase64) { alert('Pilih gambar terlebih dahulu!'); return; }

            const payload = {
                judul,
                deskripsi: document.getElementById('sliderInputDeskripsi').value.trim() || null,
                link_url: document.getElementById('sliderInputLink').value.trim() || null,
                urutan: parseInt(document.getElementById('sliderInputUrutan').value) || 0,
                aktif: document.getElementById('sliderInputAktif').value === '1',
            };
            if (gambarBase64) payload.gambar = gambarBase64;

            const isEdit = !!editId;
            const url = isEdit ? `${SLIDER_API_BASE}/${editId}` : SLIDER_API_BASE;
            const method = isEdit ? 'PUT' : 'POST';

            try {
                const res = await fetch(url, {
                    method,
                    headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': SLIDER_CSRF },
                    body: JSON.stringify(payload)
                });
                const result = await res.json();
                if (result.success) {
                    tutupFormSlider();
                    renderDaftarSlider();
                    showToast('<i class="bi bi-check-circle-fill text-success"></i>', isEdit ? 'Slider Diperbarui' : 'Slider Ditambahkan', '"' + judul + '" berhasil ' + (isEdit ? 'diperbarui' : 'ditambahkan') + '.');
                } else {
                    alert('Gagal menyimpan slider: ' + (result.message || 'Error tidak diketahui'));
                }
            } catch (e) {
                alert('Terjadi kesalahan koneksi. Coba lagi!');
            }
        }

        async function hapusSlider(id, judul) {
            if (!confirm(`Yakin ingin menghapus slider "${judul}"? Gambar akan dihapus permanen.`)) return;
            try {
                const res = await fetch(`${SLIDER_API_BASE}/${id}`, {
                    method: 'DELETE',
                    headers: { 'Accept': 'application/json', 'X-CSRF-TOKEN': SLIDER_CSRF }
                });
                const result = await res.json();
                if (result.success) {
                    renderDaftarSlider();
                    showToast('<i class="bi bi-trash text-danger"></i>', 'Slider Dihapus', '"' + judul + '" berhasil dihapus.');
                } else {
                    alert('Gagal menghapus slider!');
                }
            } catch (e) {
                alert('Terjadi kesalahan koneksi!');
            }
        }

        async function toggleAktifSlider(id, newAktif) {
            try {
                const res = await fetch(`${SLIDER_API_BASE}/${id}`, {
                    method: 'PUT',
                    headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': SLIDER_CSRF },
                    body: JSON.stringify({ aktif: newAktif === 1 })
                });
                const result = await res.json();
                if (result.success) {
                    renderDaftarSlider();
                    showToast('<i class="bi bi-toggle-on text-success"></i>', 'Status Diubah', `Slider berhasil di${newAktif ? 'aktifkan' : 'nonaktifkan'}.`);
                }
            } catch (e) {
                alert('Gagal mengubah status!');
            }
        }
    </script>
    </script>
    <script>
        // Responsive Sidebar functions
        function toggleSidebarAdmin() {
            const sidebar = document.querySelector('.sidebar');
            const overlay = document.getElementById('sidebarOverlayAdmin');
            sidebar.classList.toggle('open');
            overlay.classList.toggle('active');
        }

        function closeSidebarAdmin() {
            const sidebar = document.querySelector('.sidebar');
            const overlay = document.getElementById('sidebarOverlayAdmin');
            sidebar.classList.remove('open');
            overlay.classList.remove('active');
        }

        // Close sidebar automatically on mobile when a menu item is clicked
        document.querySelectorAll('.sidebar .nav-link').forEach(link => {
            link.addEventListener('click', () => {
                if(window.innerWidth <= 768 && !link.id.includes('Dropdown')) {
                    closeSidebarAdmin();
                }
            });
        });
    </script>

    <style>
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(12px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</body>

</html>