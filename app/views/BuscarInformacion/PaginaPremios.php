<div class="body-element-cont body-element-small">
    <div class="body-element-title">
        <h1>Premios del concurso</h1>
    </div>
    <div class="form-element">
        <div>
            <?php
                if (isset($params['premios-content'])) {
                    echo '<div class="generic-table"><table>';
                    echo '<tr><th>Nombre</th><th>Ganador</th></tr>';
                    $pair = false;
                    foreach ($params['premios-content'] as $premio) {
                        $ganadorstr = (isset($premio['ganador'])) ? '<a href="' . SITE_URL . '/index.php/usuario/obtenerusuario/' . $premio['ganadorid'] . '" title="No implementado">' . $premio['ganador'] . '</a>' : 'Aún no se ha decidido un ganador';
                        echo '<tr class="row-' . (($pair) ? 'pair': 'nopair') . '"><td>' . $premio['nombre'] . '</td><td>' . $ganadorstr . '</td></tr>';
                        echo '<tr class="row-' . (($pair) ? 'pair': 'nopair') . '"><td colspan="3">' . $premio['descripcion'] . '</td></tr>';
                        $pair = !$pair;
                    }
                    echo '</table></div>';
                }
                else {
                    echo 'Aún no se han registrado los premios del concurso.';
                }
            ?>
        </div>
    </div>
</div>
