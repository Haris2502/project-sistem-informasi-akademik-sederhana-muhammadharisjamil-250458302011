<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class UpdateProfileAdmin extends Component
{
    use WithFileUploads;

    public $name, $telepon;
    public $tempat_lahir, $tanggal_lahir, $gender;
    public $photo, $oldPhoto;

    public function mount()
    {
        $profile = auth()->user()->profileAdmin;

        $this->name = $profile->name ?? auth()->user()->name ?? '';
        $this->telepon = $profile->telepon ?? '';
        $this->tempat_lahir = $profile->tempat_lahir ?? '';
        $this->tanggal_lahir = $profile->tanggal_lahir ?? '';
        $this->gender = $profile->gender ?? '';
        $this->oldPhoto = $profile->photo ?? null;
    }

    public function updateProfile()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'telepon' => 'nullable|string|max:20',
            'tempat_lahir' => 'nullable|string|max:255',
            'tanggal_lahir' => 'nullable|date',
            'gender' => 'nullable',
            'photo' => 'nullable|image|max:2048',
        ]);

        $user = auth()->user();
        $photoPath = $this->oldPhoto;

        // Upload foto baru jika ada
        if ($this->photo) {
            if ($this->oldPhoto && Storage::disk('public')->exists($this->oldPhoto)) {
                Storage::disk('public')->delete($this->oldPhoto);
            }

            $photoPath = $this->photo->store('photos', 'public');
        }

        // Update atau buat profile admin
        $user->profileAdmin()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'name' => $this->name,
                'telepon' => $this->telepon,
                'tempat_lahir' => $this->tempat_lahir,
                'tanggal_lahir' => $this->tanggal_lahir,
                'gender' => $this->gender,
                'photo' => $photoPath,
            ]
        );

        session()->flash('success', 'Profile admin berhasil diperbarui!');
    }

    public function render()
    {
        return view('livewire.features.admin.update-profile-admin');
    }
}
