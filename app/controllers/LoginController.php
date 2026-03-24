<?php 
    require_once (__DIR__ . '/../models/login.models.php');


    class LoginController extends Controller {

        public function index() {

            include (__DIR__. '/../views/auth/login/login.php');
        }
        
        public function setSession(){

            if(session_status() === PHP_SESSION_NONE){
                session_start();
            }

            $data = json_decode(file_get_contents("php://input"), true);

            if(!isset($data['id']) || !isset($data['rol'])){
                header('Content-Type: application/json');
                echo json_encode([
                    "status" => 400,
                    "error" => "Datos incompletos para sesión"
                ]);
                return;
            }

            $_SESSION['id_usuario'] = $data['id'];
            $_SESSION['rol'] = $data['rol'];
            $_SESSION['nombre'] = $data['nombre'];

            header('Content-Type: application/json');
            echo json_encode([
                "status" => 200,
                "message" => "Sesión creada correctamente"
            ]);
        }
       
    }
?>