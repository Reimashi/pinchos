<?php
if (defined('PINCHOSFW'))
{
    require_once (SYSTEM_FOLDER . 'Model.php');

    class ModeloVoto extends Model {
        private $table_public_vote = 'votos_populares';
        private $table_private_vote = 'votos_profesionales';
        private $table_public_codereg = 'codigos_votados';

        /**
        * Registra un voto publico en la base de datos.
        */
        public function registrarVotoPublico ($codigoganador, $codigosvotados) {
            if (isset($codigoganador) && isset($codigosvotados) && in_array($codigoganador, $codigosvotados)) {
                
                $usuario = $_SESSION['user']['info']['id'];
                $query = "INSERT INTO votos_populares (id_jurado, id_codigo_ganador) VALUES ('$usuario', '$codigoganador')";
                if($this->db->query($query)){
                    //FIXME
                    $idvoto = NULL;
                    foreach ($codigosvotados as $codigo) {
                        if (!$this->registrarCodigoVotado($codigo, $idvoto)) {
                            return FALSE;
                        }
                    }
                    return TRUE;
                }
                else
                {
                    trigger_error('No se ha podido emitir el voto (' . $this->db->errno . ').', E_USER_WARNING);
                    return FAlSE;
                }
            }
            else {
                return FALSE;
            }
        }
        
        private function registrarCodigoVotado($idcodigo, $idvoto) {
            $query = "INSERT INTO codigos_votados"."(id_voto, id_codigo)"."VALUES ('$idvoto','$idcodigo')";
            
            if($this->db->query($query)){
                return TRUE;
            }
            else
            {
                trigger_error('No se ha podido emitir el voto (' . $this->db->errno . ').', E_USER_WARNING);
                return FALSE;
            }
        }

        /**
        * Registra un voto privado en la base de datos.
        */
        public function registrarVotoPrivado ($idpincho, $idjurado, $nota) {
          if(isset($idpincho) && isset($idjurado) && isset($nota)){
            if ($nota > 100 || $nota < 0) {
                return FALSE;
            }

            $query = "INSERT INTO ' . $this->table_private_vote . ' (id_jurado, id_pincho, nota) VALUES (' . $idjurado . ', ' . $idpincho . ', ' . $nota . ')";
            if($this->db->query($query)){
              return TRUE;
            }else{
              trigger_error('No se ha registrado el voto.', E_USER_WARNING);
              return FALSE;
            }

          }else{
            trigger_error('Faltan parametros para contar los votos .', E_USER_ERROR);
            return FALSE;
          }
        }


        /**
        * Cuenta los votos registrados en la base de datos de un pincho.
        */
        public function contarVotos ($idpincho) {
          if(isset($idpincho)){
            $sql="SELECT COUNT(id_voto) FROM codigos_votados AS cv, codigos_pincho AS cp, pinchos as p WHERE cv.id_codigo=cp.codigo AND p.id='$idpincho'";
            $res = $this->db->query($sql);
            if($res == NULL){
              trigger_error('Error al realizar la consulta.', E_USER_WARNING);
              return -1;
            }
            return $res;
          }else{
            trigger_error('Faltan parametros para contar los votos .', E_USER_ERROR);
            return -1;
          }
        }
    };
}
else
{
  header("HTTP/1.0 404 Not Found");
}
?>
