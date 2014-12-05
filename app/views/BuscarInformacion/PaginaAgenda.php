<?php echo print_r($params); ?>

<?php foreach($params as $array): ?>

    <p>Nombre de la Actividad: <?php print_r($array['nombre']); ?></p>
    <p>Descripcion : <?php print_r($array['descripcion']); ?></p>
    <p>Fecha Inicio: <?php print_r($array['fecha_inicio']); ?></p>
    <p>Fecha Fin: <?php print_r($array['fecha_fin']); ?></p>
    </br>

  <?php endforeach; ?>
