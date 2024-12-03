<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Alquileres - A&J Rent Cars</title>
    <!-- CSS de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <div class="container py-5">
        <h1 class="text-center mb-4">Mis Alquileres</h1>

        @if ($alquileres->isEmpty())
            <div class="alert alert-info text-center">
                <p>No tienes alquileres registrados actualmente.</p>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>Auto</th>
                            <th>Fecha de Inicio</th>
                            <th>Fecha de Fin</th>
                            <th>Estado</th>
                            <th>Costo Total</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($alquileres as $alquiler)
                            <tr>
                                <td>
                                    {{ $alquiler->auto->marca->nombre_marca ?? 'N/A' }} {{ $alquiler->auto->modelo ?? 'N/A' }}
                                </td>
                                <td>{{ $alquiler->fecha_inicio }}</td>
                                <td>{{ $alquiler->fecha_fin }}</td>
                                <td>
                                    <span class="badge bg-{{ $alquiler->estado === 'pendiente' ? 'warning' : ($alquiler->estado === 'completado' ? 'success' : 'danger') }}">
                                        {{ ucfirst($alquiler->estado) }}
                                    </span>
                                </td>
                                <td>${{ number_format($alquiler->costo_total, 2) }}</td>
                                <td>
                                    <a href="#" class="btn btn-outline-primary btn-sm">Detalles</a>
                                    @if ($alquiler->estado === 'pendiente')
                                        <a href="#" class="btn btn-danger btn-sm">Cancelar</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <!-- Footer -->


    <!-- Scripts de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
