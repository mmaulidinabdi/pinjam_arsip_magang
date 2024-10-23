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
}
