<?php

namespace App\Livewire\App\InitialData\Medic;

use App\Models\Patient;
use Livewire\Component;

class MedicFillForm extends Component
{
    public ?Patient $patient;
    //public $

    public function mount(): void
    {

    }
    public function render()
    {
        return view('livewire.app.initial-data.medic.medic-fill-form');
    }
}
