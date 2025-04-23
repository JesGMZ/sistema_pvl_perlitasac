<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reporte Mensual - {{ $fecha }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
            line-height: 1.6;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .header h1 {
            font-size: 24px;
            margin-bottom: 10px;
        }
        .resumen {
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        th, td {
            padding: 8px;
            border: 1px solid #ccc;
            text-align: left;
        }
        th {
            background-color: #f0f0f0;
        }
        .footer {
            text-align: center;
            margin-top: 50px;
            font-size: 12px;
            color: #7f8c8d;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Reporte Mensual de Distribución</h1>
        <p>{{ $fecha }}</p>
    </div>

    <div class="resumen">
    <strong>Total Distribuido:</strong> {{ number_format($total_distribuido, 2) }} {{ $datos_reporte->first()['producto_unidadmedidad'] ?? '' }}
    </div>


    <table>
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Municipalidad</th>
                <th>Comité</th>
                <th>Producto</th>
                <th>Cantidad Producto</th>
                <th>Cantidad Distribuida</th>
                <th>Precio Unitario</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($datos_reporte as $fila)
                <tr>
                    <td>{{ $fila['pvl_fecha'] }}</td>
                    <td>{{ $fila['municipalidad_razonsocial'] }}</td>
                    <td>{{ $fila['comite_nombre'] }}</td>
                    <td>{{ $fila['producto_descripcion'] }}</td>
                    <td>{{ number_format($fila['producto_cantidad'], 2) }}</td>
                    <td>{{ number_format($fila['detallepvl_cantidad'], 2) }}</td>
                    <td>S/ {{ number_format($fila['detallepvl_precio'], 2) }}</td>
                    <td>S/ {{ number_format($fila['detallepvl_cantidad'] * $fila['detallepvl_precio'], 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Generado el {{ \Carbon\Carbon::now()->isoFormat('DD [de] MMMM [del] YYYY [a las] HH:mm:ss') }}</p>
    </div>
</body>
</html>
