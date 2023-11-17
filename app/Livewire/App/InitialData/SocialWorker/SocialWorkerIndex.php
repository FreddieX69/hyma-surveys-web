<?php

namespace App\Livewire\App\InitialData\SocialWorker;

use Livewire\Component;

class SocialWorkerIndex extends Component
{
    public function mount()
    {
        $this->authorize('Fichas trabajo social');
    }
    public function render()
    {
        return view('livewire.app.initial-data.social-worker.social-worker-index');
    }
}
