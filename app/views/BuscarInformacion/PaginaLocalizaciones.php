<div class="body-element-cont body-element-small">
    <div class="body-element-title">
        <h1>Concurso: <?php echo $params['concurso-info']['nombre']; ?></h1>
    </div>
    <div class="form-element">
        <div class="form-line"><?php echo $params['concurso-info']['descripcion']; ?></div>
        <div class="form-line form-line-space">&nbsp;</div>
        <div>
            <?php
                if (isset($params['places-content'])) {

                    echo '<div class="body-element-title">
                        <h1>Lista de concursantes</h1>
                    </div>
                    <div class="form-line form-line-space">&nbsp;</div>';

                    echo '<div class="generic-table"><table>';
                    $pair = true;
                    foreach ($params['places-content'] as $evento) {
                        echo '<tr class="row-' . (($pair) ? 'pair': 'nopair') . '"><td>' . $evento['nombre'] . '</td>';
                        if ($params['user']->is_role('utype_popul')) {
                            echo '<td rowspan="2"><a href="' . SITE_URL . '/index.php/votos/emitirvotopopular/' . $evento['id'] . '" class="button">Votar</a></td>';
                        }
                        else if ($params['user']->is_role('utype_profe')) {
                            echo '<td rowspan="2"><a href="' . SITE_URL . '/index.php/votos/emitirvotoprofesional/' . $evento['id'] . '" class="button">Votar</a></td>';
                        }
                        else {
                            echo '</tr>';
                        }
                        echo '<tr class="row-' . (($pair) ? 'pair': 'nopair') . '"><td>' . $evento['direccion'] . '</td></tr>';
                        $pair = !$pair;
                    }
                    echo '</table></div>';
                }
                else {
                    echo 'Aún no hay ningún concursante inscrito. Vuelve pronto para ver la lista de participantes.';
                }
            ?>
        </div>
    </div>
</div>
