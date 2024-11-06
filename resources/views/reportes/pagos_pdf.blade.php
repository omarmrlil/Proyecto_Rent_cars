<!DOCTYPE html>
<html>
<head>
    <title>Reporte de Pagos</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
    </style>
</head>
<body>
    <h2>Reporte de Pagos desde {{ $fechaInicio }} hasta {{ $fechaFin }}</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Alquiler</th>
                <th>Monto</th>
                <th>Fecha de Pago</th>
                <th>Método de Pago</th>
                <th>Referencia</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $pago)
                <tr>
                    <td>{{ $pago->id_pago }}</td>
                    <td>{{ $pago->alquiler->id_alquiler }}</td>
                    <td>{{ $pago->monto }} USD</td>
                    <td>{{ $pago->fecha_pago }}</td>
                    <td>{{ $pago->metodo_pago }}</td>
                    <td>{{ $pago->referencia_transaccion }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
