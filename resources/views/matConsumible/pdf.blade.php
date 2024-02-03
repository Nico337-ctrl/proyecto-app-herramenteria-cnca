<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    Hola soy tu reporte de Materiales consumibles
    <table id="tableH" class="table table-hover">
        <thead>
            <tr>
                <th>Codigo</th>
                <th>Descripcion</th>
                <th>Estante</th>
                <th>Entrepaño</th>
                <th>Medida</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($matConsumibles as $matConsumible)
                <tr>
                    <td>{{ $matConsumible->codigo }}</td>
                    <td>{{ $matConsumible->descripcion }}</td>
                    <td>{{ $matConsumible->estante }}</td>
                    <td>{{ $matConsumible->gaveta }}</td>
                    <td>{{ $matConsumible->medida }}</td>
                    <td>{{ $matConsumible->estado }}</td>
                </tr>
            @endforeach
        </tbody>
</body>
</html>

