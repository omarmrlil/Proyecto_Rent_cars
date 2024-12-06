<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Notificaciones</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/empleados.css') }}">
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <!-- Logo -->
                <a class="navbar-brand" href="{{ route('empleado.dashboard') }}">
                    <img src="{{ asset('images/src/img/logos/coche.png') }}" alt="Logo" width="30" height="30" class="d-inline-block align-text-top">
                    <span class="ms-2">A&J Rent Cars</span>
                </a>

                <!-- Botón de menú para móviles -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Opciones del menú -->
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link {{ Request::routeIs('empleado.dashboard') ? 'active' : '' }}" href="{{ route('empleado.dashboard') }}">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::routeIs('empleado.mantenimientos') ? 'active' : '' }}" href="{{ route('empleado.mantenimientos') }}">Mantenimientos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::routeIs('empleado.tareas') ? 'active' : '' }}" href="{{ route('empleado.tareas') }}">Tareas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::routeIs('empleado.notificaciones') ? 'active' : '' }}" href="{{ route('empleado.notificaciones') }}">Notificaciones</a>
                        </li>
                    </ul>

                    <!-- Menú del usuario -->
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ session('usuario')->nombre ?? 'Empleado' }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="{{ route('empleado.perfil') }}">Mi Perfil</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        Cerrar Sesión
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
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

    <div class="container py-5">
        <h1 class="text-center mb-4">Notificaciones</h1>

        @if ($notificaciones->isEmpty())
            <div class="alert alert-info text-center">
                <p>No tienes notificaciones en este momento.</p>
            </div>
        @else
            <ul class="list-group">
                @foreach ($notificaciones as $notificacion)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="mb-1">{{ ucfirst($notificacion->tipo_notificacion) }}</h5>
                            <p class="mb-1">{{ $notificacion->mensaje }}</p>
                            <small class="text-muted">Recibido el {{ \Carbon\Carbon::parse($notificacion->fecha_creacion)->format('d-m-Y H:i') }}</small>
                        </div>
                        @if ($notificacion->estado !== 'visto')
                            <form action="{{ route('empleado.notificaciones.visto', $notificacion->id_notificacion) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary btn-sm">Marcar como Vista</button>
                            </form>
                        @else
                            <span class="badge bg-success">Visto</span>
                        @endif
                    </li>
                @endforeach
            </ul>
        @endif
    </div>

    <!-- Footer -->
    <footer class="bg-light text-dark py-4 mt-5">
        <div class="container">
            <div class="row text-center text-md-start">
                <div class="col-md-3">
                    <h5>A&J Rent Cars</h5>
                    <p>Proporcionando un servicio de calidad en el alquiler de vehículos.</p>
                    <div class="social-icons">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-whatsapp"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
                <div class="col-md-3">
                    <h5>Contacto</h5>
                    <p><i class="fa fa-map-marker-alt me-2"></i> La Vega, RD</p>
                    <p><i class="fa fa-phone me-2"></i> 829-753-2211</p>
                    <p><i class="fa fa-envelope me-2"></i> ajrentcars@gmail.com</p>
                </div>
                <div class="col-md-3">
                    <h5>Enlaces Rápidos</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('empleado.dashboard') }}">Dashboard</a></li>
                        <li><a href="{{ route('empleado.mantenimientos') }}">Mantenimientos</a></li>
                        <li><a href="{{ route('empleado.tareas') }}">Tareas</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h5>Soporte</h5>
                    <p>¿Necesitas ayuda? Contáctanos.</p>
                </div>
            </div>
            <hr>
            <div class="text-center">
                <p>&copy; 2024 A&J Rent Cars. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
