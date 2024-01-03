    <form action="{{ url('matConsumible') }}" method="post" enctype="multipart/form-data">
        <div class="modal fade text-left" id="ModalCreate" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">{{('Crear nuevo material')}}</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <div class="md-3 row">
                            <label for="cantidad" class="col-sm-2 col-form-label">Codigo</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control"  name="codigo"  id="cantidad" value="{{ old('codigo') }}" required>
                            </div>
                        </div>
                        <div class="md-3 row">
                            <label for="descripcion" class="col-sm-2 col-form-label">Descripción</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control"  name="descripcion"  id="descripcion" value="{{ old('descripcion') }}" required>
                            </div>
                        </div>

                        <div class="md-3 row">
                            <label for="estante" class="col-sm-2 col-form-label">Estante</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control"  name="estante"  id="estante" value="{{ old('estante') }}" required>
                            </div>
                        </div>

                        <div class="md-3 row">
                            <label for="gaveta" class="col-sm-2 col-form-label">Entrepaño</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control"  name="gaveta"  id="gaveta" value="{{ old('gaveta') }}" required>
                            </div>
                        </div>


                        <div class="md-3 row">
                            <label for="medida" class="col-sm-2 col-form-label">Medida</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control"  name="medida"  id="medida" value="{{ old('medida') }}" required>
                            </div>
                        </div>

                        <div class="md-3 row">
                            <label for="cantidad" class="col-sm-2 col-form-label">Cantidad</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control"  name="cantidad"  id="cantidad" value="{{ old('cantidad') }}" required>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
