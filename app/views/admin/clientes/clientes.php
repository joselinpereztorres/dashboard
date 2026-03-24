
<div class="container-fluid p-4 pt-0">
    <nav class="navbar navbar-light  my-4 mx-0 px-0 ">
        <div class="container-fluid ">
            <div class="container ">
                <div class="row">
                    
                    <div class="col-md-6">
                        <form class="d-flex" >
                            <input class="form-control me-2 form-control-sm" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </form>
                    </div>
                    
                    <div class="col-md-6 d-flex justify-content-end gap-4 ">
                        <button type="button" class="btn btn-primary"><i class="bi bi-download text-light"></i></button>
                        
                        <button type="button" class="btn btn-primary btnModal" data-id="clientes">Agregar Cliente</button>                        
                    </div>

                </div>
            </div> 
            
        </div>
    </nav>

    <div>
        <div class="d-flex justify-content-end my-3">
            <select class="form-select form-select-sm w-auto me-2">
                <option selected>Filtro</option>
                <option>Mas antiguo</option>
                <option>Nuevo</option>
                <option>Fecha</option>
            </select>
        </div>

        <div class="table-responsive">
            <table class="table align-middle table table-borderless">
                <thead class="table-secondary">
                    <tr>
                        <th>#</th>
                        <th>Cliente</th>
                        <th>Contacto</th>
                        <th>Ubicacion</th>
                        <th>Proyectos activos</th>
                        <th>Total de muestras</th>                     
                        <th>Acciones</th>

                    </tr>
                </thead>
                
                 <tbody class="contenedor_clientes">

                    <template class="template_clientes">
                    
                        <tr >
                            <td class="indice"></td>
                             <td> 
                                <div class="d-flex align-items-center">
                                   <i class="bi bi-person fs-4 me-2"></i> 
                                   <span class="cliente"></span>
                                </div>
                            </td>
                            <td class="contacto">
                                 
                                <div class="item d-flex align-items-center">
                                    <i class="bi bi-envelope me-2"></i>
                                    <span class="correo">correo@ejemplo.com</span>
                                </div>
                                <div class="item d-flex align-items-center">
                                    <i class="bi bi-telephone me-2"></i>
                                    <span class="telefono">222 123 4567</span>
                                </div>
                            </td>
                            <td class="ubicacion"></td>
                            <td class="proyectos"></td>
                            <td class="muestras"></td>

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

<script type="module" src="/public/assets/js/clientes.js"></script>