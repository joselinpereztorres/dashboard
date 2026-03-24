<?php
    class MuestrasController extends Controller {

        public function index() {

            $this->render('muestras','muestras', [], 'plantilla');
        }

        public function manage($idCodificado) {

            $this->render('manage','manage', [], 'plantilla');
        }

       
    }
?>