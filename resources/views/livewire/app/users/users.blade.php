<div class="card">
    <div class="card-body">
        <div class="card-title">
            <h3>Usuarios</h3>
        </div>
        <hr class="my-2">
        <div class="text-center p-1">
            <a class="btn btn-sm btn-primary" href="{{ route('users') }}"><i class="bi bi-arrow-clockwise"></i> Recargar</a>
            <button type="submit" class="btn btn-sm btn-success " wire:click="showModalCreate"><i class="bi bi-person-plus"></i> Nuevo usuario</button>
        </div>
        <livewire:app.users.users-table />
    </div>
    <x-modal wire:model="modal" maxWidth="lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Actualizar usuario</h5>
                <button
                    type="button"
                    class="btn"
                    wire:click="$toggle('modal')"
                >
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6">
                        <x-inputs.text
                            label="Nombre completo"
                            name="userData.name"
                            wire:model="userData.name"
                        ></x-inputs.text>
                    </div>
                    <div class="col-lg-6">
                        <x-inputs.text
                            name="userData.email"
                            label="Correo electrónico"
                            wire:model="userData.email"
                        ></x-inputs.text>
                    </div>
                    <div class="col-lg-6">
                        <x-inputs.text
                            name="userData.password"
                            label="Contraseña"
                            wire:model="userData.password"
                        ></x-inputs.text>
                    </div>
                    <div class="col-lg-6">
                        <x-inputs.text
                            name="userData.phone"
                            label="Teléfono"
                            wire:model="userData.phone"
                        ></x-inputs.text>
                    </div>
                    <div class="col-lg-6">
                        <x-inputs.select
                            name="userData.role"
                            label="Tipo de usuario"
                            wire:model="userData.role"
                        >
                            <option value="">Seleccione una opción</option>
                            @foreach(\Spatie\Permission\Models\Role::all() as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </x-inputs.select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button
                    type="button"
                    class="btn btn-danger"
                    wire:click="$toggle('modal')"
                >
                    <i class="fas fa-times"></i>
                    Cancelar
                </button>
                <button
                    type="button"
                    class="btn btn-primary"
                    wire:click="{{ $this->functionName }}"
                    wire:loading.attr="disabled"
                >
                    <i class="bi bi-person-fill-check"></i> Guardar
                </button>
            </div>
        </div>
    </x-modal>
</div>
