<?php

namespace App\Livewire\Siswa;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class UpdateProfileSiswa extends Component
{
    use WithFileUploads;

    public $nip, $name, $mata_pelajaran, $tahun_angkatan;
    public $telepon, $tempat_lahir, $tanggal_lahir, $gender;
    public $alasan_belajar_disini, $photo, $oldPhoto;

    public function mount()
    {
        $profile = auth()->user()->profile;

        $this->nip = $profile->nip ?? '';
        $this->name = $profile->name ?? '';
        $this->program_studi = $profile->mata_pelajaran ?? '';
        $this->tahun_angkatan = $profile->tahun_angkatan ?? '';
        $this->telepon = $profile->telepon ?? '';
        $this->tempat_lahir = $profile->tempat_lahir ?? '';
        $this->tanggal_lahir = $profile->tanggal_lahir ?? '';
        $this->gender = $profile->gender ?? '';
        $this->alasan_memilih_idn = $profile->alasan_belajar_disini ?? '';
        $this->oldPhoto = $profile->photo ?? null;
    }

    public function updateProfile()
    {
        $this->validate([
            'nip' => 'nullable|string|max:50',
            'name' => 'required|string|max:255',
            'mata_pelajaran' => 'nullable|string|max:255',
            'tahun_angkatan' => 'nullable|string|max:255',
            'telepon' => 'nullable|string|max:20',
            'tempat_lahir' => 'nullable|string|max:255',
            'tanggal_lahir' => 'nullable|date',
            'gender' => 'nullable',
            'alasan_belajar_disini' => 'nullable|string',
            'photo' => 'nullable|image|max:2048',
        ]);

        $user = auth()->user();
        $photoPath = $this->oldPhoto;

        if ($this->photo) {
            if ($this->oldPhoto && Storage::disk('public')->exists($this->oldPhoto)) {
                Storage::disk('public')->delete($this->oldPhoto);
            }

            $photoPath = $this->photo->store('photos', 'public');
        }

        $user->profile()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'nip' => $this->nip,
                'name' => $this->name,
                'mata_pelajaran' => $this->mata_pelajaran,
                'tahun_angkatan' => $this->tahun_angkatan,
                'telepon' => $this->telepon,
                'tempat_lahir' => $this->tempat_lahir,
                'tanggal_lahir' => $this->tanggal_lahir,
                'gender' => $this->gender,
                'alasan_belajar_disini' => $this->alasan_belajar_disini,
                'photo' => $photoPath,
            ]
        );

        session()->flash('success', 'Profile berhasil diperbarui!');
    }


    public function render()
    {
        return view('livewire.siswa.update-profile');
    }
}
