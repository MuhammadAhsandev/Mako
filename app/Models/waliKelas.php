<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class waliKelas extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'guru_id',
        'kelas_id',
    ];

    

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }
}
