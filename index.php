<?php  
    session_start();
    require_once(__DIR__."/app/core/config.php");
    require_once (__DIR__."/app/core/Controller.php");
    
    require_once(__DIR__."/app/core/router.php");
    require_once(__DIR__."/app/models/conexion.php");

    $router = new Router();
    $router->run();