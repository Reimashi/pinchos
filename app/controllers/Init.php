<?php
if (defined('PINCHOSFW'))
{
    require_once (SYSTEM_FOLDER . 'Controller.php');

    class InitController extends Controller {
        public function index ($params) {

        }
    };

}
else
{
    header("HTTP/1.0 404 Not Found");
}
?>
