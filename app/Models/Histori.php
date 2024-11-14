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
        // Menghubungkan dengan tabel `imb` menggunakan `imb_id`
        return $this->belongsTo(Imb::class, 'imb_id');
    }
    
    public function arsip1()
    {
        // Menghubungkan dengan tabel `arsip1` menggunakan `imb_id`
        return $this->belongsTo(Arsip1::class, 'imb_id');
    }
    
    public function arsip2()
    {
        // Menghubungkan dengan tabel `arsip2` menggunakan `imb_id`
        return $this->belongsTo(Arsip2::class, 'imb_id');
    }
    


}
