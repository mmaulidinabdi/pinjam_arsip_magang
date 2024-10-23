<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjam extends Model
{
    //
    protected $table = 'kategoris';
    //
    protected $guarded = ['id'];

    public function arsips()
    {
        return $this->hasMany(Arsip::class);
    }
}
