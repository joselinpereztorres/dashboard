<?php
    

    class ClientesModel {

    public static function crearCliente($nombre, $correo, $telefono, $ubicacion, $status, $created_by,$updated_by){

        $stmt = InstallModel::conexion()->prepare(
            "INSERT into clientes (nombre, correo, telefono, ubicacion, status, created_by, updated_by) VALUES (?, ?, ?, ?, ?, ?, ?)");

        return $stmt->execute([
            $nombre, $correo, $telefono, $ubicacion, $status, $created_by,$updated_by
        ]);

    }

    public static function mostrarCliente(){
      

        $stmt = InstallModel::conexion()->prepare(
            "SELECT 
                c.id_cliente,
                c.nombre, c.correo,c.telefono,c.ubicacion,
                COUNT(DISTINCT p.id_proyecto) AS total_proyectos,
                COUNT(m.id_muestra) AS total_muestras
            FROM clientes c
            LEFT JOIN proyectos p 
                ON c.id_cliente = p.id_cliente
            LEFT JOIN muestras m 
                ON p.id_proyecto = m.id_proyecto
            GROUP BY c.id_cliente, c.nombre;" );

        $stmt->execute();
        $clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $clientes;
        
    }

    public static function mostrarClienteId($id){
      

        $stmt = InstallModel::conexion()->prepare("SELECT * FROM clientes where id_cliente = :id");

        $stmt->bindParam(":id", $id, PDO::PARAM_INT);

        $stmt->execute();
        $clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $clientes;
        
    }

    public static function editarCliente($id_cliente,$nombre, $correo, $telefono, $ubicacion, $updated_by){
        
        $stmt = InstallModel::conexion()->prepare("UPDATE clientes
                SET nombre = :nombre,
                    correo = :correo,
                    telefono = :telefono,
                    ubicacion = :ubicacion,
                    updated_at = NOW(),
                    updated_by = :updated_by

                WHERE id_cliente = :id_cliente");

  
        $stmt->bindValue(':id_cliente', $id_cliente);
        $stmt->bindValue(':nombre', $nombre);
        $stmt->bindValue(':correo', $correo);
        $stmt->bindValue(':telefono', $telefono);
        $stmt->bindValue(':ubicacion', $ubicacion);
        $stmt->bindValue(':updated_by', $updated_by);
       
        return $stmt->execute();
    }

    public static function eliminarCliente($id_cliente){
      
        $stmt = InstallModel::conexion()->prepare("DELETE FROM clientes WHERE id_cliente = :id_cliente");

        $stmt->bindParam(":id_cliente", $id_cliente, PDO::PARAM_INT);
       
        return $stmt->execute();;
        
    }

 
}
?>