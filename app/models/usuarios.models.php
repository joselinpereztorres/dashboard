<?php
    

    class UsuariosModel {

        public static function mostrarUsuarios(){
        

            $stmt = InstallModel::conexion()->prepare("SELECT * FROM usuarios");

            $stmt->execute();
            $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $usuarios;
            
        }

        public static function crearUsuario($nombre, $apellidos, $correo, $password, $status, $rol){

            $stmt = InstallModel::conexion()->prepare(
                "INSERT into usuarios ( nombre, apellidos, correo, password, status, rol) VALUES (?, ?, ?, ?, ?, ?)");

            return $stmt->execute([
                $nombre,
                $apellidos,
                $correo,
                $password,
                $status,
                $rol
               
            ]);

        }
        
        public static function mostrarUsuarioId($id){

            $stmt = InstallModel::conexion()->prepare("SELECT * FROM usuarios where id_usuario = :id");

            $stmt->bindParam(":id", $id, PDO::PARAM_INT);

            $stmt->execute();
            $usuarioId = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $usuarioId;
            
        }

    
        public static function editarUsuario($id_usuario, $nombre, $apellidos, $correo, $password, $rol,$updated_by){

            if(!empty($password)){

                $stmt = InstallModel::conexion()->prepare(
                    "UPDATE usuarios
                    SET nombre = :nombre,
                        apellidos = :apellidos,
                        correo = :correo,
                        password = :password,
                        rol = :rol,
                        updated_at = NOW(),
                        updated_by = :updated_by
                        
                    WHERE id_usuario = :id_usuario
                ");

                $stmt->bindValue(':password', password_hash($password, PASSWORD_DEFAULT));

            } else {

                $stmt = InstallModel::conexion()->prepare(
                    "UPDATE usuarios
                    SET nombre = :nombre,
                        apellidos = :apellidos,
                        correo = :correo,
                        rol = :rol,
                        updated_at = NOW(),
                        updated_by = :updated_by
                        
                    WHERE id_usuario = :id_usuario
                ");
            }

            $stmt->bindValue(':id_usuario', $id_usuario);
            $stmt->bindValue(':nombre', $nombre);
            $stmt->bindValue(':apellidos', $apellidos);
            $stmt->bindValue(':correo', $correo);
            $stmt->bindValue(':rol', $rol);
            $stmt->bindValue(':updated_by', $updated_by);

            return $stmt->execute();
        }

        public static function eliminarUsuario($id_usuario){
      
            $stmt = InstallModel::conexion()->prepare("DELETE FROM usuarios WHERE id_usuario = :id_usuario");

            $stmt->bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);
        
            return $stmt->execute();;
            
        }

    }
?>