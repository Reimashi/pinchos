<?php
    // Constante global para asegurar el paso por index
    define("PINCHOSFW", true);

    // Constantes globales para control de rutas y enlaces
    $rootpath = pathinfo($_SERVER['SCRIPT_FILENAME']);
    $httpprotocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] ? 'https://' : 'http://';

    define ("BASE_PATH", basename($rootpath['dirname']));
    define ("APP_FOLDER", realpath(dirname(BASE_PATH)) . "/app/");
    define ("SYSTEM_FOLDER", realpath(dirname(BASE_PATH)) . "/system/");
    define ("SITE_URL", $httpprotocol . $_SERVER['HTTP_HOST'] .'/'. BASE_PATH);

    // Cargamos el router
    require_once (SYSTEM_FOLDER . 'Router.php');
    $router = new Router();
    $router->handle();
?>
