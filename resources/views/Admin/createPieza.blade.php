@extends('Admin.layouts.admin')

@section('content')
<div class="container-fluid">
    <h2>Agregar Nueva Pieza al Inventario</h2>
    <form action="{{ route('admin.storePieza') }}" method="POST">
        @csrf

        <!-- Nombre de la Pieza -->
        <div class="mb-3">
            <label for="nombre_pieza" class="form-label">Nombre de la Pieza</label>
            <input type="text" class="form-control" id="nombre_pieza" name="nombre_pieza" required>
        </div>

        <!-- Cantidad Disponible -->
        <div class="mb-3">
            <label for="cantidad_disponible" class="form-label">Cantidad Disponible</label>
            <input type="number" class="form-control" id="cantidad_disponible" name="cantidad_disponible" required min="0">
        </div>

        <!-- Proveedor -->
        <div class="mb-3">
            <label for="proveedor" class="form-label">Proveedor</label>
            <input type="text" class="form-control" id="proveedor" name="proveedor" required>
        </div>

        <!-- Costo Unitario -->
        <div class="mb-3">
            <label for="costo_unidad" class="form-label">Costo Unitario (RD$)</label>
            <input type="number" class="form-control" id="costo_unidad" name="costo_unidad" required min="0">
        </div>

        <!-- Stock Mínimo -->
        <div class="mb-3">
            <label for="stock_minimo" class="form-label">Stock Mínimo</label>
            <input type="number" class="form-control" id="stock_minimo" name="stock_minimo" required min="0">
        </div>

        <!-- Botón de Enviar -->
        <button type="submit" class="btn btn-success">Agregar Pieza</button>
    </form>
</div>
@endsection
