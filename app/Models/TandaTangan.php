<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TandaTangan extends Model
{
    use HasFactory;

    protected $table = 'tanda_tangan';

    protected $fillable = ['user_id', 'path'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
