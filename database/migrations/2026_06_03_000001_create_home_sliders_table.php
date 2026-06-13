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
        Schema::create('home_sliders', function (Blueprint $table) {
            $table->id();
            $table->string('judul');                        // Judul slide
            $table->text('deskripsi')->nullable();          // Deskripsi opsional
            $table->string('gambar');                       // Path gambar
            $table->string('link_url')->nullable();         // Link tujuan saat slide diklik
            $table->integer('urutan')->default(0);          // Urutan tampil
            $table->boolean('aktif')->default(true);        // Toggle aktif/nonaktif
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_sliders');
    }
};
