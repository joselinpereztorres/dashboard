
<div class="container-fluid p-4 pt-0">

   
    <div class="d-flex justify-content-between pt-4 pb-5 ">

        <h3 class="">Proyectos</h3>

        <div class="d-flex gap-3">

            <button type="button" class="btn btn-primary px-3 btnModal" data-id="proyectos">Nuevo proyecto</button>
        </div>

        

    </div>

    <div>
     

        <div class="table-responsive">
            <table class="table align-middle table table-borderless">
                <thead class="table-secondary">
                    <tr>
                        <th>#</th>
                        <th>Proyecto</th>
                        <th>Cliente</th>
                        <th>Fecha de inicio</th>
                        <th>Muestras</th>
                        <th>Status</th>
                        <th>Acciones</th>

                    </tr>
                </thead>
               
                <tbody class="contenedor_proyectos">

                    <template class="template_proyectos">
                    
                        <tr>
                            <td class="indice"></td>
                          
                            <td> 
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-folder fs-4 me-2"></i> 
                                    <span class="proyecto"></span>
                                </div>
                            </td>
                            
                            <td> 
                                <div class="d-flex align-items-center">
                                   <i class="bi bi-person fs-4 me-2"></i> 
                                   <span class="cliente"></span>
                                </div>
                            </td>
                            
                            <td class="fecha_inicio"></td>
                            <td class="muestras"></td>
                            <td class="status"></td>

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


            <nav class="d-flex justify-content-center" aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item">
                    <a class="page-link" href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                    <a class="page-link" href="#" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                    </li>
                </ul>
                </nav>
        </div>
    </div>   


</div>

<script type="module"  src="/public/assets/js/proyectos.js"></script>