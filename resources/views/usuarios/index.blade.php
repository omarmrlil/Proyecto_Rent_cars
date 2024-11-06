@extends('layout.app')

@section('title', 'Lista de Usuarios')

@section('content')
    <h1 class="mt-4">Usuarios</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Rol</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($usuarios as $usuario)
                <tr>
                    <td>{{ $usuario->id_usuario }}</td>
                    <td>{{ $usuario->nombre }}</td>
                    <td>{{ $usuario->email }}</td>
                    <td>{{ $usuario->rol }}</td>
                    <td>{{ $usuario->estado }}</td>
                    <td>
                        <a href="{{ route('usuarios.edit', $usuario->id_usuario) }}" class="btn btn-primary">Editar</a>
                        <form action="{{ route('usuarios.destroy', $usuario->id_usuario) }}" method="POST" style="display:inline-block;">
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
