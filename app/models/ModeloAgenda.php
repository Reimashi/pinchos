<?php
if (defined('PINCHOSFW'))
{
  require_once (SYSTEM_FOLDER . 'Model.php');

  class ModeloAgenda extends Model {
    /**
    * Consulta la agenda de un concurso en la base de datos.
    */
    public function consultarAgenda ($idconcurso=1) {

      $agenda = this->db->query("SELECT nombre,descripcion,fecha_inicio,fecha_fin FROM agenda WHERE id_concurso=1");

      return $agenda;

    }
  };

}
else
{
  header("HTTP/1.0 404 Not Found");
}
?>
