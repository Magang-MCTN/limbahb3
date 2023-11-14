<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisLimbah extends Model
{
    protected $primaryKey = 'id_jenis_limbah';

    protected $fillable = ['jenis_limbah'];

    public $timestamps = true;

    // Relasi ke tabel LimbahMasuk
    public function limbahMasuks()
    {
        return $this->hasMany(LimbahMasuk::class, 'id_jenis_limbah');
    }

    // Relasi ke tabel LimbahKeluar
    public function limbahKeluars()
    {
        return $this->hasMany(LimbahKeluar::class, 'id_jenis_limbah');
    }

    // Relasi ke tabel NeracaLimbah1
    public function neracaLimbah1s()
    {
        return $this->hasMany(NeracaLimbah1::class, 'id_jenis_limbah');
    }
}
