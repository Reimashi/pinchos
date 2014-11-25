<?php
if (defined('PINCHOSFW'))
{

    class Configuration {
        public static function load_config() {
            $GLOBALS['pinchoscfg'] = array();

            foreach (glob(APP_FOLDER . "config/*.php") as $filename)
            {
                if (isset($config)) unset($config);

                include $filename;

                if (isset($config))
                {
                    $GLOBALS['pinchoscfg'] = array_merge($config, $GLOBALS['pinchoscfg']);
                }
            }

            return $GLOBALS['pinchoscfg'];
        }
    };

}
else
{
    header("HTTP/1.0 404 Not Found");
}
?>
