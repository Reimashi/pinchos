<form name="votoPopular" action="index.php/votos/FormularioEmitirVotoPopular" method="POST">
  <input type="hidden" name="form-name" value="votoPopular">
  <input type="hidden" name="voto-type">

  <div class="form-element" style="display:none;">

    <div class="form-line">
      <span class="form-line-title">Codigo Pincho 1</span>
      <span class="form-line-input"><input type="text" name="codigo1"/></span>
    </div>
    <div class="form-line">
      <span class="form-line-title">Codigo Pincho 2</span>
      <span class="form-line-input"><input type="text" name="codigo2"/></span>
    </div>
    <div class="form-line">
      <span class="form-line-title">Codigo Pincho 3</span>
      <span class="form-line-input"><input type="text" name="codigo3"/></span>
    </div>

    <div class="form-line">
      <span class="form-line-space"></span>
    </div>
    <div class="form-line">
      <span class="form-line-title">¿Cual es el ganador de los 3?</span>
      <span class="form-line-input"><input type="text" name="codigo_ganador"/></span>
    </div>

    <div class="form-line">
      <span class="form-line-title">&nbsp;</span>
      <span class="form-line-title"><input type="submit" value="Votar"/></span>
    </div>

  </div>
</form>
