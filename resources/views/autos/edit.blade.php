@extends('layout.app')

@section('title', 'Editar Auto')

@section('content')
    <h1 class="mt-4">Editar Auto</h1>
    <form action="{{ route('autos.update', $auto->id_auto) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="marca" class="form-label">Marca</label>
            <select name="id_marca" class="form-control" id="marca" required>
                @foreach ($marcas as $marca)
                    <option value="{{ $marca->id_marca }}" {{ $auto->id_marca == $marca->id_marca ? 'selected' : '' }}>{{ $marca->nombre_marca }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="tipo" class="form-label">Tipo</label>
            <select name="id_tipo" class="form-control" id="tipo" required>
                @foreach ($tipos as $tipo)
                    <option value="{{ $tipo->id_tipo }}" {{ $auto->id_tipo == $tipo->id_tipo ? 'selected' : '' }}>{{ $tipo->tipo }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="modelo" class="form-label">Modelo</label>
            <input type="text" name="modelo" class="form-control" id="modelo" value="{{ old('modelo', $auto->modelo) }}" required>
        </div>
        <div class="mb-3">
            <label for="año" class="form-label">Año</label>
            <input type="number" name="año" class="form-control" id="año" value="{{ old('año', $auto->año) }}" required>
        </div>
        <div class="mb-3">
            <label for="matricula" class="form-label">Matrícula</label>
            <input type="text" name="matricula" class="form-control" id="matricula" value="{{ old('matricula', $auto->matricula) }}" required>
        </div>
        <div class="mb-3">
            <label for="precio_por_dia" class="form-label">Precio por Día</label>
            <input type="number" name="precio_por_dia" class="form-control" id="precio_por_dia" value="{{ old('precio_por_dia', $auto->precio_por_dia) }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
@endsection
