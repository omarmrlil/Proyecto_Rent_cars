@extends('layout.app')

@section('content')

<!-- Portada con imagen y filtro de búsqueda -->
<section class="hero">
    <div class="hero">
    <div class="hero-content">
        <h1>Encuentra el auto ideal para tu viaje</h1>
        <p>¡Tu aventura comienza con nosotros!</p>
        <a href="#" class="btn btn-primary">Explora nuestros servicios</a>
    </div>
</div>

</section>
<!-- Barra de búsqueda  -->
<section class="search-section">
    <div class="search-container">
        <h2>Encuentra tu Auto Ideal</h2>
        <form action="{{ route('search_vehicles') }}" method="GET" class="search-form">
            @csrf
            <div class="input-group">
                <input type="text" name="marca" placeholder="Marca (Toyota, Honda...)" class="form-control">
                <input type="text" name="modelo" placeholder="Modelo" class="form-control">
                <input type="number" name="precio_max" placeholder="Precio Máximo (por día)" class="form-control">
                <button type="submit" class="btn btn-search">Buscar</button>
            </div>
        </form>
    </div>
</section>

@endsection
