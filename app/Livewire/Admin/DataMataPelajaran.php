<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\MataPelajaran;

class DataMataPelajaran extends Component
{
    use WithPagination;

    public $mata_pelajaran_id, $kode_mapel, $nama_mapel, $deskripsi;
    public $isEdit = false;
    public $search = '';

    protected $rules = [
        'nama_mapel' => 'required|string|max:255',
        'kode_mapel' => 'nullable|string|max:50',
        'deskripsi' => 'nullable|string',
    ];

    protected $listeners = ['deleteConfirmed' => 'delete'];


    public function render()
    {
        $mataPelajaran = MataPelajaran::where('nama_mapel', 'like', '%' . $this->search . '%')
            ->orderBy('nama_mapel', 'asc')
            ->paginate(10);

        return view('livewire.features.admin.data-mata-pelajaran', [
            'mataPelajaran' => $mataPelajaran
        ]);
    }

    public function resetForm()
    {
        $this->mata_pelajaran_id = null;
        $this->nama_mapel = '';
        $this->kode_mapel = '';
        $this->deskripsi = '';
        $this->isEdit = false;
    }

    public function store()
    {
        $this->validate();

        MataPelajaran::create([
            'kode_mapel' => $this->kode_mapel,
            'nama_mapel' => $this->nama_mapel,
            'deskripsi' => $this->deskripsi,
        ]);

        session()->flash('success', 'Mata Pelajaran berhasil ditambahkan!');
        $this->resetForm();
    }

    public function edit($id)
    {
        $mapel = MataPelajaran::findOrFail($id);
        $this->mata_pelajaran_id = $id;
        $this->nama_mapel = $mapel->nama_mapel;
        $this->kode_mapel = $mapel->kode_mapel;
        $this->deskripsi = $mapel->deskripsi;
        $this->isEdit = true;
    }

    public function update()
    {
        $this->validate();

        $mapel = MataPelajaran::findOrFail($this->mata_pelajaran_id);
        $mapel->update([
            'kode_mapel' => $this->kode_mapel,
            'nama_mapel' => $this->nama_mapel,
            'deskripsi' => $this->deskripsi,
        ]);

        session()->flash('success', 'Mata Pelajaran berhasil diperbarui!');
        $this->resetForm();
    }

    public function delete($id)
    {
        // Cek apakah data mapel ada
        $mapel = MataPelajaran::find($id);

        if (!$mapel) {
            session()->flash('error', 'Data mata pelajaran tidak ditemukan.');
            return;
        }

        // Hapus data mapel
        $mapel->delete();

        session()->flash('success', 'Data mata pelajaran berhasil dihapus!');

        // Reset halaman (kalau pakai pagination)
        $this->resetPage();
    }
}
