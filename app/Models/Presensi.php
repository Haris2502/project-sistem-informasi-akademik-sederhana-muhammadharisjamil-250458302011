<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    use HasFactory;

    protected $table = 'presensi'; // nama tabel
    protected $primaryKey = 'id';  // primary key

    protected $fillable = [
        'siswa_id',
        'tanggal',
        'status',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    /**
     * Relasi ke model Siswa
     * Setiap presensi dimiliki oleh satu siswa
     */
    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}
