<?php

    class LoginModel {

    public static function login($email){

        $stmt = InstallModel::conexion()->prepare(
            "SELECT *
            FROM usuarios
            WHERE correo = :correo
            LIMIT 1"
        );
        $stmt->bindParam(":correo", $email, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?> 