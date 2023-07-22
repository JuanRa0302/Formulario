<!DOCTYPE html>
<html>
<head>
    <title>Bienvenido</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h1>Bienvenido al formulario</h1>
    <a href="{{ route('formulario.index') }}" class="btn btn-primary">Ir al formulario</a>
</div>
</body>
</html>
