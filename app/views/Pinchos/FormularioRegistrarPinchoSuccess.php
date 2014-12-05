<form name="pincho-registry-succes" action="/index.php" method="POST">
	<input type="hidden" name="form-name" value="pincho-reg-succ">
	<br>
	<h1>Pincho añadido</h1><br>

	<p>Nombre: <?php echo $params['nombre']; ?></p>
	<p>Nombre: <?php echo $params['descripcion']; ?></p><br>
	<p>Pulsa "Atrás" para volver a la página principal</p>
    <input type="submit" value="Atras">
</form>