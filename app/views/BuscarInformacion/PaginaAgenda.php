<div class="body-element-cont body-element-small">
    <div class="body-element-title">
        <h1>Agenda del concurso</h1>
    </div>
    <div class="form-element">
        <div>
            <?php
                if (isset($params['agenda-content'])) {
                    echo '<div class="generic-table"><table>';
                    echo '<tr><th>Inicio</th><th>Fin</th><th>Evento</th></tr>';
                    $pair = false;
                    foreach ($params['agenda-content'] as $evento) {
                        echo '<tr class="row-' . (($pair) ? 'pair': 'nopair') . '"><td>' . date('Y:m:d', strtotime($evento['fecha_inicio'])) . '</td><td>' . date('Y:m:d', strtotime($evento['fecha_fin'])) . '</td><td>' . $evento['nombre'] . '</td></tr>';
                        echo '<tr class="row-' . (($pair) ? 'pair': 'nopair') . '"><td colspan="3">' . $evento['descripcion'] . '</td></tr>';
                        $pair = !$pair;
                    }
                    echo '</table></div>';
                }
                else {
                    echo 'Aún no hay ningún evento en la agenda.';
                }
            ?>
        </div>
    </div>
</div>
