@extends('layout.app')

@section('content')
    <div class="container">
        <h1>Detalle del Mantenimiento</h1>
        <div class="card">
            <div class="card-header">
                Mantenimiento ID: {{ $mantenimiento->id_mantenimiento }}
            </div>
            <div class="card-body">
                <p><strong>Auto:</strong> {{ $mantenimiento->auto->modelo }} ({{ $mantenimiento->auto->matricula }})</p>
                <p><strong>Fecha:</strong> {{ $mantenimiento->fecha_mantenimiento }}</p>
                <p><strong>Tipo:</strong> {{ ucfirst($mantenimiento->tipo_mantenimiento) }}</p>
                <p><strong>Kilometraje:</strong> {{ $mantenimiento->kilometraje }} km</p>
                <p><strong>Costo:</strong> ${{ number_format($mantenimiento->costo, 2) }}</p>
                <p><strong>Realizado por:</strong> {{ $mantenimiento->empleado ? $mantenimiento->empleado->nombre : 'No asignado' }}</p>
                <p><strong>Descripción:</strong> {{ $mantenimiento->descripcion }}</p>
                <a href="{{ route('mantenimientos.index') }}" class="btn btn-secondary">Volver a la lista</a>
                <a href="{{ route('mantenimientos.edit', $mantenimiento->id_mantenimiento) }}" class="btn btn-warning">Editar</a>
            </div>
        </div>
    </div>
@endsection
