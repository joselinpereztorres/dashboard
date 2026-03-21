

<div class="container-fluid p-4 pt-0">

   
    <div class="d-flex justify-content-between pt-4 pb-5 ">

        <h3 class="">Usuarios</h3>

        <div class="d-flex gap-3">

            <button type="button" class="btn btn-primary px-3 btnModal" data-id="usuarios">Nuevo usuario</button>
        </div>

        

    </div>

    <div>
        <div class="d-flex justify-content-end my-3">
            <select class="form-select form-select-sm w-auto me-2">
                <option selected>Filtro</option>
                <option>Mas antiguo</option>
                <option>Nuevo</option>

            </select>
        </div>

        <div class="table-responsive">
            <table class="table align-middle table table-borderless">
                <thead class="table-secondary">
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Rol</th>
                        <th>Status</th>
                        <th>Acciones</th>

                    </tr>
                </thead>
                <tbody >
                 
                    <tr >
                        <td>1</td>
                        <td>hsdjkjkd fdff</td>
                        <td>kjdjk@issdjk.comd</td>
                        <td>admin</td>
                        <td> 
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="switchCheckChecked" checked>
                                
                                
                            </div>
                        </td>
                                                            
                        <td class="d-flex  justify-content-around align-items-center">                        
                            
                         

                            <a href="/clientes/manage/<?php echo base64_encode($cliente['id_cliente']) ?>"><i class="bi bi-pencil-square"></i></a>
                                                    
                            <button class="btn btn-link p-0 btn-eliminar" data-id="<?php echo ($cliente['id_cliente']) ?>">
                                <i class="bi bi-trash"></i>
                            </button>
                    

                        
                        </td>
                    </tr>


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