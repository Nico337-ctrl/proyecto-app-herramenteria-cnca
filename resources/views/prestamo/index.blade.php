@extends('layouts.template')
@section('title', 'Prestamos')
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap4.min.css">
@endsection

@section('content')
    <div class="container py-4">
        <h1>Prestamos</h1>
        @can('prestamo.create')
            <a href="#" data-toggle="modal" data-target="#ModalCreate" class="btn btn-primary btn-sm">Realizar un prestamo</a>
        @endcan
        @can('prestamo.pdf')
            <a href="prestamo/pdf" class="btn btn-danger btn-sm" target="_blank">Generar Reporte <strong>.PDF</strong></a>
        @endcan
        <br>
        <br>
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
                        <td>
                            @can('prestamo.edit')
                                <a href="{{ url('prestamo/'.$prestamo->id.'/edit' ) }}" class="btn btn-warning btn-sn" data-toggle="modal" data-target="#ModalEdit">Devolucion</a></td>
                            @endcan
                        <td>
                            <form action="{{ url('prestamo/'.$prestamo->id) }}" method="post">
                                @method("DELETE")
                                @csrf
                                    @can('prestamo.destroy')
                                        <button type="submit" onclick="return confirm('¿Deseas eliminar este registro?')" class="btn btn-danger btn-sn">Eliminar</button>
                                    @endcan
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @section('js')
        <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
        <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap4.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

        <script>
            $(document).ready(function (){
                    if ($.fn.DataTable.isDataTable('#tableH')) {
                        $('#tableH').DataTable().destroy();
                    }

                    $('#tableH').DataTable({
                        responsive: true,
                        autoWidth: false
                        // ,
                        // "language":{
                        //     "url": 'https://cdn.datatables.net/plug-ins/1.13.7/i18n/es-CO.json'
                        // }
                    });
                });
        </script>
    @endsection
    @include('prestamo.create')
    @include('prestamo.edit')
@endsection
