<?php

namespace App\Livewire\Guru;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\Guru;
use App\Models\MataPelajaran;

class JadwalPelajaran extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $jadwal_id;
    public $kelas_id, $guru_id, $mapel_id, $hari, $jam;
    public $isEdit = false;

    public $kelasList = [];
    public $guruList = [];
    public $mapelList = [];

    public $search = '';

    // Listener untuk konfirmasi hapus dari js
    protected $listeners = ['deleteConfirmed' => 'delete'];

    public function mount()
    {
        $this->kelasList = Kelas::all();
        $this->guruList = Guru::with('user')->get();
        $this->mapelList = MataPelajaran::all();
    }

    protected function rules()
    {
        return [
            'kelas_id' => 'required',
            'guru_id' => 'required',
            'mapel_id' => 'required',
            'hari' => 'required|string',
            'jam' => 'required',
        ];
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $jadwalList = Jadwal::with(['kelas', 'guru.user', 'mapel'])
            ->whereHas('kelas', function ($q) {
                $q->where('nama_kelas', 'like', "%{$this->search}%");
            })
            ->orWhereHas('guru.user', function ($q) {
                $q->where('name', 'like', "%{$this->search}%");
            })
            ->orWhereHas('mapel', function ($q) {
                $q->where('nama_mapel', 'like', "%{$this->search}%");
            })
            ->paginate(5);

        return view('livewire.guru.jadwal-pelajaran', [
            'jadwalList' => $jadwalList,
        ]);
    }

    public function resetForm()
    {
        $this->reset([
            'jadwal_id',
            'kelas_id',
            'guru_id',
            'mapel_id',
            'hari',
            'jam',
            'isEdit'
        ]);
    }

    // ========================= STORE =========================
    public function store()
    {
        $this->validate();

        Jadwal::create([
            'kelas_id' => $this->kelas_id,
            'guru_id'  => $this->guru_id,
            'mapel_id' => $this->mapel_id,
            'hari'     => $this->hari,
            'jam'      => $this->jam,
        ]);

        session()->flash('success', 'Jadwal berhasil ditambahkan!');
        $this->resetForm();

        $this->dispatch('close-modal');
    }

    // ========================= EDIT =========================
    public function edit($id)
    {
        $jadwal = Jadwal::findOrFail($id);

        $this->jadwal_id = $jadwal->id;
        $this->kelas_id  = $jadwal->kelas_id;
        $this->guru_id   = $jadwal->guru_id;
        $this->mapel_id  = $jadwal->mapel_id;
        $this->hari      = $jadwal->hari;
        $this->jam       = $jadwal->jam;

        $this->isEdit = true;
    }

    // ========================= UPDATE =========================
    public function update()
    {
        $this->validate();

        $jadwal = Jadwal::findOrFail($this->jadwal_id);

        $jadwal->update([
            'kelas_id' => $this->kelas_id,
            'guru_id'  => $this->guru_id,
            'mapel_id' => $this->mapel_id,
            'hari'     => $this->hari,
            'jam'      => $this->jam,
        ]);

        session()->flash('success', 'Jadwal berhasil diperbarui!');
        $this->resetForm();

        $this->dispatch('close-modal');
    }

    // ========================= DELETE =========================
    public function delete($id)
    {
        $jadwal = Jadwal::find($id);

        if (!$jadwal) {
            session()->flash('error', 'Data jadwal tidak ditemukan!');
            return;
        }

        $jadwal->delete();

        session()->flash('success', 'Jadwal berhasil dihapus!');
        $this->resetPage();

        $this->dispatch('show-toast', message: 'Jadwal berhasil dihapus!');
    }
}
