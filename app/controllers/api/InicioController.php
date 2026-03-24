<?php 
require_once(__DIR__ . '/../../models/inicio.models.php');
require_once(__DIR__ . '/../../core/authApi.php');

    class InicioController extends Controller {

        public function metricas() {

            header('Content-Type: application/json');

            $metricas = InicioModel::obtenerMetricasMuestras();

            if (!$metricas) {
                echo json_encode([
                    "status" => 404,
                    "error" => "No se pudieron obtener las métricas"
                ]);
                return;
            }

            echo json_encode([
                "status" => 200,
                "data" => [
                    "pendientes" => (int)$metricas["pendientes"],
                    "urgentes" => (int)$metricas["urgentes"],
                    "total" => (int)$metricas["total"],
                    "recientes" => (int)$metricas["recientes"]
                ]
            ]);
        }

       
    }
?>

