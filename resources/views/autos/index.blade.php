@extends('layout.app')

@section('title', 'Lista de Autos')

@section('content')
    <h1 class="mt-4">Lista de Autos</h1>
    <a href="{{ route('autos.create') }}" class="btn btn-success mb-3">Registrar Nuevo Auto</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Marca</th>
                <th>Tipo</th>
                <th>Modelo</th>
                <th>Año</th>
                <th>Matrícula</th>
                <th>Precio por Día</th>
                <th>Foto</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($autos as $auto)
                <tr>
                    <td>{{ $auto->id_auto }}</td>
                    <td>{{ $auto->marca->nombre_marca }}</td>
                    <td>{{ $auto->tipo->tipo }}</td>
                    <td>{{ $auto->modelo }}</td>
                    <td>{{ $auto->año }}</td>
                    <td>{{ $auto->matricula }}</td>
                    <td>{{ $auto->precio_por_dia }} USD</td>
                    <td>
                        @if ($auto->foto_auto)
                            <img src="{{ asset('storage/' . $auto->foto_auto) }}" alt="Foto de {{ $auto->modelo }}" width="100">
                        @else
                            Sin imagen
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('autos.edit', $auto->id_auto) }}" class="btn btn-primary">Editar</a>
                        <form action="{{ route('autos.destroy', $auto->id_auto) }}" method="POST" style="display:inline-block;">
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
