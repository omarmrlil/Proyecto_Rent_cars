@extends('layout.app')

@section('content')
<div class="d-flex justify-content-end mb-3">
    <a href="{{ route('autos.create') }}" class="btn btn-success">Añadir Vehículo</a>
</div>



<div class="container">
    <h1>Resultados de la búsqueda</h1>

    @if($autos->isEmpty())
        <p>No se encontraron autos que coincidan con tu búsqueda.</p>
    @else
        <div class="car-grid">
            @foreach($autos as $auto)
                <div class="car-card">
                    <img src="{{ asset('storage/'. $auto->foto_auto) }}" alt="{{ $auto->modelo }}">
                    <h3>{{ $auto->modelo }} - {{ $auto->marca->nombre_marca }}</h3>
                    <p>{{ $auto->precio_por_dia }} USD por día</p>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
