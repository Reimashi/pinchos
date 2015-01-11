<?php
if (defined('PINCHOSFW'))
{
    require_once (SYSTEM_FOLDER . 'Controller.php');

    class ControladorInstalador extends Controller {
        /**
        * Metodo por defecto del controlador.
        */
        private function index ($params) {
        }

        public function install ($params) {
            // Comprobacion de seguridad.
            if (!defined('INSTALL_MODE')) { header("HTTP/1.1 401 Unauthorized"); return; }

            echo 'Instalacion';
        }
    };
}
else
{
    header("HTTP/1.0 404 Not Found");
}
?>
