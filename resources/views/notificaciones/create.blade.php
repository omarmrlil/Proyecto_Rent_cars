@extends('layout.app')

@section('title', 'Crear Notificación')

@section('content')
    <h1 class="mt-4">Crear Nueva Notificación</h1>
    <form action="{{ route('notificaciones.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="id_usuario" class="form-label">Usuario</label>
            <select name="id_usuario" class="form-control" id="id_usuario" required>
                <option value="">Seleccione un usuario</option>
                @foreach($usuarios as $usuario)
                    <option value="{{ $usuario->id_usuario }}">{{ $usuario->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="tipo_notificacion" class="form-label">Tipo de Notificación</label>
            <select name="tipo_notificacion" class="form-control" id="tipo_notificacion" required>
                <option value="mantenimiento">Mantenimiento</option>
                <option value="devolución">Devolución</option>
                <option value="pago">Pago</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="mensaje" class="form-label">Mensaje</label>
            <textarea name="mensaje" class="form-control" id="mensaje" rows="4" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Crear Notificación</button>
        <a href="{{ route('notificaciones.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection
