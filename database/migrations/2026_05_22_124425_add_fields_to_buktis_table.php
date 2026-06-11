<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * PBI #45 - Menambah kolom pendukung manajemen bukti fisik
     */
    public function up(): void
    {
        Schema::table('buktis', function (Blueprint $table) {
            $table->string('nama_barang')->after('id_laporan')->nullable();
            $table->enum('status_bukti', [
                'Disimpan',
                'Dipinjam',
                'Dipindahkan',
                'Dimusnahkan',
                'Dikembalikan'
            ])->default('Disimpan')->after('tipe_file');
            $table->string('lokasi_simpan')->nullable()->after('status_bukti');
            $table->text('catatan')->nullable()->after('lokasi_simpan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('buktis', function (Blueprint $table) {
            $table->dropColumn(['nama_barang', 'status_bukti', 'lokasi_simpan', 'catatan']);
        });
    }
};