<?php

namespace App\Livewire\App\Users;

use App\Models\User;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Livewire\Attributes\On;
use Livewire\Component;

class Users extends Component
{
    use AuthorizesRequests;

    public $modal = false, $userData = [], $functionName;
    public ?User $user;

    public function mount(): void
    {
        $this->authorize('Módulo usuarios');
    }
    public function showModalCreate(): void
    {
        $this->resetValidation();
        $this->userData = [];
        $this->functionName = 'createUser';
        $this->modal = true;
    }

    public function createUser(): void
    {
        $this->validate([
            'userData.name' => ['required', 'string'],
            'userData.email' => ['required', 'email', 'unique:users,email'],
            'userData.password' => ['required', 'string', 'min:6'],
            'userData.role' => ['required', 'integer', 'between:1,4'],
            'userData.phone' => ['required', 'string', 'min:8'],
        ]);
        $user = User::create($this->userData);
        $user->syncRoles([$user->role]);
        $this->dispatch('refreshTable');
        $this->modal = false;
        $this->dispatch('toast-notify',
            type: 'success',
            message: 'Usuario creado correctamente'
        );
    }

    #[On('edit')]
    public function showModalEdit(User $id): void
    {
        $this->resetValidation();
        $this->userData = [];
        $this->functionName = 'updateUser';
        $this->user = $id;
        $this->userData = $id->toArray();
        $this->modal = true;
    }
    public function updateUser(): void
    {
        $this->validate([
            'userData.name' => ['required', 'string'],
            'userData.email' => ['required', 'email', Rule::unique('users', 'email')->ignore($this->user ?? null)],
            'userData.password' => ['nullable', 'string', 'min:6'],
            'userData.role' => ['required', 'integer', 'between:1,4'],
            'userData.phone' => ['required', 'string', 'min:8'],
        ]);
        if (isset($this->userData['password'])) {
            $this->userData['password'] = Hash::make($this->userData['password']);
        }
        $this->user->update($this->userData);
        $this->user->syncRoles([$this->userData['role']]);
        $this->dispatch('refreshTable');
        $this->modal = false;
        $this->user = null;
        $this->dispatch('toast-notify',
            type: 'success',
            message: 'Usuario actualizado'
        );
    }

    #[On('delete')]
    public function deleteUser(User $id): void
    {
        try {
            $id->delete();
            $this->dispatch('refreshTable');
            $this->dispatch('toast-notify',
                type: 'success',
                message: 'Usuario eliminado'
            );
        } catch (Exception) {
            $this->dispatch('toast-notify',
                type: 'error',
                message: 'Este usuario tiene registros en el sistema'
            );
        }
    }

    public function render(): View
    {
        return view('livewire.app.users.users');
    }
}
