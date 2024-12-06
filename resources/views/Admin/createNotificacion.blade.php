@extends('Admin.layouts.admin')

@section('content')
<div class="container-fluid">
    <h2>Crear Nueva Notificación</h2>

    <!-- Mensaje de error -->
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.storeNotificacion') }}" method="POST">
        @csrf
        <div class="form-group mb-3">
            <label for="id_usuario">Usuario:</label>
            <select name="id_usuario" id="id_usuario" class="form-control" required>
                <option value="">Seleccione un usuario</option>
                @foreach ($usuarios as $usuario)
                    <option value="{{ $usuario->id_usuario }}">{{ $usuario->nombre }} ({{ $usuario->rol }})</option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="tipo_notificacion">Tipo de Notificación:</label>
            <select name="tipo_notificacion" id="tipo_notificacion" class="form-control" required>
                <option value="mantenimiento">Mantenimiento</option>
                <option value="devolucion">Devolución</option>
                <option value="pago">Pago</option>
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="mensaje">Mensaje:</label>
            <textarea name="mensaje" id="mensaje" class="form-control" rows="4" required></textarea>
        </div>

        <button type="submit" class="btn btn-success">Enviar Notificación</button>
    </form>
</div>
@endsection
