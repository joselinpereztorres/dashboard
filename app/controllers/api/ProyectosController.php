<?php 
require_once(__DIR__ . '/../../models/proyectos.models.php');
require_once(__DIR__ . '/../../core/authApi.php');

    class ProyectosController extends Controller {

        public function mostrar() {

            header('Content-Type: application/json');

            $proyectos = ProyectosModel::mostrarProyecto();

            if (!$proyectos) {
                echo json_encode([
                    "status" => 404,
                    "error" => "No se encontraron proyectos"
                ]);
                return;
            }

            echo json_encode([
                "status" => 200,
                "data" => $proyectos
                
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

       
            $id_cliente=  trim($data['id_cliente'] ?? '');
            $nombre=   trim($data['nombre'] ?? '');
            $descripcion=   trim($data['descripcion'] ?? '');
            $fecha_inicio=   trim($data['fecha_inicio'] ?? '');
            $fecha_fin=   trim($data['fecha_fin'] ?? '');
            $status=  1;
            $created_by= $_SESSION['id_usuario'];
            $updated_by=$_SESSION['id_usuario'];

            if (!$id_cliente || !$nombre || !$descripcion || !$fecha_inicio || !$fecha_fin) {
                echo json_encode([
                    "status" => 400,
                    "error" => "Todos los campos son obligatorios"
                ]);
                return;
            }

            $crear = ProyectosModel::crearProyecto(
                $id_cliente,$nombre, $descripcion, $fecha_inicio, $fecha_fin, $status, $created_by,$updated_by
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
                "message" => "Proyecto registrado correctamente"
            ]);
        }

        public function mostrarId($id_proyecto) {
            header('Content-Type: application/json');

            $lista= ProyectosModel::mostrarProyectoId($id_proyecto);
            $campos = [
                'nombre' => ['label'=>'Nombre','type'=>'text'],
                'descripcion' => ['label'=>'Descripcion','type'=>'text'],
                'fecha_inicio' => ['label'=>'Fecha de inicio','type'=>'date'],
                'fecha_fin' => ['label'=>'Fecha de fin','type'=>'date'],
                
              
               
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
            $eliminar= ProyectosModel::eliminarProyecto($id);
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
            $descripcion = $data["descripcion"];
            $fecha_inicio = $data["fecha_inicio"];
            $fecha_fin = $data["fecha_fin"];
            $updated_by= $_SESSION['id_usuario'];

            $respuesta = ProyectosModel::editarProyecto(
                $id,$nombre, $descripcion, $fecha_inicio, $fecha_fin, $updated_by
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