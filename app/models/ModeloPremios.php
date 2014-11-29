<?php
if (defined('PINCHOSFW'))
{
    require_once (SYSTEM_FOLDER . 'Model.php');

    class ModeloConcurso extends Model {
        /**
        * Consulta los premios de un concurso en la base de datos.
        */
        public function consultarPremios ($idconcurso) {
            trigger_error('Metodo no implementado.', E_USER_ERROR);
        }

        /**
        * Consulta la información de un premio en la base de datos.
        */
        public function consultarPremio ($idconcurso, $nombrepremio) {
            trigger_error('Metodo no implementado.', E_USER_ERROR);
        }
    };

}
else
{
    header("HTTP/1.0 404 Not Found");
}
?>
