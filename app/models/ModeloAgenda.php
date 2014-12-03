<?php
if (defined('PINCHOSFW'))
{
    require_once (SYSTEM_FOLDER . 'Model.php');

    class ModeloAgenda extends Model {
        /**
        * Consulta la agenda de un concurso en la base de datos.
        */
        public function consultarAgenda ($idconcurso) {
          if(isset($idconcurso)){

            $agenda = this->db->query("SELECT * FROM agenda WHERE id_concurso='$idconcurso'");

            return $agenda;

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
