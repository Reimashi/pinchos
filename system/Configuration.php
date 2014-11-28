<?php
if (defined('PINCHOSFW'))
{

    /**
     * Clase singleton que carga y almacena los archivos de configuración de la app.
     */
    class Configuration {
        private static $instance;
        private $configuration;

        private function __construct()
        {
            $this->loadConfig();
        }

        /**
         * Metodo que carga los archivos de configuración.
         */
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
        * Metodo que fuerza la recarga de los archivos de configuración.
        */
        public function reload()
        {
            $this->loadConfig();
        }

        /**
         * Metodo mágico para acceder a un valor de la configuración con una sintaxis mas sencilla.
         * @param string $name Clave del valor de la configuración que se quiere obtener.
         */
        public function __get($name) {
            if (array_key_exists($name, $this->configuration)) {
                return $this->configuration[$name];
            }

            trigger_error('La configuración (' . $name . ') no existe.', E_USER_WARNING);
            return FALSE;
        }
    };

}
else
{
    header("HTTP/1.0 404 Not Found");
}
?>
