<?php
if (defined('PINCHOSFW'))
{
    require_once(SYSTEM_FOLDER . 'Model.php');

    class ModeloPinchos extends Model {
        /**
        * Registra un nuevo pincho en la base de datos.
        */
        public function registrarPincho ($pincho) {
            if(isset($pincho['nombre']) && isset($pincho['descripcion'])){
                $this->db->query('INSERT INTO pinchos (nombre, descripcion) VALUES (' . $pincho['nombre'] . ', ' . $pincho['descripcion'] . ')');
            }
        }

        /**
        * Valida un pincho y lo registra en la base de datos.
        */
        public function validarPincho ($idpincho) {
            if(isset($idpincho)){
                this->db->query("UPDATE pinchos SET validado='1' WHERE id='$idpincho'");
            }
        }

        /**
        * Obtiene un pincho desde la base de datos.
        */
        public function obtenerPincho ($idpincho) {
            if(isset($idpincho)){

                $pincho = this->db->query("SELECT * FROM pinchos WHERE id='$idpincho'");

                return $pincho;
            }
        }

        /**
        * Comprueba si existe un pincho en la base de datos.
        */
        public function existePincho ($idpincho) {
            if(isset($idpincho)){
                $existe = this->db->query("SELECT * FROM pinchos WHERE id='$idpincho'");   
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
            $localizaciones = array();
            $sql = this->db->query("SELECT usuario_participante.direccion FROM pinchos, usuario_participante WHERE pinchos.validado='1' AND pinchos.id_participante=usuario_participante.id");
            while($row = fetch_array($sql)){
                $localizaciones[]=$row[];
            }
            return $localizaciones;
        }

        /**
         * Registra un array de codigos para un pincho en la base de datos.
         */
        public function registrarCodigos($idpincho, $codigos) {
            foreach ($codigos as $codigo) {
                this->db->query("INSERT INTO codigos_pincho (codigo, id_pincho) VALUES ($codigo, $idpincho)"");
            }
        }
    };

}
else
{
    header("HTTP/1.0 404 Not Found");
}
?>
