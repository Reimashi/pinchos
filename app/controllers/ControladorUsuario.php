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
                $datosUsuario['role'] = (isset($params['post']['user-type'])) ? $params['post']['user-type'] : '';
                $datosUsuario['email'] = (isset($params['post']['username'])) ? $params['post']['username'] : '';
                $datosUsuario['password'] = (isset($params['post']['password-encrypted'])) ? $params['post']['password-encrypted'] : '';
                $datosUsuario['firstname'] = (isset($params['post']['firstname'])) ? $params['post']['firstname'] : '';
                $datosUsuario['lastname'] = (isset($params['post']['lastname'])) ? $params['post']['lastname'] : '';
                $datosUsuario['localname'] = (isset($params['post']['localname'])) ? $params['post']['localname'] : '';
                $datosUsuario['localaddr'] = (isset($params['post']['localaddr'])) ? $params['post']['localaddr'] : '';

                $validadostate = $this->validarDatosUsuario($datosUsuario);

                if ($validadostate === TRUE) {
                    // Cargamos el modelo de Usuario
                    $modeloUsuario = $this->loadModel('Usuario');

                    if ($modeloUsuario->obtenerUsuario($datosUsuario['email'])) {
                        $paramparc['post'] = $params['post'];
                        unset($paramparc['post']['username']);
                        return $this->registrarUsuarioVerFormulario($configvistaprincipal, $paramparc, "Este <strong>email</strong> ya está registrado.");
                    }
                    else {
                        // Creamos el usuario en la base de datos
                        if ($modeloUsuario->crearUsuario($datosUsuario) === TRUE) {
                            // Mostramos la vista de tarea completa
                            return $this->registrarUsuarioVerFormularioSuccess($configvistaprincipal);
                        }
                        else {
                            $paramparc['post'] = $params['post'];
                            return $this->registrarUsuarioVerFormulario($configvistaprincipal, $paramparc, "Error al crear el usuario. Contacte con el administrador.");
                        }
                    }
                }
                else {
                    $paramparc['post'] = $params['post'];
                    return $this->registrarUsuarioVerFormulario($configvistaprincipal, $paramparc, $validadostate);
                }
            }
            else {
                return $this->registrarUsuarioVerFormulario($configvistaprincipal);
            }
        }

        private function registrarUsuarioVerFormulario($confprincipal, $params = array(), $error = false) {
            if ($error) $params = array_merge($params, array('form-error' => $error));
            $confprincipal['body-containers'][] = $this->render('Usuario/FormularioRegistrar', $params, true);
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
            // Comprobamos si los valores recibidos del formulario son los esperados
            // http://php.net/manual/en/filter.filters.validate.php

            if ($usuario['role'] != 'utype_popul' &&
                $usuario['role'] != 'utype_parti' &&
                $usuario['role'] != 'utype_profe' &&
                $usuario['role'] != 'utype_organ' ) {
                return "No se ha especificado un usuario válido.";
            }

            if (($usuario['role'] == 'utype_profe' || $usuario['role'] == 'utype_organ') &&
                (!$this->user->loguedin() || !$this->user->is_role('utype_organ'))) {
                return 'No tiene permisos suficientes para registrar un usuario de este tipo.';
            }

            if (!filter_var($usuario['email'], FILTER_VALIDATE_EMAIL)) {
                return "El email no es válido.";
            }

            if (strlen($usuario['password']) != 40) { // Tamaño de SHA1
                return "La contraseña no es válida." . strlen($usuario['password']);
            }

            if ($usuario['role'] == 'utype_profe' || $usuario['role'] == 'utype_organ') {
                if (strlen($usuario['firstname']) < 2 || strlen($usuario['firstname']) > 24) {
                    return "Debe introducir un <strong>nombre</strong> válido. (Entre 2 y 24 caracteres)";
                }

                if (strlen($usuario['lastname']) < 2 || strlen($usuario['lastname']) > 48) {
                    return "Debe introducir un <strong>apellido</strong> válido. (Entre 2 y 48 caracteres)";
                }
            }

            if ($usuario['role'] == 'utype_parti') {
                if (strlen($usuario['localname']) < 2 || strlen($usuario['lastname']) > 24) {
                    return "Debe introducir un <strong>nombre de local</strong> válido. (Entre 2 y 24 caracteres)";
                }

                if (strlen($usuario['localname']) < 2 || strlen($usuario['lastname']) > 512) {
                    return "Debe introducir una <strong>dirección</strong> válido.";
                }
            }

            return TRUE;
        }
    };

}
else
{
    header("HTTP/1.0 404 Not Found");
}
?>
