<?php
if (defined('PINCHOSFW'))
{
    require_once (SYSTEM_FOLDER . 'Controller.php');

    class ControladorVotos extends Controller {
        /**
        * Metodo por defecto del controlador.
        */
        public function index ($params) {
          header("HTTP/1.0 404 Not Found");
        }

        /**
        * Emite un voto desde un usuario jurado publico.
        */
        public function emitirVotoPublico ($params) {
          $configvistaprincipal = array(
            'body-containers' => array()
          );

          //codigos_votados(id_voto,id_codigo)

          // Si ha recibido los valores de formulario en un post
          if (isset($params['post']['form-name']) && $params['post']['form-name'] = 'votoPopular')
          {
            $datosUsuario = array();

            // Cargamos el modelo de voto
            $modeloUsuario = $this->loadModel('voto');

            // Creamos el usuario en la base de datos
            $modeloUsuario->emitirVoto($datosUsuario);

            // Mostramos la vista de tarea completa
            return $this->registrarUsuarioVerFormularioSuccess($configvistaprincipal);
          }
          else {
            return $this->registrarUsuarioVerFormulario($configvistaprincipal);
          }


        }

        /**
        * Emite un voto desde un usuario jurado profesional.
        */
        public function emitirVotoProfesional ($params) {
            if (true) { //}$this->user->loguedin() && $this->user->is_role('utype_profe')) {
                $confprincipal = array( 'body-containers' => array() );
                $confprincipal['css'] = array(
                    RESOURCES_URL . 'styles/Votes.css'
                );

                // Si ha recibido los valores de formulario en un post
                if (isset($params['post']['form-name']) && $params['post']['form-name'] == 'private-vote')
                {
                    if ($params['post']['evaluation'] && is_numeric($params['post']['evaluation'])) {

                        // Cargamos el modelo de voto
                        $modeloVoto = $this->loadModel('voto');

                        // Registramos el voto en la base de datos
                        $modeloVoto->registrarVotoPrivado($params['post']['idvoto'], $this->user->email, $params['post']['evaluation']);

                        // Mostramos la vista de tarea completa
                        $this->registrarUsuarioVerFormularioSuccess($configvistaprincipal);
                    }
                    else {
                        $paramess = array ('info' => array(
                            'nombre' => $params['post']['vname'],
                            'descripcion' => $params['post']['vdesc']
                        ));
                        $paramess['form-error'] = 'Se ha especificado una nota inválida (0-100)';
                        $confprincipal['body-containers'][] = $this->render('Votos/FormularioEmitirVotoPrivado', $paramess, true);
                    }
                }
                else if (isset($params[0]) && is_numeric($params[0])) {
                    $modeloPincho = $this->loadModel('pinchos');
                    $infopincho = $modeloPincho->obtenerPincho($params[0]);

                    if ($infopincho && $infopincho['validado'] == 'VALIDATE') { // FIXME: Poner YES
                        $paramess = array ('info' => $infopincho);
                        $confprincipal['body-containers'][] = $this->render('Votos/FormularioEmitirVotoPrivado', $paramess, true);
                    }
                    else {
                        $confprincipal['body-containers'][] = $this->render('PaginaError', array('error' => 'El pincho indicado no existe.'), true);
                    }
                }
                else {
                    $confprincipal['body-containers'][] = $this->render('PaginaError', array('error' => 'No se ha indicado un pincho.'), true);
                }
            }
            else {
                $confprincipal['body-containers'][] = $this->render('PaginaError', array('error' => 'No tiene permiso para acceder a esta pagina.'), true);
            }

            $this->render('Principal', $confprincipal);
        }

        /**
        * Valida los datos de un voto.
        */
        private function validarDatosVoto ($datos) {
            trigger_error('Metodo no implementado.', E_USER_ERROR);
        }
    };
}
else
{
  header("HTTP/1.0 404 Not Found");
}
?>
