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
                    $premio['nombre'] = utf8_encode($premio['nombre']);
                    $premio['descripcion'] = utf8_encode($premio['descripcion']);
                    $premios[] = $premio;
                }

                return $premios;
            }
            else {
                return FALSE;
            }
        }
        
        public function listarPremios ($idconcurso) {
            $pcg = $this->listarPremiosConGanador($idconcurso);
            $psg = $this->listarPremiosSinGanador($idconcurso);
            
            if (is_array($psg) && is_array($pcg)) {
                return array_merge($psg, $pcg);
            }
            else {
                return FALSE;
            }
        }
        
        /**
        * Consulta los premios de un concurso en la base de datos.
        */
        public function listarPremiosSinGanador ($idconcurso) {
            $qresult = $this->db->query("SELECT nombre, descripcion FROM premios WHERE id_concurso = \"" . $idconcurso . '" AND ganador IS NULL');

            if ($qresult && $qresult->num_rows > 0) {
                $premios = array();

                // Se recorren las filas encontradas en la base de datos
                while ($premio = $qresult->fetch_assoc()) {
                    $premio['nombre'] = utf8_encode($premio['nombre']);
                    $premio['descripcion'] = utf8_encode($premio['descripcion']);
                    $premios[] = $premio;
                }

                return $premios;
            }
            else {
                return FALSE;
            }
        }
        
        /**
        * Consulta los premios de un concurso en la base de datos.
        */
        public function listarPremiosConGanador ($idconcurso) {
            $qresult = $this->db->query("SELECT premios.nombre, premios.descripcion, usuario_participante.nombre ganador FROM premios, usuario_participante WHERE premios.id_concurso = \"" . $idconcurso . '" AND premios.ganador = usuario_participante.id');

            if ($qresult && $qresult->num_rows > 0) {
                $premios = array();

                // Se recorren las filas encontradas en la base de datos
                while ($premio = $qresult->fetch_assoc()) {
                    $premio['nombre'] = utf8_encode($premio['nombre']);
                    $premio['descripcion'] = utf8_encode($premio['descripcion']);
                    $premio['ganador'] = utf8_encode($premio['ganador']);
                    $premios[] = $premio;
                }

                return $premios;
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
