<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura - {{ $factura->numero_factura }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        .container {
            padding: 20px;
            border: 1px solid #ddd;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .details table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .details th, .details td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .details th {
            background-color: #f5f5f5;
        }
        .summary {
            text-align: right;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>A&J Rent Cars</h1>
            <p>Factura No. {{ $factura->numero_factura }}</p>
        </div>
        <div class="details">
            <h3>Detalles del Alquiler</h3>
            <table>
                <thead>
                    <tr>
                        <th>Auto</th>
                        <th>Fechas</th>
                        <th>Precio por día</th>
                        <th>Monto Total</th>
                        <th>ITBIS (18%)</th>
                        <th>Total a Pagar</th>
                        <th>Fecha del Pago</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $auto->marca->nombre_marca }} {{ $auto->modelo }}</td>
                        <td>{{ $alquiler->fecha_inicio }} a {{ $alquiler->fecha_fin }}</td>
                        <td>${{ number_format($auto->precio_por_dia, 2) }}</td>
                        <td>${{ number_format($factura->monto_total, 2) }}</td>
                        <td>${{ number_format($factura->monto_impuesto, 2) }}</td>
                        <td>${{ number_format($factura->monto_total + $factura->monto_impuesto, 2) }}</td>
                        <td>{{ $factura->alquiler->pago->fecha_pago ?? 'No disponible' }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="summary">
            <p><strong>Total Pagado:</strong> ${{ number_format($factura->monto_total + $factura->monto_impuesto, 2) }}</p>
            <p><strong>Gracias por confiar en A&J Rent Cars</strong></p>
        </div>
    </div>
</body>
</html>
