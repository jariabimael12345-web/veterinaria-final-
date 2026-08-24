<?php

session_start();

require_once("Mascota.php");
require_once("GuardarMascota.php");
require_once("funciones.php");

$origen = isset($_POST['origen']) ? $_POST['origen'] : 'index';
$destino = ($origen === 'dashboard') ? 'dashboard_vet.php' : 'index.php';

try{

    $nombre      = limpiar($_POST['nombre']);
    $especie     = limpiar($_POST['especie']);
    $raza        = limpiar($_POST['raza']);
    $edad        = limpiar($_POST['edad']);
    $peso        = limpiar($_POST['peso']);
    $color       = limpiar($_POST['color']);
    $responsable = limpiar($_POST['responsable']);
    $telefono    = limpiar($_POST['telefono']);

    if($nombre === '' || $especie === '' || $raza === '' || $responsable === ''){
        throw new Exception("Por favor completa todos los campos obligatorios.");
    }

    if(!is_numeric($peso) || $peso <= 0){
        throw new Exception("El peso debe ser mayor que cero.");
    }

    if(!is_numeric($edad) || $edad < 0){
        throw new Exception("La edad no es válida.");
    }

    $mascota = new Mascota(
        $nombre,
        $especie,
        $raza,
        $edad,
        $peso,
        $color,
        $responsable,
        $telefono
    );

    $guardar = new GuardarMascota();
    $guardar->guardar($mascota);

    $_SESSION['mensaje'] = "Mascota registrada correctamente.";
    $_SESSION['tipo_mensaje'] = "exito";

}catch(Exception $e){

    $_SESSION['mensaje'] = $e->getMessage();
    $_SESSION['tipo_mensaje'] = "error";

}

header("Location: " . $destino);
exit;

?>
