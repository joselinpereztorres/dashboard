<?php
    class UsuariosController extends Controller {

        public function index() {

            $this->render('usuarios','usuarios', [], 'plantilla');
        }

       
    }
?>