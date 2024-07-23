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
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Ingrese el dato a buscar:</h6>
        </div>
        <div class="card-body">
            <!-- <p>SB Admin 2 makes extensive use of Bootstrap 4 utility classes in order to reduce
                CSS bloat and poor page performance. Custom CSS classes are used to create
                custom components and custom utility classes.</p>
            <p class="mb-0">Before working with this theme, you should become familiar with the
                Bootstrap framework, especially the utility classes.</p> -->
                <form method="POST" action="{{ route('reporte.pdf') }}" target="_blanl">
                    @csrf
                    <!-- <label for="dato">Ingrese el dato a buscar: </label>
                    <br> -->
                    <input class="" type="search" name="dato" placeholder="Instructor, Aprendiz, Ficha Aprendiz ó Documento Aprendiz, Elemento prestado o elementos">
                    <br>
                    <br>
                    <input  class="btn btn-primary btn-sm" type="submit" value="Buscar reporte">
                </form>
        </div>
    </div>
    
    @endcan
    @include('layouts.footer')
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
