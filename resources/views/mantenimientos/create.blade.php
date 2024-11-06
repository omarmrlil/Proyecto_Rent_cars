@extends('layout.app')

@section('content')
    <div class="container">
        <h1>Registrar Mantenimiento</h1>
        <form action="{{ route('mantenimientos.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="id_auto">Auto:</label>
                <select name="id_auto" id="id_auto" class="form-control" required>
                    @foreach($autos as $auto)
                        <option value="{{ $auto->id_auto }}">{{ $auto->modelo }} - {{ $auto->matricula }}</option>
                    @endforeach
                </select>
            </div>
            <!-- Otros campos -->
            <button type="submit" class="btn btn-primary">Registrar</button>
        </form>
    </div>
@endsection
