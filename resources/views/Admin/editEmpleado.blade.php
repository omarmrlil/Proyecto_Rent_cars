@extends('admin.layouts.admin')

@section('content')
    <div class="container">
        <h1>{{ isset($empleado) ? 'Editar Empleado' : 'Agregar Nuevo Empleado' }}</h1>

        <form action="{{ isset($empleado) ? route('admin.empleados.update', $empleado->id_empleado) : route('admin.empleados.store') }}" method="POST">
            @csrf
            @isset($empleado)
                @method('PUT')
            @endisset

            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre', $empleado->usuario->nombre ?? '') }}" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $empleado->usuario->email ?? '') }}" required>
            </div>

            <div class="mb-3">
                <label for="cargo" class="form-label">Cargo</label>
                <input type="text" name="cargo" id="cargo" class="form-control" value="{{ old('cargo', $empleado->cargo ?? '') }}" required>
            </div>

            <div class="mb-3">
                <label for="fecha_contratacion" class="form-label">Fecha de Contratación</label>
                <input type="date" name="fecha_contratacion" id="fecha_contratacion" class="form-control" value="{{ old('fecha_contratacion', $empleado->fecha_contratacion ?? '') }}" required>
            </div>

            <div class="mb-3">
                <label for="salario" class="form-label">Salario</label>
                <input type="number" name="salario" id="salario" class="form-control" value="{{ old('salario', $empleado->salario ?? '') }}" required>
            </div>

            <button type="submit" class="btn btn-primary">{{ isset($empleado) ? 'Actualizar Empleado' : 'Agregar Empleado' }}</button>
        </form>
    </div>
@endsection
