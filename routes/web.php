<?php

use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Admin\DataGuru;
use App\Livewire\Admin\DataSiswa;
use App\Livewire\Guru\InputNilai;
use App\Livewire\Siswa\CetakRapor;
use App\Livewire\Guru\UploadMateri;
use App\Livewire\Siswa\JadwalSiswa;
use App\Livewire\Siswa\LihatMateri;
use App\Livewire\Siswa\UploadTugas;
use App\Livewire\Guru\DashboardGuru;
use App\Livewire\Guru\PresensiSiswa;
use App\Livewire\Siswa\PresensiSaya;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\DashboardAdmin;
use App\Livewire\Admin\DataKelasSiswa;
use App\Livewire\Guru\JadwalPelajaran;
use App\Livewire\Guru\LihatTugasSiswa;
use App\Livewire\Siswa\DashboardSiswa;
use App\Livewire\Guru\KelolaPengumuman;
use App\Livewire\Guru\UpdateProfileGuru;
use App\Livewire\Admin\DataMataPelajaran;
use App\Livewire\Admin\UpdateProfileAdmin;
use App\Livewire\Siswa\UpdateProfileSiswa;



Route::get('/', function () {
    return view('welcome');
});

Route::prefix('auth')->group(function () {
    Route::get('/login', Login::class)->name('login');
    Route::get('/register', Register::class)->name('register');
});

Route::middleware('auth')->group(function () {
    Route::middleware('role:admin')->prefix('admin')->group(function () {
        Route::get('/dashboard', DashboardAdmin::class)->name('admin.dashboard');
        Route::get('/data/siswa', DataSiswa::class)->name('admin.data.siswa');
        Route::get('/data/guru', DataGuru::class)->name('admin.data.guru');
        Route::get('/admin/mata-pelajaran', DataMataPelajaran::class)->name('admin.mata-pelajaran');
        Route::get('/admin/kelas-siswa', DataKelasSiswa::class)->name('admin.kelas-siswa');
        Route::get('/update-profile', UpdateProfileAdmin::class)->name('admin.update-profile-admin');
    });

    Route::middleware('role:guru')->prefix('guru')->group(function () {
        Route::get('/dashboard', DashboardGuru::class)->name('guru.dashboard');
        Route::get('/jadwal-pelajaran', JadwalPelajaran::class)->name('guru.jadwal-pelajaran');
        Route::get('/upload-materi', UploadMateri::class)->name('guru.upload-materi');
        Route::get('/kelola-pengumuman', KelolaPengumuman::class)->name('guru.kelola-pengumuman');
        Route::get('/presensi-siswa', PresensiSiswa::class)->name('guru.presensi-siswa');
        Route::get('/input-nilai', InputNilai::class)->name('guru.input-nilai');
        Route::get('/lihat-tugas', LihatTugasSiswa::class)->name('guru.lihat-tugas');
        Route::get('/update-profile', UpdateProfileGuru::class)->name('guru.update-profile-guru');
    });

    Route::middleware('role:siswa')->prefix('siswa')->group(function () {
        Route::get('/dashboard', DashboardSiswa::class)->name('siswa.dashboard');
        Route::get('/lihat-materi', LihatMateri::class)->name('siswa.lihat-materi');
        Route::get('/jadwal-siswa', JadwalSiswa::class)->name('siswa.jadwal-siswa');
        Route::get('/presensi-saya', PresensiSaya::class)->name('siswa.presensi-saya');
        Route::get('/cetak-rapor', CetakRapor::class)->name('siswa.cetak-rapor');
        Route::get('/upload-tugas', UploadTugas::class)->name('siswa.upload-tugas');
        Route::get('/update-profile', UpdateProfileSiswa::class)->name('siswa.update-profile');
    });

    Route::post('/logout', function () {
    Auth::logout();

    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect('/auth/login');
    })->name('logout');
});
