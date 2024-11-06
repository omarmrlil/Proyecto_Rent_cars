@extends('Admin.layouts.admin')

@section('content')
<div class="container-fluid">
    <h2>Historial de Mantenimientos</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Auto</th>
                <th>Fecha de Mantenimiento</th>
                <th>Tipo de Mantenimiento</th>
                <th>Descripción</th>
                <th>Empleado</th>
                <th>Costo</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($mantenimientos as $mantenimiento)
                <tr>
                    <td>{{ $mantenimiento->auto->modelo }}</td>
                    <td>{{ $mantenimiento->fecha_mantenimiento }}</td>
                    <td>{{ $mantenimiento->tipo_mantenimiento }}</td>
                    <td>{{ $mantenimiento->descripcion }}</td>
                    <td>{{ $mantenimiento->empleado->usuario->nombre ?? 'N/A' }}</td>
                    <td>{{ $mantenimiento->costo }} RD$</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
