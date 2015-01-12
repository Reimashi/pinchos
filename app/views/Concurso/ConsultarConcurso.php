<div class="body-element-cont body-element-small">
  <form name="concurso-modificar" action="<?php echo SITE_URL; ?>/index.php/Concurso/modificarConcurso" method="POST">
    <input name="Nombre" <?php echo (isset($params['post']['Nombre'])) ? 'value="' . $params['post']['Nombre'] . '"' : '' ?>>
    <input name="Fecha" <?php echo (isset($params['post']['Fecha'])) ? 'value="' . $params['post']['Fecha'] . '"' : '' ?>>
    <input name="Descripcion" <?php echo (isset($params['post']['Descripcion'])) ? 'value="' . $params['post']['Descripcion'] . '"' : '' ?>>
    <input name="Bases" <?php echo (isset($params['post']['Bases'])) ? 'value="' . $params['post']['Bases'] . '"' : '' ?>>
      <span class="form-line-centered"><input type="submit" value="Modificar Concurso"/></span>
    </div>
  </form>
</div>
