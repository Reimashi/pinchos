<?php
if (defined('PINCHOSFW'))
{
    require_once (SYSTEM_FOLDER . 'Model.php');

    class ModeloConcurso extends Model {

        private $table_concurso = 'concursos';
        
        /**
        * Consulta las bases de un concurso en la base de datos.
        */
        public function consultarBases ($idconcurso) {

            $qresult = $this->db->query("SELECT bases FROM concursos WHERE id=1");

            if ($qresult && $qresult->num_rows == 1) {
                return utf8_encode($qresult->fetch_assoc()['bases']);
            }
            else {
                return FALSE;
            }
        }

        public function obtenerConcurso ($idconcurso = 1, $campos = null) {

            $qresult = $this->db->query("SELECT * FROM concursos WHERE id = " . $idconcurso);

            if ($qresult && $qresult->num_rows == 1) {
                $cinfo = $qresult->fetch_assoc();
                $cinfo['descripcion'] = utf8_encode($cinfo['descripcion']);
                $cinfo['bases'] = utf8_encode($cinfo['bases']);
                
                if ($campos == null) {
                    return $cinfo;
                }
                else {
                    return array_intersect_key($cinfo, array_flip($campos));
                }
            }
            else {
                return FALSE;
            }
        }

        public function crearConcurso ($concurso) {
            if (is_array($concurso)) {
                $queryinser = "INSERT INTO `" . $this->table_concurso . "` (";
                $queryval = ") VALUES (";
                
                if (isset($concurso['nombre'])) {
                    $queryinser .= "nombre";
                    $queryval .= '"' . $concurso['nombre'] . '"';
                }
                else {
                    return FALSE;
                }
                
                if (isset($concurso['fecha'])) {
                    $queryinser .= ", fecha";
                    $queryval .= ', "' . $concurso['fecha'] . '"';
                }
                
                if (isset($concurso['descripcion'])) {
                    $queryinser .= ", descripcion";
                    $queryval .= ', "' . $concurso['descripcion'] . '"';
                }
                
                if (isset($concurso['bases'])) {
                    $queryinser .= ", bases";
                    $queryval .= ', "' . $concurso['bases'] . '"';
                }
                
                $querytuser = $queryinser . $queryval . ")";

                if ($this->db->query($querytuser)) {
                    return TRUE;
                }
                else {
                    trigger_error('No se ha podido crear el concurso en la base de datos (' . $this->db->errno . ').', E_USER_WARNING);
                    return FALSE;
                }
            }
            else {
                trigger_error('El metodo ModeloConcurso->crearConcurso no ha recibido parametros suficientes.', E_USER_ERROR);
                return FALSE;
            }
        }

        /**
        * Borra un usuario en la base de datos.
        */
        public function borrarConcurso ($email) {
          // Solo es necesario borrar en la tabla usuario, el delete cascade se encarga del resto
          $query = "DELETE FROM `$this->table_concurso` WHERE nombre = '$nombre'";

          if ($this->db->query($query)) {
            return TRUE;
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
