<?php
if (defined('PINCHOSFW'))
{
    /**
     * Clase que representa una plantilla o template.
     */
    class Template
    {
        private $viewfile;

        public function __construct($name) {
            $vfile = APP_FOLDER . "views/" . $name . '.php';

            if (file_exists($vfile)) {
                $this->viewfile = $vfile;
            }
            else {
                trigger_error('No se ha encontrado la vista indicado en (' . $vfile . ')', E_USER_ERROR);
            }
        }

        /**
         * Metodo que renderiza la plantilla.
         * @param array $params Parametros que recibe la plantilla.
         * @param bool $rethtml Indica si el codigo resultante se debe retornar como variable o debe ser escrito en el buffer de salida.
         */
        public function render($params = array(), $rethtml = false) {
            if (!is_array($params)) {
                trigger_error('La variable \$params debe ser de tipo array. Tipo recibido: (' . gettype($params) . ').', E_USER_WARNING);
                $params = array();
            }

            ob_start();

            require($this->viewfile);

            $code = ob_get_contents();
            ob_end_clean();

            // Cargamos subvistas
            $subviews = array();
            $code = preg_replace_callback('/\{\{\{(.*)\}\}\}/', function($match) use ($params, $subviews) {
                $viewname = trim($match[0], " \t\n\r\0\x0B{}");

                if (!isset($subviews[$viewname])) {
                    $subviews[$viewname] = new Template($viewname);
                }
                return $subviews[$viewname]->render($params, true);
            }, $code);


            if ($rethtml) return $code;
            else echo $code;
        }
    };
}
else
{
    header("HTTP/1.0 404 Not Found");
}
?>
