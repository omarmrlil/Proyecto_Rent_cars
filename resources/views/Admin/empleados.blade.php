@extends('Admin.layouts.admin')

@section('content')

<a href="{{ route('empleados.create') }}" class="btn btn-success mb-3">Añadir Empleado</a>
<div class="container-fluid">
    <h2>Gestión de Empleados</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Cargo</th>
                <th>Salario</th>
                <th>Fecha de Contratación</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($empleados as $empleado)
                <tr>
                    <td>{{ $empleado->id_empleado }}</td>
                    <td>{{ $empleado->usuario->nombre }}</td>
                    <td>{{ $empleado->cargo }}</td>
                    <td>{{ $empleado->salario }} RD$</td>
                    <td>{{ $empleado->fecha_contratacion }}</td>
                    <td>
                        <!-- Opciones para editar o eliminar empleado -->
                        <a href="{{ route('empleados.edit', $empleado->id_empleado) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('empleados.destroy', $empleado->id_empleado) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
