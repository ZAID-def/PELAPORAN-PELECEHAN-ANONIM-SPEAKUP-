<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Menambahkan kolom untuk bukti digital (gambar/file upload dari halaman publik/lapor)
     * Bukti fisik tetap dikelola manual via menu Bukti Fisik (AdminBuktiController)
     */
    public function up(): void
    {
        Schema::table('laporans', function (Blueprint $table) {
            $table->string('bukti_file')->nullable()->after('notes');
            $table->string('bukti_tipe_file')->nullable()->after('bukti_file');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('laporans', function (Blueprint $table) {
            $table->dropColumn(['bukti_file', 'bukti_tipe_file']);
        });
    }
};
