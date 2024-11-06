@extends('layout.app')

@section('title', 'Inventario de Piezas')

@section('content')
    <h1 class="mt-4">Inventario de Piezas</h1>
    <a href="{{ route('inventarios.create') }}" class="btn btn-success mb-3">Agregar Nueva Pieza</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre de Pieza</th>
                <th>Cantidad Disponible</th>
                <th>Costo por Unidad</th>
                <th>Proveedor</th>
                <th>Stock Mínimo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($piezas as $pieza)
                <tr>
                    <td>{{ $pieza->id_pieza }}</td>
                    <td>{{ $pieza->nombre_pieza }}</td>
                    <td>{{ $pieza->cantidad_disponible }}</td>
                    <td>{{ $pieza->costo_unidad }}</td>
                    <td>{{ $pieza->proveedor }}</td>
                    <td>{{ $pieza->stock_minimo }}</td>
                    <td>
                        <a href="{{ route('inventarios.edit', $pieza->id_pieza) }}" class="btn btn-primary">Editar</a>
                        <form action="{{ route('inventarios.destroy', $pieza->id_pieza) }}" method="POST" style="display:inline-block;">
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
