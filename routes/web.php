<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeSliderController;
use App\Models\HomeSlider;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes - Portal PPDB SMP Al-Amanah
|--------------------------------------------------------------------------
*/

// 1. Halaman Utama / Landing Page
Route::get('/', function () {
    $sliders = HomeSlider::where('aktif', true)->orderBy('urutan')->orderBy('created_at', 'desc')->get();
    return view('landing', compact('sliders'));
});

// Route Darurat untuk menjalankan migrate di production (karena terminal Railway tidak bisa/bermasalah)
Route::get('/run-migration', function () {
    try {
        \Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);
        return response('Migrasi berhasil dijalankan! Output: <br>' . nl2br(\Illuminate\Support\Facades\Artisan::output()));
    } catch (\Exception $e) {
        return response('Migrasi gagal: ' . $e->getMessage());
    }
});

Route::get('/reset-db', function () {
    try {
        \Illuminate\Support\Facades\Artisan::call('migrate:fresh', ['--seed' => true, '--force' => true]);
        return response('Database berhasil direset ke kondisi awal (termasuk akun admin & seeder)! Output: <br>' . nl2br(\Illuminate\Support\Facades\Artisan::output()));
    } catch (\Exception $e) {
        return response('Reset Database gagal: ' . $e->getMessage());
    }
});

// 2. Rute Navigasi Menu Profil Sekolah (Mendukung Tab Sejarah, Visi-Misi, Fasilitas, Ekstrakurikuler, Prestasi)
Route::get('/profil', function () {
    return view('profil', ['tab' => 'sejarah']); // Standar awal membuka sejarah
});

Route::get('/profil/{tab}', function ($tab) {
    // Memastikan tab yang dimasukkan hanya yang didukung
    if (!in_array($tab, ['sejarah', 'visi-misi', 'fasilitas', 'ekstrakurikuler', 'prestasi'])) {
        abort(404);
    }
    return view('profil', compact('tab'));
});

// 3. Rute Navigasi Menu PPDB (Mendukung Tab Gelombang, Jalur, Syarat)
Route::get('/ppdb', function () {
    return view('ppdb', ['tab' => 'gelombang']); // Standar awal membuka gelombang
});

Route::get('/ppdb/{tab}', function ($tab) {
    // Memastikan tab yang dimasukkan hanya yang didukung
    if (!in_array($tab, ['gelombang', 'jalur', 'syarat'])) {
        abort(404);
    }
    return view('ppdb', compact('tab'));
});

// 4. Rute Navigasi Menu Umum Lainnya
Route::get('/berita', function () { return view('berita'); });
Route::get('/galeri', function () { return view('galeri'); });
Route::get('/kontak', function () { return view('kontak'); });
Route::get('/tentang', function () { return view('tentang'); });

// 5a. Dashboard Siswa - Hanya untuk user yang login dengan role 'siswa'
Route::get('/dashboard', function () {
    $siswa = Auth::user();
    // Jika admin mencoba akses dashboard siswa, arahkan ke dashboard admin
    if ($siswa && $siswa->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }
    
    // Sinkronisasi status dari DB riil
    $dbStatusPembayaran = null;
    $dbCatatanPembayaran = null;
    $dbBuktiTransferManual = null;
    $dbNamaPengirim = null;
    if ($siswa) {
        $calon = \App\Models\CalonSiswa::where('user_id', $siswa->id)->first();
        if ($calon) {
            $pendaftaran = \App\Models\Pendaftaran::where('calon_siswa_id', $calon->id)->first();
            if ($pendaftaran) {
                $pembayaran = \App\Models\Pembayaran::where('pendaftaran_id', $pendaftaran->id)->first();
                if ($pembayaran) {
                    $dbStatusPembayaran = $pembayaran->status_pembayaran;
                    $dbCatatanPembayaran = $pembayaran->catatan_pembayaran;
                    $dbBuktiTransferManual = $pembayaran->bukti_transfer_manual;
                    $dbNamaPengirim = $pembayaran->nama_pengirim;
                }
            }
        }
    }
    
    return view('siswa.dashboard-siswa', compact('siswa', 'dbStatusPembayaran', 'dbCatatanPembayaran', 'dbBuktiTransferManual', 'dbNamaPengirim'));
})->middleware(['auth'])->name('dashboard');

// 5b. Dashboard Admin - Hanya untuk user dengan role 'admin'
Route::get('/admin/dashboard', function () {
    $siswa = Auth::user();
    $pendaftar = \App\Models\CalonSiswa::with([
        'user',
        'pendaftaran.pembayaran',
        'pendaftaran.berkas',
        'dataOrangtua'
    ])->whereHas('user', fn($q) => $q->where('role', 'siswa'))
      ->orderBy('created_at', 'desc')
      ->get();
    $dbPendaftarCount = $pendaftar->count();
    $sys_settings = \App\Models\Setting::pluck('value', 'key')->toArray();
    return view('admin.dashboard-admin', compact('siswa', 'pendaftar', 'dbPendaftarCount', 'sys_settings'));
})->middleware(['auth', 'isAdmin'])->name('admin.dashboard');

