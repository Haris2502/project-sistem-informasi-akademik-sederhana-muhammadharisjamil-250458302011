<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Kelas;

class DataKelasSiswa extends Component
{
    use WithPagination;

    public $search = '';
    public $kelas_id, $nama_kelas, $deskripsi;
    public $isEdit = false;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['deleteConfirmed' => 'delete']; // 🔹 dengarkan event dari JS

    protected $rules = [
        'nama_kelas' => 'required|string|max:255',
        'deskripsi' => 'nullable|string',
    ];

    // 🔹 Reset form
    public function resetForm()
    {
        $this->reset(['kelas_id', 'nama_kelas', 'deskripsi', 'isEdit']);
        $this->resetValidation();
    }

    // 🔹 Simpan (Tambah/Edit)
    public function store()
    {
        $this->validate();

        Kelas::updateOrCreate(
            ['id' => $this->kelas_id],
            [
                'nama_kelas' => $this->nama_kelas,
                'deskripsi' => $this->deskripsi,
            ]
        );

        session()->flash('success', $this->isEdit ? 'Data kelas berhasil diperbarui!' : 'Data kelas berhasil ditambahkan!');
        $this->dispatch('close-modal');
        $this->resetForm();
    }

    // 🔹 Edit
    public function edit($id)
    {
        $kelas = Kelas::findOrFail($id);

        $this->kelas_id = $kelas->id;
        $this->nama_kelas = $kelas->nama_kelas;
        $this->deskripsi = $kelas->deskripsi;
        $this->isEdit = true;
    }

    // 🔹 Trigger konfirmasi hapus
    public function confirmDelete($id)
    {
        $this->kelas_id = $id;
        $this->dispatch('show-delete-confirmation'); // kirim event ke JS
    }

    // 🔹 Hapus setelah dikonfirmasi
    public function delete()
    {
        $kelas = Kelas::find($this->kelas_id);

        if (!$kelas) {
            session()->flash('error', 'Data kelas tidak ditemukan.');
            return;
        }

        $kelas->delete();
        session()->flash('success', 'Data kelas berhasil dihapus!');
    }

    // 🔹 Render
    public function render()
    {
        $kelas = Kelas::with('siswa')
            ->where('nama_kelas', 'like', "%{$this->search}%")
            ->orderBy('id', 'desc')
            ->paginate(5);

        return view('livewire.features.admin.data-kelas-siswa', [
            'kelasList' => $kelas,
        ]);
    }
}
