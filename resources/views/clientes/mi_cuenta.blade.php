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
            <li><a class="dropdown-item" href="#">Mis Alquileres</a></li>
            <li><a class="dropdown-item" href="#">Historial</a></li>
            <li><a class="dropdown-item" href="#">Configuración</a></li>
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


<div class="container mt-5">
        <h1 class="text-center mb-4">Mi Cuenta</h1>

        <!-- Mensajes de éxito o error -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row">
            <!-- Perfil -->
            <form method="POST" action="{{ route('cliente.updateProfile') }}">
    @csrf
    <div class="form-group">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre" class="form-control" value="{{ session('usuario')->nombre }}" required>
    </div>

    <div class="form-group">
        <label for="email">Correo Electrónico</label>
        <input type="email" name="email" id="email" class="form-control" value="{{ session('usuario')->email }}" required>
    </div>

    <div class="form-group">
        <label for="telefono">Teléfono</label>
        <input type="text" name="telefono" id="telefono" class="form-control" value="{{ session('usuario')->cliente->telefono ?? '' }}">
    </div>

    <div class="form-group">
        <label for="direccion">Dirección</label>
        <input type="text" name="direccion" id="direccion" class="form-control" value="{{ session('usuario')->cliente->direccion ?? '' }}">
    </div>

    <button type="submit" class="btn btn-primary mt-3">Actualizar Perfil</button>
</form>

            <!-- Cambiar Contraseña -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-secondary text-white">
                        <h4>Cambiar Contraseña</h4>
<form method="POST" action="{{ route('cliente.updatePassword') }}">
    @csrf
    <div class="form-group">
        <label for="current_password">Contraseña Actual</label>
        <input type="password" name="current_password" id="current_password" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="new_password">Nueva Contraseña</label>
        <input type="password" name="new_password" id="new_password" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="new_password_confirmation">Confirmar Nueva Contraseña</label>
        <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-primary mt-3">Actualizar Contraseña</button>
</form>

                    </div>
                </div>
            </div>
        </div>
    </div>
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
