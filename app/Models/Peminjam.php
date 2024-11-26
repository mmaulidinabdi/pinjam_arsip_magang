<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Peminjam extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    use HasFactory;
    //
    protected $table = 'peminjams';
    //
    protected $guarded = ['id'];



    public function histori()
    {
        return $this->hasMany(Histori::class, 'peminjam_id');
    }
}
