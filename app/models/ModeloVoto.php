<?php
if (defined('PINCHOSFW'))
{
    require_once (SYSTEM_FOLDER . 'Model.php');

    class ModeloVoto extends Model {
        /**
        * Registra un voto en la base de datos.
        */
        public function registrarVoto ($voto) {
            trigger_error('Metodo no implementado.', E_USER_ERROR);
        }

        /**
        * Cuenta los votos registrados en la base de datos de un pincho.
        */
        public function contarVotos ($idpincho) {
            trigger_error('Metodo no implementado.', E_USER_ERROR);
        }
    };

}
else
{
    header("HTTP/1.0 404 Not Found");
}
?>
