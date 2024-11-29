@extends('layout.app')

@section('content')
<section class="car-details-section py-5">
    <div class="container">
        <div class="row">
            <!-- Imagen Principal del Auto -->
            <div class="col-md-6">
                <img src="{{ asset('storage/' . $auto->foto_auto) }}" alt="{{ $auto->modelo }}" class="img-fluid rounded shadow">
            </div>

            <!-- Detalles del Auto -->
            <div class="col-md-6">
                <h2 class="mb-4">{{ $auto->marca->nombre_marca }} {{ $auto->modelo }}</h2>
                <ul class="list-unstyled">
                    <li class="mb-3">
                        <i class="fa fa-dollar-sign text-primary"></i>
                        <strong>Precio por día:</strong> ${{ $auto->precio_por_dia }}
                    </li>
                    <li class="mb-3">
                        <i class="fa fa-calendar text-primary"></i>
                        <strong>Año:</strong> {{ $auto->año }}
                    </li>
                    <li class="mb-3">
                        <i class="fa fa-palette text-primary"></i>
                        <strong>Color:</strong> {{ ucfirst($auto->detalles->color) }}
                    </li>
                    <li class="mb-3">
                        <i class="fa fa-cogs text-primary"></i>
                        <strong>Transmisión:</strong> {{ ucfirst($auto->detalles->transmision) }}
                    </li>
                    <li class="mb-3">
                        <i class="fa fa-gas-pump text-primary"></i>
                        <strong>Combustible:</strong> {{ ucfirst($auto->detalles->tipo_combustible) }}
                    </li>
                    <li class="mb-3">
                        <i class="fa fa-chair text-primary"></i>
                        <strong>Capacidad de Asientos:</strong> {{ $auto->detalles->numero_asientos }}
                    </li>
                    <li class="mb-3">
                        <i class="fa fa-snowflake text-primary"></i>
                        <strong>Aire Acondicionado:</strong> {{ $auto->detalles->aire_acondicionado == 'sí' ? 'Sí' : 'No' }}
                    </li>
                    <li class="mb-3">
                        <i class="fa fa-map-marker-alt text-primary"></i>
                        <strong>GPS:</strong> {{ $auto->detalles->gps == 'sí' ? 'Sí' : 'No' }}
                    </li>
                    <li class="mb-3">
                        <i class="fa fa-tachometer-alt text-primary"></i>
                        <strong>Velocidad Máxima:</strong> {{ $auto->detalles->velocidad_maxima }} km/h
                    </li>
                    <li class="mb-3">
                        <i class="fa fa-box text-primary"></i>
                        <strong>Capacidad del Maletero:</strong> {{ $auto->detalles->capacidad_maletero }} L
                    </li>
                    <li class="mb-3">
                        <i class="fa fa-oil-can text-primary"></i>
                        <strong>Consumo de Combustible:</strong> {{ $auto->detalles->consumo_combustible }} L/100km
                    </li>
                </ul>
                <a href="#" class="btn btn-primary btn-lg mt-3">
                    <i class="fa fa-calendar-check"></i> Reservar
                </a>
            </div>
        </div>

        <!-- Galería de Imágenes -->
        <div class="row mt-5">
            <h3 class="mb-4">Galería</h3>
            @if ($auto->multimedia->isNotEmpty())
                @foreach ($auto->multimedia as $media)
                    <div class="col-md-4 mb-3">
                        @if ($media->tipo_media === 'imagen')
                            <img src="{{ asset('storage/' . $media->ruta_media) }}" alt="Imagen del Auto" class="img-fluid rounded shadow">
                        @endif
                    </div>
                @endforeach
            @else
                <p class="text-muted">No hay multimedia disponible para este auto.</p>
            @endif
        </div>
    </div>
</section>
@endsection
