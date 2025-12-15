<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido - Tutoriales Web</title>
    @vite(['resources/css/app.css'])
</head>
<body>
    <div class="container">
        <h1 class="title">ESPACIO PARA SUBIR PROYECTOS</h1>
        <p class="subtitle">Sube tus proyectos web y tutoriales en video</p>

        @if (Route::has('login'))
            <nav class="auth-nav">
                @auth
                    <a href="{{ url('/dashboard') }}" class="btn btn-dashboard">Dashboard</a>
                @else
                    <a href="/google-auth/redirect" class="btn btn-google">Google</a>
                    <a href="{{ route('login') }}" class="btn btn-login">Entrar</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-register">Registrarse</a>
                    @endif
                @endauth
            </nav>
        @endif
    </div>
</body>
</html>