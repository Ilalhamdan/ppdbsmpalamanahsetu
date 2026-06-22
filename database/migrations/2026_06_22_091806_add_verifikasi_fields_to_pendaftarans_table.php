<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Tambah kolom verifikasi admin, nilai ujian & hasil seleksi ke pendaftarans
        Schema::table('pendaftarans', function (Blueprint $table) {
            if (!Schema::hasColumn('pendaftarans', 'status_formulir_admin')) {
                $table->enum('status_formulir_admin', ['Menunggu', 'Disetujui', 'Ditolak', 'Belum Valid'])
                      ->default('Menunggu')->after('jurusan_pilihan');
            }
            if (!Schema::hasColumn('pendaftarans', 'catatan_formulir_admin')) {
                $table->text('catatan_formulir_admin')->nullable()->after('status_formulir_admin');
            }
            if (!Schema::hasColumn('pendaftarans', 'status_berkas_admin')) {
                $table->enum('status_berkas_admin', ['Menunggu', 'Disetujui', 'Ditolak', 'Belum Valid'])
                      ->default('Menunggu')->after('catatan_formulir_admin');
            }
            if (!Schema::hasColumn('pendaftarans', 'catatan_berkas_admin')) {
                $table->text('catatan_berkas_admin')->nullable()->after('status_berkas_admin');
            }
            if (!Schema::hasColumn('pendaftarans', 'nilai_ujian')) {
                $table->decimal('nilai_ujian', 5, 2)->nullable()->after('catatan_berkas_admin');
            }
            if (!Schema::hasColumn('pendaftarans', 'hasil_seleksi')) {
                $table->string('hasil_seleksi')->nullable()->after('nilai_ujian'); // 'Lulus' | 'Tidak Lulus'
            }
        });

        // 2. Tambah kolom tracking status formulir & berkas ke calon_siswas
        Schema::table('calon_siswas', function (Blueprint $table) {
            if (!Schema::hasColumn('calon_siswas', 'status_formulir')) {
                $table->enum('status_formulir', ['Belum', 'Terkirim'])->default('Belum')->after('user_id');
            }
            if (!Schema::hasColumn('calon_siswas', 'status_berkas')) {
                $table->enum('status_berkas', ['Belum', 'Terkirim'])->default('Belum')->after('status_formulir');
            }
        });

        // 3. Tambah kolom file berkas tambahan ke tabel berkas
        Schema::table('berkas', function (Blueprint $table) {
            if (!Schema::hasColumn('berkas', 'file_pas_foto')) {
                $table->string('file_pas_foto')->nullable()->after('file_ijazah_rapor');
            }
            if (!Schema::hasColumn('berkas', 'file_sertifikat_prestasi')) {
                $table->string('file_sertifikat_prestasi')->nullable()->after('file_pas_foto');
            }
            if (!Schema::hasColumn('berkas', 'file_surat_hafalan')) {
                $table->string('file_surat_hafalan')->nullable()->after('file_sertifikat_prestasi');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pendaftarans', function (Blueprint $table) {
            $cols = ['status_formulir_admin', 'catatan_formulir_admin', 'status_berkas_admin', 'catatan_berkas_admin', 'nilai_ujian', 'hasil_seleksi'];
            $colsToDrop = array_filter($cols, fn($c) => Schema::hasColumn('pendaftarans', $c));
            if (!empty($colsToDrop)) {
                $table->dropColumn($colsToDrop);
            }
        });

        Schema::table('calon_siswas', function (Blueprint $table) {
            $cols = ['status_formulir', 'status_berkas'];
            $colsToDrop = array_filter($cols, fn($c) => Schema::hasColumn('calon_siswas', $c));
            if (!empty($colsToDrop)) {
                $table->dropColumn($colsToDrop);
            }
        });

        Schema::table('berkas', function (Blueprint $table) {
            $cols = ['file_pas_foto', 'file_sertifikat_prestasi', 'file_surat_hafalan'];
            $colsToDrop = array_filter($cols, fn($c) => Schema::hasColumn('berkas', $c));
            if (!empty($colsToDrop)) {
                $table->dropColumn($colsToDrop);
            }
        });
    }
};
