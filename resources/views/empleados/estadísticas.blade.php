<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Estadísticas</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/empleados.css') }}">
</head>
<body>
    @include('partials.navbar_empleado')

    <div class="container py-5">
        <h1 class="text-center mb-4">Estadísticas</h1>

        <div class="row">
            <!-- Tarjetas de Resumen -->
            <div class="col-md-6 mb-4">
                <div class="card shadow">
                    <div class="card-body text-center">
                        <h3 class="text-primary">{{ $mantenimientosRealizados }}</h3>
                        <p>Mantenimientos Realizados</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card shadow">
                    <div class="card-body text-center">
                        <h3 class="text-warning">{{ $autosEnMantenimiento }}</h3>
                        <p>Autos en Mantenimiento</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Historial de Mantenimientos -->
        <h2 class="mt-5">Historial de Mantenimientos Recientes</h2>
        @if ($historialMantenimientos->isEmpty())
            <p class="text-center">No se encontraron mantenimientos recientes.</p>
        @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Auto</th>
                        <th>Tipo</th>
                        <th>Costo</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($historialMantenimientos as $mantenimiento)
                        <tr>
                            <td>{{ $mantenimiento->fecha_mantenimiento }}</td>
                            <td>{{ $mantenimiento->auto->marca->nombre_marca }} {{ $mantenimiento->auto->modelo }}</td>
                            <td>{{ ucfirst($mantenimiento->tipo_mantenimiento) }}</td>
                            <td>${{ number_format($mantenimiento->costo, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        <!-- Piezas Más Usadas -->
        <h2 class="mt-5">Piezas Más Usadas</h2>
        @if ($piezasUsadas->isEmpty())
            <p class="text-center">No hay información sobre piezas usadas.</p>
        @else
            <ul class="list-group">
                @foreach ($piezasUsadas as $pieza)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $pieza->nombre_pieza }}
                        <span class="badge bg-primary rounded-pill">{{ $pieza->total_usado }}</span>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>

    @include('partials.footer_empleado')
</body>
</html>
