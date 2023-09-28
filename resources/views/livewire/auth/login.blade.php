<div>
    <h1 class="auth-title">Bienvenido de nuevo</h1>
    <p class="auth-subtitle mb-5">Ingresa tus credenciales</p>

    <form wire:submit="login">
        <div class="form-group position-relative has-icon-left mb-4">
            <input type="text" wire:model="email" wire:click="clearAlerts" class="form-control form-control-xl" placeholder="Correo electrónico">
            <div class="form-control-icon">
                <i class="bi bi-person"></i>
            </div>
            @error('email')
            @include('components.inputs.partials.error')
            @enderror
        </div>
        <div class="form-group position-relative has-icon-left mb-4">
            <input type="password" wire:model="password" wire:click="clearAlerts" class="form-control form-control-xl" placeholder="Contraseña">
            <div class="form-control-icon">
                <i class="bi bi-shield-lock"></i>
            </div>
            @error('password')
            @include('components.inputs.partials.error')
            @enderror
        </div>
        @if($error)
            <div class="alert alert-danger alert-dismissible show fade">
                {{ $error }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="form-check form-check-lg d-flex align-items-end">
            <input class="form-check-input me-2" type="checkbox" value="" id="flexCheckDefault">
            <label class="form-check-label text-gray-600" for="flexCheckDefault">
                Guardar credenciales
            </label>
        </div>
        <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Ingresar</button>
    </form>
    <div class="text-center mt-5 text-lg fs-4">
        <p><a class="font-bold" href="{{ route('forgot-password') }}">¿Olvidaste tu contraseña?</a></p>
    </div>
</div>
