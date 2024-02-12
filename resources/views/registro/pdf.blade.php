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
    Hola soy tu reporte de registros
    <table id="tableH" class="table table-hover">
        <thead>
            <tr>
                <th>Origen de cambio</th>
                <th>Tipo de cambio</th>
                <th>Elemento alterado/Aprendiz</th>
                <th>Fecha de registro</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($registros as $registro)
                <tr>
                    <td>{{ $registro->origen }}</td>
                    <td>{{ $registro->tipo_cambio }}</td>
                    <td>{{ $registro->elemento_id }}</td>
                    <td>{{ $registro->fecha}}</td>


                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

