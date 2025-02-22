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
        Schema::create('peminjams', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap');
            $table->string('email')->unique();
            $table->string('password');
            $table->text('alamat')->nullable();
            $table->string('no_telp')->unique()->nullable();
            $table->string('nik',16)->unique()->nullable();
            $table->string('ktp')->nullable();
            $table->boolean('is_account_verified')->default(true);
            $table->string('verification_token')->nullable();
            $table->enum('isVerificate', ['diperiksa', 'diterima', 'ditolak'])->default('diperiksa');
            $table->string('alasan_ditolak')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjams');
    }
};
