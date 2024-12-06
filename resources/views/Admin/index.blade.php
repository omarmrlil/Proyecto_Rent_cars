@extends('Admin.layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Contenido Principal -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Dashboard del Administrador</h1>
            </div>

            <!-- Tarjetas de Resumen -->
            <div class="row mb-4">
                <!-- Total de Autos -->
                <div class="col-md-3">
                    <div class="card bg-info text-white">
                        <div class="card-body">
                            <h5 class="card-title">Total de Autos</h5>
                            <p class="card-text">{{ $totalAutos }}</p>
                        </div>
                    </div>
                </div>
                <!-- Total de Clientes -->
                <div class="col-md-3">
                    <div class="card bg-success text-white">
                        <div class="card-body">
                            <h5 class="card-title">Total de Clientes</h5>
                            <p class="card-text">{{ $totalClientes }}</p>
                        </div>
                    </div>
                </div>
                <!-- Alquileres Activos -->
                <div class="col-md-3">
                    <div class="card bg-warning text-white">
                        <div class="card-body">
                            <h5 class="card-title">Alquileres Activos</h5>
                            <p class="card-text">{{ $alquileresActivos }}</p>
                        </div>
                    </div>
                </div>
                <!-- Ingresos Totales -->
                <div class="col-md-3">
                    <div class="card bg-danger text-white">
                        <div class="card-body">
                            <h5 class="card-title">Ingresos Totales</h5>
                            <p class="card-text">{{ $ingresosTotales }} RD$</p>
                        </div>
                    </div>
                </div>
            </div>

            
            <!-- Tabla de Alquileres Recientes -->
<div class="table-responsive mt-4">
    <h5>Alquileres Recientes</h5>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Auto</th>
                <th>Fecha de Inicio</th>
                <th>Fecha de Fin</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($alquileresRecientes as $alquiler)
            <tr>
                <td>{{ $alquiler->id_alquiler }}</td>
                <td>{{ $alquiler->cliente->usuario->nombre }}</td> <!-- Nombre del cliente -->
                <td>{{ $alquiler->auto->modelo }}</td>
                <td>{{ $alquiler->fecha_inicio }}</td>
                <td>{{ $alquiler->fecha_fin }}</td>
                <td>{{ $alquiler->estado }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>


            <!-- Tabla de Piezas de Inventario Disponibles -->
            <div class="table-responsive mt-4">
                <h5>Piezas Disponibles en Inventario</h5>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nombre de la Pieza</th>
                            <th>Cantidad Disponible</th>
                            <th>Costo por Unidad (RD$)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($piezasDisponibles as $pieza)
                        <tr>
                            <td>{{ $pieza->nombre_pieza }}</td>
                            <td>{{ $pieza->cantidad_disponible }}</td>
                            <td>{{ $pieza->costo_unidad }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Tabla de Mantenimientos Recientes -->
            <div class="table-responsive mt-4">
                <h5>Mantenimientos Recientes</h5>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Auto</th>
                            <th>Fecha de Mantenimiento</th>
                            <th>Tipo de Mantenimiento</th>
                            <th>Costo</th>
                            <th>Empleado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mantenimientosRecientes as $mantenimiento)
                        <tr>
                            <td>{{ $mantenimiento->auto->modelo }}</td>
                            <td>{{ $mantenimiento->fecha_mantenimiento }}</td>
                            <td>{{ ucfirst($mantenimiento->tipo_mantenimiento) }}</td>
                            <td>{{ $mantenimiento->costo }} RD$</td>
                            <td>{{ $mantenimiento->empleado ? $mantenimiento->empleado->usuario->nombre : 'N/A' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </main>
    </div>

</div>
@endsection
