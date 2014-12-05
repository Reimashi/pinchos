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
                'body-containers' => array(),
            );

            if(isset($params['post']['form-name']) && $params['post']['form-name'] = 'pincho-registry'){

                $datosPincho = array();
                $datosPincho['nombre'] .= $params['post']['nombre'];
                $datosPincho['descripcion'] .= $params['post']['descripcion'];

                $modeloPincho = $this->loadModel('Pinchos');
                if($modeloPincho->registrarPincho($datosPincho)){
                    return $this->registrarPinchoVerFormularioSuccess($configvistaprincipal, $datosPincho);
                }else{
                    trigger_error('Error al registrar el pincho (' . $this->db->errno . ').', E_USER_ERROR);
                }

                
            
            }else{

                return $this->registrarPinchoVerFormulario($configvistaprincipal);

            }
        }

        /**
        * Valida un pincho previamente registrado.
        */
        public function validarPincho ($params) {
            
            $configvistaprincipal = array(
                'body-containers' => array()
            );

            if(isset($params['post']['form-name']) && $params['post']['form-name'] == "pincho-validate"){
                
                $idpincho = $params['post']['idpincho'];

                if ($params['post']['validar'] == 'VALIDATE') {
                    $validar = "YES";
                    $modeloPincho->validarPincho($validar, $idpincho)
                }
                if ($params['post']['validar'] == 'DENEGATE') {
                    $validar = "NO";
                    $modeloPincho->validarPincho($validar, $idpincho);
                }
                
            }else{
                $pinchos = array();
                $pin_f = array();
                $modeloPincho = $this->loadModel('Pinchos');
                $pinchos = $modeloPincho->listarPinchos();
                foreach ($pinchos as $pincho) {
                    if($pincho['validado'] == 'WAITING'){
                        $pin_f[] = $pincho;
                    }
                }
                return $this->validarPinchoVerFormulario($configvistaprincipal, $pin_f);
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

        public function registrarPinchoVerFormularioSuccess($configvistaprincipal, $datosPincho){
            $configvistaprincipal['body-containers'][] = $this->render('Pinchos/FormularioRegistrarPinchoSuccess', $datosPincho, true);
            $configvistaprincipal['css'] = array(
                RESOURCES_URL . 'styles/Pinchos.css'
            );
            $this->render('Principal', $configvistaprincipal);
        }

        public function validarPinchoVerFormulario($configvistaprincipal, $lista){
            $configvistaprincipal['body-containers'][] = $this->render('Pinchos/FormularioValidarPincho', $lista, true);
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