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
        Schema::create('report_comparisons', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('start_month');
            $table->date('end_month');
            $table->string('category_filter')->nullable();
            $table->string('status_filter')->nullable();
            $table->string('comparison_type'); // bulanan, kategori, status
            $table->text('notes')->nullable();
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('report_comparisons');
    }
};
