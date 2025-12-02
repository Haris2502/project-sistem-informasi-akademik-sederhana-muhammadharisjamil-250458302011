<?php

namespace App\Livewire\Siswa;

use Livewire\Component;
use App\Models\MataPelajaran;
use App\Models\Nilai;
use App\Models\Pengumuman;
use Illuminate\Support\Facades\Auth;

class DashboardSiswa extends Component
{
    public $totalMapel = 0;
    public $rataRataNilai = 0;
    public $jumlahPengumuman = 0;
    public $persentaseKehadiran = 0;

    public $mapelList = [];
    public $materiList = [];
    public $pengumumanList = [];
    public $chartData = [];

    public function mount()
    {
        $user = Auth::user();
        $siswa = $user->siswa;

        if (!$siswa) {
            session()->flash('error', 'Data siswa tidak ditemukan.');
            return;
        }

        // Mapel + relasi
        $this->mapelList = MataPelajaran::with(['nilai', 'materi'])->get();
        $this->totalMapel = $this->mapelList->count();

        // Nilai siswa
        $nilaiSiswa = Nilai::where('siswa_id', $siswa->id)->get();
        $this->rataRataNilai = $nilaiSiswa->avg('nilai') ?? 0;

        // Materi terbaru (limit 5 per mapel)
        $this->materiList = $this->mapelList->map(function ($m) {
            return [
                'mapel' => $m->nama_mapel,
                'materi' => $m->materi?->take(5) ?? collect(),
            ];
        });

        // Pengumuman terbaru + isi
        $this->pengumumanList = Pengumuman::latest()
            ->select('id', 'judul', 'isi', 'tanggal')
            ->take(5)
            ->get();

        $this->jumlahPengumuman = $this->pengumumanList->count();

        // Chart Data
        $this->chartData = $nilaiSiswa->mapWithKeys(function ($n) {
            return [$n->mapel->nama_mapel => $n->nilai];
        })->toArray();
    }

    public function render()
    {
        return view('livewire.siswa.dashboard-siswa');
    }
}
