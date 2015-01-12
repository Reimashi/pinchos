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
        public function emitirVotoPopular ($params) {
            $configvistaprincipal = array(
                'body-containers' => array()
            );
            
            if (isset($params['post']['form-name']) && $params['post']['form-name'] == 'popular-vote-select'){
                $modeloPincho = $this->loadModel('pinchos');
                $modeloVoto = $this->loadModel('voto');
                $paramsview = array();
                
                if (isset($params['post']['codeselected']) && 
                        $params['post']['codeselected'] != "" && 
                        $modeloPincho->comprobarCodigo($params['post']['codeselected'])) {
                    $modeloVoto->registrarVotoPublico($params['post']['codeselected'],
                            array (
                                $params['post']['code-01'],
                                $params['post']['code-02'],
                                $params['post']['code-03']
                            ));
                    
                    $paramsview['body-containers'][] = $this->render('Votos/FormularioVotadoSuccess', $paramsview, true);
                    $paramsview['css'] = array(
                        RESOURCES_URL . 'styles/Votes.css'
                    );
                    $this->render('Principal', $paramsview);
                }
                else {
                    $paramsview['form-error'] = "Ha habido un error al registrar el voto para el pincho seleccionado.";
                    $paramsview['body-containers'][] = $this->render('Votos/FormularioEmitirVotoPublico', $paramsview, true);
                    $paramsview['css'] = array(
                        RESOURCES_URL . 'styles/Votes.css'
                    );
                    $this->render('Principal', $paramsview);
                }
                $votos = array();
                $votos[] = $params['post']['code'];
                $modeloPincho->registrarVotoPublico($votos, false);

                $confprincipal['body-containers'][] = $this->render('Votos/FormularioEmitirVotoSeleccionarVoto', $votos, true);
                $confprincipal['css'] = array(
                    RESOURCES_URL . 'styles/Votes.css'
                );
                $this->render('Principal', $confprincipal);

            }
            if (isset($params['post']['form-name']) && $params['post']['form-name'] == 'popular-vote-codes') {
                $modeloPincho = $this->loadModel('pinchos');
                $paramsview = array();
                
                if (isset($params['post']['code-01']) && 
                        $params['post']['code-01'] != "" && 
                        $modeloPincho->comprobarCodigo($params['post']['code-01'])) {
                    $paramsview['codes']['codes-01'] = $params['post']['code-01'];
                }
                else {
                    $paramsview['form-error'] = "El codigo 01 es inválido.";
                    $paramsview['body-containers'][] = $this->render('Votos/FormularioEmitirVotoPublico', $paramsview, true);
                    $paramsview['css'] = array(
                        RESOURCES_URL . 'styles/Votes.css'
                    );
                    $this->render('Principal', $paramsview);
                }
                
                if (isset($params['post']['code-02']) && 
                        $params['post']['code-02'] != "" && 
                        $modeloPincho->comprobarCodigo($params['post']['code-02'])) {
                    $paramsview['codes']['codes-02'] = $params['post']['code-02'];
                }
                else {
                    $paramsview['form-error'] = "El codigo 02 es inválido.";
                    $paramsview['body-containers'][] = $this->render('Votos/FormularioEmitirVotoPublico', $paramsview, true);
                    $paramsview['css'] = array(
                        RESOURCES_URL . 'styles/Votes.css'
                    );
                    $this->render('Principal', $paramsview);
                }
                
                if (isset($params['post']['code-03']) && 
                        $params['post']['code-03'] != "" && 
                        $modeloPincho->comprobarCodigo($params['post']['code-03'])) {
                    $paramsview['codes']['codes-03'] = $params['post']['code-03'];
                }
                else {
                    $paramsview['form-error'] = "El codigo 03 es inválido.";
                    $paramsview['body-containers'][] = $this->render('Votos/FormularioEmitirVotoPublico', $paramsview, true);
                    $paramsview['css'] = array(
                        RESOURCES_URL . 'styles/Votes.css'
                    );
                    $this->render('Principal', $paramsview);
                }
                
                $paramsview['form-error'] = "El codigo 03 es inválido.";
                $paramsview['body-containers'][] = $this->render('Votos/FormularioEmitirVotoPublicoSelect', $paramsview, true);
                $paramsview['css'] = array(
                    RESOURCES_URL . 'styles/Votes.css'
                );
                $this->render('Principal', $paramsview);
            }
            else
            {
               $confprincipal['body-containers'][] = $this->render('Votos/FormularioEmitirVotoPublico', ($error= false) ? array('form-error' => $error) : null, true);
               $confprincipal['css'] = array(
                   RESOURCES_URL . 'styles/Votes.css'
               );
               $this->render('Principal', $confprincipal);
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

                    if ($infopincho && $infopincho['validado'] == 'YES') {
                        $paramess = array ('info' => $infopincho);
                        $confprincipal['body-containers'][] = $this->render('Votos/FormularioEmitirVotoPrivado', $paramess, true);
                    }
                    else {
                        $confprincipal['body-containers'][] = $this->render('PaginaError', array('error' => 'El pincho indicado no existe.'), true);
                    }
                }else {
                    $confprincipal['body-containers'][] = $this->render('PaginaError', array('error' => 'No se ha indicado un pincho.'), true);
                }
            }
            else {
                $confprincipal['body-containers'][] = $this->render('PaginaError', array('error' => 'No tiene permiso para acceder a esta pagina.'), true);
            }
            $confprincipal['body-containers'][] = $this->render('Votos/FormularioEmitirVotoPrivado', ($error= false) ? array('form-error' => $error) : null, true);
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
