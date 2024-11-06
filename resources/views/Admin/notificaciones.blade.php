@extends('Admin.layouts.admin')

@section('content')
<div class="container-fluid">
    <h2>Notificaciones Recientes</h2>
    <ul class="list-group">
        @foreach ($notificacionesRecientes as $notificacion)
            <li class="list-group-item">
                <strong>{{ $notificacion->tipo_notificacion }}</strong>: {{ $notificacion->mensaje }}
                <span class="badge bg-info float-end">{{ $notificacion->fecha_envio ?? 'Pendiente' }}</span>
            </li>
        @endforeach
    </ul>
</div>
@endsection
