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
        public function registrarVotoPublico ($voto, $bool) {
          if($bool == true){}
            if (isset($voto['code-01']) && isset($voto['code-02']) && isset($voto['code-03'])) {
                $voto1 = $voto['code-01'];
                $voto2 = $voto['code-02'];
                $voto3 = $voto['code-03'];
                $id = rand(0, 100);
                $querytuser1 = "INSERT INTO codigos_votados"."(id_voto, id_codigo)"."VALUES ('$id','$voto1')";
                $id = rand(0, 100);
                $querytuser2 = "INSERT INTO codigos_votados"."(id_voto, id_codigo)"."VALUES ('$id','$voto2')";
                $id = rand(0, 100);
                $querytuser3 = "INSERT INTO codigos_votados"."(id_voto, id_codigo)"."VALUES ('$id','$voto3')";

                if($this->db->query($querytuser1)) {
                  if($this->db->query($querytuser2)){
                    if($this->db->query($querytuser3)){
                        return TRUE;
                      }else{
                        trigger_error('No se ha podido emitir el voto (' . $this->db->errno . ').', E_USER_WARNING);
                        $query = "DELETE FROM codigos_votados WHERE id_codigo ='$voto3'";
                        $this->db->query($query);
                        $query = "DELETE FROM codigos_votados WHERE id_codigo ='$voto2'";
                        $this->db->query($query);
                        $query = "DELETE FROM codigos_votados WHERE id_codigo ='$voto1'";
                        $this->db->query($query);
                        return FALSE;
                      }
                    }else{
                      trigger_error('No se ha podido emitir el voto (' . $this->db->errno . ').', E_USER_WARNING);
                      $query = "DELETE FROM codigos_votados WHERE id_codigo ='$voto2'";
                      $this->db->query($query);
                      $query = "DELETE FROM codigos_votados WHERE id_codigo ='$voto1'";
                      $this->db->query($query);
                      return FALSE;
                    }
                  }else{
                    trigger_error('No se ha podido emitir el voto (' . $this->db->errno . ').', E_USER_WARNING);
                    $query = "DELETE FROM codigos_votados WHERE id_codigo ='$voto1'";
                    $this->db->query($query);
                    return FALSE;
                  }
                }else{
                  if(isset($voto['code'])){
                      $usuario = $_SESSION['user']['info']['id'];
                      $votof = $voto['code'];
                      $query = "INSERT INTO votos_populares (id_jurado,id_codigo_ganador) VALUES ('$usuario', '$votof')";
                      if($this->db->query($query)){
                        return TRUE;
                      }else{
                        trigger_error('No se ha podido emitir el voto (' . $this->db->errno . ').', E_USER_WARNING);
                        return FAlSE;
                      }
                    }else {
                        trigger_error('El metodo ModeloVoto->registrarVoto no ha recibido parametros suficientes.', E_USER_ERROR);
                        return FALSE;
                          
                        }
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
