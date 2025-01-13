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
        Schema::create('sk', function (Blueprint $table) {
            $table->id();
            $table->integer('nomor_sk')->nullable();
            $table->year('tahun')->nullable();
            $table->date('tanggal_penetapan')->nullable();
            $table->text('tentang')->nullable();
            $table->string('sk')->nullable();
            $table->enum('status', ['Tersedia', 'Dipinjam'])->default('tersedia');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sk');
    }
};
