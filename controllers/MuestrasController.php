<?php
    class MuestrasController extends Controller {

        public function index() {

            $this->render('muestras','muestras', [], 'plantilla');
        }

       
    }
?>