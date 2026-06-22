<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CalonSiswa;
use App\Models\Pendaftaran;
use App\Models\Berkas;

class AdminVerifikasiController extends Controller
{
    // ==================== VERIFIKASI FORMULIR ====================

    public function setujuiFormulir($userId)
    {
        $pendaftaran = $this->getPendaftaranByUserId($userId);
        if (!$pendaftaran) {
            return response()->json(['success' => false, 'message' => 'Data pendaftaran tidak ditemukan.'], 404);
        }

        $pendaftaran->update([
            'status_formulir_admin' => 'Disetujui',
            'catatan_formulir_admin' => null,
        ]);

        return response()->json(['success' => true, 'message' => 'Formulir berhasil disetujui.']);
    }

    public function tolakFormulir(Request $request, $userId)
    {
        $request->validate(['catatan' => 'required|string|max:1000']);

        $pendaftaran = $this->getPendaftaranByUserId($userId);
        if (!$pendaftaran) {
            return response()->json(['success' => false, 'message' => 'Data pendaftaran tidak ditemukan.'], 404);
        }

        $pendaftaran->update([
            'status_formulir_admin' => 'Ditolak',
            'catatan_formulir_admin' => $request->catatan,
        ]);

        return response()->json(['success' => true, 'message' => 'Formulir berhasil ditolak.']);
    }

    // ==================== VERIFIKASI BERKAS ====================

    public function setujuiBerkas($userId)
    {
        $pendaftaran = $this->getPendaftaranByUserId($userId);
        if (!$pendaftaran) {
            return response()->json(['success' => false, 'message' => 'Data pendaftaran tidak ditemukan.'], 404);
        }

        $pendaftaran->update([
            'status_berkas_admin' => 'Disetujui',
            'catatan_berkas_admin' => null,
        ]);

        return response()->json(['success' => true, 'message' => 'Berkas berhasil disetujui.']);
    }

    public function tolakBerkas(Request $request, $userId)
    {
        $request->validate(['catatan' => 'required|string|max:1000']);

        $pendaftaran = $this->getPendaftaranByUserId($userId);
        if (!$pendaftaran) {
            return response()->json(['success' => false, 'message' => 'Data pendaftaran tidak ditemukan.'], 404);
        }

        $pendaftaran->update([
            'status_berkas_admin' => 'Ditolak',
            'catatan_berkas_admin' => $request->catatan,
        ]);

        return response()->json(['success' => true, 'message' => 'Berkas berhasil ditolak.']);
    }

    // ==================== NILAI UJIAN & SELEKSI ====================

    public function simpanNilai(Request $request, $userId)
    {
        $request->validate([
            'nilai_ujian'   => 'required|numeric|min:0|max:100',
            'hasil_seleksi' => 'required|in:Lulus,Tidak Lulus',
        ]);

        $pendaftaran = $this->getPendaftaranByUserId($userId);
        if (!$pendaftaran) {
            return response()->json(['success' => false, 'message' => 'Data pendaftaran tidak ditemukan.'], 404);
        }

        $pendaftaran->update([
            'nilai_ujian'   => $request->nilai_ujian,
            'hasil_seleksi' => $request->hasil_seleksi,
        ]);

        return response()->json(['success' => true, 'message' => 'Nilai & hasil seleksi berhasil disimpan.']);
    }

    // ==================== HELPER ====================

    private function getPendaftaranByUserId($userId)
    {
        $calonSiswa = CalonSiswa::where('user_id', $userId)->first();
        if (!$calonSiswa) return null;
        return Pendaftaran::where('calon_siswa_id', $calonSiswa->id)->first();
    }
}
