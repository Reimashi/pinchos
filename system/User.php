<?php
if (defined('PINCHOSFW'))
{
    /**
    * Clase singleton que representa el estado de un usuario del sistema.
    */
    class User
    {
        private static $instance;

        private function __construct()
        {
            $_SESSION['user']['loguedin'] = (isset($_SESSION['user']['loguedin'])) ? $_SESSION['user']['loguedin'] : false;
            $_SESSION['user']['info'] = (isset($_SESSION['user']['info'])) ? $_SESSION['user']['info'] : array();
            $_SESSION['user']['role'] = (isset($_SESSION['user']['role'])) ? $_SESSION['user']['role'] : '';
        }

        /**
        * Metodo que permite obtener una instancia de la clase Configuration.
        */
        public static function getInstance()
        {
            if (  !self::$instance instanceof self)
            {
                self::$instance = new self;
            }
            return self::$instance;
        }

        /**
         * Metodo mágico para cargar el valor de una propiedad del usuario
         */
        public function __get ($name) {
            if (isset($_SESSION['user']['info'][$name])) {
                return $_SESSION['user']['info'][$name];
            }
            else {
                trigger_error('El usuario no tiene una propiedad llamada (' . $name . ').', E_USER_ERROR);
                return null;
            }
        }

        /**
        * Metodo mágico para establecer una propiedad del usuario
        */
        public function __set ($name, $value) {
            $_SESSION['user']['info'][$name] = $value;
        }

        /**
         * Metodo que comprueba si un usuario tiene una sesión iniciada.
         */
        public function loguedin() {
            return $_SESSION['user']['loguedin'];
        }

        /**
        * Metodo que comprueba si un usuario pertenece a un rol determinado.
        */
        public function is_role($role) {
            return ($role == $_SESSION['user']['role']);
        }

        /**
        * Metodo que inicia sesion en el sistema.
        * @param array Información del usuario.
        * @param string Nombre del rol del usuario.
        */
        public function login($userinfo, $role) {
            $_SESSION['user']['loguedin'] = true;
            $_SESSION['user']['info'] = $userinfo;
            $_SESSION['user']['role'] = $role;
        }

        /**
        * Metodo que cierra sesion en el sistema.
        */
        public function logout() {
            $_SESSION['user']['loguedin'] = false;
            $_SESSION['user']['info'] = array();
            $_SESSION['user']['role'] = '';
        }

        /**
        * Metodo que obtiene un array con la informacion del usuario.
        */
        public function get_info() {
            return $_SESSION['user']['info'];
        }
    };
}
else
{
    header("HTTP/1.0 404 Not Found");
}
?>
