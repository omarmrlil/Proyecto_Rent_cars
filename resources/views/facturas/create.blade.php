@extends('layout.app')

@section('content')
<div class="container">
    <h1>Crear Factura</h1>
    <form action="{{ route('facturas.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="id_alquiler" class="form-label">Alquiler</label>
            <select name="id_alquiler" id="id_alquiler" class="form-control">
                @foreach($alquileres as $alquiler)
                    <option value="{{ $alquiler->id_alquiler }}">Alquiler ID: {{ $alquiler->id_alquiler }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="numero_factura" class="form-label">Número de Factura</label>
            <input type="text" class="form-control" id="numero_factura" name="numero_factura" required>
        </div>
        <div class="mb-3">
            <label for="monto_total" class="form-label">Monto Total</label>
            <input type="number" step="0.01" class="form-control" id="monto_total" name="monto_total" required>
        </div>
        <div class="mb-3">
            <label for="monto_impuesto" class="form-label">Monto del Impuesto</label>
            <input type="number" step="0.01" class="form-control" id="monto_impuesto" name="monto_impuesto" required>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>
@endsection
