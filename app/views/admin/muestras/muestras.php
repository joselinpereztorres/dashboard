

<div class="container-fluid p-4 pt-0">
    
    <div class="d-flex justify-content-between pt-4 pb-5 ">

        <h3 class="">Muestras</h3>

        <div class="d-flex gap-3">
         


            <button type="button" class="btn btn-primary px-3 btnModal" data-id="muestras">Nueva Muestra</button>
        </div>

        

    </div>

    <div>
       

        <div class="table-responsive">
            <table class="table align-middle table table-borderless">
                <thead class="table-secondary">
                    <tr>
                        <th>#</th>
                        <th>Codigo</th>
                        <th>Cliente</th>
                        <th>Proyecto</th>
                        <th>Fecha recibo</th>
                        <th>Prioridad</th>
                        <th>Horas estimadas</th>
                        <th>Status</th>
                        <th>Resultado</th>
                        <th>Acciones</th>


                    </tr>
                </thead>
                
                <tbody class="contenedor_muestras">

                    <template class="template_muestras">
                    
                        <tr>
                            <td class="indice"></td>
                            <td class="codigo"></td>
                          
                            <td> 
                                <div class="d-flex align-items-center">
                                   <i class="bi bi-person fs-4 me-2"></i> 
                                   <span class="cliente"></span>
                                </div>
                            </td>
                            <td> 
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-folder fs-4 me-2"></i> 
                                    <span class="proyecto"></span>
                                </div>
                            </td>
                            <td class="fecha_recibo"></td>
                            <td> <span class="badge text-bg-primary prioridad text-capitalize"></span></td>

                            <td class="horas"></td>
                            <td><span class="badge text-bg-primary status text-capitalize"></span></td>

                            <td class="resultado"></td>
                            <td>
                                <div class="d-flex justify-content-center align-items-center gap-3">
                                    
                                    <a class="btn-editar">
                                        <i class="bi bi-pencil-square "></i>
                                    </a>

                                    <button class="btn btn-link p-0 btn-eliminar">
                                        <i class="bi bi-trash "></i>
                                    </button>

                                </div>
                            </td>
                        </tr>

                    </template>
                </tbody>

            </table>


            <!-- <nav class="d-flex justify-content-center" aria-label="Page navigation example">
                <ul class="pagination" id="paginacionMuestras"></ul>
            </nav> -->
        </div>
    </div>
</div>


<script type="module" src="/public/assets/js/muestras.js"></script>