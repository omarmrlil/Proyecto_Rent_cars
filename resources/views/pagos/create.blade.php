@extends('layout.app')

@section('title', 'Registrar Pago')

@section('content')
    <h1 class="mt-4">Registrar Pago</h1>
    <form action="{{ route('pagos.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="id_alquiler" class="form-label">Alquiler</label>
            <select name="id_alquiler" class="form-control" id="id_alquiler" required>
                @foreach ($alquileres as $alquiler)
                    <option value="{{ $alquiler->id_alquiler }}">Alquiler #{{ $alquiler->id_alquiler }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="monto" class="form-label">Monto</label>
            <input type="number" name="monto" class="form-control" id="monto" step="0.01" required>
        </div>
        <div class="mb-3">
            <label for="metodo_pago" class="form-label">Método de Pago</label>
            <input type="text" name="metodo_pago" class="form-control" id="metodo_pago" required>
        </div>
        <div class="mb-3">
            <label for="referencia_transaccion" class="form-label">Referencia de Transacción</label>
            <input type="text" name="referencia_transaccion" class="form-control" id="referencia_transaccion">
        </div>
        <button type="submit" class="btn btn-primary">Registrar</button>
    </form>
@endsection
