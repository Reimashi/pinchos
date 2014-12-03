<!-- NO HACER CASO A LO QUE HAY DEBAJO. ESTÁ SIN PROBAR PERO DUDO QUE FUNCIONE -->
<form name="pincho-validate" action="index.php/pinchos/validarPincho" method="POST">

    <input type="hidden" name="form-name" value="pincho-validate">
    <input type="hidden" name="id">
    
    <?php 
        $mod = &getinstance(); 
        $mod->load->model("ModeloPincho");
        $res = $mod->ModeloPincho->obtenerPincho("id");
        
        echo $res["nombre"];
        echo $res["descripcion"];
        echo $res["id_participante"];
    ?>
    <input type="submit" name="validar" value="VALIDATE">
    <input type="submit" name="denegar" value="DENEGATE">
    
</form>