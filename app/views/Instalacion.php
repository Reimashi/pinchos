<!DOCTYPE html>
<html>
    <head>
        <title>Instalador de PinChos</title>
    </head>
    <body>
        <h2>Instalador de PinChos</h2>
        <form name="install-info" action="<?php echo SITE_URL; ?>/index.php" method="POST">
        <input type="hidden" name="form-name" value="install-info">
        <h4>Base de datos</h4>
        <table>
            <tr>
                <td>Usuario:</td>
                <td><input type="text" name="dbuser"/></td>
            </tr>
            <tr>
                <td>Contraseña:</td>
                <td><input type="text" name="dbpass"/></td>
            </tr>
            <tr>
                <td>Dirección:</td>
                <td><input type="text" name="dbhost"/></td>
            </tr>
            <tr>
                <td>Tabla:</td>
                <td><input type="text" name="dbname"/></td>
            </tr>
        </table>
        <h4>Consurso</h4>
        <table>
            <tr>
                <td>Nombre:</td>
                <td><input type="text" name="concurname"/></td>
            </tr>
        </table>
        <br>
        <?php 
        if (isset($params['form-error'])) {
            echo $params['form-error'];
            echo '<br>';
        }
        ?>
        <input type="submit" value="Instalar"/>
        </form>
    </body>
</html>
