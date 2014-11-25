<?php
if (defined('PINCHOSFW'))
{
    require_once (SYSTEM_FOLDER . 'Database.php');

    abstract class Model
    {
        protected $db;

        function __construct() {
            $db = Database::getDatabase();
        }
    };

}
else
{
    header("HTTP/1.0 404 Not Found");
}
?>
