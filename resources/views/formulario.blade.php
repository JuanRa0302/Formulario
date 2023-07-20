<!DOCTYPE html>
<html>
<head>
    <title>Formulario</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            function readURL(input, imgPreview) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        imgPreview.attr('src', e.target.result);
                        imgPreview.show();
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }

            $("#documento_adverso").change(function() {
                readURL(this, $('#preview_documento_adverso'));
            });

            $("#documento_reverso").change(function() {
                readURL(this, $('#preview_documento_reverso'));
            });
        });
    </script>
    @if(isset($datosEnviados))
        <div class="container mt-5">
            <h1>Datos Enviados</h1>
            <table>
                <!-- ... -->
                <tr>
                    <!-- ... -->
                    <td>
                        @if ($documentoAdversoPath)
                            <a href="{{ asset('storage/' . $documentoAdversoPath) }}" target="_blank">Ver Documento Adverso</a>
                            <img src="{{ asset('storage/' . $documentoAdversoPath) }}" alt="Documento Adverso" style="max-width: 200px;">
                        @else
                            No se proporcionó documento adverso
                        @endif
                    </td>
                    <td>
                        @if ($documentoReversoPath)
                            <a href="{{ asset('storage/' . $documentoReversoPath) }}" target="_blank">Ver Documento Reverso</a>
                            <img src="{{ asset('storage/' . $documentoReversoPath) }}" alt="Documento Reverso" style="max-width: 200px;">
                        @else
                            No se proporcionó documento reverso
                        @endif
                    </td>
                </tr>
            </table>
        </div>
    @endif
</head>
<body>
<div class="container mt-5">
    <form action="{{ route('formulario.enviar') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono:</label>
            <input type="text" name="telefono" id="telefono" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="prefijo" class="form-label">Prefijo del país:</label>
            <select name="prefijo" id="prefijo" class="form-control" required>
                <option value="">Selecciona un país</option>
                @foreach ($paisesYPrefijos as $pais => $prefijos)
                    @foreach ($prefijos as $prefijo)
                        <option value="{{ $prefijo }}">{{ $prefijo }} ({{ $pais }})</option>
                    @endforeach
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="contrasena" class="form-label">Contraseña:</label>
            <input type="password" name="contrasena" id="contrasena" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="documento_adverso" class="form-label">Documento Adverso:</label>
            <input type="file" name="documento_adverso" id="documento_adverso" class="form-control" accept=".pdf, .jpg, .jpeg, .png" required>
            <img id="preview_documento_adverso" src="" alt="Documento Adverso" style="max-width: 200px; display: none;">
            <div id="documento_adverso_error" style="color: red; display: none;">Archivo no válido. Asegúrate de que sea un PDF, JPG o PNG.</div>
        </div>
        <div class="mb-3">
            <label for="documento_reverso" class="form-label">Documento Reverso:</label>
            <input type="file" name="documento_reverso" id="documento_reverso" class="form-control" accept=".pdf, .jpg, .jpeg, .png" required>
            <img id="preview_documento_reverso" src="" alt="Documento Reverso" style="max-width: 200px; display: none;">
            <div id="documento_reverso_error" style="color: red; display: none;">Archivo no válido. Asegúrate de que sea un PDF, JPG o PNG.</div>
        </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>
</div>
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
                    @if ($datosEnviados->documentoAdversoPath)
                        <a href="{{ asset($datosEnviados->documentoAdversoPath) }}" target="_blank">Ver Documento Adverso</a>
                    @else
                        No se proporcionó documento adverso
                    @endif
                </td>
                <td>
                    @if ($datosEnviados->documentoReversoPath)
                        <a href="{{ asset($datosEnviados->documentoReversoPath) }}" target="_blank">Ver Documento Reverso</a>
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
