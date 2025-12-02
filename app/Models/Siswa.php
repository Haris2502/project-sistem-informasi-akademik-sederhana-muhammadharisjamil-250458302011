<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswa';

    protected $fillable = [
        'user_id',
        'nis',
        'kelas_id',
    ];

    /**
     * Relasi ke User (nama & email siswa)
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relasi ke Kelas
     */
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    /**
     * Relasi ke Nilai siswa
     */
    public function nilai()
    {
        return $this->hasMany(Nilai::class, 'siswa_id');
    }

    /**
     * Relasi ke Presensi siswa
     */
    public function presensi()
    {
        return $this->hasMany(Presensi::class, 'siswa_id');
    }
}
