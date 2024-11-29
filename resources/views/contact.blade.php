@extends('layout.app')

@section('content')
    <section class="contact-section py-5">
        <div class="container">
            <h2 class="text-center mb-4">Contáctanos</h2>
            <p class="text-center mb-5">Estamos aquí para ayudarte. Completa el formulario o utiliza los datos de contacto
                para comunicarte con nosotros.</p>

            <div class="row">
                <!-- Información de Contacto -->
                <div class="col-md-6">
                    <h4>Información de Contacto</h4>
                    <ul class="list-unstyled">
                        <li class="mb-3">
                            <i class="fa fa-map-marker-alt text-primary"></i> Dirección: Calle Principal #123, Santo Domingo
                        </li>
                        <li class="mb-3">
                            <i class="fa fa-phone-alt text-primary"></i> Teléfono: +1 (809) 555-1234
                        </li>
                        <li class="mb-3">
                            <i class="fa fa-envelope text-primary"></i> Correo: contacto@ajrental.com
                        </li>
                        <li>
                            <i class="fa fa-clock text-primary"></i> Horario: Lunes a Viernes, 8:00 AM - 6:00 PM
                        </li>
                    </ul>
                </div>

                <!-- Formulario de Contacto -->
                <div class="col-md-6">
                    <h4>Envíanos un Mensaje</h4>
                    <form action="" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Tu Nombre"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo Electrónico</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Tu Correo"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="mensaje" class="form-label">Mensaje</label>
                            <textarea class="form-control" id="mensaje" name="mensaje" rows="5" placeholder="Tu Mensaje" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </form>

                </div>
            </div>
        </div>
    </section>
@endsection
