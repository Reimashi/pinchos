<?php
if (defined('PINCHOSFW'))
{
    require_once('Configuration.php');

    class Database {
        private static $instance;
        private $db;

        private function __construct()
        {
            $config = Configuration::getInstance();
            $this->db = new mysqli($config->dbhost, $config->dbuser, $config->dbpass, $config->dbname);
            if ($this->db->connect_errno) {
                trigger_error('No se ha podido conectar con la base de datos. <' . $this->db->connect_errno . '>', E_USER_ERROR);
            }
        }

        public function getDatabaseConnection() {
            return $this->db;
        }

        public static function getDatabase()
        {
            if (  !self::$instance instanceof self)
            {
                self::$instance = new self;
            }

            $DatabaseInstance = self::$instance;
            return $DatabaseInstance->getDatabaseConnection();
        }
    };

}
else
{
    header("HTTP/1.0 404 Not Found");
}
?>
