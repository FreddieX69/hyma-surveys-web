<div>
    <strong>
        <h5>Datos generales del paciente</h5>
    </strong>
    <div class="row">
        <x-inputs.group class="col-lg-4">
            <x-inputs.text
                label="Nombre completo"
                required="required"
                name="name"
                wire:model="name"
            ></x-inputs.text>
        </x-inputs.group>
        <x-inputs.group class="col-lg-4">
            <x-inputs.text
                label="Correo electrónico"
                name="email"
                wire:model="email"
            ></x-inputs.text>
        </x-inputs.group>
        <x-inputs.group class="col-lg-4">
            <x-inputs.select
                label="Tipo de paciente"
                name="type"
                wire:model="type">
                <option value="1">Adulto</option>
                <option value="2">Niño</option>
            </x-inputs.select>
        </x-inputs.group>
    </div>
    @if(!$this->patient)
        <button type="button" wire:click="savePatient" class="btn btn-success">Cargar formulario <i class="bi bi-floppy"></i></button>
    @endif
    @if($this->form ?? null)
        <div class="row">
            @foreach($this->form->fields as $field)
                @php
                    $required = $field->required ? 'required' : '';
                    $model = 'form_fields.'.$field->id;
                @endphp
                <x-inputs.group class="col-lg-4">
                    @switch($field->type)
                        @case(0)
                            {{-- Texto --}}
                            <x-inputs.text
                                label="{{ $field->description }}"
                                required="{{ $required }}"
                                name="{{ $model }}"
                                wire:model="{{ $model }}"
                            ></x-inputs.text>
                            @break
                        @case(1)
                            {{-- Área de texto --}}
                            <x-inputs.textarea
                                label="{{ $field->description }}"
                                required="{{ $required }}"
                                name="{{ $model }}"
                                wire:model="{{ $model }}"
                            ></x-inputs.textarea>
                            @break
                        @case(2)
                            {{-- Número --}}
                            <x-inputs.number
                                label="{{ $field->description }}"
                                required="{{ $required }}"
                                name="{{ $model }}"
                                wire:model="{{ $model }}"
                            ></x-inputs.number>
                            @break
                        @case(3)
                            {{-- Fecha --}}
                            <x-inputs.date
                                label="{{ $field->description }}"
                                required="{{ $required }}"
                                name="{{ $model }}"
                                wire:model="{{ $model }}"
                            ></x-inputs.date>
                            @break
                        @case(4)
                            {{-- Foto --}}
                            <x-inputs.image
                                label="{{ $field->description }}"
                                required="{{ $required }}"
                                name="{{ $model }}"
                                wire:model="{{ $model }}"
                                description=""
                            ></x-inputs.image>
                            @break
                        @case(5)
                            {{-- Booleano --}}
                            <x-inputs.select-size
                                size="2"
                                required="{{ $required }}"
                                name="{{ $model }}"
                                wire:model="{{ $model }}"
                                label="{{ $field->description }}">
                                <option value="1">Sí </option>
                                <option value="0">No </option>
                            </x-inputs.select-size>
                            @break
                        @default
                            {{-- Seleccionar Respuesta --}}
                            <x-inputs.select-size
                                size="{{ $field->answers->count()  }}"
                                name="{{ $model }}"
                                wire:model="{{ $model }}"
                                required="{{ $required }}"
                                label="{{ $field->description }}">
                                @foreach($field->answers as $answer)
                                    <option value="{{ $answer->id }}">{{ $answer->description }}</option>
                                @endforeach
                            </x-inputs.select-size>
                            @break
                    @endswitch
                </x-inputs.group>
            @endforeach
        </div>
    @endif
    <button type="button" class="btn btn-success" wire:click="finishForm">Finalizar Formulario <i class="bi bi-send-check"></i></button>
    <button type="button" class="btn btn-primary" wire:click="saveForm">Guardar Progreso <i class="bi bi-floppy-fill"></i></button>
</div>
