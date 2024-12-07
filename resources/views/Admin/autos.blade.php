@extends('admin.layouts.admin')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4">Listado de Autos</h1>

        <!-- Mensaje de éxito -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('admin.autos.create') }}" class="btn btn-primary mb-3">Registrar Nuevo Auto</a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Año</th>
                    <th>Matrícula</th>
                    <th>Precio por Día</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($autos as $auto)
                    <tr>
                        <td>{{ $auto->marca->nombre_marca }}</td>
                        <td>{{ $auto->modelo }}</td>
                        <td>{{ $auto->año }}</td>
                        <td>{{ $auto->matricula }}</td>
                        <td>${{ $auto->precio_por_dia }}</td>
                        <td>{{ $auto->estado }}</td>
                        <td>
                            <a href="{{ route('admin.autos.edit', $auto->id_auto) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('admin.autos.delete', $auto->id_auto) }}" method="POST" style="display:inline;">
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
