<?php
if (defined('PINCHOSFW'))
{
    require_once (SYSTEM_FOLDER . 'Configuration.php');

    abstract class Controller
    {
        protected $config;

        function __construct() {
            $this->config = Configuration::getInstance();
        }
    };
}
else
{
    header("HTTP/1.0 404 Not Found");
}
?>
