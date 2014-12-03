<?php
if (defined('PINCHOSFW'))
{
    require_once (SYSTEM_FOLDER . 'Controller.php');

    class ControladorUsuario extends Controller {
        /**
        * Metodo por defecto del controlador.
        */
        public function index ($params) {
            return obtenerUsuario($params);
        }

        /**
         * Registra un nuevo usuario en el sistema.
         */
        public function registrarUsuario ($params) {
            $configvistaprincipal = array(
                'body-containers' => array()
            );

            // Si ha recibido los valores de formulario en un post
            if (isset($params['post']['form-name']) && $params['post']['form-name'] = 'user-registry')
            {
                $datosUsuario = array();

                // Comprobamos si los valores recibidos del formulario son los esperados
                // http://php.net/manual/en/filter.filters.validate.php
                if (!filter_var($params['post']['email'], FILTER_VALIDATE_EMAIL)) {
                    return $this->registrarUsuarioVerFormulario($configvistaprincipal, "El email no es válido");
                }
                else {
                    $datosUsuario['email'] = $params['post']['email'];
                }

                if (strlen($params['post']['pass']) != 40) { // Tamaño de SHA1
                    return $this->registrarUsuarioVerFormulario($configvistaprincipal, "La contraseña no es válida");
                }
                else {
                    $datosUsuario['password'] = $params['post']['pass'];
                }

                // Cargamos el modelo de Usuario
                $modeloUsuario = $this->loadModel('Usuario');

                // Creamos el usuario en la base de datos
                $modeloUsuario->crearUsuario($datosUsuario);

                // Mostramos la vista de tarea completa
                return $this->registrarUsuarioVerFormularioSuccess($configvistaprincipal);
            }
            else {
                return $this->registrarUsuarioVerFormulario($configvistaprincipal);
            }
        }

        private function registrarUsuarioVerFormulario($confprincipal, $error = false) {
            $confprincipal['body-containers'][] = $this->render('Usuario/FormularioRegistrar', ($error) ? array('form-error' => $error) : null, true);
            $confprincipal['js'] = array(
                RESOURCES_URL . 'js/jquery-2.min.js',
                RESOURCES_URL . 'js/sha1.js',
                RESOURCES_URL . 'js/UsuarioRegistrar.js'
            );
            $confprincipal['css'] = array(
                RESOURCES_URL . 'styles/Usuario.css'
            );
            $this->render('Principal', $confprincipal);
        }

        private function registrarUsuarioVerFormularioSuccess($confprincipal) {
            $confprincipal['css'] = array(
                RESOURCES_URL . 'styles/Usuario.css'
            );
            $confprincipal['body-containers'][] = $this->render('Usuario/FormularioRegistrarSuccess', null, true);
            $this->render('Principal', $confprincipal);
        }

        /**
        * Registra un nuevo usuario en el sistema.
        */
        public function borrarUsuario ($params) {
            trigger_error('Metodo no implementado.', E_USER_ERROR);
        }

        /**
        * Obtiene y muestra un usuario del sistema.
        */
        public function obtenerUsuario ($params) {
            trigger_error('Metodo no implementado.', E_USER_ERROR);
        }

        /**
        * Obtiene y muestra un usuario del sistema.
        */
        private function validarDatosUsuario ($usuario) {
            trigger_error('Metodo no implementado.', E_USER_ERROR);
        }
    };

}
else
{
    header("HTTP/1.0 404 Not Found");
}
?>
