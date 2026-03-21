<div class="modal" id="modalCliente" tabindex="-1">
    <div class="modal-dialog modal-dialog-scrollable">
       

        <div class="modal-content rounded">

            <form method="POST" class="needs-validation" action="/clientes/crear" novalidate>

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title text-capitalize">Páginas</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body px-4">

                    <div class="row  g-4">

                        <!-- Fila 1 -->
                        <div class="col-md-6">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>

                        <div class="col-md-6">
                            <label for="ape_paterno" class="form-label">Apellido Paterno</label>
                            <input type="text" class="form-control" id="ape_paterno" name="ape_paterno" required>
                        </div>

                        <!-- Fila 2 -->
                        <div class="col-md-6">
                            <label for="ape_materno" class="form-label">Apellido Materno</label>
                            <input type="text" class="form-control" id="ape_materno" name="ape_materno" required>
                        </div>

                        <div class="col-md-6">
                            <label for="telefono" class="form-label">Teléfono</label>
                            <input type="text" class="form-control" id="telefono" name="telefono" required>
                        </div>

                        <!-- Fila 3 -->
                        <div class="col-md-6">
                            <label for="fecha_nac" class="form-label">Fecha de nacimiento</label>
                            <input type="date" class="form-control" id="fecha_nac" name="fecha_nac" required>
                        </div>

                        <div class="col-md-6">
                            <label for="tel_emergencia" class="form-label">Teléfono de emergencia</label>
                            <input type="text" class="form-control" id="tel_emergencia" name="tel_emergencia" required>
                        </div>

                    </div>
                </div>

                

                <!-- Modal footer -->
                <div class="modal-footer d-flex justify-content-between">
                
                    <div><button type="button" class="btn btn-secondary rounded" data-bs-dismiss="modal">Cerrar</button></div>
                    <div><button type="submit" class="btn btn-default btn-primary rounded">Guardar</button></div>
                
                </div>

            </form>

            
        </div>
        
    </div>
</div>
