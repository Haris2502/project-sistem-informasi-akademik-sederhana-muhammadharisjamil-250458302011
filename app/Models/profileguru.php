<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class profileguru extends Model
{
    protected $fillable = [
        'user_id',
        'nip',
        'name',
        'kelas',
        'telepon',
        'tempat_lahir',
        'tanggal_lahir',
        'gender',
        'photo',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
