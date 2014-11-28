<?php
    /*
     * Punto de entrada de la web. Todos las peticiones a la web pasan por aquí
     */

    // Constante global para asegurar el paso por index
    define("PINCHOSFW", true);

    // Constantes globales para control de rutas y enlaces
    $rootpath = pathinfo($_SERVER['SCRIPT_FILENAME']);
    $httpprotocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] ? 'https://' : 'http://';

    define ("BASE_PATH", basename($rootpath['dirname']));
    define ("APP_FOLDER", realpath(dirname(BASE_PATH)) . "/app/");
    define ("SYSTEM_FOLDER", realpath(dirname(BASE_PATH)) . "/system/");
    define ("SITE_URL", $httpprotocol . $_SERVER['HTTP_HOST'] .'/'. BASE_PATH);
    define ("RESOURCES_URL", SITE_URL . '/app/static/');

    // Cargamos el router
    require_once (SYSTEM_FOLDER . 'Router.php');
    $router = new Router();
    $router->handle();
?>
