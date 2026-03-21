<?php 
    require_once (__DIR__ . '/../models/dynamic.models.php');

    class DynamicController extends Controller {

        public function agregarElementos() {
      
            $tabla = $_POST['tabla'];
          
 

            $columnas= DynamicModel::getDatos($tabla);


            if($columnas){
                echo json_encode(
                   ["status"         => "200",
                   "col"         => $columnas]);
            }
        }

       
    }

    
?>