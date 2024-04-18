<form action="{{ url('prestamo') }}" method="post" enctype="multipart/form-data">
    <div class="modal fade text-left" id="ModalCreate" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ 'Realizar prestamo' }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @csrf
                    <strong>
                        <label for="instructor_prestamista" class="col-sm-2 col-form-label">Instructor:</label>
                    </strong>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="instructor_prestamista"
                            id="instructor_prestamista" value="{{ old('instructor_prestamista') }}" required>
                    </div>


                    <strong>
                        <label for="nombre_aprendiz" class="col-sm-2 col-form-label">Nombre Aprendiz:</label>
                    </strong>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="nombre_aprendiz" id="nombre_aprendiz"
                            value="{{ old('nombre_aprendiz') }}" required>
                    </div>


                    <strong>
                        <label for="ficha_aprendiz" class="col-sm-2 col-form-label">Ficha aprendiz:</label>
                    </strong>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="ficha_aprendiz" id="ficha_aprendiz"
                            value="{{ old('ficha_aprendiz') }}" required>
                    </div>

                    <strong>
                        <label for="id_aprendiz" class="col-sm-2 col-form-label"># Documento Aprendiz:</label>
                    </strong>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="id_aprendiz" id="id_aprendiz"
                            value="{{ old('id_aprendiz') }}" required>
                    </div>

                    <strong>
                        <label for="herramientas" class="col-sm-2 col-form-label">Herramientas y materiales consumibles:</label>
                    </strong>
                    <div class="col-sm-5">

                        <select class=" js-example-basic-multiple" name="herramientas[]" multiple="multiple"
                            style="width: 100%">
                            @foreach ($herramientas as $herramienta)
                                @if ($herramienta->estado == 'disponible')
                                    <option value="{{ $herramienta->id }}">{{ $herramienta->codigo }} --
                                        {{ $herramienta->descripcion }}</option>
                                @endif
                            @endforeach
                        </select>

                    </div>

                    <strong>
                        <label for="mat_consumibles" class="col-sm-2 col-form-label">Materiales consumibles</label>
                    </strong>
                    <div class="col-sm-5">
                        <select name="mat_consumibles[]" class="form-control js-example-basic-multiple"
                            multiple="multiple" style="width: 100%">
                            @foreach ($mat_consumibles as $mat_consumible)
                                @if ($mat_consumible->estado == 'disponible')
                                <option value="{{ $mat_consumible->id }}">{{ $mat_consumible->codigo }} --
                                    {{ $mat_consumible->descripcion }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <!-- Cantidad para Material Consumible -->
                    <strong>
                        <label for="cantidad_mat_consumibles" class="col-sm2 col-form-label">Selecciona la cantidad de cada material a prestar:</label>
                    </strong>
                    <div class="col-sm-5">
                        <select name="" id="">
                            @foreach($mat_consumibles as $mat_consumible)
                                @if($mat_consumible->estado = 'disponible')
                                    <option value="{{ $mat_consumible->id }}">{{ $mat_consumible->descripcion }} --{{ $mat_consumible->cantidad }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <br>
                    <a href="{{ url('prestamo') }}" class="btn btn-secondary">Regresar</a>
                    <button type="submit" class="btn btn-success">Guardar prestamo</button>
                </div>
            </div>
        </div>
    </div>
</form>
@section('js')
    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2({
                theme: "classic"
            });
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"
        integrity="sha256-oP6HI/tTQa9F8kWuR5JfIeZl6+nLlYUZ5K90Zl8l+FY=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endsection


@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
