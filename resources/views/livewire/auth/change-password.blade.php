<div>
    <h1 class="auth-title">Recupera tu usuario</h1>
    <p class="auth-subtitle mb-5">Cambia tu contraseña para iniciar sesión.</p>

    <form wire:submit="changePassword">
        <label><strong>Nueva contraseña</strong></label>
        <div class="form-group position-relative has-icon-left mb-4">
            <input type="password" wire:model="password" wire:click="clearAlerts" class="form-control form-control-xl" placeholder="Mínimo 6 caracteres">
            <div class="form-control-icon">
                <i class="bi bi-shield-lock"></i>
            </div>
            @error('password')
            @include('components.inputs.partials.error')
            @enderror
        </div>
        <label><strong>Confirmar contraseña</strong></label>
        <div class="form-group position-relative has-icon-left mb-4">
            <input type="password" wire:model="confirm_password" wire:click="clearAlerts" class="form-control form-control-xl" placeholder="Mínimo 6 caracteres">
            <div class="form-control-icon">
                <i class="bi bi-shield-lock"></i>
            </div>
            @error('confirm_password')
            @include('components.inputs.partials.error')
            @enderror
        </div>
        @if($alert)
            <div class="alert alert-light-danger alert-dismissible show fade">
                {{ $alert }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Cambiar contraseña</button>
    </form>
    <div class="text-center mt-5 text-lg fs-4">
        <p class='text-gray-600'>O <a href="{{ route('login') }}" class="font-bold">Inicia Sesión</a>
        </p>
    </div>
</div>
