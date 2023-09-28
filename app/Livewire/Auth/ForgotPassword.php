<?php

namespace App\Livewire\Auth;

use App\Mail\ResetPasswordMail;
use App\Models\User;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Str;

class ForgotPassword extends Component
{
    public $email, $success, $error;

    public function mount(): void
    {
        if (auth()->user()) {
            $this->redirect(route('home'));
        }
    }
    public function sendLink(): void
    {
        $this->error =  null;
        $this->success =  null;
        $this->validate([
            'email' => ['required', 'email', 'exists:users,email']
        ]);
        try {
            $user = User::whereEmail($this->email)->first();
            $user->reset_password_token = Str::uuid();
            $user->save();
            $link = route('change-password', encrypt($user->reset_password_token));
            Mail::to($user->email)->send(new ResetPasswordMail($link));
            $this->success = 'Se ha enviado el link al correo '.$this->email.' revisa la bandeja de entrada y spam.';
        } catch (Exception $exception) {
            $this->error = 'Ha ocurrido un error al enviar el correo'. $exception->getMessage();
        }
    }
    #[Layout('components.layouts.auth')]
    public function render(): View
    {
        return view('livewire.auth.forgot-password');
    }
}
