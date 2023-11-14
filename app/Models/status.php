<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class status extends Model
{
    protected $primaryKey = 'id_status';

    protected $fillable = ['nama'];

    public $timestamps = false;

    // Relasi ke tabel LimbahMasuk
    public function limbahMasuks()
    {
        return $this->hasMany(LimbahMasuk::class, 'id_status');
    }

    // Relasi ke tabel LimbahKeluar
    public function limbahKeluars()
    {
        return $this->hasMany(LimbahKeluar::class, 'id_status');
    }

    // Relasi ke tabel NeracaLimbah
    public function neracaLimbahs()
    {
        return $this->hasMany(NeracaLimbah::class, 'id_status');
    }

    // Relasi ke tabel DataPengelolaanLb3
    public function dataPengelolaanLb3s()
    {
        return $this->hasMany(DataPengelolaanLb3::class, 'id_status');
    }
}
