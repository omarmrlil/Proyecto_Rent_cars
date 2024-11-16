<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
    <title>Crear Cuenta</title>
</head>
<body>

<div class="register-container">
    <div class="image-container">
        <img src="{{ asset('images/car2.jpg') }}" alt="Auto de Registro">
    </div>
    <div class="form-container">
        <h2>Crear Cuenta</h2>
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Campos para la tabla usuarios -->
            <input type="text" name="nombre" placeholder="Nombre" value="{{ old('nombre') }}" required>
            <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
            <div class="document-group">
                <select name="tipo_documento" required>
                    <option value="cedula" {{ old('tipo_documento') == 'cedula' ? 'selected' : '' }}>Cédula</option>
                    <option value="pasaporte" {{ old('tipo_documento') == 'pasaporte' ? 'selected' : '' }}>Pasaporte</option>
                </select>
                <input type="text" name="documento_identidad" placeholder="No. Documento" value="{{ old('documento_identidad') }}" required>
            </div>
            <input type="text" name="licencia_conducir" placeholder="Licencia de Conducir" value="{{ old('licencia_conducir') }}" required>
            <input type="text" name="telefono" placeholder="Teléfono o Celular" value="{{ old('telefono') }}">
            <input type="text" name="direccion" placeholder="Dirección" value="{{ old('direccion') }}">
            <input type="password" name="password" placeholder="Contraseña" required>
            <input type="password" name="password_confirmation" placeholder="Confirmar Contraseña" required>

            <button type="submit">Registrate</button>
        </form>
        <p class="login-link">¿Ya tiene una cuenta? <a href="{{ route('login') }}">Iniciar Sesión</a></p>
    </div>
</div>

</body>
</html>
