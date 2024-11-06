@extends('layout.app')

@section('content')
    <div class="container">
        <h1>Editar Mantenimiento</h1>
        <form action="{{ route('mantenimientos.update', $mantenimiento->id_mantenimiento) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="id_auto">Auto:</label>
                <select name="id_auto" id="id_auto" class="form-control" required>
                    @foreach($autos as $auto)
                        <option value="{{ $auto->id_auto }}" {{ $mantenimiento->id_auto == $auto->id_auto ? 'selected' : '' }}>
                            {{ $auto->modelo }} - {{ $auto->matricula }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="fecha_mantenimiento">Fecha:</label>
                <input type="date" name="fecha_mantenimiento" id="fecha_mantenimiento" class="form-control" value="{{ $mantenimiento->fecha_mantenimiento }}" required>
            </div>
            <div class="form-group">
                <label for="tipo_mantenimiento">Tipo de Mantenimiento:</label>
                <select name="tipo_mantenimiento" id="tipo_mantenimiento" class="form-control" required>
                    <option value="preventivo" {{ $mantenimiento->tipo_mantenimiento == 'preventivo' ? 'selected' : '' }}>Preventivo</option>
                    <option value="correctivo" {{ $mantenimiento->tipo_mantenimiento == 'correctivo' ? 'selected' : '' }}>Correctivo</option>
                </select>
            </div>
            <div class="form-group">
                <label for="costo">Costo:</label>
                <input type="number" step="0.01" name="costo" id="costo" class="form-control" value="{{ $mantenimiento->costo }}" required>
            </div>
            <div class="form-group">
                <label for="descripcion">Descripción:</label>
                <textarea name="descripcion" id="descripcion" class="form-control">{{ $mantenimiento->descripcion }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
@endsection
