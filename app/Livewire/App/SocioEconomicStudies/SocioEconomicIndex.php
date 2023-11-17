<?php

namespace App\Livewire\App\SocioEconomicStudies;

use Livewire\Component;

class SocioEconomicIndex extends Component
{
    public function mount()
    {
        $this->authorize('Estudios socioeconómicos');
    }
    public function render()
    {
        return view('livewire.app.socio-economic-studies.socio-economic-index');
    }
}
