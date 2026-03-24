<?php
    class UsuariosController extends Controller {

        public function index() {

            $this->render('usuarios','usuarios', [], 'plantilla');
        }

        public function manage($idCodificado) {

            $this->render('manage','manage', [], 'plantilla');
        }

       
    }
?>