<?php
if (defined('PINCHOSFW'))
{
    require_once (SYSTEM_FOLDER . 'Controller.php');

    class ControladorPincho extends Controller {
        /**
        * Metodo por defecto del controlador.
        */
        public function index ($params) {
            header("HTTP/1.0 404 Not Found");
        }

        /**
        * Registra un nuevo pincho en el sistema.
        */
        private function registrarPincho ($params) {
            trigger_error('Metodo no implementado.', E_USER_ERROR);
        }

        /**
        * Valida un pincho previamente registrado.
        */
        public function validarPincho ($params) {
            trigger_error('Metodo no implementado.', E_USER_ERROR);
        }

        /**
        * Valida negativamente un pincho previamente registrado.
        * FIXME: Aitor: Yo diria que sobra. En validarPincho se puede hacer todo.
        */
        private function denegarPincho ($params) {
            trigger_error('Metodo no implementado.', E_USER_ERROR);
        }

        /**
        * Genera codigos de un pincho previamente registrado.
        */
        public function generarCodigos ($longitud=10) {
            codigo = "";
            $caracteres="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
            $max=strlen($caracteres)-1;
            for($i=0;$i < $longitud;$i++)
              {
                $codigo.=$caracteres[mt_rand(0,$max)];
              }

            return $codigo;

        }
    };

}
else
{
    header("HTTP/1.0 404 Not Found");
}
?>
