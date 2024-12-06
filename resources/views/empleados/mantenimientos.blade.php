<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Mantenimientos</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/empleados.css') }}">
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
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
        <h1 class="text-center mb-4">Mantenimientos</h1>

        <!-- Contadores de estado -->
        <div class="row text-center mb-4">
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title text-warning"><i class="fas fa-hourglass-start"></i> Pendientes</h5>
                        <p class="card-text display-5">{{ $countPendiente ?? 0 }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title text-info"><i class="fas fa-tools"></i> En Progreso</h5>
                        <p class="card-text display-5">{{ $countEnProgreso ?? 0 }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title text-success"><i class="fas fa-check-circle"></i> Finalizados</h5>
                        <p class="card-text display-5">{{ $countFinalizado ?? 0 }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Formulario de Filtros -->
        <!-- Filtro de Mantenimientos -->
<form action="{{ route('empleado.mantenimientos') }}" method="GET" class="row g-3 mb-4">
    <div class="col-md-4">
        <label for="estado" class="form-label">Estado</label>
        <select class="form-select" id="estado" name="estado">
            <option value="">Todos</option>
            <option value="pendiente" {{ request('estado') == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
            <option value="en progreso" {{ request('estado') == 'en progreso' ? 'selected' : '' }}>En Progreso</option>
            <option value="finalizado" {{ request('estado') == 'finalizado' ? 'selected' : '' }}>Finalizado</option>
        </select>
    </div>
    <div class="col-md-3">
        <label for="fecha_desde" class="form-label">Desde</label>
        <input type="date" class="form-control" id="fecha_desde" name="fecha_desde" value="{{ request('fecha_desde') }}">
    </div>
    <div class="col-md-3">
        <label for="fecha_hasta" class="form-label">Hasta</label>
        <input type="date" class="form-control" id="fecha_hasta" name="fecha_hasta" value="{{ request('fecha_hasta') }}">
    </div>
    <div class="col-md-2 align-self-end">
        <button type="submit" class="btn btn-primary w-100">Filtrar</button>
    </div>
</form>


        <!-- Tabla de Mantenimientos -->
        @if ($mantenimientos->isEmpty())
            <div class="alert alert-info text-center">No hay mantenimientos registrados con los filtros aplicados.</div>
        @else
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Auto</th>
                            <th>Tipo</th>
                            <th>Costo</th>
                            <th>Fecha</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mantenimientos as $mantenimiento)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $mantenimiento->auto->marca->nombre_marca ?? 'N/A' }} {{ $mantenimiento->auto->modelo ?? 'N/A' }}</td>
                                <td>{{ ucfirst($mantenimiento->tipo_mantenimiento) }}</td>
                                <td>${{ number_format($mantenimiento->costo, 2) }}</td>
                                <td>{{ $mantenimiento->fecha_mantenimiento }}</td>
                                <td>
                                    <span class="badge bg-{{ $mantenimiento->estado === 'pendiente' ? 'warning' : ($mantenimiento->estado === 'finalizado' ? 'success' : 'info') }}">
                                        {{ ucfirst($mantenimiento->estado) }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('empleado.mantenimientos.detalles', $mantenimiento->id_mantenimiento) }}" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i> Detalles</a>
                                    @if ($mantenimiento->estado === 'pendiente')
                                        <form action="{{ route('empleado.mantenimientos.finalizar', $mantenimiento->id_mantenimiento) }}" method="POST" style="display: inline-block ; >

                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-check"></i> Finalizar</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        <!-- Resumen -->
        <div class="mt-4">
            <h4 class="text-end">Total en costos de mantenimientos: ${{ number_format($totalCostos ?? 0, 2) }}</h4>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-light py-4 mt-5">
        <div class="container">
            <div class="row text-center text-md-start">
                <div class="col-md-4">
                    <h5>A&J Rent Cars</h5>
                    <p>Proporcionando un servicio de calidad en el alquiler de vehículos.</p>
                    <div class="social-icons">
                        <a href="#"><i class="fab fa-facebook-f text-light"></i></a>
                        <a href="#"><i class="fab fa-instagram text-light"></i></a>
                        <a href="#"><i class="fab fa-whatsapp text-light"></i></a>
                        <a href="#"><i class="fab fa-youtube text-light"></i></a>
                    </div>
                </div>
                <div class="col-md-4">
                    <h5>Contacto</h5>
                    <p><i class="fa fa-map-marker-alt me-2"></i> La Vega, RD</p>
                    <p><i class="fa fa-phone me-2"></i> 829-753-2211</p>
                </div>
                <div class="col-md-4">
                    <h5>Soporte</h5>
                    <p>¿Necesitas ayuda? Contáctanos.</p>
                    <p><i class="fa fa-envelope me-2"></i> ajrentcars@gmail.com</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
