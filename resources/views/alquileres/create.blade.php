@extends('layout.app')

@section('title', 'Registrar Alquiler')

@section('content')
    <h1 class="mt-4">Registrar Alquiler</h1>
    <form action="{{ route('alquileres.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="id_cliente" class="form-label">Cliente</label>
            <select name="id_cliente" class="form-control" id="id_cliente" required>
                @foreach ($clientes as $cliente)
                    <option value="{{ $cliente->id_cliente }}">{{ $cliente->usuario->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="id_auto" class="form-label">Auto</label>
            <select name="id_auto" class="form-control" id="id_auto" required>
                @foreach ($autos as $auto)
                    <option value="{{ $auto->id_auto }}">{{ $auto->modelo }} ({{ $auto->matricula }})</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="fecha_inicio" class="form-label">Fecha de Inicio</label>
            <input type="date" name="fecha_inicio" class="form-control" id="fecha_inicio" required>
        </div>
        <div class="mb-3">
            <label for="fecha_fin" class="form-label">Fecha de Fin</label>
            <input type="date" name="fecha_fin" class="form-control" id="fecha_fin" required>
        </div>
        <div class="mb-3">
            <label for="costo_total" class="form-label">Costo Total</label>
            <input type="number" name="costo_total" class="form-control" id="costo_total" step="0.01" required>
        </div>
        <button type="submit" class="btn btn-primary">Registrar</button>
    </form>
@endsection
