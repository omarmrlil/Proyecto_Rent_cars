@extends('admin.layouts.admin')

@section('content')
    <div class="container">
        <h1>Gestión de Empleados</h1>

        <!-- Botón para agregar un nuevo empleado -->
        <a href="{{ route('admin.empleados.create') }}" class="btn btn-success mb-4">Agregar Nuevo Empleado</a>

        <!-- Tabla de empleados -->
        <div class="table-responsive mt-4">
            <h5>Empleados Registrados</h5>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Cargo</th>
                        <th>Fecha de Contratación</th>
                        <th>Salario</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($empleados as $empleado)
                    <tr>
                        <td>{{ $empleado->usuario->nombre }}</td>
                        <td>{{ $empleado->usuario->email }}</td>
                        <td>{{ $empleado->cargo }}</td>
                        <td>{{ $empleado->fecha_contratacion }}</td>
                        <td>{{ $empleado->salario }}</td>
                        <td>
                            <a href="{{ route('admin.empleados.edit', $empleado->id_empleado) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('admin.empleados.delete', $empleado->id_empleado) }}" method="POST" style="display:inline;">
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
    </div>
@endsection
