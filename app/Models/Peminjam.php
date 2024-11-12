<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Peminjam extends Authenticatable
{
    //
    protected $table = 'peminjams';
    //
    protected $guarded = ['id'];

    

    public function histori()
    {
        return $this->hasMany(Histori::class, 'peminjam_id');
    }
}
