<?php
if (defined('PINCHOSFW'))
{
    require_once (SYSTEM_FOLDER . 'Model.php');

    class Users extends Model {
        public function getUser ($id) {
            
        }
    };

}
else
{
    header("HTTP/1.0 404 Not Found");
}
?>