<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeriodeLaporan extends Model
{
    protected $primaryKey = 'id_periode_laporan';

    protected $fillable = ['bulan', 'tahun', 'kuartal', 'keterangan_kuartal', 'no_dokumen_masuk', 'no_dokumen_keluar', 'no_dokumen_neraca', 'id_status_masuk', 'id_status_keluar', 'id_status_neraca'];

    public $timestamps = true;

    // Relasi ke tabel LimbahMasuk
    public function limbahMasuks()
    {
        return $this->hasMany(LimbahMasuk::class, 'id_periode_laporan');
    }

    // Relasi ke tabel LimbahKeluar
    public function limbahKeluars()
    {
        return $this->hasMany(LimbahKeluar::class, 'id_periode_laporan');
    }

    // Relasi ke tabel NeracaLimbah
    public function neracaLimbahs()
    {
        return $this->hasMany(NeracaLimbah::class, 'id_periode_laporan');
    }

    // Relasi ke tabel DataPengelolaanLb3
    public function dataPengelolaanLb3s()
    {
        return $this->hasMany(DataPengelolaanLb3::class, 'id_periode');
    }
    public function status()
    {
        return $this->belongsTo(Status::class, 'id_status_masuk');
    }

    /**
     * Mendefinisikan relasi dengan model LimbahMasuk.
     */
    public function limbahMasuk()
    {
        return $this->hasMany(LimbahMasuk::class, 'id_periode_laporan');
    }
}
