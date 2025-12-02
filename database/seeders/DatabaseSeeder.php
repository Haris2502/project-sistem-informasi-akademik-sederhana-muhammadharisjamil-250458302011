<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Siswa;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\MataPelajaran;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@gnail.com',
        ]);

        User::factory(10)->create()([
            'role' => 'guru',
        ]);
        User::factory(20)->create()([
            'role' => 'siswa',
        ]);
        User::factory(5)->create()([
            'role' => 'admin',
        ]);
    }
}
