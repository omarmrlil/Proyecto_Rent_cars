@extends('Admin.layouts.admin')

@section('content')
<div class="container-fluid">
    <h2>Calendario de Alquileres</h2>
    <div id="alquileres-calendar"></div>
</div>

<script>
    $(document).ready(function() {
        $('#alquileres-calendar').fullCalendar({
            events: @json($alquileres->map(function($alquiler) {
                return [
                    'title' => 'Alquiler: ' . $alquiler->id_auto,
                    'start' => $alquiler->fecha_inicio,
                    'end' => $alquiler->fecha_fin,
                ];
            }))
        });
    });
</script>
@endsection
