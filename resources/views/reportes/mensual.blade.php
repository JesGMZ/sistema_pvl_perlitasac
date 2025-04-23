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
            color: #2c3e50;
            font-size: 24px;
            margin-bottom: 10px;
        }
        .header p {
            color: #7f8c8d;
            font-size: 16px;
            margin: 0;
        }
        .resumen {
            margin-bottom: 30px;
            padding: 15px;
            background-color: #f8f9fa;
            border-radius: 5px;
        }
        .resumen h2 {
            color: #2c3e50;
            font-size: 18px;
            margin-top: 0;
        }
        .resumen p {
            margin: 5px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f8f9fa;
            font-weight: bold;
            color: #2c3e50;
        }
        tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        .productos {
            margin-left: 20px;
            font-size: 14px;
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
        <p>Programa Vaso de Leche - {{ $fecha }}</p>
    </div>

    <div class="resumen">
        <h2>Resumen General</h2>
        <p><strong>Total Distribuido:</strong> {{ number_format($total_distribuido, 2) }} kg</p>
        <p><strong>Total Comités Atendidos:</strong> {{ $total_comites }}</p>
    </div>

    <h2>Detalle por Comité</h2>
    <table>
        <thead>
            <tr>
                <th>Comité</th>
                <th>Total Distribuido</th>
                <th>Productos Entregados</th>
            </tr>
        </thead>
        <tbody>
            @foreach($resumen_comites as $comite => $datos)
                <tr>
                    <td>{{ $comite }}</td>
                    <td>{{ number_format($datos['total_cantidad'], 2) }} kg</td>
                    <td>
                        <div class="productos">
                            @foreach($datos['productos'] as $producto => $info)
                                • {{ $producto }}: {{ number_format($info['cantidad'], 2) }} {{ $info['unidad'] }}<br>
                            @endforeach
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Generado el {{ \Carbon\Carbon::now()->isoFormat('DD [de] MMMM [del] YYYY [a las] HH:mm:ss') }}</p>
    </div>
</body>
</html>
