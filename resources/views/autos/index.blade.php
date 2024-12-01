@extends('layout.app') <!-- herencia -->

@section('content') <!--Define el contenido que será colocado en la sección content del layout base.-->

<!-- Sección de Filtros -->
<section class="filter-section py-4 bg-light">
    <div class="container">
        <h3 class="text-center mb-4">Búsqueda Rapida!!</h3>
        <form action="{{ route('autos.index') }}" method="GET" class="row g-3 justify-content-center">
            <div class="col-md-3">
                <input type="text" name="marca" class="form-control" placeholder="Marca (e.g., Toyota)" value="{{ request('marca') }}">
            </div>
            <div class="col-md-3">
                <input type="text" name="modelo" class="form-control" placeholder="Modelo (e.g., Corolla)" value="{{ request('modelo') }}">
            </div>
            <div class="col-md-2">
                <select name="transmision" class="form-control">
                    <option value="">Transmisión</option>
                    <option value="manual" {{ request('transmision') == 'manual' ? 'selected' : '' }}>Manual</option>
                    <option value="automatica" {{ request('transmision') == 'automatica' ? 'selected' : '' }}>Automática</option>
                </select>
            </div>
            <div class="col-md-2">
                <select name="tipo_combustible" class="form-control">
                    <option value="">Combustible</option>
                    <option value="gasolina" {{ request('tipo_combustible') == 'gasolina' ? 'selected' : '' }}>Gasolina</option>
                    <option value="diesel" {{ request('tipo_combustible') == 'diesel' ? 'selected' : '' }}>Diésel</option>
                    <option value="electrico" {{ request('tipo_combustible') == 'electrico' ? 'selected' : '' }}>Eléctrico</option>
                    <option value="hibrido" {{ request('tipo_combustible') == 'hibrido' ? 'selected' : '' }}>Híbrido</option>
                </select>
            </div>
            <div class="col-md-2">
                <input type="number" name="precio_max" class="form-control" placeholder="Precio Máximo ($)" value="{{ request('precio_max') }}">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">Filtrar</button>
            </div>
        </form>
    </div>
</section>

<!-- Lista de Autos -->
<section class="cars-section py-5">
    <div class="container">
        <h2 class="text-center mb-4">Encuentra tu Auto Perfecto</h2>
        <div class="row">
            @forelse ($autos as $auto)
                <div class="col-md-4 mb-4">
                    <div class="cars-card shadow-sm">
                        <div class="car-image-wrapper">
                            <img src="{{ asset('storage/' . $auto->foto_auto) }}" alt="{{ $auto->modelo }}" class="car-image">
                        </div>
                        <div class="car-content">
                            <h4 class="car-title">{{ $auto->marca->nombre_marca ?? 'N/A' }} {{ $auto->modelo }}</h4>
                            <p class="car-price text-primary font-weight-bold">${{ $auto->precio_por_dia }} / día</p>
                            <ul class="car-features list-unstyled d-flex justify-content-between px-3">
                                <li><i class="fa fa-cogs"></i> {{ ucfirst($auto->detalles->transmision ?? 'N/A') }}</li>
                                <li><i class="fa fa-gas-pump"></i> {{ ucfirst($auto->detalles->tipo_combustible ?? 'N/A') }}</li>
                                <li><i class="fa fa-chair"></i> {{ $auto->detalles->numero_asientos ?? 'N/A' }}</li>
                                <li><i class="fa fa-snowflake"></i> {{ $auto->detalles?->aire_acondicionado == 'sí' ? 'Sí' : 'No' }}</li>
                            </ul>
                            <div class="car-actions text-center">
                                <a href="{{ route('autos.show', $auto->id_auto) }}" class="btn btn-outline-secondary btn-sm">Más Detalles</a>
                                <a href="#" class="btn btn-primary btn-sm">Reservar</a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p>No se encontraron autos con los filtros seleccionados.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>
@endsection
