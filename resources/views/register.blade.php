@extends('layout.app')

@section('content')
<div class="register-container">
    <h1>Registro de Cliente</h1>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Campos para la tabla usuarios -->
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre') }}" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
        </div>

        <div class="form-group">
            <label for="password">Contraseña</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="password_confirmation">Confirmar Contraseña</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
        </div>

        <!-- Campos para la tabla clientes -->
        <div class="form-group">
            <label for="tipo_documento">Tipo de Documento</label>
            <select name="tipo_documento" id="tipo_documento" class="form-control" required>
                <option value="cedula" {{ old('tipo_documento') == 'cedula' ? 'selected' : '' }}>Cédula</option>
                <option value="pasaporte" {{ old('tipo_documento') == 'pasaporte' ? 'selected' : '' }}>Pasaporte</option>
            </select>
        </div>

        <div class="form-group">
            <label for="documento_identidad">Documento de Identidad</label>
            <input type="text" name="documento_identidad" id="documento_identidad" class="form-control" value="{{ old('documento_identidad') }}" required>
        </div>

        <div class="form-group">
            <label for="licencia_conducir">Licencia de Conducir</label>
            <input type="text" name="licencia_conducir" id="licencia_conducir" class="form-control" value="{{ old('licencia_conducir') }}" required>
        </div>

        <div class="form-group">
            <label for="telefono">Teléfono (opcional)</label>
            <input type="text" name="telefono" id="telefono" class="form-control" value="{{ old('telefono') }}">
        </div>

        <div class="form-group">
            <label for="direccion">Dirección (opcional)</label>
            <input type="text" name="direccion" id="direccion" class="form-control" value="{{ old('direccion') }}">
        </div>

        <button type="submit" class="btn btn-primary">Registrarse</button>
    </form>
</div>
@endsection

