
    <div class="container">
        <h1>Mis Notificaciones</h1>

        @if ($notificaciones->isEmpty())
            <p>No tienes notificaciones.</p>
        @else
            <ul class="list-group">
                @foreach ($notificaciones as $notificacion)
                    <li class="list-group-item">
                        <strong>{{ $notificacion->tipo_notificacion }}</strong>: {{ $notificacion->mensaje }}
                        <span class="badge bg-secondary">{{ $notificacion->estado }}</span>
                        <br>
                        Fecha: {{ $notificacion->fecha_creacion }}
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
