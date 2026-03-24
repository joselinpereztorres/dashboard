<?php 
    require_once (__DIR__ . '/../models/proyectos.models.php');


    class ProyectosController extends Controller {
       

        public function __construct(){
          
        }

        public function index() {
            
            $this->checkAuth();   // valida sesión
            $this->render('proyectos','proyectos', [], 'plantilla');
        }

         public function manage() {

            $this->render('manage','manage', [], 'plantilla');
        }
    }
