<form name="private-vote" action="<?php echo SITE_URL; ?>/index.php/votos/emitirVotoProfesional" method="POST">
    <input type="hidden" name="form-name" value="private-vote">
    <input type="hidden" name="idpincho" value="<?php echo $params['info']['id']; ?>">

    <input type="hidden" name="vname" value="<?php echo $params['info']['nombre']; ?>">
    <input type="hidden" name="vdesc" value="<?php echo $params['info']['descripcion']; ?>">

    <div class="form-element">
        <div class="form-line">
            <div class="vote-info">
                <div class="form-line-text"><?php echo $params['info']['nombre']; ?></div>
                <div class="form-line-text"><?php echo $params['info']['descripcion']; ?></div>
            </div>
        </div>
        <div class="form-line">
            <span class="form-line-space"></span>
        </div>
        <div class="form-line">
            <span class="form-line-title">¿Que nota le merece este pincho? (0-100)</span>
            <span class="form-line-input"><input type="number" name="evaluation" min="0" max="100" required="required"/></span>
        </div>
        <div class="form-line">
            <span class="form-line-space"></span>
        </div>
        <div class="form-line-error" <?php if (isset($params['form-error'])) {
            echo '>' . $params['form-error'];
        }
        else {
            echo ' style="display: none;">';
        } ?>
        </div>
        <div class="form-line">
            <span class="form-line-title">&nbsp;</span>
            <span class="form-line-title"><input type="submit" value="Votar"/></span>
        </div>
    </div>
</form>
