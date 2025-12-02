<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Siswa;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\MataPelajaran;

class DashboardAdmin extends Component
{
    public $totalSiswa;
    public $totalGuru;
    public $totalKelas;
    public $totalMapel;
    public $chartLabels = [];
    public $chartData = [];

    public function mount()
    {
        // Hitung total data
        $this->totalSiswa = Siswa::count();
        $this->totalGuru = Guru::count();
        $this->totalKelas = Kelas::count();
        $this->totalMapel = MataPelajaran::count();

        // Gunakan $this-> agar mengacu ke properti
        $this->chartLabels = ['Siswa', 'Guru', 'Kelas', 'Mata Pelajaran'];
        $this->chartData = [
            $this->totalSiswa,
            $this->totalGuru,
            $this->totalKelas,
            $this->totalMapel
        ];
    }

    public function render()
    {
        return view('livewire.features.admin.dashboard', [
            'totalSiswa' => $this->totalSiswa,
            'totalGuru' => $this->totalGuru,
            'totalKelas' => $this->totalKelas,
            'totalMapel' => $this->totalMapel,
            'chartLabels' => $this->chartLabels,
            'chartData' => $this->chartData
        ])->title('Dashboard Admin');
    }
}
