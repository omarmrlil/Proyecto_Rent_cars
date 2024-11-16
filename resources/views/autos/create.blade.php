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
<div>
    <label for="transmision">Transmisión:</label>
    <select name="transmision" id="transmision" required>
        <option value="manual">Manual</option>
        <option value="automatica">Automática</option>
    </select>
</div>

<div>
    <label for="consumo_combustible">Consumo de Combustible (L/100km):</label>
    <input type="number" name="consumo_combustible" id="consumo_combustible" required step="0.01">
</div>

<div>
    <label for="capacidad_tanque">Capacidad del Tanque (L):</label>
    <input type="number" name="capacidad_tanque" id="capacidad_tanque" required step="0.01">
</div>

<div>
    <label for="numero_asientos">Número de Asientos:</label>
    <input type="number" name="numero_asientos" id="numero_asientos" required>
</div>

<div>
    <label for="numero_puertas">Número de Puertas:</label>
    <input type="number" name="numero_puertas" id="numero_puertas" required>
</div>

<div>
    <label for="color">Color:</label>
    <input type="text" name="color" id="color" required>
</div>

<div>
    <label for="tipo_combustible">Tipo de Combustible:</label>
    <select name="tipo_combustible" id="tipo_combustible" required>
        <option value="gasolina">Gasolina</option>
        <option value="diesel">Diésel</option>
        <option value="electrico">Eléctrico</option>
        <option value="hibrido">Híbrido</option>
    </select>
</div>

<div>
    <label for="capacidad_maletero">Capacidad del Maletero (L):</label>
    <input type="number" name="capacidad_maletero" id="capacidad_maletero">
</div>

<div>
    <label for="aire_acondicionado">Aire Acondicionado:</label>
    <select name="aire_acondicionado" id="aire_acondicionado" required>
        <option value="sí">Sí</option>
        <option value="no">No</option>
    </select>
</div>

<div>
    <label for="gps">GPS:</label>
    <select name="gps" id="gps" required>
        <option value="sí">Sí</option>
        <option value="no">No</option>
    </select>
</div>

<div>
    <label for="velocidad_maxima">Velocidad Máxima (km/h):</label>
    <input type="number" name="velocidad_maxima" id="velocidad_maxima" required>
</div>

<div>
    <label for="peso">Peso (kg):</label>
    <input type="number" name="peso" id="peso" required step="0.01">
</div>

<div>
    <label for="fecha_compra">Fecha de Compra:</label>
    <input type="date" name="fecha_compra" id="fecha_compra" required>
</div>

<div>
    <label for="condicion">Condición:</label>
    <select name="condicion" id="condicion" required>
        <option value="nuevo">Nuevo</option>
        <option value="usado">Usado</option>
    </select>
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
