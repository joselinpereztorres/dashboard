<?php
    

    class MuestrasModel {

    public static function crearMuestra($id_proyecto,$codigo, $fecha_inicio , $fecha_fin, $prioridad , $observaciones, $estado ,$horas_estimadas,$created_by,$updated_by ){

        $stmt = InstallModel::conexion()->prepare(
            "INSERT into muestras (id_proyecto, codigo, fecha_inicio, fecha_fin, prioridad, observaciones, estado,horas_estimadas,created_by,updated_by) VALUES (?, ?, ?, ?, ?, ?, ?,?,?,?)");

        return $stmt->execute([
            $id_proyecto,$codigo, $fecha_inicio , $fecha_fin, $prioridad , $observaciones, $estado ,$horas_estimadas,$created_by,$updated_by
        ]);

    }

    public static function mostrarMuestras(){

        $stmt = InstallModel::conexion()->prepare(
            "SELECT 
                m.id_muestra,
                m.codigo,
                c.nombre AS cliente,
                p.nombre AS proyecto,
                m.fecha_inicio AS fecha_recibo,
                m.prioridad,
                m.horas_estimadas,
                m.estado AS status,
                COALESCE(r.resultado, 'Sin resultado') AS resultado
            FROM muestras m
            LEFT JOIN proyectos p 
                ON m.id_proyecto = p.id_proyecto
            LEFT JOIN clientes c 
                ON p.id_cliente = c.id_cliente
            LEFT JOIN resultados r 
                ON m.id_muestra = r.id_muestra
            ORDER BY m.id_muestra ASC;" );

        $stmt->execute();
        $muestra = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $muestra;
        
    }

    public static function mostrarMuestraId($id){
      

        $stmt = InstallModel::conexion()->prepare("SELECT * FROM muestras where id_muestra = :id");

        $stmt->bindParam(":id", $id, PDO::PARAM_INT);

        $stmt->execute();
        $muestras = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $muestras;
        
    }

    public static function editarMuestra($id_muestra,$codigo, $fecha_inicio, $fecha_fin, $prioridad,$observaciones,$estado, $updated_by){
        
        $stmt = InstallModel::conexion()->prepare("UPDATE muestras
                SET codigo = :codigo,
                    fecha_inicio = :fecha_inicio,
                    fecha_fin = :fecha_fin,
                    prioridad = :prioridad,
                    observaciones = :observaciones,
                    estado = :estado,
                    updated_at = NOW(),
                    updated_by = :updated_by

                WHERE id_muestra = :id_muestra");

  
        $stmt->bindValue(':id_muestra', $id_muestra);
        $stmt->bindValue(':codigo', $codigo);
        $stmt->bindValue(':fecha_inicio', $fecha_inicio);
        $stmt->bindValue(':fecha_fin', $fecha_fin);
        $stmt->bindValue(':prioridad', $prioridad);
        $stmt->bindValue(':observaciones', $observaciones);
        $stmt->bindValue(':estado', $estado);
        $stmt->bindValue(':updated_by', $updated_by);
       
        return $stmt->execute();
    }

    public static function eliminarMuestra($id_muestra){
    
        $stmt = InstallModel::conexion()->prepare("DELETE FROM muestras WHERE id_muestra = :id_muestra");

        $stmt->bindParam(":id_muestra", $id_muestra, PDO::PARAM_INT);
    
        return $stmt->execute();;
        
    }


}
?>

