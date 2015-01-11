<?php
if (defined('PINCHOSFW'))
{
    require_once (SYSTEM_FOLDER . 'Controller.php');

    class ControladorInstalador extends Controller {
        /**
        * Metodo por defecto del controlador.
        */
        private function index ($params) {
        }

        public function install ($params) {
            // Comprobacion de seguridad.
            if (!defined('INSTALL_MODE')) { header("HTTP/1.1 401 Unauthorized"); return; }

            if(isset($params['post']['form-name']) && $params['post']['form-name'] = 'install-info') {

            }
            else {

            }
        }

        private function import_sql($filename, $mysql_host, $mysql_username, $mysql_password, $mysql_database) {
            if (file_exists($filename)) {
                if (!mysql_connect($mysql_host, $mysql_username, $mysql_password)) {
                    return FALSE;
                }

                if (!mysql_select_db($mysql_database)) {
                    return FALSE;
                }

                $templine = '';
                $lines = file($filename);

                foreach ($lines as $line)
                {
                    // Evitamos lineas vacias y comentarios
                    if (substr($line, 0, 2) == '--' || $line == '')
                    continue;

                    $templine .= $line;

                    // Si la sentencia SQL esta completa, la ejecutamos.
                    if (substr(trim($line), -1, 1) == ';')
                    {
                        if (!mysql_query($templine)) {
                            return FALSE;
                        }
                        $templine = '';
                    }
                }

                return TRUE;
            }
            else {
                return FALSE;
            }
        }

        private function generate_conf_file($filename, $config) {
            $path = APP_FOLDER . 'config/' . ucfirst(strtolower($filename)) . '.php';

            if ($myfile = fopen($path, "w")) {
                if (!fwrite($myfile, "<?php\n\$config = array();\n")) return FALSE;
                foreach ($config as $clave => $valor) {
                    if (!fwrite($myfile, "\$config[\"" . $clave . "\"] = \"" . $valor . "\";")) return FALSE;
                }
                if (!fwrite($myfile, "\n?>")) return FALSE;
                return fclose($myfile);
            }
            else {
                return FALSE;
            }
        }
    };
}
else
{
    header("HTTP/1.0 404 Not Found");
}
?>
