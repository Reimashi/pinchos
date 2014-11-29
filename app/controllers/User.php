<?php
if (defined('PINCHOSFW'))
{
    require_once (SYSTEM_FOLDER . 'Controller.php');

    class UserController extends Controller {
        public function add ($params) {
            $parametros = array();
            $parametros['body-containers'][] = $this->render('FormRegistro', null, true);

            $this->render('Principal', $parametros);
        }
    };

}
else
{
    header("HTTP/1.0 404 Not Found");
}
?>
