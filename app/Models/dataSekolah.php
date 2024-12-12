<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dataSekolah extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_sekolah',
        'NPSN',
        'alamat',
    ];
}
