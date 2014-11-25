<?php
    // Constante global para asegurar el paso por index
    define("PINCHOSFW", true);

    // Constantes globales para control de rutas y enlaces
    $rootpath = pathinfo($_SERVER['SCRIPT_FILENAME']);
    $basepath = basename($rootpath['dirname']);
    $httpprotocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] ? 'https://' : 'http://';

    define ("APP_FOLDER", realpath(dirname(__DIR__)) . "/app/");
    define ("SYSTEM_FOLDER", realpath(dirname(__DIR__)) . "/system/");
    define ("SITE_URL", $httpprotocol . $_SERVER['HTTP_HOST'] .'/'. $basepath);

    // Cargamos el router
    $router = new Router();
    $router->handle();
?>
