<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Imb extends Model
{
    //
    protected $fillable = [
        'nomor_dp',
        'nama',
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
