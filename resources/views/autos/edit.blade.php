@extends('layout.app')

@section('title', 'Editar Auto')

@section('content')
    <h1 class="mt-4">Editar Auto</h1>
    <form action="{{ route('autos.update', $auto->id_auto) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Información básica del auto -->
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

        <!-- Detalles del auto -->
        <h3>Detalles del Auto</h3>

        <div class="mb-3">
            <label for="transmision" class="form-label">Transmisión</label>
            <select name="transmision" class="form-control" id="transmision" required>
                <option value="manual" {{ $auto->detalles->transmision == 'manual' ? 'selected' : '' }}>Manual</option>
                <option value="automatica" {{ $auto->detalles->transmision == 'automatica' ? 'selected' : '' }}>Automática</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="consumo_combustible" class="form-label">Consumo de Combustible (L/100 km)</label>
            <input type="number" name="consumo_combustible" class="form-control" id="consumo_combustible" value="{{ old('consumo_combustible', $auto->detalles->consumo_combustible) }}" required>
        </div>

        <div class="mb-3">
            <label for="capacidad_tanque" class="form-label">Capacidad del Tanque (L)</label>
            <input type="number" name="capacidad_tanque" class="form-control" id="capacidad_tanque" value="{{ old('capacidad_tanque', $auto->detalles->capacidad_tanque) }}" required>
        </div>

        <div class="mb-3">
            <label for="numero_asientos" class="form-label">Número de Asientos</label>
            <input type="number" name="numero_asientos" class="form-control" id="numero_asientos" value="{{ old('numero_asientos', $auto->detalles->numero_asientos) }}" required>
        </div>

        <div class="mb-3">
            <label for="numero_puertas" class="form-label">Número de Puertas</label>
            <input type="number" name="numero_puertas" class="form-control" id="numero_puertas" value="{{ old('numero_puertas', $auto->detalles->numero_puertas) }}" required>
        </div>

        <div class="mb-3">
            <label for="color" class="form-label">Color</label>
            <input type="text" name="color" class="form-control" id="color" value="{{ old('color', $auto->detalles->color) }}" required>
        </div>

        <!-- Agrega más campos de detalles aquí según sea necesario -->

        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
@endsection
