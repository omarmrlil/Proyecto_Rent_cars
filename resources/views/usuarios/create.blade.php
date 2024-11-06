@extends('layout.app')

@section('title', 'Crear Usuario')

@section('content')
    <h1 class="mt-4">Crear Usuario</h1>
    <form action="{{ route('usuarios.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" class="form-control" id="nombre" value="{{ old('nombre') }}" required>
            @error('nombre')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" id="email" value="{{ old('email') }}" required>
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <input type="password" name="password" class="form-control" id="password" required>
            @error('password')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="rol" class="form-label">Rol</label>
            <select name="rol" class="form-control" id="rol" required>
                <option value="administrador">Administrador</option>
                <option value="empleado">Empleado</option>
                <option value="cliente">Cliente</option>
            </select>
            @error('rol')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
@endsection
