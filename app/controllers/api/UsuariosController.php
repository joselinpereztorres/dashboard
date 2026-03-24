<?php 
require_once(__DIR__ . '/../../models/usuarios.models.php');
require_once(__DIR__ . '/../../core/authApi.php');

    class UsuariosController extends Controller {

        public function mostrar() {

            header('Content-Type: application/json');

            $usuarios = UsuariosModel::mostrarUsuarios();

            if (!$usuarios) {
                echo json_encode([
                    "status" => 404,
                    "error" => "No se encontraron usuarios"
                ]);
                return;
            }

            echo json_encode([
                "status" => 200,
                "data" => $usuarios
                
            ]);
        }

        public function crear() {


            header('Content-Type: application/json');
            $validar = AuthApi::validar();

            $data = json_decode(file_get_contents("php://input"), true);

            if (!$data) {
                echo json_encode([
                    "status" => 400,
                    "error" => "Datos no enviados"
                ]);
                return;
            }

            $nombre = trim($data['nombre'] ?? '');
            $apellidos = trim($data['apellidos'] ?? '');
            $correo = trim($data['correo'] ?? '');
            $passwordPlano = trim($data['password'] ?? '');
            $rol = trim($data['rol'] ?? '');
            $status = 1;

            if (!$nombre || !$apellidos || !$correo || !$passwordPlano || !$rol) {
                echo json_encode([
                    "status" => 400,
                    "error" => "Todos los campos son obligatorios"
                ]);
                return;
            }

            if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
                echo json_encode([
                    "status" => 400,
                    "error" => "Correo inválido"
                ]);
                return;
            }

            $password = password_hash($passwordPlano, PASSWORD_DEFAULT);

            $crear = UsuariosModel::crearUsuario(
                $nombre,
                $apellidos,
                $correo,
                $password,
                $status,
                $rol
            );

            if (!$crear) {
                echo json_encode([
                    "status" => 500,
                    "error" => "No se pudo registrar"
                ]);
                return;
            }

            echo json_encode([
                "status" => 200,
                "message" => "Usuario registrado correctamente"
            ]);
        }

         
        public function mostrarId($id_cliente) {
            header('Content-Type: application/json');
            
            $lista= UsuariosModel::mostrarUsuarioId($id_cliente);
            $campos = [
                'nombre' => ['label'=>'Nombre','type'=>'text'],
                'apellidos' => ['label'=>'Apellidos','type'=>'text'],
                'correo' => ['label'=>'Correo electronico','type'=>'text'],
                'password' => ['label'=>'Contraseña','type'=>'password'],
                'rol' => ['label'=>'Rol','type'=>'text'],
               
            ];

            echo json_encode([
                "status" => 200,
                "campos" => $campos,
                "lista" => $lista
            ]);
        }
        
        public function eliminar(){
            header('Content-Type: application/json');
            $validar = AuthApi::validar();

            $data = json_decode(file_get_contents("php://input"), true);

            $id = $data['id'];
            $eliminar= UsuariosModel::eliminarUsuario($id);
            header('Content-Type: application/json');

            if (!$eliminar) {
                echo json_encode([
                    "status" => 500,
                    "error" => "No se pudo eliminar"
                ]);
                return;
            }
          
            echo json_encode([
                "status" => "200"]
            );
            
        }

        // public function editar($id){
        //     header('Content-Type: application/json');
        //     $validar = AuthApi::validar();
        //     $data = json_decode(file_get_contents("php://input"), true);

        //     // if(
        //     //     !isset($data["id_cliente"]) ||
        //     //     !isset($data["nombre"]) ||
        //     //     !isset($data["apellidos"]) ||
        //     //     !isset($data["correo"]) ||
        //     //     !isset($data["rol"])
        //     // ){
        //     //     echo json_encode([
        //     //         "status" => "error",
        //     //         "message" => "Faltan datos obligatorios"
        //     //     ]);
        //     //     return;
        //     // }

            
        //     $nombre = $data["nombre"];
        //     $apellidos = $data["apellidos"];
        //     $correo = $data["correo"];
        //     $password = $data["password"] ?? "";
        //     $rol = $data["rol"];

        //     $respuesta = UsuariosModel::editarUsuario(
        //         $id,
        //         $nombre,
        //         $apellidos,
        //         $correo,
        //         $password,
        //         $rol
        //     );

        //     if($respuesta){
        //         echo json_encode([
        //             "status" => 200,
        //             "message" => "Cliente actualizado correctamente"
        //         ]);
        //     }else{
        //         echo json_encode([
        //             "status" => 500,
        //             "message" => "No se pudo actualizar el cliente"
        //         ]);
        //     }
        // }
        public function editar($id){
            header('Content-Type: application/json');

            $validar = AuthApi::validar();

            $data = json_decode(file_get_contents("php://input"), true);

            if (!$data) {
                echo json_encode([
                    "status" => 400,
                    "error" => "Datos no enviados"
                ]);
                return;
            }

            $nombre = $data["nombre"];
            $apellidos = $data["apellidos"];
            $correo = $data["correo"];
            $password = $data["password"] ?? "";
            $rol = $data["rol"];
            $updated_by= $_SESSION['id_usuario'];

            $respuesta = UsuariosModel::editarUsuario(
                $id, $nombre, $apellidos, $correo, $password, $rol,$updated_by
            );

            if($respuesta){
                echo json_encode([
                    "status" => 200,
                    "message" => "Usuario actualizado correctamente"
                ]);
            }else{
                echo json_encode([
                    "status" => 500,
                    "message" => "No se pudo actualizar el usuario"
                ]);
            }
        }
        
    }
?>