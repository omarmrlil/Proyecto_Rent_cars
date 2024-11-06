@extends('layout.app')

@section('title', 'Editar Pieza del Inventario')

@section('content')
    <h1 class="mt-4">Editar Pieza del Inventario</h1>
    <form action="{{ route('inventarios.update', $pieza->id_pieza) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nombre_pieza" class="form-label">Nombre de la Pieza</label>
            <input type="text" name="nombre_pieza" class="form-control" id="nombre_pieza" value="{{ $pieza->nombre_pieza }}" required>
        </div>
        <div class="mb-3">
            <label for="cantidad_disponible" class="form-label">Cantidad Disponible</label>
            <input type="number" name="cantidad_disponible" class="form-control" id="cantidad_disponible" value="{{ $pieza->cantidad_disponible }}" required min="0">
        </div>
        <div class="mb-3">
            <label for="costo_unidad" class="form-label">Costo por Unidad</label>
            <input type="number" step="0.01" name="costo_unidad" class="form-control" id="costo_unidad" value="{{ $pieza->costo_unidad }}" required min="0">
        </div>
        <div class="mb-3">
            <label for="proveedor" class="form-label">Proveedor</label>
            <input type="text" name="proveedor" class="form-control" id="proveedor" value="{{ $pieza->proveedor }}">
        </div>
        <div class="mb-3">
            <label for="stock_minimo" class="form-label">Stock Mínimo</label>
            <input type="number" name="stock_minimo" class="form-control" id="stock_minimo" value="{{ $pieza->stock_minimo }}" required min="0">
        </div>
        <button type="submit" class="btn btn-primary">Actualizar Pieza</button>
        <a href="{{ route('inventarios.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection
