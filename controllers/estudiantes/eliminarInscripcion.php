<?php
session_start();

include '../../config/php/conexion.php';

if(!isset($_POST['eliminar'])){
    $_SESSION['error'] = 'No se puedo inscribir al taller';
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
}

// Obtener datos para la consulta
$idInscripcion = $_POST['idInscripcion'];
$idTaller = $_POST['idTaller'];
$matricula = $_SESSION['idEstudiante'];

// Reestablecer el cupo del taller
$query = "UPDATE talleres SET cupo = cupo + 1 WHERE id = ?";

$stmt = $conexion->prepare($query);
$stmt->bind_param('i', $idTaller);

if(!$stmt->execute()){
    $_SESSION["error"] = "Hubo un error eliminar tu inscripción";
    header("Location: ". $_SERVER['HTTP_REFERER']);
    exit();
}

$stmt->close();

// Eliminar inscripcion 
$query = "DELETE FROM inscripciones WHERE id = ?";

$stmt = $conexion->prepare($query);
$stmt->bind_param("i", $idInscripcion);

if(!$stmt->execute()){
    $_SESSION["error"] = "Hubo un error eliminar tu inscripción";
    header("Location: ". $_SERVER['HTTP_REFERER']);
    exit();
}

$_SESSION["success"] = "Se ha eliminado tu inscripción del taller";
header("Location: ". $_SERVER['HTTP_REFERER']);
exit();