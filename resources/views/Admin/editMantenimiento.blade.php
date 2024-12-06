@extends('Admin.layouts.admin')

@section('content')
<div class="container-fluid">
    <h2>Editar Mantenimiento</h2>

    <form action="{{ route('admin.updateMantenimiento', $mantenimiento->id_mantenimiento) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="id_auto" class="form-label">Auto</label>
            <select name="id_auto" id="id_auto" class="form-control" required>
                @foreach($autos as $auto)
                    <option value="{{ $auto->id_auto }}" {{ $auto->id_auto == $mantenimiento->id_auto ? 'selected' : '' }}>{{ $auto->modelo }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="fecha_mantenimiento" class="form-label">Fecha de Mantenimiento</label>
            <input type="date" name="fecha_mantenimiento" id="fecha_mantenimiento" class="form-control" value="{{ $mantenimiento->fecha_mantenimiento }}" required>
        </div>

        <div class="mb-3">
            <label for="tipo_mantenimiento" class="form-label">Tipo de Mantenimiento</label>
            <select name="tipo_mantenimiento" id="tipo_mantenimiento" class="form-control" required>
                <option value="preventivo" {{ $mantenimiento->tipo_mantenimiento == 'preventivo' ? 'selected' : '' }}>Preventivo</option>
                <option value="correctivo" {{ $mantenimiento->tipo_mantenimiento == 'correctivo' ? 'selected' : '' }}>Correctivo</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea name="descripcion" id="descripcion" class="form-control" required>{{ $mantenimiento->descripcion }}</textarea>
        </div>

        <div class="mb-3">
            <label for="costo" class="form-label">Costo</label>
            <input type="number" name="costo" id="costo" class="form-control" value="{{ $mantenimiento->costo }}" required min="0">
        </div>

        <div class="mb-3">
            <label for="kilometraje" class="form-label">Kilometraje</label>
            <input type="number" name="kilometraje" id="kilometraje" class="form-control" value="{{ $mantenimiento->kilometraje }}" required min="0">
        </div>

        <div class="mb-3">
            <label for="realizado_por" class="form-label">Empleado Asignado</label>
            <select name="realizado_por" id="realizado_por" class="form-control" required>
                @foreach($empleados as $empleado)
                    <option value="{{ $empleado->id_empleado }}" {{ $empleado->id_empleado == $mantenimiento->realizado_por ? 'selected' : '' }}>{{ $empleado->usuario->nombre }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar Mantenimiento</button>
    </form>
</div>
@endsection
