<?php 
require_once(__DIR__ . '/../../models/clientes.models.php');
require_once(__DIR__ . '/../../core/authApi.php');

    class ClientesController extends Controller {

        public function mostrar() {

            header('Content-Type: application/json');

            $clientes = ClientesModel::mostrarCliente();

            if (!$clientes) {
                echo json_encode([
                    "status" => 404,
                    "error" => "No se encontraron clientes"
                ]);
                return;
            }

            echo json_encode([
                "status" => 200,
                "data" => $clientes
                
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

            $nombre=  trim($data['nombre'] ?? '');
            $correo=  trim($data['correo'] ?? '');
            $telefono=  trim($data['telefono'] ?? '');
            $ubicacion=  trim($data['ubicacion'] ?? '');
            $status= 1;
            $created_by= $_SESSION['id_usuario'];
            $updated_by=$_SESSION['id_usuario'];

            if (!$nombre || !$correo || !$telefono || !$ubicacion) {
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

         
            
            $crear = ClientesModel::crearCliente(
               $nombre, $correo, $telefono, $ubicacion, $status, $created_by,$updated_by
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
                "message" => "Cliente registrado correctamente"
            ]);
        }

        public function mostrarId($id_cliente) {
            header('Content-Type: application/json');

            $lista= ClientesModel::mostrarClienteId($id_cliente);
            $campos = [
                'nombre' => ['label'=>'Nombre','type'=>'text'],
                'correo' => ['label'=>'Correo electronico','type'=>'text'],
                'telefono' => ['label'=>'Telefono','type'=>'text'],
                'ubicacion' => ['label'=>'Ubicacion','type'=>'text'],
               
            ];

            echo json_encode([
                "status" => 200,
                "campos" => $campos,
                "lista" => $lista
            ]);
        }
        
        public function eliminar(){
            header('Content-Type: application/json');
            $data = json_decode(file_get_contents("php://input"), true);
            $id = $data['id'];
            $eliminar= ClientesModel::eliminarCliente($id);
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
            $correo = $data["correo"];
            $telefono = $data["telefono"];
            $ubicacion = $data["ubicacion"];
            $updated_by= $_SESSION['id_usuario'];

            $respuesta = ClientesModel::editarCliente(
                $id,$nombre, $correo, $telefono, $ubicacion, $updated_by
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