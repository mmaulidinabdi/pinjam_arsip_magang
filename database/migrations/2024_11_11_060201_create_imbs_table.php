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
        Schema::create('imbs', function (Blueprint $table) {
            $table->id();
            $table->integer('nomor_dp')->nullable();
            $table->string('nama_pemilik')->nullable();
            $table->text('alamat')->nullable();
            $table->text('lokasi')->nullable();
            $table->string('box')->nullable();
            $table->text('keterangan')->nullable();
            $table->year('tahun')->nullable();
            $table->string('imbs')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('imbs');
    }
};
