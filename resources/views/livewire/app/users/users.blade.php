<div class="card">
    <div class="card-header">
        <div class="card-title">
            <h3>Usuarios</h3>
        </div>
    </div>
    <hr class="my-2">
    <div class="text-center p-1">
        <a class="btn btn-sm btn-primary" href="{{ route('users') }}"><i class="bi bi-arrow-clockwise"></i> Recargar</a>
        <button type="submit" class="btn btn-sm btn-success " wire:click="excelExport"><i class="bi bi-file-earmark-excel"></i> Exportar</button>
    </div>
    <div class="card-body">
        <livewire:app.users.users-table />
    </div>
</div>
