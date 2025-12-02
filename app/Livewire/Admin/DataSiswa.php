<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Siswa;
use App\Models\User;
use App\Models\Kelas;

class DataSiswa extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $siswa_id, $user_id, $nis, $kelas_id;
    public $search = '';
    public $isEdit = false;

    public $users = [];
    public $kelas = [];

    // Dengarkan event dari JS
    protected $listeners = ['deleteConfirmed' => 'delete'];

    protected function rules()
    {
        return [
            'user_id' => 'required',
            'nis' => 'required|string|max:50|unique:siswa,nis,' . $this->siswa_id,
            'kelas_id' => 'required',
        ];
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $this->users = User::where('role', 'siswa')->get();
        $this->kelas = Kelas::all();

        $siswas = Siswa::with(['user', 'kelas'])
            ->where(function ($query) {
                $query->whereHas('user', function ($q) {
                    $q->where('name', 'like', "%{$this->search}%")
                      ->orWhere('email', 'like', "%{$this->search}%");
                })
                ->orWhere('nis', 'like', "%{$this->search}%");
            })
            ->paginate(5);

        return view('livewire.features.admin.data-siswa', [
            'siswas' => $siswas,
        ]);
    }

    public function resetForm()
    {
        $this->reset(['siswa_id', 'user_id', 'nis', 'kelas_id', 'isEdit']);
        $this->resetValidation();
    }

    public function store()
    {
        $this->validate();

        Siswa::create([
            'user_id' => $this->user_id,
            'nis' => $this->nis,
            'kelas_id' => $this->kelas_id,
        ]);

        session()->flash('success', 'Data siswa berhasil ditambahkan.');
        $this->resetForm();

        $this->dispatch('close-modal');
    }

    public function edit($id)
    {
        $siswa = Siswa::findOrFail($id);

        $this->siswa_id = $siswa->id;
        $this->user_id = $siswa->user_id;
        $this->nis = $siswa->nis;
        $this->kelas_id = $siswa->kelas_id;
        $this->isEdit = true;
    }

    public function update()
    {
        $this->validate();

        $siswa = Siswa::findOrFail($this->siswa_id);
        $siswa->update([
            'user_id' => $this->user_id,
            'nis' => $this->nis,
            'kelas_id' => $this->kelas_id,
        ]);

        session()->flash('success', 'Data siswa berhasil diperbarui.');
        $this->resetForm();

        $this->dispatch('close-modal');
    }

    // ✅ Diperbaiki agar tidak error lagi
    public function delete($id)
{
    $siswa = Siswa::find($id);

    if (!$siswa) {
        session()->flash('error', 'Data siswa tidak ditemukan.');
        return;
    }

    $siswa->delete();

    session()->flash('success', 'Data siswa berhasil dihapus!');
    $this->resetPage();

    // Notifikasi Livewire (opsional)
    $this->dispatch('show-toast', message: 'Data siswa berhasil dihapus!');
}

}
