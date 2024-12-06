<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Mi Perfil</title>


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
<body>

    <div class="container py-5">
        <h1 class="text-center mb-4">Mi Perfil</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="row">
            <div class="col-md-6">
                <h2>Información Personal</h2>
                <form action="{{ route('empleado.perfil.actualizar') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" value="{{ $usuario->nombre }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control" value="{{ $usuario->email }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="telefono" class="form-label">Teléfono</label>
                        <input type="text" name="telefono" id="telefono" class="form-control" value="{{ $empleado->telefono }}">
                    </div>
                    <div class="mb-3">
                        <label for="direccion" class="form-label">Dirección</label>
                        <textarea name="direccion" id="direccion" class="form-control">{{ $empleado->direccion }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Actualizar Perfil</button>
                </form>
            </div>
            <div class="col-md-6">
                <h2>Cambiar Contraseña</h2>
                <form action="{{ route('empleado.perfil.cambiar_password') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="password_actual" class="form-label">Contraseña Actual</label>
                        <input type="password" name="password_actual" id="password_actual" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="password_nuevo" class="form-label">Nueva Contraseña</label>
                        <input type="password" name="password_nuevo" id="password_nuevo" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="password_nuevo_confirmation" class="form-label">Confirmar Nueva Contraseña</label>
                        <input type="password" name="password_nuevo_confirmation" id="password_nuevo_confirmation" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Cambiar Contraseña</button>
                </form>
            </div>
        </div>
    </div>

</body>
    <!-- Footer -->
    <footer class="bg-light text-dark py-4 mt-5">
        <div class="container">
            <div class="row text-center text-md-start">
                <div class="col-md-3">
                    <h5>A&J Rent Cars</h5>
                    <p>Proporcionando un servicio de calidad en el alquiler de vehículos.</p>
                </div>
                <div class="col-md-3">
                    <h5>Contacto</h5>
                    <p><i class="fa fa-map-marker-alt me-2"></i> La Vega, RD</p>
                </div>
                <div class="col-md-3">
                    <h5>Soporte</h5>
                    <p>¿Necesitas ayuda? Contáctanos.</p>
                </div>
            </div>
        </div>
    </footer>
        <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
</html>
