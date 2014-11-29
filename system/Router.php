<?php
if (defined('PINCHOSFW'))
{
    require_once (SYSTEM_FOLDER . 'Configuration.php');

    /**
     * Enrutador MVC. Recibe las peticiones de la web y las encamina al controlador que le corresponde.
     */
    class Router
    {
        private $config;
        private $controller;
        private $action;
        private $params;

        public function __construct() {
            $this->config = Configuration::getInstance();

            if (isset($_SERVER["REQUEST_URI"])) {
                $uripath = $_SERVER["REQUEST_URI"];

                // Limpiamos la URL
                if (strrpos($uripath, BASE_PATH)) {
                    $count = 1;
                    $uripath = str_replace(BASE_PATH, "", $uripath, $count);
                }

                if (strrpos($uripath, "index.php")) {
                    $count = 1;
                    $uripath = str_replace("index.php", "", $uripath, $count);
                }

                if (strrpos($uripath, "?")) {
                    $uripath = substr($uripath, 0, strrpos($uripath, "?"));
                }

                // Obtenemos los path's
                $path = explode("/", trim($uripath, "/"));

                if (isset($path[0]) && $path[0] != "") {
                    $this->controller = $path[0];
                }
                else {
                    $this->controller = $this->config->default_controller;
                }

                if (isset($path[1]) && $path[1] != "") {
                    $this->action = strtolower($path[1]);
                }
                else {
                    $this->action = 'index';
                }

                // Establecemos los parametros
                $this->params = (isset($_GET) && is_array($_GET)) ? $_GET : array();

                if (count($path) > 2) {
                    $this->params = array_merge($this->params, array_slice($path, 2));
                }
            }
            else {
                trigger_error('El router no ha podido establecer la ruta.', E_USER_ERROR);
            }
        }

        /**
         * Metodo que ejecuta el controlador correspondiente a la ruta recibida.
         */
        public function handle() {
            $controllername = ucfirst(strtolower($this->controller));
            $controllerfile = APP_FOLDER . "controllers/" . $controllername . '.php';
            $controllername = $controllername . 'Controller';

            if (file_exists($controllerfile)) {
                require_once($controllerfile);

                if (class_exists($controllername) &&
                    is_subclass_of($controllername, 'Controller'))
                {
                    if (method_exists($controllername, $this->action))
                    {
                        $minstance = new $controllername();
                        $mmethod = $this->action;
                        $minstance->$mmethod($this->params);
                        return TRUE;
                    }
                    else
                    {
                        trigger_error('El controlador indicado no posee un metodo (' . $this->action . ')', E_USER_ERROR);
                        return FALSE;
                    }
                }
                else
                {
                    trigger_error('No existe un controlador llamado (' . $controllername . ') o no hereda de Controller.', E_USER_ERROR);
                    return FALSE;
                }
            }
            else
            {
                trigger_error('No se ha encontrado el controlador indicado en (' . $controllerfile . ')', E_USER_ERROR);
                return FALSE;
            }
        }
    };

}
else
{
    header("HTTP/1.0 404 Not Found");
}
?>
