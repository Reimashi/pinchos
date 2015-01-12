<div class="body-element-cont body-element-regusuario">
<form name="user-registry" action="<?php echo SITE_URL; ?>/index.php/concurso/registrarUsuario" method="POST">
    <input type="hidden" name="form-name" value="concurso-registry">

    <div id="urf_insert_data" class="form-element" <?php echo (!isset($params['post']['user-type'])) ? 'style="display:none;"' : '' ?>>
        <h1>Introduzca los datos de registro</h1>
        <div class="form-line">
            <span class="form-line-space">&nbsp;</span>
        </div>
        <div class="form-line">
            <span class="form-line-title">Nombre del concurso</span>
            <span class="form-line-input"><input type="text" name="nombre" <?php echo (isset($params['post']['nombre'])) ? 'value="' . $params['post']['nombre'] . '"' : '' ?>/></span>
        </div>
        <div class="form-line">
            <span class="form-line-space">&nbsp;</span>
        </div>
        <div class="form-line">
            <span class="form-line-title">Fecha</span>
            <span class="form-line-input"><input type="date" name="fecha"/></span>
        </div>
        <div class="form-line">
            <span class="form-line-title">Descripcion</span>
            <span class="form-line-input"><input type="text" name="descripcion"/></span>
        </div>
        <div class="form-line">
            <span class="form-line-space">&nbsp;</span>
        </div>
        <div class="form-line">
          <span class="form-line-title">Bases</span>
          <span class="form-line-input"><input type="text" name="bases"/></span>
        </div>

        <div class="form-line">
            <span class="form-line-space">&nbsp;</span>
        </div>
        <div class="form-line-error" <?php if (isset($params['form-error'])) {
                echo '>' . $params['form-error'];
            }
            else {
                echo ' style="display: none;">';
            } ?>
        </div>
        <div class="form-line">
            <span class="form-line-centered"><input type="submit" value="Realizar registro"/></span>
        </div>
    </div>
</form>
</div>
