<?php
if (defined('PINCHOSFW'))
{
    require_once (SYSTEM_FOLDER . 'Controller.php');

    class ControladorUsuario extends Controller {
        /**
        * Metodo por defecto del controlador.
        */
        public function index ($params) {
            return obtenerUsuario($params);
        }

        /**
         * Registra un nuevo usuario en el sistema.
         */
        public function registrarUsuario ($params) {
            $configvista = array('body-containers' => array());

            if (!isset($params['form']) && $params['form'] = '') {
            }
            $this->render('FormularioRegistrar', null, true);

            $this->render('Principal', $configvista);
        }

        /**
        * Registra un nuevo usuario en el sistema.
        */
        public function borrarUsuario ($params) {
            trigger_error('Metodo no implementado.', E_USER_ERROR);
        }

        /**
        * Obtiene y muestra un usuario del sistema.
        */
        public function obtenerUsuario ($params) {
            trigger_error('Metodo no implementado.', E_USER_ERROR);
        }

        /**
        * Obtiene y muestra un usuario del sistema.
        */
        private function validarDatosUsuario ($usuario) {
            trigger_error('Metodo no implementado.', E_USER_ERROR);
        }
    };

}
else
{
    header("HTTP/1.0 404 Not Found");
}
?>
