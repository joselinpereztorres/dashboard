<?php
    class Controller{

        protected function checkAuth(){

            if(session_status() === PHP_SESSION_NONE){
                session_start();
            }

            if(!isset($_SESSION['id_usuario'])){
                header("Location: /login");
                exit;
            }


        }

        protected function flash($type, $msg, $redirect){

            if(session_status() === PHP_SESSION_NONE){
                session_start();
            }

            $_SESSION["flash"] = [
                "type" => $type,
                "msg"  => $msg
            ];

            header("Location: $redirect");
            exit;
        }

        protected function render ($controll, $path,$parameters=[], $layout=''){
            //require_once(__DIR__. '../views/home.view.php')
            extract($parameters);
            ob_start();
            require_once(__DIR__. '/../views/admin/'.$controll.'/'.$path.'.php');
            $content=ob_get_clean();

            require(__DIR__. '/../views/'.$layout.'.php');

        }

    }
    
?>