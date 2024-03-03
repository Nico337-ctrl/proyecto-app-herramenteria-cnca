@extends('layouts.template')

@section('title', 'Generar Reportes')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap4.min.css">
@endsection
@section('content')
<div class="container py-4">
    <h1>Generar Reportes</h1>

    <br>
    <br>
    @can('reporte.pdf')
    <form method="POST" action="{{ route('reporte.pdf') }}" target="_blanl">
        @csrf
        <label for="dato">Ingrese el dato a buscar: </label>
        <br>
        <input type="text" name="dato" placeholder="Instructor, Aprendiz, Ficha Aprendiz ó Documento Aprendiz">
        <br>
        <input type="submit" value="Buscar reporte">
    </form>
    @endcan

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
