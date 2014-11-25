<?php
if (defined('PINCHOSFW'))
{

    abstract class Controller
    {
        protected $config;

        function __construct() {
            if (isset($GLOBALS['pinchoscfg'])) {
                $this->config = $GLOBALS['pinchoscfg'];
            }
            else {
                require_once('Configuration.php');
                $this->config = Configuration::load_config();
            }
        }
    };

}
else
{
    header("HTTP/1.0 404 Not Found");
}
?>
