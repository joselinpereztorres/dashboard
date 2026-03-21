<?php 
    require_once (__DIR__ . '/../models/servicios.models.php');


    class ProyectosController extends Controller {
       

        public function __construct(){
          
        }

        public function index() {
            
            $this->checkAuth();   // valida sesión
            $this->render('proyectos','proyectos', [], 'plantilla');
        }

        public function crear() {
            
            $this->checkAuth();   // valida sesión
            $this->render('servicios','servicios','admin', [], 'plantilla');
        }
    }
