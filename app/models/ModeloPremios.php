<?php
if (defined('PINCHOSFW'))
{
    require_once (SYSTEM_FOLDER . 'Model.php');

    class ModeloPremios extends Model {
        /**
        * Consulta los premios de un concurso en la base de datos.
        */
        public function consultarPremios ($idconcurso) {
            $qresult = $this->db->query("SELECT * FROM premios WHERE id_concurso = " . $idconcurso);

            if ($qresult && $qresult->num_rows > 0) {
                $premios = array();

                // Se recorren las filas encontradas en la base de datos
                while ($premio = $qresult->fetch_assoc()) {
                    $premios[] = $premio;
                }

                return $premios;
            }
            else {
                return FALSE;
            }
        }

        /**
        * Consulta la información de un premio en la base de datos.
        */
        public function consultarPremio ($idconcurso, $idpremio) {
            trigger_error('Metodo no implementado.', E_USER_ERROR);
        }
    };

}
else
{
    header("HTTP/1.0 404 Not Found");
}
?>
