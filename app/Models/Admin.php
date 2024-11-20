<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

use function PHPUnit\Framework\returnSelf;

class Admin extends Authenticatable
{
    //
    protected $guarded = ['id'];
    protected $table = 'admins';

    // Jika ingin menambahkan autentikasi khusus untuk admin
    protected $guard = 'admin';

    public function peminjaman()
    {
        return $this->hasMany(TransaksiPeminjaman::class);
    }


    public function imb()
    {
        return $this->hasMany(Imb::class);
    }

    // Tambahkan relasi arsip yg lain

    public function sk()
    {
        return $this->hasMany(SK::class);
    }

}
