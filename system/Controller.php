<?php
if (defined('PINCHOSFW'))
{
    require_once (SYSTEM_FOLDER . 'Configuration.php');

    abstract class Controller
    {
        protected $config;

        protected $models;

        function __construct() {
            $this->config = Configuration::getInstance();
        }

        protected function render ($name, $params, $return = false) {
            $viewfile = APP_FOLDER . "views/" . $name . '.html';
            $code = "";

            if (file_exists($viewfile)) {
                $code = file_get_contents ($viewfile);
                // Cargamos subvistas
                preg_replace('/{{{([A-z0-9]*)}}}/', $this->render(trim($1)), $code);
                // Cargamos variables
                preg_replace('/{{([A-z0-9]*)}}/', $params[trim($1)], $code);
            }

            if ($return) {
                return $code;
            }
            else {
                echo $code;
            }
        }

        protected function loadModel ($name) {
            if (isset($this->models->$name)) {
                return TRUE;
            }
            else {
                $modelname = ucfirst(strtolower($name));
                $modelfile = APP_FOLDER . "models/" . $modelname . '.php';

                if (file_exists($modelfile)) {
                    require_once($modelfile);

                    if (class_exists($modelname) &&
                        is_subclass_of($modelname, 'Model'))
                    {
                        $this->models->$modelname = new $modelname();
                        return TRUE;
                    }
                    else
                    {
                        trigger_error('No existe un modelo llamado (' . $modelname . ') o no hereda de Model.', E_USER_ERROR);
                        return FALSE;
                    }
                }
                else
                {
                    trigger_error('No se ha encontrado el modelo indicado en (' . $modelfile . ')', E_USER_ERROR);
                    return FALSE;
                }
            }
        }
    };
}
else
{
    header("HTTP/1.0 404 Not Found");
}
?>
