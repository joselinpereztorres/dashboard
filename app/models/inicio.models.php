<?php
    

    class InicioModel {

        public static function obtenerMetricasMuestras() {

            $stmt = InstallModel::conexion()->prepare("
                SELECT 
                    COUNT(*) AS total,
                    SUM(estado = 'pendiente') AS pendientes,
                    SUM(estado = 'urgente' OR prioridad = 'urgente') AS urgentes,
                    SUM(created_at >= DATE_SUB(NOW(), INTERVAL 7 DAY)) AS recientes
                FROM muestras
            ");

            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        
    

}
?>

