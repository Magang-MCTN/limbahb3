<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NeracaLimbah1 extends Model
{
    protected $primaryKey = 'id_neraca_limbah_1';

    protected $fillable = ['id_user', 'id_periode_laporan', 'sumber_limbah', 'id_jenis_limbah', 'dihasilkan', 'dimanfaatkan', 'diolah', 'ditimbun', 'diserahkan', 'eksport', 'lainnya'];

    public $timestamps = true;

    // Relasi ke tabel JenisLimbah
    public function jenisLimbah()
    {
        return $this->belongsTo(JenisLimbah::class, 'id_jenis_limbah');
    }

    // Relasi ke tabel User
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    // Relasi ke tabel PeriodeLaporan
    public function periodeLaporan()
    {
        return $this->belongsTo(PeriodeLaporan::class, 'id_periode_laporan');
    }
}
