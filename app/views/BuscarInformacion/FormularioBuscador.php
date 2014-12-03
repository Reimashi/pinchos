
<div class="body-element-cont body-element-regusuario">
  <form name="user-registry" action="index.php/BuscarInformacion/busar" method="POST">
    <input type="hidden" name="form-name" value="user-registry">
    <input type="hidden" name="user-type" <?php if(!$showsumenu) { echo 'value=utype_popul'; } ?>>
    <input type="hidden" name="password-encrypted">


      <div id="urf_insert_data" class="form-element" <?php if($showsumenu) { echo 'style="display:none;"'; } ?>>
        <h1>¿Que quiere buscar?</h1>
        <div class="form-line">
          <span class="form-line-space">&nbsp;</span>
        </div>
        <div class="form-line">
          <span class="form-line-title">Agenda</span>
          <span class="form-line-centered"><input type="submit" value="Ver"/></span>
        </div>
        <div class="form-line">
          <span class="form-line-space">&nbsp;</span>
        </div>
        <div class="form-line">
          <span class="form-line-title">Bases</span>
          <span class="form-line-centered"><input type="submit" value="Ver"/></span>
        </div>
        <div class="form-line">
          <span class="form-line-title">Localizaciones</span>
          <span class="form-line-centered"><input type="submit" value="Ver"/></span>
        </div>
        <div class="form-line">
          <span class="form-line-space">&nbsp;</span>
        </div>
        <div class="form-line">
          <span class="form-line-title">Premios</span>
          <span class="form-line-centered"><input type="submit" value="Ver"/></span>
        </div>

        <div class="form-line">
          <span class="form-line-space">&nbsp;</span>
        </div>
        <div class="form-line-error">
        </div>

      </div>
    </form>
  </div>
