<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasRoles;
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function guru()
    {
        return $this->hasOne(\App\Models\Guru::class, 'user_id');
    }

    public function siswa()
    {
        return $this->hasOne(\App\Models\Siswa::class, 'user_id');
    }

    public function profile()
    {
        return $this->hasOne(\App\Models\Profile::class, 'user_id');
    }

    public function profileGuru()
    {
        return $this->hasOne(\App\Models\ProfileGuru::class, 'user_id');
    }

    public function profileAdmin()
    {
        return $this->hasOne(\App\Models\Profileadmin::class, 'user_id');
    }
}
