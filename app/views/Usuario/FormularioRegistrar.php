<?php
    $showsumenu = false;
    if (isset($param['user']) && !$param['user']->is_role('jurado-popular')) {
        $showmenu = true;
    }
?>

<div class="body-element-cont body-element-regusuario">
<form name="user-registry" action="index.php/usuario/registrarUsuario" method="POST">
    <input type="hidden" name="form-name" value="user-registry">
    <input type="hidden" name="user-type" <?php if(!$showsumenu) { echo 'value=utype_popul'; } ?>>
    <input type="hidden" name="password-encrypted">

    <?php if($showsumenu) { ?>
    <div id="urf_select_user" class="buttons-element">
        <h1>Elija que tipo de usuario crear</h1>
        <ul class="usertype-list">
            <li><a href="#" id="utype_popul" class="usertype-button"><img src="<?php echo RESOURCES_URL; ?>img/like-128.png" alt="Jurado popular"><span>Jurado popular</span></a></li>
            <li><a href="#" id="utype_parti" class="usertype-button"><img src="<?php echo RESOURCES_URL; ?>img/restaurant-128.png" alt="Participante"><span>Participante</span></a></li>
            <?php
                if (isset($param['user']) && $param['user']->is_role('organizador')) {
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
    <div id="urf_insert_data" class="form-element" <?php if($showsumenu) { echo 'style="display:none;"'; } ?>>
        <h1>Introduzca los datos de registro</h1>
        <div class="form-line">
            <span class="form-line-space">&nbsp;</span>
        </div>
        <div class="form-line">
            <span class="form-line-title">Dirección de email</span>
            <span class="form-line-input"><input type="text" name="username"/></span>
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
        <div class="form-line">
            <span class="form-line-title">Nombre</span>
            <span class="form-line-input"><input type="text" name="firstname"/></span>
        </div>
        <div class="form-line">
            <span class="form-line-title">Apellidos</span>
            <span class="form-line-input"><input type="text" name="lastname"/></span>
        </div>
        <div class="form-line">
            <span class="form-line-space">&nbsp;</span>
        </div>
        <div class="form-line-error">
        </div>
        <div class="form-line">
            <span class="form-line-centered"><input type="submit" value="Realizar registro"/></span>
        </div>
    </div>
</form>
</div>
