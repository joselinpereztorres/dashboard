<?php 
require_once(__DIR__ . '/../../models/muestras.models.php');
require_once(__DIR__ . '/../../core/authApi.php');

    class MuestrasController extends Controller {

        public function mostrar() {

            header('Content-Type: application/json');

            $muestras = MuestrasModel::mostrarMuestras();

            if (!$muestras) {
                echo json_encode([
                    "status" => 404,
                    "error" => "No se encontraron muestras"
                ]);
                return;
            }

            echo json_encode([
                "status" => 200,
                "data" => $muestras
                
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
            $id_proyecto=trim($data['id_proyecto'] ?? '');
            $codigo=trim($data['codigo'] ?? '');
            $fecha_inicio =trim($data['fecha_inicio'] ?? '');
            $fecha_fin=trim($data['fecha_fin'] ?? '');
            $prioridad =trim($data['prioridad'] ?? '');
            $observaciones=trim($data['observaciones'] ?? '');
            $estado =trim($data['estado'] ?? '');
            $horas_estimadas=trim($data['horas_estimadas'] ?? '');
            $created_by= $_SESSION['id_usuario'];
            $updated_by=$_SESSION['id_usuario'];

            

            if (!$id_proyecto || !$codigo || !$fecha_inicio || !$fecha_fin || !$prioridad || !$observaciones  || !$estado  || !$horas_estimadas) {
                echo json_encode([
                    "status" => 400,
                    "error" => "Todos los campos son obligatorios"
                ]);
                return;
            }


            $crear = MuestrasModel::crearMuestra(
                $id_proyecto,$codigo, $fecha_inicio , $fecha_fin, $prioridad , $observaciones, $estado ,$horas_estimadas,$created_by,$updated_by
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

        public function mostrarId($id) {
            header('Content-Type: application/json');

            $lista= MuestrasModel::mostrarMuestraId($id);
            $campos = [
                
                'codigo' => ['label'=>'Codigo','type'=>'text'],
                'fecha_inicio' => ['label'=>'Fecha de inicio','type'=>'date'],
                'fecha_fin' => ['label'=>'Fecha de fin','type'=>'date'],
                'prioridad' => ['label'=>'Prioridad','type'=>'text'],
                'observaciones' => ['label'=>'Observaciones','type'=>'text'],
                'estado' => ['label'=>'Estado','type'=>'text']
               
               
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
            $eliminar= MuestrasModel::eliminarMuestra($id);
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


            $codigo = $data["codigo"];
            $fecha_inicio = $data["fecha_inicio"];
            $fecha_fin = $data["fecha_fin"];
            $prioridad = $data["prioridad"];
            $observaciones = $data["observaciones"];
            $estado = $data["estado"];
            $updated_by= $_SESSION['id_usuario'];

            $respuesta = MuestrasModel::editarMuestra(
                $id,$codigo, $fecha_inicio, $fecha_fin, $prioridad,$observaciones,$estado, $updated_by
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

        public function agregarResultado() {


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
            $id_muestra=trim($data['id_muestra'] ?? '');
            $resultado=trim($data['resultado'] ?? '');
            $fecha =trim($data['fecha'] ?? '');
            $observaciones=trim($data['observaciones'] ?? '');
            $id_usuario=$_SESSION['id_usuario'];

            

            if (!$id_muestra || !$resultado || !$fecha || !$observaciones || !$id_usuario ) {
                echo json_encode([
                    "status" => 400,
                    "error" => "Todos los campos son obligatorios"
                ]);
                return;
            }


            $crear = MuestrasModel::addResultado(
                $id_muestra, $resultado , $fecha, $observaciones , $id_usuario
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
                "message" => "Muestra registrado correctamente"
            ]);
        }

        
        // public static function mostrarPaginacion(){

        //     $pagina = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
        //     $limite = isset($_GET["limit"]) ? (int)$_GET["limit"] : 5;

        //     if($pagina < 1){
        //         $pagina = 1;
        //     }

        //     $data = MuestrasModel::mostrarMuestrasPaginadas($pagina, $limite);
        //     $total = MuestrasModel::totalMuestras();

        //     $totalRegistros = (int)$total["total"];
        //     $totalPaginas = ceil($totalRegistros / $limite);

        //     echo json_encode([
        //         "status" => 200,
        //         "data" => $data,
        //         "pagination" => [
        //             "current_page" => $pagina,
        //             "per_page" => $limite,
        //             "total_records" => $totalRegistros,
        //             "total_pages" => $totalPaginas
        //         ]
        //     ]);
        // }

       
    }
?>

