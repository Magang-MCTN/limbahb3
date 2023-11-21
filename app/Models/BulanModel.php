<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BulanModel extends Model
{
    use HasFactory;
    protected $table = 'bulan';
    protected $primaryKey = 'id_bulan';
    protected $fillable = ['nama_bulan', 'id_periode_laporan'];
    public $timestamps = true;

    // Relasi dengan PeriodeLaporan
    public function periodeLaporan()
    {
        return $this->belongsTo(PeriodeLaporan::class, 'id_periode_laporan', 'id_periode_laporan');
    }
}
