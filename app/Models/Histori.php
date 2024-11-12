<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Histori extends Model
{
    //
    protected $table = 'historis';
    //
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
