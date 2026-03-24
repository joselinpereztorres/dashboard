<?php 
    require_once (__DIR__ . '/../models/clientes.models.php');


    class ClientesController extends Controller {
        private $id;

        public function __construct(){
           
        }

        public function index() {

            $this->checkAuth();   // valida sesión
                    
            $this->render('clientes','clientes', [], 'plantilla');
        }

        public function manage($idCodificado) {

            $this->render('manage','manage', [], 'plantilla');
        }
    
    }
?>