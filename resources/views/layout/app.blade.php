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
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">

        <!-- Custom CSS -->
        <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

        <!-- Favicon -->
        <link rel="icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">
    </head>

    <body>
        <!-- Header / Navbar Section -->
        <header>
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <div class="container-fluid">
                    <a class="navbar-brand" href="/">A&J Rent Cars</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="/">Inicio</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/vehiculos">Vehículos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/servicios">Servicios</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/contacto">Contacto</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link btn btn-primary text-white" href="/login">Inicia Sesión</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link btn btn-outline-light" href="/register">Regístrate</a>
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
        <footer class="bg-dark text-white mt-auto py-4">
            <div class="container text-center">
                <p>&copy; {{ date('Y') }} A&J Rent Cars. Todos los derechos reservados.</p>
                <p>Email: contacto@ajrentcars.com | Teléfono: +1 809 123 4567</p>
            </div>
        </footer>

        <!-- External JS Scripts (Bootstrap, Font Awesome, etc.) -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/js/all.min.js"></script>

        <!-- Custom Scripts -->
        <script src="{{ asset('js/scripts.js') }}"></script>
    </body>
</html>
