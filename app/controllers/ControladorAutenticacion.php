<?php
if (defined('PINCHOSFW'))
{
    require_once (SYSTEM_FOLDER . 'Controller.php');

    class ControladorAutenticacion extends Controller {
        /**
         * Metodo por defecto del controlador.
         */
        public function index ($params) {
            return $this->autenticarUsuario($params);
        }

        /**
        * Autentica un usario en el sistema.
        */
        public function autenticarUsuario ($params) {
            // Si el usuario ya esta autenticado, se redirecciona a la web principal.
            if ($this->user->loguedin()) {
                header("Location: " . SITE_URL);
                die();
            }

            $configvistaprincipal = array(
                'body-containers' => array(),
                'nologuedin' => true,
                'css' => array(RESOURCES_URL . 'styles/Usuario.css'),
                'js' => array(
                    RESOURCES_URL . 'js/jquery-2.min.js',
                    RESOURCES_URL . 'js/sha1.js',
                    RESOURCES_URL . 'js/Autenticacion.js'
                )
            );

            // Si ha recibido los valores de formulario en un post
            if (isset($params['post']['form-name']) && $params['post']['form-name'] = 'user-login' &&
                isset($params['post']['username']) && isset($params['post']['password-encrypted']))
            {
                if ($this->validarDatosAutenticacion($params['post']['username'], $params['post']['password-encrypted'])) {
                    header("Location: " . SITE_URL);
                    die();
                }
                else {
                    $configformlogin['form-error'] = 'Usuario o contraseña no válidos.';
                    $configformlogin['post'] = $params['post'];
                    $configvistaprincipal['body-containers'][] = $this->render('Usuario/FormularioAutenticar', $configformlogin, true);
                }
            }
            else {
                $configvistaprincipal['body-containers'][] = $this->render('Usuario/FormularioAutenticar', null, true);
            }

            $this->render('Principal', $configvistaprincipal);
        }

        /**
        * Cierra la sesión de un usario en el sistema.
        */
        public function salirUsuario ($params) {
            $this->user->logout();
            header("Location: " . SITE_URL);
            die();
        }

        /**
        * Permite recuperar la contraseña de un usuario.
        */
        public function recuperarContrasenha ($params) {
            trigger_error('Metodo no implementado.', E_USER_ERROR);
        }

        /**
        * Permite validar los datos de autenticacion de un usario.
        */
        private function validarDatosAutenticacion ($usuario, $pass) {
            if (isset($usuario) && filter_var($usuario, FILTER_VALIDATE_EMAIL) &&
                isset($pass) && strlen($pass) == 40)
            {
                $modeloUsuario = $this->loadModel('Usuario');
                $usuario = $modeloUsuario->obtenerUsuario($usuario);

                if ($usuario && $usuario['password'] == $pass) {
                    $this->user->login($usuario, $usuario['role']);
                    return TRUE;
                }
                else {
                    return FALSE;
                }
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
