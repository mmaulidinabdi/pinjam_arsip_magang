<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Arsip extends Model
{
    //
    protected $table = 'arsips';

    protected $guarded = ['id'];
    
    //
    //relasi dengan kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }


    // relasi arsip dengan peminjaman
    public function peminjamans()
    {
        return $this->belongsToMany(TransaksiPeminjaman::class, 'arsip_peminjaman');
    }
}
