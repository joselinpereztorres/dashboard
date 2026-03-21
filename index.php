<?php  
    session_start();
    require_once(__DIR__."/core/config.php");
    require_once (__DIR__."/core/Controller.php");
    
    require_once(__DIR__."/core/router.php");
    require_once(__DIR__."/models/conexion.php");

    $router = new Router();
    $router->run();