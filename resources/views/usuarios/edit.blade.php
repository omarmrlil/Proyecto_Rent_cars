@extends('layout.app')

@section('title', 'Editar Usuario')

@section('content')
    <h1 class="mt-4">Editar Usuario</h1>
    <form action="{{ route('usuarios.update', $usuario->id_usuario) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" class="form-control" id="nombre" value="{{ old('nombre', $usuario->nombre) }}" required>
            @error('nombre')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" id="email" value="{{ old('email', $usuario->email) }}" required>
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="rol" class="form-label">Rol</label>
            <select name="rol" class="form-control" id="rol" required>
                <option value="administrador" {{ $usuario->rol == 'administrador' ? 'selected' : '' }}>Administrador</option>
                <option value="empleado" {{ $usuario->rol == 'empleado' ? 'selected' : '' }}>Empleado</option>
                <option value="cliente" {{ $usuario->rol == 'cliente' ? 'selected' : '' }}>Cliente</option>
            </select>
            @error('rol')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
@endsection
