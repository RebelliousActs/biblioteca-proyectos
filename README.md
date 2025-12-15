
Laravel: Auth con Breeze y Google

Breve guía paso a paso para **implementar autenticación con Laravel Breeze (Blade)** y **login con Google (Socialite)**. Incluye los comandos esenciales, los archivos que debes modificar y el paso para mapear un dominio local en `hosts` (útil para el callback de Google).

---

## Requisitos
- **Software:** PHP, Composer, Node.js, npm.  
- **Proyecto:** un proyecto Laravel existente o crear uno nuevo.  
- **Cuenta Google Cloud** para crear credenciales OAuth (Client ID y Client Secret).

---

## Comandos principales (paso a paso)

1. **Crear proyecto Laravel (si aplica)**
```bash
composer create-project --prefer-dist laravel/laravel mi-proyecto
cd mi-proyecto
```

2. **Instalar Breeze (Blade)**
```bash
composer require laravel/breeze --dev
php artisan breeze:install
npm install
npm run dev
php artisan migrate
```

3. **Instalar Socialite (Google)**
```bash
composer require laravel/socialite
```

4. **Configurar variables de entorno**
Edita `.env` y añade las variables de Google (rellena con tus credenciales):
```
GOOGLE_CLIENT_ID=tu_client_id
GOOGLE_CLIENT_SECRET=tu_client_secret

```

5. **Mapear dominio local en hosts (para callback de Google)**

- **Objetivo:** que `mi-proyecto.com` resuelva a tu máquina local y coincida con la URL registrada en Google Cloud.

- **Linux / macOS**
  ```bash
  sudo nano /etc/hosts
  ```
  Añade al final:
  ```
  127.0.0.1    mi-proyecto.com
  ```

- **Windows**
  - Abre el Bloc de notas como Administrador y edita:
    ```
    C:\Windows\System32\drivers\etc\hosts
    ```
  - Añade:
    ```
    127.0.0.1    mi-proyecto.com
    ```

- **En Google Cloud Console** (APIs & Services → Credentials) registra el **Authorized redirect URI**:
  ```
  http://mi-proyecto.com/google-auth/callback
  ```

- **En Laravel** asegúrate de que `.env` y `config/services.php` usan la misma URL de callback (ver sección siguiente).

6. **Levantar servidor local con host personalizado**
```bash
php artisan serve --host mi-proyecto.com --port:80
```

---

## Archivos a modificar (esenciales)

### `config/services.php`
Añade la configuración de Google:
```php
'google' => [
    'client_id' => env('GOOGLE_CLIENT_ID'),
    'client_secret' => env('GOOGLE_CLIENT_SECRET'),
    'redirect' =>'http://mi-proyecto.com/google-auth/callback',
],
```

### `.env`
Asegúrate de tener:
```
GOOGLE_CLIENT_ID=tu_client_id
GOOGLE_CLIENT_SECRET=tu_client_secret

```

### `routes/web.php`
Rutas mínimas para Google:

```php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
// Socialite Routes
Route::get('/google-auth/redirect', function () {
    return Socialite::driver('google')->redirect();
});
Route::get('/google-auth/callback', function () {
    $user_google = Socialite::driver('google')->user();
    $user = User::updateOrCreate(
        [
            'google_id' => $user_google->id,
        ],
        [
            'name' => $user_google->name,
            'email' => $user_google->email,
        ]
    );
    Auth::login($user);
    return redirect('/dashboard');
    
});
```

---

## Pasos mínimos en Google Cloud (resumen)
1. Entra a **Google Cloud Console → APIs & Services → Credentials**.  
2. Crea un **OAuth 2.0 Client ID** (Application type: Web application).  
3. En **Authorized redirect URIs** añade:
```
http://mi-proyecto.com/google-auth/callback
```
4. Copia **Client ID** y **Client Secret** a tu `.env`.

---


