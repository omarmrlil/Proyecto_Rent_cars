<!DOCTYPE html>
<html>
<head>
    <title>Reporte de Alquileres</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
    </style>
</head>
<body>
    <h2>Reporte de Alquileres desde {{ $fechaInicio }} hasta {{ $fechaFin }}</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Auto</th>
                <th>Fecha Inicio</th>
                <th>Fecha Fin</th>
                <th>Costo Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $alquiler)
                <tr>
                    <td>{{ $alquiler->id_alquiler }}</td>
                    <td>{{ $alquiler->cliente->usuario->nombre }}</td>
                    <td>{{ $alquiler->auto->modelo }}</td>
                    <td>{{ $alquiler->fecha_inicio }}</td>
                    <td>{{ $alquiler->fecha_fin }}</td>
                    <td>{{ $alquiler->costo_total }} USD</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
