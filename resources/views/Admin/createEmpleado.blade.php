@extends('admin.layouts.admin')

@section('content')
    <div class="container">
        <h1>Agregar Nuevo Empleado</h1>

        <form action="{{ route('admin.empleados.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre') }}" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
            </div>

            <!-- El campo de contraseña ha sido eliminado -->
            <!-- <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div> -->

            <div class="mb-3">
                <label for="cargo" class="form-label">Cargo</label>
                <input type="text" name="cargo" id="cargo" class="form-control" value="{{ old('cargo') }}" required>
            </div>

            <div class="mb-3">
                <label for="fecha_contratacion" class="form-label">Fecha de Contratación</label>
                <input type="date" name="fecha_contratacion" id="fecha_contratacion" class="form-control" value="{{ old('fecha_contratacion') }}" required>
            </div>

            <div class="mb-3">
                <label for="salario" class="form-label">Salario</label>
                <input type="number" name="salario" id="salario" class="form-control" value="{{ old('salario') }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Agregar Empleado</button>
        </form>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
@endsection
