<?php
if (defined('PINCHOSFW'))
{
    /**
    * Clase singleton que representa el estado de un usuario del sistema.
    */
    class User
    {
        private static $instance;

        private $loguedin;
        private $role;
        private $info;

        private function __construct()
        {
            $this->loguedin = (isset($_SESSION['user']['loguedin'])) ? $_SESSION['user']['loguedin'] : false;
            $this->info = (isset($_SESSION['user']['info'])) ? $_SESSION['user']['info'] : array();
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
            if (isset($this->info[$name])) {
                return $this->info[$name];
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
            $this->info[$name] = $value;
        }

        /**
         * Metodo que comprueba si un usuario tiene una sesión iniciada.
         */
        public function loguedin() {
            return $this->loguedin;
        }

        /**
        * Metodo que comprueba si un usuario pertenece a un rol determinado.
        */
        public function is_role($role) {
            return ($role == $this->role);
        }

        /**
        * Metodo que inicia sesion en el sistema.
        * @param array Información del usuario.
        * @param string Nombre del rol del usuario.
        */
        public function login($userinfo, $role) {
            $this->loguedin = true;
            $this->info = $userinfo;
            $this->role = $role;
        }

        /**
        * Metodo que cierra sesion en el sistema.
        */
        public function logout() {
            $this->loguedin = false;
            $this->info = array();
            $this->role = '';
        }

        /**
        * Metodo que obtiene un array con la informacion del usuario.
        */
        public function get_info() {
            return $this->info;
        }

        public function save() {
            $_SESSION['user']['loguedin'] = $this->loguedin;
            $_SESSION['user']['info'] = $this->info;
            $_SESSION['user']['role'] = $this->role;
        }
    };
}
else
{
    header("HTTP/1.0 404 Not Found");
}
?>
