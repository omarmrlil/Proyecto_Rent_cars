@extends('layout.app')

@section('content')
<div class="container">
    <h1>Registrar Auto</h1>

    <form action="{{ route('autos.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Campos de autos -->
        <label for="id_marca">Marca:</label>
        <select name="id_marca" id="id_marca" required>
            @foreach($marcas as $marca)
                <option value="{{ $marca->id_marca }}">{{ $marca->nombre_marca }}</option>
            @endforeach
        </select>

        <label for="id_tipo">Tipo:</label>
        <select name="id_tipo" id="id_tipo" required>
            @foreach($tipos as $tipo)
                <option value="{{ $tipo->id_tipo }}">{{ $tipo->tipo }}</option>
            @endforeach
        </select>

        <label for="modelo">Modelo:</label>
        <input type="text" name="modelo" id="modelo" required>

        <label for="año">Año:</label>
        <input type="number" name="año" id="año" required>

        <label for="matricula">Matrícula:</label>
        <input type="text" name="matricula" id="matricula" required>

        <label for="precio_por_dia">Precio por Día:</label>
        <input type="number" name="precio_por_dia" id="precio_por_dia" required>

        <label for="foto_auto">Foto del Auto:</label>
        <input type="file" name="foto_auto" id="foto_auto">

        <label for="kilometraje">Kilometraje:</label>
        <input type="number" name="kilometraje" id="kilometraje" required>

        <!-- Campos de detalles del auto -->
        <!-- Campos de detalles del auto -->
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

        <!-- (Los campos de detalles siguen el mismo formato) -->

        <button type="submit">Registrar Auto</button>
    </form>
</div>
@endsection
