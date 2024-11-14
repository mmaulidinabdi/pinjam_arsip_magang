<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Histori extends Model
{
    use HasFactory;
    //
    protected $table = 'historis';
    //

    protected $fillable = [
        'peminjaman_id',
        'peminjam_id',
        'nama_arsip',
        'imb_id',
        'status',
        'alasan_ditolak',
        'tanggal_peminjaman',
        'tujuan_peminjam',
        'dokumen_pendukung',
        'jenis_arsip',
    ];

    public function peminjaman()
    {
        return $this->belongsTo(TransaksiPeminjaman::class);
    }

    // Relasi ke peminjam
    public function peminjam()
    {
        return $this->belongsTo(Peminjam::class, 'peminjam_id');
    }

    public function imb()
    {
        return $this->hasOne(Imb::class);
    }


}
