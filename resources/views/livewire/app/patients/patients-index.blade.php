<div class="card">
    <div class="card-body">
        <div class="card-title">
            <h3>Resumen de pacientes</h3>
        </div>
        <hr class="my-2">
        <div class="text-center p-1">
            <a class="btn btn-sm btn-primary" href="{{ route('patients-index') }}"><i class="bi bi-arrow-clockwise"></i> Recargar</a>
        </div>
        <div class="text-black-50">
            <livewire:app.patients.patient-table/>
        </div>
    </div>
</div>
