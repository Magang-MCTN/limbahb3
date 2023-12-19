<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeriodeLaporan extends Model
{
    protected $primaryKey = 'id_periode_laporan';

    protected $fillable = ['bulan', 'tahun', 'kuartal', 'keterangan_kuartal', 'keterangan_kuartal', 'no_dokumen_masuk', 'no_dokumen_keluar', 'no_dokumen_neraca', 'id_status_masuk', 'id_status_keluar', 'id_status_neraca', 'alasan_limbah_masuk', 'alasan_limbah_keluar', 'alasan_limbah_neraca', 'tanggal_masuk', 'tanggal_keluar', 'tanggal_neraca'];

    public $timestamps = true;

    // Relasi ke tabel LimbahMasuk
    public function limbahMasuks()
    {
        return $this->hasMany(LimbahMasuk::class, 'id_periode_laporan');
    }

    // Relasi ke tabel LimbahKeluar
    public function limbahKeluar()
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
    public function statuskeluar()
    {
        return $this->belongsTo(Status::class, 'id_status_keluar');
    }

    /**
     * Mendefinisikan relasi dengan model LimbahMasuk.
     */
    public function limbahMasuk()
    {
        return $this->hasMany(LimbahMasuk::class, 'id_periode_laporan');
    }
    public function statusNeraca()
    {
        return $this->belongsTo(Status::class, 'id_status_neraca');
    }
    public function bulan()
    {
        return $this->belongsTo(BulanModel::class, 'id_periode');
    }
    public function bulans()
    {
        return $this->hasMany(BulanModel::class, 'id_periode_laporan');
    }
    public function neracaLimbah1()
    {
        return $this->hasOne(NeracaLimbah1::class, 'id_periode_laporan');
    }

    // Definisikan relasi dengan LimbahMasuk


    // Definisikan relasi dengan NeracaLimbah2
    public function neracaLimbah2()
    {
        return $this->hasOne(NeracaLimbah2::class, 'id_periode_laporan');
    }
}
