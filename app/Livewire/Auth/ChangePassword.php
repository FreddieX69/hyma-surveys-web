<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Auth;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Livewire\Component;

class ChangePassword extends Component
{
    public ?User $user = null;
    public $password, $confirm_password, $alert;
    public function mount($key): void
    {
        if (auth()->user()) {
            $this->redirect(route('home'));
        }
        try {
            $this->user = User::where('reset_password_token', decrypt($key))->first();
            if (!$this->user) {
                $this->redirect(route('404'));
            }
        } catch (Exception) {
            $this->redirect(route('404'));
        }
    }

    public function clearAlerts(): void
    {
        $this->alert = null;
    }
    public function changePassword(): void
    {
        $this->validate([
            'password' => ['required', 'string', 'min:6'],
            'confirm_password' => ['required', 'string', 'min:6'],
        ]);
        if ($this->password == $this->confirm_password) {
            $this->user->password = Hash::make($this->password);
            $this->user->reset_password_token = null;
            $this->user->save();
            Auth::login($this->user);
            $this->redirect(route('home'));
        } else {
            $this->alert = 'Las contraseñas no coinciden';
        }
    }

    #[Layout('components.layouts.auth')]
    public function render(): View
    {
        return view('livewire.auth.change-password');
    }
}
