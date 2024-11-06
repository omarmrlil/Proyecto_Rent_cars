@extends('layout.app')

@section('content')
<div class="container">
    <h1>Editar Empleado</h1>
    <form action="{{ route('empleados.update', $empleado->id_empleado) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="id_usuario" class="form-label">Usuario</label>
            <select name="id_usuario" id="id_usuario" class="form-control">
                @foreach($usuarios as $usuario)
                    <option value="{{ $usuario->id_usuario }}" {{ $empleado->id_usuario == $usuario->id_usuario ? 'selected' : '' }}>
                        {{ $usuario->nombre }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="cargo" class="form-label">Cargo</label>
            <input type="text" class="form-control" id="cargo" name="cargo" value="{{ $empleado->cargo }}" required>
        </div>
        <div class="mb-3">
            <label for="fecha_contratacion" class="form-label">Fecha de Contratación</label>
            <input type="date" class="form-control" id="fecha_contratacion" name="fecha_contratacion" value="{{ $empleado->fecha_contratacion }}" required>
        </div>
        <div class="mb-3">
            <label for="salario" class="form-label">Salario</label>
            <input type="number" step="0.01" class="form-control" id="salario" name="salario" value="{{ $empleado->salario }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>
@endsection
