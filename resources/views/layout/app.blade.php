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
                    <li><a href="/servicio" role="menuitem">Servicio</a></li>
                    <li><a href="/contacto" role="menuitem">Contacto</a></li>
                </ul>

                <!-- Botones de Acción -->
                <div class="navbar-buttons">
                    <a href="/register" class="register" role="button">Registrarte</a>
                    <a href="/login" class="login" role="button">Iniciar Sesión</a>
                </div>
            </nav>
        </header>

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

    </body>
</html>
