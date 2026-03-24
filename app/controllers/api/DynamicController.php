<?php 
require_once(__DIR__ . '/../../models/dynamic.models.php');
require_once(__DIR__ . '/../../core/authApi.php');

class DynamicController extends Controller {

    public function agregarElementos() {

        header('Content-Type: application/json');

        $data = json_decode(file_get_contents("php://input"), true);
        $tabla = $data['tabla'] ?? null;

        if (!$tabla) {
            echo json_encode([
                "status" => 400,
                "error" => "Tabla no enviada"
            ]);
            return;
        }

        $columnas = DynamicModel::getDatos($tabla);
        $prioridades = DynamicModel::getPrioridades();
        $estados = DynamicModel::getEstados();

        if (!$columnas) {
            echo json_encode([
                "status" => 404,
                "error" => "No se encontraron columnas o la tabla no está permitida"
            ]);
            return;
        }

        echo json_encode([
            "status" => 200,
            "col" => $columnas,
            "prioridades" => $prioridades,
            "estados" => $estados
        ]);
    }
}
?>