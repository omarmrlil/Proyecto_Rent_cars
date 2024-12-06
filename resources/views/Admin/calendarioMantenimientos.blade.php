@extends('Admin.layouts.admin')

@section('content')
<div class="container-fluid">
    <h2>Calendario de Mantenimientos</h2>
    <div id="mantenimientos-calendar"></div>
</div>

<script>
    $(document).ready(function() {
        $('#mantenimientos-calendar').fullCalendar({
            events: @json($mantenimientos->map(function($mantenimiento) {
                return [
                    'title' => 'Mantenimiento Auto: ' . $mantenimiento->id_auto,
                    'start' => $mantenimiento->fecha_mantenimiento,
                ];
            }))
        });
    });
</script>
@endsection
