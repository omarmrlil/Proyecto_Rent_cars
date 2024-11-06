@extends('layout.app')

@section('title', 'Lista de Pagos')

@section('content')
    <h1 class="mt-4">Lista de Pagos</h1>
    <a href="{{ route('pagos.create') }}" class="btn btn-success mb-3">Registrar Nuevo Pago</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Alquiler</th>
                <th>Monto</th>
                <th>Fecha de Pago</th>
                <th>Método de Pago</th>
                <th>Referencia</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pagos as $pago)
                <tr>
                    <td>{{ $pago->id_pago }}</td>
                    <td>{{ $pago->alquiler->id_alquiler }}</td>
                    <td>{{ $pago->monto }} USD</td>
                    <td>{{ $pago->fecha_pago }}</td>
                    <td>{{ $pago->metodo_pago }}</td>
                    <td>{{ $pago->referencia_transaccion }}</td>
                    <td>
                        <a href="{{ route('pagos.edit', $pago->id_pago) }}" class="btn btn-primary">Editar</a>
                        <form action="{{ route('pagos.destroy', $pago->id_pago) }}" method="POST" style="display:inline-block;">
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
