<?php

namespace App\Livewire\Siswa;

use Livewire\Component;
use App\Models\Presensi;
use Illuminate\Support\Facades\Auth;

class PresensiSaya extends Component
{
    public $list = [];
    public $hadir = 0;
    public $izin = 0;
    public $sakit = 0;

    public function mount()
{
    $user = Auth::user();

    // Jika user bukan siswa → redirect / forbid
    if (!$user || !$user->siswa) {
        abort(403, 'Akses ditolak. Halaman khusus untuk siswa.');
    }

    $siswa = $user->siswa;

    $this->list = Presensi::where('siswa_id', $siswa->id)
        ->orderBy('tanggal', 'DESC')
        ->get();

    $this->hadir = $this->list->where('status', 'hadir')->count();
    $this->izin = $this->list->where('status', 'izin')->count();
    $this->sakit = $this->list->where('status', 'sakit')->count();
}

    public function render()
    {
        return view('livewire.siswa.presensi-saya');
    }
}
