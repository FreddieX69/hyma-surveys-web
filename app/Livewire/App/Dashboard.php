<?php

namespace App\Livewire\App;

use Livewire\Component;

class Dashboard extends Component
{
    public function mount()
    {
        $this->dispatch('toast-notify',
            type: 'success',
            message: 'Datos cargados correctamente'
        );
    }
    public function render()
    {
        return view('livewire.app.dashboard');
    }
}
