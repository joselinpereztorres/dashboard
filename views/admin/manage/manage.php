<div class="container-fluid p-4 pt-0"> 

<div class="card mt-4">

    <h3 class="m-4 mb-0 text-capitalize"><?php echo "$controller" ?> </h3>
    <?php $registro = $lista[0]; ?> 

    <form class="row g-3 needs-validation m-4" novalidate method='POST' action="<?= "/$controller/editar" ?>">

        <input type="hidden" name="id_cliente" value="<?= $registro['id_cliente'] ?>">
        <?php foreach ($campos as $key => $value): ?>

        

            <?php if($value['type'] == 'text'): ?>
                <div class="col-md-4">
                    
                    <label for="<?php echo $key?>" class="form-label"><?php echo $value['label'] ?></label>
                    <input type="text" class="form-control" id="<?php echo $key?>" name="<?php echo $key?>" value="<?php echo $registro[$key] ?>" required>
                    <div class="valid-feedback">
                    Looks good!
                    </div>
                </div>

            <?php elseif($value['type'] == 'date'): ?>
            <div class="col-md-4">
                    <label for="<?php echo $key?>" class="form-label"><?php echo $value['label'] ?></label>

                    <input 
                        type="date"
                        class="form-control"
                        id="<?php echo $key?>"
                        name="<?php echo $key?>"
                        value="<?php echo $registro[$key] ?>"
                    >
                </div>


            <?php endif ?>


        <?php endforeach ?>
    
    
    <div class="col-12 d-flex justify-content-end mt-4 gap-4">
        <a class="btn btn-secondary px-5" href="<?php echo "/$controller" ?>" role="button">Regresar</a>
        <button class="btn btn-primary px-5" type="submit">Guardar</button>
    </div>
    </form>
</div>

</div>