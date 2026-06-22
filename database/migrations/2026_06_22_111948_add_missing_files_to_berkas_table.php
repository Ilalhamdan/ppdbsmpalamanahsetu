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
        Schema::table('berkas', function (Blueprint $table) {
            $table->string('file_pas_foto')->nullable();
            $table->string('file_sertifikat_prestasi')->nullable();
            $table->string('file_surat_hafalan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('berkas', function (Blueprint $table) {
            $table->dropColumn(['file_pas_foto', 'file_sertifikat_prestasi', 'file_surat_hafalan']);
        });
    }
};
