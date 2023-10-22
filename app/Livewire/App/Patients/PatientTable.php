<?php

namespace App\Livewire\App\Patients;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Patient;

class PatientTable extends DataTableComponent
{
    protected $model = Patient::class;

    /**
     * @throws DataTableConfigurationException
     */
    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setSearchDebounce(500);
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable()->searchable(),
            Column::make("Nombre", "name")
                ->sortable()->searchable(),
            Column::make("Correo electrónico", "email")
                ->sortable()->searchable(),
            Column::make("Tipo", "type")
                ->format(function ($type) {
                    return $type == 1 ? 'Adulto' : 'Niño';
                })
                ->sortable()->searchable(),
            Column::make("Ficha inicial - Médico", "initial_data")
                ->format(function ($value) {
                    return $value == 1 ? 'Sí' : 'No';
                })
                ->sortable()->searchable(),
            Column::make("Ficha inicial - Trabajo social", "initial_data")
                ->format(function ($value, $row) {
                    $id = $row->id;
                    $type = 3;
                    return view('components.initial-data', compact('type', 'value', 'id'));
                })
                ->sortable()->searchable(),
            Column::make("Estudio socioeconómico", "socio_economic_study")
                ->format(function ($value, $row) {
                    $id = $row->id;
                    $type = 4;
                    return view('components.initial-data', compact('type', 'value', 'id'));
                })
                ->sortable()->searchable(),
            Column::make("Fecha creación", "created_at")
                ->sortable()->searchable(),
        ];
    }
}
