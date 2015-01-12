<form name="popular-vote-codes" action="emitirVotoPublico" method="POST">
  <input type="hidden" name="form-name" value="popular-vote-codes">
  <input type="hidden" name="code-01" value="popular-vote-codes">
  <input type="hidden" name="code-02" value="popular-vote-codes">
  <input type="hidden" name="code-03" value="popular-vote-codes">

  <div class="form-element">
    <div class="form-line">
      <span class="form-line-title">Pincho ganador</span>
      <span class="form-line-input">
          <select name="codeselected">
              <option value="<?php echo $params['codes']['codes-01']; ?>"><?php echo $params['codes']['codes-01']; ?></option>
              <option value="<?php echo $params['codes']['codes-02']; ?>"><?php echo $params['codes']['codes-02']; ?></option>
              <option value="<?php echo $params['codes']['codes-03']; ?>"><?php echo $params['codes']['codes-03']; ?></option>
          </select>
      </span>
    </div>
    <div class="form-line">
      <span class="form-line-space"></span>
    </div>
    <div class="form-line">
      <span class="form-line-title">&nbsp;</span>
      <span class="form-line-title"><input type="submit" value="Emitir voto"/></span>
    </div>
  </div>
</form>