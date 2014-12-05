<?php
if (defined('PINCHOSFW'))
{
    require_once (SYSTEM_FOLDER . 'Model.php');

    class ModeloConcurso extends Model {
        /**
        * Consulta las bases de un concurso en la base de datos.
        */
        public function consultarBases ($idconcurso) {

            $qresult = $this->db->query("SELECT bases FROM concursos WHERE id=1");

            if ($qresult && $qresult->num_rows == 1) {
                return $qresult->fetch_assoc()['bases'];
            }
            else {
                return FALSE;
            }
        }

        public function obtenerConcurso ($idconcurso = 1, $campos = null) {

            $qresult = $this->db->query("SELECT * FROM concursos WHERE id = " . $idconcurso);

            if ($qresult && $qresult->num_rows == 1) {
                if ($campos == null) {
                    return $qresult->fetch_assoc();
                }
                else {
                    return array_intersect_key($qresult->fetch_assoc(), array_flip($campos));
                }
            }
            else {
                return FALSE;
            }
        }
    };
}
else
{
    header("HTTP/1.0 404 Not Found");
}
?>
