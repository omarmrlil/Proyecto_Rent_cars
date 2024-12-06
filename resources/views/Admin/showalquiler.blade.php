@extends('admin.layouts.admin')

@section('content')
    <div class="container">
        <h1>Detalles del Alquiler</h1>

        <p><strong>Cliente:</strong> {{ $alquiler->cliente->nombre }}</p>
        <p><strong>Auto:</strong> {{ $alquiler->auto->modelo }}</p>
        <p><strong>Fecha de Inicio:</strong> {{ $alquiler->fecha_inicio }}</p>
        <p><strong>Fecha de Fin:</strong> {{ $alquiler->fecha_fin }}</p>
        <p><strong>Costo Total:</strong> {{ $alquiler->costo_total }}</p>

        <a href="{{ route('admin.alquileres') }}" class="btn btn-secondary">Volver</a>
    </div>
@endsection
