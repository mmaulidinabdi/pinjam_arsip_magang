<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imb extends Model
{
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
        'imbs'
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
