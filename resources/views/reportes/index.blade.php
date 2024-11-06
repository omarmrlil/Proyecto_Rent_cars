@extends('layout.app')

@section('title', 'Generar Reportes')

@section('content')
    <h1 class="mt-4">Generar Reportes</h1>
    <form action="{{ route('reportes.generar') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="tipo_reporte" class="form-label">Tipo de Reporte</label>
            <select name="tipo_reporte" class="form-control" id="tipo_reporte" required>
                <option value="alquileres">Reporte de Alquileres</option>
                <option value="pagos">Reporte de Pagos</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="fecha_inicio" class="form-label">Fecha Inicio</label>
            <input type="date" name="fecha_inicio" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="fecha_fin" class="form-label">Fecha Fin</label>
            <input type="date" name="fecha_fin" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Generar Reporte</button>
    </form>
@endsection
