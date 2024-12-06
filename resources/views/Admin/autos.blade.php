@extends('admin.layouts.admin')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Registrar Auto</h1>

    <form action="{{ route('admin.autos.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Fila de Marca y Tipo -->
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="id_marca" class="form-label">Marca <i class="fas fa-car-side"></i></label>
                <select name="id_marca" id="id_marca" class="form-select" required>
                    @foreach($marcas as $marca)
                        <option value="{{ $marca->id_marca }}">{{ $marca->nombre_marca }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label for="id_tipo" class="form-label">Tipo <i class="fas fa-cogs"></i></label>
                <select name="id_tipo" id="id_tipo" class="form-select" required>
                    @foreach($tipos as $tipo)
                        <option value="{{ $tipo->id_tipo }}">{{ $tipo->tipo }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Fila de Modelo y Año -->
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="modelo" class="form-label">Modelo <i class="fas fa-car"></i></label>
                <input type="text" name="modelo" id="modelo" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label for="año" class="form-label">Año <i class="fas fa-calendar-alt"></i></label>
                <input type="number" name="año" id="año" class="form-control" required>
            </div>
        </div>

        <!-- Fila de Matrícula y Foto -->
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="matricula" class="form-label">Matrícula <i class="fas fa-id-card"></i></label>
                <input type="text" name="matricula" id="matricula" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label for="foto_auto" class="form-label">Foto del Auto <i class="fas fa-camera"></i></label>
                <input type="file" name="foto_auto" id="foto_auto" class="form-control">
            </div>
        </div>

        <!-- Fila de Precio y Kilometraje -->
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="precio_por_dia" class="form-label">Precio por Día <i class="fas fa-dollar-sign"></i></label>
                <input type="number" name="precio_por_dia" id="precio_por_dia" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label for="kilometraje" class="form-label">Kilometraje <i class="fas fa-tachometer-alt"></i></label>
                <input type="number" name="kilometraje" id="kilometraje" class="form-control" required>
            </div>
        </div>

        <!-- Fila de Consumo y Capacidad -->
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="consumo_combustible" class="form-label">Consumo de Combustible (L/100km) <i class="fas fa-fuel-pump"></i></label>
                <input type="number" name="consumo_combustible" id="consumo_combustible" class="form-control" required step="0.01">
            </div>
            <div class="col-md-6">
                <label for="capacidad_tanque" class="form-label">Capacidad del Tanque (L) <i class="fas fa-tint"></i></label>
                <input type="number" name="capacidad_tanque" id="capacidad_tanque" class="form-control" required step="0.01">
            </div>
        </div>

        <!-- Fila de Número de Asientos y Puertas -->
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="numero_asientos" class="form-label">Número de Asientos <i class="fas fa-chair"></i></label>
                <input type="number" name="numero_asientos" id="numero_asientos" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label for="numero_puertas" class="form-label">Número de Puertas <i class="fas fa-door-open"></i></label>
                <input type="number" name="numero_puertas" id="numero_puertas" class="form-control" required>
            </div>
        </div>

        <!-- Fila de Color y Combustible -->
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="color" class="form-label">Color <i class="fas fa-paint-brush"></i></label>
                <input type="text" name="color" id="color" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label for="tipo_combustible" class="form-label">Tipo de Combustible <i class="fas fa-gas-pump"></i></label>
                <select name="tipo_combustible" id="tipo_combustible" class="form-select" required>
                    <option value="gasolina">Gasolina</option>
                    <option value="diesel">Diésel</option>
                    <option value="electrico">Eléctrico</option>
                    <option value="hibrido">Híbrido</option>
                </select>
            </div>
        </div>

        <!-- Fila de Aire Acondicionado y GPS -->
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="aire_acondicionado" class="form-label">Aire Acondicionado <i class="fas fa-snowflake"></i></label>
                <select name="aire_acondicionado" id="aire_acondicionado" class="form-select" required>
                    <option value="sí">Sí</option>
                    <option value="no">No</option>
                </select>
            </div>
            <div class="col-md-6">
                <label for="gps" class="form-label">GPS <i class="fas fa-map-marker-alt"></i></label>
                <select name="gps" id="gps" class="form-select" required>
                    <option value="sí">Sí</option>
                    <option value="no">No</option>
                </select>
            </div>
        </div>

        <!-- Fila de Velocidad Máxima y Fecha de Compra -->
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="velocidad_maxima" class="form-label">Velocidad Máxima (km/h) <i class="fas fa-tachometer-alt"></i></label>
                <input type="number" name="velocidad_maxima" id="velocidad_maxima" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label for="fecha_compra" class="form-label">Fecha de Compra <i class="fas fa-calendar-check"></i></label>
                <input type="date" name="fecha_compra" id="fecha_compra" class="form-control" required>
            </div>
        </div>

        <!-- Fila de Condición -->
        <div class="row mb-3">
            <div class="col-md-12">
                <label for="condicion" class="form-label">Condición <i class="fas fa-cogs"></i></label>
                <select name="condicion" id="condicion" class="form-select" required>
                    <option value="nuevo">Nuevo</option>
                    <option value="usado">Usado</option>
                </select>
            </div>
        </div>

        <button type="submit" class="btn btn-primary btn-lg w-100">Registrar Auto <i class="fas fa-save"></i></button>
    </form>
</div>
@endsection
