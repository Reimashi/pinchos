<?php
if (defined('PINCHOSFW'))
{
    require_once (SYSTEM_FOLDER . 'Controller.php');

    class ControladorBuscarInformacion extends Controller {
        /**
        * Metodo por defecto del controlador.
        */
        public function index ($params) {
            return buscarInformacion($params);
        }

        /**
        * Busca informacion a partir de un string en el sistema.
        */
        public function buscarInformacion ($params) {
            trigger_error('Metodo no implementado.', E_USER_ERROR);
        }

        /**
        * Muestra la agenda de un concurso.
        */
        public function obtenerAgenda ($params) {
            trigger_error('Metodo no implementado.', E_USER_ERROR);


            
        }

        /**
        * Obtiene las localizaciones de los pinchos de un concurso.
        */
        public function obtenerLocalizaciones ($params) {
            trigger_error('Metodo no implementado.', E_USER_ERROR);
        }

        /**
        * Obtiene las bases de un concurso.
        */
        private function obtenerBases ($params) {
            trigger_error('Metodo no implementado.', E_USER_ERROR);
        }

        /**
        * Obtiene la lista de premios de un concurso.
        */
        private function obtenerPremios ($params) {
            trigger_error('Metodo no implementado.', E_USER_ERROR);
        }
    };

}
else
{
    header("HTTP/1.0 404 Not Found");
}
?>
