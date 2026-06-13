<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Midtrans\Config;
use Midtrans\Snap;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    public function __construct()
    {
        // Konfigurasi Midtrans
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');
    }

    public function pay(Request $request)
    {
        $user = Auth::user();
        
        // Cari data calon siswa dari user yang login
        $calonSiswa = \App\Models\CalonSiswa::where('user_id', $user->id)->first();
        
        if (!$calonSiswa) {
            return response()->json(['error' => 'Biodata belum diisi. Harap isi formulir terlebih dahulu.'], 400);
        }

        // Cari pendaftaran dari calon siswa ini
        $pendaftaran = Pendaftaran::where('calon_siswa_id', $calonSiswa->id)->first();
        
        if (!$pendaftaran) {
            return response()->json(['error' => 'Data pendaftaran belum ditemukan. Harap isi formulir terlebih dahulu.'], 400);
        }

        // Cari atau buat record pembayaran
        $pembayaran = Pembayaran::firstOrCreate(
            ['pendaftaran_id' => $pendaftaran->id],
            [
                'kode_invoice' => 'INV-' . date('Ymd') . '-' . str_pad($user->id, 4, '0', STR_PAD_LEFT),
                'jumlah_bayar' => 100000, // Biaya pendaftaran 100rb
                'status_pembayaran' => 'Belum Bayar'
            ]
        );

        // Jika sudah ada snap_token dan belum expire/lunas, gunakan yang ada
        if ($pembayaran->snap_token && $pembayaran->status_pembayaran != 'Lunas') {
            return response()->json(['snap_token' => $pembayaran->snap_token]);
        }

        // Parameter untuk Midtrans
        $params = array(
            'transaction_details' => array(
                'order_id' => $pembayaran->kode_invoice . '-' . time(), // Tambahkan time() agar unik jika re-create
                'gross_amount' => $pembayaran->jumlah_bayar,
            ),
            'customer_details' => array(
                'first_name' => $user->name,
                'email' => $user->email,
            ),
            'item_details' => array(
                array(
                    'id' => 'REG-PPDB',
                    'price' => $pembayaran->jumlah_bayar,
                    'quantity' => 1,
                    'name' => 'Biaya Pendaftaran PPDB'
                )
            )
        );

        try {
            // Minta Snap Token ke Midtrans
            $snapToken = Snap::getSnapToken($params);
            
            // Simpan snap_token dan order_id (di kolom bukti_transfer) ke database
            $pembayaran->update([
                'snap_token' => $snapToken,
                'bukti_transfer' => $params['transaction_details']['order_id']
            ]);

            return response()->json(['snap_token' => $snapToken]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function webhook(Request $request)
    {
        // Konfigurasi webhook midtrans
        $serverKey = config('midtrans.server_key');
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);
        
        if ($hashed == $request->signature_key) {
            if ($request->transaction_status == 'capture' || $request->transaction_status == 'settlement') {
                // Ekstrak kode_invoice asli dari order_id (menghilangkan suffix time)
                $orderIdParts = explode('-', $request->order_id);
                $kodeInvoice = $orderIdParts[0] . '-' . $orderIdParts[1] . '-' . $orderIdParts[2];
                
                $pembayaran = Pembayaran::where('kode_invoice', $kodeInvoice)->first();
                if ($pembayaran) {
                    // JANGAN langsung mengubah status pembayaran menjadi Menunggu Verifikasi
                    // $pembayaran->update([
                    //     'status_pembayaran' => 'Menunggu Verifikasi'
                    // ]);
                }
            }
        }

        return response()->json(['message' => 'ok']);
    }

    public function clientSuccess(Request $request)
    {
        $user = Auth::user();
        $calonSiswa = \App\Models\CalonSiswa::where('user_id', $user->id)->first();
        if ($calonSiswa) {
            $pendaftaran = \App\Models\Pendaftaran::where('calon_siswa_id', $calonSiswa->id)->first();
            if ($pendaftaran) {
                $pembayaran = Pembayaran::where('pendaftaran_id', $pendaftaran->id)->first();
                if ($pembayaran) {
                    // JANGAN langsung mengubah status pembayaran menjadi Menunggu Verifikasi
                    // $pembayaran->update([
                    //     'status_pembayaran' => 'Menunggu Verifikasi'
                    // ]);
                    return response()->json(['success' => true]);
                }
            }
        }
        return response()->json(['error' => 'Not found'], 404);
    }

    public function confirmLunas($userId)
    {
        $calonSiswa = \App\Models\CalonSiswa::where('user_id', $userId)->first();
        if ($calonSiswa) {
            $pendaftaran = \App\Models\Pendaftaran::where('calon_siswa_id', $calonSiswa->id)->first();
            if ($pendaftaran) {
                $pembayaran = Pembayaran::where('pendaftaran_id', $pendaftaran->id)->first();
                if ($pembayaran) {
                    $pembayaran->update([
                        'status_pembayaran' => 'Lunas'
                    ]);
                    return response()->json(['success' => true]);
                }
            }
        }
        return response()->json(['error' => 'Not found'], 404);
    }

    public function resetSimulasi()
    {
        $user = \Illuminate\Support\Facades\Auth::user();
        $calonSiswa = \App\Models\CalonSiswa::where('user_id', $user->id)->first();
        if ($calonSiswa) {
            $pendaftaran = \App\Models\Pendaftaran::where('calon_siswa_id', $calonSiswa->id)->first();
            if ($pendaftaran) {
                $pembayaran = Pembayaran::where('pendaftaran_id', $pendaftaran->id)->first();
                if ($pembayaran) {
                    // Hapus file manual lama jika ada
                    if ($pembayaran->bukti_transfer_manual && file_exists(public_path($pembayaran->bukti_transfer_manual))) {
                        unlink(public_path($pembayaran->bukti_transfer_manual));
                    }
                    
                    $pembayaran->update([
                        'status_pembayaran' => 'Belum Bayar',
                        'snap_token' => null,
                        'bukti_transfer' => null,
                        'bukti_transfer_manual' => null,
                        'nama_pengirim' => null,
                        'catatan_pembayaran' => null
                    ]);
                }
            }
        }
        return redirect()->route('dashboard');
    }

    public function uploadBukti(Request $request)
    {
        $request->validate([
            'bukti_transfer' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'nama_pengirim' => 'required|string|max:255',
        ]);

        $user = Auth::user();
        $calonSiswa = \App\Models\CalonSiswa::where('user_id', $user->id)->first();
        if (!$calonSiswa) {
            return response()->json(['error' => 'Calon siswa tidak ditemukan.'], 404);
        }

        $pendaftaran = Pendaftaran::where('calon_siswa_id', $calonSiswa->id)->first();
        if (!$pendaftaran) {
            return response()->json(['error' => 'Pendaftaran tidak ditemukan.'], 404);
        }

        // Cari atau buat record pembayaran
        $pembayaran = Pembayaran::firstOrCreate(
            ['pendaftaran_id' => $pendaftaran->id],
            [
                'kode_invoice' => 'INV-' . date('Ymd') . '-' . str_pad($user->id, 4, '0', STR_PAD_LEFT),
                'jumlah_bayar' => 100000,
            ]
        );

        if ($request->hasFile('bukti_transfer')) {
            // Hapus file manual lama jika ada
            if ($pembayaran->bukti_transfer_manual && file_exists(public_path($pembayaran->bukti_transfer_manual))) {
                unlink(public_path($pembayaran->bukti_transfer_manual));
            }

            $file = $request->file('bukti_transfer');
            $filename = 'bukti_' . time() . '_' . rand(100, 999) . '.' . $file->getClientOriginalExtension();
            $path = 'uploads/bukti_pembayaran/' . $filename;
            
            // Simpan file ke folder public/uploads/bukti_pembayaran/
            $file->move(public_path('uploads/bukti_pembayaran'), $filename);

            $pembayaran->update([
                'bukti_transfer_manual' => $path,
                'nama_pengirim' => $request->nama_pengirim,
                'status_pembayaran' => 'Menunggu Verifikasi',
                'catatan_pembayaran' => null, // Reset catatan jika mereka upload ulang
            ]);

            return response()->json([
                'success' => true,
                'bukti_transfer_manual' => $path,
                'nama_pengirim' => $request->nama_pengirim
            ]);
        }

        return response()->json(['error' => 'File tidak ditemukan.'], 400);
    }

    public function rejectPayment(Request $request, $userId)
    {
        $request->validate([
            'catatan' => 'required|string|max:500',
        ]);

        $calonSiswa = \App\Models\CalonSiswa::where('user_id', $userId)->first();
        if ($calonSiswa) {
            $pendaftaran = Pendaftaran::where('calon_siswa_id', $calonSiswa->id)->first();
            if ($pendaftaran) {
                $pembayaran = Pembayaran::where('pendaftaran_id', $pendaftaran->id)->first();
                if ($pembayaran) {
                    $pembayaran->update([
                        'status_pembayaran' => 'Belum Bayar',
                        'catatan_pembayaran' => $request->catatan,
                    ]);
                    return response()->json(['success' => true]);
                }
            }
        }
        return response()->json(['error' => 'Data pembayaran tidak ditemukan.'], 404);
    }
}
