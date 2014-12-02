<?php
if (defined('PINCHOSFW'))
{
    require_once (SYSTEM_FOLDER . 'Controller.php');
    
    class ControladorPincho extends Controller {
        /**
        * Metodo por defecto del controlador.
        */
        public function index ($params) {
            header("HTTP/1.0 404 Not Found");
        }

        /**
        * Registra un nuevo pincho en el sistema.
        */
        private function registrarPincho ($params) {
            $configvistaprincipal = array(
                'body-containers' => array()
            );

            if(isset(['post']['form-name']) && $params['post']['form-name'] = 'pincho-registry'){

                $datosPincho = array();

                $datosPincho['nombre'] = $params['post']['nombre'];
                $datosPincho['descripcion'] = $params['post']['descripcion'];

                $modeloPincho = $this->loadModel('Pinchos');
                $modeloPincho->registrarPincho($datosPincho);

                return $this->registrarPinchoVerFormularioSuccess($configvistaprincipal);
            
            }else{

                return $this->registrarPinchoVerFormulario($configvistaprincipal);

            }
        }

        /**
        * Valida un pincho previamente registrado.
        */
        public function validarPincho ($params) {
            $validar = $params['post']['validado'];

            $modeloPincho = $this->loadModel('Pincho');
            $modeloPincho->registrarPincho($validar);
        }


        /**
        * Genera codigos de un pincho previamente registrado.
        */
        public function generarCodigos ($longitud=10) {
            codigo = "";
            $caracteres="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
            $max=strlen($caracteres)-1;
            for($i=0;$i < $longitud;$i++)
              {
                $codigo.=$caracteres[mt_rand(0,$max)];
              }

            return $codigo;

        }

        public function registrarPinchoVerFormulario($configvistaprincipal){
            $configvistaprincipal['body-containers'][] = $this->render('Pinchos/FormularioRegistrarPincho', ($error) ? array('form-error' => $error) : null, true);
            $this->render('Principal', $confprincipal);
        }

        public function registrarPinchoVerFormularioSucces($configvistaprincipal){
            $configvistaprincipal['body-containers'][] = $this->render('Pinchos/FormularioRegistrarPinchoSuccess', null, true);
            $this->render('Principal', $confprincipal);
        }
    };

}
else
{
    header("HTTP/1.0 404 Not Found");
}
?>
