<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AkunAktivasiController extends Controller
{
    /**
     * Ambil daftar akun siswa yang belum diaktivasi (email_verified_at = null)
     */
    public function pending()
    {
        $pendingUsers = User::where('role', 'siswa')
            ->whereNull('email_verified_at')
            ->orderBy('created_at', 'desc')
            ->get(['id', 'name', 'email', 'created_at']);

        return response()->json($pendingUsers);
    }

    /**
     * Aktivasi akun siswa oleh admin
     */
    public function activate(Request $request, $userId)
    {
        $user = User::where('role', 'siswa')->findOrFail($userId);

        if ($user->hasVerifiedEmail()) {
            return response()->json(['message' => 'Akun sudah aktif sebelumnya.'], 422);
        }

        $user->email_verified_at = now();
        $user->save();

        // Kirim email notifikasi ke siswa (jika Resend tersedia)
        try {
            Mail::raw(
                "Halo {$user->name},\n\nAkun PPDB Anda telah DIAKTIFKAN oleh admin.\nSilakan login di portal PPDB SMP Al-Amanah untuk melanjutkan proses pendaftaran.\n\nTerima kasih,\nPanitia PPDB SMP Al-Amanah",
                function ($message) use ($user) {
                    $message->to($user->email)
                            ->subject('✅ Akun PPDB Anda Telah Diaktifkan - SMP Al-Amanah');
                }
            );
        } catch (\Exception $e) {
            // Jangan gagalkan proses aktivasi jika email gagal terkirim
            \Log::warning('Gagal kirim email aktivasi ke ' . $user->email . ': ' . $e->getMessage());
        }

        return response()->json([
            'message' => "Akun {$user->name} ({$user->email}) berhasil diaktivasi!",
            'user' => $user,
        ]);
    }

    /**
     * Tolak/hapus akun siswa yang belum diaktivasi
     */
    public function reject(Request $request, $userId)
    {
        $user = User::where('role', 'siswa')
            ->whereNull('email_verified_at')
            ->findOrFail($userId);

        $nama = $user->name;
        $email = $user->email;
        $user->delete();

        return response()->json([
            'message' => "Akun {$nama} ({$email}) berhasil ditolak dan dihapus.",
        ]);
    }
}
