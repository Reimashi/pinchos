<?php
if (defined('PINCHOSFW'))
{
    require_once (SYSTEM_FOLDER . 'Database.php');

    /**
     * Clase abstracta a heredar por todos los modelos.
     */
    abstract class Model
    {
        protected $db;

        function __construct() {
            $this->db = Database::getDatabase();
        }
    };

}
else
{
    header("HTTP/1.0 404 Not Found");
}
?>
