<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Guru;
use App\Models\User;
use App\Models\MataPelajaran;

class DataGuru extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $guru_id, $user_id, $nip, $mapel_id;
    public $search = '';
    public $isEdit = false;

    public $users = [];
    public $mapels = [];

    protected $listeners = ['deleteConfirmed' => 'delete'];

    protected function rules()
    {
        return [
            'user_id' => 'required',
            'nip' => 'required|string|max:50|unique:guru,nip,' . $this->guru_id,
            'mapel_id' => 'required',
        ];
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $this->users = User::where('role', 'guru')->get();
        $this->mapels = MataPelajaran::all();

        $gurus = Guru::with(['user', 'mapel'])
            ->whereHas('user', function ($query) {
                $query->where('name', 'like', "%{$this->search}%")
                      ->orWhere('email', 'like', "%{$this->search}%");
            })
            ->orWhere('nip', 'like', "%{$this->search}%")
            ->paginate(5);

        return view('livewire.features.admin.data-guru', [
            'gurus' => $gurus,
        ]);
    }

    public function resetForm()
    {
        $this->reset(['guru_id', 'user_id', 'nip', 'mapel_id', 'isEdit']);
    }

    public function store()
    {
        $this->validate();

        Guru::create([
            'user_id' => $this->user_id,
            'nip' => $this->nip,
            'mapel_id' => $this->mapel_id,
        ]);

        session()->flash('success', 'Data guru berhasil ditambahkan.');
        $this->resetForm();

        // ✅ Livewire v3 event
        $this->dispatch('close-modal');
    }

    public function edit($id)
    {
        $guru = Guru::findOrFail($id);

        $this->guru_id = $guru->id;
        $this->user_id = $guru->user_id;
        $this->nip = $guru->nip;
        $this->mapel_id = $guru->mapel_id;
        $this->isEdit = true;
    }

    public function update()
    {
        $this->validate();

        $guru = Guru::findOrFail($this->guru_id);
        $guru->update([
            'user_id' => $this->user_id,
            'nip' => $this->nip,
            'mapel_id' => $this->mapel_id,
        ]);

        session()->flash('success', 'Data guru berhasil diperbarui.');
        $this->resetForm();

        // ✅ event baru
        $this->dispatch('close-modal');
    }

    public function delete($id)
    {
        $guru = Guru::find($id);

        if (!$guru) {
            session()->flash('error', 'Data guru tidak ditemukan.');
            return;
        }

        $guru->delete();

        session()->flash('success', 'Data guru berhasil dihapus!');
        $this->resetPage();

        // ✅ bisa tambahkan notifikasi browser kalau mau
        $this->dispatch('show-toast', message: 'Data guru berhasil dihapus!');
    }
}
