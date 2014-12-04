<?php
if (defined('PINCHOSFW'))
{
    require_once (SYSTEM_FOLDER . 'Configuration.php');
    require_once (SYSTEM_FOLDER . 'Template.php');
    require_once (SYSTEM_FOLDER . 'User.php');

    /**
     * Clase abstracta a heredar por todos los controladores.
     * Provee al controlador que lo herede de ciertas funcionalidades y metodos abreviados.
     */
    abstract class Controller
    {
        /** Instancia de la clase Configuration */
        protected $config;
        /** Array de modelos instanciados */
        protected $models;
        /** Instancia de la clase User */
        protected $user;

        function __construct() {
            $this->config = Configuration::getInstance();
            $this->user = User::getInstance();
        }

        /**
         * Metodo abreviado para cargar una plantilla desde el controlador.
         * @param string $name Nombre de la plantilla a cargar.
         * @param array $params Parametros que recibe la plantilla.
         * @param bool $rethtml Indica si el codigo resultante se debe retornar como variable o debe ser escrito en el buffer de salida.
         */
        protected function render ($name, $params = array(), $return = false) {
            $params = ($params == null) ? array() : $params;

            if (!is_array($params)) {
                trigger_error('La variable \$params debe ser de tipo array. Tipo recibido: (' . gettype($params) . ').', E_USER_WARNING);
                $params = array();
            }

            $template = new Template($name);
            return $template->render(array_merge($params, array('user' => $this->user)), $return);
        }

        /**
        * Metodo para instanciar y guardar un modelo desde el controlador.
        * @param string $name Nombre del modelo a cargar.
        */
        protected function loadModel ($name) {
            if (isset($this->models[$name])) {
                return $this->models[$name];
            }
            else {
                $modelname = 'Modelo' . ucfirst(strtolower($name));
                $modelfile = APP_FOLDER . "models/" . $modelname . '.php';

                if (file_exists($modelfile)) {
                    require_once($modelfile);

                    if (class_exists($modelname) &&
                        is_subclass_of($modelname, 'Model'))
                    {
                        $this->models[$name] = new $modelname();
                        return $this->models[$name];
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
