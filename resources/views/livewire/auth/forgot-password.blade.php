<div>
    <h1 class="auth-title">Recupera tu contraseña</h1>
    <p class="auth-subtitle mb-5">Ingresa tu correo electrónico para enviarte el link de recuperación.</p>

    <form wire:submit="sendLink">
        <div class="form-group position-relative has-icon-left mb-4">
            <input type="email" wire:model="email" class="form-control form-control-xl" placeholder="Correo electrónico">
            <div class="form-control-icon">
                <i class="bi bi-envelope"></i>
            </div>
            @error('email')
            @include('components.inputs.partials.error')
            @enderror
        </div>
        @if($success)
            <div class="alert alert-success alert-dismissible show fade">
                {{ $success }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if($error)
            <div class="alert alert-danger alert-dismissible show fade">
                {{ $error }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Enviar</button>
    </form>
    <div class="text-center mt-5 text-lg fs-4">
        <p class='text-gray-600'>Volver al <a href="{{ route('login') }}" class="font-bold">Inicio de Sesión</a>
        </p>
    </div>
</div>
