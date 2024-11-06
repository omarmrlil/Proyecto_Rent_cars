@extends('layout.app')

@section('title', 'Lista de Alquileres')

@section('content')
    <h1 class="mt-4">Lista de Alquileres</h1>
    <a href="{{ route('alquileres.create') }}" class="btn btn-success mb-3">Registrar Nuevo Alquiler</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Auto</th>
                <th>Fecha Inicio</th>
                <th>Fecha Fin</th>
                <th>Estado</th>
                <th>Costo Total</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($alquileres as $alquiler)
                <tr>
                    <td>{{ $alquiler->id_alquiler }}</td>
                    <td>{{ $alquiler->cliente->usuario->nombre }}</td>
                    <td>{{ $alquiler->auto->modelo }}</td>
                    <td>{{ $alquiler->fecha_inicio }}</td>
                    <td>{{ $alquiler->fecha_fin }}</td>
                    <td>{{ $alquiler->estado }}</td>
                    <td>{{ $alquiler->costo_total }} USD</td>
                    <td>
                        <a href="{{ route('alquileres.edit', $alquiler->id_alquiler) }}" class="btn btn-primary">Editar</a>
                        <form action="{{ route('alquileres.destroy', $alquiler->id_alquiler) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
