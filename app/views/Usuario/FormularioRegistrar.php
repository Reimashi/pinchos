<form name="user-registry" action="index.php/usuario/registrarUsuario" method="POST">
    <input type="hidden" name="form-name" value="user-registry">
    <input type="hidden" name="user-type">

    <div class="buttons-element">
        <ul>
            <li><a href="#" class="usertype-button"><img src="" alt="<?php echo RESOURCES_URL; ?>img/utype_jpopular.png" alt="Jurado popular"><span>Jurado popular</span></a></li>
            <li><a href="#" class="usertype-button"><img src="" alt="<?php echo RESOURCES_URL; ?>img/utype_jpro.png" alt="Jurado profesional"><span>Jurado profesional</span></a></li>
            <li><a href="#" class="usertype-button"><img src="" alt="<?php echo RESOURCES_URL; ?>img/utype_particip.png" alt="Participante"><span>Participante</span></a></li>
            <li><a href="#" class="usertype-button"><img src="" alt="<?php echo RESOURCES_URL; ?>img/utype_organizador.png" alt="Organizador"><span>Organizador</span></a></li>
        </ul>
    </div>
    <div class="form-element" style="display:none;">
        <div class="form-line">
            <span class="form-line-title">Dirección de email</span>
            <span class="form-line-input"><input type="text" name="username"/></span>
        </div>
        <div class="form-line">
            <span class="form-line-title">Contraseña</span>
            <span class="form-line-input"><input type="password" name="password"/></span>
        </div>
        <div class="form-line">
            <span class="form-line-title">Repetir contraseña</span>
            <span class="form-line-input"><input type="password" name="password2"/></span>
        </div>
        <div class="form-line">
            <span class="form-line-space"></span>
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
            <span class="form-line-space"></span>
        </div>
        <div class="form-line">
            <span class="form-line-title">&nbsp;</span>
            <span class="form-line-title"><input type="submit" value="Realizar registro"/></span>
        </div>
    </div>
</form>
