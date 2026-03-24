
<div class="container-fluid p-4 pt-0">

    <div class="d-flex justify-content-between pt-4 pb-5 ">

        <h3 class="">Clientes</h3>

        <div class="d-flex gap-3">
         


           
            <button type="button" class="btn btn-primary btnModal" data-id="clientes">Agregar Cliente</button>
        </div>

        

    </div>
  

    <div>
       

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

        </div>
    </div>   

</div>

<script type="module" src="/public/assets/js/clientes.js"></script>