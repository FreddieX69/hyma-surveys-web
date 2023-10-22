<div class="card">
    <div class="card-body">
        <div class="card-title">
            <h3>Fichas médicas</h3>
        </div>
        <hr class="my-2">
        <div class="text-center p-1">
            <a class="btn btn-sm btn-primary" href="{{ route('initial-data-medic') }}"><i class="bi bi-arrow-clockwise"></i> Recargar</a>
            <a type="submit" class="btn btn-sm btn-success" href="{{ route('medic-fill-form') }}"><i class="bi bi-clipboard2-plus"></i> Nueva ficha</a>
        </div>
        <div class="col-lg-3">
            <x-inputs.select
                label="Tipo de paciente"
                name="Tipo de paciente"
                wire:model.live="patientType">
                <option value="1">Adulto</option>
                <option value="2">Niño</option>
            </x-inputs.select>
        </div>
        <br>
        <div class="text-black-50">
            @if($this->patientType == 1)
                <livewire:app.forms.form-table :form_id="1"/>
            @else
                <livewire:app.forms.form-table :form_id="2"/>
            @endif
        </div>
    </div>
</div>
