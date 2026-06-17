<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SMP AL-AMANAH</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body { 
            background: linear-gradient(135deg, #0d9488 0%, #0f766e 100%); 
            font-family: 'Inter', sans-serif; 
            position: relative;
            overflow: hidden;
        }
        /* Glowing dots like in Hero section */
        body::before {
            content: '';
            position: absolute;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(255,255,255,0.06) 0%, transparent 70%);
            top: -50px;
            right: -50px;
            border-radius: 50%;
        }
        body::after {
            content: '';
            position: absolute;
            width: 250px;
            height: 250px;
            background: radial-gradient(circle, rgba(255,255,255,0.04) 0%, transparent 75%);
            bottom: -50px;
            left: -50px;
            border-radius: 50%;
        }
        .card-login { 
            background-color: #0f766e; 
            color: white; 
            border-radius: 20px; 
            max-width: 380px; 
            width: 100%; 
            padding: 32px 28px; 
            box-shadow: 0 15px 35px rgba(0,0,0,0.25); 
            border: 1px solid rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            z-index: 10;
        }
        .logo-emblem {
            margin-bottom: 12px;
        }
        .form-control-kustom { 
            background-color: rgba(255,255,255,0.08); 
            border: 1px solid rgba(255,255,255,0.15); 
            color: white; 
            border-radius: 8px; 
            padding: 10px 14px; 
            font-size: 13.5px;
            transition: all 0.3s ease;
        }
        .form-control-kustom::placeholder {
            color: rgba(255, 255, 255, 0.4);
        }
        .form-control-kustom:focus { 
            background-color: rgba(255,255,255,0.12); 
            border-color: #fef08a; 
            color: white; 
            box-shadow: 0 0 0 3px rgba(254, 240, 138, 0.15); 
        }
        .btn-login { 
            background-color: #fef08a; 
            color: #b45309; 
            font-weight: 700; 
            border-radius: 8px; 
            padding: 10px; 
            border: none; 
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); 
            font-size: 14.5px;
            letter-spacing: 0.5px;
        }
        .btn-login:hover { 
            background-color: #fde68a; 
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(254, 240, 138, 0.25);
            color: #b45309;
        }
        .text-link { color: rgba(255,255,255,0.7); text-decoration: none; font-size: 12px; transition: color 0.2s; }
        .text-link:hover { color: #fde68a; }
        .form-label { font-size: 12.5px; margin-bottom: 5px; font-weight: 500; color: rgba(255, 255, 255, 0.9); }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center" style="min-height: 100vh;">

    <!-- Back to home link -->
    <a href="{{ url('/') }}" class="position-fixed text-white text-decoration-none d-flex align-items-center gap-1" style="top:20px;left:24px;font-size:13px;opacity:0.8;transition:opacity 0.2s;" onmouseover="this.style.opacity='1'" onmouseout="this.style.opacity='0.8'">
        <i class="bi bi-arrow-left"></i> Beranda
    </a>

    <div class="card-login text-center">
        <!-- Premium Islamic Emblem Logo -->
        <div class="logo-emblem d-inline-block">
            <div class="rounded-circle bg-white d-flex align-items-center justify-content-center border border-3 border-warning shadow-sm mx-auto" style="width: 64px; height: 64px;">
                <img src="{{ asset('logo.png') }}" alt="Logo SMP Al-Amanah" style="width: 44px; height: 44px; object-fit: contain;">
            </div>
        </div>
        <h2 class="fw-bold h5 mb-1">SMP AL-AMANAH</h2>
        <p class="text-warning-50 mb-3 text-uppercase tracking-wider fw-semibold" style="font-size: 10px; color: rgba(254, 240, 138, 0.8);">Portal PPDB Online</p>

        @if (session('status'))
            <div class="alert alert-success bg-success text-white border-0 p-2" style="font-size: 12px;" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-3 text-start">
                <label class="form-label">Email Address</label>
                <input type="email" name="email" class="form-control form-control-kustom @error('email') is-invalid @enderror" value="{{ old('email') }}" required autofocus placeholder="Masukkan email Anda">
                @error('email') <span class="text-danger" style="font-size: 11px;">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4 text-start">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control form-control-kustom @error('password') is-invalid @enderror" required placeholder="Masukkan password Anda">
                @error('password') <span class="text-danger" style="font-size: 11px;">{{ $message }}</span> @enderror
            </div>

            <div class="d-grid mb-3">
                <button type="submit" class="btn btn-login">Masuk Portal</button>
            </div>

            <div>
                <a href="{{ route('register') }}" class="text-link">Belum memiliki akun? <strong>Daftar Baru</strong></a>
            </div>
        </form>
    </div>

</body>
</html>