<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama',
        'NISN',
        'kelas_id',
        'email',
        'alamat',
        'no_telp',
        'orangtua_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function orangtua()
    {
        return $this->belongsTo(OrangTua::class);
    }

    public function prestasi()
    {
        return $this->hasMany(Prestasi::class);
    }

    public function pelanggaran()
    {
        return $this->hasMany(Pelanggaran::class);
    }
}
