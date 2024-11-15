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
            $table->unsignedBigInteger('imb_id')->nullable(); // Membuat kolom nullable
            $table->foreign('imb_id')->references('id')->on('imbs')->onDelete('cascade');
            $table->string('nama_arsip');
            $table->enum('status', ['diacc', 'ditolak']);
            $table->string('alasan_ditolak')->nullable();
            $table->date('tanggal_peminjaman');
            $table->date('tanggal_pengembalian')->nullable();
            $table->string('tujuan_peminjam');
            $table->string('dokumen_pendukung')->nullable();
            $table->enum('jenis_arsip', ['Arsip1', 'arsip2', 'IMB'])->notNull();
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
