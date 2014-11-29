<!DOCTYPE html>

<html>
<head>
  <title>PinChos</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <link rel="stylesheet" href="<?php echo RESOURCES_URL ?>styles/common.css">
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
                        echo $element;
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
