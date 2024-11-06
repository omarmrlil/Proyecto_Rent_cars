@extends('layout.app')

@section('title', 'Lista de Clientes')

@section('content')
<div class="container">
        <h1>Bienvenido a A&J Rent Cars</h1>
        <p>¡Esperamos que disfrutes de nuestros servicios!</p> <br><br>

    <h1 class="mt-4">Lista de Clientes</h1><br><br>

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
    <a href="{{ route('clientes.create') }}" class="btn btn-success mb-3">Registrar Nuevo Cliente</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Documento</th>
                <th>Licencia</th>
                <th>Teléfono</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($clientes as $cliente)
                <tr>
                    <td>{{ $cliente->id_cliente }}</td>
                    <td>{{ $cliente->usuario->nombre }}</td>
                    <td>{{ $cliente->usuario->email }}</td>
                    <td>{{ $cliente->documento_identidad }}</td>
                    <td>{{ $cliente->licencia_conducir }}</td>
                    <td>{{ $cliente->telefono }}</td>
                    <td>
                        <a href="{{ route('clientes.edit', $cliente->id_cliente) }}" class="btn btn-primary">Editar</a>
                        <form action="{{ route('clientes.destroy', $cliente->id_cliente) }}" method="POST" style="display:inline-block;">
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
