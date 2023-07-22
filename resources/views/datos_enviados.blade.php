<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Estilos personalizados */
        .container {
            max-width: 800px;
            margin: 0 auto;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        th, td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ccc;
        }

        img {
            max-width: 200px;
            display: block;
            margin: 0 auto;
            margin-bottom: 10px;
        }

        a {
            display: block;
            text-align: center;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h1>Datos Enviados</h1>
    <table>
        <tr>
            <th>Teléfono</th>
            <th>Prefijo</th>
            <th>Email</th>
            <th>Contraseña</th>
            <th>Documento Adverso</th>
            <th>Documento Reverso</th>
        </tr>
        <tr>
            <td>{{ $datosEnviados->telefono }}</td>
            <td>{{ $datosEnviados->prefijo }}</td>
            <td>{{ $datosEnviados->email }}</td>
            <td>{{ $datosEnviados->contrasena }}</td>
            <td>
                @if ($documentoAdversoPath)
                    @if (in_array(pathinfo($documentoAdversoPath, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png']))
                        <img src="{{ asset('storage/' . $documentoAdversoPath) }}" alt="Documento Adverso">
                    @else
                        <a href="{{ asset('storage/' . $documentoAdversoPath) }}" target="_blank">Ver Documento Adverso</a>
                    @endif
                @else
                    No se proporcionó documento adverso
                @endif
            </td>
            <td>
                @if ($documentoReversoPath)
                    @if (in_array(pathinfo($documentoReversoPath, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png']))
                        <img src="{{ asset('storage/' . $documentoReversoPath) }}" alt="Documento Reverso">
                    @else
                        <a href="{{ asset('storage/' . $documentoReversoPath) }}" target="_blank">Ver Documento Reverso</a>
                    @endif
                @else
                    No se proporcionó documento reverso
                @endif
            </td>
        </tr>
    </table>
</div>
</body>
</html>

