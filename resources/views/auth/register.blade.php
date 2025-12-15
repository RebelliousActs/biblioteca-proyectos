<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse</title>
    @vite(['resources/css/app.css'])
</head>
<body>
    <div class="auth-container">
        <h1 class="auth-title">REGISTRARSE</h1>

        <form method="POST" action="{{ route('register') }}" class="auth-form">
            @csrf

            <!-- Name -->
            <div class="form-group">
                <label for="name" class="form-label">NOMBRE</label>
                <input
                    id="name"
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    required
                    autofocus
                    autocomplete="name"
                    class="form-input"
                >
                @error('name')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <!-- Email -->
            <div class="form-group">
                <label for="email" class="form-label">EMAIL</label>
                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autocomplete="username"
                    class="form-input"
                >
                @error('email')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password" class="form-label">CONTRASEÑA</label>
                <input
                    id="password"
                    type="password"
                    name="password"
                    required
                    autocomplete="new-password"
                    class="form-input"
                >
                @error('password')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="form-group">
                <label for="password_confirmation" class="form-label">CONFIRMAR</label>
                <input
                    id="password_confirmation"
                    type="password"
                    name="password_confirmation"
                    required
                    autocomplete="new-password"
                    class="form-input"
                >
                @error('password_confirmation')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <!-- Botones -->
            <div class="form-group">
                <button type="submit" class="btn btn-register">REGISTRARSE</button>
            </div>

            <!-- Enlace a login -->
            <p class="auth-footer">
                ¿Ya tienes cuenta? <a href="{{ route('login') }}" class="link">ENTRAR</a>
            </p>

            <!-- Botón a página principal -->
            <div class="form-group">
                <a href="{{ url('/') }}" class="btn btn-purple">← PÁGINA PRINCIPAL</a>
            </div>
        </form>
    </div>
</body>
</html>