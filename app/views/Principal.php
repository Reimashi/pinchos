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
                        <li><a href="#" class="menu-item">Inicio</a></li>
                        <li><a href="#" class="menu-item">Participantes</a></li>
                        <li><a href="#" class="menu-item">Bases</a></li>
                        <li><a href="#" class="menu-item">Agenda</a></li>
                        <?php
                        if (isset($params['user']) && $params['user']->loguedin()) {
                            ?>
                            <li><a href="#" class="button button-blue">Cerrar sesión</a></li>
                            <?php
                        }
                        else {
                            ?>
                            <li><a href="#" class="button button-blue">Iniciar sesión</a></li>
                            <?php
                        }
                        ?>
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
        Copyright
    </footer>
</body>
</html>
