@extends('layout.app')

@section('content')
<div class="container">
    <h1>Crear Empleado</h1>
    <form action="{{ route('empleados.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="id_usuario" class="form-label">Usuario</label>
            <select name="id_usuario" id="id_usuario" class="form-control">
                @foreach($usuarios as $usuario)
                    <option value="{{ $usuario->id_usuario }}">{{ $usuario->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="cargo" class="form-label">Cargo</label>
            <input type="text" class="form-control" id="cargo" name="cargo" required>
        </div>
        <div class="mb-3">
            <label for="fecha_contratacion" class="form-label">Fecha de Contratación</label>
            <input type="date" class="form-control" id="fecha_contratacion" name="fecha_contratacion" required>
        </div>
        <div class="mb-3">
            <label for="salario" class="form-label">Salario</label>
            <input type="number" step="0.01" class="form-control" id="salario" name="salario" required>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>
@endsection
