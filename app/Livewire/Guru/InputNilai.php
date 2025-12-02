<?php

namespace App\Livewire\Guru;

use Livewire\Component;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\MataPelajaran;
use App\Models\Nilai;
use App\Models\User;

class InputNilai extends Component
{
    public $kelas_id;
    public $mapel_id;

    public $kelasList = [];
    public $mapelList = [];
    public $siswaList = [];
    public $nilai = [];
    public $riwayat = [];

    public $showModal = false;

    public function mount()
    {
        $this->kelasList = Kelas::orderBy('nama_kelas')->get();
        $this->mapelList = MataPelajaran::orderBy('nama_mapel')->get();
    }

    public function updatedKelasId()
    {
        $this->loadSiswa();
        $this->loadRiwayat();
        $this->loadFormNilai();
    }

    public function updatedMapelId()
    {
        $this->loadRiwayat();
        $this->loadFormNilai();
    }

    public function loadSiswa()
    {
        if (!$this->kelas_id) {
            $this->siswaList = [];
            return;
        }

        $this->siswaList = Siswa::with('user')
            ->where('kelas_id', $this->kelas_id)
            ->orderBy(
                User::select('name')->whereColumn('users.id', 'siswa.user_id')
            )
            ->get();
    }

    public function loadFormNilai()
    {
        $this->nilai = [];

        if (!$this->kelas_id || !$this->mapel_id) return;

        foreach ($this->siswaList as $siswa) {

            $cek = Nilai::where('siswa_id', $siswa->id)
                ->where('mapel_id', $this->mapel_id)
                ->first();

            $this->nilai[$siswa->id] = $cek->nilai ?? '';
        }
    }

    public function loadRiwayat()
{
    if (!$this->kelas_id || !$this->mapel_id) {
        $this->riwayat = [];
        $this->dispatch('updateChart', [], []);
        return;
    }

    $this->riwayat = Nilai::with('siswa.user', 'mapel')
        ->whereHas('siswa', fn ($q) => $q->where('kelas_id', $this->kelas_id))
        ->where('mapel_id', $this->mapel_id)
        ->get();

    // 🔥 Kirim data ke grafik
    $this->dispatch(
        'updateChart',
        $this->riwayat->pluck('siswa.user.name'),
        $this->riwayat->pluck('nilai')
    );
}


    public function openModal()
    {
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

    public function simpan()
{
    foreach ($this->nilai as $siswa_id => $value) {
        if ($value === '' || $value === null) continue;

        Nilai::updateOrCreate(
            [
                'siswa_id' => $siswa_id,
                'mapel_id' => $this->mapel_id,
            ],
            [
                'nilai' => $value,
                'guru_id' => auth()->user()->guru->id ?? null,
            ]
        );
    }

    session()->flash('success', 'Nilai berhasil disimpan!');
    $this->closeModal();
    $this->loadRiwayat(); // ini otomatis update chart
}

public function updateNilai($id, $value)
{
    Nilai::where('id', $id)->update(['nilai' => $value]);
    $this->loadRiwayat(); // otomatis update chart
}


    public function render()
    {
        return view('livewire.guru.input-nilai');
    }
}
