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
                $conf = $this->get_route($_SERVER["REQUEST_URI"]);

                if (file_exists(APP_FOLDER . 'config/Common.php') &&
                    file_exists(APP_FOLDER . 'config/Database.php')) {
                    $this->controller = $conf['controller'];
                    $this->action = $conf['action'];
                    $this->params = $conf['params'];
                }
                else {
                    define('INSTALL_MODE', true);
                    $this->controller = 'Instalador';
                    $this->action = 'install';
                    $this->params = $conf['params'];
                }
            }
            else {
                trigger_error('El router no ha podido establecer la ruta.', E_USER_ERROR);
            }
        }

        private function get_route($uripath) {
            $routeinfo = array();
            
            // Limpiamos la URL
            if (strrpos($uripath, BASE_PATH) !== FALSE) {
                $count = 1;
                $uripath = str_replace(BASE_PATH, "", $uripath, $count);
            }


            if (strrpos($uripath, "index.php") !== FALSE) {
                $count = 1;
                $uripath = str_replace("index.php", "", $uripath, $count);
            }


            if (strrpos($uripath, "?") !== FALSE) {
                $uripath = substr($uripath, 0, strrpos($uripath, "?"));
            }

            // Obtenemos los path's
            $path = explode("/", trim($uripath, "/"));

            if (isset($path[0]) && $path[0] != "") {
                $routeinfo['controller'] = $path[0];
            }
            else {
                $routeinfo['controller'] = $this->config->default_controller;
            }

            if (isset($path[1]) && $path[1] != "") {
                $routeinfo['action'] = strtolower($path[1]);
            }
            else {
                $routeinfo['action'] = 'index';
            }

            // Establecemos los parametros
            $routeinfo['params'] = (isset($_GET) && is_array($_GET)) ? $_GET : array();
            $routeinfo['params']['post'] = (isset($_POST) && is_array($_POST)) ? $_POST : array();

            if (count($path) > 2) {
                $routeinfo['params'] = array_merge($routeinfo['params'], array_slice($path, 2));
            }

            return $routeinfo;
        }

        /**
         * Metodo que ejecuta el controlador correspondiente a la ruta recibida.
         */
        public function handle() {
            $controllername = 'Controlador' . ucfirst(strtolower($this->controller));
            $controllerfile = APP_FOLDER . "controllers/" . $controllername . '.php';

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
