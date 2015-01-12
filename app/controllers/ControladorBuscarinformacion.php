<?php
if (defined('PINCHOSFW'))
{
    require_once (SYSTEM_FOLDER . 'Controller.php');

    class ControladorBuscarInformacion extends Controller {
        /**
        * Metodo por defecto del controlador.
        */
        public function index ($params) {
            return $this->obtenerLocalizaciones($params);
        }

        /**
        * Busca informacion a partir de un string en el sistema.
        */
        public function buscarInformacion ($params) {
            if (isset($params['post']['form-name']) && $params['post']['form-name'] == 'buscador') {

                if($params['post']['tipo_busqueda'] == 'Agenda')
                {
                    $this->obtenerAgenda($params);
                }
                if($params['post']['form-name'] == 'Bases')
                {
                    $this->render('PaginaBases', null);
                }
                if($params['post']['form-name'] == 'Localizacion')
                {
                    $this->render('PaginaLocalizaciones', null);
                }
                if($params['post']['form-name'] == 'Premios')
                {
                    $this->render('PaginaPremios', null);
                }
            }
            else {
                // Imprimes formulario
                $htmlform = $this->render('BuscarInformacion/FormularioBuscador', null, true);
                $this->render('Principal', array('body-containers' => array($htmlform)));
            }
        }

        /**
        * Muestra la agenda de un concurso.
        */
        public function obtenerAgenda ($params) {
            $baseform = array();
            $htmlform = array();

            $modeloAgenda = $this->loadModel('Agenda');
            $datosAgenda = $modeloAgenda->consultarAgenda($params);

            if ($datosAgenda) {
                $baseform['agenda-content'] = $datosAgenda;
            }

            $htmlform['body-containers'] = array();
            $htmlform['body-containers'][] = $this->render('BuscarInformacion/PaginaAgenda', $baseform, true);
            $this->render('Principal', $htmlform);
        }

        /**
        * Obtiene las localizaciones de los pinchos de un concurso.
        */
        public function obtenerLocalizaciones ($params) {
            $baseform = array();
            $htmlform = array();

            $modeloConcurso = $this->loadModel('Concurso');
            // Sin soporte para multiples concursos, concurso siempre será 1
            $datosConcurso = $modeloConcurso->obtenerConcurso(1, array('nombre', 'descripcion', 'fecha'));

            if ($datosConcurso) {
                $baseform['concurso-info'] = $datosConcurso;
            }
            else {
                $htmlform['body-containers'] = array();
                $htmlform['body-containers'][] = $this->render('PaginaError', array('error' => 'Aún no se ha registrado ningún concurso.'), true);
                return $this->render('Principal', $htmlform);
            }

            $modeloPinchos = $this->loadModel('Pinchos');
            $datosPinchos = $modeloPinchos->obtenerLocalizaciones();

            if ($datosPinchos) {
                $baseform['places-content'] = $datosPinchos;
            }

            $htmlform['body-containers'] = array();
            $htmlform['body-containers'][] = $this->render('BuscarInformacion/PaginaLocalizaciones', $baseform, true);
            $this->render('Principal', $htmlform);
        }

        /**
        * Obtiene las bases de un concurso.
        */
        public function obtenerBases ($params) {
            $baseform = array();
            $htmlform = array();

            $modeloConcurso = $this->loadModel('Concurso');
            $datosConcurso = $modeloConcurso->consultarBases($params); // Que es validar?

            if ($datosConcurso) {
                $baseform['bases-content'] = $datosConcurso;
            }

            $htmlform['body-containers'] = array();
            $htmlform['body-containers'][] = $this->render('BuscarInformacion/PaginaBases', $baseform, true);
            $this->render('Principal', $htmlform);
        }

        /**
        * Obtiene la lista de premios de un concurso.
        */

        public function obtenerPremios ($params) {
            $baseform = array();
            $htmlform = array();

            $modeloPremios = $this->loadModel('Premios');
            $premios = $modeloPremios->listarPremios(1);

            if ($premios) {
                $baseform['premios-content'] = $premios;
            }

            $htmlform['body-containers'] = array();
            $htmlform['body-containers'][] = $this->render('BuscarInformacion/PaginaPremios', $baseform, true);
            $this->render('Principal', $htmlform);
        }
    };

}
else
{
    header("HTTP/1.0 404 Not Found");
}
?>
