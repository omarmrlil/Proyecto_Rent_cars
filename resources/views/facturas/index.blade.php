@extends('layout.app')

@section('content')
<div class="container">
    <h1>Lista de Facturas</h1>
    <a href="{{ route('facturas.create') }}" class="btn btn-primary mb-3">Agregar Nueva Factura</a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Número de Factura</th>
                <th>Monto Total</th>
                <th>Monto del Impuesto</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($facturas as $factura)
                <tr>
                    <td>{{ $factura->id_factura }}</td>
                    <td>{{ $factura->numero_factura }}</td>
                    <td>{{ $factura->monto_total }}</td>
                    <td>{{ $factura->monto_impuesto }}</td>
                    <td>
                        <a href="{{ route('facturas.edit', $factura->id_factura) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('facturas.destroy', $factura->id_factura) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar esta factura?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
