
<div class="container-fluid p-4 pt-0">

   
    <div class="d-flex justify-content-between pt-4 pb-5 ">

        <h3 class="">Usuarios</h3>

        <div class="d-flex gap-3">

            <button type="button" class="btn btn-primary px-3 btnModal" data-id="usuarios">Nuevo usuario</button>
        </div>

        

    </div>

    <div>
      

        <div class="table-responsive">
            <table class="table align-middle table table-borderless">
                <thead class="table-secondary">
                    <tr>
                        <th class="indice">#</th>
                        <th class="nombre">Nombre</th>
                        <th class="correo">Correo</th>
                        <th class="rol">Rol</th>
                        <th class="status">Status</th>
                        <th class="acciones">Acciones</th>

                    </tr>
                </thead>

                <tbody class="contenedor_usuarios">

                    <template class="template_usuarios">
                    
                        <tr >
                            <td class="indice"></td>
                            <td> 
                                <div class="d-flex align-items-center">
                                   <i class="bi bi-person fs-4 me-2"></i> 
                                   <span class="nombre"></span>
                                </div>
                            </td>
                            <td> 
                                <div class="d-flex align-items-center">
                                   <i class="bi bi-envelope fs-4 me-2"></i>
                                   <span class="correo"></span>
                                </div>
                            </td>

                            <td class="rol"></td>
                            <td class=""> 
                                <div class="form-check form-switch status">
                                    <input class="form-check-input" type="checkbox" role="switch"  >
                                    
                                    
                                </div>
                            </td>
                                                                
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


    
        </div>
    </div>   

</div>

<script type="module"  src="/public/assets/js/usuarios.js"></script>