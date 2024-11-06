@extends('layout.app')

@section('title', 'Lista de Notificaciones')

@section('content')
    <h1 class="mt-4">Lista de Notificaciones</h1>
    <a href="{{ route('notificaciones.create') }}" class="btn btn-success mb-3">Crear Nueva Notificación</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Usuario</th>
                <th>Tipo</th>
                <th>Mensaje</th>
                <th>Estado</th>
                <th>Fecha Envío</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($notificaciones as $notificacion)
                <tr>
                    <td>{{ $notificacion->id_notificacion }}</td>
                    <td>{{ $notificacion->usuario->nombre }}</td>
                    <td>{{ $notificacion->tipo_notificacion }}</td>
                    <td>{{ $notificacion->mensaje }}</td>
                    <td>{{ $notificacion->estado }}</td>
                    <td>{{ $notificacion->fecha_envio }}</td>
                    <td>
                        <a href="{{ route('notificaciones.edit', $notificacion->id_notificacion) }}" class="btn btn-primary">Editar</a>
                        <form action="{{ route('notificaciones.destroy', $notificacion->id_notificacion) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
