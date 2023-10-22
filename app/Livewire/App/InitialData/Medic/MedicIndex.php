<?php

namespace App\Livewire\App\InitialData\Medic;

use Livewire\Component;

class MedicIndex extends Component
{
    public $patientType = 1;
    public function render()
    {
        return view('livewire.app.initial-data.medic.medic-index');
    }
}
