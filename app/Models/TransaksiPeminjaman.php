<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransaksiPeminjaman extends Model
{
    //
    protected $table = 'peminjamans';

    //relasi peminjaman dengan peminjam
    public function peminjam()
    {
        return $this->belongsTo(Peminjam::class);
    }

    // relasi peminjaman dengan arsips
    public function arsips()
    {
        return $this->belongsToMany(Arsip::class, 'arsip_peminjaman');
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
