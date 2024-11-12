@extends('layout.app')

@section('content')

<!-- Hero Section -->
<section class="hero">
    <div class="hero-content">
        <h1>¿Busca un auto para alquilar?</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        <a href="#" class="btn btn-primary">Reservar</a>
    </div>
    <div class="hero-image">
        <img src="{{ asset('images/portada2.jpg') }}" alt="porches 911">
    </div>
</section>

<!-- Barra de búsqueda -->
<section class="search-section">
    <div class="search-container">
        <h2>Busca tu auto ideal aquí!!</h2>
        <form action="{{ route('search_vehicles') }}" method="GET" class="search-form">
            @csrf
            <div class="input-group">
                <input type="text" name="marca" placeholder="Marca" class="form-control">
                <input type="text" name="modelo" placeholder="Modelo" class="form-control">
                <input type="number" name="precio_max" placeholder="Precio" class="form-control">
                <button type="submit" class="btn btn-search">Buscar</button>
            </div>
        </form>
    </div>
</section>

@endsection
