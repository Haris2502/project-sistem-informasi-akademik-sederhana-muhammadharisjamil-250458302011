<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profileadmin extends Model
{

    protected $table = 'profile_admins';
    
    protected $fillable = [
        'user_id',
        'name',
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
