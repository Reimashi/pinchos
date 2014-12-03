<?php
if (defined('PINCHOSFW'))
{
  require_once (SYSTEM_FOLDER . 'Model.php');

  class ModeloVoto extends Model {
    /**
    * Registra un voto en la base de datos.
    */
    public function registrarVoto ($voto) {
      if (isset($voto['codigo'])) {
        $querytuser ='INSERT INTO votos_populares(id_jurado,id_codigo_ganador) VALUES (' . $voto['id_jurado'] . ',' . $voto['codigo_ganador'] . ')';

        $querytuser= 'INSERT INTO codigos_votados(id_codigo) VALUES ('.$voto['codigo1']')';
        $querytuser= 'INSERT INTO codigos_votados(id_codigo) VALUES ('.$voto['codigo2']')';
        $querytuser= 'INSERT INTO codigos_votados(id_codigo) VALUES ('.$voto['codigo3']')';

        if ($this->db->query($querytuser) === TRUE) {
          return TRUE;
        }
        else {
          trigger_error('No se ha podido emitir el voto (' . $this->db->errno . ').', E_USER_ERROR);
          return FALSE;
        }
      }
      else {
        trigger_error('El metodo ModeloVoto->registrarVoto no ha recibido parametros suficientes.', E_USER_ERROR);
        return FALSE;
      }









      /*
      if (isset($voto['codigo'])) {
      $querytuser ='INSERT INTO votos_populares(id_codigo) VALUES (' . $voto['codigo1'] . ')';
      if ($this->db->query($querytuser) === TRUE) {
      $querytuser ='INSERT INTO votos_populares(id_codigo) VALUES (' . $voto['codigo2'] . ')';
      if ($this->db->query($querytuser) === TRUE) {
      $querytuser ='INSERT INTO votos_populares(id_codigo) VALUES (' . $voto['codigo3'] . ')';
      if ($this->db->query($querytuser) === TRUE) {
      return TRUE;
    }
    else {
    trigger_error('No se ha podido emitir el voto (' . $this->db->errno . ').', E_USER_ERROR);
    return FALSE;
  }
}
else {
trigger_error('El metodo ModeloVoto->registrarVoto no ha recibido parametros suficientes.', E_USER_ERROR);
return FALSE;
}
}
else {
trigger_error('El metodo ModeloVoto->registrarVoto no ha recibido parametros suficientes.', E_USER_ERROR);
return FALSE;
}*/






}

/**
* Cuenta los votos registrados en la base de datos de un pincho.
*/
public function contarVotos ($idpincho) {
  trigger_error('Metodo no implementado.', E_USER_ERROR);
}
};

}
else
{
  header("HTTP/1.0 404 Not Found");
}
?>
