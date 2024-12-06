@extends('Admin.layouts.admin')

@section('content')
<div class="container-fluid">
    <h2>Agregar Piezas al Mantenimiento</h2>

    <form action="{{ route('admin.storePiezasMantenimiento', $mantenimiento->id_mantenimiento) }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="id_pieza" class="form-label">Pieza</label>
            <select name="id_pieza" id="id_pieza" class="form-control" required>
                @foreach($piezas as $pieza)
                    <option value="{{ $pieza->id_pieza }}">{{ $pieza->nombre_pieza }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="cantidad_utilizada" class="form-label">Cantidad Utilizada</label>
            <input type="number" name="cantidad_utilizada" id="cantidad_utilizada" class="form-control" required min="1">
        </div>

        <button type="submit" class="btn btn-primary">Registrar Pieza</button>
    </form>
</div>
@endsection
