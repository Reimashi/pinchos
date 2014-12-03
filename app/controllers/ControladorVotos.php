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
    private function emitirVotoProfesional ($params) {
      trigger_error('Metodo no implementado.', E_USER_ERROR);
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
