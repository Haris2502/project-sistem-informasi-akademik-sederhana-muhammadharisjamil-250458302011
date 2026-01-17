<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;

class Login extends Component
{
    public $email, $password;

    #[Layout('components.layouts.auth')]

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required|min:6',
    ];

    protected function messages()
    {
        return [
        'email.required' => 'Email wajib diisi kalo gak ngisi gausah belajar',
        'email.email' => 'Format email tidak valid.',
        'password.required' => 'Password wajib diisi gak ngisi gausah belajar',
        'password.min' => 'Password minimal 6 karakter.',
        ];
    }

    public function login()
    {
        
        $credentials = $this->validate();

        if (Auth::attempt($credentials)) {
            session()->regenerate();

            $role = Auth::user()->role;
            if ($role === 'admin') {
                return $this->redirect('/admin/dashboard', navigate: true);
            } elseif ($role === 'guru') {
                return $this->redirect('/guru/dashboard', navigate: true);
            } else {
                return $this->redirect('/siswa/dashboard', navigate: true);
            }
        }

                $this->addError('login_failed', 'Email atau password salah.');

    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
