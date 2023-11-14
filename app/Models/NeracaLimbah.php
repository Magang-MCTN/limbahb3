<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NeracaLimbah extends Model
{
    protected $primaryKey = 'id_neraca_limbah';

    protected $fillable = [
        'id_user', 'id_status', 'id_periode_laporan', 'id_neraca_limbah_2'
    ];

    public $timestamps = true;

    // Relasi dengan tabel User
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    // Relasi dengan tabel Status
    public function status()
    {
        return $this->belongsTo(Status::class, 'id_status');
    }

    // Relasi dengan tabel PeriodeLaporan
    public function periodeLaporan()
    {
        return $this->belongsTo(PeriodeLaporan::class, 'id_periode_laporan');
    }

    // Relasi dengan tabel NeracaLimbah2
    public function neracaLimbah2()
    {
        return $this->belongsTo(NeracaLimbah2::class, 'id_neraca_limbah_2');
    }
}
