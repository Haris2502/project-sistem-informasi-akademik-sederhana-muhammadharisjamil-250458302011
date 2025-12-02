<?php

namespace App\Livewire\Guru;

use Livewire\Component;
use App\Models\Siswa;
use App\Models\MataPelajaran;
use App\Models\Kelas;
use App\Models\Nilai;
use Illuminate\Support\Facades\Auth;

class DashboardGuru extends Component
{
    public $totalSiswa = 0;
    public $totalMapel = 0;
    public $totalKelas = 0;
    public $rataRataNilaiKeseluruhan = 0;

    public $chartNilai = [];
    public $chartKelas = [];
    public $chartDistribusiNilai = [];
    public $chartTrendNilai = [];

    public function mount()
    {

        $this->totalSiswa = Siswa::count();
        $this->totalMapel = MataPelajaran::count();
        $this->totalKelas = Kelas::count();

        $nilai = Nilai::avg('nilai');
        $this->rataRataNilaiKeseluruhan = $nilai ? round($nilai, 2) : 0;

        $this->chartNilai = MataPelajaran::with('nilai')
            ->get()
            ->map(function ($m) {
                $rata = $m->nilai->avg('nilai');
                return [
                    'mapel' => $m->nama_mapel,
                    'rata' => $rata ? round($rata, 2) : 0
                ];
            })
            ->toArray();

        $this->chartKelas = Kelas::withCount('siswa')
            ->get()
            ->map(function ($k) {
                return [
                    'kelas' => $k->nama_kelas,
                    'jumlah' => $k->siswa_count
                ];
            })
            ->toArray();

        $kategori = [
            ['range' => '0-50', 'min' => 0, 'max' => 50],
            ['range' => '51-70', 'min' => 51, 'max' => 70],
            ['range' => '71-85', 'min' => 71, 'max' => 85],
            ['range' => '86-100', 'min' => 86, 'max' => 100],
        ];

        $this->chartDistribusiNilai = collect($kategori)->map(function ($item) {
            $jumlah = Nilai::whereBetween('nilai', [$item['min'], $item['max']])->count();
            return [
                'range' => $item['range'],
                'jumlah' => $jumlah
            ];
        })->toArray();

        $this->chartTrendNilai = MataPelajaran::with('nilai')
            ->get()
            ->map(function ($m) {
                return [
                    'mapel' => $m->nama_mapel,
                    'tertinggi' => $m->nilai->max('nilai') ?? 0,
                    'rata' => round($m->nilai->avg('nilai') ?? 0, 2),
                    'terendah' => $m->nilai->min('nilai') ?? 0
                ];
            })
            ->toArray();
    }

    public function render()
    {
        return view('livewire.guru.dashboard');
    }
}
