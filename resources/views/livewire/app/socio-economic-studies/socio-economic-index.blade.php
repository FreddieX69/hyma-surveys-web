<div class="card">
    <div class="card-body">
        <div class="card-title">
            <h3>Estudios socioeconómicos</h3>
        </div>
        <hr class="my-2">
        <div class="text-center p-1">
            <a class="btn btn-sm btn-primary" href="{{ route('socio-economic-index') }}"><i class="bi bi-arrow-clockwise"></i> Recargar</a>
        </div>
        <div class="text-black-50">
            <livewire:app.forms.form-table :form_id="4"/>
        </div>
    </div>
</div>
