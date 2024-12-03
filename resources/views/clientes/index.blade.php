<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- SEO Meta Tags -->
        <meta name="description" content="A&J Rent Cars, el mejor servicio de alquiler de autos en República Dominicana">
        <meta name="author" content="A&J Rent Cars">
        <meta name="keywords" content="rent cars, alquiler de autos, autos en renta, autos Santo Domingo, alquiler República Dominicana">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Title Section -->
        <title>@yield('title', 'A&J Rent Cars')</title>

        <!-- External CSS (Bootstrap, Font Awesome, etc.) -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQ3NpXQdxRx3pgNcF1V9BqLS18NSdPXRdN8ULw+fUFpC9IW5FH6EF/2Q7" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-11YT3fo3luYytChjpxQVBoXKAFKsdjXoOdZyMQ5RZbgqZV4Qax+jHPq/bSwHoF2e0a1fA3gH+6g7PCiS4ETnZQ==" crossorigin="anonymous" />

        <!-- Custom CSS -->
        <link rel="stylesheet" href="{{ asset('css/clientes.css') }}">

        <!-- Favicon -->
        <link rel="icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">
   <!-- Barra de Navegación -->
<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <!-- Logo y Nombre de la Compañía -->
            <a class="navbar-brand d-flex align-items-center" href="{{ route('cliente.dashboard') }}">
                <img src="{{ asset('images/src/img/logos/coche.png') }}" alt="Logo" width="30" height="30" class="d-inline-block align-text-top">
                <span class="ms-2">A&J Rent Cars</span>
            </a>

            <!-- Botón de Toggle para móviles -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Menú de Navegación -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::routeIs('cliente.dashboard') ? 'active' : '' }}" href="{{ route('cliente.dashboard') }}">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::routeIs('clientes.autos') ?  : '' }}" href="{{ route('cliente.autos') }}">Autos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::routeIs('clientes.servicios') ? '' : '' }}" href="{{ route('cliente.servicios') }}">Servicios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::routeIs('clientes.contact') ? '' : '' }}" href="{{ route('cliente.contact') }}">Contacto</a>
                    </li>
                </ul>

<ul class="navbar-nav ms-auto">
    <li class="nav-item dropdown">
        <!-- Botón del Menú -->
        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="clienteMenu" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fas fa-user me-2"></i> {{ session('usuario')->nombre ?? 'Usuario' }}
        </a>

        <!-- Opciones del Dropdown -->
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="clienteMenu">
            <li><a class="dropdown-item" href="{{ route('cliente.mi_cuenta') }}">Mi Cuenta</a></li>
            <li><a class="dropdown-item" href="{{ route('cliente.notificaciones') }}">Notificaciones</a></li>
            <li><a class="dropdown-item" href="{{ route('cliente.historial_pagos') }}">Historial de Pagos</a></li>
            <li><a class="dropdown-item" href="{{ route('cliente.mis_alquileres') }}">Mis Alquileres</a></li>

            <li><hr class="dropdown-divider"></li>
            <li>
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Cerrar Sesión
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        </ul>
    </li>
</ul>
            </div>
        </div>
    </nav>
</header>
<body>

     <!-- cuerpo de la pagina-->
    <!-- Sección Principal de Alquiler -->

    <section class="hero">
    <div class="hero-content">
        <h1>¿Busca un auto para alquilar?</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        <a href="{{ route('cliente.autos') }}" class="btn btn-primary">Reservar</a>
    </div>
    <div class="hero-image">
        <img src="{{ asset('images/src/img/logos/imagen de sesion 1.png') }}" alt="Auto en la playa">
    </div>
</section>

<!-- Barra de búsqueda -->
<section class="search-section">
    <div class="search-container">
        <h2>Busca tu auto ideal aquí!!</h2>
<form action="{{ route('cliente.search') }}" method="GET" class="search-form">
    @csrf
    <div class="input-group">
        <input type="text" name="marca" placeholder="Marca" class="form-control" value="{{ request('marca') }}">
        <input type="text" name="modelo" placeholder="Modelo" class="form-control" value="{{ request('modelo') }}">
        <input type="number" name="precio_max" placeholder="Precio" class="form-control" value="{{ request('precio_max') }}">
        <button type="submit" class="btn btn-search">Buscar</button>
    </div>
</form>

    </div>
</section>


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
                <button onclick="window.location.href='{{ route('cliente.autos') }}';" >Reserva ahora</button>
            </div>

            <!-- Imagen del auto alineada a la derecha -->
            <div class="why-us-image">
                <img src="{{asset('images/src/img/autos/sesion de por que arquilar con nosotros.png')}}" alt="Imagen de Auto">
            </div>
        </div>
    </section>

</body>

    <!-- Sección del Pie de Página -->
    <footer class="bg-light text-dark py-4">
    <div class="container">
        <div class="row text-center text-md-start">
            <div class="col-md-3">
                <h5>A&J Rent Cars</h5>
                <p>Faucibus faucibus pellentesque dictum turpis. Id pellentesque turpis massa a id iaculis lorem turpis euismod.</p>
                <div class="social-icons">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-whatsapp"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
            <div class="col-md-3 contact-info">
                <h5><i class="fa fa-map-marker-alt me-2"></i> Dirección</h5>
                <p>La Vega</p>
            </div>
            <div class="col-md-3 contact-info">
                <h5><i class="fa fa-envelope me-2"></i> Email</h5>
                <p>A&JRent@gmail.com</p>
            </div>
            <div class="col-md-3 contact-info">
                <h5><i class="fa fa-phone me-2"></i> Teléfono</h5>
                <p>829-753-2211</p>
            </div>
        </div>
        <hr>
        <div class="text-center">
            <p>&copy; 2024 A&J Rent Cars. Todos los derechos reservados.</p>
        </div>
    </div>
</footer>


        <!-- External JS Scripts (Bootstrap, Font Awesome, etc.) -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/js/all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-QF0g3OAO3BzabXzj5S5AzlOjgjoxD9BZmS4wg1vtJrbhxwyy3aWYNJlWyfHVjPiY" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYe0KI6NzAsfrg2G+idk8Ns2fL3R77SyJHYQWVuWTZIjvoE5RFYYUOdQ0Pxaj+T" crossorigin="anonymous"></script>


        <!-- Custom Scripts -->
        <script src="{{ asset('js/scripts.js') }}"></script>
    </body>
</html>
