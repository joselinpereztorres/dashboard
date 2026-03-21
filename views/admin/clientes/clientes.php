
<pre><?php print_r($_SESSION); ?></pre>
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
                        <th>Nombre</th>
                        <th>Telefono</th>
                        <th>Tel emergencia</th>
                        <th>Status</th>
                        <th>Visitas</th>
                        <th>Ultima cita</th>
                        <th>Acciones</th>

                    </tr>
                </thead>
                <tbody >
                    <?php foreach($lista as $index => $cliente): ?>
                    <tr >
                        <td><?php echo $index+1 ?></td>
                        <td><?php echo "{$cliente['nombre']} {$cliente['apellido_pat']} {$cliente['apellido_mat']}" ?></td>
                        <td><?php echo $cliente['telefono'] ?></td>
                        <td><?php echo $cliente['tel_emergencia'] ?></td>
                        <td><span class="badge bg-success"><?php echo $cliente['status'] ?></span></td>
                        <td><?php echo $cliente['num_visitas'] ?></td>
                        <td><?php echo $cliente['ultima_visita'] ?></td>                    
                        <td class="d-flex  justify-content-around align-items-center">                        
                            
                            <a href="/clientes/manage"><i class="bi bi-whatsapp"></i></i></a>

                            <a href="/clientes/manage/<?php echo base64_encode($cliente['id_cliente']) ?>"><i class="bi bi-pencil-square"></i></a>
                                                    
                            <button class="btn btn-link p-0 btn-eliminar" data-id="<?php echo ($cliente['id_cliente']) ?>">
                                <i class="bi bi-trash"></i>
                            </button>
                    

                        
                        </td>
                    </tr>

                    <?php endforeach ?>
                
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