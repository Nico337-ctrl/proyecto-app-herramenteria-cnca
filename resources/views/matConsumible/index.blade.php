@extends('layouts.template')
@section('title', 'MATERIALES CONSUMIBLES')
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('css/index-matc.css') }}">
@endsection

@section('content')
    <div class="container py-4">
        <h1>Materiales consumibles</h1>
        @can('matConsumible.create')
            <a  href="#" data-toggle="modal" data-target="#ModalCreate" class="btn btn-primary btn-sm">Ingresar nuevo material</a>
        @endcan
        @can('matConsumible.pdf')
            <a href="matConsumible/pdf" class="btn btn-primary btn-sm">Generar Reporte (PDF)</a>
        @endcan
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Codigo</th>
                    <th>Descripcion</th>
                    <th>Estante</th>
                    <th>Entrepaño</th>
                    <th>Medida</th>
                    <th>Cantidad</th>
                    <th>ACCIONES</th>
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
                        <td>{{ $matConsumible->cantidad }}</td>
                        {{-- <td>{{ $matConsumible->estado }}</td>                      --}}
                        <td class="btn-s">
                            {{-- <a href="{{ url('matConsumible/'.$matConsumible->id.'/edit' ) }}" class="btn btn-warning btn-sn" data-toggle="modal" data-target="#ModalEdit" data-id="{{ $matConsumible->id }}"><i class="fa-solid fa-pen-to-square"></i></a>   --}}
                            @can('matConsumible.edit')
                                <a href="#" class="btn btn-warning btn-sn edit-button" data-toggle="modal" data-target="#ModalEdit_{{ $matConsumible->id }}" data-id="{{ $matConsumible->id }}">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                            @endcan
                            {{-- <a href="#" class="btn btn-warning btn-sn edit-button" data-toggle="modal" data-target="#ModalEdit_{{ $matConsumible->id }}" data-id="{{ $matConsumible->id }}">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a> --}}

                            <form class="form__delete" action="{{ url('matConsumible/'.$matConsumible->id) }}" method="post">
                                @method("DELETE")
                                @csrf
                                @can('matConsumible.destroy')
                                    <button type="submit" class="btn btn-danger btn-sn"><i class="fa-solid fa-trash"></i></button>
                                @endcan
                            </form>
                        </td>
                    </tr>
                    {{-- <form id="editForm" action="{{ url('matConsumible') }}" method="post" enctype="multipart/form-data"> --}}
                    <form class="edit-form" action="{{ url('matConsumible/'.$matConsumible->id) }}" method="post" enctype="multipart/form-data">
                        <div class="modal fade text-left" id="ModalEdit_{{ $matConsumible->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">{{('Editar material consumible')}}</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        @method("PUT")
                                        @csrf
                                        <div class="md-3 row">
                                            <label for="cantidad" class="col-sm-2 col-form-label">Codigo</label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control"  name="codigo"  id="codigo" value="{{ $matConsumible->codigo }}" required>
                                            </div>
                                        </div>
                                        <div class="md-3 row">
                                            <label for="descripcion" class="col-sm-2 col-form-label">Descripción</label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control"  name="descripcion"  id="descripcion" value="{{ $matConsumible->descripcion }}" required>
                                            </div>
                                        </div>

                                        <div class="md-3 row">
                                            <label for="estante" class="col-sm-2 col-form-label">Estante</label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control"  name="estante"  id="estante" value="{{ $matConsumible->estante }}" required>
                                            </div>
                                        </div>

                                        <div class="md-3 row">
                                            <label for="gaveta" class="col-sm-2 col-form-label">Entrepaño</label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control"  name="gaveta"  id="gaveta" value="{{ $matConsumible->gaveta }}" required>
                                            </div>
                                        </div>


                                        <div class="md-3 row">
                                            <label for="medida" class="col-sm-2 col-form-label">Medida</label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control"  name="medida"  id="medida" value="{{ $matConsumible->medida }}" required>
                                            </div>
                                        </div>

                                        <div class="md-3 row">
                                            <label for="medida" class="col-sm-2 col-form-label">Cantidad</label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control"  name="cantidad"  id="cantidad" value="{{ $matConsumible->cantidad }}" required>
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-success">Guardar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                @endforeach
            </tbody>
        </table>
    </div>

    @include('matConsumible.create')

    {{-- @foreach ($matConsumibles as $matConsumible) --}}

    {{-- @endforeach     --}}
@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://kit.fontawesome.com/f7a6c0e211.js" crossorigin="anonymous"></script>

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

    @if(session('delete') == 'ok')
    <script>
        Swal.fire({
            title: "¡Material eliminado!",
            text: "El material ha sido eliminado con éxito.",
            icon: "success"
        });
    </script>
    @endif

    <script>
        $('.form__delete').submit(function(e){
            e.preventDefault();

            Swal.fire({
                title: "¿Estás seguro?",
                text: "Este material se eliminará definitivamente",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "¡Si, eliminar!",
                cancelButtonText: "Cancelar",

            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();

                }
            });
        });
    </script>

    <script>
        $(document).ready(function () {
            $('.btn-warning').on('click', function () {
                var matConsumibleId = $(this).data('id');

                // Hacer una solicitud AJAX para obtener los datos del material consumible
                $.get("{{ url('matConsumible') }}" + '/' + matConsumibleId + '/edit', function (data) {
                    // Actualizar dinámicamente el formulario con los datos recibidos
                    var form = $('#editForm_' + matConsumibleId);
                    form.attr('action', "{{ url('matConsumible') }}" + '/' + matConsumibleId);

                    // Actualizar los campos del formulario
                    form.find('#codigo').val(data.codigo);
                    form.find('#descripcion').val(data.descripcion);
                    // ... Actualizar otros campos ...

                    // Mostrar el modal de edición
                    $('#ModalEdit_' + matConsumibleId).modal('show');
                });
            });
        });
    </script>
    {{-- <script>
        $(document).ready(function () {
            $('.edit-button').on('click', function () {
                var matConsumibleId = $(this).data('id');

                // Obtener el formulario específico para el elemento clicado
                var form = $('#editForm_' + matConsumibleId);

                // Hacer una solicitud AJAX para obtener los datos del material consumible
                $.get("{{ url('matConsumible') }}" + '/' + matConsumibleId + '/edit')
                    .done(function (data) {
                        // Actualizar dinámicamente el formulario con los datos recibidos
                        form.attr('action', "{{ url('matConsumible') }}" + '/' + matConsumibleId);

                        // Actualizar los campos del formulario
                        form.find('#codigo').val(data.codigo);
                        form.find('#descripcion').val(data.descripcion);
                        // ... Actualizar otros campos ...

                        // Mostrar el modal de edición
                        $('#ModalEdit_' + matConsumibleId).modal('show');
                    })
                    .fail(function (error) {
                        console.error("Error al obtener datos del servidor:", error);
                        // Manejar el error, por ejemplo, mostrar un mensaje al usuario
                    });
            });
        });
    </script> --}}


@endsection



