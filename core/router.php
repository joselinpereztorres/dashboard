<?php
    class Router{
        public $controller;
        public $method;
        public $params = [];
     

        public function __construct(){
            $this->matchRoute();
        }  

        public function matchRoute(){
            $url= explode("/", URL);
            
            $this->controller= !empty($url[1]) ? $url[1] : 'Inicio';
            $this->method= !empty($url[2]) ? $url[2] : 'index';

            $this->controller=$this->controller.'Controller';

            $this->params = array_slice($url, 3);
           
            
            $file = __DIR__ . '/../controllers/' . $this->controller . '.php';

            // si no existe el controller
            if(!file_exists($file)){
                header("Location: /inicio"); 
                exit;
            }

            require_once($file);
            

        }


        private function authorize(){

   
            // Recurso = nombre del controlador sin "Controller" (ej: ClientesController -> "clientes")
            $recurso = strtolower(str_replace('Controller','', $this->controller));

            // ✅ Rutas públicas (NO requieren sesión)
            // Ajusta aquí según cómo se llame tu controlador de login/auth
            $public = ["login", "auth", "logout"];

            if(in_array($recurso, $public, true)){
                return;
            } 

            // ✅ Si no hay sesión, manda a login
            if(!isset($_SESSION['id_usuario']) || !isset($_SESSION['rol'])){
                header("Location: /login");
                exit;
            }

            // ✅ Permisos por rol (whitelist)
            $permisos = [
                "superadmin" => ["inicio","usuarios","clientes","proyectos","muestras", "dynamic"],
                "admin"      => ["inicio","clientes","proyectos","muestras", "dynamic"],
            ];

            $rol = $_SESSION['rol'];

            // ✅ Si el recurso no está permitido, manda a inicio
            if(!isset($permisos[$rol]) || !in_array($recurso, $permisos[$rol], true)){
                header("Location: /inicio");
                exit;
            }
        }

        public function run(){

            // ✅ Antes de ejecutar controlador/método, valida permisos
            $this->authorize();

            //traeer conexion
            $controller= new $this->controller();
            $method=$this->method;
            // $controller->$method();

            if(!method_exists($controller, $method)){
                header("Location: /inicio");
                exit;
            }

            call_user_func_array([$controller, $method], $this->params);
        }

    
    }
?>