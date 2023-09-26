<?php

namespace App\Livewire\Auth;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Login extends Component
{
    public $email, $password, $error;

    public function mount(): void
    {
        if (auth()->user()) {
            $this->redirect(route('home'));
        }
    }
    public function clearAlerts(): void
    {
        $this->error = null;
    }

    public function login(): void
    {
        $credentials = $this->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        if (Auth::attempt($credentials)) {
            $this->redirect('/');
        } else {
            $this->error = 'Credenciales incorrectas';
        }
    }

    #[Layout('components.layouts.auth')]
    public function render(): View
    {
        return view('livewire.auth.login');
    }
}
