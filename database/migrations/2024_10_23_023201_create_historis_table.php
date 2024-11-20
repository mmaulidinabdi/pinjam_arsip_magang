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
            $table->foreignId('peminjam_id')->constrained('peminjams')->onDelete('cascade');
            $table->unsignedBigInteger('imb_id')->nullable(); // Membuat kolom nullable
            $table->foreign('imb_id')->references('id')->on('imbs')->onDelete('cascade')->nullable();
            $table->unsignedBigInteger('sk_id')->nullable(); // Membuat kolom nullable
            $table->foreign('sk_id')->references('id')->on('sk')->onDelete('cascade')->nullable();
            $table->unsignedBigInteger('arsip2_id')->nullable(); // Membuat kolom nullable
            $table->foreign('arsip2_id')->references('id')->on('arsip2s')->onDelete('cascade')->nullable();
            $table->string('nama_arsip');
            $table->enum('status', ['diacc', 'ditolak']);
            $table->string('alasan_ditolak')->nullable();
            $table->date('tanggal_peminjaman');
            $table->date('tanggal_pengembalian')->nullable();
            $table->string('tujuan_peminjam');
            $table->string('dokumen_pendukung')->nullable();
            $table->enum('jenis_arsip', ['SK', 'arsip2', 'IMB'])->notNull();
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
