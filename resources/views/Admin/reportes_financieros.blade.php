@extends('Admin.layouts.admin')

@section('content')
<div class="container-fluid">
    <h2>Reportes Financieros</h2>

    <!-- Tarjetas de Resumen -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <h5 class="card-title">Ingresos Totales</h5>
                    <p class="card-text">{{ $ingresosTotales }} RD$</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card bg-danger text-white">
                <div class="card-body">
                    <h5 class="card-title">Egresos Totales</h5>
                    <p class="card-text">{{ $egresosTotales }} RD$</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Gráfico de Ingresos por Mes -->
    <div class="row">
        <div class="col-md-12">
            <canvas id="ingresosPorMesChart"></canvas>
        </div>
    </div>
</div>

<script>
    const ingresosPorMes = @json($ingresosPorMes);
    const labels = Object.keys(ingresosPorMes);
    const data = Object.values(ingresosPorMes);

    const ctx = document.getElementById('ingresosPorMesChart').getContext('2d');
    const ingresosPorMesChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Ingresos por Mes (RD$)',
                data: data,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
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
