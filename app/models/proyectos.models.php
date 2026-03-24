<?php
    

class ProyectosModel {

    public static function crearProyecto($id_cliente,$nombre, $descripcion, $fecha_inicio, $fecha_fin, $status, $created_by,$updated_by){

        $stmt = InstallModel::conexion()->prepare(
            "INSERT into proyectos (id_cliente, nombre, descripcion, fecha_inicio, fecha_fin, status, created_by,updated_by) VALUES (?, ?, ?, ?, ?, ?, ?,?)");

        return $stmt->execute([
            $id_cliente,$nombre, $descripcion, $fecha_inicio, $fecha_fin, $status, $created_by,$updated_by
        ]);

    }

    public static function mostrarProyecto(){
      

        $stmt = InstallModel::conexion()->prepare(
            "SELECT 
                p.id_proyecto,
                p.nombre,
                c.nombre AS cliente,
                p.fecha_inicio,
                p.status,
                COUNT(m.id_muestra) AS total_muestras
            FROM proyectos p
            LEFT JOIN clientes c 
                ON p.id_cliente = c.id_cliente
            LEFT JOIN muestras m 
                ON p.id_proyecto = m.id_proyecto
            GROUP BY p.id_proyecto;" );

        $stmt->execute();
        $proyecto = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $proyecto;
        
    }

    public static function mostrarProyectoId($id){
      

        $stmt = InstallModel::conexion()->prepare("SELECT * FROM proyectos where id_proyecto = :id");

        $stmt->bindParam(":id", $id, PDO::PARAM_INT);

        $stmt->execute();
        $proyecto = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $proyecto;
        
    }

    public static function editarProyecto($id_proyecto,$nombre, $descripcion, $fecha_inicio, $fecha_fin, $updated_by){
        
        $stmt = InstallModel::conexion()->prepare("UPDATE proyectos
                SET nombre = :nombre,
                    descripcion = :descripcion,
                    fecha_inicio = :fecha_inicio,
                    fecha_fin = :fecha_fin,
                    updated_at = NOW(),
                    updated_by = :updated_by

                WHERE id_cliente = :id_cliente");

  
        $stmt->bindValue(':id_cliente', $id_proyecto);
        $stmt->bindValue(':nombre', $nombre);
        $stmt->bindValue(':descripcion', $descripcion);
        $stmt->bindValue(':fecha_inicio', $fecha_inicio);
        $stmt->bindValue(':fecha_fin', $fecha_fin);
        $stmt->bindValue(':updated_by', $updated_by);
       
        return $stmt->execute();
    }

    public static function eliminarProyecto($id_proyecto){
      
        $stmt = InstallModel::conexion()->prepare("DELETE FROM proyectos WHERE id_proyecto = :id_proyecto");

        $stmt->bindParam(":id_proyecto", $id_proyecto, PDO::PARAM_INT);
    
        return $stmt->execute();;
        
    }


}
?>