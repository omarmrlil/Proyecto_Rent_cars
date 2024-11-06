@extends('layout.app')

@section('content')
    <div class="container">
        <h1>Lista de Mantenimientos</h1>
        <a href="{{ route('mantenimientos.create') }}" class="btn btn-primary mb-3">Registrar Mantenimiento</a>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Auto</th>
                    <th>Fecha</th>
                    <th>Tipo</th>
                    <th>Kilometraje</th>
                    <th>Costo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($mantenimientos as $mantenimiento)
                    <tr>
                        <td>{{ $mantenimiento->id_mantenimiento }}</td>
                        <td>{{ $mantenimiento->auto->modelo }} ({{ $mantenimiento->auto->matricula }})</td>
                        <td>{{ $mantenimiento->fecha_mantenimiento }}</td>
                        <td>{{ ucfirst($mantenimiento->tipo_mantenimiento) }}</td>
                        <td>{{ $mantenimiento->kilometraje }} km</td>
                        <td>${{ number_format($mantenimiento->costo, 2) }}</td>
                        <td>
                            <a href="{{ route('mantenimientos.show', $mantenimiento->id_mantenimiento) }}" class="btn btn-info btn-sm">Ver</a>
                            <a href="{{ route('mantenimientos.edit', $mantenimiento->id_mantenimiento) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('mantenimientos.destroy', $mantenimiento->id_mantenimiento) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Está seguro de eliminar este mantenimiento?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
