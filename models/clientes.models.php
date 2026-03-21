<?php
    

    class ClientesModel {

    public static function crearCliente($id_admin,$nombre, $apePaterno, $apeMaterno, $tel, $fecha_nac, $tel_emer,$status,$num_visitas){

        $stmt = InstallModel::conexion()->prepare(
            "INSERT into clientes (id_admin, nombre, apellido_pat, apellido_mat, telefono, fecha_nacimiento, tel_emergencia,status,num_visitas) VALUES (?, ?, ?, ?, ?, ?, ?,?,?)");

        return $stmt->execute([
            $id_admin,
            $nombre,
            $apePaterno,
            $apeMaterno,
            $tel,
            $fecha_nac,
            $tel_emer,
            $status,
            $num_visitas
        ]);

    }

    public static function mostrarRegistro(){
      

        $stmt = InstallModel::conexion()->prepare("SELECT * FROM clientes" );

        $stmt->execute();
        $clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $clientes;
        
    }

    public static function mostrarCliente($id){
      

        $stmt = InstallModel::conexion()->prepare("SELECT * FROM clientes where id_cliente = :id");

        $stmt->bindParam(":id", $id, PDO::PARAM_INT);

        $stmt->execute();
        $clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $clientes;
        
    }

    public static function editarCliente($id_cliente, $id_admin, $nombre, $apellido_pat, $apellido_mat, $telefono, $fecha_nacimiento, $tel_emergencia){
        
        $stmt = InstallModel::conexion()->prepare("UPDATE clientes
                SET nombre = :nombre,
                    apellido_pat = :apellido_pat,
                    apellido_mat = :apellido_mat,
                    telefono = :telefono,
                    fecha_nacimiento = :fecha_nacimiento,
                    tel_emergencia = :tel_emergencia
                WHERE id_cliente = :id_cliente
                AND id_admin = :id_admin");

  

        $stmt->bindValue(':nombre', $nombre);
        $stmt->bindValue(':apellido_pat', $apellido_pat);
        $stmt->bindValue(':apellido_mat', $apellido_mat);
        $stmt->bindValue(':telefono', $telefono);
        $stmt->bindValue(':fecha_nacimiento', $fecha_nacimiento);
        $stmt->bindValue(':tel_emergencia', $tel_emergencia);
        $stmt->bindValue(':id_cliente', $id_cliente, PDO::PARAM_INT);
        $stmt->bindValue(':id_admin', $id_admin, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public static function eliminarCliente($id_cliente, $id_admin){
      

        $stmt = InstallModel::conexion()->prepare("DELETE FROM clientes WHERE id_cliente = :id_cliente AND id_admin = :id_admin");

        $stmt->bindParam(":id_cliente", $id_cliente, PDO::PARAM_INT);
        $stmt->bindValue(':id_admin', $id_admin, PDO::PARAM_INT);
        return $stmt->execute();;
        
    }

}
?>