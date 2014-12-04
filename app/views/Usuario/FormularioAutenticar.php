<div class="body-element-cont body-element-logusuario">
<form name="user-login" action="<?php echo SITE_URL; ?>/index.php/autenticacion/autenticarUsuario" method="POST">
    <input type="hidden" name="form-name" value="user-login">
    <input type="hidden" name="password-encrypted">

    <div class="form-element">
        <h1>Iniciar sesión</h1>
        <div class="form-line">
            <span class="form-line-space">&nbsp;</span>
        </div>
        <div class="form-line">
            <span class="form-line-title">Dirección de email</span>
            <span class="form-line-input"><input type="text" name="username" <?php if(isset($params['post']['username'])) { echo "value=\"" . $params['post']['username'] . "\""; } ?>/></span>
        </div>
        <div class="form-line">
            <span class="form-line-title">Contraseña</span>
            <span class="form-line-input"><input type="password" name="password"/></span>
        </div>
        <div class="form-line">
            <span class="form-line-space">&nbsp;</span>
        </div>
        <div class="form-line-error"<?php if (isset($params['form-error'])) {
                echo '>' . $params['form-error'];
            }
            else {
                echo ' style="display: none;">';
            } ?>
        </div>
        <div class="form-line">
            <span class="form-line-centered"><span id="recup-pass"><a href="#" title="No implementado">Recuperar contraseña</a></span><input type="submit" value="Iniciar sesión"/></span>
        </div>
    </div>
</form>
</div>
