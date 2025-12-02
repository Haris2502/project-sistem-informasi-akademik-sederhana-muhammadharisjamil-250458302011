<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Register extends Component
{
    public $name, $email, $password;

    #[Layout('components.layouts.auth')]

    public function register()
    {
        $this->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|',
        ]);

        // Buat user baru
        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        // Kirim pesan sukses
        session()->flash('success', 'Registrasi berhasil! Silakan login.');

        // Redirect ke login
        return redirect()->route('login');

        // Login otomatis setelah register
        Auth::login($user);

        // Redirect ke dashboard
        // return redirect()->route('admin.dashboard');
    }

    public function render()
    {
        return view('livewire.auth.register');
    }
}
