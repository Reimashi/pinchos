<?php
if (defined('PINCHOSFW'))
{
    require_once (SYSTEM_FOLDER . 'Controller.php');

    class User extends Controller {
        public function add ($params) {
            // Ejemplo de carga de un modelo
            $this->loadModel('Users');
            // Ejemplo de usar una función de un modelo
            $this->models->Users->getUser(0);

            // Ejemplo de renderizar una vista parcial (devuelve el codigo html)
            $parametros = Array();
            $vistaparcial = $this->render('nombrevista', $parametros, true);
            // Ejemplo de renderizar una vista completa (imprime en el navegador)
            $this->render('nombrevista', $parametros);
        }
    };

}
else
{
    header("HTTP/1.0 404 Not Found");
}
?>
