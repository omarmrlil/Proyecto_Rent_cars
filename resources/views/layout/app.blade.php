<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A&J Rent Cars, el mejor servicio de alquiler de autos en República Dominicana">
    <meta name="author" content="A&J Rent Cars">
    <meta name="keywords" content="rent cars, alquiler de autos, autos en renta, autos Santo Domingo, alquiler República Dominicana">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'A&J Rent Cars')</title>

    <!-- External CSS (Bootstrap, Font Awesome, etc.) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">
</head>

<body>
    <!-- Header / Navbar Section -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center" href="/">
                    <i class="fa fa-car fa-lg me-2"></i>
                    A&J Rent Cars
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto align-items-center">
                        <li class="nav-item">
                            <a class="nav-link" href="/">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/vehiculos">Autos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/servicios">Servicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/contacto">Contacto</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-primary text-white ms-3" href="/register">Regístrate</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-secondary text-white ms-2" href="/login">Iniciar Sesión</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- Main Content Section -->
    <main>
        <div class="container my-4">
            @yield('content')
        </div>
    </main>

    <!-- Footer Section -->
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

    <!-- External JS Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
