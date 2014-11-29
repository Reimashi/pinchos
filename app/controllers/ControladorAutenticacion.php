<?php
if (defined('PINCHOSFW'))
{
    require_once (SYSTEM_FOLDER . 'Controller.php');

    class ControladorAutenticacion extends Controller {
        /**
         * Metodo por defecto del controlador.
         */
        public function index ($params) {
            return autenticarUsuario($params);
        }

        /**
        * Autentica un usario en el sistema.
        */
        public function autenticarUsuario ($params) {
            trigger_error('Metodo no implementado.', E_USER_ERROR);
        }

        /**
        * Cierra la sesión de un usario en el sistema.
        */
        public function salirUsuario ($params) {
            trigger_error('Metodo no implementado.', E_USER_ERROR);
        }

        /**
        * Permite recuperar la contraseña de un usuario.
        */
        public function recuperarContrasenha ($params) {
            trigger_error('Metodo no implementado.', E_USER_ERROR);
        }

        /**
        * Permite validar los datos de autenticacion de un usario.
        */
        private function validarDatosAutenticacion ($usuario, $pass) {
            trigger_error('Metodo no implementado.', E_USER_ERROR);
        }
    };

}
else
{
    header("HTTP/1.0 404 Not Found");
}
?>
