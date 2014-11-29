<?php
if (defined('PINCHOSFW'))
{
    require_once (SYSTEM_FOLDER . 'Model.php');

    class ModeloUsuario extends Model {
        /**
        * Crea un usuario en la base de datos.
        */
        public function crearUsuario ($usuario) {
            if (isset($usuario['email']) && isset($usuario['password']) && isset($usuario['type'])) {
                $querytuser = 'INSERT INTO usuario (email, password) VALUES (' . $usuario['email'] . ', ' . $usuario['password'] . ')';

                if ($this->db->query($querytuser) === TRUE) {
                    return TRUE;
                }
                else {
                    trigger_error('No se ha podido crear el usuario en la base de datos (' . $this->db->errno . ').', E_USER_ERROR);
                    return FALSE;
                }
            }
            else {
                trigger_error('El metodo ModeloUsuario->crearUsuario no ha recibido parametros suficientes.', E_USER_ERROR);
                return FALSE;
            }
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
