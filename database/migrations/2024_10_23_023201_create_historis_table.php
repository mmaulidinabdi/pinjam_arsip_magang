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
        Schema::create('historis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('peminjaman_id')->constrained('transaksi_peminjamans')->onDelete('cascade');
            $table->foreignId('peminjam_id')->constrained('peminjams')->onDelete('cascade');
            $table->foreignId('arsip_id')->constrained('arsips')->onDelete('cascade')->nullable();
            $table->enum('isVerificate', ['diacc', 'ditolak']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historis');
    }
};
