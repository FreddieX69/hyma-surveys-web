<?php

namespace App\Livewire\App\Users;

use Livewire\Attributes\On;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\User;

class UsersTable extends DataTableComponent
{
    protected $model = User::class;

    /**
     * @throws DataTableConfigurationException
     */
    public function configure(): void
    {
        $this->setPrimaryKey('Id');
        $this->setSearchDebounce(500);
    }

    #[On('refreshTable')]
    public function refreshTable(): void
    {
        // TODO: Es suficiente para refrescar la tabla - NO BORRAR ESTE MÉTODO
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable()->searchable(),
            Column::make("Nombre completo", "name")
                ->sortable()->searchable(),
            Column::make("Correo electrónico", "email")
                ->sortable()->searchable(),
            Column::make("Teléfono", "phone")
                ->sortable()->searchable(),
            Column::make("Tipo", "role")
                ->format(function ($role, $row) {
                    return $row->userRole->name ?? 'Desconocido';
                })
                ->sortable()->searchable(),
            Column::make("Fecha creación", "created_at")
                ->format(function ($date) {
                    return $date->format('d/m/Y');
                })
                ->sortable()->searchable(),
            Column::make("Acciones", "id")
                ->format(function ($id) {
                    return view('components.livewire.action-buttons', compact('id'));
                })
                ->sortable()->searchable(),
        ];
    }
}
