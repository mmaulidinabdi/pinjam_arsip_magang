<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Arsip2 extends Model
{
    //
    use HasFactory;
    //
    protected $fillable = [
        'nomor_dp',
        'nama_pemilik',
        'alamat',
        'lokasi',
        'box',
        'keterangan',
        'tahun',
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function histori()
    {
        return $this->belongsTo(Histori::class);
    }
}
