<div class="card">
    <div class="card-body">
        <div class="card-title">
            <h3>Fichas de trabajo social</h3>
        </div>
        <hr class="my-2">
        <div class="text-center p-1">
            <a class="btn btn-sm btn-primary" href="{{ route('social-worker-index') }}"><i class="bi bi-arrow-clockwise"></i> Recargar</a>
        </div>
        <div class="text-black-50">
            <livewire:app.forms.form-table :form_id="3"/>
        </div>
    </div>
</div>
