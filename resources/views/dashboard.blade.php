<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Tutoriales Web</title>
    @vite(['resources/css/app.css'])
</head>
<body>
    <!-- Barra superior: Profile + Cerrar Sesión -->
    <div class="top-right-bar">
        <a href="{{ route('profile.edit') }}" class="btn btn-blue">Profile</a>
        <form method="POST" action="{{ route('logout') }}" style="display: inline;">
            @csrf
            <button type="submit" class="btn btn-red">Cerrar Sesión</button>
        </form>
    </div>

    <!-- Contenido principal -->
    <div class="main-content">
        <h1 class="title">DASHBOARD</h1>
        <p class="subtitle">¡Hola, <span style="color: #b026ff;">{{ Auth::user()->name }}</span>!</p>
        <p class="subtitle">Correo: {{ Auth::user()->email }}</p>
        <p class="message">You're logged in!</p>
    </div>

    <!-- Panel izquierdo: Subir Proyectos / Tutoriales -->
    <div class="left-actions">
        <a href="/proyectos" class="btn btn-green">Subir Proyecto</a>
        <a href="/tutoriales" class="btn btn-purple">Subir Tutorial</a>
    </div>
</body>
</html>