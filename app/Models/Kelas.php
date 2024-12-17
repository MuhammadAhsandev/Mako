<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_kelas',
        'jurusan',
        'tahun_ajaran',
    ];

    // Model Siswa
    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function siswa()
    {
        return $this->hasMany(Siswa::class);
    }

    public function waliKelas()
    {
        return $this->hasOne(WaliKelas::class);
    }
}
