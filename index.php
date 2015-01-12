<?php
    /*
     * Punto de entrada de la web. Todos las peticiones a la web pasan por aquí
     */

    // Constante global para asegurar el paso por index
    define("PINCHOSFW", true);

    // Constantes globales para control de rutas y enlaces
    $rootpath = pathinfo($_SERVER['SCRIPT_FILENAME']);
    $rootfpath = pathinfo($_SERVER['SCRIPT_NAME']);
    $httpprotocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] ? 'https://' : 'http://';

    $count = 1;
    $rootxpath = str_replace(pathinfo($_SERVER['SCRIPT_NAME'])['dirname'], "", pathinfo($_SERVER['SCRIPT_FILENAME'])['dirname'], $count);
    $count = 1;
    $godpath = str_replace($rootxpath, "", pathinfo($_SERVER['SCRIPT_FILENAME'])['dirname'], $count);

    define ("BASE_PATH", $godpath);
    define ("APP_FOLDER", $rootpath['dirname'] . "/app/");
    define ("SYSTEM_FOLDER", $rootpath['dirname'] . "/system/");
    define ("SITE_URL", $httpprotocol . $_SERVER['HTTP_HOST'] . (($rootfpath['dirname'] != '\\') ? $rootfpath['dirname'] : ''));
    define ("RESOURCES_URL", SITE_URL . '/app/static/');

    // Iniciamos la sesion PHP
    if (!session_start()) {
        trigger_error('Ha ocurrido un error al iniciar sesión. La aplicación no funcionará correctamente.', E_USER_ERROR);
    }

    // Cargamos el router
    require_once (SYSTEM_FOLDER . 'Router.php');
    $router = new Router();
    $router->handle();
?>
