@extends('layouts.template')

@section('title', 'Registros')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap4.min.css">
@endsection
@section('content')
<div class="container py-4">

    <h1>Registros</h1>
    @can('registro.pdf')
        <a href="registro/pdf" class="btn btn-danger btn-sm">Generar Reporte <strong>.PDF</strong></a>
    @endcan
    <br>
    <br>
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
    </div>

    @section('scripts')
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap4.min.js"></script>
        <script>
            $(document).ready(function () {
                $('#tableH').DataTable();
            });
        </script>
    @endsection
@endsection
