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
                        <label for="id_aprendiz" class="col-sm-2 col-form-label">Herramienta</label>
                    </strong>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="herramienta_id" id="herramienta_id"
                            value="{{ old('herramienta_id') }}" >
                    </div>

                    {{-- <strong>
                        <label for="id_aprendiz" class="col-sm-2 col-form-label">Mataerial consumible</label>
                    </strong>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="mat_consumible_id" id="mat_consumible_id"
                            value="{{ old('mat_consumible_id') }}">
                    </div> --}}

                    <strong>
                        <label for="mat_consumible_id" class="col-sm-2 col-form-label">Material Consumible</label>
                    </strong>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="mat_consumible_id" id="mat_consumible_id"
                            value="{{ old('mat_consumible_id') }}">
                    </div>

                    <!-- Cantidad para Material Consumible -->
                    <strong>
                        <label for="cantidad" class="col-sm-2 col-form-label">Cantidad Material Consumible</label>
                    </strong>
                    <div class="col-sm-5">
                        <input type="number" class="form-control" name="cantidad"
                            id="cantidad" value="{{ old('cantidad') }}">
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
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"
        integrity="sha256-oP6HI/tTQa9F8kWuR5JfIeZl6+nLlYUZ5K90Zl8l+FY=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
@endsection
