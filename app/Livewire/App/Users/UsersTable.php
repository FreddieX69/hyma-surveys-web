<?php

namespace App\Livewire\App\Users;

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

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable()->searchable(),
            Column::make("Name", "name")
                ->sortable()->searchable(),
            Column::make("Email", "email")
                ->sortable()->searchable(),
            Column::make("Created at", "created_at")
                ->sortable()->searchable(),
            Column::make("Updated at", "updated_at")
                ->sortable()->searchable(),
            Column::make("Acciones", "id")
                ->format(function ($id) {
                    return view('components.livewire.action-buttons');
                })
                ->sortable()->searchable(),
        ];
    }
}
