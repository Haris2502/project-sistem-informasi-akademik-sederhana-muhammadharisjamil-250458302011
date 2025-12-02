<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'user_id',
        'nis',
        'name',
        'mata_pelajaran',
        'tahun_angkatan',
        'telepon',
        'tempat_lahir',
        'tanggal_lahir',
        'gender',
        'alasan_belajar_disini',
        'photo',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
