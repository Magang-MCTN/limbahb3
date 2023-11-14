<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPengelolaanLb3 extends Model
{
    protected $primaryKey = 'id_data_pengelolaan_lb3';

    protected $fillable = [
        'id_limbah_masuk', 'id_limbah_keluar', 'id_neraca_limbah',
        'no_dokumen', 'file_klhk', 'file_pemda_riau', 'file_pemda_bengkalis',
        'id_status', 'id_user', 'id_periode'
    ];

    public $timestamps = true;

    // Relasi dengan tabel LimbahMasuk
    public function limbahMasuk()
    {
        return $this->belongsTo(LimbahMasuk::class, 'id_limbah_masuk');
    }

    // Relasi dengan tabel LimbahKeluar
    public function limbahKeluar()
    {
        return $this->belongsTo(LimbahKeluar::class, 'id_limbah_keluar');
    }

    // Relasi dengan tabel NeracaLimbah
    public function neracaLimbah()
    {
        return $this->belongsTo(NeracaLimbah::class, 'id_neraca_limbah');
    }

    // Relasi dengan tabel Status
    public function status()
    {
        return $this->belongsTo(Status::class, 'id_status');
    }

    // Relasi dengan tabel User
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    // Relasi dengan tabel PeriodeLaporan
    public function periodeLaporan()
    {
        return $this->belongsTo(PeriodeLaporan::class, 'id_periode');
    }
}
