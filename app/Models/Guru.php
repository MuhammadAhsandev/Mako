<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Guru extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
        'NIP',
        'email',
        'alamat',
        'no_telp',
        'role',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
