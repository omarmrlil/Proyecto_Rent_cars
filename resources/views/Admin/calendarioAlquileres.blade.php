@extends('Admin.layouts.admin')

@section('content')
<div class="container-fluid">
    <h2>Calendario de Alquileres</h2>
    <div id="alquileres-calendar"></div>
</div>

<script>
    $(document).ready(function() {
        $('#alquileres-calendar').fullCalendar({
            events: {!! json_encode($alquileres->map(function($alquiler) {
                return [
                    'title' => 'Alquiler: ' . $alquiler->id_auto, // Asegúrate de que 'id_auto' o el campo correcto esté disponible
                    'start' => $alquiler->fecha_inicio->format('Y-m-d H:i:s'),
                    'end' => $alquiler->fecha_fin->format('Y-m-d H:i:s'),
                ];
            })) !!}
        });
    });
</script>

@endsection
