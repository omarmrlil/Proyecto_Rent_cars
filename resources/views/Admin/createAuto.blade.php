@extends('admin.layouts.admin')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Registrar Auto</h1>

    <form action="{{ route('autos.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Campos de autos -->
        <div class="form-group">
            <label for="id_marca">Marca:</label>
            <select name="id_marca" id="id_marca" class="form-control" required>
                @foreach($marcas as $marca)
                    <option value="{{ $marca->id_marca }}">{{ $marca->nombre_marca }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="id_tipo">Tipo:</label>
            <select name="id_tipo" id="id_tipo" class="form-control" required>
                @foreach($tipos as $tipo)
                    <option value="{{ $tipo->id_tipo }}">{{ $tipo->tipo }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="modelo">Modelo:</label>
            <input type="text" name="modelo" id="modelo" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="año">Año:</label>
            <input type="number" name="año" id="año" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="matricula">Matrícula:</label>
            <input type="text" name="matricula" id="matricula" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="precio_por_dia">Precio por Día:</label>
            <input type="number" name="precio_por_dia" id="precio_por_dia" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="foto_auto">Foto del Auto:</label>
            <input type="file" name="foto_auto" id="foto_auto" class="form-control">
        </div>

        <div class="form-group">
            <label for="kilometraje">Kilometraje:</label>
            <input type="number" name="kilometraje" id="kilometraje" class="form-control" required>
        </div>

        <!-- Campos de detalles del auto -->
        <div class="form-group">
            <label for="transmision">Transmisión:</label>
            <select name="transmision" id="transmision" class="form-control" required>
                <option value="manual">Manual</option>
                <option value="automatica">Automática</option>
            </select>
        </div>

        <div class="form-group">
            <label for="consumo_combustible">Consumo de Combustible (L/100km):</label>
            <input type="number" name="consumo_combustible" id="consumo_combustible" class="form-control" required step="0.01">
        </div>

        <div class="form-group">
            <label for="capacidad_tanque">Capacidad del Tanque (L):</label>
            <input type="number" name="capacidad_tanque" id="capacidad_tanque" class="form-control" required step="0.01">
        </div>

        <div class="form-group">
            <label for="numero_asientos">Número de Asientos:</label>
            <input type="number" name="numero_asientos" id="numero_asientos" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="numero_puertas">Número de Puertas:</label>
            <input type="number" name="numero_puertas" id="numero_puertas" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="color">Color:</label>
            <input type="text" name="color" id="color" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="tipo_combustible">Tipo de Combustible:</label>
            <select name="tipo_combustible" id="tipo_combustible" class="form-control" required>
                <option value="gasolina">Gasolina</option>
                <option value="diesel">Diésel</option>
                <option value="electrico">Eléctrico</option>
                <option value="hibrido">Híbrido</option>
            </select>
        </div>

        <div class="form-group">
            <label for="capacidad_maletero">Capacidad del Maletero (L):</label>
            <input type="number" name="capacidad_maletero" id="capacidad_maletero" class="form-control">
        </div>

        <div class="form-group">
            <label for="aire_acondicionado">Aire Acondicionado:</label>
            <select name="aire_acondicionado" id="aire_acondicionado" class="form-control" required>
                <option value="sí">Sí</option>
                <option value="no">No</option>
            </select>
        </div>

        <div class="form-group">
            <label for="gps">GPS:</label>
            <select name="gps" id="gps" class="form-control" required>
                <option value="sí">Sí</option>
                <option value="no">No</option>
            </select>
        </div>

        <div class="form-group">
            <label for="velocidad_maxima">Velocidad Máxima (km/h):</label>
            <input type="number" name="velocidad_maxima" id="velocidad_maxima" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="peso">Peso (kg):</label>
            <input type="number" name="peso" id="peso" class="form-control" required step="0.01">
        </div>

        <div class="form-group">
            <label for="fecha_compra">Fecha de Compra:</label>
            <input type="date" name="fecha_compra" id="fecha_compra" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="condicion">Condición:</label>
            <select name="condicion" id="condicion" class="form-control" required>
                <option value="nuevo">Nuevo</option>
                <option value="usado">Usado</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary btn-lg w-100 mt-4">Registrar Auto</button>
    </form>
</div>
@endsection

@section('styles')
    <style>
        .form-group {
            margin-bottom: 15px;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        .btn {
            width: 100%;
            padding: 15px;
            background-color: #007bff;
            color: white;
            border-radius: 5px;
            border: none;
        }

        .btn:hover {
            background-color: #0056b3;
        }
    </style>
@endsection
