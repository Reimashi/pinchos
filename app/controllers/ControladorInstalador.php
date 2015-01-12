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

            if(isset($params['post']['form-name']) && $params['post']['form-name'] == 'install-info') {
                $form_error = "";
                
                if (!isset($params['post']['dbuser']) || $params['post']['dbuser'] == "") {
                    $form_error .= 'No se ha pasado el usuario de la base de datos<br>';
                }
                if (!isset($params['post']['dbpass']) || $params['post']['dbpass'] == "") {
                    $form_error .= 'No se ha pasado la contraseña de la base de datos<br>';
                }
                if (!isset($params['post']['dbhost']) || $params['post']['dbhost'] == "") {
                    $form_error .= 'No se ha pasado la dirección de la base de datos<br>';
                }
                if (!isset($params['post']['dbname']) || $params['post']['dbname'] == "") {
                    $form_error .= 'No se ha pasado el nombre de la base de datos<br>';
                }
                if (!isset($params['post']['concurname']) || $params['post']['concurname'] == "") {
                    $form_error .= 'No se ha pasado el nombre del concurso<br>';
                }
                
                if ($form_error != "") {
                    return $this->render('Instalacion', array('form-error' => $form_error));
                }
                
                if (!$this->test_sql_connection($params['post']['dbhost'],  
                        $params['post']['dbuser'], 
                        $params['post']['dbpass'], 
                        $params['post']['dbname'])) {
                    return $this->render('Instalacion', array('form-error' => "No se ha podido conectar con la base de datos. Configuración incorrecta.<br>"));
                }
                else {
                    $config = array();
                    $config['dbhost'] = $params['post']['dbhost'];
                    $config['dbuser'] = $params['post']['dbuser'];
                    $config['dbpass'] = $params['post']['dbpass'];
                    $config['dbname'] = $params['post']['dbname'];
                    if (!$this->generate_conf_file("Database", $config)) {
                        return $this->render('Instalacion', array('form-error' => "No se ha podido crear el archivo de configuracion. Comprueba que PHP tiene permisos de escritura.<br>"));
                    }
                }
                
                if (!file_exists(APP_FOLDER . "config/Common.php")) {
                    $config = array();
                    $config['default_controller'] = 'Buscarinformacion';
                    if (!$this->generate_conf_file("Common", $config)) {
                        return $this->render('Instalacion', array('form-error' => "No se ha podido crear el archivo de configuracion. Comprueba que PHP tiene permisos de escritura.<br>"));
                    }
                }
                
                if(!$this->import_sql(APP_FOLDER . 'create.sql',
                        $params['post']['dbhost'],  
                        $params['post']['dbuser'], 
                        $params['post']['dbpass'], 
                        $params['post']['dbname'])) {
                    $form_error .= "WARNING: No se ha podido importar el script .sql . Importelo manualmente.<br>";
                }
                
                $this->config->reload();
                
                $modeloConcurso = $this->loadModel('Concurso');
                // Sin soporte para multiples concursos, concurso siempre será 1
                if (!$modeloConcurso->crearConcurso(array("nombre" => $params['post']['concurname']))) {
                    $form_error .= "WARNING: No se ha podido crear el concurso en la base de datos. Intentelo manualmente.<br>";
                }
                
                $form_error .= "Instalación completada!<br>";
                
                return $this->render('Instalacion', array('form-error' => $form_error));
            }
            else {
                $this->render('Instalacion', null);
            }
        }
        
        private function test_sql_connection($mysql_host, $mysql_username, $mysql_password, $mysql_database) {
            $res = mysql_connect($mysql_host, $mysql_username, $mysql_password);
            if (!$res) {
                echo "Conexion incorrecta";
                return FALSE;
            }

            if (!mysql_select_db($mysql_database, $res)) {
                echo "Tabla incorrecta";
                return FALSE;
            }
            
            mysql_close ($res);
            
            return TRUE;
        }

        private function import_sql($filename, $mysql_host, $mysql_username, $mysql_password, $mysql_database) {
            if (file_exists($filename)) {
                $res = mysql_connect($mysql_host, $mysql_username, $mysql_password);
                if (!$res) {
                    return FALSE;
                }

                if (!mysql_select_db($mysql_database, $res)) {
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
                        if (!mysql_query($templine, $res)) {
                            return FALSE;
                        }
                        $templine = '';
                    }
                }

                mysql_close ($res);
                return TRUE;
            }
            else {
                return FALSE;
            }
        }

        private function generate_conf_file($filename, $config) {
            $path = APP_FOLDER . 'config/' . ucfirst(strtolower($filename)) . '.php';

            if (($myfile = fopen($path, "w"))) {
                if (!fwrite($myfile, "<?php\n\$config = array();\n")) {
                    return FALSE;
                }
                foreach ($config as $clave => $valor) {
                    if (!fwrite($myfile, "\$config[\"" . $clave . "\"] = \"" . $valor . "\";\n")) {
                        return FALSE;
                    }
                }
                if (!fwrite($myfile, "\n?>")) {
                    return FALSE;
                }
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
