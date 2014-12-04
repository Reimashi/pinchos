<?php
if (defined('PINCHOSFW'))
{
    require_once (SYSTEM_FOLDER . 'Controller.php');

    class ControladorBuscarInformacion extends Controller {
        /**
        * Metodo por defecto del controlador.
        */
        public function index ($params) {
            return buscarInformacion($params);
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
          }        }

        /**
        * Muestra la agenda de un concurso.
        */
        public function obtenerAgenda ($params) {
          $modeloAgenda = $this->loadModel('Agenda');
          $modeloAgenda->consultarAgenda($validar);

          $htmlform = $this->render('BuscarInformacion/PaginaAgenda', null, true);
          $this->render('Principal', array('body-containers' => array($htmlform)));

        }

        /**
        * Obtiene las localizaciones de los pinchos de un concurso.
        */
        public function obtenerLocalizaciones ($params) {

          $modeloLocalizaciones = $this->loadModel('Localizaciones');
          $modeloLocalizaciones->consultarAgenda($validar);

          $htmlform = $this->render('BuscarInformacion/PaginaLocalizaciones', null, true);
          $this->render('Principal', array('body-containers' => array($htmlform)));

        }

        /**
        * Obtiene las bases de un concurso.
        */
        private function obtenerBases ($params) {

          $modeloBases = $this->loadModel('Bases');
          $modeloBases->consultarAgenda($validar);

          $htmlform = $this->render('BuscarInformacion/PaginaBases', null, true);
          $this->render('Principal', array('body-containers' => array($htmlform)));
          

        }

        /**
        * Obtiene la lista de premios de un concurso.
        */

        private function obtenerPremios ($params) {
          $validar = $params['post']['validado'];

          $modeloconcurso = $this->loadModel('Premios');
          $premios=$modeloConcurso->consultarPremios($validar);
          //include($_SERVER['DOCUMENT_ROOT'].'/views/BuscarInformacion/FormularioBuscador.php')
          $this->render('FormularioBuscador', $premios);
        }
    };

}
else
{
    header("HTTP/1.0 404 Not Found");
}
?>
