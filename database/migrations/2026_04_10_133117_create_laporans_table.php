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
        Schema::create('laporans', function (Blueprint $table) {
            $table->id('id_laporan');
            $table->foreignId('id_user')->nullable()->constrained('users')->onDelete('set null');
            $table->string('jenis_kejadian');
            $table->string('lokasi');
            $table->datetime('tanggal_kejadian');
            $table->text('deskripsi');
            $table->string('status')->default('Menunggu Verifikasi');
            $table->datetime('tanggal_lapor');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporans');
    }
};
