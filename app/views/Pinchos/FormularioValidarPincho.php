<form name="pincho-validate" action="validarPincho" method="POST">
    <div class="usertype-list">
        <input type="hidden" name="form-name" value="pin-val">
        <?php for ($i=0; $i < count($params)-1; $i++) { ?>
            <p id="utype_popul" class="usertype-button">
                <span>Nombre:</span>
                <br>
                <?php echo $params[$i]['nombre'] ?> 
                <br><br>
                <span>Descripcion:</span> 
                <br>
                <?php echo $params[$i]['descripcion'] ?> 
                <br>
                <select name="validar">
                    <option value="WAITING">--</option>
                    <option value="VALIDATE">Validar</option>
                    <option value="DENEGATE">Denegar</option>
                </select>
                <input type="hidden" name="idpincho" value="<?php echo $params[$i]['id']?>">
                <input type="submit" value="Enviar">
                <br>
            </p>
        <?php } ?>
            
    </div>
        
</form>