<?php
if (defined('PINCHOSFW'))
{
    require_once (SYSTEM_FOLDER . 'Model.php');

    class ModeloPinchos extends Model {
        /**
        * Registra un nuevo pincho en la base de datos.
        */
        public function registrarPincho ($pincho) {
            trigger_error('Metodo no implementado.', E_USER_ERROR);
        }

        /**
        * Valida un pincho y lo registra en la base de datos.
        */
        public function validarPincho ($idpincho) {
            trigger_error('Metodo no implementado.', E_USER_ERROR);
        }

        /**
        * Obtiene un pincho desde la base de datos.
        */
        public function obtenerPincho ($idpincho) {
            trigger_error('Metodo no implementado.', E_USER_ERROR);
        }

        /**
        * Comprueba si existe un pincho en la base de datos.
        */
        public function existePincho ($idpincho) {
            trigger_error('Metodo no implementado.', E_USER_ERROR);
        }

        /**
        * Obtiene la localización de todos los pinchos desde la base de datos.
        * FIXME: Creo que se le debe pasar el id de concurso, comprobadlo.
        */
        public function obtenerLocalizaciones () {
            trigger_error('Metodo no implementado.', E_USER_ERROR);
        }
    };

}
else
{
    header("HTTP/1.0 404 Not Found");
}
?>
