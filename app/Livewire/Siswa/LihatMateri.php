<?php

namespace App\Livewire\Siswa;

use Livewire\Component;
use App\Models\Materi;
use Illuminate\Support\Facades\Auth;

class LihatMateri extends Component
{
    public function render()
    {
        $siswa = Auth::user()->siswa ?? null;

        // Jika materi tidak punya kolom kelas_id, ambil semua
        $materi = Materi::latest()->paginate(10);

        return view('livewire.siswa.lihat-materi', [
            'materi' => $materi,
        ]);
    }
}
