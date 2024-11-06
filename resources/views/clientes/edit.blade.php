@extends('layout.app')

@section('title', 'Editar Cliente')

@section('content')
    <h1 class="mt-4">Editar Cliente</h1>
    <form action="{{ route('clientes.update', $cliente->id_cliente) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" class="form-control" id="nombre" value="{{ old('nombre', $cliente->usuario->nombre) }}" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" id="email" value="{{ old('email', $cliente->usuario->email) }}" required>
        </div>
        <div class="mb-3">
            <label for="tipo_documento" class="form-label">Tipo de Documento</label>
            <select name="tipo_documento" class="form-control" id="tipo_documento" required>
                <option value="cedula" {{ old('tipo_documento', $cliente->tipo_documento) == 'cedula' ? 'selected' : '' }}>Cédula</option>
                <option value="pasaporte" {{ old('tipo_documento', $cliente->tipo_documento) == 'pasaporte' ? 'selected' : '' }}>Pasaporte</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="documento_identidad" class="form-label">Documento de Identidad</label>
            <input type="text" name="documento_identidad" class="form-control" id="documento_identidad" value="{{ old('documento_identidad', $cliente->documento_identidad) }}" required>
        </div>
        <div class="mb-3">
            <label for="licencia_conducir" class="form-label">Licencia de Conducir</label>
            <input type="text" name="licencia_conducir" class="form-control" id="licencia_conducir" value="{{ old('licencia_conducir', $cliente->licencia_conducir) }}" required>
        </div>
        <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono</label>
            <input type="text" name="telefono" class="form-control" id="telefono" value="{{ old('telefono', $cliente->telefono) }}">
        </div>
        <div class="mb-3">
            <label for="direccion" class="form-label">Dirección</label>
            <input type="text" name="direccion" class="form-control" id="direccion" value="{{ old('direccion', $cliente->direccion) }}">
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
@endsection
