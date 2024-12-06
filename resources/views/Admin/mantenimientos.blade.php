@extends('Admin.layouts.admin')

@section('content')
<div class="container-fluid">
    <h2>Gestión de Mantenimientos</h2>

    <div class="table-responsive mt-4">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Auto</th>
                    <th>Fecha de Mantenimiento</th>
                    <th>Tipo de Mantenimiento</th>
                    <th>Descripción</th>
                    <th>Empleado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($mantenimientos as $mantenimiento)
                <tr>
                    <td>{{ $mantenimiento->id_mantenimiento }}</td>
                    <td>{{ $mantenimiento->auto->modelo }}</td>
                    <td>{{ $mantenimiento->fecha_mantenimiento }}</td>
                    <td>{{ $mantenimiento->tipo_mantenimiento }}</td>
                    <td>{{ $mantenimiento->descripcion }}</td>
                    <td>{{ $mantenimiento->empleado->usuario->nombre }}</td>
                    <td>
                        <a href="{{ route('admin.editMantenimiento', $mantenimiento->id_mantenimiento) }}" class="btn btn-warning btn-sm">Editar</a>
                        <a href="{{ route('admin.deleteMantenimiento', $mantenimiento->id_mantenimiento) }}" class="btn btn-danger btn-sm">Eliminar</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <a href="{{ route('admin.createMantenimiento') }}" class="btn btn-primary">Registrar Nuevo Mantenimiento</a>
</div>
@endsection
