@extends('Admin.layouts.admin')

@section('content')
<div class="container-fluid">
    <h2>Inventario de Piezas</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nombre de la Pieza</th>
                <th>Cantidad Disponible</th>
                <th>Proveedor</th>
                <th>Costo Unitario</th>
                <th>Stock Mínimo</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($piezas as $pieza)
                <tr>
                    <td>{{ $pieza->nombre_pieza }}</td>
                    <td>{{ $pieza->cantidad_disponible }}</td>
                    <td>{{ $pieza->proveedor }}</td>
                    <td>{{ $pieza->costo_unidad }} RD$</td>
                    <td>{{ $pieza->stock_minimo }}</td>
                    <td>
                        @if($pieza->cantidad_disponible <= $pieza->stock_minimo)
                            <span class="badge bg-danger">Bajo Stock</span>
                        @else
                            <span class="badge bg-success">Disponible</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
    