@extends('layout.app')

@section('title', 'Mis Notificaciones')

@section('content')
    <h1 class="mt-4">Mis Notificaciones</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tipo</th>
                <th>Mensaje</th>
                <th>Estado</th>
                <th>Fecha de Envío</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($notificaciones as $notificacion)
                <tr>
                    <td>{{ $notificacion->tipo_notificacion }}</td>
                    <td>{{ $notificacion->mensaje }}</td>
                    <td>{{ ucfirst($notificacion->estado) }}</td>
                    <td>{{ $notificacion->fecha_envio }}</td>
                    <td>
                        @if ($notificacion->estado !== 'visto')
                            <form action="{{ route('notificaciones.marcarVisto', $notificacion->id_notificacion) }}" method="POST" style="display:inline-block;">
                                @csrf
                                <button type="submit" class="btn btn-secondary">Marcar como Visto</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
