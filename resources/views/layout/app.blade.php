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
   <!-- Barra de Navegación Principal -->
   <header>
    <nav class="navbar" aria-label="Barra de navegación principal">

        <!-- Logo y Nombre de la Compañía -->
        <div class="navbar-logo">
            <img src="{{asset('images/src/img/logos/coche.png')}}" alt="Ícono de un auto" aria-hidden="true">
            <span class="company-name">A&J Rent Cars</span>
        </div>

        <!-- Menú de Navegación -->
        <ul class="navbar-menu" role="menubar">
            <li><a href="/" role="menuitem">Inicio</a></li>
            <li><a href="/autos" role="menuitem">Autos</a></li>
            <li><a href="#" role="menuitem">Servicio</a></li>
            <li><a href="#" role="menuitem">Contacto</a></li>
        </ul>

        <!-- Botones de Acción -->
        <div class="navbar-buttons">
            <a href="/register" class="register" role="button">Registrarte</a>
            <a href="/login" class="login" role="button">Iniciar Sesión</a>
        </div>
    </nav>
</header>

        <!-- Main Content Section -->
        <main>
            <div class="container my-4">
                @yield('content')
            </div>
        </main>

    <!-- Sección del Pie de Página -->
    <footer class="footer">
        <!-- Logos de Marcas -->
        <div class="footer-logos">
            <img src="{{asset('images/src/img/logos/toyota.png')}}" alt="Toyota">
            <img src="{{asset('images/src/img/logos/ford.svg')}}" alt="Ford">
            <img src="{{asset('images/src/img/logos/mercedes.png')}}" alt="Mercedes">
            <img src="{{asset('images/src/img/logos/jeep.webp')}}" alt="Jeep">
            <img src="{{asset('images/src/img/logos/bmw.jpg')}}" alt="BMW">
            <img src="{{asset('images/src/img/logos/audi.jpg')}}" alt="Audi">
        </div>

        <!-- Información de la Empresa -->
        <div class="footer-info">

            <!-- Información General -->
            <div class="footer-details">
                <div class="company-info">
                    <p><i class="fas fa-car"></i> A&J Rent Cars</p>
                    <p>Faucibus faucibus pellentesque dictum turpis. Id pellentesque turpis massa a id iaculis lorem
                        turpis euismod.</p>

                    <!-- Redes Sociales -->
                    <div class="social-media">
                        <a href="#"><i class="fab fa-facebook"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-whatsapp"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>

                <!-- Información de Contacto -->
                <div class="contact-info">
                    <div class="contact-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <p>Dirección <br> La Vega</p>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-envelope"></i>
                        <p>Email <br> A&JRent@gmail.com</p>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-phone"></i>
                        <p>Teléfono <br> 829-753-2211</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Derechos de Autor -->
        <div class="footer-copyright">
            <p>&copy; Copyright A&J Rent Cars, 2024</p>
        </div>
    </footer>

        <!-- External JS Scripts (Bootstrap, Font Awesome, etc.) -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/js/all.min.js"></script>

        <!-- Custom Scripts -->
        <script src="{{ asset('js/scripts.js') }}"></script>
    </body>
</html>
