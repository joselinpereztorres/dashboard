<?php 
    require_once(__DIR__ . '/../../models/login.models.php');
    require_once __DIR__ . '/../../../vendor/autoload.php';

    use Firebase\JWT\JWT;

    class LoginController extends Controller {
       
        public function login(){
            
        header('Content-Type: application/json');

        $data = json_decode(file_get_contents("php://input"), true);

        if(!isset($data['email']) || !isset($data['password'])){
            echo json_encode([
                "status"=>400,
                "error"=>"Datos incompletos"]);
            return;
        }

        $usuario = LoginModel::login($data['email']);

        if(!$usuario || !password_verify($data['password'], $usuario['password'])){
            echo json_encode([
                "status"=>401,
                "error"=>"Credenciales inválidas"]);
            return;
        }

        $payload = [
            "iat" => time(),
            "exp" => time() + (60 * 60), 
            "data" => [
                "id" => $usuario['id_usuario'],
                "rol" => $usuario['rol']
            ]
        ];

        $token = JWT::encode($payload, JWT_SECRET, 'HS256');

        $nombreCompleto = trim(
            $usuario['nombre'] . ' ' .
            $usuario['apellidos'] 
        );

        echo json_encode([
            "status" => 200,
            "usuario" => [
                "id_usuario" => $usuario['id_usuario'],
                "rol" => $usuario['rol'],
                "nombre" => $nombreCompleto
            ],
            "token" => $token
        ]);
    }
       
    }
?>