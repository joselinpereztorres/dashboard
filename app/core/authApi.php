<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class AuthApi {

    public static function validar(){

        $headers = getallheaders();

        if(!isset($headers['Authorization'])){
            self::error("Token requerido", 401);
        }

        $token = str_replace("Bearer ", "", $headers['Authorization']);

        try {
            $decoded = JWT::decode($token, new Key(JWT_SECRET, 'HS256'));
            return $decoded;

        } catch(Exception $e){
            self::error("Token inválido", 401);
        }
    }

    private static function error($msg, $code){
        http_response_code($code);
        echo json_encode([
            "status" => $code,
            "error" => $msg
        ]);
        exit;
    }
}