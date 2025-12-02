<?php

namespace App\Livewire\Guru;

use Livewire\Component;
use App\Models\Presensi;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\User;

class PresensiSiswa extends Component
{
    public $kelas_id;
    public $tanggal;
    public $kelasList = [];
    public $siswaList = [];
    public $presensi = [];
    public $riwayat = [];
    public $showModal = false;

    public $deleteId;

    protected $listeners = [
        'deleteConfirmed' => 'delete'
    ];

    public function mount()
    {
        $this->tanggal = date('Y-m-d');
        $this->kelasList = Kelas::orderBy('nama_kelas')->get();
    }

    public function updatedKelasId()
    {
        if ($this->kelas_id) {
            $this->siswaList = Siswa::with('user')
                ->where('kelas_id', $this->kelas_id)
                ->orderBy(
                    User::select('name')
                        ->whereColumn('users.id', 'siswa.user_id')
                )
                ->get();

            $this->loadRiwayat();
            $this->loadPresensiForm();
        } else {
            $this->siswaList = [];
            $this->riwayat = [];
        }
    }

    public function updatedTanggal()
    {
        $this->loadRiwayat();
        $this->loadPresensiForm();
    }

    public function loadPresensiForm()
    {
        $this->presensi = [];

        foreach ($this->siswaList as $siswa) {
            $cek = Presensi::where('siswa_id', $siswa->id)
                ->where('tanggal', $this->tanggal)
                ->first();

            $this->presensi[$siswa->id] = $cek->status ?? '';
        }
    }

    public function loadRiwayat()
    {
        if ($this->kelas_id && $this->tanggal) {
            $this->riwayat = Presensi::with('siswa.user')
                ->whereHas('siswa', fn ($q) => $q->where('kelas_id', $this->kelas_id))
                ->where('tanggal', $this->tanggal)
                ->get();
        }
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
        foreach ($this->presensi as $siswa_id => $status) {
            if (!$status) continue;

            Presensi::updateOrCreate(
                [
                    'siswa_id' => $siswa_id,
                    'tanggal'  => $this->tanggal,
                ],
                [
                    'status' => $status,
                ]
            );
        }

        session()->flash('success', 'Presensi berhasil disimpan!');
        $this->closeModal();
        $this->loadRiwayat();
    }

    public function updatePresensi($id, $value)
    {
        Presensi::where('id', $id)->update(['status' => $value]);
        $this->loadRiwayat();
    }

    /** ---------------------
     *  DELETE PRESENSI
     * --------------------- */
    

    public function render()
    {
        return view('livewire.guru.presensi-siswa');
    }
}
