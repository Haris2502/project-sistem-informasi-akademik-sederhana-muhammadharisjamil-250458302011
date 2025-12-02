<?php

namespace App\Livewire\Siswa;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\TugasSiswa;
use App\Models\Siswa;
use App\Models\MataPelajaran;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UploadTugas extends Component
{
    use WithFileUploads;

    public $judul, $mapel_id, $file;
    public $isModalOpen = false;
    public $tugasList = [];
    public $mapelList = [];
    public $siswa_id;

    protected $listeners = ['delete' => 'delete'];

    public function mount()
    {
        $this->siswa_id = Auth::user()->siswa->id; // pastikan user punya relasi siswa
        $this->mapelList = MataPelajaran::all();
        $this->loadTugas();
    }

    public function loadTugas()
    {
        $this->tugasList = TugasSiswa::where('siswa_id', $this->siswa_id)
                                     ->latest()
                                     ->get();
    }

    public function openModal()
    {
        $this->resetInput();
        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
    }

    public function resetInput()
    {
        $this->judul = '';
        $this->mapel_id = '';
        $this->file = null;
    }

    public function simpan()
    {
        $this->validate([
            'judul' => 'required|string|max:255',
            'mapel_id' => 'required|exists:mata_pelajaran,id',
            'file' => 'required|file|max:20480', // 20MB
        ]);

        $filePath = $this->file->store('tugas_siswa', 'public');

        TugasSiswa::create([
            'siswa_id' => $this->siswa_id,
            'mapel_id' => $this->mapel_id,
            'judul' => $this->judul,
            'file_path' => $filePath,
        ]);

        $this->closeModal();
        $this->loadTugas();

        session()->flash('success', 'Tugas berhasil diupload!');
    }

    public function delete($id)
    {
        $tugas = TugasSiswa::find($id);

        if (!$tugas) return;

        if (Storage::disk('public')->exists($tugas->file_path)) {
            Storage::disk('public')->delete($tugas->file_path);
        }

        $tugas->delete();

        $this->loadTugas();

        session()->flash('success', 'Tugas berhasil dihapus!');
    }

    public function render()
    {
        return view('livewire.siswa.upload-tugas');
    }
}
