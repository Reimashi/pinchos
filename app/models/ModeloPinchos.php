<?php
if (defined('PINCHOSFW'))
{
    require_once(SYSTEM_FOLDER . 'Model.php');

    class ModeloPinchos extends Model {

        private $table_user = 'pinchos';
        private $id_concurso = '1';
        /**
        * Registra un nuevo pincho en la base de datos.
        */
        public function registrarPincho ($pincho) {
            if($_SESSION['user']['info']['role'] == 'utype_parti'){
                if(isset($pincho['nombre']) && isset($pincho['descripcion'])){

                    $nombre = $pincho['nombre'];
                    $descripcion = $pincho['descripcion'];
                    $sesion = $_SESSION['user']['info']['email'];
                    $code = str_split($pincho['nombre'], 3);
                    $sql = "INSERT INTO pinchos "."(id, id_participante, id_concurso, nombre, descripcion) "."VALUES('$code[0]', '$sesion', 1, '$nombre','$descripcion')";
                    if($this->db->query($sql)){
                        return TRUE;
                    }else{
                        trigger_error('Pincho no registrado (' . $this->db->errno . ').', E_USER_WARNING);
                        return FALSE;
                    }

                }else{
                    trigger_error('Parametros insuficientes (' . $this->db->errno . ').', E_USER_WARNING);
                    return FALSE;
                }
            }else{
                trigger_error('Permisos insuficientes para registrar un pincho (' . $this->db->errno . ').', E_USER_ERROR);
                return FALSE;
            }

        }

        /**
        * Valida un pincho y lo registra en la base de datos.
        */
        public function validarPincho ($estado, $idpincho) {
            if($_SESSION['user']['info']['role'] == 'utype_organ'){
                if(isset($idpincho) && isset($estado)){
                    $sql = "UPDATE pinchos SET validado='$estado' WHERE id='$idpincho'";
                    if($this->db->query($sql)){
                        return TRUE;
                    }else{
                        trigger_error('Pincho no actualizado (' . $this->db->errno . ').', E_USER_WARNING);
                        return FALSE;
                    }
                }else{
                    trigger_error('Parametros insuficientes (' . $this->db->errno . ').', E_USER_WARNING);
                    return FALSE;
                }
            }else{
                trigger_error('Permisos insuficientes para registrar un pincho (' . $this->db->errno . ').', E_USER_ERROR);
                return FALSE;
            }
        }

        /**
        * Obtiene un pincho desde la base de datos.
        */
        public function obtenerPincho ($idpincho) {
            $pincho = $this->db->query("SELECT * FROM pinchos WHERE id='$idpincho'");

            if ($pincho && $pincho->num_rows == 1) {
                $pinfo = $pincho->fetch_assoc();
                $pinfo['nombre'] = utf8_encode($pinfo['nombre']);
                $pinfo['descripcion'] = utf8_encode($pinfo['descripcion']);
                $pinfo['validado_reason'] = utf8_encode($pinfo['validado_reason']);
                return $pinfo;
            }

            return FALSE;
        }

        /**
        * Obtiene todos los pinchos desde la base de datos.
        * TODO: Comprobar si es necesario el id del concurso.
        */
        public function listarPinchos () {

                $lista_pinchos = array();
                $sql = "SELECT * FROM pinchos";
                $pinchos = $this->db->query($sql);

                while($pincho = $pinchos->fetch_assoc()) {
                    $pincho['nombre'] = utf8_encode($pincho['nombre']);
                    $pincho['descripcion'] = utf8_encode($pincho['descripcion']);
                    $pincho['validado_reason'] = utf8_encode($pincho['validado_reason']);
                    $lista_pinchos[] = $pincho;
                }
                return $lista_pinchos;
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
            $qresult = $this->db->query("SELECT pinchos.id, pinchos.nombre , usuario_participante.direccion FROM pinchos, usuario_participante WHERE pinchos.validado='YES' AND pinchos.id_participante=usuario_participante.id");

            if ($qresult && $qresult->num_rows > 0) {
                $localizaciones = array();

                // Se recorren las filas encontradas en la base de datos
                while ($pincho = $qresult->fetch_assoc()) {
                    $pincho['nombre'] = utf8_encode($pincho['nombre']);
                    $pincho['direccion'] = utf8_encode($pincho['direccion']);
                    
                    $localizaciones[] = $pincho;
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
        
        public function comprobarCodigo($codigo) {
            if (isset($codigo)) {
                $sql="SELECT pinchos.id FROM codigos_pincho, pinchos WHERE codigo_pinchos.codigo = \"" . $codigo . "\" AND codigo_pinchos.id_pincho = pinchos.id";
                $res = $this->db->query($sql);
                if(!$res){
                    trigger_error('Error al realizar la consulta.', E_USER_WARNING);
                    return FALSE;
                }
                else {
                    if ($res->num_rows > 0) {
                        $data = $res->fetch_assoc();
                        return $data['id'];
                    }
                    else {
                        return FALSE;
                    }
                }
            }
        }

    };

}
else
{
    header("HTTP/1.0 404 Not Found");
}
?>
