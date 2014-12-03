<?php
if (defined('PINCHOSFW'))
{
    require_once (SYSTEM_FOLDER . 'Model.php');

    class ModeloConcurso extends Model {
        /**
        * Consulta las bases de un concurso en la base de datos.
        */
        public function consultarBases ($idconcurso) {
          if(isset($idconcurso)){

            $bases = this->db->query("SELECT bases FROM concursos WHERE id_concurso='$idconcurso'");

            return $bases;
          }



            trigger_error('Metodo no implementado.', E_USER_ERROR);
        }
    };
}
else
{
    header("HTTP/1.0 404 Not Found");
}
?>
