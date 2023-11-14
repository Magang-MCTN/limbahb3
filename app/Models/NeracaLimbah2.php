<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NeracaLimbah2 extends Model
{
    protected $primaryKey = 'id_neraca_limbah_2';

    protected $fillable = [
        'id_user', 'id_periode_laporan', 'total_neraca', 'residu',
        'limbah_belum_dikelola', 'limbah_tersisa', 'kinerja_pengelolaan',
        'dokumen_kontrol', 'perizinan_limbah_klh', 'no_izin_limbah_klh', 'catatan'
    ];

    public $timestamps = true;

    // Relasi dengan tabel User
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    // Relasi dengan tabel PeriodeLaporan
    public function periodeLaporan()
    {
        return $this->belongsTo(PeriodeLaporan::class, 'id_periode_laporan');
    }
}
