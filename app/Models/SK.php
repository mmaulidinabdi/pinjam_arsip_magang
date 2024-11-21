<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SK extends Model
{
    //
    use HasFactory;
    //

    protected $table ='sk'; 

    protected $fillable = [
        'nomor_sk',
        'tahun',
        'tanggal_penetapan',
        'tentang',
        'sk'
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
