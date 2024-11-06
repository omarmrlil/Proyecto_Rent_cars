@extends('layout.app')

@section('title', 'Registrar Auto')

@section('content')
    <h1 class="mt-4">Registrar Auto</h1>
    <form action="{{ route('autos.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="marca" class="form-label">Marca</label>
            <select name="id_marca" class="form-control" id="marca" required>
                @foreach ($marcas as $marca)
                    <option value="{{ $marca->id_marca }}">{{ $marca->nombre_marca }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="tipo" class="form-label">Tipo</label>
            <select name="id_tipo" class="form-control" id="tipo" required>
                @foreach ($tipos as $tipo)
                    <option value="{{ $tipo->id_tipo }}">{{ $tipo->tipo }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="modelo" class="form-label">Modelo</label>
            <input type="text" name="modelo" class="form-control" id="modelo" value="{{ old('modelo') }}" required>
        </div>
        <div class="mb-3">
            <label for="año" class="form-label">Año</label>
            <input type="number" name="año" class="form-control" id="año" value="{{ old('año') }}" required>
        </div>
        <div class="mb-3">
            <label for="matricula" class="form-label">Matrícula</label>
            <input type="text" name="matricula" class="form-control" id="matricula" value="{{ old('matricula') }}" required>
        </div>
        <div class="mb-3">
    <label for="kilometraje" class="form-label">Kilometraje</label>
    <input type="number" name="kilometraje" class="form-control" id="kilometraje" value="{{ old('kilometraje', 0) }}" required>
    </div>

        <div class="mb-3">
            <label for="foto_auto" class="form-label">Foto del Auto</label>
            <input type="file" name="foto_auto" class="form-control" id="foto_auto">
        </div>
        <div class="mb-3">
            <label for="precio_por_dia" class="form-label">Precio por Día</label>
            <input type="number" name="precio_por_dia" class="form-control" id="precio_por_dia" value="{{ old('precio_por_dia') }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Registrar</button>
    </form>
@endsection
