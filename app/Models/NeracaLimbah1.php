<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NeracaLimbah1 extends Model
{
    protected $primaryKey = 'id_neraca_limbah_1';
    protected $table = 'neraca_limbah_1s';
    protected $fillable = ['id_user', 'disimpan', 'id_periode_laporan', 'sumber_limbah', 'id_jenis_limbah', 'dihasilkan', 'dimanfaatkan', 'diolah', 'ditimbun', 'diserahkan', 'eksport', 'lainnya', 'id_bulan'];

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
    public function bulan()
    {
        return $this->belongsTo(BulanModel::class, 'id_bulan', 'id_bulan');
    }
}
