<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - Tutoriales Web</title>
    @vite(['resources/css/app.css'])
</head>
<body>
    <div class="container profile-container">
        <h1 class="title">PROFILE</h1>

        <!-- Información del usuario -->
        <div class="user-info">
            <p class="subtitle">Hola, <span style="color: #b026ff;">{{ Auth::user()->name }}</span></p>
            <p class="subtitle">Correo: {{ Auth::user()->email }}</p>
        </div>

        <!-- Enlaces de navegación -->
        <nav class="profile-nav">
            <a href="{{ route('dashboard') }}" class="btn btn-dashboard">Dashboard</a>
            <a href="{{ route('profile.edit') }}" class="btn btn-blue">Profile</a>
            <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                @csrf
                <button type="submit" class="btn btn-red">Cerrar Sesión</button>
            </form>
        </nav>

        <!-- Formulario de información del perfil -->
        <div class="section">
            <h2 class="section-title">Profile Information</h2>
            <p class="section-desc">Update your account's profile information and email address.</p>

            <form method="POST" action="{{ route('profile.update') }}" class="profile-form">
                @csrf
                @method('patch')

                <!-- Name -->
                <div class="form-group">
                    <label for="name" class="form-label">NAME</label>
                    <input
                        id="name"
                        type="text"
                        name="name"
                        value="{{ old('name', $user->name) }}"
                        required
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
                        value="{{ old('email', $user->email) }}"
                        required
                        autocomplete="username"
                        class="form-input"
                    >
                    @error('email')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-green">Save</button>
                </div>
            </form>
        </div>

        <!-- Actualizar contraseña -->
        <div class="section">
            <h2 class="section-title">Update Password</h2>
            <p class="section-desc">Ensure your account is using a long, random password to stay secure.</p>

            <form method="POST" action="{{ route('password.update') }}" class="profile-form">
                @csrf
                @method('put')

                <!-- Current Password -->
                <div class="form-group">
                    <label for="current_password" class="form-label">CURRENT PASSWORD</label>
                    <input
                        id="current_password"
                        type="password"
                        name="current_password"
                        required
                        autocomplete="current-password"
                        class="form-input"
                    >
                    @error('current_password')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <!-- New Password -->
                <div class="form-group">
                    <label for="password" class="form-label">NEW PASSWORD</label>
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
                    <label for="password_confirmation" class="form-label">CONFIRM PASSWORD</label>
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

                <div class="form-group">
                    <button type="submit" class="btn btn-purple">Save</button>
                </div>
            </form>
        </div>

        <!-- Eliminar cuenta -->
        <div class="section delete-section">
            <h2 class="section-title">Delete Account</h2>
            <p class="section-desc">
                Once your account is deleted, all of its resources and data will be permanently deleted.
                Before deleting your account, please download any data or information that you wish to retain.
            </p>

            <div class="form-group">
                <form method="POST" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-red">Delete Account</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>