<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['name', 'email', 'password', 'id_role'];

    protected $hidden = ['password', 'remember_token'];

    public $timestamps = true;

    // Relasi ke tabel Role
    public function role()
    {
        return $this->belongsTo(Role::class, 'id_role');
    }

    // Relasi ke tabel LimbahMasuk
    public function limbahMasuks()
    {
        return $this->hasMany(LimbahMasuk::class, 'id_user');
    }

    // Relasi ke tabel LimbahKeluar
    public function limbahKeluars()
    {
        return $this->hasMany(LimbahKeluar::class, 'id_user');
    }

    // Relasi ke tabel NeracaLimbah
    public function neracaLimbahs()
    {
        return $this->hasMany(NeracaLimbah::class, 'id_user');
    }

    // Relasi ke tabel DataPengelolaanLb3
    public function dataPengelolaanLb3s()
    {
        return $this->hasMany(DataPengelolaanLb3::class, 'id_user');
    }
}
