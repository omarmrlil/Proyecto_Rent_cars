@extends('layout.app')

@section('title', 'Editar Alquiler')

@section('content')
    <h1 class="mt-4">Editar Alquiler</h1>
    <form action="{{ route('alquileres.update', $alquiler->id_alquiler) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="id_cliente" class="form-label">Cliente</label>
            <select name="id_cliente" class="form-control" id="id_cliente" required>
                @foreach ($clientes as $cliente)
                    <option value="{{ $cliente->id_cliente }}" {{ $cliente->id_cliente == $alquiler->id_cliente ? 'selected' : '' }}>
                        {{ $cliente->usuario->nombre }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="id_auto" class="form-label">Auto</label>
            <select name="id_auto" class="form-control" id="id_auto" required>
                @foreach ($autos as $auto)
                    <option value="{{ $auto->id_auto }}" {{ $auto->id_auto == $alquiler->id_auto ? 'selected' : '' }}>
                        {{ $auto->modelo }} ({{ $auto->matricula }})
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="fecha_inicio" class="form-label">Fecha de Inicio</label>
            <input type="date" name="fecha_inicio" class="form-control" id="fecha_inicio" value="{{ $alquiler->fecha_inicio }}" required>
        </div>
        <div class="mb-3">
            <label for="fecha_fin" class="form-label">Fecha de Fin</label>
            <input type="date" name="fecha_fin" class="form-control" id="fecha_fin" value="{{ $alquiler->fecha_fin }}" required>
        </div>
        <div class="mb-3">
            <label for="costo_total" class="form-label">Costo Total</label>
            <input type="number" name="costo_total" class="form-control" id="costo_total" step="0.01" value="{{ $alquiler->costo_total }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
@endsection
