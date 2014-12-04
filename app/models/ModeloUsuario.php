<?php
if (defined('PINCHOSFW'))
{
    require_once (SYSTEM_FOLDER . 'Model.php');

    class ModeloUsuario extends Model {
        private $table_user = 'usuario';
        private $table_user_popu = 'usuario_jurado_popular';
        private $role_user_popu = 'utype_popul';
        private $table_user_prof = 'usuario_jurado_especialista';
        private $role_user_prof = 'utype_profe';
        private $table_user_part = 'usuario_participante';
        private $role_user_part = 'utype_parti';
        private $table_user_orga = 'usuario_organizador';
        private $role_user_orga = 'utype_organ';

        /**
        * Crea un usuario en la base de datos.
        */
        public function crearUsuario ($usuario) {
            if (isset($usuario['email']) && isset($usuario['password']) && isset($usuario['role'])) {

                $querytuser = "INSERT INTO `" . $this->table_user . "` (email, password) VALUES (\"" . $usuario['email'] . "\", \"" . $usuario['password'] . "\")";
                if ($this->db->query($querytuser)) {
                    switch ($usuario['role']) {
                        case $this->role_user_popu:
                            $querytusersp = "INSERT INTO `" . $this->table_user_popu . "` (id) VALUES (\"" . $usuario['email'] . "\")";
                            break;
                        case $this->role_user_prof:
                            $querytusersp = "INSERT INTO `" . $this->table_user_prof . "` (id, nombre, apellidos) VALUES (\"" . $usuario['email'] . "\", \"" . $usuario['firstname'] . "\", \"" . $usuario['lastname'] . "\")";
                            break;
                        case $this->role_user_orga:
                            $querytusersp = "INSERT INTO `" . $this->table_user_orga . "` (id, nombre, apellidos) VALUES (\"" . $usuario['email'] . "\", \"" . $usuario['firstname'] . "\", \"" . $usuario['lastname'] . "\")";
                            break;
                        case $this->role_user_part:
                            $querytusersp = "INSERT INTO `" . $this->table_user_part . "` (id, nombre, direccion) VALUES (\"" . $usuario['email'] . "\", \"" . $usuario['localname'] . "\", \"" . $usuario['localaddr'] . "\")";
                            break;
                        default:
                            trigger_error('No se ha especificado un tipo de usuario.', E_USER_ERROR);
                            break;
                    }

                    if ($this->db->query($querytusersp)) {
                        return TRUE;
                    }
                    else {
                        trigger_error('No se ha podido crear el usuario especifico en la base de datos (' . $this->db->errno . ').', E_USER_WARNING);
                        $this->borrarUsuario($usuario['email']);
                        return FALSE;
                    }
                }
                else {
                    trigger_error('No se ha podido crear el usuario en la base de datos (' . $this->db->errno . ').', E_USER_WARNING);
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
        public function borrarUsuario ($email) {
            // Solo es necesario borrar en la tabla usuario, el delete cascade se encarga del resto
            $query = "DELETE FROM `$this->table_user` WHERE email = '$email'";

            if ($this->db->query($query)) {
                return TRUE;
            }
            else {
                return FALSE;
            }
        }

        /**
        * Obtiene un usuario desde la base de datos.
        */
        public function obtenerUsuario ($email) {
            $query = "SELECT * FROM `$this->table_user` WHERE email = '$email'";
            $userinfo = array();

            // Comprobamos que el usuario exista
            $data = $this->db->query($query);
            if ($data && $data->num_rows == 1) {
                $userinfo = $data->fetch_assoc();

                // Comprobamos si el usuario pertenece a otro tipo de usuario
                $query = "SELECT * FROM `$this->table_user_popu` WHERE id = '$email'";
                $data = $this->db->query($query);
                if ($data && $data->num_rows == 1) {
                    $userinfo['role'] = $this->role_user_popu;
                    return $userinfo;
                }

                $query = "SELECT nombre, apellidos FROM `$this->table_user_prof` WHERE id = '$email'";
                $data = $this->db->query($query);
                if ($data && $data->num_rows == 1) {
                    $userinfo = array_merge($userinfo, $data->fetch_assoc());
                    $userinfo['role'] = $this->role_user_prof;
                    return $userinfo;
                }

                $query = "SELECT nombre, apellidos FROM `$this->table_user_orga` WHERE id = '$email'";
                $data = $this->db->query($query);
                if ($data && $data->num_rows == 1) {
                    $userinfo = array_merge($userinfo, $data->fetch_assoc());
                    $userinfo['role'] = $this->role_user_orga;
                    return $userinfo;
                }

                $query = "SELECT nombre, direccion FROM `$this->table_user_part` WHERE id = '$email'";
                $data = $this->db->query($query);
                if ($data && $data->num_rows == 1) {
                    $userinfo = array_merge($userinfo, $data->fetch_assoc());
                    $userinfo['role'] = $this->role_user_part;
                    return $userinfo;
                }

                trigger_error('El usuario no esta presente en las tablas de usuario especializado.', E_USER_WARNING);
                return $userinfo;
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
