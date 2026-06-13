<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Email Anda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body { background-color: #f4f6f9; font-family: 'Inter', sans-serif; }
        .card-verify { background-color: #0b2240; color: white; border-radius: 20px; max-width: 500px; padding: 30px; box-shadow: 0 10px 25px rgba(0,0,0,0.2); }
        .btn-resend { background-color: white; color: #0b2240; font-weight: 600; border-radius: 8px; border: none; padding: 10px 20px; }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center" style="min-height: 100vh;">

    <div class="card-verify text-center">
        <h2 class="fw-bold h4 mb-3"><i class="bi bi-envelope-check me-2"></i>Verifikasi Email Anda</h2>
        <p class="small text-white-50 mb-4" style="line-height: 1.6;">
            Terima kasih telah mendaftar! Sebelum bisa masuk ke dashboard, mohon periksa kotak masuk email simulasi Anda di **Mailtrap** dan klik tautan aktivasi yang kami kirimkan.
        </p>

        @if (session('status') == 'verification-link-sent')
            <div class="alert alert-success bg-success text-white border-0 small mb-3" role="alert">
                Tautan verifikasi baru telah dikirimkan ke alamat email Anda.
            </div>
        @endif

        <div class="d-flex justify-content-between align-items-center mt-4">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit" class="btn btn-resend btn-sm">Kirim Ulang Email</button>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-link text-white text-decoration-none small">Keluar</button>
            </form>
        </div>
    </div>

</body>
</html>