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
        public function registrarPincho ($params) {
            $configvistaprincipal = array(
                'body-containers' => array()
            );

            if(isset($params['post']['form-name']) && $params['post']['form-name'] = 'pincho-registry'){

                $datosPincho = array();

                $datosPincho['nombre'] = $params['post']['form-name'];
                $datosPincho['descripcion'] = $params['post']['descripcion'];

                $modeloPincho = $this->loadModel('Pinchos');
                $modeloPincho->registrarPincho($datosPincho);

                return $this->registrarPinchoVerFormularioSucces($configvistaprincipal);
            
            }else{

                return $this->registrarPinchoVerFormulario($configvistaprincipal);

            }
        }

        /**
        * Valida un pincho previamente registrado.
        */
        public function validarPincho ($params) {
            
            if(isset($params['post']['form-name']) && $params['post']['form-name'] == "pincho-validate"){
                $idpincho = $params['post']['id'];
                
                if(isset($params['post']['validar'])){
                    $validar = $params['post']['validar'];
    
                    $modeloPincho = $this->loadModel('Pincho');
                    $modeloPincho->validarPincho($validar, $idpincho);
                }else{
                    if(isset($params['post']['denegar'])){
                        $denegar = $params['post']['denegar'];
    
                        $modeloPincho = $this->loadModel('Pincho');
                        $modeloPincho->validarPincho($denegar, $idpincho);
                    }else{
                         trigger_error('Operacion no realizada', E_USER_ERROR);
                    }
                }
            }
        }


        /**
        * Genera codigos de un pincho previamente registrado.
        */
        public function generarCodigos ($idpincho, $cantidad) {
            $arCodigos = array();
                for($j=0;$j < $cantidad; $j++){
                    $longitud=5;
                    /*
                     * crear funcion en el modelo para obtener id del participante
                     * $codigo = $this->db->query("SELECT pa.id FROM pinchos AS p, participante AS pa WHERE p.id_participante=pa.id AND p.id='$idpincho'");
                    */
                    $caracteres="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
                    $max=strlen($caracteres)-1;
                    for($i=0;$i < $longitud;$i++)
                      {
                        $codigo.=$caracteres[mt_rand(0,$max)];
                      }
                      $arCodigos = array_push($codigo);
                }
            return $arCodigos;

        }

        public function registrarPinchoVerFormulario($configvistaprincipal, $error=false){
            $configvistaprincipal['body-containers'][] = $this->render('Pinchos/FormularioRegistrarPincho', ($error) ? array('form-error' => $error) : null, true);
            $configvistaprincipal['css'] = array(
                RESOURCES_URL . 'styles/Pinchos.css'
            );
            $this->render('Principal', $configvistaprincipal);
        }

        public function registrarPinchoVerFormularioSucces($configvistaprincipal){
            $configvistaprincipal['body-containers'][] = $this->render('Pinchos/FormularioRegistrarPinchoSuccess', null, true);
            $configvistaprincipal['css'] = array(
                RESOURCES_URL . 'styles/Pinchos.css'
            );
            $this->render('Principal', $configvistaprincipal);
        }
    };

}
else
{
    header("HTTP/1.0 404 Not Found");
}
?>