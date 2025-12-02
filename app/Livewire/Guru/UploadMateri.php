<?php

namespace App\Livewire\Guru;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Materi;
use App\Models\MataPelajaran;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UploadMateri extends Component
{
    use WithFileUploads;

    public $judul, $mapel_id, $file;
    public $mapelList = [];
    public $isModalOpen = false;

    protected $listeners = ['deleteConfirmed' => 'delete'];

    public function mount()
    {
        $this->mapelList = MataPelajaran::all();
    }

    public function openModal()
    {
        $this->reset(['judul', 'mapel_id', 'file']);
        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
    }

    public function simpan()
    {
        $this->validate([
            'judul' => 'required|string|max:255',
            'mapel_id' => 'required|exists:mata_pelajaran,id',
            'file' => 'required|file|mimes:jpg,pdf,ppt,pptx,doc,docx,zip|max:10240',
        ]);

        // Nama file unik
        $filename = Str::slug($this->judul) . '-' . time() . '.' . $this->file->getClientOriginalExtension();

        // Simpan file di storage/app/public/materi
        $path = $this->file->storeAs('materi', $filename, 'public');

        // Simpan data ke database
        Materi::create([
            'guru_id' => optional(Auth::user()->guru)->id,
            'mapel_id' => $this->mapel_id,
            'judul' => $this->judul,
            'file_path' => $path,
        ]);

        $this->reset(['judul', 'mapel_id', 'file']);
        $this->closeModal();

        session()->flash('success', 'Materi berhasil diunggah.');
    }

    public function delete($id)
    {
        $materi = Materi::find($id);

        if (!$materi) {
            session()->flash('error', 'Materi tidak ditemukan!');
            return;
        }

        // Hapus file jika ada di storage
        if (\Storage::disk('public')->exists($materi->file_path)) {
            \Storage::disk('public')->delete($materi->file_path);
        }

        // Hapus baris materi
        $materi->delete();

        session()->flash('success', 'Materi berhasil dihapus!');

        // Jika pakai pagination
        if (method_exists($this, 'resetPage')) {
            $this->resetPage();
        }

        // Trigger toast dari JS
        $this->dispatch('show-toast', message: 'Materi berhasil dihapus!');
    }


    public function render()
    {
        return view('livewire.guru.upload-materi', [
            'materiList' => Materi::with(['guru.user', 'mapel'])->latest()->take(20)->get(),
        ]);
    }
}
