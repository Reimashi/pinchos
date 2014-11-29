<?php
if (defined('PINCHOSFW'))
{
    require_once (SYSTEM_FOLDER . 'Controller.php');

    class ControladorVotos extends Controller {
        /**
        * Metodo por defecto del controlador.
        */
        public function index ($params) {
            header("HTTP/1.0 404 Not Found");
        }

        /**
        * Emite un voto desde un usuario jurado publico.
        */
        public function emitirVotoPublico ($params) {
            trigger_error('Metodo no implementado.', E_USER_ERROR);
        }

        /**
        * Emite un voto desde un usuario jurado profesional.
        */
        private function emitirVotoProfesional ($params) {
            trigger_error('Metodo no implementado.', E_USER_ERROR);
        }

        /**
        * Valida los datos de un voto.
        */
        private function validarDatosVoto ($datos) {
            trigger_error('Metodo no implementado.', E_USER_ERROR);
        }
    };

}
else
{
    header("HTTP/1.0 404 Not Found");
}
?>
