<div class="modal" id="modalResultado" tabindex="-1">
    <div class="modal-dialog modal-dialog-scrollable">
       

        <div class="modal-content rounded">

            <form method="POST" id="resultadosForm" class="needs-validation" novalidate>
                <input type="hidden" id="id_muestra" name="id_muestra">

                <div class="modal-header">
                    <h4 class="modal-title text-capitalize">Resultados</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body px-4">
                    <div class="row g-4">

                        <div class="col-md-12">
                            <label for="resultado" class="form-label">Resultado</label>
                            <textarea class="form-control" name="resultado" style="height: 70px"></textarea>
                        </div>

                        <div class="col-md-12">
                            <label for="fecha" class="form-label">Fecha</label>
                            <input type="date" class="form-control" id="fecha" name="fecha" required>
                        </div>

                        <div class="col-md-12">
                            <label for="observaciones" class="form-label">Observaciones</label>
                            <textarea class="form-control" name="observaciones" style="height: 70px"></textarea>
                        </div>

                    </div>
                </div>

                <div class="modal-footer d-flex justify-content-between">
                    <div><button type="button" class="btn btn-secondary rounded" data-bs-dismiss="modal">Cerrar</button></div>
                    <div><button type="submit" class="btn btn-default btn-primary rounded" id="guardarResultado">Guardar</button></div>
                </div>
            </form>
            
        </div>
        
    </div>
</div>
