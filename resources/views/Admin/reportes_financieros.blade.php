@extends('Admin.layouts.admin')

@section('content')
<div class="container-fluid">
    <h2 class="mb-4">Reportes Financieros</h2>

    <!-- Tarjetas de Resumen -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h5 class="card-title">Ingresos Totales</h5>
                    <p class="card-text">{{ number_format($ingresosTotales, 2) }} RD$</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card bg-danger text-white">
                <div class="card-body">
                    <h5 class="card-title">Egresos Totales</h5>
                    <p class="card-text">{{ number_format($egresosTotales, 2) }} RD$</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Filtros para generar reportes -->
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="card-title">Generar Reporte Financiero</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.generarReporte') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="fecha_inicio">Fecha Inicio:</label>
        <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control">
    </div>
    <div class="form-group">
        <label for="fecha_fin">Fecha Fin:</label>
        <input type="date" name="fecha_fin" id="fecha_fin" class="form-control">
    </div>
    <div class="form-group">
        <label for="tipo_reporte">Tipo de Reporte:</label>
        <select name="tipo_reporte" id="tipo_reporte" class="form-control">
            <option value="ingresos">Ingresos</option>
            <option value="egresos">Egresos</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Generar Reporte</button>
</form>

        </div>
    </div>

    <!-- Gráfico de Ingresos y Egresos por Mes -->
    <div class="row mb-4">
        <div class="col-md-12">
            <canvas id="ingresosEgresosChart"></canvas>
        </div>
    </div>

    <!-- Tabla de Reportes Generados -->
    <div class="row">
        <div class="col-md-12">
            <h5>Reportes Generados</h5>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Tipo de Reporte</th>
                        <th>Estado</th>
                        <th>Fecha de Generación</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reportes as $reporte)
                    <tr>
                        <td>{{ $reporte->tipo_reporte }}</td>
                        <td>
                            <span class="badge bg-{{ $reporte->estado == 'pendiente' ? 'warning' : 'success' }}">
                                {{ ucfirst($reporte->estado) }}
                            </span>
                        </td>
                        <td>{{ $reporte->fecha_generacion }}</td>
                        <td>
                        <a href="{{ route('admin.descargarReporte', $reporte->id_reporte) }}" class="btn btn-primary">Descargar Reporte</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>

<script>
    const ingresos = @json($ingresosPorMes);
    const egresos = @json($egresosPorMes);
    const labels = Object.keys(ingresos);
    const ingresosData = Object.values(ingresos);
    const egresosData = Object.values(egresos);

    const ctx = document.getElementById('ingresosEgresosChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Ingresos (RD$)',
                data: ingresosData,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            },
            {
                label: 'Egresos (RD$)',
                data: egresosData,
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

@endsection
