<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CalonSiswa;
use App\Models\DataOrangtua;
use App\Models\Pendaftaran;
use App\Models\Berkas;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Setting;
use Shuchkin\SimpleXLSXGen;

class PendaftaranController extends Controller
{
    /**
     * Menyimpan data formulir pendaftaran calon siswa ke database MySQL.
     */
    public function saveFormulir(Request $request)
    {
        $userId = Auth::id();
        $formData = $request->input('formData', []);
        $jalur = $request->input('jalur');
        $noUrut = $request->input('noUrut');

        if (!$userId) {
            return response()->json([
                'success' => false,
                'message' => 'Pengguna tidak terautentikasi'
            ], 401);
        }

        $tahunAjaranSetting = Setting::where('key', 'tahun_ajaran')->first();
        $tahunAjaran = $tahunAjaranSetting ? $tahunAjaranSetting->value : '2026/2027';

        DB::beginTransaction();
        try {
            // 1. Simpan/Update data ke tabel `calon_siswas`
            $calonSiswa = CalonSiswa::updateOrCreate(
                ['user_id' => $userId],
                [
                    'nik'              => $formData['inputNIK'] ?? '',
                    'nisn'             => $formData['inputNISN'] ?? '',
                    'tempat_lahir'     => $formData['inputTempatLahir'] ?? '',
                    'tanggal_lahir'    => $formData['inputTanggalLahir'] ?? null,
                    'jenis_kelamin'    => ($formData['inputGender'] ?? '') === 'Laki-laki' ? 'L' : 'P',
                    'tinggi_badan'     => $formData['inputTinggiBadan'] ?? null,
                    'gol_darah'        => $formData['inputGolDarah'] ?? '',
                    'agama'            => $formData['inputAgama'] ?? '',
                    'anak_ke'          => $formData['inputAnakKe'] ?? null,
                    'jumlah_saudara'   => $formData['inputJumlahSaudara'] ?? null,
                    'saudara_laki'     => $formData['inputSaudaraLaki'] ?? null,
                    'saudara_perempuan'=> $formData['inputSaudaraPerempuan'] ?? null,
                    'saudara_menikah'  => $formData['inputSaudaraMenikah'] ?? null,
                    'alamat_jalan'     => $formData['inputAlamatJalan'] ?? '',
                    'alamat_rt_rw'     => $formData['inputAlamatRTRW'] ?? '',
                    'alamat_desa'      => $formData['inputAlamatDesa'] ?? '',
                    'alamat_kecamatan' => $formData['inputAlamatKecamatan'] ?? '',
                    'alamat_kabupaten' => $formData['inputAlamatKabupaten'] ?? '',
                    'no_hp_siswa'      => $formData['inputNoHpSiswa'] ?? '',
                    'asal_sekolah'     => $formData['inputAsalSekolah'] ?? '',
                    'alamat_sekolah'   => $formData['inputAlamatSekolah'] ?? '',
                    'kebutuhan_khusus' => 'Tidak Ada',
                    'data_khusus'      => null
                ]
            );

            // 2. Simpan/Update data ke tabel `data_orangtuas`
            DataOrangtua::updateOrCreate(
                ['calon_siswa_id' => $calonSiswa->id],
                [
                    'nama_ayah'        => $formData['inputNamaAyah'] ?? '',
                    'status_ayah'      => $formData['inputStatusAyah'] ?? '',
                    'pendidikan_ayah'  => $formData['inputPendidikanAyah'] ?? '',
                    'pekerjaan_ayah'   => $formData['inputPekerjaanAyah'] ?? '',
                    'penghasilan_ayah' => 'Tidak Ada',
                    'nama_ibu'         => $formData['inputNamaIbu'] ?? '',
                    'status_ibu'       => $formData['inputStatusIbu'] ?? '',
                    'pendidikan_ibu'   => $formData['inputPendidikanIbu'] ?? '',
                    'pekerjaan_ibu'    => $formData['inputPekerjaanIbu'] ?? '',
                    'penghasilan_ibu'  => 'Tidak Ada',
                    'alamat_ortu'      => $formData['inputAlamatOrtu'] ?? '',
                    'no_hp_ayah'       => $formData['inputNoHpOrtu'] ?? '',
                    'nama_wali'        => $formData['inputNamaWali'] ?? '',
                    'alamat_wali'      => $formData['inputAlamatWali'] ?? '',
                    'no_hp_wali'       => $formData['inputNoHpWali'] ?? '',
                    'pekerjaan_wali'   => $formData['inputPekerjaanWali'] ?? '',
                    'no_hp_ibu'        => null,
                ]
            );

            // 3. Simpan/Update data ke tabel `pendaftarans`
            Pendaftaran::updateOrCreate(
                ['calon_siswa_id' => $calonSiswa->id],
                [
                    'no_pendaftaran'     => $noUrut ?? ('REG-2026-' . str_pad($userId, 3, '0', STR_PAD_LEFT)),
                    'gelombang'          => 'Gelombang 1',
                    'jurusan_pilihan'    => $jalur ?? 'Reguler',
                    'latar_belakang'     => 'SD / MI',
                    'status_pendaftaran' => 'Proses',
                    'tanggal_daftar'     => now(),
                    'tahun_ajaran'       => $tahunAjaran,
                ]
            );

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Data pendaftaran berhasil disimpan ke MySQL!'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan data: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Memuat data pendaftaran calon siswa dari database MySQL.
     */
    public function getFormulir()
    {
        $userId = Auth::id();

        if (!$userId) {
            return response()->json([
                'success' => false,
                'message' => 'Pengguna tidak terautentikasi'
            ], 401);
        }

        $calonSiswa = CalonSiswa::with(['dataOrangtua', 'pendaftaran'])
            ->where('user_id', $userId)
            ->first();

        if (!$calonSiswa) {
            return response()->json([
                'success' => false,
                'message' => 'Belum ada data pendaftaran'
            ]);
        }

        $dataKhusus = $calonSiswa->data_khusus;
        if (is_string($dataKhusus)) {
            $dataKhusus = json_decode($dataKhusus, true);
        }

        $pendaftaran = $calonSiswa->pendaftaran;

        $bk = Berkas::where('pendaftaran_id', $pendaftaran->id)->first();
        $uploadedFiles = [];
        if ($bk) {
            if ($bk->file_kartu_keluarga) $uploadedFiles['KK'] = [
                'name' => basename($bk->file_kartu_keluarga),
                'mime' => $bk->file_kartu_keluarga ? (str_ends_with(strtolower($bk->file_kartu_keluarga), '.pdf') ? 'application/pdf' : 'image/jpeg') : '',
                'size' => 0,
                'url'  => asset('storage/' . $bk->file_kartu_keluarga)
            ];
            if ($bk->file_akta_kelahiran) $uploadedFiles['Akta'] = [
                'name' => basename($bk->file_akta_kelahiran),
                'mime' => $bk->file_akta_kelahiran ? (str_ends_with(strtolower($bk->file_akta_kelahiran), '.pdf') ? 'application/pdf' : 'image/jpeg') : '',
                'size' => 0,
                'url'  => asset('storage/' . $bk->file_akta_kelahiran)
            ];
            if ($bk->file_ijazah_rapor) $uploadedFiles['Rapor'] = [
                'name' => basename($bk->file_ijazah_rapor),
                'mime' => $bk->file_ijazah_rapor ? (str_ends_with(strtolower($bk->file_ijazah_rapor), '.pdf') ? 'application/pdf' : 'image/jpeg') : '',
                'size' => 0,
                'url'  => asset('storage/' . $bk->file_ijazah_rapor)
            ];
            if ($bk->file_pas_foto) $uploadedFiles['Foto'] = [
                'name' => basename($bk->file_pas_foto),
                'mime' => $bk->file_pas_foto ? (str_ends_with(strtolower($bk->file_pas_foto), '.pdf') ? 'application/pdf' : 'image/jpeg') : '',
                'size' => 0,
                'url'  => asset('storage/' . $bk->file_pas_foto)
            ];
            if ($bk->file_sertifikat_prestasi) $uploadedFiles['Sertifikat'] = [
                'name' => basename($bk->file_sertifikat_prestasi),
                'mime' => $bk->file_sertifikat_prestasi ? (str_ends_with(strtolower($bk->file_sertifikat_prestasi), '.pdf') ? 'application/pdf' : 'image/jpeg') : '',
                'size' => 0,
                'url'  => asset('storage/' . $bk->file_sertifikat_prestasi)
            ];
            if ($bk->file_surat_hafalan) $uploadedFiles['KetHafalan'] = [
                'name' => basename($bk->file_surat_hafalan),
                'mime' => $bk->file_surat_hafalan ? (str_ends_with(strtolower($bk->file_surat_hafalan), '.pdf') ? 'application/pdf' : 'image/jpeg') : '',
                'size' => 0,
                'url'  => asset('storage/' . $bk->file_surat_hafalan)
            ];
        }

        return response()->json([
            'success'              => true,
            'jalur'                => $pendaftaran->jurusan_pilihan ?? '',
            'statusFormulir'       => $calonSiswa->status_formulir ?? ($pendaftaran ? 'Terkirim' : 'Belum'),
            'statusFormulirAdmin'  => $pendaftaran->status_formulir_admin ?? 'Menunggu',
            'catatanFormulirAdmin' => $pendaftaran->catatan_formulir_admin ?? '',
            'statusBerkas'         => $calonSiswa->status_berkas ?? 'Belum',
            'statusBerkasAdmin'    => $pendaftaran->status_berkas_admin ?? 'Menunggu',
            'catatanBerkasAdmin'   => $pendaftaran->catatan_berkas_admin ?? '',
            'nilaiUjian'           => $pendaftaran->nilai_ujian ?? null,
            'hasilSeleksi'         => $pendaftaran->hasil_seleksi ?? '',
            'noUrut'               => $pendaftaran->no_pendaftaran ?? '',
            'tanggalDaftar'        => $pendaftaran ? $pendaftaran->created_at->format('d/m/Y') : '',
            'uploadedFiles'        => $uploadedFiles,
            'formData'            => [
                'inputNama'              => Auth::user()->name,
                'inputGender'            => $calonSiswa->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan',
                'inputTinggiBadan'       => $calonSiswa->tinggi_badan,
                'inputGolDarah'          => $calonSiswa->gol_darah,
                'inputTempatLahir'       => $calonSiswa->tempat_lahir,
                'inputTanggalLahir'      => $calonSiswa->tanggal_lahir,
                'inputAgama'             => $calonSiswa->agama,
                'inputAnakKe'            => $calonSiswa->anak_ke,
                'inputJumlahSaudara'     => $calonSiswa->jumlah_saudara,
                'inputSaudaraLaki'       => $calonSiswa->saudara_laki,
                'inputSaudaraPerempuan'  => $calonSiswa->saudara_perempuan,
                'inputSaudaraMenikah'    => $calonSiswa->saudara_menikah,
                'inputAlamatJalan'       => $calonSiswa->alamat_jalan,
                'inputAlamatRTRW'        => $calonSiswa->alamat_rt_rw,
                'inputAlamatDesa'        => $calonSiswa->alamat_desa,
                'inputAlamatKecamatan'   => $calonSiswa->alamat_kecamatan,
                'inputAlamatKabupaten'   => $calonSiswa->alamat_kabupaten,
                'inputNoHpSiswa'         => $calonSiswa->no_hp_siswa,
                'inputAsalSekolah'       => $calonSiswa->asal_sekolah,
                'inputAlamatSekolah'     => $calonSiswa->alamat_sekolah,
                'inputNISN'              => $calonSiswa->nisn,
                'inputNIK'               => $calonSiswa->nik,
                'inputNamaAyah'          => $calonSiswa->dataOrangtua->nama_ayah ?? '',
                'inputStatusAyah'        => $calonSiswa->dataOrangtua->status_ayah ?? '',
                'inputNamaIbu'           => $calonSiswa->dataOrangtua->nama_ibu ?? '',
                'inputStatusIbu'         => $calonSiswa->dataOrangtua->status_ibu ?? '',
                'inputPendidikanAyah'    => $calonSiswa->dataOrangtua->pendidikan_ayah ?? '',
                'inputPendidikanIbu'     => $calonSiswa->dataOrangtua->pendidikan_ibu ?? '',
                'inputAlamatOrtu'        => $calonSiswa->dataOrangtua->alamat_ortu ?? '',
                'inputNoHpOrtu'          => $calonSiswa->dataOrangtua->no_hp_ayah ?? '',
                'inputPekerjaanAyah'     => $calonSiswa->dataOrangtua->pekerjaan_ayah ?? '',
                'inputPekerjaanIbu'      => $calonSiswa->dataOrangtua->pekerjaan_ibu ?? '',
                'inputNamaWali'          => $calonSiswa->dataOrangtua->nama_wali ?? '',
                'inputAlamatWali'        => $calonSiswa->dataOrangtua->alamat_wali ?? '',
                'inputNoHpWali'          => $calonSiswa->dataOrangtua->no_hp_wali ?? '',
                'inputPekerjaanWali'     => $calonSiswa->dataOrangtua->pekerjaan_wali ?? '',
            ]
        ]);
    }

    /**
     * Mengekspor data pendaftaran ke file Excel menggunakan SimpleXLSXGen.
     */
    public function exportExcel()
    {
        $xlsx = new SimpleXLSXGen();

        $headers = [
            'Tahun Ajaran', 'No. Pendaftaran', 'Jalur Pendaftaran', 'Tanggal Daftar', 'NIK', 'NISN', 'Nama Lengkap',
            'Jenis Kelamin', 'Tempat Lahir', 'Tanggal Lahir', 'Agama', 'Tinggi Badan (cm)', 'Golongan Darah',
            'Anak Ke', 'Jumlah Saudara', 'Saudara Laki-laki', 'Saudara Perempuan', 'Saudara Menikah',
            'Alamat Jalan', 'RT / RW', 'Desa / Kelurahan', 'Kecamatan', 'Kabupaten / Kota', 'No. HP Siswa',
            'Asal Sekolah', 'Alamat Asal Sekolah', 'Nama Ayah', 'Status Ayah', 'Pendidikan Ayah',
            'Pekerjaan Ayah', 'Nama Ibu', 'Status Ibu', 'Pendidikan Ibu', 'Pekerjaan Ibu',
            'Alamat Orang Tua', 'No. HP Orang Tua', 'Nama Wali', 'Alamat Wali', 'No. HP Wali', 'Pekerjaan Wali'
        ];

        $pendaftarans = Pendaftaran::with(['calonSiswa.dataOrangtua'])->get();
        
        $sheetData = [];
        $sheetData[] = array_map(function($h) { return '<b>'.$h.'</b>'; }, $headers);

        foreach ($pendaftarans as $pendaftaran) {
            $siswa = $pendaftaran->calonSiswa;
            $ortu = $siswa ? $siswa->dataOrangtua : null;

            $sheetData[] = [
                $pendaftaran->tahun_ajaran,
                $pendaftaran->no_pendaftaran,
                $pendaftaran->jurusan_pilihan,
                $pendaftaran->created_at ? $pendaftaran->created_at->format('d/m/Y H:i') : '',
                $siswa->nik ?? '',
                $siswa->nisn ?? '',
                $siswa->user->name ?? '',
                isset($siswa->jenis_kelamin) ? ($siswa->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan') : '',
                $siswa->tempat_lahir ?? '',
                $siswa->tanggal_lahir ?? '',
                $siswa->agama ?? '',
                $siswa->tinggi_badan ?? '',
                $siswa->gol_darah ?? '',
                $siswa->anak_ke ?? '',
                $siswa->jumlah_saudara ?? '',
                $siswa->saudara_laki ?? '',
                $siswa->saudara_perempuan ?? '',
                $siswa->saudara_menikah ?? '',
                $siswa->alamat_jalan ?? '',
                $siswa->alamat_rt_rw ?? '',
                $siswa->alamat_desa ?? '',
                $siswa->alamat_kecamatan ?? '',
                $siswa->alamat_kabupaten ?? '',
                $siswa->no_hp_siswa ?? '',
                $siswa->asal_sekolah ?? '',
                $siswa->alamat_sekolah ?? '',
                $ortu->nama_ayah ?? '',
                $ortu->status_ayah ?? '',
                $ortu->pendidikan_ayah ?? '',
                $ortu->pekerjaan_ayah ?? '',
                $ortu->nama_ibu ?? '',
                $ortu->status_ibu ?? '',
                $ortu->pendidikan_ibu ?? '',
                $ortu->pekerjaan_ibu ?? '',
                $ortu->alamat_ortu ?? '',
                $ortu->no_hp_ayah ?? '',
                $ortu->nama_wali ?? '',
                $ortu->alamat_wali ?? '',
                $ortu->no_hp_wali ?? '',
                $ortu->pekerjaan_wali ?? ''
            ];
        }

        if (count($sheetData) === 1) { // Only headers
            $sheetData[] = ['Data Kosong'];
        }

        $xlsx->addSheet($sheetData, 'Data Pendaftar');

        // Return inline download
        $fileName = 'Data_Pendaftar_Siswa.xlsx';
        $xlsx->downloadAs($fileName);
        exit();
    }

    /**
     * Update status formulir siswa di database (dipanggil dari dashboard siswa via JS).
     */
    public function updateStatusFormulir(Request $request)
    {
        $userId = Auth::id();
        $calonSiswa = CalonSiswa::where('user_id', $userId)->first();
        if (!$calonSiswa) {
            return response()->json(['success' => false, 'message' => 'Calon siswa tidak ditemukan.'], 404);
        }
        $calonSiswa->update(['status_formulir' => 'Terkirim']);
        return response()->json(['success' => true]);
    }

    /**
     * Update status berkas siswa di database (dipanggil dari dashboard siswa via JS).
     */
    public function updateStatusBerkas(Request $request)
    {
        $userId = Auth::id();
        $calonSiswa = CalonSiswa::where('user_id', $userId)->first();
        if (!$calonSiswa) {
            return response()->json(['success' => false, 'message' => 'Calon siswa tidak ditemukan.'], 404);
        }
        $calonSiswa->update(['status_berkas' => 'Terkirim']);
        return response()->json(['success' => true]);
    }

    /**
     * Simpan metadata berkas (nama file & tipe) ke tabel berkas.
     */
    public function simpanBerkas(Request $request)
    {
        $userId = Auth::id();
        $calonSiswa = CalonSiswa::where('user_id', $userId)->first();
        if (!$calonSiswa) {
            return response()->json(['success' => false, 'message' => 'Calon siswa tidak ditemukan.'], 404);
        }
        $pendaftaran = Pendaftaran::where('calon_siswa_id', $calonSiswa->id)->first();
        if (!$pendaftaran) {
            return response()->json(['success' => false, 'message' => 'Pendaftaran tidak ditemukan.'], 404);
        }

        $fieldMap = [
            'kk'       => 'file_kartu_keluarga',
            'akta'     => 'file_akta_kelahiran',
            'rapor'    => 'file_ijazah_rapor',
            'foto'     => 'file_pas_foto',
            'prestasi' => 'file_sertifikat_prestasi',
            'hafalan'  => 'file_surat_hafalan',
        ];

        $data = [];
        foreach ($fieldMap as $key => $col) {
            if ($request->hasFile($key)) {
                $path = $request->file($key)->store('berkas_siswa', 'public');
                $data[$col] = $path;
            }
        }

        if (!empty($data)) {
            Berkas::updateOrCreate(
                ['pendaftaran_id' => $pendaftaran->id],
                $data
            );
        }

        // Set status berkas ke Terkirim jika tombol submit ditekan
        if ($request->input('submit') === 'true') {
            $calonSiswa->update(['status_berkas' => 'Terkirim']);
            $pendaftaran->update(['status_berkas_admin' => 'Menunggu']);
        }

        return response()->json(['success' => true]);
    }

    /**
     * Menghapus seluruh data calon siswa dari database MySQL berdasarkan user_id.
     */
    public function deletePendaftar($userId)
    {
        $user = \App\Models\User::find($userId);
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Pengguna tidak ditemukan'
            ], 404);
        }

        // Hapus file bukti transfer fisik pendaftar jika ada di folder public/uploads/
        $calonSiswa = CalonSiswa::where('user_id', $userId)->first();
        if ($calonSiswa) {
            $pendaftaran = Pendaftaran::where('calon_siswa_id', $calonSiswa->id)->first();
            if ($pendaftaran) {
                $pembayaran = \App\Models\Pembayaran::where('pendaftaran_id', $pendaftaran->id)->first();
                if ($pembayaran && $pembayaran->bukti_transfer_manual && file_exists(public_path($pembayaran->bukti_transfer_manual))) {
                    unlink(public_path($pembayaran->bukti_transfer_manual));
                }
            }
        }

        DB::beginTransaction();
        try {
            // Hapus user (men-cascade delete calon_siswas, pendaftarans, pembayarans, berkas, dll.)
            $user->delete();
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Data pendaftar berhasil dihapus dari database!'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data: ' . $e->getMessage()
            ], 500);
        }
    }
}

