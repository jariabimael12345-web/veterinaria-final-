<?php
session_start();
$mensaje = $_SESSION['mensaje'] ?? null;
$tipo = $_SESSION['tipo_mensaje'] ?? null;
unset($_SESSION['mensaje'], $_SESSION['tipo_mensaje']);
?>
<!DOCTYPE html>
<html>
<head>

<title>Santuario de Mascotas</title>

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

</head>

<body class="w3-light-grey">

<div class="w3-container">

<h2 class="w3-blue w3-padding">Registro de Mascotas</h2>

<?php if($mensaje): ?>
    <div class="w3-panel <?= $tipo === 'exito' ? 'w3-green' : 'w3-red' ?> w3-round">
        <p><?= htmlspecialchars($mensaje) ?></p>
    </div>
<?php endif; ?>

<form action="guardar.php" method="post" class="w3-card w3-white w3-padding">

<input type="hidden" name="origen" value="index">

<label>Nombre</label>
<input class="w3-input w3-border" type="text" name="nombre" required>

<label>Especie</label>
<input class="w3-input w3-border" type="text" name="especie" required>

<label>Raza</label>
<input class="w3-input w3-border" type="text" name="raza" required>

<label>Edad</label>
<input class="w3-input w3-border" type="number" name="edad" required>

<label>Peso</label>
<input class="w3-input w3-border" type="number" step="0.01" name="peso" required>

<label>Color o señas físicas</label>
<input class="w3-input w3-border" type="text" name="color">

<label>Responsable</label>
<input class="w3-input w3-border" type="text" name="responsable" required>

<label>Teléfono</label>
<input class="w3-input w3-border" type="text" name="telefono">

<br>

<input class="w3-button w3-green" type="submit" value="Guardar">

<input class="w3-button w3-red" type="reset" value="Limpiar">

</form>

<p class="w3-margin-top">
    <a href="lista.php" class="w3-button w3-blue">Ver lista de mascotas registradas</a>
</p>

</div>

</body>
</html>
