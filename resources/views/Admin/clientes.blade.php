@extends('Admin.layouts.admin')

@section('content')
<div class="container-fluid">
    <h2>Gestión de Clientes</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Email</th>
                <th>Teléfono</th>
                <th>Dirección</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($clientes as $cliente)
            <tr>
                <td>{{ $cliente->usuario->nombre }}</td>
                <td>{{ $cliente->usuario->email }}</td>
                <td>{{ $cliente->telefono }}</td>
                <td>{{ $cliente->direccion }}</td>
                <td>
                    <a href="{{ route('admin.clientes.edit', $cliente->id_cliente) }}" class="btn btn-warning">Editar</a>
                    <form action="{{ route('admin.clientes.delete', $cliente->id_cliente) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