// 5c. API Kelola Home Slider (admin only)
Route::middleware(['auth', 'isAdmin'])->prefix('admin')->group(function () {
    Route::get('/home-slider', [HomeSliderController::class, 'index'])->name('admin.slider.index');
    Route::post('/home-slider', [HomeSliderController::class, 'store'])->name('admin.slider.store');
    Route::put('/home-slider/{id}', [HomeSliderController::class, 'update'])->name('admin.slider.update');
    Route::delete('/home-slider/{id}', [HomeSliderController::class, 'destroy'])->name('admin.slider.destroy');
    
    // API Kelola Pengaturan Sistem (admin only)
    Route::post('/settings/update', [\App\Http\Controllers\SettingController::class, 'update'])->name('admin.settings.update');
    
    // Export Excel Pendaftar
    Route::get('/pendaftar/export', [\App\Http\Controllers\PendaftaranController::class, 'exportExcel'])->name('admin.pendaftar.export');
    
    // Konfirmasi Pembayaran Lunas (admin only)
    Route::post('/payment/confirm-lunas/{userId}', [\App\Http\Controllers\PaymentController::class, 'confirmLunas'])->name('admin.payment.confirm-lunas');
    // Tolak Pembayaran (admin only)
    Route::post('/payment/reject/{userId}', [\App\Http\Controllers\PaymentController::class, 'rejectPayment'])->name('admin.payment.reject');
    // Hapus Pendaftar (admin only)
    Route::delete('/pendaftar/delete/{userId}', [\App\Http\Controllers\PendaftaranController::class, 'deletePendaftar'])->name('admin.pendaftar.delete');

    // ===== VERIFIKASI FORMULIR (admin only) =====
    Route::post('/formulir/setujui/{userId}', [\App\Http\Controllers\AdminVerifikasiController::class, 'setujuiFormulir'])->name('admin.formulir.setujui');
    Route::post('/formulir/tolak/{userId}',   [\App\Http\Controllers\AdminVerifikasiController::class, 'tolakFormulir'])->name('admin.formulir.tolak');

    // ===== VERIFIKASI BERKAS (admin only) =====
    Route::post('/berkas/setujui/{userId}',   [\App\Http\Controllers\AdminVerifikasiController::class, 'setujuiBerkas'])->name('admin.berkas.setujui');
    Route::post('/berkas/tolak/{userId}',     [\App\Http\Controllers\AdminVerifikasiController::class, 'tolakBerkas'])->name('admin.berkas.tolak');

    // ===== NILAI UJIAN & SELEKSI (admin only) =====
    Route::post('/seleksi/simpan-nilai/{userId}', [\App\Http\Controllers\AdminVerifikasiController::class, 'simpanNilai'])->name('admin.seleksi.simpan-nilai');
});

// 6. Logika Manajemen Akun (Bawaan Breeze)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rute Pendaftaran Calon Siswa (MySQL)
    Route::post('/pendaftaran/simpan', [\App\Http\Controllers\PendaftaranController::class, 'saveFormulir'])->name('pendaftaran.simpan');
    Route::get('/pendaftaran/data', [\App\Http\Controllers\PendaftaranController::class, 'getFormulir'])->name('pendaftaran.data');
    Route::post('/pendaftaran/update-status-formulir', [\App\Http\Controllers\PendaftaranController::class, 'updateStatusFormulir'])->name('pendaftaran.update-status-formulir');
    Route::post('/pendaftaran/update-status-berkas', [\App\Http\Controllers\PendaftaranController::class, 'updateStatusBerkas'])->name('pendaftaran.update-status-berkas');
    Route::post('/pendaftaran/simpan-berkas', [\App\Http\Controllers\PendaftaranController::class, 'simpanBerkas'])->name('pendaftaran.simpan-berkas');
    
    // Rute Pembayaran (Midtrans & Manual)
    Route::post('/payment/pay', [\App\Http\Controllers\PaymentController::class, 'pay'])->name('payment.pay');
    Route::post('/payment/success', [\App\Http\Controllers\PaymentController::class, 'clientSuccess'])->name('payment.success');
    Route::get('/payment/reset-simulasi', [\App\Http\Controllers\PaymentController::class, 'resetSimulasi'])->name('payment.reset-simulasi');
    Route::post('/payment/upload-bukti', [\App\Http\Controllers\PaymentController::class, 'uploadBukti'])->name('payment.upload-bukti');
});

// Webhook Midtrans (di luar middleware auth)
Route::post('/api/midtrans/webhook', [\App\Http\Controllers\PaymentController::class, 'webhook'])->name('payment.webhook');

// 7. Sistem Autentikasi Breeze (Login, Register, Kirim Email)
require __DIR__.'/auth.php';