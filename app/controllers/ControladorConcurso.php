<?php
if (defined('PINCHOSFW'))
{
    require_once (SYSTEM_FOLDER . 'Controller.php');

    class ControladorConcurso extends Controller {
        /**
        * Metodo por defecto del controlador.
        */
        public function index ($params) {
            return obtenerUsuario($params);
        }

        /**
         * Registra un nuevo usuario en el sistema.
         */
        public function registrarConcurso ($params) {
            $configvistaprincipal = array(
                'body-containers' => array()
            );

            // Si ha recibido los valores de formulario en un post
            if (isset($params['post']['form-name']) && $params['post']['form-name'] = 'concurso-registry')
            {
                $datosUsuario = array();
                $datosUsuario['nombre'] = (isset($params['post']['concursoname'])) ? $params['post']['concursoname'] : '';
                $datosUsuario['fecha'] = (isset($params['post']['date'])) ? $params['post']['date'] : '';
                $datosUsuario['descripcion'] = (isset($params['post']['description'])) ? $params['post']['description'] : '';
                $datosUsuario['bases'] = (isset($params['post']['bases'])) ? $params['post']['bases'] : '';
            }
        }

        private function registrarConcursoVerFormulario($confprincipal, $params = array(), $error = false) {
            if ($error) $params = array_merge($params, array('form-error' => $error));
            $confprincipal['body-containers'][] = $this->render('Concurso/FormularioRegistrar', $params, true);
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

        private function registrarConcursoVerFormularioSuccess($confprincipal) {
            $confprincipal['css'] = array(
                RESOURCES_URL . 'styles/Usuario.css'
            );
            $confprincipal['body-containers'][] = $this->render('Concurso/FormularioRegistrarSuccess', null, true);
            $this->render('Principal', $confprincipal);
        }

        /**
        * Registra un nuevo usuario en el sistema.
        */
        public function borrarConcurso ($params) {
            trigger_error('Metodo no implementado.', E_USER_ERROR);
        }

        /**
        * Obtiene y muestra un usuario del sistema.
        */
        public function obtenerConcurso ($params) {
            trigger_error('Metodo no implementado.', E_USER_ERROR);
        }

        /**
        * Obtiene y muestra un usuario del sistema.
        */

    };

}
else
{
    header("HTTP/1.0 404 Not Found");
}
?>
