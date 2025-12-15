<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    @vite(['resources/css/app.css'])
</head>
<body>
    <div class="auth-container">
        <h1 class="auth-title">ENTRAR</h1>

        <!-- Mensaje de estado (ej. después de registro) -->
        @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="auth-form">
            @csrf

            <!-- Email -->
            <div class="form-group">
                <label for="email" class="form-label">EMAIL</label>
                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
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
                    autocomplete="current-password"
                    class="form-input"
                >
                @error('password')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="form-group remember">
                <label class="remember-label">
                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                    RECORDAR SESIÓN
                </label>
            </div>

            <!-- Olvidé mi contraseña -->
            @if (Route::has('password.request'))
                <div class="form-group">
                    <a href="{{ route('password.request') }}" class="forgot-link">¿OLVIDASTE TU CONTRASEÑA?</a>
                </div>
            @endif

            <!-- Botón de envío -->
            <div class="form-group">
                <button type="submit" class="btn btn-login">ENTRAR</button>
            </div>
        </form>

        <!-- Enlace a registro -->
        <p class="auth-footer">
            ¿No tienes cuenta? <a href="{{ route('register') }}" class="link">REGISTRARSE</a>
        </p>

         <!-- Botón a página principal -->
        <div class="form-group">
            <a href="{{ url('/') }}" class="btn btn-purple">← PÁGINA PRINCIPAL</a>
        </div>
    </div>
</body>
</html>