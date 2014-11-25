<?php
if (defined('PINCHOSFW'))
{
    private static $instance;
    private $configuration;

    class Configuration {
        private function __construct()
        {
            $this->loadConfig();
        }

        private function loadConfig()
        {
            $this->configuration = array();

            foreach (glob(APP_FOLDER . "config/*.php") as $filename)
            {
                if (isset($config)) unset($config);

                include $filename;

                if (isset($config))
                {
                    $this->configuration = array_merge($config, $this->configuration);
                }
            }
        }

        public static function getInstance()
        {
            if (  !self::$instance instanceof self)
            {
                self::$instance = new self;
            }
            return self::$instance;
        }

        public function reload()
        {
            $this->loadConfig();
        }

        public function __get($name) {
            if (array_key_exists($name, $this->configuration)) {
                return $this->configuration[$name];
            }

            trigger_error('La configuración <' . $name . '> no existe.', E_USER_WARNING);
            return FALSE;
        }
    };

}
else
{
    header("HTTP/1.0 404 Not Found");
}
?>
