<div class="container py-5">
    <h1 class="text-center">Historial de Actividades</h1>

    <form action="{{ route('empleado.historial') }}" method="GET" class="row g-3 mb-4">
        <div class="col-md-4">
            <input type="date" name="fecha_inicio" class="form-control" placeholder="Fecha Inicio" value="{{ request('fecha_inicio') }}">
        </div>
        <div class="col-md-4">
            <input type="date" name="fecha_fin" class="form-control" placeholder="Fecha Fin" value="{{ request('fecha_fin') }}">
        </div>
        <div class="col-md-4">
            <button type="submit" class="btn btn-primary w-100">Filtrar</button>
        </div>
    </form>

    <h3>Mantenimientos Completados</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Auto</th>
                <th>Descripción</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($mantenimientos as $mantenimiento)
                <tr>
                    <td>{{ $mantenimiento->auto->marca->nombre_marca }} {{ $mantenimiento->auto->modelo }}</td>
                    <td>{{ $mantenimiento->descripcion }}</td>
                    <td>{{ $mantenimiento->fecha_mantenimiento }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">No hay mantenimientos completados en este periodo.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <h3>Tareas Completadas</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Título</th>
                <th>Descripción</th>
                <th>Fecha de Completación</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($tareas as $tarea)
                <tr>
                    <td>{{ $tarea->titulo }}</td>
                    <td>{{ $tarea->descripcion }}</td>
                    <td>{{ $tarea->updated_at->format('Y-m-d') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">No hay tareas completadas en este periodo.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
    