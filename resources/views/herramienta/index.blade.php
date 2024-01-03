@extends('layouts.template')
@section('title', 'HERRAMIENTAS')
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('css/index-h.css') }}">
@endsection

@section('content')
    <div class="container py-4">
        <h1>Herramientas</h1>
        <a href="#" data-toggle="modal" data-target="#ModalCreate" class="btn btn-primary btn-sm">Ingresar nueva herramienta</a>
        <table id="tableH" class="table table-hover">
            <thead>
                <tr>
                    <th>Codigo</th>
                    <th>Descripcion</th>
                    <th>Estante</th>
                    <th>Entrepaño</th>
                    <th>Medida</th>
                    <th>Estado</th>
                    <th>ACCIONES</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($herramientas as $herramienta)
                    <tr>
                        <td>{{ $herramienta->codigo }}</td>
                        <td>{{ $herramienta->descripcion }}</td>
                        <td>{{ $herramienta->estante }}</td>
                        <td>{{ $herramienta->gaveta }}</td>
                        <td>{{ $herramienta->medida }}</td>
                        <td>{{ $herramienta->estado }}</td>
                        <td class="btn-s">
                            {{-- <a href="{{ url('herramienta/'.$herramienta->id.'/edit' ) }}" class="btn btn-warning btn-sn" data-toggle="modal" data-target="#ModalEdit" data-id="{{ $herramienta->id }}"><i class="fa-solid fa-pen-to-square"></i></a> --}}
                            <a href="#" class="btn btn-warning btn-sn" data-toggle="modal" data-target="#ModalEdit{{ $herramienta->id }}"><i class="fa-solid fa-pen-to-square"></i></a>
                            <form class="form__delete" action="{{ url('herramienta/'.$herramienta->id) }}" method="post" >
                                @method("DELETE")
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sn"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    <form action="{{ url('herramienta/'.$herramienta->id) }}" method="post" enctype="multipart/form-data">
                        <div class="modal fade text-left" id="ModalEdit{{ $herramienta->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">{{('Editar herramienta')}}</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        @method("PUT")
                                        @csrf

                                        <div class="md-3 row">
                                            <label for="codigo" class="col-sm-2 col-form-label">Codigo</label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control"  name="codigo"  id="codigo" value="{{ $herramienta->codigo }}" required>
                                            </div>
                                        </div>

                                        <div class="md-3 row">
                                            <label for="descripcion" class="col-sm-2 col-form-label">Descripción</label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control"  name="descripcion"  id="descripcion" value="{{ $herramienta->descripcion }}" required>
                                            </div>
                                        </div>

                                        <div class="md-3 row">
                                            <label for="estante" class="col-sm-2 col-form-label">Estante</label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control"  name="estante"  id="estante" value="{{ $herramienta->estante }}" required>
                                            </div>
                                        </div>

                                        <div class="md-3 row">
                                            <label for="gaveta" class="col-sm-2 col-form-label">Entrepaño</label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control"  name="gaveta"  id="gaveta" value="{{ $herramienta->gaveta }}" required>
                                            </div>
                                        </div>


                                        <div class="md-3 row">
                                            <label for="medida" class="col-sm-2 col-form-label">Medida</label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control"  name="medida"  id="medida" value="{{ $herramienta->medida }}" required>
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

    @include('herramienta.create')


@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
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

                });
            });
    </script>

    @if(session('delete') == 'ok')
        <script>
            Swal.fire({
                title: "¡Herramienta eliminada!",
                text: "Tu herramienta ha sido eliminada con éxito.",
                icon: "success"
            });
        </script>
    @endif

    <script>
        $('.form__delete').submit(function(e){
            e.preventDefault();

            Swal.fire({
                title: "¿Estás seguro?",
                text: "Esta herramienta se eliminará definitivamente",
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
@endsection

