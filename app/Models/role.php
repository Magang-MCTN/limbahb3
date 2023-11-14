<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class role extends Model
{
    protected $primaryKey = 'id_role';

    protected $fillable = ['nama_role', 'keterangan_role'];

    public $timestamps = true;

    // Relasi ke tabel User
    public function users()
    {
        return $this->hasMany(User::class, 'id_role');
    }
}
