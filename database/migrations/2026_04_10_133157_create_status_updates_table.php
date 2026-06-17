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
        Schema::create('status_updates', function (Blueprint $table) {
            $table->id('id_status');
            $table->foreignId('id_laporan')->constrained('laporans', 'id_laporan')->onDelete('cascade');
            $table->foreignId('id_admin')->constrained('users')->onDelete('cascade');
            $table->string('status');
            $table->datetime('tanggal_update');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('status_updates');
    }
};
