
<?php
class Router{
    public $controller;
    public $method;
    public $params = [];
    public $isApi = false;

    public function __construct(){
        $this->matchRoute();
    }

    public function matchRoute(){
        $url = explode("/", URL);

        // Detectar si es API
        $this->isApi = isset($url[1]) && $url[1] === 'api';

        if($this->isApi){

            // /api/clientes/index
            $this->controller = !empty($url[2]) ? ucfirst($url[2]) : null;
            $this->method = !empty($url[3]) ? $url[3] : 'index';
            $this->params = array_slice($url, 4);

            if(!$this->controller){
                header('Content-Type: application/json');
                echo json_encode(["error" => "Controlador no especificado"]);
                exit;
            }

            $this->controller = $this->controller . 'Controller';
            $file = __DIR__ . '/../controllers/api/' . $this->controller . '.php';

        } else {

            // /clientes/index
            $this->controller = !empty($url[1]) ? ucfirst($url[1]) : 'Inicio';
            $this->method = !empty($url[2]) ? $url[2] : 'index';
            $this->params = array_slice($url, 3);

            $this->controller = $this->controller . 'Controller';
            $file = __DIR__ . '/../controllers/' . $this->controller . '.php';
        }

        if(!file_exists($file)){
            if($this->isApi){
                header('Content-Type: application/json');
                echo json_encode(["error" => "Endpoint no encontrado"]);
            } else {
                header("Location: /inicio");
            }
            exit;
        }

        require_once($file);
    }

    private function authorize(){

        $recurso = strtolower(str_replace('Controller','', $this->controller));

        $public = ["login", "auth", "logout"];

        if(in_array($recurso, $public, true)){
            return;
        }

        if(!isset($_SESSION['id_usuario']) || !isset($_SESSION['rol'])){
            header("Location: /login");
            exit;
        }

        $permisos = require __DIR__ . '/permisos.php';
        $rol = $_SESSION['rol'];

        if(!isset($permisos[$rol]) || !in_array($recurso, $permisos[$rol], true)){
            header("Location: /inicio");
            exit;
        }
    }

    public function run(){

        // Solo proteger con sesión la parte web
        if(!$this->isApi){
            $this->authorize();
        }

        $controller = new $this->controller();
        $method = $this->method;

        if(!method_exists($controller, $method)){
            if($this->isApi){
                header('Content-Type: application/json');
                echo json_encode(["error" => "Método no encontrado"]);
            } else {
                header("Location: /inicio");
            }
            exit;
        }

        if($this->isApi){
            header('Content-Type: application/json');
        }

        call_user_func_array([$controller, $method], $this->params);
    }
}
?>