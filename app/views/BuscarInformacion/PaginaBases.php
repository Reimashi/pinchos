<div class="body-element-cont body-element-small">
    <div class="body-element-title">
        <h1>Bases del concurso</h1>
    </div>
    <div class="form-element">
        <div>
            <?php
                if (isset($params['bases-content'])) {
                    echo $params['bases-content'];
                }
                else {
                    echo 'Aún no se han creado bases para este concurso';
                }
            ?>
        </div>
    </div>
</div>
