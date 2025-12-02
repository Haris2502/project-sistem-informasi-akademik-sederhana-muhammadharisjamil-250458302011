<?php

namespace App\Livewire\Siswa;

use Livewire\Component;
use App\Models\Nilai;
use Illuminate\Support\Facades\Auth;

class NilaiSiswa extends Component
{
    public $nilaiList = [];
    public $rataRata = 0;

    public function mount()
    {
        $siswa = Auth::user()->siswa;
        if ($siswa) {
            $this->nilaiList = Nilai::with('mapel')
                ->where('siswa_id', $siswa->id)
                ->get();

            $this->rataRata = round($this->nilaiList->avg('nilai'), 2);
        }
    }

    public function render()
    {
        return view('livewire.siswa.nilai-siswa');
    }
}
