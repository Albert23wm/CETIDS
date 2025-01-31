<?php
session_start();

include '../../../config/php/conexion.php';

if (!isset($_POST['Enviar'])) {
    header("Location: " . $_SERVER['HTTP_REFERER']);
    $_SESSION['error'] = "Hubo un error al enviar el formulario";
    exit();
}

// Actualizar la actividad si se envían datos por POST
$id = $_POST['id'];
$dia = $_POST['dia'];
$nombre = $_POST['nombre'];
$asistentes = $_POST['asistentes'];
$fecha = $_POST['fecha'];
$hora = $_POST['hora'];
$lugar = $_POST['lugar'];
$ponenteId = $_POST['ponente'];

// Perparar consulta
$query = "UPDATE actividades SET
    id_ponente = ?,
    nombre = ?,
    asistentes = ?,
    fecha = ?,
    dia = ?,
    hora = ?,
    ubicacion = ?
    WHERE id = $id;
";

$stmt = $conexion->prepare($query);
$stmt->bind_param('isssiss', $ponenteId, $nombre, $asistentes, $fecha, $dia, $hora, $lugar);

if (!$stmt->execute()) {
    header("Location: " . $_SERVER['HTTP_REFERER']);
    $_SESSION['error'] = "Hubo un error al actualizar los datos";
    exit();
}

header("Location: " . $_SERVER['HTTP_REFERER']);
$_SESSION['success'] = "Datos actualizados de manera correcta";
exit();