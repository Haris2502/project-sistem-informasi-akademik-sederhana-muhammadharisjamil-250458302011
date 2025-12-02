<?php

namespace App\Livewire\Guru;

use Livewire\Component;
use App\Models\Pengumuman;
use Illuminate\Support\Facades\Auth;

class KelolaPengumuman extends Component
{
    public $judul, $isi, $tanggal;
    public $pengumuman_id;
    public $isModalOpen = false;
    public $isEdit = false;

    protected $listeners = ['deleteConfirmed' => 'delete'];

    public function openModal()
    {
        $this->resetForm();
        $this->isEdit = false;
        $this->isModalOpen = true;
    }

    public function openEdit($id)
    {
        $p = Pengumuman::findOrFail($id);

        $this->pengumuman_id = $id;
        $this->judul = $p->judul;
        $this->isi = $p->isi;
        $this->tanggal = $p->tanggal;

        $this->isEdit = true;
        $this->isModalOpen = true;
    }

    public function resetForm()
    {
        $this->reset(['judul', 'isi', 'tanggal', 'pengumuman_id']);
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
    }

    public function simpan()
    {
        $this->validate([
            'judul' => 'required',
            'isi' => 'required',
            'tanggal' => 'required|date',
        ]);

        Pengumuman::updateOrCreate(
            ['id' => $this->pengumuman_id],
            [
                'guru_id' => optional(Auth::user()->guru)->id,
                'judul' => $this->judul,
                'isi' => $this->isi,
                'tanggal' => $this->tanggal,
            ]
        );

        $this->closeModal();
        $this->resetForm();

        session()->flash('success', $this->isEdit ? 'Berhasil diperbarui' : 'Berhasil ditambahkan');
    }

    public function delete($id)
    {
        $pengumuman = Pengumuman::find($id);

        if (!$pengumuman) {
            session()->flash('error', 'Data pengumuman tidak ditemukan.');
            return;
        }

        $pengumuman->delete();

        session()->flash('success', 'Pengumuman berhasil dihapus!');
        $this->dispatch('show-toast', message: 'Pengumuman berhasil dihapus!');
    }

    public function render()
    {
        return view('livewire.guru.kelola-pengumuman', [
            'list' => Pengumuman::latest()->get(),
        ]);
    }
}
