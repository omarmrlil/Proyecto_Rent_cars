@extends('layout.app')

@section('content')
<div class="container">
    <h1>Lista de Empleados</h1><br><br>
    <li class="nav-item">
<a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Cerrar Sesión</a>
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>
</li>
<br>
<br>
@if (session('usuario'))
    <p>Sesión iniciada para: {{ session('usuario')->nombre }} - Rol: {{ session('usuario')->rol }}</p>
@endif
    <a href="{{ route('empleados.create') }}" class="btn btn-primary mb-3">Agregar Nuevo Empleado</a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Cargo</th>
                <th>Fecha de Contratación</th>
                <th>Salario</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($empleados as $empleado)
                <tr>
                    <td>{{ $empleado->id_empleado }}</td>
                    <td>{{ $empleado->usuario->nombre }}</td>
                    <td>{{ $empleado->cargo }}</td>
                    <td>{{ $empleado->fecha_contratacion }}</td>
                    <td>{{ $empleado->salario }}</td>
                    <td>
                        <a href="{{ route('empleados.edit', $empleado->id_empleado) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('empleados.destroy', $empleado->id_empleado) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar este empleado?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
