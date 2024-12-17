<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'siswa_id',
        'nama_prestasi',
        'lv_prestasi',
        'tanggal_prestasi',
        'keterangan',
        'input_data',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class,'siswa_id');
    }
}
