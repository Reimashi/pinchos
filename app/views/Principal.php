<!DOCTYPE html>

<html>
<head>
    <title>PinChos</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <script src="<?php echo RESOURCES_URL ?>js/common.js" type="text/javascript"></script>
    <?php if (isset($params['js']) && is_array($params['js'])) {
        foreach ($params['js'] as $script) {
            echo "<script src=\"$script\" type=\"text/javascript\"></script>";
        }
    }
    ?>
    <link rel="stylesheet" href="<?php echo RESOURCES_URL ?>styles/common.css">
    <?php
    if (isset($params['css']) && is_array($params['css'])) {
        foreach ($params['css'] as $resource) {
            echo "<link rel=\"stylesheet\" href=\"$resource\">";
        }
    } ?>
</head>

<body>
    <div id="body-wrapper">
        <header>
            <div id="head-contw">
                <div id="head-title">
                    <img src="<?php echo RESOURCES_URL ?>img/logo.png" alt="PinChos CMS Logo">
                </div>
                <div id="head-menu">
                    <ul>
                        <li><a href="<?php echo SITE_URL . '/index.php/buscarinformacion/obtenerLocalizaciones' ?>" class="menu-item">Participantes</a></li>
                        <li><a href="<?php echo SITE_URL . '/index.php/buscarinformacion/obtenerBases' ?>" class="menu-item">Bases</a></li>
                        <li><a href="<?php echo SITE_URL . '/index.php/buscarinformacion/obtenerPremios' ?>" class="menu-item">Premios</a></li>
                        <li><a href="<?php echo SITE_URL . '/index.php/buscarinformacion/obtenerAgenda' ?>" class="menu-item">Agenda</a></li>
                        <?php
                        if (isset($params['user']) && $params['user']->loguedin()) {
                            ?>
                            <li><a href="<?php echo SITE_URL . '/index.php/autenticacion/salirUsuario' ?>" class="button button-blue">Cerrar sesión</a></li>
                            <?php
                        }
                        else if (!(isset($params['nologuedin']) && $params['nologuedin'])) {
                            ?>
                            <li><a href="<?php echo SITE_URL . '/index.php/autenticacion/autenticarUsuario' ?>" class="button button-blue">Iniciar sesión</a></li>
                            <?php
                        }
                        else {
                            ?>
                            <li><a href="<?php echo SITE_URL . '/index.php/usuario/registrarUsuario' ?>" class="button button-blue">Registrarse</a></li>
                            <?php
                        } ?>
                    </ul>
                </div>
                <div class="clear-float"></div>
            </div>
        </header>
        <div id="body-container">
            <?php
                if (isset($params['body-containers'])) {
                    foreach ($params['body-containers'] as $element) {
                        ?>
                        <div class="body-element">
                        <?php
                            echo $element;
                        ?>
                        </div>
                        <?php
                    }
                }
                else {
                    echo 'Error: Algunos elementos no se han cargado correctamente';
                }
            ?>
        </div>
        <div class="push"></div>
    </div>
    <footer>
        <a href="https://github.com/Reimashi/pinchos">PinChos Framework</a> - ABP 2014
    </footer>
</body>
</html>
