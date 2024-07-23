<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error de tiempo de búsqueda</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f2f2f2;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            text-align: center;
        }
        h1 {
            color: #ff0000;
        }
        p {
            font-size: 18px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Error de búsqueda</h1>
        <p>No se pudo encontrar el elemento buscado. El tiempo de búsqueda ha sido excedido.</p>
        <a href="{{ url()->previous() }}">Volver</a>
    </div>
</body>
</html>
