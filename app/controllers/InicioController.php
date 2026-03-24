<?php 


    class InicioController extends Controller {

        public function index() {
            $this->checkAuth();   // valida sesión

       
            $this->render('inicio','inicio', [], 'plantilla');
     

            
        }

       
    }
?>