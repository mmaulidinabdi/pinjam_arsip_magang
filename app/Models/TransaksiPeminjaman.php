<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory; 
use Illuminate\Database\Eloquent\Model;

class TransaksiPeminjaman extends Model
{
    
    use HasFactory;
    //
    protected $table = 'transaksi_peminjamans';

    protected $fillable = [
        'peminjam_id',
        'tanggal_peminjaman',
        'tujuan_peminjam',
        'dokumen_pendukung',
        'status',
        'no_arsip',
        'nama_arsip',
        'data_arsip',
        'jenis_arsip',
        'alasan_ditolak',

    ];


    //relasi peminjaman dengan peminjam
    public function peminjam()
    {
        return $this->belongsTo(Peminjam::class);
    }

    // relasi peminjaman dengan arsips
    public function arsips()
    {
        return $this->belongsToMany(Imb::class, 'imb_id');
    }

    // relasi peminjaman ke atmin
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function histori()
    {
        return $this->hasOne(Histori::class);
    }

    
}
