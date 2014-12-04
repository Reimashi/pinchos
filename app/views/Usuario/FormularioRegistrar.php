<div class="body-element-cont body-element-regusuario">
<form name="user-registry" action="<?php echo SITE_URL; ?>/index.php/usuario/registrarUsuario" method="POST">
    <input type="hidden" name="form-name" value="user-registry">
    <input type="hidden" name="user-type" <?php echo (isset($params['post']['user-type'])) ? 'value="' . $params['post']['user-type'] . '"' : '' ?>>
    <input type="hidden" name="password-encrypted">

    <?php if(!isset($params['post']['user-type'])) { ?>
    <div id="urf_select_user" class="buttons-element">
        <h1>Elija que tipo de usuario crear <?php print_r($params['user']->get_role()); ?></h1>
        <ul class="usertype-list">
            <li><a href="#" id="utype_popul" class="usertype-button"><img src="<?php echo RESOURCES_URL; ?>img/like-128.png" alt="Jurado popular"><span>Jurado popular</span></a></li>
            <li><a href="#" id="utype_parti" class="usertype-button"><img src="<?php echo RESOURCES_URL; ?>img/restaurant-128.png" alt="Participante"><span>Participante</span></a></li>
            <?php
                if (isset($params['user']) && $params['user']->is_role('utype_organ')) {
            ?>
            <li><a href="#" id="utype_profe" class="usertype-button"><img src="<?php echo RESOURCES_URL; ?>img/edit-128.png" alt="Jurado profesional"><span>Jurado profesional</span></a></li>
            <li><a href="#" id="utype_organ" class="usertype-button"><img src="<?php echo RESOURCES_URL; ?>img/gear-128.png" alt="Organizador"><span>Organizador</span></a></li>
            <?php
                }
            ?>
        </ul>
        <div class="clear-float"></div>
    </div>
    <?php } ?>
    <div id="urf_insert_data" class="form-element" <?php echo (!isset($params['post']['user-type'])) ? 'style="display:none;"' : '' ?>>
        <h1>Introduzca los datos de registro</h1>
        <div class="form-line">
            <span class="form-line-space">&nbsp;</span>
        </div>
        <div class="form-line">
            <span class="form-line-title">Dirección de email</span>
            <span class="form-line-input"><input type="text" name="username" <?php echo (isset($params['post']['username'])) ? 'value="' . $params['post']['username'] . '"' : '' ?>/></span>
        </div>
        <div class="form-line">
            <span class="form-line-space">&nbsp;</span>
        </div>
        <div class="form-line">
            <span class="form-line-title">Contraseña</span>
            <span class="form-line-input"><input type="password" name="password"/></span>
        </div>
        <div class="form-line">
            <span class="form-line-title">Repetir contraseña</span>
            <span class="form-line-input"><input type="password" name="password-repeat"/></span>
        </div>
        <div class="form-line">
            <span class="form-line-space">&nbsp;</span>
        </div>
        <?php
            $showorgjur = (isset($params['post']['user-type']) && ($params['post']['user-type'] == "utype_profe" || $params['post']['user-type'] == "utype_organ"));
            $showpart = (isset($params['post']['user-type']) && $params['post']['user-type'] == "utype_parti");
        ?>
        <div class="form-line orgjur-info" <?php if (!$showorgjur) echo 'style="display: none;"'; ?>>
            <span class="form-line-title">Nombre</span>
            <span class="form-line-input"><input type="text" name="firstname" <?php echo (isset($params['post']['firstname'])) ? 'value="' . $params['post']['firstname'] . '"' : '' ?>/></span>
        </div>
        <div class="form-line orgjur-info" <?php if (!$showorgjur) echo 'style="display: none;"'; ?>>
            <span class="form-line-title">Apellidos</span>
            <span class="form-line-input"><input type="text" name="lastname" <?php echo (isset($params['post']['lastname'])) ? 'value="' . $params['post']['lastname'] . '"' : '' ?>/></span>
        </div>
        <div class="form-line part-info" <?php if (!$showpart) echo 'style="display: none;"'; ?>>
            <span class="form-line-title">Nombre del local</span>
            <span class="form-line-input"><input type="text" name="localname" <?php echo (isset($params['post']['localname'])) ? 'value="' . $params['post']['localname'] . '"' : '' ?>/></span>
        </div>
        <div class="form-line part-info"<?php if (!$showpart) echo 'style="display: none;"'; ?>>
            <span class="form-line-title">Dirección del local</span>
            <span class="form-line-input"><input type="text" name="localaddr" <?php echo (isset($params['post']['localaddr'])) ? 'value="' . $params['post']['localaddr'] . '"' : '' ?>/></span>
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
