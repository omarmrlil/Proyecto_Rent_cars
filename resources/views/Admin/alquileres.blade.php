@extends('admin.layouts.admin')

@section('content')
<div class="container">
    <h1>Gestión de Alquileres</h1>

    <!-- Tabla de Alquileres -->
    <h3>Alquileres Actuales</h3>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Cliente</th>
                <th>Auto</th>
                <th>Fecha de Inicio</th>
                <th>Fecha de Fin</th>
                <th>Costo Total</th>
                <th>Acciones</th>
            </tr>
        </thead>
<tbody>
    @foreach ($alquileres as $alquiler)
        <tr>
            <td>{{ $alquiler->cliente->usuario->nombre }}</td> <!-- Nombre del cliente -->
            <td>{{ $alquiler->auto->modelo }}</td>
            <td>{{ $alquiler->fecha_inicio }}</td>
            <td>{{ $alquiler->fecha_fin }}</td>
            <td>{{ $alquiler->costo_total }}</td>
            <td>
                <a href="{{ route('admin.showAlquiler', $alquiler->id_alquiler) }}" class="btn btn-info btn-sm">Ver</a>
                <a href="{{ route('admin.editAlquiler', $alquiler->id_alquiler) }}" class="btn btn-warning btn-sm">Editar</a>
                <form action="{{ route('admin.deleteAlquiler', $alquiler->id_alquiler) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                </form>
            </td>
        </tr>
    @endforeach
</tbody>
    </table>
</div>
@endsection
