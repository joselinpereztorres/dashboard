<?php 


    class InicioController extends Controller {

        public function index() {
            $this->checkAuth();   // valida sesión
            $rol= $_SESSION['rol'];

       
            $this->render('inicio','inicio', [], 'plantilla');
     

            
        }

       
    }
?>