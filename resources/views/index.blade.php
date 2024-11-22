@extends('layout.app')

@section('content')
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sesion principal</title>
    <link rel="stylesheet" href="styles.css">

<body>

    <!-- cuerpo de la pagina-->
    <!-- Sección Principal de Alquiler -->

    <main>
        <!-- Contenedor de presentación de Alquiler de Autos -->
        <section class="rental-intro">

            <!-- Contenedor de Texto -->
            <article class="intro-text">
                <h1>¿Busca un auto para alquilar?</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                    et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                    aliquip ex ea commodo consequat.</p>
                <a href="#" class="btn-reserve">Reservar</a>
            </article>

            <!-- Contenedor de Imagen -->
            <figure class="intro-image">
                <img src="{{asset('images/src/img/logos/imagen de sesion 1.png')}}" alt="Imagen de un auto deportivo rojo frente al mar">
            </figure>
        </section>

        <!-- Sección de Búsqueda de Autos -->
        <section class="search-section">
            <h2>Busca tu auto ideal aquí!!</h2>

            <!-- Formulario de Búsqueda de Autos -->
            <form class="search-form" action="#" method="get">
                <input type="text" name="brand" placeholder="Marca" aria-label="Marca">
                <input type="text" name="model" placeholder="Modelo" aria-label="Modelo">
                <input type="text" name="price" placeholder="Precio" aria-label="Precio">
                <button type="submit" class="btn-search">Buscar</button>
            </form>

        </section>
    </main>

    <!-- Sección de Logos de Marcas -->
    <section class="brand-logos">
        <img src="{{asset('images/src/img/logos/bmw.jpg')}}" alt="BMW">
        <img src="{{asset('images/src/img/logos/lexus.png')}}" alt="Lexus">
        <img src="{{asset('images/src/img/logos/mercedes.png')}}" alt="Mercedes">
        <img src="{{asset('images/src/img/logos/honda.png')}}" alt="Honda">
        <img src="{{asset('images/src/img/logos/toyota.png')}}" alt="Toyota">
        <img src="{{asset('images/src/img/logos/nissan.svg')}}" alt="Nissan">
        <img src="{{asset('images/src/img/logos/kia.png')}}" alt="Kia">
    </section>

    <!-- Sección de Coches Destacados -->
    <section class="featured-cars">
        <h2>Coches Destacados</h2>
        <div class="car-list">

            <!-- Cada coche destacado -->
            <div class="car-card">
                <img src="{{asset('images/src/img/autos/2021 BMW M5.jpg')}}" alt="2021 BMW M5">
                <h3>2021 BMW M5</h3>
                <p>$200/day</p>
                <button>Rentar</button>
            </div>

            <div class="car-card">
                <img src="{{asset('images/src/img/autos/2019 Tesla Model X.jpg')}}" alt="2019 Tesla Model X">
                <h3>2019 Tesla Model X</h3>
                <p>$250/day</p>
                <button>Rentar</button>
            </div>

            <div class="car-card">
                <img src="{{asset('images/src/img/autos/2018 Ferrari 488 Spider.jpg')}}" alt="2018 Ferrari 488 Spider">
                <h3>2018 Ferrari 488 Spider</h3>
                <p>$300/day</p>
                <button>Rentar</button>
            </div>

            <div class="car-card">
                <img src="{{asset('images/src/img/autos/2020 Lamborghini Urus.jpg')}}" alt="2020 Lamborghini Urus">
                <h3>2020 Lamborghini Urus</h3>
                <p>$350/day</p>
                <button>Rentar</button>
            </div>

            <div class="car-card">
                <img src="{{asset('images/src/img/autos/2017 Porsche 911 GT3 RS.jpeg')}}" alt="2017 Porsche 911 GT3 RS">
                <h3>2017 Porsche 911 GT3 RS</h3>
                <p>$400/day</p>
                <button>Rentar</button>
            </div>
        </div>
    </section>

    <!-- Sección de Por qué alquilar con nosotros -->
    <section class="why-us">
        <div class="why-us-content">

            <!-- Contenido textual alineado a la izquierda -->
            <div class="why-us-text">
                <h2>¿Por qué alquilar con Nosotros?</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent mi ipsum, dapibus et rhoncus eget,
                    euismod quis metus. Nullam vitae orci sit amet elit dictum consectetur.</p>
                <button>Reserva ahora</button>
            </div>

            <!-- Imagen del auto alineada a la derecha -->
            <div class="why-us-image">
                <img src="{{asset('images/src/img/autos/sesion de por que arquilar con nosotros.png')}}" alt="Imagen de Auto">
            </div>
        </div>
    </section>


</body>

@endsection
