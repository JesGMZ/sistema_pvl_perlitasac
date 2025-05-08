<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reporte Mensual - {{ $fecha }}</title>
    <link rel="stylesheet" href="{{ asset('css/reporte.css') }}">
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
