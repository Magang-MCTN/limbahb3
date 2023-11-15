<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LimbahMasuk extends Model
{
    protected $primaryKey = 'id_limbah_masuk';
    protected $table = 'limbah_masuks';
    protected $fillable = ['id_jenis_limbah', 'tanggal_masuk', 'satuan_limbah', 'sumber_limbahB3', 'bentuk_limbahB3', 'maksimal_penyimpanan', 'jumlah_limbah', 'berat_satuan', 'berat', 'id_status', 'id_periode_laporan', 'id_user', 'alasan_limbah_masuk'];

    public $timestamps = true;

    // Relasi ke tabel JenisLimbah
    public function jenisLimbah()
    {
        return $this->belongsTo(JenisLimbah::class, 'id_jenis_limbah');
    }

    // Relasi ke tabel Status
    public function status()
    {
        return $this->belongsTo(Status::class, 'id_status');
    }

    // Relasi ke tabel PeriodeLaporan
    public function periodeLaporan()
    {
        return $this->belongsTo(PeriodeLaporan::class, 'id_periode_laporan');
    }

    // Relasi ke tabel User
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
