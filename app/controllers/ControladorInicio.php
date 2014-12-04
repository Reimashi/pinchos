<?php
if (defined('PINCHOSFW'))
{
    require_once (SYSTEM_FOLDER . 'Controller.php');

    class ControladorInicio extends Controller {
        public function index ($params) {
            $configvistaprincipal['css'] = array( RESOURCES_URL . 'styles/Usuario.css' );
            $configvistaprincipal['body-containers'][] = $this->render('Usuario/FormularioRegistrarSuccess', null, true);
            $this->render('Principal', $configvistaprincipal);
        }
    };

}
else
{
    header("HTTP/1.0 404 Not Found");
}
?>
