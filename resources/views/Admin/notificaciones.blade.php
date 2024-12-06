@extends('Admin.layouts.admin')

@section('content')
<div class="container-fluid">
    <h2>Notificaciones Recientes</h2>

    <!-- Mensaje de éxito -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Lista de notificaciones -->
    <ul class="list-group">
        @foreach ($notificacionesRecientes as $notificacion)
            <li class="list-group-item">
                <strong>{{ $notificacion->tipo_notificacion }}</strong>: {{ $notificacion->mensaje }}
                <span class="badge bg-info float-end">
                    @if($notificacion->fecha_envio)
                        {{ \Carbon\Carbon::parse($notificacion->fecha_envio)->format('d/m/Y H:i') }}
                    @else
                        Pendiente
                    @endif
                </span>
                <!-- Botón para marcar como enviada -->
                @if($notificacion->estado == 'pendiente')
                    <a href="{{ route('admin.marcarNotificacionEnviada', $notificacion->id_notificacion) }}" class="btn btn-success btn-sm float-end ms-2">Marcar como enviada</a>
                @endif
            </li>
        @endforeach
    </ul>

    <!-- Crear nueva notificación -->
    <div class="mt-4">
        <a href="{{ route('admin.createNotificacion') }}" class="btn btn-primary">Crear Notificación</a>
    </div>
</div>
@endsection
