<div class="card">
    <div class="card-body">
        <div class="card-title">
            <h3>Mantenimiento de formularios</h3>
        </div>
        <hr class="my-2">
        <strong>
            <h5>Seleccione el formulario a editar</h5>
        </strong>
        <div class="row p-1" style="font-size: large">
            <div class="col-auto">
                <div class="form-check form-switch">
                    <input wire:model="form_initial_data_adult"
                           wire:click="changeForm('form_initial_data_adult', 'FICHA INICIAL ADULTO - MÉDICO')"
                           class="form-check-input"
                           type="checkbox"
                           id="form_initial_data_adult">
                    <label class="form-check-label" for="form_initial_data_adult">
                        <strong>FICHA INICIAL ADULTO - MÉDICO</strong>
                    </label>
                </div>
            </div>
            <div class="col-auto">
                <div class="form-check form-switch">
                    <input wire:model="form_initial_data_child"
                           wire:click="changeForm('form_initial_data_child', 'FICHA INICIAL NIÑO - MÉDICO')"
                           class="form-check-input"
                           type="checkbox"
                           id="form_initial_data_child">
                    <label class="form-check-label" for="form_initial_data_child">
                        <strong>FICHA INICIAL ADULTO NIÑO - MÉDICO</strong>
                    </label>
                </div>
            </div>
            <div class="col-auto">
                <div class="form-check form-switch">
                    <input wire:model="form_initial_data_social_worker"
                           wire:click="changeForm('form_initial_data_social_worker', 'FICHA INICIAL - TRABAJO SOCIAL')"
                           class="form-check-input"
                           type="checkbox"
                           id="form_initial_data_social_worker">
                    <label class="form-check-label" for="form_initial_data_social_worker">
                        <strong>FICHA INICIAL - TRABAJO SOCIAL</strong>
                    </label>
                </div>
            </div>
            <div class="col-auto">
                <div class="form-check form-switch">
                    <input wire:model="form_socio_economic_study"
                           wire:click="changeForm('form_socio_economic_study', 'ESTUDIO SOCIOECONÓMICO')"
                           class="form-check-input"
                           type="checkbox" id="form_socio_economic_study">
                    <label class="form-check-label" for="form_socio_economic_study">
                        <strong>ESTUDIO SOCIOECONÓMICO</strong>
                    </label>
                </div>
            </div>
        </div>
        @if($alert)
            <div class="alert alert-success col-lg-4" >
                <strong>Formulario seleccionado: {{ $alert }}</strong>
            </div>
            <form wire:submit="saveField" >
                <strong class=" text-center">
                    <h5>Agregar nuevo campo</h5>
                </strong>
                <div class="row">
                    <x-inputs.group class="col-auto" >
                        <x-inputs.text
                        label="Nombre del campo"
                        name="field.name"
                        wire:model="field.name"
                        >
                        </x-inputs.text>
                    </x-inputs.group>
                    <x-inputs.group class="col-auto" >
                        <x-inputs.select
                            label="Tipo de campo"
                            name="field.type"
                            wire:model.live="field.type">
                            <option value="">Elija una opción</option>
                            @foreach($fieldTypes as $fieldType)
                                <option value="{{ $fieldType->value }}">{{ implode(' ', preg_split('/(?=[A-Z])/', $fieldType->name)) }}</option>
                            @endforeach
                        </x-inputs.select>
                    </x-inputs.group>
                    <x-inputs.group class="col-auto py-xl-4" >
                        <x-inputs.checkbox
                            label="¿Es obligatorio?"
                            name="field.required"
                            wire:click=""
                            wire:model="field.required"
                        >
                        </x-inputs.checkbox>
                    </x-inputs.group>
                    @if(($field['type'] ?? null) == 6)
                        <x-inputs.group class="col-auto" >
                            <x-inputs.text
                                label="Agregar respuesta"
                                name="field_answer"
                                wire:model="field_answer"
                            >
                            </x-inputs.text>
                        </x-inputs.group>
                        <x-inputs.group class="col-auto py-4" >
                            @if($answerEdit != null)
                                <button type="button" class="btn btn-sm btn-primary" wire:click="updateAnswer">
                                    Editar Respuesta <i class="bi bi-pencil-square"></i>
                                </button>
                                <button type="button" wire:click="clearField('2')" class="btn btn-secondary">Cancelar <i class="bi bi-x-circle"></i></button>
                            @else
                                <button type="button" class="btn btn-sm btn-primary" wire:click="saveAnswer">
                                    Agregar Respuesta <i class="bi bi-plus-square"></i>
                                </button>
                            @endif
                        </x-inputs.group>
                        <div class="card-body">
                            <strong class=" text-start">
                                <h6>Respuestas disponibles</h6>
                            </strong>
                            <x-inputs.group class="col-lg-6" >
                                @error('field.answers')
                                <p class="text-danger" role="alert">Debes agregar respuestas</p>
                                @enderror
                                <ul class="list-group list-group-flush">
                                    @forelse ($field['answers'] ?? [] as $key => $answer)
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-lg-10">
                                                    {{ $answer }}
                                                </div>
                                                <div class="col-lg-2">
                                                    <button type="button"
                                                            class="btn btn-sm btn-primary"
                                                            title="Editar"
                                                            wire:click="editAnswer('{{ $key }}')">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </button>
                                                    <button type="button"
                                                            class="btn btn-sm btn-danger"
                                                            title="Editar"
                                                            wire:click="deleteAnswer('{{ $key }}')">
                                                        <i class="bi bi-trash3"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </li>
                                        @empty
                                            <p>Ninguna respuesta agregada</p>
                                        @endforelse
                                    </ul>
                            </x-inputs.group>
                        </div>
                    @endif
                </div>
                @if($fieldEdit)
                    <p class="text-bg-danger text-center text-dark col-auto">Recuerda que al editar un campo se afecta a los formularios que ya existen</p>
                    <button type="button"  wire:click="updateField" class="btn btn-primary">Actualizar Campo <i class="bi bi-pencil-square"></i></button>
                    <button type="button"  wire:click="clearField('1')" class="btn btn-secondary">Cancelar <i class="bi bi-x-circle"></i></button>
                @else
                    <button type="submit" class="btn btn-success">Guardar Campo <i class="bi bi-floppy"></i></button>
                @endif
            </form>
            <hr class="my-2">
            <strong class="text-start">
                <h5>Lista de campos</h5>
            </strong>
            <div class="table-responsive">
                <table class="table">
                <thead>
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Obligatorio</th>
                    <th scope="col">Respuestas</th>
                    <th scope="col">Acciones</th>
                </tr>
                </thead>
                <tbody>
                @forelse($form->fields()->orderBy('id')->get() ?? [] as $field_form)
                    <tr>
                        <td>{{ $field_form->description }}</td>
                        <td>{{ $fieldTypes->where('value', $field_form->type)->first()->name }}</td>
                        <td>{{ $field_form->required ? 'Obligatorio' : 'Opcional' }}</td>
                        <td>
                            <ol class="list-group list-group-numbered">
                            @forelse($field_form->answers as $field_answer)
                                <li class="list-group-item">{{ $field_answer->description }}</li>
                                @empty
                                <p>No aplica</p>
                            @endforelse
                            </ol>
                        </td>
                        <td>
                            <button type="button"
                                    class="btn btn-sm btn-primary"
                                    title="Editar"
                                    wire:click="showModalEdit('{{ $field_form->id }}')">
                                <i class="bi bi-pencil-square"></i>
                            </button>
                            <button type="button"
                                    class="btn btn-sm btn-danger"
                                    title="Eliminar"
                                    wire:click="deleteField('{{ $field_form->id }}')"
                                    wire:confirm="Atención: Si elimina este campo no podrá ver las respuestas de los formularios ya realizados.">
                                <i class="bi bi-trash3"></i>
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">No hay campos en este formulario</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
            </div>
        @else
            <div class="alert alert-primary col-lg-4" role="alert">
                Ningún formulario seleccionado
            </div>
        @endif
    </div>
</div>
