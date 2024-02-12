<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Prestamo</title>
    {{-- <link rel="stylesheet" href="{{ asset('css/pdf-p.css') }}"> --}}
</head>
<body>
    <table id="tableH" class="table table-hover">
        <thead>
            <tr>
                <th>Instructor</th>
                <th>Aprendiz</th>
                <th>Ficha aprendiz</th>
                <th>Documento aprendiz</th>
                <th>Días por fuera</th>
                <th>Observación</th>
                <th>Fecha prestamo</th>
                <th>Fecha devolucion</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($prestamos as $prestamo)
                <tr>
                    <td>{{ $prestamo->instructor_prestamista }}</td>
                    <td>{{ $prestamo->nombre_aprendiz }}</td>
                    <td>{{ $prestamo->ficha_aprendiz }}</td>
                    <td>{{ $prestamo->id_aprendiz }}</td>
                    <td>{{ $prestamo->dias_por_fuera }}</td>
                    <td>{{ $prestamo->observacion }}</td>
                    <td>{{ $prestamo->created_at }}</td>
                    <td>{{ $prestamo->updated_at }}</td>
                </tr>
            @endforeach
        </tbody>
</body>
</html>

