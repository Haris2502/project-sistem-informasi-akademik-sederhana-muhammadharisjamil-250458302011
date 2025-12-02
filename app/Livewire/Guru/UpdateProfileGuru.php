<?php

namespace App\Livewire\Guru;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class UpdateProfileGuru extends Component
{
    use WithFileUploads;

    public $nip, $name, $kelas;
    public $telepon, $tempat_lahir, $tanggal_lahir, $gender;
    public $photo, $oldPhoto;

    public function mount()
    {
        $profile = auth()->user()->profileGuru;

        $this->nip = $profile->nip ?? '';
        $this->name = $profile->name ?? '';
        $this->kelas = $profile->kelas ?? '';
        $this->telepon = $profile->telepon ?? '';
        $this->tempat_lahir = $profile->tempat_lahir ?? '';
        $this->tanggal_lahir = $profile->tanggal_lahir ?? '';
        $this->gender = $profile->gender ?? '';
        $this->oldPhoto = $profile->photo ?? null;
    }

    public function updateProfile()
    {
        $this->validate([
            'nip' => 'nullable|string|max:50',
            'name' => 'required|string|max:255',
            'kelas' => 'nullable|string|max:255',
            'telepon' => 'nullable|string|max:20',
            'tempat_lahir' => 'nullable|string|max:255',
            'tanggal_lahir' => 'nullable|date',
            'gender' => 'nullable',
            'photo' => 'nullable|image|max:2048',
        ]);

        $user = auth()->user();
        $photoPath = $this->oldPhoto;

        // Upload foto baru
        if ($this->photo) {
            if ($this->oldPhoto && Storage::disk('public')->exists($this->oldPhoto)) {
                Storage::disk('public')->delete($this->oldPhoto);
            }

            $photoPath = $this->photo->store('photos', 'public');
        }

        // Update atau create profile guru
        $user->profileGuru()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'nip' => $this->nip,
                'name' => $this->name,
                'kelas' => $this->kelas,
                'telepon' => $this->telepon,
                'tempat_lahir' => $this->tempat_lahir,
                'tanggal_lahir' => $this->tanggal_lahir,
                'gender' => $this->gender,
                'photo' => $photoPath,
            ]
        );

        session()->flash('success', 'Profile guru berhasil diperbarui!');
    }

    public function render()
    {
        return view('livewire.guru.update-profile-guru');
    }
}
