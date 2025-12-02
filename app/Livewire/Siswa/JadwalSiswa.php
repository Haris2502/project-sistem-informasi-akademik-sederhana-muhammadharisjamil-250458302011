<?php

namespace App\Livewire\Siswa;

use Livewire\Component;
use App\Models\Jadwal;
use Illuminate\Support\Facades\Auth;

class JadwalSiswa extends Component
{
    public $jadwalList = [];

    public function mount()
{
    $siswa = Auth::user()->siswa;

    if ($siswa?->kelas_id) {
        $this->jadwalList = Jadwal::with(['mapel', 'guru.user'])
            ->where('kelas_id', $siswa->kelas_id)
            ->orderBy('hari')
            ->orderBy('jam')
            ->get();
    }
}


    public function render()
    {
        return view('livewire.siswa.jadwal-siswa');
    }
}
