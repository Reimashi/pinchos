<?php
if (defined('PINCHOSFW'))
{
    require_once(SYSTEM_FOLDER . 'Model.php');

    class ModeloPinchos extends Model {
        /**
        * Registra un nuevo pincho en la base de datos.
        */
        public function registrarPincho ($pincho) {
            if($this->user->loguedin() && $this->user->is_role("usuario_participante"))
            {
                if(isset($pincho['nombre']) && isset($pincho['descripcion'])){

                    $iduser = array();
                    $iduser = $this->user->get_info();
                    $code = str_split($pincho['nombre'], 3);
                    $this->db->query("INSERT INTO pinchos VALUES (" . $code[0] . ", " . $iduser['id'] . ", ". 1 .", " . $pincho['nombre'] . ", " . $pincho['descripcion'] . ")");
                }

            }else{
                trigger_error('No dispone de permisos suficientes (' . $this->db->errno . ').', E_USER_ERROR);
            }
        }

        /**
        * Valida un pincho y lo registra en la base de datos.
        */
        public function validarPincho ($estado, $idpincho) {

            if($this->user->loguedin() && $this->user->is_role("usuario_organizador")){
                if(isset($idpincho) && isset($estado)){
                    $this->db->query("UPDATE pinchos SET validado='$estado' WHERE id='$idpincho'");
                }
            }else{
                trigger_error('No dispone de permisos suficientes (' . $this->db->errno . ').', E_USER_ERROR);
            }
        }

        /**
        * Obtiene un pincho desde la base de datos.
        */
        public function obtenerPincho ($idpincho) {
            if(isset($idpincho)){

                $pincho = $this->db->query("SELECT * FROM pinchos WHERE id='$idpincho'");

                return $pincho;
            }
        }

        /**
        * Comprueba si existe un pincho en la base de datos.
        */
        public function existePincho ($idpincho) {
            if(isset($idpincho)){
                $existe = $this->db->query("SELECT * FROM pinchos WHERE id='$idpincho'");
                if($existe == NULL){
                    return false;
                }else{
                    return true;
                }
            }
        }

        /**
        * Obtiene la localización de todos los pinchos desde la base de datos.
        * FIXME: Creo que se le debe pasar el id de concurso, comprobadlo.
        */
        public function obtenerLocalizaciones () {

          /*  $localizaciones = array();
            $sql = $this->db->query("SELECT usuario_participante.direccion FROM pinchos, usuario_participante WHERE pinchos.validado='VALIDATE' AND pinchos.id_participante=usuario_participante.id");
            while($row = fetch_array($sql)){
                $localizaciones[]=$row;
            }*/



            $qresult = $this->db->query("SELECT pinchos.nombre , usuario_participante.direccion FROM pinchos, usuario_participante WHERE pinchos.validado='VALIDATE' AND pinchos.id_participante=usuario_participante.id");

            if ($qresult && $qresult->num_rows > 0) {
              $localizaciones = array();

              // Se recorren las filas encontradas en la base de datos
              while ($entradalocalizaciones = $qresult->fetch_assoc()) {
                $localizaciones[] = $entradalocalizaciones;
              }

              return $localizaciones;
            }
            else {
              return FALSE;
            }

        }

        /**
         * Registra un array de codigos para un pincho en la base de datos.
         */
        public function registrarCodigos($idpincho, $codigos) {
            if($this->user->loguedin() && $this->user->is_role("usuario_organizador")){
                foreach ($codigos as $codigo) {
                    $this->db->query("INSERT INTO codigos_pincho (codigo, id_pincho) VALUES ($codigo, $idpincho)");
                }
            }else{
                trigger_error('No dispone de permisos suficientes (' . $this->db->errno . ').', E_USER_ERROR);
            }
        }
    };

}
else
{
    header("HTTP/1.0 404 Not Found");
}
?>
