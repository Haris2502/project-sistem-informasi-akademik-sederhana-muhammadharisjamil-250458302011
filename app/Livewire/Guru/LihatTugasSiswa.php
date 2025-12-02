<?php

namespace App\Livewire\Guru;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\TugasSiswa;
use Illuminate\Support\Facades\Auth;

class LihatTugasSiswa extends Component
{
    use WithPagination;

    public function render()
    {
        $guru = Auth::user()->guru;

        // Ambil semua ID mapel yang diajar guru
        $mapelIds = $guru->mapel()->pluck('id');

        // Ambil tugas siswa berdasarkan mapel yang diajar guru
        $tugasSiswa = TugasSiswa::with(['siswa.user', 'mapel'])
            ->whereIn('mapel_id', $mapelIds)
            ->latest()
            ->paginate(10);

        return view('livewire.guru.lihat-tugas-siswa', [
            'tugasSiswa' => $tugasSiswa,
        ]);
    }
}
