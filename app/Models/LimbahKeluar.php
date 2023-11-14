<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LimbahKeluar extends Model
{
    protected $primaryKey = 'id_limbah_keluar';

    protected $fillable = ['tanggal_keluar', 'id_jenis_limbah', 'jumlahkg', 'jumlahton', 'tujuanPenyerahan', 'buktiNomorDokumen', 'sisa_lb3', 'id_status', 'id_periode_laporan', 'id_user', 'alasan_limbah_keluar'];

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
