<?php
if (defined('PINCHOSFW'))
{
    require_once (SYSTEM_FOLDER . 'Model.php');

    class ModeloUsuario extends Model {
        /**
        * Crea un usuario en la base de datos.
        */
        public function crearUsuario ($usuario) {
            trigger_error('Metodo no implementado.', E_USER_ERROR);
        }

        /**
        * Borra un usuario en la base de datos.
        */
        public function borrarUsuario ($userid) {
            trigger_error('Metodo no implementado.', E_USER_ERROR);
        }

        /**
        * Obtiene un usuario desde la base de datos.
        */
        public function obtenerUsuario ($userid) {
            trigger_error('Metodo no implementado.', E_USER_ERROR);
        }
    };

}
else
{
    header("HTTP/1.0 404 Not Found");
}
?>
