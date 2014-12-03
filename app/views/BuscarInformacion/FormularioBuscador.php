
<div class="body-element-cont body-element-regusuario">
  <form name="buscador" action="index.php/BuscarInformacion/buscar" method="POST">
    <input type="hidden" name="form-name" value="buscador">
    <div class="form-element" >
      <h1>¿Que quiere buscar?</h1>
      <div class="form-line">
        <span class="form-line-space">&nbsp;</span>
      </div>
      <div class="form-line">
        <select name="tipo_busqueda">
          <option value="Agenda">Agenda</option>
          <option value="Bases">Bases</option>
          <option value="Localizaciones">Localizaciones</option>
          <option value="Premios" selected>Premios</option>
        </select>
      </div>
      <div class="form-line-error">
      </div>
      <div class="form-line">
        <span class="form-line-centered"><input type="submit" value="Buscar"/></span>
      </div>

    </div>
  </div>
</form>
</div>
