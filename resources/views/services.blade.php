@extends('layout.app')

@section('content')
<section class="services-section py-5">
    <div class="container">
        <h2 class="text-center mb-4">Nuestros Servicios</h2>
        <p class="text-center mb-5">En A&J Rent Cars, ofrecemos una variedad de servicios para satisfacer tus necesidades de transporte.</p>
        <div class="row">
            <!-- Servicio 1 -->
            <div class="col-md-4 text-center">
                <i class="fa fa-car text-primary fa-3x mb-3"></i>
                <h4>Alquiler de Autos</h4>
                <p>Variedad de autos modernos y económicos para satisfacer tus necesidades de transporte.</p>
            </div>
            <!-- Servicio 2 -->
            <div class="col-md-4 text-center">
                <i class="fa fa-wrench text-primary fa-3x mb-3"></i>
                <h4>Mantenimiento Preventivo</h4>
                <p>Mantenemos nuestra flota en óptimas condiciones para garantizar tu seguridad.</p>
            </div>
            <!-- Servicio 3 -->
            <div class="col-md-4 text-center">
                <i class="fa fa-road text-primary fa-3x mb-3"></i>
                <h4>Asistencia en Carretera</h4>
                <p>Brindamos soporte en caso de emergencias durante el alquiler.</p>
            </div>
        </div>
    </div>
</section>
@endsection
