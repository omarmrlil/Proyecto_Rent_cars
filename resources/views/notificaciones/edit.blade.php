@extends('layout.app')

@section('title', 'Editar Notificación')

@section('content')
    <h1 class="mt-4">Editar Notificación</h1>
    <form action="{{ route('notificaciones.update', $notificacion->id_notificacion) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="id_usuario" class="form-label">Usuario</label>
            <select name="id_usuario" class="form-control" id="id_usuario" required>
                <option value="">Seleccione un usuario</option>
                @foreach($usuarios as $usuario)
                    <option value="{{ $usuario->id_usuario }}" {{ $notificacion->id_usuario == $usuario->id_usuario ? 'selected' : '' }}>
                        {{ $usuario->nombre }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="tipo_notificacion" class="form-label">Tipo de Notificación</label>
            <select name="tipo_notificacion" class="form-control" id="tipo_notificacion" required>
                <option value="mantenimiento" {{ $notificacion->tipo_notificacion == 'mantenimiento' ? 'selected' : '' }}>Mantenimiento</option>
                <option value="devolución" {{ $notificacion->tipo_notificacion == 'devolución' ? 'selected' : '' }}>Devolución</option>
                <option value="pago" {{ $notificacion->tipo_notificacion == 'pago' ? 'selected' : '' }}>Pago</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="mensaje" class="form-label">Mensaje</label>
            <textarea name="mensaje" class="form-control" id="mensaje" rows="4" required>{{ $notificacion->mensaje }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar Notificación</button>
        <a href="{{ route('notificaciones.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection
