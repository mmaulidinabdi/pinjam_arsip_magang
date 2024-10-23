<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
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
}
