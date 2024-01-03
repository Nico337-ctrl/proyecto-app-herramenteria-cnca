{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CREAR HERRAMIENTA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body> --}}
        <form action="{{ url('herramienta') }}" method="post" enctype="multipart/form-data">
            <div class="modal fade text-left" id="ModalCreate" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">{{('Crear nueva herramienta')}}</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            @csrf
                                <strong>
                                    <label for="codigo" class="col-sm-2 col-form-label">Codigo:</label>
                                </strong>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control"  name="codigo"  id="codigo" value="{{ old('codigo') }}" required>
                                </div>

                                <strong>
                                    <label for="descripcion" class="col-sm-2 col-form-label">Descripción:</label>
                                </strong>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control"  name="descripcion"  id="descripcion" value="{{ old('descripcion') }}" required>
                                </div>


                                <strong>
                                    <label for="estante" class="col-sm-2 col-form-label">Estante:</label>
                                </strong>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control"  name="estante"  id="estante" value="{{ old('estante') }}" required>
                                </div>

                                <strong>
                                    <label for="gaveta" class="col-sm-2 col-form-label">Entrepaño:</label>
                                </strong>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control"  name="gaveta"  id="gaveta" value="{{ old('gaveta') }}" required>
                                </div>



                                <strong>
                                    <label for="medida" class="col-sm-2 col-form-label">Medida:</label>
                                </strong>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control"  name="medida"  id="medida" value="{{ old('medida') }}" required>
                                </div>

                                <br>
                                {{-- <a href="{{ url('herramienta') }}"  class="btn btn-secondary">Regresar</a> --}}
                                <button type="submit" class="btn btn-success">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
{{--
</body>
</html> --}}
