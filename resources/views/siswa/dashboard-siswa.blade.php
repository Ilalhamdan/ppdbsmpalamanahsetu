<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Dashboard Calon Siswa PPDB SMP Al-Amanah - Pantau dan lengkapi proses pendaftaran Anda secara real-time.">
    <title>Dashboard Calon Siswa - PPDB SMP Al-Amanah</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

    @vite(['resources/css/app.css'])

    <style>
        :root {
            --sidebar-width: 265px;
            --toska-600: #0d9488;
            --toska-700: #0f766e;
            --toska-800: #115e59;
            --sidebar-text: rgba(255, 255, 255, 0.82);
            --sidebar-hover: rgba(255, 255, 255, 0.15);
            --accent-green: #10b981;
            --body-bg: #f1f5f9;
            --card-bg: #ffffff;
            --text-primary: #1e293b;
            --text-secondary: #64748b;
            --border-color: #e2e8f0;
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--body-bg);
            color: var(--text-primary);
            overflow-x: hidden;
        }

        ::-webkit-scrollbar {
            width: 5px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }

        /* ===== SIDEBAR ===== */
        .sidebar {
            width: var(--sidebar-width);
            height: 100%;
            background: linear-gradient(180deg, #0d9488 0%, #0f766e 50%, #115e59 100%);
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            display: flex;
            flex-direction: column;
            z-index: 1040;
            overflow-y: auto;
            overflow-x: hidden;
            box-shadow: 4px 0 20px rgba(0, 0, 0, 0.12);
        }

        .sidebar-brand {
            padding: 1.2rem 1.25rem 1rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.12);
        }

        .brand-logo-box {
            width: 40px;
            height: 40px;
            background: #fff;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
            padding: 3px;
        }

        .brand-name {
            font-size: 13px;
            font-weight: 700;
            color: #fff;
            line-height: 1.2;
        }

        .brand-sub {
            font-size: 10px;
            color: rgba(255, 255, 255, 0.65);
            font-weight: 400;
        }

        .tahun-badge {
            font-size: 10px;
            color: #fff;
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.25);
            border-radius: 20px;
            padding: 2px 10px;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            margin-top: 6px;
        }

        .sidebar-nav {
            padding: 0.85rem 0.875rem;
            flex: 1;
        }

        .nav-section-label {
            font-size: 9px;
            font-weight: 700;
            letter-spacing: 1.2px;
            text-transform: uppercase;
            color: rgba(255, 255, 255, 0.5);
            padding: 0 0.5rem;
            margin-bottom: 5px;
            margin-top: 12px;
        }

        .sidebar-menu-item {
            display: flex;
            align-items: center;
            padding: 0.6rem 0.85rem;
            border-radius: 10px;
            color: var(--sidebar-text);
            font-weight: 500;
            font-size: 12.5px;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.2s;
            background: transparent;
            border: 1px solid transparent;
            margin-bottom: 3px;
            gap: 10px;
        }

        .sidebar-menu-item:hover {
            background: var(--sidebar-hover);
            color: #fff;
        }

        .sidebar-menu-item.active {
            background: rgba(255, 255, 255, 0.95);
            color: #0f766e !important;
            font-weight: 700;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .menu-icon {
            width: 28px;
            height: 28px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 7px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            flex-shrink: 0;
            transition: all 0.2s;
        }

        .sidebar-menu-item.active .menu-icon {
            background: #ccfbf1;
            color: #0d9488;
        }

        .status-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            margin-left: auto;
            flex-shrink: 0;
        }

        .status-dot.done {
            background: #10b981;
        }

        .status-dot.pending {
            background: #f59e0b;
        }

        .status-dot.locked {
            background: rgba(255, 255, 255, 0.3);
        }

        .status-dot.review {
            background: #3b82f6;
        }

        .status-dot.approved {
            background: #10b981;
            box-shadow: 0 0 6px rgba(16, 185, 129, 0.5);
        }

        .status-dot.rejected {
            background: #ef4444;
        }

        .sidebar-footer {
            padding: 1rem 1rem;
            border-top: 1px solid rgba(255, 255, 255, 0.12);
        }

        .logout-btn {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 0.6rem 0.85rem;
            border-radius: 10px;
            color: rgba(255, 255, 255, 0.7);
            font-size: 12.5px;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s;
        }

        .logout-btn:hover {
            background: rgba(239, 68, 68, 0.15);
            color: #fca5a5;
        }

        /* ===== MAIN WRAPPER ===== */
        .main-wrapper {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ===== TOPBAR ===== */
        .topbar {
            background: #fff;
            border-bottom: 1px solid var(--border-color);
            padding: 0 1.75rem;
            height: 62px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 999;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.04);
        }

        .topbar-title h1 {
            font-size: 18px;
            font-weight: 700;
            color: var(--text-primary);
            margin: 0;
        }

        .topbar-title span {
            font-size: 11px;
            color: var(--text-secondary);
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .breadcrumb-sep {
            color: #cbd5e1;
        }

        .topbar-actions {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .icon-btn {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background: var(--body-bg);
            border: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            cursor: pointer;
            position: relative;
            transition: all 0.2s;
            color: var(--text-secondary);
        }

        .icon-btn:hover {
            background: #ccfbf1;
            border-color: #0d9488;
            color: #0d9488;
        }

        .notif-badge {
            position: absolute;
            top: 4px;
            right: 4px;
            width: 8px;
            height: 8px;
            background: #ef4444;
            border-radius: 50%;
            border: 1.5px solid #fff;
            display: none;
        }

        .notif-badge.show {
            display: block;
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

        .profile-btn {
            display: flex;
            align-items: center;
            gap: 8px;
            background: none;
            border: none;
            cursor: pointer;
            padding: 4px 8px;
            border-radius: 10px;
            transition: all 0.2s;
        }

        .profile-btn:hover {
            background: var(--body-bg);
        }

        .profile-avatar-top {
            width: 34px;
            height: 34px;
            border-radius: 10px;
            background: linear-gradient(135deg, #0d9488, #0f766e);
            color: #fff;
            font-size: 12px;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .profile-info-text .name {
            font-size: 12.5px;
            font-weight: 600;
            color: var(--text-primary);
        }

        .profile-info-text .role {
            font-size: 10.5px;
            color: var(--text-secondary);
        }

        /* ===== PAGE CONTENT ===== */
        .page-content {
            padding: 1.5rem 1.75rem;
            flex: 1;
        }

        .dashboard-section {
            display: none;
        }

        .dashboard-section.active {
            display: block;
        }

        /* ===== CARDS & COMPONENTS ===== */
        .stat-card {
            background: var(--card-bg);
            border-radius: 14px;
            padding: 16px 18px;
            border: 1px solid var(--border-color);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
            transition: all 0.2s;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.08);
        }

        .stat-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            margin-bottom: 10px;
        }

        .stat-icon.blue {
            background: #dbeafe;
        }

        .stat-icon.green {
            background: #dcfce7;
        }

        .stat-icon.yellow {
            background: #fef9c3;
        }

        .stat-icon.purple {
            background: #ede9fe;
        }

        .stat-icon.red {
            background: #fee2e2;
        }

        .stat-label {
            font-size: 11.5px;
            color: var(--text-secondary);
            font-weight: 500;
            margin-bottom: 4px;
        }

        .stat-value {
            font-size: 22px;
            font-weight: 800;
            color: var(--text-primary);
            line-height: 1;
        }

        .stat-hint {
            font-size: 10.5px;
            color: var(--text-secondary);
            margin-top: 4px;
        }

        .section-title {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13.5px;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 12px;
        }

        .section-title .icon {
            width: 28px;
            height: 28px;
            background: #ccfbf1;
            border-radius: 7px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
        }

        /* ===== WELCOME BANNER ===== */
        .welcome-banner {
            background: linear-gradient(135deg, #0d9488 0%, #0f766e 50%, #134e4a 100%);
            border-radius: 16px;
            padding: 28px 28px;
            color: #fff;
            margin-bottom: 24px;
            position: relative;
            overflow: hidden;
        }

        .welcome-greeting {
            font-size: 12.5px;
            color: rgba(255, 255, 255, 0.75);
            margin-bottom: 4px;
        }

        .welcome-name {
            font-size: 22px;
            font-weight: 800;
            margin-bottom: 8px;
        }

        .welcome-sub {
            font-size: 12px;
            color: rgba(255, 255, 255, 0.72);
            max-width: 520px;
            line-height: 1.6;
            margin-bottom: 16px;
        }

        .welcome-action-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: #fff;
            font-size: 12.5px;
            font-weight: 600;
            padding: 8px 18px;
            border-radius: 20px;
            text-decoration: none;
            transition: all 0.2s;
            cursor: pointer;
        }

        .welcome-action-btn:hover {
            background: rgba(255, 255, 255, 0.25);
            color: #fff;
        }

        /* ===== PROGRESS CARD ===== */
        .progress-card {
            background: var(--card-bg);
            border-radius: 14px;
            border: 1px solid var(--border-color);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
            overflow: hidden;
        }

        .progress-step {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 16px;
            border-bottom: 1px solid var(--border-color);
            transition: background 0.2s;
            cursor: pointer;
        }

        .progress-step:last-child {
            border-bottom: none;
        }

        .progress-step:hover {
            background: #f8fafc;
        }

        .step-number {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: 700;
            flex-shrink: 0;
        }

        .step-number.done {
            background: #dcfce7;
            color: #16a34a;
        }

        .step-number.active {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .step-number.pending {
            background: #fef9c3;
            color: #b45309;
        }

        .step-number.locked {
            background: #f1f5f9;
            color: #94a3b8;
        }

        .step-number.approved {
            background: #dcfce7;
            color: #16a34a;
        }

        .step-number.review {
            background: #e0f2fe;
            color: #0369a1;
        }

        .step-number.rejected {
            background: #fee2e2;
            color: #dc2626;
        }

        .step-info {
            flex: 1;
        }

        .step-name {
            font-size: 12.5px;
            font-weight: 600;
            color: var(--text-primary);
        }

        .step-desc {
            font-size: 11px;
            color: var(--text-secondary);
            margin-top: 1px;
        }

        .step-status {
            font-size: 10px;
            font-weight: 600;
            padding: 3px 10px;
            border-radius: 20px;
            flex-shrink: 0;
        }

        .step-status.done {
            background: #dcfce7;
            color: #16a34a;
        }

        .step-status.active {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .step-status.pending {
            background: #fef9c3;
            color: #b45309;
        }

        .step-status.locked {
            background: #f1f5f9;
            color: #94a3b8;
        }

        .step-status.approved {
            background: #dcfce7;
            color: #16a34a;
        }

        .step-status.review {
            background: #e0f2fe;
            color: #0369a1;
        }

        .step-status.rejected {
            background: #fee2e2;
            color: #dc2626;
        }

        /* ===== INFO CARD ===== */
        .info-card {
            background: var(--card-bg);
            border-radius: 14px;
            border: 1px solid var(--border-color);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
            overflow: hidden;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            padding: 10px 16px;
            border-bottom: 1px solid var(--border-color);
            gap: 8px;
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .info-key {
            font-size: 11.5px;
            color: var(--text-secondary);
            font-weight: 500;
            flex-shrink: 0;
        }

        .info-val {
            font-size: 12.5px;
            color: var(--text-primary);
            font-weight: 600;
            text-align: right;
        }

        /* ===== NOTICE BOX ===== */
        .notice-box {
            background: #fff7ed;
            border: 1px solid #fed7aa;
            border-left: 4px solid #f97316;
            border-radius: 12px;
            padding: 14px 16px;
            display: flex;
            gap: 12px;
            align-items: flex-start;
        }

        .notice-icon {
            font-size: 18px;
            flex-shrink: 0;
            margin-top: 1px;
        }

        .notice-title {
            font-size: 13px;
            font-weight: 700;
            color: #7c2d12;
            margin-bottom: 3px;
        }

        .notice-text {
            font-size: 12px;
            color: #9a3412;
            line-height: 1.5;
        }

        /* ===== DARK CARD (forms, berkas, etc) ===== */
        .dark-card {
            background: linear-gradient(135deg, #0d9488 0%, #0f766e 100%);
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }

        /* ===== DARK FORM STYLES ===== */
        .dark-card .form-label {
            color: #ccfbf1 !important;
            font-weight: 600 !important;
            font-size: 12.5px !important;
        }

        .dark-card .form-control,
        .dark-card .form-select,
        .dark-card textarea {
            color: #ffffff !important;
            background-color: rgba(0, 0, 0, 0.2) !important;
            border: 1.5px solid rgba(255, 255, 255, 0.2) !important;
            font-size: 13px !important;
            padding: 10px 14px !important;
            border-radius: 10px !important;
        }

        .dark-card .form-control:focus,
        .dark-card .form-select:focus,
        .dark-card textarea:focus {
            border-color: #2dd4bf !important;
            box-shadow: 0 0 0 3px rgba(45, 212, 191, 0.25) !important;
            background-color: rgba(0, 0, 0, 0.3) !important;
        }

        .dark-card .form-control::placeholder,
        .dark-card textarea::placeholder {
            color: rgba(204, 251, 241, 0.55) !important;
        }

        .dark-card .form-select option {
            background-color: #0f766e !important;
            color: #fff !important;
        }

        .dark-card .text-white-50 {
            color: rgba(255, 255, 255, 0.75) !important;
            font-size: 11.5px !important;
        }

        /* ===== BERKAS UPLOAD ITEM ===== */
        .berkas-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 14px 16px;
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.04);
            margin-bottom: 10px;
            transition: all 0.2s;
        }

        .berkas-item:hover {
            background: rgba(255, 255, 255, 0.07);
        }

        .berkas-item.uploaded {
            border-color: rgba(16, 185, 129, 0.5);
            background: rgba(16, 185, 129, 0.08);
        }

        /* ===== JALUR SELECTION CARD ===== */
        .jalur-card {
            background: rgba(255, 255, 255, 0.06);
            border: 2px solid rgba(255, 255, 255, 0.15);
            border-radius: 14px;
            padding: 20px 18px;
            cursor: pointer;
            transition: all 0.25s;
            color: #fff;
            text-align: center;
        }

        .jalur-card:hover {
            background: rgba(255, 255, 255, 0.12);
            border-color: rgba(255, 255, 255, 0.4);
            transform: translateY(-2px);
        }

        .jalur-card.selected {
            border-color: #fbbf24;
            background: rgba(251, 191, 36, 0.12);
            box-shadow: 0 0 0 3px rgba(251, 191, 36, 0.2);
        }

        .jalur-icon {
            font-size: 32px;
            margin-bottom: 10px;
            display: block;
        }

        .jalur-title {
            font-size: 14px;
            font-weight: 700;
            margin-bottom: 4px;
        }

        .jalur-desc {
            font-size: 11px;
            color: rgba(255, 255, 255, 0.7);
            line-height: 1.5;
        }

        /* ===== NOTIFICATION PANEL ===== */
        .notif-panel {
            position: fixed;
            top: 62px;
            right: 20px;
            width: 340px;
            background: #fff;
            border-radius: 14px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
            border: 1px solid var(--border-color);
            z-index: 2000;
            display: none;
            animation: fadeInDown 0.2s ease;
        }

        .notif-panel.show {
            display: block;
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-8px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .notif-header {
            padding: 14px 16px 10px;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .notif-item {
            padding: 12px 16px;
            border-bottom: 1px solid var(--border-color);
            cursor: pointer;
            transition: background 0.15s;
            display: block;
        }

        .notif-item:last-child {
            border-bottom: none;
        }

        .notif-item:hover {
            background: #f8fafc;
        }

        .notif-item.unread {
            background: #f0fdf4;
        }

        .notif-item.unread:hover {
            background: #dcfce7;
        }

        .notif-type-icon {
            font-size: 18px;
            flex-shrink: 0;
            margin-top: 2px;
        }

        /* ===== ALERT BANNERS ===== */
        .alert-banner {
            border-radius: 12px;
            padding: 14px 16px;
            border-left: 4px solid;
            margin-bottom: 12px;
            display: flex;
            align-items: flex-start;
            gap: 12px;
        }

        .alert-banner.success {
            background: #f0fdf4;
            border-color: #16a34a;
        }

        .alert-banner.warning {
            background: #fffbeb;
            border-color: #d97706;
        }

        .alert-banner.error {
            background: #fef2f2;
            border-color: #dc2626;
        }

        .alert-banner.info {
            background: #eff6ff;
            border-color: #2563eb;
        }

        /* ===== ANIMATIONS ===== */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(16px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-in {
            animation: fadeInUp 0.4s ease both;
        }

        .delay-1 {
            animation-delay: 0.07s;
        }

        .delay-2 {
            animation-delay: 0.14s;
        }

        .delay-3 {
            animation-delay: 0.21s;
        }

        .delay-4 {
            animation-delay: 0.28s;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1
            }

            50% {
                opacity: 0.6
            }
        }

        @keyframes spin {
            0% {
                transform: rotate(0)
            }

            100% {
                transform: rotate(360deg)
            }
        }

        /* ===== CETAK KARTU ===== */
        .kartu-status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .kartu-status-badge.locked {
            background: rgba(255, 255, 255, 0.1);
            color: rgba(255, 255, 255, 0.7);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .kartu-status-badge.open {
            background: #dcfce7;
            color: #16a34a;
            border: 1px solid #86efac;
        }

        /* ===== OFFCANVAS STYLE ===== */
        .offcanvas-header {
            background: linear-gradient(135deg, #0d9488, #0f766e);
            color: #fff;
        }

        .offcanvas-header .btn-close {
            filter: invert(1);
        }

        /* ===== HAMBURGER BUTTON (hanya mobile) ===== */
        .hamburger-btn {
            display: none;
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background: var(--body-bg);
            border: 1px solid var(--border-color);
            align-items: center;
            justify-content: center;
            font-size: 18px;
            cursor: pointer;
            color: var(--text-primary);
            transition: all 0.2s;
            flex-shrink: 0;
        }

        .hamburger-btn:hover {
            background: #ccfbf1;
            border-color: #0d9488;
            color: #0d9488;
        }

        /* ===== SIDEBAR OVERLAY (hanya mobile) ===== */
        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.45);
            z-index: 1039;
            backdrop-filter: blur(2px);
        }

        .sidebar-overlay.active {
            display: block;
        }

        /* ===== RESPONSIVE MOBILE ===== */
        @media (max-width: 768px) {

            /* --- Sidebar: overlay mode --- */
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                z-index: 1040;
                width: 260px;
            }

            .sidebar.open {
                transform: translateX(0);
                box-shadow: 6px 0 30px rgba(0, 0, 0, 0.25);
            }

            /* --- Main wrapper: full width --- */
            .main-wrapper {
                margin-left: 0 !important;
            }

            /* --- Topbar --- */
            .topbar {
                padding: 0 1rem;
                gap: 8px;
            }

            .topbar-title h1 {
                font-size: 14px;
            }

            .topbar-title span {
                font-size: 10px;
            }

            /* --- Tampilkan hamburger --- */
            .hamburger-btn {
                display: flex;
            }

            /* --- Page content: kurangi padding --- */
            .page-content {
                padding: 1rem 0.85rem;
            }

            /* --- Welcome banner --- */
            .welcome-banner {
                padding: 1.2rem 1rem !important;
            }

            /* --- Stat cards: 2 kolom di mobile --- */
            .row.g-3>[class*="col-lg-3"] {
                flex: 0 0 50%;
                max-width: 50%;
            }

            /* --- Form grid: tumpuk di mobile --- */
            .row>[class*="col-md"],
            .row>[class*="col-lg"] {
                flex: 0 0 100%;
                max-width: 100%;
            }

            /* --- Notif panel: full width di mobile --- */
            .notif-panel {
                width: calc(100vw - 24px);
                right: 12px;
                left: 12px;
            }

            /* --- Tabel scroll horizontal --- */
            .table-responsive {
                overflow-x: auto;
            }

            /* --- Card berkas/formulir dark: no horizontal overflow --- */
            .card[style*="background: linear-gradient"],
            div[style*="background: linear-gradient(135deg, #0d9488"] {
                overflow-x: hidden;
            }

            /* --- Progress step: wrap --- */
            .progress-steps {
                gap: 4px;
            }

            /* --- Jalur cards: 1 kolom --- */
            .jalur-card {
                margin-bottom: 8px;
            }

            /* --- Print area kartu ujian: full width --- */
            #printAreaKartu {
                max-width: 100% !important;
            }

            /* --- Profile info text: sembunyikan nama di HP kecil --- */
            .profile-info-text {
                display: none !important;
            }

            /* --- Topbar breadcrumb: sembunyikan di HP --- */
            .topbar-title span {
                display: none;
            }
        }

        /* ===== TABLET (768px - 1024px) ===== */
        @media (min-width: 769px) and (max-width: 1024px) {
            :root {
                --sidebar-width: 220px;
            }

            .topbar-title h1 {
                font-size: 15px;
            }

            .page-content {
                padding: 1.2rem 1.25rem;
            }
        }
    </style>
</head>

<body>

    {{-- Sidebar Overlay (mobile) --}}
    <div class="sidebar-overlay" id="sidebarOverlay" onclick="closeSidebarMobile()"></div>

    <script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.client_key') }}"></script>

    {{-- ===================== SIDEBAR ===================== --}}
    <aside class="sidebar">
        <div class="sidebar-brand">
            <div class="d-flex align-items-center gap-2 mb-1">
                <div class="brand-logo-box">
                    <img src="{{ asset('logo.png') }}" alt="Logo" style="width:100%;height:100%;object-fit:contain;">
                </div>
                <div>
                    <div class="brand-name">PPDB Al Amanah</div>
                    <div class="brand-sub">Al Amanah Al Bantani</div>
                </div>
            </div>
            <div class="tahun-badge"><i class="bi bi-calendar3" style="font-size:9px;"></i> Tahun Ajaran 2026/2027</div>
        </div>

        <nav class="sidebar-nav">
            <div class="nav-section-label">Menu Utama</div>
            <a href="#" class="sidebar-menu-item active" id="linkDashboard" onclick="switchSection('Dashboard')">
                <div class="menu-icon"><i class="bi bi-grid-1x2-fill"></i></div><span>Dashboard</span>
            </a>

            <div class="nav-section-label" style="margin-top:14px;">Pendaftaran</div>
            <a href="#" class="sidebar-menu-item" id="linkPilihJalur" onclick="switchSection('PilihJalur')">
                <div class="menu-icon"><i class="bi bi-mortarboard-fill"></i></div><span>Pilih Jalur</span>
                <span class="status-dot locked" id="dotPilihJalur"></span>
            </a>
            <a href="#" class="sidebar-menu-item" id="linkIsiFormulir" onclick="switchSection('Formulir')"
                style="margin-top:3px;">
                <div class="menu-icon"><i class="bi bi-file-earmark-text-fill"></i></div><span>Isi Formulir</span>
                <span class="status-dot locked" id="dotFormulir"></span>
            </a>
            <a href="#" class="sidebar-menu-item" id="linkUploadBerkas" onclick="switchSection('UploadBerkas')"
                style="margin-top:3px;">
                <div class="menu-icon"><i class="bi bi-folder-fill"></i></div><span>Upload Berkas</span>
                <span class="status-dot locked" id="dotBerkas"></span>
            </a>
            <a href="#" class="sidebar-menu-item" id="linkCetakKartu" onclick="switchSection('CetakKartu')"
                style="margin-top:3px;">
                <div class="menu-icon"><i class="bi bi-printer-fill"></i></div><span>Cetak Kartu Ujian</span>
                <span class="status-dot locked" id="dotCetak"></span>
            </a>

            <div class="nav-section-label" style="margin-top:14px;">Lainnya</div>
            <a href="#" class="sidebar-menu-item" id="linkPembayaran" onclick="switchSection('Pembayaran')">
                <div class="menu-icon"><i class="bi bi-credit-card-2-back-fill"></i></div><span>Pembayaran</span>
                <span class="status-dot locked" id="dotPembayaran"></span>
            </a>
            <a href="#" class="sidebar-menu-item" id="linkHasilSeleksi" onclick="switchSection('HasilSeleksi')">
                <div class="menu-icon"><i class="bi bi-megaphone-fill"></i></div><span>Hasil Seleksi</span>
            </a>
        </nav>

        <div class="sidebar-footer">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="{{ route('logout') }}" class="logout-btn"
                    onclick="event.preventDefault();this.closest('form').submit();">
                    <i class="bi bi-box-arrow-left" style="font-size:15px;"></i><span>Logout</span>
                </a>
            </form>
        </div>
    </aside>

    {{-- ===================== MAIN WRAPPER ===================== --}}
    <div class="main-wrapper">

        {{-- TOPBAR --}}
        <header class="topbar">
            {{-- Hamburger button (hanya tampil di mobile) --}}
            <button class="hamburger-btn" id="hamburgerBtn" type="button" onclick="toggleSidebarMobile()"
                aria-label="Buka Menu">
                <i class="bi bi-list"></i>
            </button>
            <div class="topbar-title">
                <h1 id="topbarTitle">Dashboard Calon Siswa</h1>
                <span>
                    <i class="bi bi-house-fill" style="font-size:10px;"></i> PPDB
                    <span class="breadcrumb-sep">/</span>
                    <span id="topbarSub">2026/2027</span>
                </span>
            </div>
            <div class="topbar-actions">
                <button class="icon-btn" type="button" id="btnNotif" title="Notifikasi" onclick="toggleNotifPanel()">
                    <i class="bi bi-bell-fill"></i>
                    <span class="notif-count-badge" id="notifCountBadge"></span>
                </button>
                <button class="profile-btn" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasDataDiri">
                    <div class="profile-avatar-top">{{ strtoupper(substr($siswa->name, 0, 2)) }}</div>
                    <div class="profile-info-text d-none d-sm-block">
                        <div class="name">{{ $siswa->name }}</div>
                        <div class="role">Akun Pendaftar <i class="bi bi-chevron-down" style="font-size:8px;"></i></div>
                    </div>
                </button>
            </div>
        </header>

        {{-- NOTIFICATION PANEL --}}
        <div class="notif-panel" id="notifPanel">
            <div class="notif-header">
                <span class="fw-bold" style="font-size:13.5px;"><i class="bi bi-bell-fill me-1 text-teal"></i>
                    Notifikasi</span>
                <button type="button" class="btn btn-sm btn-link text-secondary p-0" onclick="markAllRead()"
                    style="font-size:11px;">Tandai semua dibaca</button>
            </div>
            <div id="notifList" style="max-height:340px;overflow-y:auto;">
                <div class="text-center py-4 text-muted" style="font-size:12.5px;" id="notifEmpty">
                    <i class="bi bi-bell-slash text-muted mb-2" style="font-size:24px;display:block;"></i>
                    Belum ada notifikasi
                </div>
            </div>
        </div>

        {{-- PAGE CONTENT --}}
        <main class="page-content">

            {{-- ============ SECTION: DASHBOARD ============ --}}
            <div id="sectionDashboard" class="dashboard-section active">
                <div class="welcome-banner animate-in">
                    <div class="welcome-greeting"><i class="bi bi-emoji-smile-fill me-1 text-warning"></i> Selamat
                        Datang Kembali</div>
                    <div class="welcome-name">{{ $siswa->name }}</div>
                    <div class="welcome-sub">Lengkapi seluruh tahapan pendaftaran untuk menyelesaikan administrasi PPDB
                        SMP Al-Amanah. Pantau status real-time di bawah ini.</div>
                    <a href="#" class="welcome-action-btn" onclick="switchSection('PilihJalur')">
                        <i class="bi bi-play-fill" style="font-size:11px;"></i> Mulai Proses Pendaftaran
                    </a>
                </div>

                {{-- Notification banners from admin --}}
                <div id="adminNotifBanners" class="mb-3"></div>

                {{-- Stat Cards --}}
                <div class="row g-3 mb-4">
                    <div class="col-sm-6 col-lg-3">
                        <div class="stat-card animate-in delay-1">
                            <div class="stat-icon blue" style="display:flex;align-items:center;justify-content:center;">
                                <i class="bi bi-bar-chart-line-fill text-primary" style="font-size:18px;"></i>
                            </div>
                            <div class="stat-label">Progres Pendaftaran</div>
                            <div class="stat-value" id="statProgres">0%</div>
                            <div class="stat-hint" id="statProgresHint">Belum dimulai</div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="stat-card animate-in delay-2">
                            <div class="stat-icon green"
                                style="display:flex;align-items:center;justify-content:center;"><i
                                    class="bi bi-compass-fill text-success" style="font-size:18px;"></i></div>
                            <div class="stat-label">Jalur Pendaftaran</div>
                            <div class="stat-value" id="statJalur" style="font-size:16px;">-</div>
                            <div class="stat-hint" id="statJalurHint">Belum dipilih</div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="stat-card animate-in delay-3">
                            <div class="stat-icon yellow"
                                style="display:flex;align-items:center;justify-content:center;"><i
                                    class="bi bi-file-earmark-text-fill text-warning" style="font-size:18px;"></i></div>
                            <div class="stat-label">Status Formulir</div>
                            <div class="stat-value" id="statFormulir" style="font-size:15px;">Belum</div>
                            <div class="stat-hint" id="statFormulirHint">Segera isi formulir</div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="stat-card animate-in delay-4">
                            <div class="stat-icon purple"
                                style="display:flex;align-items:center;justify-content:center;"><i
                                    class="bi bi-folder-fill text-info" style="font-size:18px;"></i></div>
                            <div class="stat-label">Status Berkas</div>
                            <div class="stat-value" id="statBerkas" style="font-size:15px;">Belum</div>
                            <div class="stat-hint" id="statBerkasHint">Belum ada berkas</div>
                        </div>
                    </div>
                </div>

                <div class="row g-3">
                    {{-- Progress Steps --}}
                    <div class="col-lg-7 animate-in delay-2">
                        <div class="section-title">
                            <div class="icon"><i class="bi bi-pin-angle-fill text-teal"></i></div> Tahapan Pendaftaran
                        </div>
                        <div class="progress-card">
                            <div class="progress-step" onclick="switchSection('PilihJalur')">
                                <div class="step-number done"><i class="bi bi-check-lg"></i></div>
                                <div class="step-info">
                                    <div class="step-name">Registrasi Akun</div>
                                    <div class="step-desc">Akun pendaftar berhasil dibuat</div>
                                </div>
                                <span class="step-status done">Selesai</span>
                            </div>
                            <div class="progress-step" id="stepJalurRow" onclick="switchSection('PilihJalur')">
                                <div class="step-number active" id="stepJalurNum">1</div>
                                <div class="step-info">
                                    <div class="step-name">Pilih Jalur Pendaftaran</div>
                                    <div class="step-desc" id="stepJalurDesc">Reguler / Prestasi / Tahfidz</div>
                                </div>
                                <span class="step-status active" id="stepJalurStatus">Pilih Jalur</span>
                            </div>
                            <div class="progress-step" id="stepFormulirRow" onclick="switchSection('Formulir')">
                                <div class="step-number pending" id="stepFormulirNum">2</div>
                                <div class="step-info">
                                    <div class="step-name">Isi Formulir Pendaftaran</div>
                                    <div class="step-desc" id="stepFormulirDesc">Data diri, sekolah asal, orang tua
                                    </div>
                                </div>
                                <span class="step-status pending" id="stepFormulirStatus">Menunggu</span>
                            </div>
                            <div class="progress-step" id="stepBerkasRow" onclick="switchSection('UploadBerkas')">
                                <div class="step-number locked" id="stepBerkasNum">3</div>
                                <div class="step-info">
                                    <div class="step-name">Upload Berkas Persyaratan</div>
                                    <div class="step-desc" id="stepBerkasDesc">KK, Akta, Rapor, Foto, dll</div>
                                </div>
                                <span class="step-status locked" id="stepBerkasStatus">Terkunci</span>
                            </div>
                            <div class="progress-step" id="stepCetakRow" onclick="switchSection('CetakKartu')">
                                <div class="step-number locked" id="stepCetakNum">4</div>
                                <div class="step-info">
                                    <div class="step-name">Cetak Kartu Ujian</div>
                                    <div class="step-desc" id="stepCetakDesc">Terbuka setelah formulir & berkas
                                        disetujui</div>
                                </div>
                                <span class="step-status locked" id="stepCetakStatus">Terkunci</span>
                            </div>
                        </div>
                    </div>

                    {{-- Info Akun --}}
                    <div class="col-lg-5 animate-in delay-3">
                        <div class="section-title">
                            <div class="icon"><i class="bi bi-person-fill text-teal"></i></div> Informasi Akun
                        </div>
                        <div class="info-card">
                            <div class="info-row">
                                <span class="info-key">Nama Lengkap</span>
                                <span class="info-val">{{ $siswa->name }}</span>
                            </div>
                            <div class="info-row">
                                <span class="info-key">Email</span>
                                <span class="info-val" style="font-size:11px;">{{ $siswa->email }}</span>
                            </div>
                            <div class="info-row">
                                <span class="info-key">Jalur Dipilih</span>
                                <span class="info-val" id="infoJalurSelected">-</span>
                            </div>
                            <div class="info-row">
                                <span class="info-key">Status Formulir</span>
                                <span class="info-val" id="infoStatusFormulir" style="color:#b45309;">Belum Diisi</span>
                            </div>
                            <div class="info-row">
                                <span class="info-key">Status Berkas</span>
                                <span class="info-val" id="infoStatusBerkas" style="color:#b45309;">Belum Upload</span>
                            </div>
                            <div class="info-row" style="border-bottom:none;">
                                <span class="info-key">Tahun Ajaran</span>
                                <span class="info-val">2026/2027</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Notice --}}
                <div class="notice-box mt-4 animate-in delay-4">
                    <div class="notice-icon"><i class="bi bi-exclamation-triangle-fill text-warning"
                            style="font-size:18px;"></i></div>
                    <div>
                        <div class="notice-title">Batas Waktu Pendaftaran</div>
                        <div class="notice-text">Batas waktu pengisian formulir adalah <strong>30 Juni 2026</strong>.
                            Pastikan seluruh berkas persyaratan diunggah tepat waktu dan sesuai ketentuan jalur yang
                            dipilih.</div>
                    </div>
                </div>
            </div>

            {{-- ============ SECTION: PILIH JALUR ============ --}}
            <div id="sectionPilihJalur" class="dashboard-section">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h2 class="fw-bold text-dark m-0" style="font-size:20px;">Pilih Jalur Pendaftaran</h2>
                    <span class="badge px-3 py-2 fw-semibold"
                        style="font-size:11px;border-radius:20px;background:#e2fbf5;color:#0d9488;border:1px solid rgba(13,148,136,0.15);">Langkah
                        1 dari 4</span>
                </div>
                <div class="dark-card animate-in">
                    <h4 class="text-white mb-1" style="font-size:16px;font-weight:700;">Tentukan Jalur Masuk Anda</h4>
                    <p class="text-white-50 mb-4" style="font-size:12px;line-height:1.6;">Setiap jalur memiliki
                        persyaratan formulir dan berkas yang berbeda. Baca ketentuan masing-masing sebelum memilih.
                        Setelah dipilih, jalur dapat diubah selama formulir belum dikirim.</p>

                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <div class="jalur-card" id="cardJalurReguler" onclick="selectJalur('Reguler')">
                                <span class="jalur-icon"><i class="bi bi-book-half"></i></span>
                                <div class="jalur-title">Jalur Reguler</div>
                                <div class="jalur-desc">Seleksi umum berdasarkan nilai rapor kelas 4–6. Terbuka untuk
                                    semua calon siswa.</div>
                                <div class="mt-2" style="font-size:10.5px;color:rgba(255,255,255,0.6);">Berkas: KK •
                                    Akta • Rapor • Foto</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="jalur-card" id="cardJalurPrestasi" onclick="selectJalur('Prestasi')">
                                <span class="jalur-icon"><i class="bi bi-trophy-fill text-warning"></i></span>
                                <div class="jalur-title">Jalur Prestasi</div>
                                <div class="jalur-desc">Untuk calon siswa berprestasi di bidang akademik atau
                                    non-akademik (lomba, kejuaraan, dll).</div>
                                <div class="mt-2" style="font-size:10.5px;color:rgba(255,255,255,0.6);">Berkas: KK •
                                    Akta • Rapor • Foto • Sertifikat</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="jalur-card" id="cardJalurTahfidz" onclick="selectJalur('Tahfidz')">
                                <span class="jalur-icon"><i class="bi bi-book-fill text-info"></i></span>
                                <div class="jalur-title">Jalur Tahfidz</div>
                                <div class="jalur-desc">Untuk calon siswa penghafal Al-Qur'an atau berafiliasi dengan
                                    Pondok Pesantren.</div>
                                <div class="mt-2" style="font-size:10.5px;color:rgba(255,255,255,0.6);">Berkas: KK •
                                    Akta • Rapor • Foto • Surat Keterangan</div>
                            </div>
                        </div>
                    </div>

                    <div id="selectedJalurInfo" class="d-none mb-3 p-3 rounded-3"
                        style="background:rgba(255,255,255,0.1);border:1px solid rgba(255,255,255,0.2);">
                        <div class="d-flex align-items-center gap-2">
                            <span id="selectedJalurEmoji" style="font-size:18px;"></span>
                            <div>
                                <div class="text-white fw-bold" style="font-size:13.5px;" id="selectedJalurTitle">Jalur
                                    Terpilih</div>
                                <div class="text-white-50" style="font-size:11.5px;" id="selectedJalurSubtitle">Klik
                                    tombol konfirmasi untuk melanjutkan ke formulir.</div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button class="btn btn-success px-4 py-2 fw-bold d-none" id="btnKonfirmasiJalur"
                            onclick="konfirmasiJalur()"
                            style="border-radius:20px;font-size:13px;border:none;background:linear-gradient(135deg,#10b981,#059669);">
                            <i class="bi bi-check-circle me-1"></i> Konfirmasi &amp; Lanjut ke Formulir
                        </button>
                    </div>
                </div>

                {{-- Perbandingan Jalur --}}
                <div class="card mt-4 shadow-sm animate-in delay-2"
                    style="border-radius:14px;border:1px solid var(--border-color);">
                    <div class="card-header bg-white border-bottom py-3 px-4" style="border-radius:14px 14px 0 0;">
                        <h6 class="fw-bold m-0" style="font-size:13.5px;"><i
                                class="bi bi-bar-chart-line-fill me-1 text-teal"></i> Perbandingan Persyaratan Setiap
                            Jalur</h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-sm m-0" style="font-size:12px;">
                            <thead style="background:#f8fafc;">
                                <tr>
                                    <th class="px-4 py-3">Persyaratan</th>
                                    <th class="text-center py-3"><i class="bi bi-book-half me-1"></i> Reguler</th>
                                    <th class="text-center py-3"><i class="bi bi-trophy-fill me-1 text-warning"></i>
                                        Prestasi</th>
                                    <th class="text-center py-3"><i class="bi bi-book-fill me-1 text-info"></i> Tahfidz
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="px-4 py-2">Data Diri & Orang Tua</td>
                                    <td class="text-center"><i class="bi bi-check-circle-fill text-success"
                                            style="font-size: 13px;"></i></td>
                                    <td class="text-center"><i class="bi bi-check-circle-fill text-success"
                                            style="font-size: 13px;"></i></td>
                                    <td class="text-center"><i class="bi bi-check-circle-fill text-success"
                                            style="font-size: 13px;"></i></td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-2">Scan KK & Akta Lahir</td>
                                    <td class="text-center"><i class="bi bi-check-circle-fill text-success"
                                            style="font-size: 13px;"></i></td>
                                    <td class="text-center"><i class="bi bi-check-circle-fill text-success"
                                            style="font-size: 13px;"></i></td>
                                    <td class="text-center"><i class="bi bi-check-circle-fill text-success"
                                            style="font-size: 13px;"></i></td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-2">Rapor Kelas 4–6</td>
                                    <td class="text-center"><i class="bi bi-check-circle-fill text-success"
                                            style="font-size: 13px;"></i></td>
                                    <td class="text-center"><i class="bi bi-check-circle-fill text-success"
                                            style="font-size: 13px;"></i></td>
                                    <td class="text-center"><i class="bi bi-check-circle-fill text-success"
                                            style="font-size: 13px;"></i></td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-2">Pas Foto 3x4</td>
                                    <td class="text-center"><i class="bi bi-check-circle-fill text-success"
                                            style="font-size: 13px;"></i></td>
                                    <td class="text-center"><i class="bi bi-check-circle-fill text-success"
                                            style="font-size: 13px;"></i></td>
                                    <td class="text-center"><i class="bi bi-check-circle-fill text-success"
                                            style="font-size: 13px;"></i></td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-2">Data Prestasi (Lomba/Kejuaraan)</td>
                                    <td class="text-center text-muted">—</td>
                                    <td class="text-center"><i class="bi bi-check-circle-fill text-success"
                                            style="font-size: 13px;"></i></td>
                                    <td class="text-center text-muted">—</td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-2">Sertifikat / Piagam Prestasi</td>
                                    <td class="text-center text-muted">—</td>
                                    <td class="text-center"><i class="bi bi-check-circle-fill text-success"
                                            style="font-size: 13px;"></i></td>
                                    <td class="text-center text-muted">—</td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-2">Jumlah Hafalan (Juz)</td>
                                    <td class="text-center text-muted">—</td>
                                    <td class="text-center text-muted">—</td>
                                    <td class="text-center"><i class="bi bi-check-circle-fill text-success"
                                            style="font-size: 13px;"></i></td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-2">Surat Keterangan Hafalan</td>
                                    <td class="text-center text-muted">—</td>
                                    <td class="text-center text-muted">—</td>
                                    <td class="text-center"><i class="bi bi-check-circle-fill text-success"
                                            style="font-size: 13px;"></i></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- ============ SECTION: FORMULIR ============ --}}
            <div id="sectionFormulir" class="dashboard-section">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h2 class="fw-bold text-dark m-0" style="font-size:20px;">Isi Formulir Pendaftaran</h2>
                    <span class="badge px-3 py-2 fw-semibold" id="formStepLabel"
                        style="font-size:11px;border-radius:20px;background:#e2fbf5;color:#0d9488;border:1px solid rgba(13,148,136,0.15);">Langkah
                        2 dari 4</span>
                </div>

                {{-- Admin rejection banner --}}
                <div id="formRejectionBanner" class="d-none mb-3">
                    <div class="alert-banner error">
                        <span style="font-size:20px;"><i class="bi bi-x-circle-fill text-danger"></i></span>
                        <div>
                            <div class="fw-bold text-danger" style="font-size:13.5px;">Formulir Perlu Diperbaiki</div>
                            <div style="font-size:12px;color:#7f1d1d;margin-top:3px;" id="formRejectionNote">Admin
                                memberikan catatan pada formulir Anda. Perbaiki dan kirim ulang.</div>
                        </div>
                    </div>
                </div>

                <div class="dark-card animate-in" id="formPendaftaranContainer">
                    {{-- Step Indicator --}}
                    <div class="d-flex gap-2 mb-4 flex-wrap" id="formStepIndicator">
                        <div class="d-flex align-items-center gap-2 flex-wrap">
                            <span class="badge px-3 py-2 fw-bold" id="stepInd1"
                                style="border-radius:20px;background:rgba(255,255,255,0.9);color:#0f766e;font-size:11px;">1
                                Data Diri</span>
                            <i class="bi bi-chevron-right text-white-50" style="font-size:11px;"></i>
                            <span class="badge px-3 py-2 fw-bold" id="stepInd2"
                                style="border-radius:20px;background:rgba(255,255,255,0.15);color:rgba(255,255,255,0.6);font-size:11px;">2
                                Sekolah & Ortu</span>
                            <i class="bi bi-chevron-right text-white-50" style="font-size:11px;"></i>
                            <span class="badge px-3 py-2 fw-bold" id="stepInd3"
                                style="border-radius:20px;background:rgba(255,255,255,0.15);color:rgba(255,255,255,0.6);font-size:11px;"
                                id="stepInd3">3 Data Khusus</span>
                        </div>
                    </div>

                    <form id="formPendaftaranPPDB" onsubmit="return false;" novalidate>

                        {{-- === STEP 1: Biodata === --}}
                        <div id="formStep1" class="form-step">
                            <h4 class="text-white mb-3"
                                style="font-size:15px;font-weight:700;border-bottom:1px solid rgba(255,255,255,0.1);padding-bottom:10px;">
                                <i class="bi bi-person-fill me-2"></i>Langkah 1: Biodata Calon Siswa
                            </h4>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">NIK (Lihat di kartu keluarga) <span
                                            class="text-warning">*</span></label>
                                    <input type="text" id="inputNIK" class="form-control" placeholder="16 digit NIK"
                                        maxlength="16" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">NISN <span class="text-warning">*</span></label>
                                    <input type="text" id="inputNISN" class="form-control" placeholder="10 digit NISN"
                                        maxlength="10" required>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Nama Lengkap <span class="text-warning">*</span></label>
                                    <input type="text" id="inputNama" class="form-control"
                                        placeholder="Tulis nama lengkap" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Jenis Kelamin <span class="text-warning">*</span></label>
                                    <select id="inputGender" class="form-select" required>
                                        <option value="">-- Pilih --</option>
                                        <option value="Laki-laki">Laki-Laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Tinggi Badan (Cm) <span
                                            class="text-warning">*</span></label>
                                    <input type="number" id="inputTinggiBadan" class="form-control" placeholder="Cm"
                                        required>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Gol Darah</label>
                                    <input type="text" id="inputGolDarah" class="form-control" placeholder="A/B/AB/O">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Tempat Lahir <span class="text-warning">*</span></label>
                                    <input type="text" id="inputTempatLahir" class="form-control"
                                        placeholder="Kota/Kabupaten" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Tanggal Lahir <span class="text-warning">*</span></label>
                                    <input type="date" id="inputTanggalLahir" class="form-control" required>
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">Agama <span class="text-warning">*</span></label>
                                    <select id="inputAgama" class="form-select" required>
                                        <option value="">-- Pilih --</option>
                                        <option value="Islam">Islam</option>
                                        <option value="Kristen">Kristen</option>
                                        <option value="Katolik">Katolik</option>
                                        <option value="Hindu">Hindu</option>
                                        <option value="Buddha">Buddha</option>
                                        <option value="Konghucu">Konghucu</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Anak Ke <span class="text-warning">*</span></label>
                                    <input type="number" id="inputAnakKe" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Jumlah Saudara <span class="text-warning">*</span></label>
                                    <input type="number" id="inputJumlahSaudara" class="form-control" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Saudara Laki-Laki (Orang)</label>
                                    <input type="number" id="inputSaudaraLaki" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Saudara Perempuan (Orang)</label>
                                    <input type="number" id="inputSaudaraPerempuan" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Yang Sudah Berkeluarga (Orang)</label>
                                    <input type="number" id="inputSaudaraMenikah" class="form-control">
                                </div>
                            </div>
                            <div class="d-flex justify-content-end mt-4">
                                <button type="button" class="btn btn-light px-4 py-2 fw-bold" onclick="nextFormStep(2)"
                                    style="border-radius:20px;font-size:13px;color:#0f766e;">
                                    Lanjut ke Langkah 2 <i class="bi bi-arrow-right ms-1"></i>
                                </button>
                            </div>
                        </div>

                        {{-- === STEP 2: Alamat & Sekolah Asal === --}}
                        <div id="formStep2" class="form-step d-none">
                            <h4 class="text-white mb-3"
                                style="font-size:15px;font-weight:700;border-bottom:1px solid rgba(255,255,255,0.1);padding-bottom:10px;">
                                <i class="bi bi-geo-alt-fill me-2"></i>Langkah 2: Alamat &amp; Pendidikan
                            </h4>
                            <h6 class="text-white mb-3" style="font-size:12.5px;opacity:0.85;">Alamat Lengkap</h6>
                            <div class="row g-3 mb-3">
                                <div class="col-12">
                                    <label class="form-label">Jl. (Alamat Lengkap) <span
                                            class="text-warning">*</span></label>
                                    <input type="text" id="inputAlamatJalan" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">RT/RW/No. Rumah <span
                                            class="text-warning">*</span></label>
                                    <input type="text" id="inputAlamatRTRW" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Desa / Kelurahan <span
                                            class="text-warning">*</span></label>
                                    <input type="text" id="inputAlamatDesa" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Kecamatan <span class="text-warning">*</span></label>
                                    <input type="text" id="inputAlamatKecamatan" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Kabupaten / Kota <span
                                            class="text-warning">*</span></label>
                                    <input type="text" id="inputAlamatKabupaten" class="form-control" required>
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">No. HP. Siswa</label>
                                    <input type="tel" id="inputNoHpSiswa" class="form-control">
                                </div>
                            </div>
                            <hr style="border-color:rgba(255,255,255,0.15);margin:16px 0;">
                            <h6 class="text-white mb-3" style="font-size:12.5px;opacity:0.85;">Pendidikan</h6>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Sekolah Asal <span class="text-warning">*</span></label>
                                    <input type="text" id="inputAsalSekolah" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Alamat Sekolah <span class="text-warning">*</span></label>
                                    <input type="text" id="inputAlamatSekolah" class="form-control" required>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between mt-4">
                                <button type="button" class="btn btn-outline-light px-4 py-2 fw-bold"
                                    onclick="prevFormStep(1)" style="border-radius:20px;font-size:13px;">
                                    <i class="bi bi-arrow-left me-1"></i> Kembali
                                </button>
                                <button type="button" class="btn btn-light px-4 py-2 fw-bold" onclick="nextFormStep(3)"
                                    style="border-radius:20px;font-size:13px;color:#0f766e;">
                                    Lanjut ke Langkah 3 <i class="bi bi-arrow-right ms-1"></i>
                                </button>
                            </div>
                        </div>

                        {{-- === STEP 3: Data Orang Tua & Wali === --}}
                        <div id="formStep3" class="form-step d-none">
                            <h4 class="text-white mb-3"
                                style="font-size:15px;font-weight:700;border-bottom:1px solid rgba(255,255,255,0.1);padding-bottom:10px;"
                                id="step3Title">
                                <i class="bi bi-people-fill me-2"></i>Langkah 3: Data Orang Tua & Wali
                            </h4>

                            <div class="row g-3">
                                <h6 class="text-white mt-3 mb-1" style="font-size:12.5px;opacity:0.85;">Data Ayah</h6>
                                <div class="col-md-6">
                                    <label class="form-label">Nama Ayah <span class="text-warning">*</span></label>
                                    <input type="text" id="inputNamaAyah" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Status Ayah</label>
                                    <select id="inputStatusAyah" class="form-select">
                                        <option value="">-- Pilih --</option>
                                        <option value="Masih Hidup">Masih Hidup</option>
                                        <option value="Sudah Meninggal">Sudah Meninggal</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Pendidikan Ayah <span
                                            class="text-warning">*</span></label>
                                    <select id="inputPendidikanAyah" class="form-select" required>
                                        <option value="">-- Pilih --</option>
                                        <option value="1. SD">1. SD</option>
                                        <option value="2. SMP">2. SMP</option>
                                        <option value="3. SMA/SMK">3. SMA/SMK</option>
                                        <option value="4. D1">4. D1</option>
                                        <option value="5. D2">5. D2</option>
                                        <option value="6. D3">6. D3</option>
                                        <option value="7. S1">7. S1</option>
                                        <option value="8. S2">8. S2</option>
                                        <option value="9. S3">9. S3</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Pekerjaan Ayah <span class="text-warning">*</span></label>
                                    <input type="text" id="inputPekerjaanAyah" class="form-control" required>
                                </div>

                                <h6 class="text-white mt-4 mb-1" style="font-size:12.5px;opacity:0.85;">Data Ibu</h6>
                                <div class="col-md-6">
                                    <label class="form-label">Nama Ibu <span class="text-warning">*</span></label>
                                    <input type="text" id="inputNamaIbu" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Status Ibu</label>
                                    <select id="inputStatusIbu" class="form-select">
                                        <option value="">-- Pilih --</option>
                                        <option value="Masih Hidup">Masih Hidup</option>
                                        <option value="Sudah Meninggal">Sudah Meninggal</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Pendidikan Ibu <span class="text-warning">*</span></label>
                                    <select id="inputPendidikanIbu" class="form-select" required>
                                        <option value="">-- Pilih --</option>
                                        <option value="1. SD">1. SD</option>
                                        <option value="2. SMP">2. SMP</option>
                                        <option value="3. SMA/SMK">3. SMA/SMK</option>
                                        <option value="4. D1">4. D1</option>
                                        <option value="5. D2">5. D2</option>
                                        <option value="6. D3">6. D3</option>
                                        <option value="7. S1">7. S1</option>
                                        <option value="8. S2">8. S2</option>
                                        <option value="9. S3">9. S3</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Pekerjaan Ibu <span class="text-warning">*</span></label>
                                    <input type="text" id="inputPekerjaanIbu" class="form-control" required>
                                </div>

                                <h6 class="text-white mt-4 mb-1" style="font-size:12.5px;opacity:0.85;">Alamat Orang Tua
                                </h6>
                                <div class="col-md-8">
                                    <label class="form-label">Alamat Orang Tua <span
                                            class="text-warning">*</span></label>
                                    <input type="text" id="inputAlamatOrtu" class="form-control" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">No. Telepon / HP <span
                                            class="text-warning">*</span></label>
                                    <input type="tel" id="inputNoHpOrtu" class="form-control" required>
                                </div>

                                <h6 class="text-white mt-4 mb-1" style="font-size:12.5px;opacity:0.85;">Data Wali
                                    (Opsional)</h6>
                                <div class="col-md-12">
                                    <label class="form-label">Nama Wali</label>
                                    <input type="text" id="inputNamaWali" class="form-control">
                                </div>
                                <div class="col-md-8">
                                    <label class="form-label">Alamat Wali</label>
                                    <input type="text" id="inputAlamatWali" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">No. Telepon / HP Wali</label>
                                    <input type="tel" id="inputNoHpWali" class="form-control">
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">Pekerjaan Wali</label>
                                    <input type="text" id="inputPekerjaanWali" class="form-control">
                                </div>
                            </div>

                            <div class="d-flex justify-content-between mt-4">
                                <button type="button" class="btn btn-outline-light px-4 py-2 fw-bold"
                                    onclick="prevFormStep(2)" style="border-radius:20px;font-size:13px;">
                                    <i class="bi bi-arrow-left me-1"></i> Kembali
                                </button>
                                <button type="button" class="btn btn-warning px-5 py-2 fw-bold"
                                    onclick="submitFormulir()" id="btnSubmitFormulir"
                                    style="border-radius:20px;font-size:13px;color:#1a1a1a;border:none;">
                                    <i class="bi bi-send-fill me-1"></i> Kirim Formulir Pendaftaran
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            {{-- ============ SECTION: UPLOAD BERKAS ============ --}}
            <div id="sectionUploadBerkas" class="dashboard-section">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h2 class="fw-bold text-dark m-0" style="font-size:20px;">Upload Berkas Persyaratan</h2>
                    <span class="badge px-3 py-2 fw-semibold"
                        style="font-size:11px;border-radius:20px;background:#e2fbf5;color:#0d9488;border:1px solid rgba(13,148,136,0.15);">Langkah
                        3 dari 4</span>
                </div>

                {{-- Admin rejection banner berkas --}}
                <div id="berkasRejectionBanner" class="d-none mb-3">
                    <div class="alert-banner error">
                        <span style="font-size:20px;"><i class="bi bi-x-circle-fill text-danger"></i></span>
                        <div>
                            <div class="fw-bold text-danger" style="font-size:13.5px;">Berkas Perlu Diperbaiki</div>
                            <div style="font-size:12px;color:#7f1d1d;margin-top:3px;" id="berkasRejectionNote">Admin
                                memberikan catatan pada berkas Anda. Perbaiki dan kirim ulang.</div>
                        </div>
                    </div>
                </div>

                <div class="dark-card animate-in">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div>
                            <h4 class="text-white mb-1" style="font-size:15px;font-weight:700;">Unggah Dokumen
                                Persyaratan</h4>
                            <p class="text-white-50 m-0" style="font-size:11.5px;">Jalur: <strong class="text-warning"
                                    id="jalurBerkasLabel">-</strong> — Pastikan semua berkas wajib diunggah sebelum
                                mengirim.</p>
                        </div>
                        <span id="berkasCountBadge" class="badge px-3 py-1 fw-bold"
                            style="font-size:11px;border-radius:20px;background:rgba(255,255,255,0.15);color:#fff;">0/0
                            Berkas</span>
                    </div>

                    {{-- Berkas Umum (semua jalur) --}}
                    <div class="mb-2"
                        style="font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:0.8px;color:rgba(255,255,255,0.55);">
                        <i class="bi bi-clipboard-check-fill me-1"></i> Berkas Wajib (Semua Jalur)
                    </div>

                    <div class="berkas-item" id="itemBerkasKK">
                        <div>
                            <div class="text-white fw-semibold" style="font-size:13px;">1. Scan Kartu Keluarga (KK)
                                <span class="text-warning">*</span>
                            </div>
                            <div class="text-white-50" style="font-size:11px;" id="statusKKText">Format: PDF/JPG — Belum
                                diunggah</div>
                        </div>
                        <div class="d-flex gap-2 align-items-center">
                            <input type="file" id="fileKK" accept=".pdf,.jpg,.jpeg,.png" class="d-none"
                                onchange="handleBerkasUpload(this,'KK')">
                            <button class="btn btn-outline-light btn-sm px-3 py-1 d-none" id="btnPreviewKK"
                                onclick="previewBerkas('KK')"
                                style="border-radius:20px;font-size:11.5px;font-weight:500;background:rgba(255,255,255,0.1);">
                                <i class="bi bi-eye me-1"></i>Preview
                            </button>
                            <button class="btn btn-outline-light btn-sm px-3 py-1" id="btnUploadKK"
                                onclick="document.getElementById('fileKK').click()"
                                style="border-radius:20px;font-size:11.5px;font-weight:500;">
                                <i class="bi bi-upload me-1"></i>Pilih Berkas
                            </button>
                        </div>
                    </div>

                    <div class="berkas-item" id="itemBerkasAkta">
                        <div>
                            <div class="text-white fw-semibold" style="font-size:13px;">2. Scan Akta Kelahiran <span
                                    class="text-warning">*</span></div>
                            <div class="text-white-50" style="font-size:11px;" id="statusAktaText">Format: PDF/JPG —
                                Belum diunggah</div>
                        </div>
                        <div class="d-flex gap-2 align-items-center">
                            <input type="file" id="fileAkta" accept=".pdf,.jpg,.jpeg,.png" class="d-none"
                                onchange="handleBerkasUpload(this,'Akta')">
                            <button class="btn btn-outline-light btn-sm px-3 py-1 d-none" id="btnPreviewAkta"
                                onclick="previewBerkas('Akta')"
                                style="border-radius:20px;font-size:11.5px;font-weight:500;background:rgba(255,255,255,0.1);">
                                <i class="bi bi-eye me-1"></i>Preview
                            </button>
                            <button class="btn btn-outline-light btn-sm px-3 py-1" id="btnUploadAkta"
                                onclick="document.getElementById('fileAkta').click()"
                                style="border-radius:20px;font-size:11.5px;font-weight:500;">
                                <i class="bi bi-upload me-1"></i>Pilih Berkas
                            </button>
                        </div>
                    </div>

                    <div class="berkas-item" id="itemBerkasRapor">
                        <div>
                            <div class="text-white fw-semibold" style="font-size:13px;">3. Scan Rapor Kelas 4–6 / SKL
                                <span class="text-warning">*</span>
                            </div>
                            <div class="text-white-50" style="font-size:11px;" id="statusRaporText">Format: PDF/JPG —
                                Belum diunggah</div>
                        </div>
                        <div class="d-flex gap-2 align-items-center">
                            <input type="file" id="fileRapor" accept=".pdf,.jpg,.jpeg,.png" class="d-none"
                                onchange="handleBerkasUpload(this,'Rapor')">
                            <button class="btn btn-outline-light btn-sm px-3 py-1 d-none" id="btnPreviewRapor"
                                onclick="previewBerkas('Rapor')"
                                style="border-radius:20px;font-size:11.5px;font-weight:500;background:rgba(255,255,255,0.1);">
                                <i class="bi bi-eye me-1"></i>Preview
                            </button>
                            <button class="btn btn-outline-light btn-sm px-3 py-1" id="btnUploadRapor"
                                onclick="document.getElementById('fileRapor').click()"
                                style="border-radius:20px;font-size:11.5px;font-weight:500;">
                                <i class="bi bi-upload me-1"></i>Pilih Berkas
                            </button>
                        </div>
                    </div>

                    <div class="berkas-item" id="itemBerkasFoto">
                        <div>
                            <div class="text-white fw-semibold" style="font-size:13px;">4. Pas Foto 3×4 (Latar
                                Merah/Biru) <span class="text-warning">*</span></div>
                            <div class="text-white-50" style="font-size:11px;" id="statusFotoText">Format: JPG/PNG —
                                Belum diunggah</div>
                        </div>
                        <div class="d-flex gap-2 align-items-center">
                            <input type="file" id="fileFoto" accept=".jpg,.jpeg,.png" class="d-none"
                                onchange="handleBerkasUpload(this,'Foto')">
                            <button class="btn btn-outline-light btn-sm px-3 py-1 d-none" id="btnPreviewFoto"
                                onclick="previewBerkas('Foto')"
                                style="border-radius:20px;font-size:11.5px;font-weight:500;background:rgba(255,255,255,0.1);">
                                <i class="bi bi-eye me-1"></i>Preview
                            </button>
                            <button class="btn btn-outline-light btn-sm px-3 py-1" id="btnUploadFoto"
                                onclick="document.getElementById('fileFoto').click()"
                                style="border-radius:20px;font-size:11.5px;font-weight:500;">
                                <i class="bi bi-upload me-1"></i>Pilih Berkas
                            </button>
                        </div>
                    </div>

                    {{-- Berkas Khusus Prestasi --}}
                    <div id="berkasKhususPrestasi" class="d-none">
                        <div class="my-2"
                            style="font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:0.8px;color:rgba(255,255,255,0.55);">
                            <i class="bi bi-trophy-fill me-1 text-warning"></i> Berkas Khusus Jalur Prestasi
                        </div>

                        <div class="berkas-item" id="itemBerkasSertifikat">
                            <div>
                                <div class="text-white fw-semibold" style="font-size:13px;">5. Sertifikat / Piagam
                                    Prestasi <span class="text-warning">*</span></div>
                                <div class="text-white-50" style="font-size:11px;" id="statusSertifikatText">Format:
                                    PDF/JPG — Belum diunggah</div>
                            </div>
                            <div class="d-flex gap-2 align-items-center">
                                <input type="file" id="fileSertifikat" accept=".pdf,.jpg,.jpeg,.png" class="d-none"
                                    onchange="handleBerkasUpload(this,'Sertifikat')">
                                <button class="btn btn-outline-light btn-sm px-3 py-1 d-none" id="btnPreviewSertifikat"
                                    onclick="previewBerkas('Sertifikat')"
                                    style="border-radius:20px;font-size:11.5px;font-weight:500;background:rgba(255,255,255,0.1);">
                                    <i class="bi bi-eye me-1"></i>Preview
                                </button>
                                <button class="btn btn-outline-light btn-sm px-3 py-1" id="btnUploadSertifikat"
                                    onclick="document.getElementById('fileSertifikat').click()"
                                    style="border-radius:20px;font-size:11.5px;font-weight:500;">
                                    <i class="bi bi-upload me-1"></i>Pilih Berkas
                                </button>
                            </div>
                        </div>

                        <div class="berkas-item" id="itemBerkasRekomen">
                            <div>
                                <div class="text-white fw-semibold" style="font-size:13px;">6. Surat Rekomendasi Kepala
                                    Sekolah <span class="badge ms-1"
                                        style="background:rgba(255,255,255,0.15);font-size:9px;">Opsional</span></div>
                                <div class="text-white-50" style="font-size:11px;" id="statusRekomenText">Format:
                                    PDF/JPG — Opsional</div>
                            </div>
                            <div class="d-flex gap-2 align-items-center">
                                <input type="file" id="fileRekomen" accept=".pdf,.jpg,.jpeg,.png" class="d-none"
                                    onchange="handleBerkasUpload(this,'Rekomen')">
                                <button class="btn btn-outline-light btn-sm px-3 py-1 d-none" id="btnPreviewRekomen"
                                    onclick="previewBerkas('Rekomen')"
                                    style="border-radius:20px;font-size:11.5px;font-weight:500;background:rgba(255,255,255,0.1);">
                                    <i class="bi bi-eye me-1"></i>Preview
                                </button>
                                <button class="btn btn-outline-light btn-sm px-3 py-1" id="btnUploadRekomen"
                                    onclick="document.getElementById('fileRekomen').click()"
                                    style="border-radius:20px;font-size:11.5px;font-weight:500;">
                                    <i class="bi bi-upload me-1"></i>Pilih Berkas
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- Berkas Khusus Tahfidz --}}
                    <div id="berkasKhususTahfidz" class="d-none">
                        <div class="my-2"
                            style="font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:0.8px;color:rgba(255,255,255,0.55);">
                            <i class="bi bi-book-fill me-1 text-info"></i> Berkas Khusus Jalur Tahfidz
                        </div>

                        <div class="berkas-item" id="itemBerkasKetHafalan">
                            <div>
                                <div class="text-white fw-semibold" style="font-size:13px;">5. Surat Keterangan Hafalan
                                    Qur'an <span class="text-warning">*</span></div>
                                <div class="text-white-50" style="font-size:11px;" id="statusKetHafalanText">Format:
                                    PDF/JPG — Belum diunggah</div>
                            </div>
                            <div class="d-flex gap-2 align-items-center">
                                <input type="file" id="fileKetHafalan" accept=".pdf,.jpg,.jpeg,.png" class="d-none"
                                    onchange="handleBerkasUpload(this,'KetHafalan')">
                                <button class="btn btn-outline-light btn-sm px-3 py-1 d-none" id="btnPreviewKetHafalan"
                                    onclick="previewBerkas('KetHafalan')"
                                    style="border-radius:20px;font-size:11.5px;font-weight:500;background:rgba(255,255,255,0.1);">
                                    <i class="bi bi-eye me-1"></i>Preview
                                </button>
                                <button class="btn btn-outline-light btn-sm px-3 py-1" id="btnUploadKetHafalan"
                                    onclick="document.getElementById('fileKetHafalan').click()"
                                    style="border-radius:20px;font-size:11.5px;font-weight:500;">
                                    <i class="bi bi-upload me-1"></i>Pilih Berkas
                                </button>
                            </div>
                        </div>

                        <div class="berkas-item" id="itemBerkasKetLembaga">
                            <div>
                                <div class="text-white fw-semibold" style="font-size:13px;">6. Surat Keterangan dari
                                    Ponpes/Lembaga <span class="badge ms-1"
                                        style="background:rgba(255,255,255,0.15);font-size:9px;">Opsional</span></div>
                                <div class="text-white-50" style="font-size:11px;" id="statusKetLembagaText">Format:
                                    PDF/JPG — Opsional</div>
                            </div>
                            <div class="d-flex gap-2 align-items-center">
                                <input type="file" id="fileKetLembaga" accept=".pdf,.jpg,.jpeg,.png" class="d-none"
                                    onchange="handleBerkasUpload(this,'KetLembaga')">
                                <button class="btn btn-outline-light btn-sm px-3 py-1 d-none" id="btnPreviewKetLembaga"
                                    onclick="previewBerkas('KetLembaga')"
                                    style="border-radius:20px;font-size:11.5px;font-weight:500;background:rgba(255,255,255,0.1);">
                                    <i class="bi bi-eye me-1"></i>Preview
                                </button>
                                <button class="btn btn-outline-light btn-sm px-3 py-1" id="btnUploadKetLembaga"
                                    onclick="document.getElementById('fileKetLembaga').click()"
                                    style="border-radius:20px;font-size:11.5px;font-weight:500;">
                                    <i class="bi bi-upload me-1"></i>Pilih Berkas
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end mt-4 pt-3 border-top"
                        style="border-color:rgba(255,255,255,0.15) !important;">
                        <button class="btn btn-warning px-5 py-2 fw-bold" id="btnSubmitBerkas" disabled
                            onclick="submitBerkas()"
                            style="border-radius:20px;font-size:13px;color:#1a1a1a;border:none;">
                            <i class="bi bi-cloud-upload-fill me-1"></i> Kirim Berkas Pendaftaran
                        </button>
                    </div>
                </div>
            </div>

            {{-- ============ SECTION: CETAK KARTU ============ --}}
            <div id="sectionCetakKartu" class="dashboard-section">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h2 class="fw-bold text-dark m-0" style="font-size:20px;">Cetak Kartu Ujian</h2>
                    <span class="badge px-3 py-2 fw-semibold"
                        style="font-size:11px;border-radius:20px;background:#e2fbf5;color:#0d9488;border:1px solid rgba(13,148,136,0.15);">Langkah
                        4 dari 4</span>
                </div>

                {{-- Kartu terkunci --}}
                <div id="kartuTerkunciBox" class="dark-card animate-in mb-4">
                    <h3 class="text-white mb-2" style="font-size:16px;font-weight:600;">Status Kelengkapan Persyaratan
                    </h3>
                    <p class="text-white-50 mb-4" style="font-size:12px;line-height:1.5;">Kartu ujian akan otomatis
                        terbuka setelah formulir dan berkas Anda disetujui oleh Panitia PPDB.</p>

                    <div class="d-flex flex-column gap-2 p-3 mb-3 border"
                        style="border-color:rgba(255,255,255,0.15) !important;border-radius:12px;background:rgba(255,255,255,0.04);">
                        <div class="d-flex align-items-center justify-content-between py-2 border-bottom"
                            style="border-color:rgba(255,255,255,0.1) !important;">
                            <div class="d-flex align-items-center gap-2">
                                <span><i class="bi bi-file-earmark-text-fill text-white"></i></span>
                                <span class="text-white fw-medium" style="font-size:12.5px;">1. Formulir
                                    Pendaftaran</span>
                            </div>
                            <span class="badge px-3 py-1" id="kartuReqForm"
                                style="font-size:10px;border-radius:20px;background:#fee2e2;color:#ef4444;"><i
                                    class="bi bi-x-circle-fill me-1"></i> Belum</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-between py-2 border-bottom"
                            style="border-color:rgba(255,255,255,0.1) !important;">
                            <div class="d-flex align-items-center gap-2">
                                <span><i class="bi bi-folder-fill text-white"></i></span>
                                <span class="text-white fw-medium" style="font-size:12.5px;">2. Berkas
                                    Persyaratan</span>
                            </div>
                            <span class="badge px-3 py-1" id="kartuReqBerkas"
                                style="font-size:10px;border-radius:20px;background:#fee2e2;color:#ef4444;"><i
                                    class="bi bi-x-circle-fill me-1"></i> Belum</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-between py-2">
                            <div class="d-flex align-items-center gap-2">
                                <span><i class="bi bi-credit-card-2-back-fill text-white"></i></span>
                                <span class="text-white fw-medium" style="font-size:12.5px;">3. Konfirmasi Pembayaran
                                    Admin</span>
                            </div>
                            <span class="badge px-3 py-1" id="kartuReqBayar"
                                style="font-size:10px;border-radius:20px;background:#fee2e2;color:#ef4444;"><i
                                    class="bi bi-x-circle-fill me-1"></i> Belum</span>
                        </div>
                    </div>

                    <div class="text-center py-4 px-2" style="background:rgba(255,255,255,0.04);border-radius:12px;">
                        <i class="bi bi-lock-fill text-white-50 mb-2" style="font-size:32px;display:block;"
                            id="kartuLockEmoji"></i>
                        <h5 class="text-white mb-2" id="kartuLockTitle" style="font-size:14px;font-weight:700;">Akses
                            Cetak Kartu Terkunci</h5>
                        <p class="text-white-50 m-0" id="kartuLockDesc" style="font-size:12px;line-height:1.5;">
                            Selesaikan seluruh persyaratan dan tunggu persetujuan Panitia PPDB.</p>
                    </div>
                </div>

                {{-- Kartu terbuka --}}
                <div id="kartuTerbukaBox" class="d-none animate-in">
                    <div class="alert-banner success mb-4">
                        <span><i class="bi bi-patch-check-fill text-success" style="font-size: 22px;"></i></span>
                        <div>
                            <div class="fw-bold text-success" style="font-size:14px;">Selamat! Akses Cetak Kartu Ujian
                                Terbuka</div>
                            <div style="font-size:12px;color:#166534;margin-top:3px;">Formulir, berkas, dan pembayaran
                                Anda telah dikonfirmasi oleh Panitia PPDB. Silakan unduh kartu ujian Anda.</div>
                        </div>
                    </div>

                    <div class="card shadow-sm" style="border-radius:16px;border:1px solid #e2e8f0;">
                        <div class="card-body p-4">
                            <p class="text-secondary mb-4 text-center" style="font-size:13px;font-weight:500;">Berikut
                                adalah <strong>Kartu Peserta Ujian Masuk</strong> Anda. Foto menggunakan pas foto yang
                                Anda upload. Klik tombol di bawah untuk mengunduh PDF siap cetak.</p>

                            {{-- Preview Kartu Ujian sebagai Surat Resmi --}}
                            <div class="mb-4"
                                style="background:#f8fafc;padding:24px;border-radius:14px;border:1px dashed #cbd5e1;">
                                <div id="printAreaKartu"
                                    style="width:100%;max-width:600px;margin:0 auto;background:#ffffff;border:1px solid #d1d5db;border-radius:8px;overflow:hidden;box-shadow:0 4px 16px rgba(0,0,0,0.08);font-family:'Inter',sans-serif;color:#1e293b;">

                                    {{-- KOP SURAT --}}
                                    <div
                                        style="background:#ffffff;padding:18px 24px 12px;border-bottom:4px solid #15803d;">
                                        <div style="display:flex;align-items:center;gap:14px;">
                                            {{-- Logo --}}
                                            <img src="{{ asset('logo.png') }}" alt="Logo" id="kopLogoImg"
                                                style="width:70px;height:70px;object-fit:contain;flex-shrink:0;">
                                            {{-- Identitas Sekolah --}}
                                            <div style="flex:1;text-align:center;line-height:1.3;">
                                                <div
                                                    style="font-size:8pt;font-weight:600;color:#475569;text-transform:uppercase;letter-spacing:0.3px;">
                                                    YAYASAN PENDIDIKAN DAN PONDOK PESANTREN AL AMANAH AL BANTANI</div>
                                                <div style="font-size:7pt;color:#64748b;margin-top:1px;">Akta Notaris
                                                    SK. MENKUMHAM No. AHU-06738.50.10.2014</div>
                                                <div
                                                    style="font-size:20pt;font-weight:900;color:#15803d;letter-spacing:1px;margin:2px 0;line-height:1;">
                                                    SMP AL AMANAH</div>
                                                <div style="font-size:7.5pt;color:#334155;font-weight:600;">NSS:
                                                    202280324002&nbsp;|&nbsp;NPSN: 20603598&nbsp;|&nbsp;NDS: 2002040072
                                                </div>
                                                <div style="font-size:7pt;color:#64748b;margin-top:1px;">Jl. Raya
                                                    Puspiptek Pocis, Setu, Kota Tangerang Selatan, Banten 15314</div>
                                                <div style="font-size:7pt;color:#64748b;">Telp. (021) 7560
                                                    783&nbsp;|&nbsp;Email: smp.alamanah@yahoo.com</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div style="height:2px;background:#86efac;"></div>

                                    {{-- JUDUL KARTU --}}
                                    <div style="padding:10px 24px;text-align:center;border-bottom:1px solid #e5e7eb;">
                                        <div
                                            style="font-size:12pt;font-weight:900;color:#14532d;letter-spacing:2px;text-transform:uppercase;text-decoration:underline;text-underline-offset:3px;">
                                            KARTU PESERTA UJIAN MASUK</div>
                                        <div style="font-size:7.5pt;color:#374151;margin-top:2px;font-weight:500;">Tahun
                                            Pelajaran 2026/2027</div>
                                    </div>

                                    {{-- IDENTITAS SISWA --}}
                                    <div style="padding:14px 24px 12px;display:flex;gap:16px;align-items:flex-start;">

                                        {{-- Tabel Data --}}
                                        <div style="flex:1;">
                                            <table style="width:100%;border-collapse:collapse;font-size:9.5pt;">
                                                <tr>
                                                    <td
                                                        style="padding:5px 4px 5px 0;color:#374151;font-weight:600;width:36%;">
                                                        No. Peserta</td>
                                                    <td style="width:4px;color:#374151;">:</td>
                                                    <td style="padding:5px 0 5px 4px;font-weight:800;color:#15803d;">
                                                        <span id="cardNoDaftar">REG-2026-001</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="padding:5px 4px 5px 0;color:#374151;font-weight:600;">
                                                        Nama Lengkap</td>
                                                    <td style="color:#374151;">:</td>
                                                    <td style="padding:5px 0 5px 4px;font-weight:800;color:#1e293b;">
                                                        <span id="cardNama"
                                                            style="text-transform:uppercase;">{{ $siswa->name }}</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="padding:5px 4px 5px 0;color:#374151;font-weight:600;">
                                                        NISN</td>
                                                    <td style="color:#374151;">:</td>
                                                    <td style="padding:5px 0 5px 4px;font-weight:700;color:#1e293b;">
                                                        <span id="cardNISN">-</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="padding:5px 4px 5px 0;color:#374151;font-weight:600;">
                                                        Jalur</td>
                                                    <td style="color:#374151;">:</td>
                                                    <td style="padding:5px 0 5px 4px;font-weight:700;color:#1e293b;">
                                                        <span id="cardJalur">-</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="padding:5px 4px 5px 0;color:#374151;font-weight:600;">
                                                        Asal Sekolah</td>
                                                    <td style="color:#374151;">:</td>
                                                    <td style="padding:5px 0 5px 4px;font-weight:700;color:#1e293b;">
                                                        <span id="cardAsal">-</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="padding:5px 4px 5px 0;color:#374151;font-weight:600;">
                                                        Tanggal Ujian</td>
                                                    <td style="color:#374151;">:</td>
                                                    <td style="padding:5px 0 5px 4px;font-weight:800;color:#15803d;">
                                                        <span
                                                            id="cardTanggalUjian">{{ $sys_settings['tanggal_ujian'] ?? 'Sabtu, 6 Juni 2026' }}</span>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>

                                        {{-- Foto Siswa 3x4 --}}
                                        <div style="flex-shrink:0;text-align:center;">
                                            <div id="cardPhotoBox"
                                                style="width:82px;height:105px;border:2px solid #15803d;overflow:hidden;background:#f1f5f9;display:flex;align-items:center;justify-content:center;">
                                                <img id="cardPhotoImg" src=""
                                                    style="width:100%;height:100%;object-fit:cover;display:none;">
                                                <div id="cardPhotoPlaceholder"
                                                    style="text-align:center;color:#94a3b8;font-size:8pt;font-weight:600;line-height:1.5;padding:4px;">
                                                    PAS<br>FOTO<br>3&times;4</div>
                                            </div>
                                            <div style="font-size:6.5pt;color:#64748b;margin-top:3px;font-weight:500;">
                                                Foto Peserta</div>
                                        </div>
                                    </div>

                                    {{-- CATATAN PENTING --}}
                                    <div style="padding:8px 24px 14px;border-top:1px solid #e5e7eb;">
                                        <div style="font-size:7.5pt;color:#1e293b;font-weight:700;margin-bottom:3px;">
                                            Catatan Penting:</div>
                                        <div style="font-size:7pt;color:#374151;line-height:1.7;">
                                            <div>1. Kartu ini wajib dibawa saat ujian masuk.</div>
                                            <div>2. Hadir paling lambat 30 menit sebelum ujian dimulai.</div>
                                            <div>3. Berpakaian rapi sesuai seragam SD/MI asal.</div>
                                            <div>4. Dilarang membawa perangkat elektronik ke dalam ruang ujian.</div>
                                        </div>
                                        <div style="margin-top:8px;text-align:center;">
                                            <div
                                                style="display:inline-block;background:#f0fdf4;border:1px solid #86efac;border-radius:3px;padding:3px 12px;font-size:7pt;font-weight:600;color:#15803d;">
                                                <i>Kartu ini sah sebagai tanda peserta ujian masuk PPDB SMP Al Amanah TA
                                                    2026/2027</i>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="d-flex justify-content-center gap-3">
                                <button class="btn btn-success px-5 py-3 fw-bold" onclick="printApplicationCard()"
                                    style="border-radius:24px;font-size:13px;border:none;background:linear-gradient(135deg,#15803d,#16a34a);box-shadow:0 4px 14px rgba(21,128,61,0.3);">
                                    <i class="bi bi-file-earmark-pdf-fill me-2"></i> Unduh PDF Siap Cetak (A4)
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ============ SECTION: PEMBAYARAN ============ --}}
            <div id="sectionPembayaran" class="dashboard-section">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <div class="d-flex align-items-center gap-2">
                        <div
                            style="width: 32px; height: 32px; background: #ccfbf1; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #0d9488;">
                            <i class="bi bi-credit-card-2-back-fill"></i>
                        </div>
                        <h2 class="fw-bold text-dark m-0" style="font-size:20px;">Pembayaran Administrasi</h2>
                    </div>
                    <span class="badge px-3 py-2 fw-semibold"
                        style="font-size:11px;border-radius:20px;background:#fee2e2;color:#dc2626;border:1px solid rgba(220,38,38,0.15);">Wajib</span>
                </div>

                <div class="row g-4">
                    <!-- Kolom Kiri: Rincian Tagihan & Metode Pembayaran -->
                    <div class="col-lg-7">
                        <div class="card border-0 shadow-sm rounded-4 mb-4 bg-white">
                            <div class="card-header bg-white border-0 pt-4 px-4 pb-2">
                                <h5 class="fw-bold text-dark m-0" style="font-size:15px;"><i
                                        class="bi bi-receipt me-1 text-teal"></i> Rincian Invoice</h5>
                            </div>
                            <div class="card-body px-4 pb-4 pt-2">
                                <p class="text-secondary mb-4" style="font-size:12px; line-height:1.6;">
                                    Biaya ini digunakan untuk administrasi pendaftaran, verifikasi berkas, dan
                                    penyelenggaraan ujian seleksi masuk SMP Al-Amanah.
                                </p>
                                <div class="table-responsive mb-4">
                                    <table class="table table-sm table-borderless align-middle m-0"
                                        style="font-size:12.5px;">
                                        <tbody>
                                            <tr class="border-bottom" style="border-color:#f1f5f9 !important;">
                                                <td class="py-2 text-secondary" style="width: 60%;">Biaya Pendaftaran
                                                    (Jalur Reguler/Prestasi/Tahfidz)</td>
                                                <td class="py-2 text-end fw-bold text-dark">Rp 100.000</td>
                                            </tr>
                                            <tr class="border-bottom" style="border-color:#f1f5f9 !important;">
                                                <td class="py-2 text-secondary">Akses Portal PPDB & Kartu Ujian Digital
                                                </td>
                                                <td class="py-2 text-end text-success fw-semibold">Gratis</td>
                                            </tr>
                                            <tr>
                                                <td class="py-3 fw-bold text-dark" style="font-size:13.5px;">Total
                                                    Pembayaran</td>
                                                <td class="py-3 text-end fw-extrabold text-teal"
                                                    style="font-size:16px;">Rp 100.000</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div id="pembayaranAksiSection">
                                    <div class="d-flex gap-3 flex-wrap mb-4">
                                        <button class="btn btn-teal fw-bold px-5 py-2.5 d-flex align-items-center gap-2"
                                            onclick="openMidtransModal('all', this)"
                                            style="border-radius:12px;font-size:14px;background:#0d9488;color:#fff;border:none;box-shadow: 0 4px 12px rgba(13,148,136,0.3);">
                                            <i class="bi bi-wallet2 fs-5"></i> Bayar Sekarang via Midtrans
                                        </button>
                                    </div>
                                    <div class="border-top pt-3">
                                        <form id="formManualPayment" onsubmit="submitManualPayment(event)">
                                            <div class="mb-3">
                                                <label for="buktiNamaPengirim" class="form-label fw-bold text-secondary"
                                                    style="font-size:12.5px;"><i class="bi bi-person me-1"></i> Nama
                                                    Pengirim / Atas Nama Rekening <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control mb-3" id="buktiNamaPengirim"
                                                    placeholder="Contoh: Budi Santoso" required
                                                    style="font-size:12.5px; border-radius:8px;">

                                                <label for="buktiTransferFile" class="form-label fw-bold text-secondary"
                                                    style="font-size:12.5px;"><i class="bi bi-upload me-1"></i> Unggah
                                                    Bukti Transaksi / Pembayaran <span
                                                        class="text-danger">*</span></label>
                                                <div class="text-muted mb-2"
                                                    style="font-size:11.5px; line-height: 1.45;">
                                                    Jika Anda sudah melakukan pembayaran via Midtrans tetapi status
                                                    belum berubah otomatis, silakan unggah tangkapan layar (screenshot)
                                                    bukti pembayaran Anda di bawah ini agar panitia dapat memverifikasi
                                                    secara manual.
                                                </div>
                                                <input type="file" class="form-control" id="buktiTransferFile"
                                                    accept=".jpg,.jpeg,.png,.pdf" required
                                                    style="font-size:12.5px; border-radius:8px;">
                                                <div class="form-text" style="font-size:10px;">Format: JPG, PNG, PDF
                                                    (Maks. 2MB)</div>
                                            </div>
                                            <button type="submit" id="btnSubmitManualPayment"
                                                class="btn btn-warning fw-bold px-4 py-2"
                                                style="border-radius:10px; font-size:12.5px; color:#1e293b; border: none;">
                                                <i class="bi bi-cloud-upload-fill me-1"></i> Kirim Bukti Pembayaran
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Petunjuk Pembayaran -->
                        <div class="card border-0 shadow-sm rounded-4 bg-white">
                            <div class="card-header bg-white border-0 pt-4 px-4 pb-2">
                                <h5 class="fw-bold text-dark m-0" style="font-size:14px;"><i
                                        class="bi bi-info-circle-fill me-1 text-teal"></i> Panduan Pembayaran</h5>
                            </div>
                            <div class="card-body px-4 pb-4 pt-2">
                                <div class="d-flex flex-column gap-3">
                                    <div class="d-flex gap-3 align-items-start">
                                        <span
                                            class="d-flex align-items-center justify-content-center fw-bold rounded-circle"
                                            style="width:24px;height:24px;font-size:11px;flex-shrink:0;background:#e0f2fe;color:#0369a1;">1</span>
                                        <div style="font-size:12px;color:#475569;line-height:1.5;">Pilih salah satu
                                            metode pembayaran di atas (QRIS untuk proses instan otomatis, atau Virtual
                                            Account untuk transfer bank).</div>
                                    </div>
                                    <div class="d-flex gap-3 align-items-start">
                                        <span
                                            class="d-flex align-items-center justify-content-center fw-bold rounded-circle"
                                            style="width:24px;height:24px;font-size:11px;flex-shrink:0;background:#e0f2fe;color:#0369a1;">2</span>
                                        <div style="font-size:12px;color:#475569;line-height:1.5;">Selesaikan transaksi
                                            sesuai nominal hingga muncul pesan "Pembayaran Berhasil" pada pop-up
                                            Midtrans.</div>
                                    </div>
                                    <div class="d-flex gap-3 align-items-start">
                                        <span
                                            class="d-flex align-items-center justify-content-center fw-bold rounded-circle"
                                            style="width:24px;height:24px;font-size:11px;flex-shrink:0;background:#e0f2fe;color:#0369a1;">3</span>
                                        <div style="font-size:12px;color:#475569;line-height:1.5;">Sistem akan
                                            memverifikasi status Anda. Admin PPDB akan meninjau dan mengonfirmasi
                                            pembayaran Anda dalam 1-24 jam kerja untuk mengaktifkan kartu ujian.</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Kolom Kanan: Status Pembayaran -->
                    <div class="col-lg-5">
                        <div id="pembayaranStatusCard"
                            class="card border-0 shadow-sm rounded-4 bg-white overflow-hidden animate-in">
                            <div class="card-body p-4" id="pembayaranStatusContent">
                                <!-- Diisi secara dinamis oleh JavaScript -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ============ SECTION: HASIL SELEKSI ============ --}}
            <div id="sectionHasilSeleksi" class="dashboard-section">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <div
                        style="width: 32px; height: 32px; background: #ccfbf1; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #0d9488;">
                        <i class="bi bi-megaphone-fill"></i>
                    </div>
                    <h2 class="fw-bold text-dark m-0" style="font-size:20px;">Hasil Seleksi PPDB</h2>
                </div>
                <div id="hasilSeleksiContent">
                    <div class="card border-0 shadow-sm rounded-4 bg-white text-center py-5 px-4 animate-in">
                        <div class="d-inline-flex align-items-center justify-content-center text-teal rounded-circle mb-3"
                            style="width: 64px; height: 64px; background: #e0f2fe; color: #0284c7; animation: pulse 2s infinite;">
                            <i class="bi bi-hourglass-split" style="font-size: 30px;"></i>
                        </div>
                        <h5 class="fw-bold text-dark mb-2" style="font-size:16px;">Hasil Seleksi Belum Tersedia</h5>
                        <p class="text-secondary mx-auto mb-4"
                            style="font-size:12.5px; max-width:480px; line-height:1.6;">
                            Hasil seleksi penerimaan siswa baru saat ini sedang dalam tahap proses pengolahan nilai dan
                            rapat pleno kelulusan oleh Dewan Panitia PPDB SMP Al-Amanah.
                        </p>
                        <div class="d-inline-flex align-items-center gap-2 px-3 py-2 bg-light rounded-pill border"
                            style="border-color:#e2e8f0 !important;">
                            <span class="status-dot pending" style="background:#ca8a04; width:8px; height:8px;"></span>
                            <span class="fw-semibold text-secondary"
                                style="font-size:11px; text-transform:uppercase; letter-spacing:0.5px;">Proses Seleksi
                                Sedang Berjalan</span>
                        </div>
                    </div>
                </div>
            </div>

        </main>
    </div>

    {{-- ======= OFFCANVAS DATA DIRI ======= --}}
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasDataDiri" style="width:340px;">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title fw-bold" style="font-size:14px;"><i
                    class="bi bi-person-badge-fill me-1 text-teal"></i> Data Akun Pendaftar</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body p-0">
            <div class="p-4 border-bottom text-center">
                <div
                    style="width:60px;height:60px;background:linear-gradient(135deg,#0d9488,#0f766e);border-radius:50%;display:flex;align-items:center;justify-content:center;color:#fff;font-size:22px;font-weight:700;margin:0 auto 10px;">
                    {{ strtoupper(substr($siswa->name, 0, 2)) }}
                </div>
                <div class="fw-bold text-dark" style="font-size:15px;">{{ $siswa->name }}</div>
                <div class="text-muted" style="font-size:11.5px;">{{ $siswa->email }}</div>
                <div class="mt-2"><span class="badge"
                        style="background:#ccfbf1;color:#0d9488;font-size:11px;border-radius:20px;padding:4px 12px;">Calon
                        Siswa PPDB</span></div>
            </div>
            <div class="p-4">
                <div class="mb-3">
                    <div class="text-muted"
                        style="font-size:11px;font-weight:600;text-transform:uppercase;letter-spacing:0.5px;margin-bottom:8px;">
                        Status Pendaftaran</div>
                    <div class="d-flex flex-column gap-2">
                        <div class="d-flex justify-content-between align-items-center py-2 border-bottom"
                            style="border-color:#f1f5f9 !important;">
                            <span style="font-size:12px;color:#475569;">Jalur Dipilih</span>
                            <span style="font-size:12px;font-weight:600;" id="sideInfoJalur">–</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center py-2 border-bottom"
                            style="border-color:#f1f5f9 !important;">
                            <span style="font-size:12px;color:#475569;">Formulir</span>
                            <span style="font-size:12px;font-weight:600;" id="sideInfoFormulir">Belum</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center py-2 border-bottom"
                            style="border-color:#f1f5f9 !important;">
                            <span style="font-size:12px;color:#475569;">Berkas</span>
                            <span style="font-size:12px;font-weight:600;" id="sideInfoBerkas">Belum</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center py-2">
                            <span style="font-size:12px;color:#475569;">Cetak Kartu</span>
                            <span style="font-size:12px;font-weight:600;" id="sideInfoCetak"><i
                                    class="bi bi-lock-fill me-1"></i> Terkunci</span>
                        </div>
                    </div>
                </div>

                <div class="mb-4 border-top pt-3">
                    <div class="text-muted"
                        style="font-size:11px;font-weight:600;text-transform:uppercase;letter-spacing:0.5px;margin-bottom:8px;">
                        Profil Calon Siswa</div>
                    <div class="d-flex flex-column gap-2">
                        <div class="d-flex justify-content-between align-items-center py-2 border-bottom"
                            style="border-color:#f1f5f9 !important;">
                            <span style="font-size:12px;color:#475569;">NISN</span>
                            <span style="font-size:12px;font-weight:600;" id="sideInfoNISN">Belum diisi</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center py-2 border-bottom"
                            style="border-color:#f1f5f9 !important;">
                            <span style="font-size:12px;color:#475569;">Jenis Kelamin</span>
                            <span style="font-size:12px;font-weight:600;" id="sideInfoGender">Belum diisi</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center py-2"
                            style="border-color:#f1f5f9 !important;">
                            <span style="font-size:12px;color:#475569;">Asal Sekolah</span>
                            <span
                                style="font-size:12px;font-weight:600;max-width:180px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;"
                                id="sideInfoAsal" title="Belum diisi">Belum diisi</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ======= MODAL STATUS POPUP ======= --}}
    <div id="statusPopupModal"
        style="display:none;position:fixed;top:0;left:0;right:0;bottom:0;background:rgba(15,23,42,0.55);z-index:10005;align-items:center;justify-content:center;backdrop-filter:blur(4px);font-family:'Inter',sans-serif;">
        <div
            style="width:360px;background:#fff;border-radius:16px;box-shadow:0 20px 40px rgba(0,0,0,0.15);overflow:hidden;display:flex;flex-direction:column;animation:fadeInUp 0.25s ease;padding:28px;text-align:center;">
            <div id="spIconContainer"
                style="width:60px;height:60px;background:#dcfce7;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 16px;border:2px solid #22c55e;">
                <i class="bi bi-check-lg" style="font-size:28px;color:#22c55e;" id="spIconSymbol"></i>
            </div>
            <h4 id="spTitle" style="font-size:16px;font-weight:800;color:#0f766e;margin-bottom:8px;">Berhasil!</h4>
            <p id="spMessage" style="font-size:12.5px;color:#64748b;line-height:1.55;margin-bottom:20px;">Data berhasil
                disimpan.</p>
            <button id="spBtn" onclick="closeStatusPopup()"
                style="width:100%;padding:11px;background:linear-gradient(135deg,#0d9488,#0f766e);color:#fff;border:none;border-radius:20px;font-weight:700;font-size:13px;cursor:pointer;">
                OK, Lanjutkan
            </button>
        </div>
    </div>

    {{-- ======= MIDTRANS MODAL ======= --}}
    <div id="midtransSnapModal"
        style="display:none;position:fixed;top:0;left:0;right:0;bottom:0;background:rgba(15,23,42,0.6);z-index:10000;align-items:center;justify-content:center;backdrop-filter:blur(4px);font-family:'Inter',sans-serif;">
        <div
            style="width:380px;background:#fff;border-radius:12px;box-shadow:0 20px 40px rgba(0,0,0,0.15);overflow:hidden;display:flex;flex-direction:column;animation:fadeInUp 0.25s ease;">
            <div style="background:#002f6c;padding:16px;color:#fff;">
                <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:8px;">
                    <span style="font-size:12px;font-weight:700;"><i
                            class="bi bi-shield-fill-check me-1 text-success"></i> Midtrans Secure Gateway</span>
                    <button onclick="closeMidtransModal()"
                        style="background:transparent;border:none;color:#fff;font-size:20px;cursor:pointer;padding:0;line-height:1;">&times;</button>
                </div>
                <div style="font-size:18px;font-weight:800;color:#fbbf24;">Rp 100.000</div>
                <div style="font-size:10px;opacity:0.7;">SMP AL AMANAH — Biaya Pendaftaran PPDB 2026/2027</div>
            </div>
            <div id="mtModalBody"
                style="padding:16px;background:#f8fafc;min-height:250px;display:flex;flex-direction:column;">
                <div id="mtScreenSelect">
                    <div style="font-size:12px;font-weight:700;color:#334155;margin-bottom:12px;">Pilih Metode
                        Pembayaran</div>
                    <div onclick="selectMidtransMethod('qris')"
                        style="background:#fff;border:1.5px solid #e2e8f0;border-radius:8px;padding:12px;margin-bottom:10px;cursor:pointer;display:flex;align-items:center;justify-content:space-between;">
                        <div style="display:flex;align-items:center;gap:10px;"><i
                                class="bi bi-phone-fill text-teal-primary fs-5"></i>
                            <div>
                                <div style="font-size:12.5px;font-weight:700;color:#1e293b;">GoPay / QRIS</div>
                                <div style="font-size:10px;color:#64748b;">Bayar via dompet digital</div>
                            </div>
                        </div><span>›</span>
                    </div>
                    <div onclick="selectMidtransMethod('va')"
                        style="background:#fff;border:1.5px solid #e2e8f0;border-radius:8px;padding:12px;cursor:pointer;display:flex;align-items:center;justify-content:space-between;">
                        <div style="display:flex;align-items:center;gap:10px;"><i
                                class="bi bi-bank text-teal-primary fs-5"></i>
                            <div>
                                <div style="font-size:12.5px;font-weight:700;color:#1e293b;">Virtual Account Bank</div>
                                <div style="font-size:10px;color:#64748b;">BCA, Mandiri, BNI, BRI, BSI</div>
                            </div>
                        </div><span>›</span>
                    </div>
                </div>
                <div id="mtScreenQris" style="display:none;text-align:center;flex-direction:column;">
                    <div style="display:flex;justify-content:space-between;margin-bottom:10px;"><span
                            onclick="goBackToSelect()"
                            style="font-size:11.5px;color:#002f6c;font-weight:700;cursor:pointer;">‹ Kembali</span><span
                            style="font-size:12px;font-weight:700;">GoPay / QRIS</span></div>
                    <div
                        style="background:#fff;padding:16px;border-radius:8px;display:inline-block;margin-bottom:12px;">
                        <svg width="140" height="140" viewBox="0 0 100 100">
                            <rect x="5" y="5" width="25" height="25" fill="none" stroke="#000" stroke-width="6" />
                            <rect x="70" y="5" width="25" height="25" fill="none" stroke="#000" stroke-width="6" />
                            <rect x="5" y="70" width="25" height="25" fill="none" stroke="#000" stroke-width="6" />
                            <rect x="12" y="12" width="11" height="11" fill="#000" />
                            <rect x="77" y="12" width="11" height="11" fill="#000" />
                            <rect x="12" y="77" width="11" height="11" fill="#000" />
                            <rect x="35" y="5" width="5" height="5" fill="#000" />
                            <rect x="45" y="10" width="5" height="5" fill="#000" />
                            <rect x="35" y="20" width="10" height="5" fill="#000" />
                            <rect x="50" y="35" width="5" height="5" fill="#000" />
                            <rect x="60" y="40" width="5" height="5" fill="#000" />
                        </svg>
                    </div>
                    <div style="font-size:11px;color:#475569;margin-bottom:12px;">Pindai kode QR di atas</div>
                    <button onclick="completeMidtransPayment()"
                        style="width:100%;padding:10px;background:#10b981;color:#fff;border:none;border-radius:8px;font-weight:700;font-size:13px;cursor:pointer;">Simulasikan
                        Pembayaran</button>
                </div>
                <div id="mtScreenVa" style="display:none;text-align:center;flex-direction:column;">
                    <div style="display:flex;justify-content:space-between;margin-bottom:10px;"><span
                            onclick="goBackToSelect()"
                            style="font-size:11.5px;color:#002f6c;font-weight:700;cursor:pointer;">‹ Kembali</span><span
                            style="font-size:12px;font-weight:700;">Virtual Account BSI</span></div>
                    <div style="text-align:left;background:#fff;padding:14px;border-radius:8px;margin-bottom:12px;">
                        <div style="font-size:10.5px;color:#64748b;">No. Virtual Account</div>
                        <div style="font-size:16px;font-weight:800;color:#002f6c;margin-bottom:8px;">8807 2310 1140 1732
                        </div>
                        <div style="font-size:10.5px;color:#64748b;">Atas Nama</div>
                        <div style="font-size:13px;font-weight:700;">SMP AL AMANAH PPDB</div>
                    </div>
                    <button onclick="completeMidtransPayment()"
                        style="width:100%;padding:10px;background:#10b981;color:#fff;border:none;border-radius:8px;font-weight:700;font-size:13px;cursor:pointer;">Konfirmasi
                        Pembayaran</button>
                </div>
                <div id="mtScreenLoading"
                    style="display:none;text-align:center;justify-content:center;align-items:center;flex-direction:column;flex-grow:1;">
                    <div
                        style="border:4px solid #cbd5e1;border-top:4px solid #002f6c;border-radius:50%;width:45px;height:45px;animation:spin 1s linear infinite;margin-bottom:16px;">
                    </div>
                    <div style="font-size:13.5px;font-weight:700;color:#1e293b;">Memproses...</div>
                </div>
                <div id="mtScreenSuccess"
                    style="display:none;text-align:center;justify-content:center;align-items:center;flex-direction:column;flex-grow:1;">
                    <div
                        style="width:60px;height:60px;background:#dcfce7;border-radius:50%;display:flex;align-items:center;justify-content:center;margin-bottom:16px;border:2px solid #22c55e;">
                        <i class="bi bi-check-lg" style="font-size:32px;color:#22c55e;"></i>
                    </div>
                    <div style="font-size:15px;font-weight:800;color:#1e293b;margin-bottom:4px;">Pembayaran Berhasil!
                    </div>
                    <div style="font-size:11px;color:#64748b;">Menunggu konfirmasi admin</div>
                </div>
            </div>
            <div style="background:#e2e8f0;padding:10px;text-align:center;font-size:9px;color:#64748b;font-weight:600;">
                <i class="bi bi-lock-fill me-1"></i> Transaksi dienkripsi penuh oleh Midtrans
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // ==================== STATE & CONSTANTS ====================
        const SISWA_ID = '{{ $siswa->id }}';
        const SISWA_NAME = '{{ $siswa->name }}';
        const STATE_KEY = 'ppdbState_' + SISWA_ID;
        const NOTIF_KEY = 'ppdbNotif_' + SISWA_ID;
        const ADMIN_STATE_KEY = 'ppdb_admin_state';

        // Synchronize with Real DB Payment Status
        const DB_STATUS_PEMBAYARAN = '{{ $dbStatusPembayaran ?? "" }}';
        const DB_CATATAN_PEMBAYARAN = {!! json_encode($dbCatatanPembayaran ?? '') !!};
        const DB_BUKTI_TRANSFER_MANUAL = {!! json_encode($dbBuktiTransferManual ?? '') !!};
        const DB_NAMA_PENGIRIM = {!! json_encode($dbNamaPengirim ?? '') !!};

        if (DB_STATUS_PEMBAYARAN) {
            let mappedStatus = 'Belum Bayar';
            if (DB_STATUS_PEMBAYARAN === 'Menunggu Verifikasi') mappedStatus = 'Menunggu Konfirmasi';
            else if (DB_STATUS_PEMBAYARAN === 'Lunas') mappedStatus = 'Lunas';

            let currentState = {};
            try { currentState = JSON.parse(localStorage.getItem(STATE_KEY)) || {}; } catch (e) { }

            let changed = false;
            if (currentState.statusPembayaran !== mappedStatus) {
                currentState.statusPembayaran = mappedStatus;
                changed = true;
            }
            if (currentState.catatanPembayaran !== DB_CATATAN_PEMBAYARAN) {
                currentState.catatanPembayaran = DB_CATATAN_PEMBAYARAN;
                changed = true;
            }
            if (currentState.buktiTransferManual !== DB_BUKTI_TRANSFER_MANUAL) {
                currentState.buktiTransferManual = DB_BUKTI_TRANSFER_MANUAL;
                changed = true;
            }
            if (currentState.namaPengirim !== DB_NAMA_PENGIRIM) {
                currentState.namaPengirim = DB_NAMA_PENGIRIM;
                changed = true;
            }

            if (changed) {
                localStorage.setItem(STATE_KEY, JSON.stringify(currentState));

                // Also force sync to admin state if it exists
                let adminState = {};
                try { adminState = JSON.parse(localStorage.getItem(ADMIN_STATE_KEY)) || {}; } catch (e) { }
                if (adminState.pendaftar) {
                    const p = adminState.pendaftar.find(x => x.id === SISWA_ID);
                    if (p) {
                        p.statusPembayaran = mappedStatus;
                        p.catatanPembayaran = DB_CATATAN_PEMBAYARAN;
                        p.buktiTransferManual = DB_BUKTI_TRANSFER_MANUAL;
                        p.namaPengirim = DB_NAMA_PENGIRIM;
                        localStorage.setItem(ADMIN_STATE_KEY, JSON.stringify(adminState));
                    }
                }
            }
        }

        // IndexedDB File Store Helpers
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

        function saveFileDB(key, fileBlob, name, mime) {
            return getDB().then(db => {
                return new Promise((resolve, reject) => {
                    const transaction = db.transaction([STORE_NAME], 'readwrite');
                    const store = transaction.objectStore(STORE_NAME);
                    const request = store.put({ fileBlob, name, mime, timestamp: Date.now() }, key);
                    request.onsuccess = () => resolve();
                    request.onerror = (e) => reject(e.target.error);
                });
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

        // In-memory file store — holds actual File objects and Object URLs for current session
        // This avoids localStorage bloat. Files must be re-selected after page refresh.
        const _berkasFileMap = new Map(); // key: type, value: { file, objectUrl, name, mime }

        function getBerkasFile(type) {
            return _berkasFileMap.get(type) || null;
        }
        function setBerkasFile(type, file) {
            // Revoke old URL to free memory
            const old = _berkasFileMap.get(type);
            if (old && old.objectUrl) URL.revokeObjectURL(old.objectUrl);
            const objectUrl = URL.createObjectURL(file);
            _berkasFileMap.set(type, { file, objectUrl, name: file.name, mime: file.type });

            // Asynchronously save to IndexedDB
            saveFileDB(SISWA_ID + '_' + type, file, file.name, file.type)
                .catch(err => console.error('Gagal menyimpan file ke IndexedDB:', err));

            return objectUrl;
        }

        // Clean up old base64 data from localStorage that was stored by previous code version
        (function cleanupOldBerkasData() {
            try {
                const keysToRemove = [];
                for (let i = 0; i < localStorage.length; i++) {
                    const key = localStorage.key(i);
                    if (key && key.startsWith('ppdbFileData_')) keysToRemove.push(key);
                }
                keysToRemove.forEach(k => localStorage.removeItem(k));
            } catch (e) { }
        })();

        let uploadedFiles = {};
        let currentFormStep = 1;
        let notifPanelOpen = false;

        // ==================== STATE HELPERS ====================
        function getState() {
            try { return JSON.parse(localStorage.getItem(STATE_KEY)) || {}; } catch (e) { return {}; }
        }
        function setState(data) {
            const current = getState();
            const merged = Object.assign(current, data);
            localStorage.setItem(STATE_KEY, JSON.stringify(merged));
        }
        function getNotifs() {
            try { return JSON.parse(localStorage.getItem(NOTIF_KEY)) || []; } catch (e) { return []; }
        }
        function addNotif(notif) {
            const notifs = getNotifs();

            // Prevent duplicate notification if the most recent one is identical in type and message
            if (notifs.length > 0 && notifs[0].tipe === notif.tipe && notifs[0].pesan === notif.pesan) {
                return;
            }

            notif.id = Date.now();
            notif.waktu = new Date().toLocaleString('id-ID');
            notif.dibaca = false;
            notifs.unshift(notif);
            localStorage.setItem(NOTIF_KEY, JSON.stringify(notifs));
            renderNotifPanel();

            // Trigger a premium real-time Toast using Swal
            let icon = 'info';
            if (notif.tipe.includes('disetujui') || notif.tipe === 'kartu_terbuka' || notif.tipe === 'hasil_seleksi') {
                icon = 'success';
            } else if (notif.tipe.includes('ditolak') || notif.tipe === 'pembayaran_gagal') {
                icon = 'error';
            } else if (notif.tipe.includes('terkirim') || notif.tipe.includes('pembayaran')) {
                icon = 'info';
            }

            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 4500,
                timerProgressBar: true,
                background: '#fff',
                color: '#1e293b',
                iconColor: icon === 'success' ? '#10b981' : icon === 'error' ? '#ef4444' : '#3b82f6',
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                    toast.style.cursor = 'pointer';
                    toast.addEventListener('click', () => {
                        readNotif(notif.id);
                    });
                }
            });

            Toast.fire({
                icon: icon,
                title: notif.pesan
            });
        }
        function markAllRead() {
            const notifs = getNotifs().map(n => ({ ...n, dibaca: true }));
            localStorage.setItem(NOTIF_KEY, JSON.stringify(notifs));
            renderNotifPanel();
        }

        // ==================== SECTION SWITCHING ====================
        function switchSection(name) {
            const state = getState();

            // Kunci halaman pembayaran sebelum berkas diupload
            if (name === 'Pembayaran' && state.statusBerkas !== 'Terkirim' && state.statusBerkasAdmin !== 'Disetujui') {
                Swal.fire({
                    icon: 'warning',
                    title: 'Terkunci',
                    text: 'Anda harus menyelesaikan Upload Berkas terlebih dahulu sebelum dapat melakukan Pembayaran Administrasi.',
                    confirmButtonColor: '#0d9488'
                });
                return;
            }

            document.querySelectorAll('.dashboard-section').forEach(s => s.classList.remove('active'));
            document.querySelectorAll('.sidebar-menu-item').forEach(l => l.classList.remove('active'));

            const sectionMap = {
                'Dashboard': 'sectionDashboard',
                'PilihJalur': 'sectionPilihJalur',
                'Formulir': 'sectionFormulir',
                'UploadBerkas': 'sectionUploadBerkas',
                'CetakKartu': 'sectionCetakKartu',
                'Pembayaran': 'sectionPembayaran',
                'HasilSeleksi': 'sectionHasilSeleksi'
            };
            const linkMap = {
                'Dashboard': 'linkDashboard',
                'PilihJalur': 'linkPilihJalur',
                'Formulir': 'linkIsiFormulir',
                'UploadBerkas': 'linkUploadBerkas',
                'CetakKartu': 'linkCetakKartu',
                'Pembayaran': 'linkPembayaran',
                'HasilSeleksi': 'linkHasilSeleksi'
            };

            const sEl = document.getElementById(sectionMap[name]);
            if (sEl) sEl.classList.add('active');
            const lEl = document.getElementById(linkMap[name]);
            if (lEl) lEl.classList.add('active');

            const titles = {
                'Dashboard': 'Dashboard Calon Siswa',
                'PilihJalur': 'Pilih Jalur Pendaftaran',
                'Formulir': 'Isi Formulir Pendaftaran',
                'UploadBerkas': 'Upload Berkas Persyaratan',
                'CetakKartu': 'Cetak Kartu Ujian',
                'Pembayaran': 'Pembayaran Administrasi',
                'HasilSeleksi': 'Hasil Seleksi PPDB'
            };
            const tb = document.getElementById('topbarTitle');
            const ts = document.getElementById('topbarSub');
            if (tb) tb.textContent = titles[name] || name;
            if (ts) ts.textContent = name;

            if (name === 'UploadBerkas') updateBerkasUI();
            if (name === 'CetakKartu') updateCetakKartuUI();
            if (name === 'Formulir') loadFormFromState();

            window.scrollTo(0, 0);
            notifPanelOpen = false;
            const panel = document.getElementById('notifPanel');
            if (panel) panel.classList.remove('show');
        }

        // ==================== JALUR SELECTION ====================
        let selectedJalur = '';

        function selectJalur(jalur) {
            selectedJalur = jalur;
            document.querySelectorAll('.jalur-card').forEach(c => c.classList.remove('selected'));
            const card = document.getElementById('cardJalur' + jalur);
            if (card) card.classList.add('selected');

            const icons = { Reguler: '<i class="bi bi-book-half"></i>', Prestasi: '<i class="bi bi-trophy-fill"></i>', Tahfidz: '<i class="bi bi-book-fill"></i>' };
            const titles = { Reguler: 'Jalur Reguler Dipilih', Prestasi: 'Jalur Prestasi Dipilih', Tahfidz: 'Jalur Tahfidz Dipilih' };
            const subs = { Reguler: 'Berkas: KK, Akta, Rapor, Pas Foto', Prestasi: 'Berkas: KK, Akta, Rapor, Foto + Sertifikat Prestasi', Tahfidz: 'Berkas: KK, Akta, Rapor, Foto + Surat Ket. Hafalan' };

            const info = document.getElementById('selectedJalurInfo');
            if (info) info.classList.remove('d-none');
            const em = document.getElementById('selectedJalurEmoji');
            const ti = document.getElementById('selectedJalurTitle');
            const su = document.getElementById('selectedJalurSubtitle');
            if (em) em.innerHTML = icons[jalur];
            if (ti) ti.textContent = titles[jalur];
            if (su) su.textContent = subs[jalur];

            const btn = document.getElementById('btnKonfirmasiJalur');
            if (btn) btn.classList.remove('d-none');
        }

        function konfirmasiJalur() {
            if (!selectedJalur) return;
            setState({ jalur: selectedJalur, statusFormulir: 'Belum', statusBerkas: 'Belum', statusFormulirAdmin: 'Menunggu', statusBerkasAdmin: 'Menunggu' });
            syncToAdminPanel();
            addNotif({ tipe: 'pilih_jalur', pesan: 'Jalur pendaftaran ' + selectedJalur + ' berhasil dipilih.', emoji: '<i class="bi bi-patch-check-fill text-success"></i>' });
            showPopup('<i class="bi bi-patch-check-fill fs-3 text-success"></i>', 'Jalur Dikonfirmasi!', 'Jalur <strong>' + selectedJalur + '</strong> berhasil dipilih. Sekarang lengkapi formulir pendaftaran.', '#dcfce7', '#16a34a');
            setTimeout(() => { closeStatusPopup(); switchSection('Formulir'); }, 1800);
            updateDashboardUI();
        }

        // ==================== FORM STEP NAVIGATION ====================
        function nextFormStep(step) {
            if (!validateFormStep(currentFormStep)) return;
            saveFormStep(currentFormStep);
            currentFormStep = step;
            showFormStep(step);
        }

        function prevFormStep(step) {
            saveFormStep(currentFormStep);
            currentFormStep = step;
            showFormStep(step);
        }

        function showFormStep(step) {
            document.querySelectorAll('.form-step').forEach(s => s.classList.add('d-none'));
            const stepEl = document.getElementById('formStep' + step);
            if (stepEl) stepEl.classList.remove('d-none');

            // Update step indicators
            ['stepInd1', 'stepInd2', 'stepInd3'].forEach((id, i) => {
                const el = document.getElementById(id);
                if (el) {
                    if (i + 1 < step) {
                        el.style.background = 'rgba(16,185,129,0.85)'; el.style.color = '#fff';
                    } else if (i + 1 === step) {
                        el.style.background = 'rgba(255,255,255,0.9)'; el.style.color = '#0f766e';
                    } else {
                        el.style.background = 'rgba(255,255,255,0.15)'; el.style.color = 'rgba(255,255,255,0.6)';
                    }
                }
            });
            // If step 3, no need to show/hide jalur-specific content since it has been removed.
        }

        function validateFormStep(step) {
            const requiredFields = {
                1: ['inputNIK', 'inputNISN', 'inputNama', 'inputTempatLahir', 'inputTanggalLahir', 'inputGender', 'inputAgama', 'inputTinggiBadan', 'inputAnakKe', 'inputJumlahSaudara'],
                2: ['inputAlamatJalan', 'inputAlamatRTRW', 'inputAlamatDesa', 'inputAlamatKecamatan', 'inputAlamatKabupaten', 'inputAsalSekolah', 'inputAlamatSekolah'],
                3: ['inputNamaAyah', 'inputPendidikanAyah', 'inputPekerjaanAyah', 'inputNamaIbu', 'inputPendidikanIbu', 'inputPekerjaanIbu', 'inputAlamatOrtu', 'inputNoHpOrtu']
            };
            let valid = true;
            (requiredFields[step] || []).forEach(id => {
                const el = document.getElementById(id);
                if (el && !el.value.trim()) {
                    el.style.borderColor = '#ef4444';
                    el.style.boxShadow = '0 0 0 2px rgba(239,68,68,0.25)';
                    valid = false;
                    el.addEventListener('input', () => { el.style.borderColor = ''; el.style.boxShadow = ''; }, { once: true });
                }
            });
            if (!valid) {
                showPopup('<i class="bi bi-exclamation-triangle-fill fs-3 text-danger"></i>', 'Data Belum Lengkap', 'Harap isi semua kolom yang wajib diisi sebelum melanjutkan.', '#fee2e2', '#ef4444');
                setTimeout(closeStatusPopup, 2200);
            }
            return valid;
        }

        function saveFormStep(step) {
            const fields = {
                1: ['inputNIK', 'inputNISN', 'inputNama', 'inputTempatLahir', 'inputTanggalLahir', 'inputGender', 'inputAgama', 'inputTinggiBadan', 'inputGolDarah', 'inputAnakKe', 'inputJumlahSaudara', 'inputSaudaraLaki', 'inputSaudaraPerempuan', 'inputSaudaraMenikah'],
                2: ['inputAlamatJalan', 'inputAlamatRTRW', 'inputAlamatDesa', 'inputAlamatKecamatan', 'inputAlamatKabupaten', 'inputNoHpSiswa', 'inputAsalSekolah', 'inputAlamatSekolah'],
                3: ['inputNamaAyah', 'inputStatusAyah', 'inputPendidikanAyah', 'inputPekerjaanAyah', 'inputNamaIbu', 'inputStatusIbu', 'inputPendidikanIbu', 'inputPekerjaanIbu', 'inputAlamatOrtu', 'inputNoHpOrtu', 'inputNamaWali', 'inputAlamatWali', 'inputNoHpWali', 'inputPekerjaanWali']
            };
            const data = {};
            (fields[step] || []).forEach(id => {
                const el = document.getElementById(id);
                if (el) data[id] = el.value;
            });
            setState({ formData: Object.assign(getState().formData || {}, data) });
        }

        function loadFormFromState() {
            const state = getState();

            // Tampilkan loading kecil
            showPopup('⏳', 'Memuat Data...', 'Mengambil data formulir dari database MySQL...', '#eff6ff', '#2563eb');

            fetch('/pendaftaran/data')
                .then(res => res.json())
                .then(res => {
                    closeStatusPopup();
                    if (res.success) {
                        // Update state lokal dengan data dari MySQL
                        setState({
                            jalur: res.jalur,
                            statusFormulir: res.statusFormulir,
                            noUrut: res.noUrut,
                            tanggalDaftar: res.tanggalDaftar,
                            formData: res.formData
                        });

                        // Tampilkan ke input form
                        const fd = res.formData || {};
                        Object.keys(fd).forEach(id => {
                            const el = document.getElementById(id);
                            if (el) el.value = fd[id] || '';
                        });

                        updateDashboardUI();
                    } else {
                        // Jika belum ada data di database, gunakan local storage atau kosongkan
                        const fd = state.formData || {};
                        Object.keys(fd).forEach(id => {
                            const el = document.getElementById(id);
                            if (el) el.value = fd[id] || '';
                        });
                    }

                    // Show rejection banner if applicable
                    if (state.statusFormulirAdmin === 'Perlu Revisi' || state.statusFormulirAdmin === 'Belum Valid' || state.statusFormulirAdmin === 'Ditolak') {
                        const banner = document.getElementById('formRejectionBanner');
                        if (banner) banner.classList.remove('d-none');
                        const note = document.getElementById('formRejectionNote');
                        if (note) {
                            if (state.statusFormulirAdmin === 'Ditolak') {
                                note.innerHTML = `<strong>TOLAK:</strong> ${state.catatanFormulirAdmin || 'Hubungi panitia.'}`;
                            } else {
                                note.innerHTML = `<strong>REVISI:</strong> ${state.catatanFormulirAdmin || 'Perbaiki formulir.'}`;
                            }
                        }
                    } else {
                        const banner = document.getElementById('formRejectionBanner');
                        if (banner) banner.classList.add('d-none');
                    }

                    // Check jalur
                    const currentJalur = getState().jalur || '';
                    if (!currentJalur) {
                        showPopup('<i class="bi bi-exclamation-triangle-fill fs-3 text-warning"></i>', 'Belum Pilih Jalur', 'Silakan pilih jalur pendaftaran terlebih dahulu sebelum mengisi formulir.', '#fef9c3', '#d97706');
                        setTimeout(() => { closeStatusPopup(); switchSection('PilihJalur'); }, 2000);
                        return;
                    }
                    selectedJalur = currentJalur;
                    showFormStep(currentFormStep);
                })
                .catch(() => {
                    closeStatusPopup();
                    // Fallback ke local state jika offline/error
                    const fd = state.formData || {};
                    Object.keys(fd).forEach(id => {
                        const el = document.getElementById(id);
                        if (el) el.value = fd[id] || '';
                    });
                    showFormStep(currentFormStep);
                });
        }

        function submitFormulir() {
            saveFormStep(currentFormStep);
            const state = getState();
            if (!state.jalur) {
                showPopup('<i class="bi bi-exclamation-triangle-fill fs-3 text-warning"></i>', 'Jalur Belum Dipilih', 'Pilih jalur terlebih dahulu.', '#fef9c3', '#d97706');
                setTimeout(closeStatusPopup, 2000);
                return;
            }

            const noUrut = state.noUrut || ('REG-2026-' + String(SISWA_ID).padStart(3, '0'));

            // Tampilkan popup loading indah
            showPopup('⏳', 'Menyimpan...', 'Menghubungkan ke database MySQL...', '#eff6ff', '#2563eb');

            fetch('/pendaftaran/simpan', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    formData: state.formData || {},
                    jalur: state.jalur,
                    noUrut: noUrut
                })
            })
                .then(res => res.json())
                .then(res => {
                    if (res.success) {
                        setState({
                            statusFormulir: 'Terkirim',
                            statusFormulirAdmin: 'Menunggu',
                            noUrut: noUrut,
                            tanggalDaftar: new Date().toLocaleDateString('id-ID')
                        });

                        // Update kartu data
                        const fd = getState().formData || {};
                        if (document.getElementById('cardNama') && fd.inputNama) document.getElementById('cardNama').textContent = fd.inputNama;
                        if (document.getElementById('cardNISN') && fd.inputNISN) document.getElementById('cardNISN').textContent = fd.inputNISN;
                        if (document.getElementById('cardNIK') && fd.inputNIK) document.getElementById('cardNIK').textContent = fd.inputNIK;
                        if (document.getElementById('cardAsal') && fd.inputAsalSekolah) document.getElementById('cardAsal').textContent = fd.inputAsalSekolah;
                        if (document.getElementById('cardJalur')) document.getElementById('cardJalur').textContent = getState().jalur;
                        if (document.getElementById('cardNoDaftar')) document.getElementById('cardNoDaftar').textContent = noUrut;

                        syncToAdminPanel();
                        addNotif({ tipe: 'formulir_terkirim', pesan: 'Formulir pendaftaran Anda telah berhasil dikirim ke panitia. Tunggu verifikasi.', emoji: '<i class="bi bi-file-earmark-text text-primary"></i>' });

                        showPopup('<i class="bi bi-check-circle-fill fs-3 text-success"></i>', 'Formulir Berhasil Dikirim!', 'Formulir Anda telah disimpan di database MySQL. Selanjutnya, silakan upload berkas persyaratan.', '#dcfce7', '#16a34a');
                        setTimeout(() => { closeStatusPopup(); switchSection('UploadBerkas'); updateDashboardUI(); }, 2000);
                    } else {
                        showPopup('<i class="bi bi-x-circle-fill fs-3 text-danger"></i>', 'Gagal Menyimpan', res.message || 'Terjadi kesalahan.', '#fef2f2', '#dc2626');
                    }
                })
                .catch(err => {
                    showPopup('<i class="bi bi-x-circle-fill fs-3 text-danger"></i>', 'Error Koneksi', 'Gagal terhubung ke database. Coba lagi.', '#fef2f2', '#dc2626');
                });
        }

        // ==================== BERKAS UPLOAD ====================
        function updateBerkasUI() {
            const state = getState();
            const jalur = state.jalur || '';

            // Show banner jika perlu revisi
            const banner = document.getElementById('berkasRejectionBanner');
            const note = document.getElementById('berkasRejectionNote');
            if (banner && note) {
                if (state.statusBerkasAdmin === 'Perlu Revisi' || state.statusBerkasAdmin === 'Belum Valid' || state.statusBerkasAdmin === 'Ditolak') {
                    banner.classList.remove('d-none');
                    if (state.statusBerkasAdmin === 'Ditolak') {
                        note.innerHTML = `<strong>TOLAK:</strong> ${state.catatanBerkasAdmin || 'Berkas ditolak panitia.'}`;
                    } else {
                        note.innerHTML = `<strong>REVISI:</strong> ${state.catatanBerkasAdmin || 'Perbaiki berkas Anda.'}`;
                    }
                } else {
                    banner.classList.add('d-none');
                }
            }

            // Show jalur label
            const jalurLabel = document.getElementById('jalurBerkasLabel');
            if (jalurLabel) jalurLabel.textContent = jalur || 'Belum dipilih';

            // Show/hide jalur-specific berkas
            const pkPrestasi = document.getElementById('berkasKhususPrestasi');
            const pkTahfidz = document.getElementById('berkasKhususTahfidz');
            if (pkPrestasi) pkPrestasi.classList.toggle('d-none', jalur !== 'Prestasi');
            if (pkTahfidz) pkTahfidz.classList.toggle('d-none', jalur !== 'Tahfidz');

            // Restore upload state
            const uploaded = state.uploadedFiles || {};
            Object.keys(uploaded).forEach(key => {
                if (uploaded[key]) markBerkasUploaded(key);
            });

            checkBerkasComplete();
        }

        function handleBerkasUpload(input, type) {
            if (!input.files[0]) return;
            const file = input.files[0];
            const maxSize = 10 * 1024 * 1024; // 10MB limit

            if (file.size > maxSize) {
                showPopup('<i class="bi bi-exclamation-triangle-fill fs-3 text-warning"></i>', 'File Terlalu Besar', 'Ukuran file maksimal 10MB. Kompres file Anda terlebih dahulu.', '#fef9c3', '#d97706');
                setTimeout(closeStatusPopup, 2500);
                return;
            }

            // Store file in memory using Object URL (no localStorage needed)
            const objectUrl = setBerkasFile(type, file);

            // For photo, also update card preview using object URL
            if (type === 'Foto') {
                const img = document.getElementById('cardPhotoImg');
                const ph = document.getElementById('cardPhotoPlaceholder');
                if (img) { img.src = objectUrl; img.style.display = 'block'; }
                if (ph) ph.style.display = 'none';
                // Read as base64 only for photo (small file, needed for card persistence)
                const reader = new FileReader();
                reader.onload = e => setState({ cardPhotoSrc: e.target.result });
                reader.readAsDataURL(file);
            }

            // Store only metadata in localStorage (not the file data itself)
            const uploadedFiles = getState().uploadedFiles || {};
            uploadedFiles[type] = { name: file.name, mime: file.type, size: file.size };
            setState({ uploadedFiles: uploadedFiles });
            markBerkasUploaded(type, true);
            checkBerkasComplete();
            syncToAdminPanel();
        }

        function previewBerkas(type) {
            const entry = getBerkasFile(type);
            if (!entry || !entry.objectUrl) {
                showPopup('<i class="bi bi-info-circle-fill fs-3" style="color:#0ea5e9"></i>',
                    'Pilih File Dulu',
                    'Berkas ini belum dipilih di sesi ini. Klik <b>Ganti</b> dan pilih file kembali untuk preview.',
                    '#e0f2fe', '#0369a1');
                return;
            }
            const newTab = window.open(entry.objectUrl, '_blank');
            if (!newTab) {
                showPopup('<i class="bi bi-exclamation-triangle-fill fs-3 text-warning"></i>', 'Pop-up Diblokir', 'Izinkan pop-up untuk domain ini di browser, lalu coba lagi.', '#fef9c3', '#d97706');
                setTimeout(closeStatusPopup, 3000);
            }
        }

        function markBerkasUploaded(type, hasFile) {
            const statusMap = {
                'KK': 'statusKKText', 'Akta': 'statusAktaText', 'Rapor': 'statusRaporText',
                'Foto': 'statusFotoText', 'Sertifikat': 'statusSertifikatText',
                'Rekomen': 'statusRekomenText', 'KetHafalan': 'statusKetHafalanText',
                'KetLembaga': 'statusKetLembagaText'
            };
            const btnMap = {
                'KK': 'btnUploadKK', 'Akta': 'btnUploadAkta', 'Rapor': 'btnUploadRapor',
                'Foto': 'btnUploadFoto', 'Sertifikat': 'btnUploadSertifikat',
                'Rekomen': 'btnUploadRekomen', 'KetHafalan': 'btnUploadKetHafalan',
                'KetLembaga': 'btnUploadKetLembaga'
            };
            const previewBtnMap = {
                'KK': 'btnPreviewKK', 'Akta': 'btnPreviewAkta', 'Rapor': 'btnPreviewRapor',
                'Foto': 'btnPreviewFoto', 'Sertifikat': 'btnPreviewSertifikat',
                'Rekomen': 'btnPreviewRekomen', 'KetHafalan': 'btnPreviewKetHafalan',
                'KetLembaga': 'btnPreviewKetLembaga'
            };
            const itemMap = {
                'KK': 'itemBerkasKK', 'Akta': 'itemBerkasAkta', 'Rapor': 'itemBerkasRapor',
                'Foto': 'itemBerkasFoto', 'Sertifikat': 'itemBerkasSertifikat',
                'Rekomen': 'itemBerkasRekomen', 'KetHafalan': 'itemBerkasKetHafalan',
                'KetLembaga': 'itemBerkasKetLembaga'
            };

            const uploaded = getState().uploadedFiles || {};
            const meta = uploaded[type];
            const fileName = (meta && meta.name) ? meta.name : '';

            const sEl = document.getElementById(statusMap[type]);
            if (sEl) {
                sEl.innerHTML = '<i class="bi bi-check-circle-fill me-1"></i> Berhasil diunggah'
                    + (fileName ? ' <span style="font-size:10px;opacity:0.75;">(' + fileName + ')</span>' : '');
                sEl.style.color = '#6ee7b7';
            }

            const bEl = document.getElementById(btnMap[type]);
            if (bEl) {
                bEl.innerHTML = '<i class="bi bi-check-circle me-1"></i>Ganti';
                bEl.className = 'btn btn-success btn-sm px-3 py-1';
                bEl.style.borderRadius = '20px';
                bEl.style.fontSize = '11.5px';
            }

            const pEl = document.getElementById(previewBtnMap[type]);
            if (pEl) {
                const inMemory = hasFile === true || !!getBerkasFile(type);
                if (inMemory) pEl.classList.remove('d-none');
            }

            const iEl = document.getElementById(itemMap[type]);
            if (iEl) iEl.classList.add('uploaded');
        }

        function checkBerkasComplete() {
            const state = getState();
            const jalur = state.jalur || 'Reguler';
            const uploaded = state.uploadedFiles || {};

            const wajib = ['KK', 'Akta', 'Rapor', 'Foto'];
            if (jalur === 'Prestasi') wajib.push('Sertifikat');
            if (jalur === 'Tahfidz') wajib.push('KetHafalan');

            const allDone = wajib.every(k => uploaded[k]);
            const btn = document.getElementById('btnSubmitBerkas');
            if (btn) {
                if (allDone) { btn.removeAttribute('disabled'); btn.style.opacity = '1'; }
                else { btn.setAttribute('disabled', 'true'); btn.style.opacity = '0.5'; }
            }

            // Update count badge
            const uploaded_count = Object.values(uploaded).filter(Boolean).length;
            const badge = document.getElementById('berkasCountBadge');
            if (badge) {
                badge.textContent = uploaded_count + '/' + wajib.length + ' Berkas';
                badge.style.background = allDone ? 'rgba(16,185,129,0.3)' : 'rgba(255,255,255,0.15)';
            }
            return allDone;
        }

        function submitBerkas() {
            if (!checkBerkasComplete()) {
                showPopup('<i class="bi bi-exclamation-triangle-fill fs-3 text-warning"></i>', 'Berkas Belum Lengkap', 'Harap unggah semua berkas wajib sebelum mengirim.', '#fef9c3', '#d97706');
                setTimeout(closeStatusPopup, 2200);
                return;
            }
            setState({ statusBerkas: 'Terkirim', statusBerkasAdmin: 'Menunggu' });
            syncToAdminPanel();
            addNotif({ tipe: 'berkas_terkirim', pesan: 'Berkas persyaratan Anda telah berhasil dikirim ke panitia. Tunggu verifikasi.', emoji: '<i class="bi bi-folder-fill text-warning"></i>' });

            showPopup('<i class="bi bi-check-circle-fill fs-3 text-success"></i>', 'Berkas Berhasil Dikirim!', 'Berkas Anda sedang diverifikasi oleh Panitia PPDB. Kami akan memberi notifikasi segera setelah selesai.', '#dcfce7', '#16a34a');
            setTimeout(() => { closeStatusPopup(); switchSection('Dashboard'); updateDashboardUI(); }, 2000);
        }

        // ==================== CETAK KARTU UI ====================
        function updateCetakKartuUI() {
            const state = getState();
            const formOK = state.statusFormulirAdmin === 'Disetujui';
            const berkasOK = state.statusBerkasAdmin === 'Disetujui';
            const open = formOK && berkasOK;

            const terkunci = document.getElementById('kartuTerkunciBox');
            const terbuka = document.getElementById('kartuTerbukaBox');
            if (terkunci) terkunci.classList.toggle('d-none', open);
            if (terbuka) terbuka.classList.toggle('d-none', !open);

            // Update badges
            const reqForm = document.getElementById('kartuReqForm');
            const reqBerkas = document.getElementById('kartuReqBerkas');
            if (reqForm) {
                if (state.statusFormulirAdmin === 'Disetujui') { reqForm.innerHTML = '<i class="bi bi-check-circle-fill me-1"></i> Disetujui'; reqForm.style.background = '#dcfce7'; reqForm.style.color = '#16a34a'; }
                else if (state.statusFormulirAdmin === 'Belum Valid' || state.statusFormulirAdmin === 'Perlu Revisi') { reqForm.innerHTML = '<i class="bi bi-exclamation-triangle-fill me-1"></i> Belum Valid'; reqForm.style.background = '#fff7ed'; reqForm.style.color = '#c2410c'; }
                else if (state.statusFormulirAdmin === 'Ditolak') { reqForm.innerHTML = '<i class="bi bi-x-circle-fill me-1"></i> Ditolak'; reqForm.style.background = '#fee2e2'; reqForm.style.color = '#ef4444'; }
                else if (state.statusFormulir === 'Terkirim') { reqForm.innerHTML = '<i class="bi bi-hourglass-split me-1"></i> Menunggu Review'; reqForm.style.background = '#e0f2fe'; reqForm.style.color = '#0369a1'; }
                else { reqForm.innerHTML = '<i class="bi bi-x-circle-fill me-1"></i> Belum'; reqForm.style.background = '#fee2e2'; reqForm.style.color = '#ef4444'; }
            }
            if (reqBerkas) {
                if (state.statusBerkasAdmin === 'Disetujui') { reqBerkas.innerHTML = '<i class="bi bi-check-circle-fill me-1"></i> Disetujui'; reqBerkas.style.background = '#dcfce7'; reqBerkas.style.color = '#16a34a'; }
                else if (state.statusBerkasAdmin === 'Belum Valid' || state.statusBerkasAdmin === 'Perlu Revisi') { reqBerkas.innerHTML = '<i class="bi bi-exclamation-triangle-fill me-1"></i> Belum Valid'; reqBerkas.style.background = '#fff7ed'; reqBerkas.style.color = '#c2410c'; }
                else if (state.statusBerkasAdmin === 'Ditolak') { reqBerkas.innerHTML = '<i class="bi bi-x-circle-fill me-1"></i> Ditolak'; reqBerkas.style.background = '#fee2e2'; reqBerkas.style.color = '#ef4444'; }
                else if (state.statusBerkas === 'Terkirim') { reqBerkas.innerHTML = '<i class="bi bi-hourglass-split me-1"></i> Menunggu Review'; reqBerkas.style.background = '#e0f2fe'; reqBerkas.style.color = '#0369a1'; }
                else { reqBerkas.innerHTML = '<i class="bi bi-x-circle-fill me-1"></i> Belum'; reqBerkas.style.background = '#fee2e2'; reqBerkas.style.color = '#ef4444'; }
            }
            const reqBayar = document.getElementById('kartuReqBayar');
            if (reqBayar) {
                if (state.statusPembayaran === 'Lunas') { reqBayar.innerHTML = '<i class="bi bi-check-circle-fill me-1"></i> Konfirmasi Pembayaran Berhasil'; reqBayar.style.background = '#dcfce7'; reqBayar.style.color = '#16a34a'; }
                else if (state.statusPembayaran === 'Menunggu Konfirmasi') { reqBayar.innerHTML = '<i class="bi bi-hourglass-split me-1"></i> Menunggu Konfirmasi'; reqBayar.style.background = '#fef9c3'; reqBayar.style.color = '#b45309'; }
                else { reqBayar.innerHTML = '<i class="bi bi-x-circle-fill me-1"></i> Belum Bayar'; reqBayar.style.background = '#fee2e2'; reqBayar.style.color = '#ef4444'; }
            }

            const lockEmoji = document.getElementById('kartuLockEmoji');
            const lockTitle = document.getElementById('kartuLockTitle');
            const lockDesc = document.getElementById('kartuLockDesc');
            if (!open) {
                if (state.statusFormulir === 'Terkirim' || state.statusBerkas === 'Terkirim') {
                    if (lockEmoji) { lockEmoji.className = 'bi bi-hourglass-split text-info mb-2'; lockEmoji.textContent = ''; }
                    if (lockTitle) lockTitle.textContent = 'Menunggu Persetujuan Panitia';
                    if (lockDesc) lockDesc.textContent = 'Berkas Anda sedang diperiksa. Anda akan mendapat notifikasi setelah verifikasi selesai.';
                } else {
                    if (lockEmoji) { lockEmoji.className = 'bi bi-lock-fill text-white-50 mb-2'; lockEmoji.textContent = ''; }
                    if (lockTitle) lockTitle.textContent = 'Akses Cetak Kartu Terkunci';
                    if (lockDesc) lockDesc.textContent = 'Lengkapi formulir dan berkas terlebih dahulu, lalu tunggu persetujuan Panitia PPDB.';
                }
            }

            // Fill kartu data from state
            const fd = state.formData || {};
            if (fd.inputNama && document.getElementById('cardNama')) document.getElementById('cardNama').textContent = fd.inputNama;
            if (fd.inputNISN && document.getElementById('cardNISN')) document.getElementById('cardNISN').textContent = fd.inputNISN;
            if (fd.inputNIK && document.getElementById('cardNIK')) document.getElementById('cardNIK').textContent = fd.inputNIK;
            if (fd.inputAsalSekolah && document.getElementById('cardAsal')) document.getElementById('cardAsal').textContent = fd.inputAsalSekolah;
            if (state.jalur && document.getElementById('cardJalur')) document.getElementById('cardJalur').textContent = state.jalur;
            if (state.noUrut && document.getElementById('cardNoDaftar')) document.getElementById('cardNoDaftar').textContent = state.noUrut;

            // Restore photo
            const fotoFile = getBerkasFile('Foto');
            if (fotoFile && fotoFile.objectUrl) {
                const img = document.getElementById('cardPhotoImg');
                const ph = document.getElementById('cardPhotoPlaceholder');
                if (img) { img.src = fotoFile.objectUrl; img.style.display = 'block'; }
                if (ph) ph.style.display = 'none';
            } else if (state.cardPhotoSrc) {
                const img = document.getElementById('cardPhotoImg');
                const ph = document.getElementById('cardPhotoPlaceholder');
                if (img) { img.src = state.cardPhotoSrc; img.style.display = 'block'; }
                if (ph) ph.style.display = 'none';
            }
        }

        // ==================== DASHBOARD UI UPDATE ====================
        function updateDashboardUI() {
            const state = getState();
            const jalur = state.jalur || '';
            const formStatus = state.statusFormulir || 'Belum';
            const berkasStatus = state.statusBerkas || 'Belum';
            const formAdmin = state.statusFormulirAdmin || 'Menunggu';
            const berkasAdmin = state.statusBerkasAdmin || 'Menunggu';

            // Jalur info
            const jalurIcons = { Reguler: '<i class="bi bi-book-half"></i>', Prestasi: '<i class="bi bi-trophy-fill"></i>', Tahfidz: '<i class="bi bi-book-fill"></i>' };
            const statJalur = document.getElementById('statJalur');
            const statJalurHint = document.getElementById('statJalurHint');
            const infoJalurSelected = document.getElementById('infoJalurSelected');
            const sideInfoJalur = document.getElementById('sideInfoJalur');
            if (statJalur) statJalur.innerHTML = jalur ? (jalurIcons[jalur] + ' ' + jalur) : '–';
            if (statJalurHint) statJalurHint.textContent = jalur ? ('Jalur ' + jalur) : 'Belum dipilih';
            if (infoJalurSelected) infoJalurSelected.textContent = jalur || '–';
            if (sideInfoJalur) sideInfoJalur.textContent = jalur || '–';

            // Populate non-sensitive student profile details in offcanvas
            const fd = state.formData || {};
            const sideNISN = document.getElementById('sideInfoNISN');
            const sideGender = document.getElementById('sideInfoGender');
            const sideAsal = document.getElementById('sideInfoAsal');
            if (sideNISN) sideNISN.textContent = fd.inputNISN || 'Belum diisi';
            if (sideGender) sideGender.textContent = fd.inputGender || 'Belum diisi';
            if (sideAsal) {
                sideAsal.textContent = fd.inputAsalSekolah || 'Belum diisi';
                sideAsal.title = fd.inputAsalSekolah || 'Belum diisi';
            }

            // Form status
            const fStatusTextHtml = formAdmin === 'Disetujui' ? '<i class="bi bi-check-circle-fill"></i> Disetujui' : formAdmin === 'Perlu Revisi' ? '<i class="bi bi-exclamation-triangle-fill"></i> Perlu Revisi' : formStatus === 'Terkirim' ? '<i class="bi bi-hourglass-split"></i> Dikirim' : 'Belum';
            const fColor = formAdmin === 'Disetujui' ? '#16a34a' : formAdmin === 'Perlu Revisi' ? '#dc2626' : formStatus === 'Terkirim' ? '#0369a1' : '#b45309';
            const statF = document.getElementById('statFormulir');
            const statFH = document.getElementById('statFormulirHint');
            const infoSF = document.getElementById('infoStatusFormulir');
            const sideIF = document.getElementById('sideInfoFormulir');
            if (statF) { statF.innerHTML = fStatusTextHtml; statF.style.color = fColor; }
            if (statFH) statFH.textContent = formAdmin === 'Disetujui' ? 'Formulir valid' : formStatus === 'Terkirim' ? 'Menunggu verifikasi admin' : 'Segera isi formulir';
            if (infoSF) { infoSF.innerHTML = fStatusTextHtml; infoSF.style.color = fColor; }
            if (sideIF) sideIF.innerHTML = fStatusTextHtml;

            // Berkas status
            const bStatusTextHtml = berkasAdmin === 'Disetujui' ? '<i class="bi bi-check-circle-fill"></i> Disetujui' : berkasAdmin === 'Perlu Revisi' ? '<i class="bi bi-exclamation-triangle-fill"></i> Perlu Revisi' : berkasStatus === 'Terkirim' ? '<i class="bi bi-hourglass-split"></i> Dikirim' : 'Belum';
            const bColor = berkasAdmin === 'Disetujui' ? '#16a34a' : berkasAdmin === 'Perlu Revisi' ? '#dc2626' : berkasStatus === 'Terkirim' ? '#0369a1' : '#b45309';
            const statB = document.getElementById('statBerkas');
            const statBH = document.getElementById('statBerkasHint');
            const infoSB = document.getElementById('infoStatusBerkas');
            const sideIB = document.getElementById('sideInfoBerkas');
            if (statB) { statB.innerHTML = bStatusTextHtml; statB.style.color = bColor; }
            if (statBH) statBH.textContent = berkasAdmin === 'Disetujui' ? 'Berkas valid' : berkasStatus === 'Terkirim' ? 'Menunggu verifikasi admin' : 'Belum upload';
            if (infoSB) { infoSB.innerHTML = bStatusTextHtml; infoSB.style.color = bColor; }
            if (sideIB) sideIB.innerHTML = bStatusTextHtml;

            // Cetak kartu status — butuh formulir + berkas + PEMBAYARAN dikonfirmasi admin
            const isOpen = formAdmin === 'Disetujui' && berkasAdmin === 'Disetujui' && state.statusPembayaran === 'Lunas';
            const sideIC = document.getElementById('sideInfoCetak');
            if (sideIC) sideIC.innerHTML = isOpen ? '<i class="bi bi-check-circle-fill text-success"></i> Terbuka' : '<i class="bi bi-lock-fill text-muted"></i> Terkunci';

            // Progress %
            let prog = 20; // akun = 20%
            if (jalur) prog = 35;
            if (formStatus === 'Terkirim') prog = 50;
            if (formAdmin === 'Disetujui') prog = 65;
            if (berkasStatus === 'Terkirim') prog = 75;
            if (berkasAdmin === 'Disetujui') prog = 85;
            if (state.statusPembayaran === 'Menunggu Konfirmasi') prog = 90;
            if (state.statusPembayaran === 'Lunas') prog = 95;
            if (isOpen) prog = 100;
            const statP = document.getElementById('statProgres');
            const statPH = document.getElementById('statProgresHint');
            if (statP) statP.textContent = prog + '%';
            if (statPH) statPH.textContent = prog + '% dari tahapan selesai';

            // Sidebar dots
            const updateDot = (id, cls) => { const el = document.getElementById(id); if (el) { el.className = 'status-dot ' + cls; } };
            updateDot('dotPilihJalur', jalur ? 'done' : 'pending');
            updateDot('dotFormulir', formAdmin === 'Disetujui' ? 'approved' : formAdmin === 'Perlu Revisi' ? 'rejected' : formStatus === 'Terkirim' ? 'review' : jalur ? 'pending' : 'locked');
            updateDot('dotBerkas', berkasAdmin === 'Disetujui' ? 'approved' : berkasAdmin === 'Perlu Revisi' ? 'rejected' : berkasStatus === 'Terkirim' ? 'review' : formStatus === 'Terkirim' ? 'pending' : 'locked');
            updateDot('dotCetak', isOpen ? 'approved' : 'locked');
            updateDot('dotPembayaran', state.statusPembayaran === 'Lunas' ? 'approved' : 'locked');

            // Progress steps
            const updateStep = (numId, statusId, numClass, statusClass, statusText) => {
                const n = document.getElementById(numId);
                const s = document.getElementById(statusId);
                if (n) n.className = 'step-number ' + numClass;
                if (s) { s.className = 'step-status ' + statusClass; s.innerHTML = statusText; }
            };
            updateStep('stepJalurNum', 'stepJalurStatus', jalur ? 'done' : 'active', jalur ? 'done' : 'active', jalur ? jalur : 'Pilih Jalur');
            if (jalur && document.getElementById('stepJalurDesc')) document.getElementById('stepJalurDesc').textContent = 'Jalur ' + jalur + ' dipilih';

            const fStepClass = formAdmin === 'Disetujui' ? 'approved' : formAdmin === 'Perlu Revisi' ? 'rejected' : formStatus === 'Terkirim' ? 'review' : jalur ? 'active' : 'locked';
            const fStepText = formAdmin === 'Disetujui' ? 'Disetujui <i class="bi bi-check-lg"></i>' : formAdmin === 'Perlu Revisi' ? 'Perlu Revisi' : formStatus === 'Terkirim' ? 'Menunggu' : 'Isi Sekarang';
            updateStep('stepFormulirNum', 'stepFormulirStatus', fStepClass, fStepClass, fStepText);

            const bStepClass = berkasAdmin === 'Disetujui' ? 'approved' : berkasAdmin === 'Perlu Revisi' ? 'rejected' : berkasStatus === 'Terkirim' ? 'review' : formStatus === 'Terkirim' ? 'active' : 'locked';
            const bStepText = berkasAdmin === 'Disetujui' ? 'Disetujui <i class="bi bi-check-lg"></i>' : berkasAdmin === 'Perlu Revisi' ? 'Perlu Revisi' : berkasStatus === 'Terkirim' ? 'Menunggu' : formStatus === 'Terkirim' ? 'Upload' : 'Terkunci';
            updateStep('stepBerkasNum', 'stepBerkasStatus', bStepClass, bStepClass, bStepText);

            const cStepClass = isOpen ? 'approved' : (state.statusPembayaran === 'Menunggu Konfirmasi' ? 'pending' : 'locked');
            let cStepText = 'Terkunci <i class="bi bi-lock-fill"></i>';
            if (isOpen) cStepText = 'Konfirmasi Berhasil <i class="bi bi-check-lg"></i>';
            else if (state.statusPembayaran === 'Menunggu Konfirmasi') cStepText = 'Menunggu Konfirmasi <i class="bi bi-clock-history"></i>';
            updateStep('stepCetakNum', 'stepCetakStatus', cStepClass, cStepClass, cStepText);
            if (document.getElementById('stepCetakDesc')) document.getElementById('stepCetakDesc').textContent = isOpen ? 'Kartu siap dicetak!' : 'Terbuka setelah formulir, berkas & pembayaran dikonfirmasi';

            // Dynamic Pembayaran Status Card update
            const payCard = document.getElementById('pembayaranStatusCard');
            const payContent = document.getElementById('pembayaranStatusContent');
            const currentPayStatus = state.statusPembayaran || 'Belum Bayar';

            if (payCard && payContent) {
                payCard.style.borderColor = 'transparent';
                payCard.style.border = 'none';

                if (currentPayStatus === 'Lunas') {
                    payContent.innerHTML = `
                <div class="text-center py-4">
                    <div class="d-inline-flex align-items-center justify-content-center bg-success-subtle rounded-circle mb-3 animate-in" style="width: 64px; height: 64px; background: #e6fbf3; color: #10b981;">
                        <i class="bi bi-patch-check-fill" style="font-size: 32px;"></i>
                    </div>
                    <h5 class="fw-bold text-success mb-1" style="font-size: 15px; letter-spacing: 0.5px;">KONFIRMASI PEMBAYARAN BERHASIL</h5>
                    <p class="text-secondary px-2 mb-4" style="font-size: 12px; line-height: 1.55;">
                        Terima kasih! Pembayaran biaya pendaftaran Anda telah berhasil diverifikasi oleh sistem dan admin PPDB.
                    </p>
                    
                    <div class="border-top border-bottom py-3 mb-4 text-start" style="border-style: dashed !important; border-color: #e2e8f0 !important; border-left: none; border-right: none;">
                        <div class="d-flex justify-content-between mb-2" style="font-size:12px;">
                            <span class="text-secondary">No. Invoice</span>
                            <strong class="text-dark">INV-${SISWA_ID}-${new Date().getFullYear()}</strong>
                        </div>
                        <div class="d-flex justify-content-between mb-2" style="font-size:12px;">
                            <span class="text-secondary">Metode</span>
                            <strong class="text-dark">Midtrans E-Wallet/VA</strong>
                        </div>
                        <div class="d-flex justify-content-between mb-2" style="font-size:12px;">
                            <span class="text-secondary">Jumlah</span>
                            <strong class="text-teal" style="color:#0d9488 !important;">Rp 100.000</strong>
                        </div>
                        <div class="d-flex justify-content-between" style="font-size:12px;">
                            <span class="text-secondary">Status Verifikasi</span>
                            <span class="badge" style="border-radius:10px; font-size:10px; padding: 4px 10px; background-color: #dcfce7 !important; color: #15803d !important;">Lunas &amp; Aktif</span>
                        </div>
                    </div>
                    
                    <div class="alert alert-success d-flex align-items-start gap-2 border-0 text-start p-3 mb-0" style="background:#f0fdf4; border-radius:12px; color:#15803d; font-size:11.5px; line-height:1.5;">
                        <i class="bi bi-info-circle-fill" style="font-size: 14px; flex-shrink: 0; margin-top: 1px;"></i>
                        <div>
                            Akses cetak kartu ujian sekarang telah terbuka. Silakan buka tab <a href="#" onclick="switchSection('CetakKartu'); return false;" class="fw-bold text-success text-decoration-underline">Cetak Kartu Ujian</a> untuk mengunduh kartu peserta Anda.
                        </div>
                    </div>
                </div>
            `;
                    const aksiSec = document.getElementById('pembayaranAksiSection');
                    if (aksiSec) aksiSec.style.display = 'none';
                } else if (currentPayStatus === 'Menunggu Konfirmasi') {
                    const hasManual = (state.uploadedFiles && state.uploadedFiles.BuktiTransfer) || state.buktiTransferManual;
                    payContent.innerHTML = `
                <div class="text-center py-4">
                    <div class="d-inline-flex align-items-center justify-content-center bg-warning-subtle text-warning rounded-circle mb-3" style="width: 64px; height: 64px; background: #fef9c3; color: #d97706; animation: pulse 2s infinite;">
                        <i class="bi bi-clock-history" style="font-size: 30px;"></i>
                    </div>
                    <h5 class="fw-bold text-warning-emphasis mb-1" style="font-size: 15px; color:#a16207 !important; letter-spacing: 0.5px;">MENUNGGU VERIFIKASI</h5>
                    <p class="text-secondary px-2 mb-4" style="font-size: 12px; line-height: 1.55;">
                        Pembayaran Anda berhasil terdeteksi. Mohon tunggu beberapa saat sementara admin PPDB meninjau transaksi Anda.
                    </p>
                    
                    <div class="border-top border-bottom py-3 mb-4 text-start" style="border-style: dashed !important; border-color: #e2e8f0 !important; border-left: none; border-right: none;">
                        <div class="d-flex justify-content-between mb-2" style="font-size:12px;">
                            <span class="text-secondary">No. Invoice</span>
                            <strong class="text-dark">INV-${SISWA_ID}-${new Date().getFullYear()}</strong>
                        </div>
                        <div class="d-flex justify-content-between mb-2" style="font-size:12px;">
                            <span class="text-secondary">Jumlah Nominal</span>
                            <strong class="text-dark">Rp 100.000</strong>
                        </div>
                        ${state.namaPengirim ? `
                        <div class="d-flex justify-content-between mb-2" style="font-size:12px;">
                            <span class="text-secondary">Nama Pengirim</span>
                            <strong class="text-dark">${state.namaPengirim}</strong>
                        </div>
                        ` : ''}
                        ${hasManual ? `
                        <div class="d-flex justify-content-between mb-2" style="font-size:12px;">
                            <span class="text-secondary">Bukti Transfer</span>
                            <a href="#" onclick="previewBuktiPembayaran(); return false;" class="fw-bold text-teal text-decoration-none"><i class="bi bi-eye"></i> Lihat Bukti</a>
                        </div>
                        ` : ''}
                        <div class="d-flex justify-content-between" style="font-size:12px;">
                            <span class="text-secondary">Status Verifikasi</span>
                            <span class="badge" style="border-radius:10px; font-size:10px; padding: 4px 10px; background-color: #fef08a !important; color: #854d0e !important;">Review Admin</span>
                        </div>
                    </div>
                    
                    <div class="alert alert-warning d-flex align-items-start gap-2 border-0 text-start p-3 mb-0" style="background:#fffbeb; border-radius:12px; color:#854d0e; font-size:11.5px; line-height:1.5;">
                        <i class="bi bi-exclamation-triangle-fill" style="font-size: 14px; flex-shrink: 0; margin-top: 1px;"></i>
                        <div>
                            Jika dalam waktu 1x24 jam status pembayaran Anda belum terverifikasi otomatis, silakan hubungi Panitia PPDB dengan melampirkan screenshot bukti transfer.
                        </div>
                    </div>
                </div>
            `;
                    const aksiSec = document.getElementById('pembayaranAksiSection');
                    if (aksiSec) aksiSec.style.display = 'none';
                } else {
                    payContent.innerHTML = `
                <div class="text-center py-4">
                    <div class="d-inline-flex align-items-center justify-content-center bg-light text-secondary rounded-circle mb-3" style="width: 64px; height: 64px; background: #f8fafc; color: #64748b; border: 1.5px solid #e2e8f0;">
                        <i class="bi bi-credit-card-2-back-fill" style="font-size: 28px;"></i>
                    </div>
                    <h5 class="fw-bold text-dark mb-1" style="font-size: 15px; letter-spacing: 0.5px;">BELUM DIBAYAR</h5>
                    <p class="text-secondary px-2 mb-4" style="font-size: 12px; line-height: 1.55;">
                        Status invoice Anda saat ini belum terbayar. Silakan gunakan tombol pembayaran di sebelah kiri atau formulir transfer bank untuk memproses tagihan.
                    </p>
                    
                    <div class="border-top border-bottom py-3 mb-4 text-start" style="border-style: dashed !important; border-color: #e2e8f0 !important; border-left: none; border-right: none;">
                        <div class="d-flex justify-content-between mb-2" style="font-size:12px;">
                            <span class="text-secondary">No. Invoice</span>
                            <strong class="text-dark">INV-${SISWA_ID}-${new Date().getFullYear()}</strong>
                        </div>
                        <div class="d-flex justify-content-between mb-2" style="font-size:12px;">
                            <span class="text-secondary">Item Tagihan</span>
                            <strong class="text-dark">Uang Formulir Pendaftaran</strong>
                        </div>
                        <div class="d-flex justify-content-between" style="font-size:12px;">
                            <span class="text-secondary">Total Tagihan</span>
                            <strong class="text-teal" style="color:#0d9488 !important;">Rp 100.000</strong>
                        </div>
                    </div>
                    
                    ${state.catatanPembayaran ? `
                    <div class="alert alert-danger d-flex align-items-start gap-2 border-0 text-start p-3 mb-0" style="background:#fef2f2; border-radius:12px; color:#b91c1c; font-size:11.5px; line-height:1.5;">
                        <i class="bi bi-x-circle-fill" style="font-size: 14px; flex-shrink: 0; margin-top: 2px;"></i>
                        <div>
                            <strong>Pembayaran Ditolak Admin:</strong><br>
                            ${state.catatanPembayaran}
                        </div>
                    </div>
                    ` : `
                    <div class="alert alert-secondary d-flex align-items-start gap-2 border-0 text-start p-3 mb-0" style="background:#f1f5f9; border-radius:12px; color:#475569; font-size:11.5px; line-height:1.5;">
                        <i class="bi bi-shield-lock-fill" style="font-size: 14px; flex-shrink: 0; color:#64748b; margin-top: 1px;"></i>
                        <div>
                            Transaksi aman menggunakan Midtrans atau transfer bank manual panitia.
                        </div>
                    </div>
                    `}
                </div>
            `;
                    const aksiSec = document.getElementById('pembayaranAksiSection');
                    if (aksiSec) aksiSec.style.display = 'block';
                }
            }

            // Update dotSeleksi
            const hasNilai = state.nilaiUjian !== undefined && state.nilaiUjian !== null;
            const hasHasil = state.hasilSeleksi !== undefined && state.hasilSeleksi !== '';
            const dotSeleksiClass = hasHasil ? (state.hasilSeleksi === 'Lulus' ? 'approved' : 'rejected') : (hasNilai ? 'review' : 'locked');
            updateDot('dotSeleksi', dotSeleksiClass);

            // Update Hasil Seleksi Section Content
            const hContent = document.getElementById('hasilSeleksiContent');
            if (hContent) {
                const nilai = state.nilaiUjian || null;
                const hasil = state.hasilSeleksi || '';

                if (!nilai) {
                    hContent.innerHTML = `
                <div class="card border-0 shadow-sm rounded-4 bg-white text-center py-5 px-4 animate-in">
                    <div class="d-inline-flex align-items-center justify-content-center text-teal rounded-circle mb-3" style="width: 64px; height: 64px; background: #e0f2fe; color: #0284c7; animation: pulse 2s infinite;">
                        <i class="bi bi-hourglass-split" style="font-size: 30px;"></i>
                    </div>
                    <h5 class="fw-bold text-dark mb-2" style="font-size:16px;">Hasil Seleksi Belum Tersedia</h5>
                    <p class="text-secondary mx-auto mb-4" style="font-size:12.5px; max-width:480px; line-height:1.6;">
                        Hasil seleksi penerimaan siswa baru saat ini sedang dalam tahap proses pengolahan nilai dan rapat pleno kelulusan oleh Dewan Panitia PPDB SMP Al-Amanah.
                    </p>
                    <div class="d-inline-flex align-items-center gap-2 px-3 py-2 bg-light rounded-pill border" style="border-color:#e2e8f0 !important;">
                        <span class="status-dot pending" style="background:#ca8a04; width:8px; height:8px;"></span>
                        <span class="fw-semibold text-secondary" style="font-size:11px; text-transform:uppercase; letter-spacing:0.5px;">Proses Seleksi Sedang Berjalan</span>
                    </div>
                </div>
            `;
                } else {
                    let hasilHTML = '';
                    let containerBg = 'linear-gradient(135deg, #0d9488 0%, #0f766e 100%)';
                    let containerPadding = 'py-4';

                    if (hasil === 'Lulus') {
                        containerBg = 'linear-gradient(135deg, #0d9488 0%, #115e59 100%)';
                        hasilHTML = `
                    <div class="text-center py-2 text-white animate-in">
                        <i class="bi bi-trophy-fill text-warning mb-2" style="font-size: 26px; display: block;"></i>
                        <h5 class="fw-extrabold mb-1" style="font-size: 15px; letter-spacing: 0.5px; text-shadow: 0 1px 2px rgba(0,0,0,0.15);">SELAMAT! ANDA DINYATAKAN LULUS</h5>
                        <p class="text-white-50 mb-3" style="font-size:11.5px; max-width:520px; margin: 0 auto; line-height: 1.45;">
                            Selamat bergabung di keluarga besar <strong>SMP Al-Amanah</strong>. Anda telah berhasil melewati seluruh rangkaian seleksi penerimaan dengan hasil memuaskan.
                        </p>
                        <span class="badge px-3 py-1.5 fw-bold" style="border-radius:20px; font-size:10px; background-color: #10b981 !important; border: 1px solid rgba(255,255,255,0.2); box-shadow: 0 4px 10px rgba(16,185,129,0.3);"><i class="bi bi-check-circle-fill me-1"></i> LULUS SELEKSI</span>
                    </div>
                `;
                    } else if (hasil === 'Tidak Lulus') {
                        containerBg = '#fee2e2'; // Soft red background
                        containerPadding = 'py-3'; // Smaller compact padding
                        hasilHTML = `
                    <div class="text-center animate-in" style="color: #991b1b;">
                        <i class="bi bi-x-circle-fill text-danger mb-1.5" style="font-size: 22px; display: block;"></i>
                        <h5 class="fw-bold mb-1" style="font-size: 13px; letter-spacing: 0.2px; color: #b91c1c;">MOHON MAAF, ANDA BELUM DINYATAKAN LULUS</h5>
                        <p class="mb-2" style="font-size:10.5px; max-width:480px; margin: 0 auto; line-height: 1.4; color: #7f1d1d; opacity:0.85;">
                            Terima kasih telah mengikuti seleksi PPDB SMP Al-Amanah. Jangan berkecil hati, tetaplah semangat belajar untuk meraih cita-cita Anda.
                        </p>
                        <span class="badge px-3 py-1.5 fw-bold" style="border-radius:20px; font-size:9.5px; background-color: #ef4444 !important; color:#fff !important; box-shadow: 0 2px 6px rgba(239,68,68,0.15); border:none;">BELUM LULUS</span>
                    </div>
                `;
                    } else {
                        containerBg = 'linear-gradient(135deg, #57534e 0%, #44403c 100%)';
                        hasilHTML = `
                    <div class="text-center py-2 text-white animate-in">
                        <i class="bi bi-hourglass-split text-white-50 mb-2" style="font-size: 24px; display: block;"></i>
                        <h5 class="fw-bold mb-1" style="font-size: 14px; letter-spacing: 0.3px;">NILAI UJIAN TELAH DIRILIS</h5>
                        <p class="text-white-50 mb-3" style="font-size:11px; max-width:480px; margin: 0 auto; line-height: 1.45;">
                            Nilai ujian masuk Anda telah dipublikasikan. Keputusan kelulusan akhir saat ini sedang diproses oleh panitia seleksi.
                        </p>
                        <span class="badge bg-warning text-dark px-3 py-1.5 fw-bold" style="border-radius:20px; font-size:10px; background-color: #f59e0b !important;"><i class="bi bi-clock-history me-1"></i> MENUNGGU KELULUSAN</span>
                    </div>
                `;
                    }

                    const scores = [];
                    if (nilai.pai !== undefined && nilai.pai !== null) scores.push(nilai.pai);
                    if (nilai.ind !== undefined && nilai.ind !== null) scores.push(nilai.ind);
                    if (nilai.ipa !== undefined && nilai.ipa !== null) scores.push(nilai.ipa);
                    if (nilai.ips !== undefined && nilai.ips !== null) scores.push(nilai.ips);
                    if (nilai.mat !== undefined && nilai.mat !== null) scores.push(nilai.mat);
                    if (nilai.btq !== undefined && nilai.btq !== null) scores.push(nilai.btq);

                    // Backward compatibility check
                    if (scores.length === 0) {
                        if (nilai.ind !== undefined && nilai.ind !== null) scores.push(nilai.ind);
                        if (nilai.mat !== undefined && nilai.mat !== null) scores.push(nilai.mat);
                        if (nilai.ipa !== undefined && nilai.ipa !== null) scores.push(nilai.ipa);
                        if (nilai.btq !== undefined && nilai.btq !== null) scores.push(nilai.btq);
                        if (nilai.nilai_5 !== undefined && nilai.nilai_5 !== null) scores.push(nilai.nilai_5);
                    }

                    const averageScore = scores.length > 0
                        ? (scores.reduce((a, b) => a + b, 0) / scores.length).toFixed(1)
                        : '0.0';

                    hContent.innerHTML = `
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4 bg-white text-start">
                    <div class="${containerPadding} px-4" style="background: ${containerBg}; border-bottom: 1px solid #f1f5f9;">
                        ${hasilHTML}
                    </div>
                    <div class="p-4">
                        <div class="row g-4 align-items-stretch">
                            <!-- Kolom Kiri: Rincian Nilai -->
                            <div class="col-md-7 border-end" style="border-color: #f1f5f9 !important;">
                                <h5 class="fw-bold mb-4 text-dark" style="font-size:14.5px;"><i class="bi bi-file-earmark-spreadsheet-fill me-1 text-teal"></i> Rincian Nilai Mata Pelajaran</h5>
                                <div class="d-flex flex-column gap-3">
                                    <!-- Pendidik Agama Islam (PAI) -->
                                    <div>
                                        <div class="d-flex justify-content-between mb-1" style="font-size:12.5px;">
                                            <span class="text-secondary fw-medium">Pendidik Agama Islam (PAI)</span>
                                            <span class="fw-bold text-dark">${nilai.pai !== undefined ? nilai.pai : (nilai.nilai_5 !== undefined ? nilai.nilai_5 : 0)} <span class="text-muted" style="font-weight:normal; font-size:10px;">/100</span></span>
                                        </div>
                                        <div class="progress" style="height: 6px; background: #f1f5f9; border-radius: 3px;">
                                            <div class="progress-bar" style="width: ${nilai.pai !== undefined ? nilai.pai : (nilai.nilai_5 !== undefined ? nilai.nilai_5 : 0)}%; background: #0d9488; border-radius: 3px;"></div>
                                        </div>
                                    </div>
                                    <!-- Bahasa Indonesia -->
                                    <div>
                                        <div class="d-flex justify-content-between mb-1" style="font-size:12.5px;">
                                            <span class="text-secondary fw-medium">Bahasa Indonesia</span>
                                            <span class="fw-bold text-dark">${nilai.ind !== undefined ? nilai.ind : 0} <span class="text-muted" style="font-weight:normal; font-size:10px;">/100</span></span>
                                        </div>
                                        <div class="progress" style="height: 6px; background: #f1f5f9; border-radius: 3px;">
                                            <div class="progress-bar" style="width: ${nilai.ind !== undefined ? nilai.ind : 0}%; background: #0d9488; border-radius: 3px;"></div>
                                        </div>
                                    </div>
                                    <!-- IPA -->
                                    <div>
                                        <div class="d-flex justify-content-between mb-1" style="font-size:12.5px;">
                                            <span class="text-secondary fw-medium">IPA</span>
                                            <span class="fw-bold text-dark">${nilai.ipa !== undefined ? nilai.ipa : 0} <span class="text-muted" style="font-weight:normal; font-size:10px;">/100</span></span>
                                        </div>
                                        <div class="progress" style="height: 6px; background: #f1f5f9; border-radius: 3px;">
                                            <div class="progress-bar" style="width: ${nilai.ipa !== undefined ? nilai.ipa : 0}%; background: #0d9488; border-radius: 3px;"></div>
                                        </div>
                                    </div>
                                    <!-- IPS -->
                                    <div>
                                        <div class="d-flex justify-content-between mb-1" style="font-size:12.5px;">
                                            <span class="text-secondary fw-medium">IPS</span>
                                            <span class="fw-bold text-dark">${nilai.ips !== undefined ? nilai.ips : 0} <span class="text-muted" style="font-weight:normal; font-size:10px;">/100</span></span>
                                        </div>
                                        <div class="progress" style="height: 6px; background: #f1f5f9; border-radius: 3px;">
                                            <div class="progress-bar" style="width: ${nilai.ips !== undefined ? nilai.ips : 0}%; background: #0d9488; border-radius: 3px;"></div>
                                        </div>
                                    </div>
                                    <!-- Matematika -->
                                    <div>
                                        <div class="d-flex justify-content-between mb-1" style="font-size:12.5px;">
                                            <span class="text-secondary fw-medium">Matematika</span>
                                            <span class="fw-bold text-dark">${nilai.mat !== undefined ? nilai.mat : 0} <span class="text-muted" style="font-weight:normal; font-size:10px;">/100</span></span>
                                        </div>
                                        <div class="progress" style="height: 6px; background: #f1f5f9; border-radius: 3px;">
                                            <div class="progress-bar" style="width: ${nilai.mat !== undefined ? nilai.mat : 0}%; background: #0d9488; border-radius: 3px;"></div>
                                        </div>
                                    </div>
                                    <!-- Baca Tulis Al-Quran (BTQ) -->
                                    <div>
                                        <div class="d-flex justify-content-between mb-1" style="font-size:12.5px;">
                                            <span class="text-secondary fw-medium">Baca Tulis Al-Quran (BTQ)</span>
                                            <span class="fw-bold text-dark">${nilai.btq !== undefined ? nilai.btq : 0} <span class="text-muted" style="font-weight:normal; font-size:10px;">/100</span></span>
                                        </div>
                                        <div class="progress" style="height: 6px; background: #f1f5f9; border-radius: 3px;">
                                            <div class="progress-bar" style="width: ${nilai.btq !== undefined ? nilai.btq : 0}%; background: #0d9488; border-radius: 3px;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Kolom Kanan: Rata-rata & Info Tambahan -->
                            <div class="col-md-5 d-flex flex-column justify-content-center align-items-center text-center p-3">
                                <div class="p-3 mb-2 rounded-circle d-inline-flex flex-column align-items-center justify-content-center" style="background: #f8fafc; border: 1.5px solid #e2e8f0; width: 140px; height: 140px; box-shadow: 0 4px 10px rgba(0,0,0,0.02);">
                                    <span class="text-secondary fw-bold" style="font-size:10px; text-transform:uppercase; letter-spacing:1px; margin-bottom:4px;">RATA-RATA</span>
                                    <span class="fw-extrabold text-teal" style="font-size: 32px; line-height: 1; color:#0d9488 !important;">${averageScore}</span>
                                </div>
                                <div style="font-size:11.5px; color:#64748b; line-height:1.5; max-width: 220px;" class="mt-2">
                                    Nilai rata-rata minimal kelulusan ditentukan berdasarkan kuota penerimaan dan jalur seleksi yang Anda ikuti.
                                </div>
                            </div>
                        </div>
                        
                        <div class="border-top pt-3 mt-4 text-start">
                            <p class="text-muted mb-0" style="font-size:11px; line-height:1.5;">
                                * Nilai di atas diinput langsung oleh Panitia PPDB SMP Al-Amanah berdasarkan hasil tes tertulis &amp; lisan Anda. Keputusan kelulusan bersifat mutlak.
                            </p>
                        </div>
                    </div>
                </div>
            `;
                }
            }

            // Admin notification banners
            renderAdminBanners(state);

            // Call updateCetakKartuUI to ensure printable card checks are always dynamically updated
            updateCetakKartuUI();
        }

        function renderAdminBanners(state) {
            const container = document.getElementById('adminNotifBanners');
            if (!container) return;
            container.innerHTML = '';

            if (state.statusFormulirAdmin === 'Perlu Revisi' || state.statusFormulirAdmin === 'Belum Valid' || state.statusFormulirAdmin === 'Ditolak') {
                const title = state.statusFormulirAdmin === 'Ditolak' ? 'Formulir Ditolak' : 'Formulir Perlu Diperbaiki';
                const colorClass = state.statusFormulirAdmin === 'Ditolak' ? 'color:#b91c1c;' : 'color:#7f1d1d;';
                container.innerHTML += `
        <div class="alert-banner error mb-2">
            <span><i class="bi bi-file-earmark-text-fill text-danger" style="font-size:20px;"></i></span>
            <div style="flex:1;">
                <div class="fw-bold" style="font-size:13px; ${colorClass}">${title}</div>
                <div style="font-size:11.5px;color:#991b1b;margin-top:3px;">${state.catatanFormulirAdmin || 'Admin meminta perbaikan pada formulir Anda.'}</div>
                <button class="btn btn-sm btn-danger mt-2 fw-bold" onclick="switchSection('Formulir')" style="border-radius:20px;font-size:11px;padding:4px 12px;">Edit Formulir Sekarang</button>
            </div>
        </div>`;
            }

            if (state.statusBerkasAdmin === 'Perlu Revisi' || state.statusBerkasAdmin === 'Belum Valid' || state.statusBerkasAdmin === 'Ditolak') {
                const title = state.statusBerkasAdmin === 'Ditolak' ? 'Berkas Ditolak' : 'Berkas Perlu Diperbaiki';
                const colorClass = state.statusBerkasAdmin === 'Ditolak' ? 'color:#b91c1c;' : 'color:#7f1d1d;';
                container.innerHTML += `
        <div class="alert-banner error mb-2">
            <span><i class="bi bi-folder-fill text-danger" style="font-size:20px;"></i></span>
            <div style="flex:1;">
                <div class="fw-bold" style="font-size:13px; ${colorClass}">${title}</div>
                <div style="font-size:11.5px;color:#991b1b;margin-top:3px;">${state.catatanBerkasAdmin || 'Admin meminta perbaikan pada berkas Anda.'}</div>
                <button class="btn btn-sm btn-danger mt-2 fw-bold" onclick="switchSection('UploadBerkas')" style="border-radius:20px;font-size:11px;padding:4px 12px;">Perbaiki Berkas Sekarang</button>
            </div>
        </div>`;
            }

            const formOK = state.statusFormulirAdmin === 'Disetujui';
            const berkasOK = state.statusBerkasAdmin === 'Disetujui';
            const bayarOK = state.statusPembayaran === 'Lunas';
            if (formOK && berkasOK && bayarOK) {
                container.innerHTML += `
        <div class="alert-banner success mb-2" style="animation:pulse 2s infinite;">
            <span><i class="bi bi-patch-check-fill text-success" style="font-size:22px;"></i></span>
            <div style="flex:1;">
                <div class="fw-bold" style="font-size:13.5px;color:#166534;">Selamat! Semua Persyaratan Disetujui &amp; Pembayaran Dikonfirmasi</div>
                <div style="font-size:12px;color:#166534;margin-top:3px;">Formulir, berkas, dan pembayaran telah dikonfirmasi. Akses cetak kartu ujian terbuka!</div>
                <button class="btn btn-sm btn-success mt-2 fw-bold" onclick="switchSection('CetakKartu')" style="border-radius:20px;font-size:11px;padding:4px 14px;border:none;background:#16a34a;color:#fff;"><i class="bi bi-printer-fill me-1"></i> Cetak Kartu Ujian</button>
            </div>
        </div>`;
            } else if (formOK && berkasOK && !bayarOK) {
                container.innerHTML += `
        <div class="alert-banner warning mb-2">
            <span><i class="bi bi-credit-card-2-back-fill text-warning" style="font-size:20px;"></i></span>
            <div>
                <div class="fw-bold" style="font-size:13px;color:#78350f;">Formulir &amp; Berkas Disetujui — Menunggu Pembayaran</div>
                <div style="font-size:11.5px;color:#92400e;margin-top:3px;">Segera lakukan pembayaran dan tunggu konfirmasi dari Admin untuk membuka kartu ujian.</div>
                <button class="btn btn-sm btn-warning mt-2 fw-semibold" onclick="switchSection('Pembayaran')" style="border-radius:20px;font-size:11px;padding:4px 12px;"><i class="bi bi-credit-card-2-back-fill me-1"></i> Lihat Pembayaran</button>
            </div>
        </div>`;
            } else if (formOK && !berkasOK) {
                container.innerHTML += `
        <div class="alert-banner info mb-2">
            <span><i class="bi bi-check-circle-fill text-info" style="font-size:20px;"></i></span>
            <div>
                <div class="fw-bold" style="font-size:13px;color:#1e40af;">Formulir Disetujui!</div>
                <div style="font-size:11.5px;color:#1e40af;margin-top:3px;">Formulir Anda sudah disetujui. Segera upload berkas untuk melanjutkan.</div>
            </div>
        </div>`;
            }

            if (state.statusFormulir === 'Terkirim' && state.statusFormulirAdmin === 'Menunggu') {
                container.innerHTML += `
        <div class="alert-banner warning mb-2">
            <span style="font-size:20px;">⏳</span>
            <div>
                <div class="fw-bold" style="font-size:13px;color:#78350f;">Formulir Sedang Diverifikasi</div>
                <div style="font-size:11.5px;color:#92400e;margin-top:3px;">Formulir Anda sedang diperiksa oleh Panitia PPDB. Mohon menunggu.</div>
            </div>
        </div>`;
            }

            if (state.statusBerkas === 'Terkirim' && state.statusBerkasAdmin === 'Menunggu') {
                container.innerHTML += `
        <div class="alert-banner warning mb-2">
            <span style="font-size:20px;">⏳</span>
            <div>
                <div class="fw-bold" style="font-size:13px;color:#78350f;">Berkas Sedang Diverifikasi</div>
                <div style="font-size:11.5px;color:#92400e;margin-top:3px;">Berkas Anda sedang diperiksa oleh Panitia PPDB. Mohon menunggu.</div>
            </div>
        </div>`;
            }
        }

        // ==================== NOTIFICATION PANEL ====================
        function toggleNotifPanel() {
            notifPanelOpen = !notifPanelOpen;
            const panel = document.getElementById('notifPanel');
            if (panel) panel.classList.toggle('show', notifPanelOpen);
        }

        function renderNotifPanel() {
            const notifs = getNotifs();
            const list = document.getElementById('notifList');
            const empty = document.getElementById('notifEmpty');
            const badge = document.getElementById('notifCountBadge');

            const unread = notifs.filter(n => !n.dibaca).length;
            if (badge) {
                badge.textContent = unread;
                badge.classList.toggle('show', unread > 0);
            }

            if (!list) return;
            const unreadNotifs = notifs.filter(n => !n.dibaca);
            const readNotifs = notifs.filter(n => n.dibaca);
            const displayed = [...unreadNotifs, ...readNotifs].slice(0, 10);

            if (displayed.length === 0) {
                list.innerHTML = '<div class="text-center py-4 text-muted" style="font-size:12.5px;"><span style="font-size:24px;display:block;margin-bottom:6px;"><i class="bi bi-bell-slash text-muted" style="font-size: 24px;"></i></span>Belum ada notifikasi</div>';
                return;
            }

            const iconMap = {
                formulir_terkirim: '<i class="bi bi-file-earmark-text text-primary"></i>',
                formulir_disetujui: '<i class="bi bi-check-circle-fill text-success"></i>',
                formulir_ditolak: '<i class="bi bi-x-circle-fill text-danger"></i>',
                berkas_terkirim: '<i class="bi bi-folder-fill text-warning"></i>',
                berkas_disetujui: '<i class="bi bi-check-circle-fill text-success"></i>',
                berkas_ditolak: '<i class="bi bi-x-circle-fill text-danger"></i>',
                kartu_terbuka: '<i class="bi bi-patch-check-fill text-success"></i>',
                pembayaran: '<i class="bi bi-credit-card-fill text-primary"></i>',
                hasil_seleksi: '<i class="bi bi-patch-check-fill text-success"></i>',
                nilai_ujian: '<i class="bi bi-journal-check text-teal"></i>'
            };

            list.innerHTML = displayed.map(n => `
        <div class="notif-item ${n.dibaca ? '' : 'unread'}" onclick="readNotif(${n.id})">
            <div class="d-flex gap-2">
                <span style="font-size:18px;flex-shrink:0;">${n.emoji || iconMap[n.tipe] || '<i class="bi bi-bell text-secondary"></i>'}</span>
                <div>
                    <div style="font-size:12px;font-weight:${n.dibaca ? '500' : '600'};color:${n.dibaca ? '#64748b' : '#1e293b'};">${n.pesan}</div>
                    <div style="font-size:10.5px;color:#94a3b8;margin-top:2px;">${n.waktu}</div>
                </div>
            </div>
        </div>
    `).join('');
        }

        function readNotif(id) {
            const notifs = getNotifs();
            const notif = notifs.find(n => n.id == id);
            if (!notif) return;

            notif.dibaca = true;
            localStorage.setItem(NOTIF_KEY, JSON.stringify(notifs));
            renderNotifPanel();

            notifPanelOpen = false;
            const panel = document.getElementById('notifPanel');
            if (panel) panel.classList.remove('show');

            // Route to corresponding section based on notification type
            const typeSectionMap = {
                'pilih_jalur': 'PilihJalur',
                'formulir_terkirim': 'Formulir',
                'formulir_disetujui': 'Formulir',
                'formulir_ditolak': 'Formulir',
                'berkas_terkirim': 'UploadBerkas',
                'berkas_disetujui': 'UploadBerkas',
                'berkas_ditolak': 'UploadBerkas',
                'kartu_terbuka': 'CetakKartu',
                'pembayaran': 'Pembayaran',
                'hasil_seleksi': 'HasilSeleksi',
                'nilai_ujian': 'HasilSeleksi'
            };

            const targetSection = typeSectionMap[notif.tipe];
            if (targetSection) {
                switchSection(targetSection);
            }
        }

        // ==================== ADMIN SYNC (SHARED STATE) ====================
        function syncToAdminPanel() {
            const state = getState();
            // Get or init admin state
            let adminState = {};
            try { adminState = JSON.parse(localStorage.getItem(ADMIN_STATE_KEY)) || {}; } catch (e) { adminState = {}; }

            const pendaftar = adminState.pendaftar || [];
            const existing = pendaftar.find(p => p.id === SISWA_ID);

            const record = {
                id: SISWA_ID,
                nama: SISWA_NAME,
                email: '{{ $siswa->email }}',
                jalur: state.jalur || '',
                statusFormulir: state.statusFormulir || 'Belum',
                statusFormulirAdmin: state.statusFormulirAdmin || 'Menunggu',
                catatanFormulirAdmin: state.catatanFormulirAdmin || '',
                statusBerkas: state.statusBerkas || 'Belum',
                statusBerkasAdmin: state.statusBerkasAdmin || 'Menunggu',
                catatanBerkasAdmin: state.catatanBerkasAdmin || '',
                uploadedFiles: state.uploadedFiles || {},
                formData: state.formData || {},
                statusPembayaran: state.statusPembayaran || 'Belum Bayar',
                catatanPembayaran: state.catatanPembayaran || (existing ? existing.catatanPembayaran : ''),
                buktiTransferManual: state.buktiTransferManual || (existing ? existing.buktiTransferManual : ''),
                namaPengirim: state.namaPengirim || (existing ? existing.namaPengirim : ''),
                noUrut: state.noUrut || ('REG-2026-' + String(SISWA_ID).padStart(3, '0')),
                tanggalDaftar: state.tanggalDaftar || new Date().toLocaleDateString('id-ID'),

                // Preserve admin-controlled fields
                nilaiUjian: state.nilaiUjian || (existing ? existing.nilaiUjian : null),
                hasilSeleksi: state.hasilSeleksi || (existing ? existing.hasilSeleksi : '')
            };

            if (existing) {
                const idx = pendaftar.indexOf(existing);
                pendaftar[idx] = record;
            } else {
                pendaftar.push(record);
            }

            adminState.pendaftar = pendaftar;
            adminState.lastUpdated = Date.now();
            localStorage.setItem(ADMIN_STATE_KEY, JSON.stringify(adminState));
        }

        function pollAdminDecisions() {
            let adminState = {};
            try { adminState = JSON.parse(localStorage.getItem(ADMIN_STATE_KEY)) || {}; } catch (e) { return; }

            const pendaftar = adminState.pendaftar || [];
            const record = pendaftar.find(p => p.id === SISWA_ID);
            if (!record) return;

            const state = getState();
            let changed = false;

            // Check formulir admin decision
            if (record.statusFormulirAdmin && record.statusFormulirAdmin !== state.statusFormulirAdmin) {
                setState({ statusFormulirAdmin: record.statusFormulirAdmin, catatanFormulirAdmin: record.catatanFormulirAdmin || '' });
                changed = true;
                if (record.statusFormulirAdmin === 'Disetujui') {
                    addNotif({ tipe: 'formulir_disetujui', pesan: 'Formulir pendaftaran Anda telah DISETUJUI oleh Panitia PPDB! Silakan upload berkas.', emoji: '<i class="bi bi-check-circle-fill text-success"></i>' });
                } else if (record.statusFormulirAdmin === 'Perlu Revisi' || record.statusFormulirAdmin === 'Belum Valid') {
                    addNotif({ tipe: 'formulir_ditolak', pesan: 'Formulir Anda ditandai BELUM VALID: ' + (record.catatanFormulirAdmin || 'Silakan cek catatan admin.'), emoji: '<i class="bi bi-exclamation-triangle-fill text-warning"></i>' });
                } else if (record.statusFormulirAdmin === 'Ditolak') {
                    addNotif({ tipe: 'formulir_ditolak', pesan: 'Formulir pendaftaran Anda DITOLAK: ' + (record.catatanFormulirAdmin || 'Silakan hubungi panitia.'), emoji: '<i class="bi bi-x-circle-fill text-danger"></i>' });
                }
            }

            // Check berkas admin decision
            if (record.statusBerkasAdmin && record.statusBerkasAdmin !== state.statusBerkasAdmin) {
                setState({ statusBerkasAdmin: record.statusBerkasAdmin, catatanBerkasAdmin: record.catatanBerkasAdmin || '' });
                changed = true;
                if (record.statusBerkasAdmin === 'Disetujui') {
                    addNotif({ tipe: 'berkas_disetujui', pesan: 'Berkas Anda telah DISETUJUI! Akses cetak kartu ujian kini terbuka.', emoji: '<i class="bi bi-patch-check-fill text-success"></i>' });
                } else if (record.statusBerkasAdmin === 'Perlu Revisi' || record.statusBerkasAdmin === 'Belum Valid') {
                    addNotif({ tipe: 'berkas_ditolak', pesan: 'Berkas Anda ditandai BELUM VALID: ' + (record.catatanBerkasAdmin || 'Silakan cek catatan admin.'), emoji: '<i class="bi bi-exclamation-triangle-fill text-warning"></i>' });
                } else if (record.statusBerkasAdmin === 'Ditolak') {
                    addNotif({ tipe: 'berkas_ditolak', pesan: 'Berkas pendaftaran Anda DITOLAK: ' + (record.catatanBerkasAdmin || 'Silakan hubungi panitia.'), emoji: '<i class="bi bi-x-circle-fill text-danger"></i>' });
                }
            }

            // Check pembayaran dikonfirmasi admin
            if ((record.statusPembayaran && record.statusPembayaran !== state.statusPembayaran) ||
                (record.catatanPembayaran !== undefined && record.catatanPembayaran !== state.catatanPembayaran) ||
                (record.namaPengirim !== undefined && record.namaPengirim !== state.namaPengirim)) {
                setState({
                    statusPembayaran: record.statusPembayaran,
                    catatanPembayaran: record.catatanPembayaran || '',
                    buktiTransferManual: record.buktiTransferManual || '',
                    namaPengirim: record.namaPengirim || ''
                });
                changed = true;
                if (record.statusPembayaran === 'Lunas') {
                    addNotif({ tipe: 'pembayaran', pesan: 'Pembayaran dikonfirmasi oleh Admin! Akses cetak kartu ujian terbuka.', emoji: '<i class="bi bi-patch-check-fill text-success"></i>' });
                } else if (record.statusPembayaran === 'Belum Bayar' && record.catatanPembayaran) {
                    addNotif({ tipe: 'pembayaran', pesan: 'Pembayaran Anda ditolak admin: ' + record.catatanPembayaran, emoji: '<i class="bi bi-exclamation-triangle-fill text-danger"></i>' });
                }
            }

            // Check hasil seleksi admin decision
            if (record.hasilSeleksi !== undefined && record.hasilSeleksi !== state.hasilSeleksi) {
                setState({ hasilSeleksi: record.hasilSeleksi || '' });
                changed = true;
                if (record.hasilSeleksi === 'Lulus') {
                    addNotif({ tipe: 'hasil_seleksi', pesan: 'Selamat! Anda dinyatakan LULUS seleksi PPDB SMP Al-Amanah.', emoji: '<i class="bi bi-patch-check-fill text-success"></i>' });
                } else if (record.hasilSeleksi === 'Tidak Lulus') {
                    addNotif({ tipe: 'hasil_seleksi', pesan: 'Mohon maaf, Anda dinyatakan TIDAK LULUS seleksi PPDB SMP Al-Amanah.', emoji: '<i class="bi bi-x-circle-fill text-danger"></i>' });
                }
            }

            // Check nilai ujian admin decision
            const nilaiRecordStr = JSON.stringify(record.nilaiUjian || null);
            const nilaiStateStr = JSON.stringify(state.nilaiUjian || null);
            if (nilaiRecordStr !== nilaiStateStr) {
                setState({ nilaiUjian: record.nilaiUjian || null });
                changed = true;
                addNotif({ tipe: 'nilai_ujian', pesan: 'Nilai ujian masuk Anda telah dipublikasikan oleh panitia.', emoji: '<i class="bi bi-journal-check text-teal"></i>' });
            }

            if (changed) updateDashboardUI();
        }

        // ==================== POPUP HELPERS ====================
        function showPopup(icon, title, message, bg, color) {
            const modal = document.getElementById('statusPopupModal');
            const ic = document.getElementById('spIconContainer');
            const is = document.getElementById('spIconSymbol');
            const ti = document.getElementById('spTitle');
            const ms = document.getElementById('spMessage');
            if (modal) { modal.style.display = 'flex'; }
            if (ic) { ic.style.background = bg; ic.style.borderColor = color; }
            if (is) { is.innerHTML = icon; is.style.color = color; }
            if (ti) { ti.textContent = title; ti.style.color = '#0f766e'; }
            if (ms) { ms.innerHTML = message; }
        }
        function closeStatusPopup() {
            const modal = document.getElementById('statusPopupModal');
            if (modal) modal.style.display = 'none';
        }

        // ==================== MIDTRANS INTEGRATION ====================
        function openMidtransModal(method, btnElement) {
            // Tampilkan loading state pada tombol
            const btnText = btnElement.innerHTML;
            btnElement.innerHTML = '<i class="spinner-border spinner-border-sm me-2"></i> Memproses...';
            btnElement.disabled = true;

            fetch('{{ route('payment.pay') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
                .then(response => response.json())
                .then(data => {
                    // Kembalikan state tombol
                    btnElement.innerHTML = btnText;
                    btnElement.disabled = false;

                    if (data.snap_token) {
                        // Trigger Snap Popup
                        window.snap.pay(data.snap_token, {
                            onSuccess: function (result) {
                                // Panggil route success untuk log/simulasi di backend (tanpa mengubah status pembayaran langsung)
                                fetch('{{ route('payment.success') }}', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                    }
                                }).then(() => {
                                    addNotif({ tipe: 'pembayaran', pesan: 'Pembayaran Midtrans berhasil diproses. Selesaikan verifikasi dengan mengunggah bukti pembayaran di bawah ini.', emoji: '<i class="bi bi-info-circle-fill text-info"></i>' });
                                    alert('Pembayaran berhasil diproses oleh Midtrans!\n\nHarap lengkapi verifikasi dengan mengunggah bukti transfer manual (screenshot/PDF/foto) dan mengisi nama pengirim pada form di bawah ini agar panitia dapat memverifikasi pembayaran Anda.');
                                    setTimeout(() => { window.location.reload(); }, 1000);
                                }).catch(() => {
                                    window.location.reload();
                                });
                            },
                            onPending: function (result) {
                                fetch('{{ route('payment.success') }}', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                    }
                                }).then(() => {
                                    addNotif({ tipe: 'pembayaran', pesan: 'Menunggu penyelesaian pembayaran Midtrans. Unggah bukti pembayaran Anda setelah selesai.', emoji: '<i class="bi bi-clock-history text-warning"></i>' });
                                    alert('Transaksi pembayaran Midtrans dibuat!\n\nSetelah Anda menyelesaikan pembayaran, silakan unggah bukti transaksi Anda di form di bawah ini.');
                                    setTimeout(() => { window.location.reload(); }, 1000);
                                }).catch(() => {
                                    window.location.reload();
                                });
                            },
                            onError: function (result) {
                                addNotif({ tipe: 'pembayaran', pesan: 'Pembayaran gagal.', emoji: '<i class="bi bi-x-circle-fill text-danger"></i>' });
                            },
                            onClose: function () {
                                // Jika ditutup, muat ulang halaman untuk mengecek status terbaru dari Webhook
                                window.location.reload();
                            }
                        });
                    } else if (data.error) {
                        alert('Error: ' + data.error);
                    }
                })
                .catch(error => {
                    btnElement.innerHTML = btnText;
                    btnElement.disabled = false;
                    alert('Terjadi kesalahan koneksi saat memproses pembayaran.');
                    console.error(error);
                });
        }

        // ==================== MANUAL PAYMENT INTEGRATION ====================
        function submitManualPayment(event) {
            event.preventDefault();

            const nameInput = document.getElementById('buktiNamaPengirim');
            if (!nameInput || !nameInput.value.trim()) {
                alert('Harap isi nama pengirim terlebih dahulu.');
                return;
            }
            const namaPengirim = nameInput.value.trim();

            const fileInput = document.getElementById('buktiTransferFile');
            if (!fileInput || fileInput.files.length === 0) {
                alert('Harap pilih file bukti transfer terlebih dahulu.');
                return;
            }
            const file = fileInput.files[0];
            if (file.size > 2 * 1024 * 1024) {
                alert('Ukuran file maksimal adalah 2MB.');
                return;
            }

            const btn = document.getElementById('btnSubmitManualPayment');
            const originalText = btn.innerHTML;
            btn.innerHTML = '<i class="spinner-border spinner-border-sm me-2"></i> Mengirim...';
            btn.disabled = true;

            const formData = new FormData();
            formData.append('bukti_transfer', file);
            formData.append('nama_pengirim', namaPengirim);

            fetch('{{ route('payment.upload-bukti') }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: formData
            })
                .then(res => res.json())
                .then(data => {
                    btn.innerHTML = originalText;
                    btn.disabled = false;

                    if (data.success) {
                        // Save file locally to IndexedDB for offline simulation view by admin
                        saveFileDB(SISWA_ID + '_BuktiTransfer', file, file.name, file.type)
                            .then(() => {
                                const state = getState();
                                const uploadedFiles = state.uploadedFiles || {};
                                uploadedFiles.BuktiTransfer = { name: file.name, mime: file.type, size: file.size };

                                setState({
                                    statusPembayaran: 'Menunggu Konfirmasi',
                                    catatanPembayaran: '',
                                    buktiTransferManual: data.bukti_transfer_manual,
                                    namaPengirim: data.nama_pengirim || namaPengirim,
                                    uploadedFiles: uploadedFiles
                                });

                                syncToAdminPanel();

                                showPopup('<i class="bi bi-check-circle-fill fs-3 text-success"></i>', 'Bukti Transfer Dikirim!', 'Bukti transfer Anda telah berhasil diunggah dan sedang diproses verifikasi oleh Admin.', '#dcfce7', '#16a34a');

                                setTimeout(() => {
                                    closeStatusPopup();
                                    window.location.reload();
                                }, 2000);
                            })
                            .catch(err => {
                                console.error(err);
                                alert('Gagal memproses berkas bukti transfer lokal.');
                            });
                    } else {
                        alert('Gagal mengunggah bukti: ' + (data.error || 'Terjadi kesalahan'));
                    }
                })
                .catch(err => {
                    btn.innerHTML = originalText;
                    btn.disabled = false;
                    console.error(err);
                    alert('Terjadi kesalahan koneksi saat mengunggah bukti transfer.');
                });
        }

        function previewBuktiPembayaran() {
            getFileDB(SISWA_ID + '_BuktiTransfer').then(entry => {
                if (!entry || !entry.fileBlob) {
                    // Fallback to Server Upload Path
                    const state = getState();
                    const manualPath = state.buktiTransferManual;
                    if (manualPath) {
                        window.open('/' + manualPath, '_blank');
                    } else {
                        alert('Bukti transfer tidak ditemukan.');
                    }
                    return;
                }
                const url = URL.createObjectURL(entry.fileBlob);
                const newTab = window.open();
                if (!newTab) {
                    alert('Pop-up diblokir. Izinkan pop-up untuk melihat bukti.');
                    return;
                }
                if (entry.mime === 'application/pdf') {
                    newTab.document.write('<html><head><title>Bukti Pembayaran</title></head><body style="margin:0;"><embed src="' + url + '" type="application/pdf" width="100%" height="100%" style="height:100vh;border:none;"/></body></html>');
                } else {
                    newTab.document.write('<html><head><title>Bukti Pembayaran</title></head><body style="margin:0;background:#1a1a2e;display:flex;align-items:center;justify-content:center;min-height:100vh;"><img src="' + url + '" style="max-width:100%;max-height:100vh;object-fit:contain;box-shadow:0 4px 30px rgba(0,0,0,0.5);"/></body></html>');
                }
                newTab.document.close();
            }).catch(err => {
                console.error(err);
                alert('Gagal membuka bukti pembayaran.');
            });
        }

        // ==================== CETAK KARTU PDF (A4) ====================
        function printApplicationCard() {
            const element = document.getElementById('printAreaKartu');
            if (!element) return;

            const nama = document.getElementById('cardNama')?.textContent || 'Peserta';
            const noDaftar = document.getElementById('cardNoDaftar')?.textContent || '-';
            const nisn = document.getElementById('cardNISN')?.textContent || '-';
            const jalur = document.getElementById('cardJalur')?.textContent || '-';
            const asal = document.getElementById('cardAsal')?.textContent || '-';
            const tanggal = document.getElementById('cardTanggalUjian')?.textContent || '-';
            const photoImg = document.getElementById('cardPhotoImg');
            const photoSrc = (photoImg && photoImg.style.display !== 'none' && photoImg.src) ? photoImg.src : '';
            const logoSrc = document.getElementById('kopLogoImg')?.src || '';

            // HTML format surat resmi A4 (seperti surat keterangan sekolah)
            const suratHTML = `
    <div style="width:210mm;min-height:297mm;background:#ffffff;font-family:'Times New Roman',serif;color:#000000;box-sizing:border-box;padding:15mm 20mm 15mm 20mm;">

        <!-- KOP SURAT: Logo kiri + Teks kanan -->
        <div style="display:flex;align-items:center;gap:16px;padding-bottom:10px;">
            <img src="${logoSrc}" style="width:90px;height:90px;object-fit:contain;flex-shrink:0;" crossorigin="anonymous">
            <div style="flex:1;text-align:center;line-height:1.4;">
                <div style="font-size:10pt;font-weight:400;color:#1a1a1a;text-transform:uppercase;letter-spacing:0.5px;">YAYASAN PENDIDIKAN DAN PONDOK PESANTREN AL AMANAH AL BANTANI</div>
                <div style="font-size:8.5pt;color:#444;margin-top:1px;">Akta Notaris SK. MENKUMHAM No. AHU-06738.50.10.2014</div>
                <div style="font-size:28pt;font-weight:700;color:#15803d;letter-spacing:2px;margin:3px 0 1px;line-height:1.1;font-family:'Arial Black',Arial,sans-serif;">SMP AL AMANAH</div>
                <div style="font-size:9pt;color:#1a1a1a;font-weight:600;margin-top:1px;">NSS: 202280324002 &nbsp;|&nbsp; NPSN: 20603598 &nbsp;|&nbsp; NDS: 2002040072</div>
                <div style="font-size:8.5pt;color:#444;margin-top:2px;">Jl. Raya Puspiptek Pocis, Setu, Kota Tangerang Selatan, Banten 15314</div>
                <div style="font-size:8.5pt;color:#444;">Telp. (021) 7560 783 &nbsp;|&nbsp; Email: smp.alamanah@yahoo.com</div>
            </div>
        </div>

        <!-- GARIS KOP (tebal + tipis) -->
        <div style="border-top:4px solid #000000;margin-top:2px;"></div>
        <div style="border-top:1.5px solid #000000;margin-top:2px;margin-bottom:12px;"></div>

        <!-- JUDUL KARTU (bergaris bawah, seperti surat resmi) -->
        <div style="text-align:center;margin-bottom:16px;">
            <div style="font-size:14pt;font-weight:700;color:#000000;letter-spacing:2px;text-transform:uppercase;text-decoration:underline;font-family:'Arial',sans-serif;">KARTU PESERTA UJIAN MASUK</div>
            <div style="font-size:10pt;color:#000000;margin-top:3px;font-weight:400;">Tahun Pelajaran 2026/2027</div>
        </div>

        <!-- IDENTITAS PESERTA + FOTO -->
        <div style="display:flex;gap:20px;align-items:flex-start;margin-bottom:20px;">

            <!-- Tabel Data Peserta -->
            <div style="flex:1;">
                <table style="width:100%;border-collapse:collapse;font-size:11pt;line-height:1.9;">
                    <tr>
                        <td style="width:36%;padding:2px 0;vertical-align:top;font-weight:400;color:#000;">Nama Lengkap</td>
                        <td style="width:4px;vertical-align:top;padding:2px 4px;">:</td>
                        <td style="padding:2px 0;font-weight:700;color:#000;">${nama.toUpperCase()}</td>
                    </tr>
                    <tr>
                        <td style="padding:2px 0;vertical-align:top;font-weight:400;color:#000;">No. Peserta</td>
                        <td style="vertical-align:top;padding:2px 4px;">:</td>
                        <td style="padding:2px 0;font-weight:700;color:#15803d;">${noDaftar}</td>
                    </tr>
                    <tr>
                        <td style="padding:2px 0;vertical-align:top;font-weight:400;color:#000;">NISN</td>
                        <td style="vertical-align:top;padding:2px 4px;">:</td>
                        <td style="padding:2px 0;font-weight:400;color:#000;">${nisn}</td>
                    </tr>
                    <tr>
                        <td style="padding:2px 0;vertical-align:top;font-weight:400;color:#000;">Jalur</td>
                        <td style="vertical-align:top;padding:2px 4px;">:</td>
                        <td style="padding:2px 0;font-weight:400;color:#000;">${jalur}</td>
                    </tr>
                    <tr>
                        <td style="padding:2px 0;vertical-align:top;font-weight:400;color:#000;">Asal Sekolah</td>
                        <td style="vertical-align:top;padding:2px 4px;">:</td>
                        <td style="padding:2px 0;font-weight:400;color:#000;">${asal}</td>
                    </tr>
                    <tr>
                        <td style="padding:2px 0;vertical-align:top;font-weight:400;color:#000;">Tanggal Ujian</td>
                        <td style="vertical-align:top;padding:2px 4px;">:</td>
                        <td style="padding:2px 0;font-weight:700;color:#15803d;">${tanggal}</td>
                    </tr>
                </table>
            </div>

            <!-- Foto Siswa 3x4 -->
            <div style="flex-shrink:0;text-align:center;">
                <div style="width:105px;height:140px;border:2px solid #000000;overflow:hidden;background:#f3f4f6;display:flex;align-items:center;justify-content:center;">
                    ${photoSrc
                    ? `<img src="${photoSrc}" style="width:100%;height:100%;object-fit:cover;" crossorigin="anonymous">`
                    : `<div style="text-align:center;color:#9ca3af;font-size:9pt;font-weight:600;line-height:1.6;font-family:Arial,sans-serif;">PAS<br>FOTO<br>3&times;4</div>`
                }
                </div>
                <div style="font-size:8pt;color:#374151;margin-top:4px;font-family:Arial,sans-serif;">Foto Peserta</div>
            </div>
        </div>

        <!-- GARIS PEMISAH -->
        <div style="border-top:1px solid #000000;margin-bottom:12px;"></div>

        <!-- CATATAN PENTING -->
        <div style="margin-bottom:16px;">
            <div style="font-size:10pt;font-weight:700;color:#000000;margin-bottom:5px;">Catatan Penting:</div>
            <div style="font-size:10pt;color:#000000;line-height:1.8;">
                <div>1. Kartu ini wajib dibawa saat ujian masuk.</div>
                <div>2. Hadir paling lambat 30 menit sebelum ujian dimulai.</div>
                <div>3. Berpakaian rapi sesuai seragam SD/MI asal.</div>
                <div>4. Dilarang membawa perangkat elektronik ke dalam ruang ujian.</div>
            </div>
        </div>

        <!-- KETERANGAN KEASLIAN -->
        <div style="border-top:1px dashed #888;padding-top:10px;text-align:center;">
            <div style="display:inline-block;border:1px solid #15803d;padding:5px 20px;font-size:9pt;font-style:italic;color:#15803d;font-family:Arial,sans-serif;">
                Kartu ini sah sebagai tanda peserta ujian masuk PPDB SMP Al Amanah Tahun Pelajaran 2026/2027
            </div>
        </div>

    </div>
    `;

            const wrapper = document.createElement('div');
            wrapper.innerHTML = suratHTML;
            wrapper.style.cssText = 'position:absolute;top:-9999px;left:-9999px;';
            document.body.appendChild(wrapper);

            const opt = {
                margin: 0,
                filename: 'Kartu Ujian PPDB - ' + nama + '.pdf',
                image: { type: 'jpeg', quality: 1.0 },
                html2canvas: { scale: 3, useCORS: true, allowTaint: true, letterRendering: true, backgroundColor: '#ffffff' },
                jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
            };
            html2pdf().set(opt).from(wrapper.firstElementChild).save().then(() => {
                document.body.removeChild(wrapper);
            });
        }

        async function loadBerkasFromIndexedDB() {
            const state = getState();
            const uploaded = state.uploadedFiles || {};
            for (const type of Object.keys(uploaded)) {
                try {
                    const entry = await getFileDB(SISWA_ID + '_' + type);
                    if (entry && entry.fileBlob) {
                        const objectUrl = URL.createObjectURL(entry.fileBlob);
                        _berkasFileMap.set(type, { file: entry.fileBlob, objectUrl, name: entry.name, mime: entry.mime });
                        markBerkasUploaded(type, true);

                        if (type === 'Foto') {
                            const img = document.getElementById('cardPhotoImg');
                            const ph = document.getElementById('cardPhotoPlaceholder');
                            if (img) { img.src = objectUrl; img.style.display = 'block'; }
                            if (ph) ph.style.display = 'none';
                        }
                    }
                } catch (e) {
                    console.error('Error loading file from IndexedDB:', e);
                }
            }
        }

        // ==================== INIT ====================
        document.addEventListener('click', function (e) {
            const panel = document.getElementById('notifPanel');
            const btn = document.getElementById('btnNotif');
            if (panel && btn && !panel.contains(e.target) && !btn.contains(e.target)) {
                notifPanelOpen = false;
                panel.classList.remove('show');
            }
        });

        window.addEventListener('load', function () {
            // Restore jalur selection UI if already chosen
            const state = getState();
            if (state.jalur) {
                selectedJalur = state.jalur;
                const card = document.getElementById('cardJalur' + state.jalur);
                if (card) card.classList.add('selected');
            }

            updateDashboardUI();
            renderNotifPanel();
            syncToAdminPanel();
            loadBerkasFromIndexedDB();

            // Poll admin decisions every 3 seconds
            setInterval(() => { pollAdminDecisions(); }, 3000);
        });
    </script>

    <style>
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(15px);
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

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.75;
            }
        }
    </style>

    <script>
        // ===== MOBILE SIDEBAR TOGGLE =====
        function toggleSidebarMobile() {
            const sidebar = document.querySelector('.sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            sidebar.classList.toggle('open');
            overlay.classList.toggle('active');
            document.body.style.overflow = sidebar.classList.contains('open') ? 'hidden' : '';
        }

        function closeSidebarMobile() {
            const sidebar = document.querySelector('.sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            sidebar.classList.remove('open');
            overlay.classList.remove('active');
            document.body.style.overflow = '';
        }

        // Tutup sidebar mobile saat menu diklik
        document.addEventListener('DOMContentLoaded', function () {
            const menuItems = document.querySelectorAll('.sidebar-menu-item');
            menuItems.forEach(function (item) {
                item.addEventListener('click', function () {
                    if (window.innerWidth <= 768) {
                        closeSidebarMobile();
                    }
                });
            });

            // Tutup sidebar saat resize ke desktop
            window.addEventListener('resize', function () {
                if (window.innerWidth > 768) {
                    closeSidebarMobile();
                    document.body.style.overflow = '';
                }
            });
        });
    </script>
</body>

</html>