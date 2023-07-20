<!DOCTYPE html>
<html>
<head>
    <title>Datos Enviados</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
@if(isset($datosEnviados))
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
                            <img src="{{ asset('storage/' . $documentoAdversoPath) }}" alt="Documento Adverso" style="max-width: 200px;">
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
                            <img src="{{ asset('storage/' . $documentoReversoPath) }}" alt="Documento Reverso" style="max-width: 200px;">
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
@endif
</body>
</html>
