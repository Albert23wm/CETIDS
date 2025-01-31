<?php
session_start();

include '../../config/php/conexion.php';

if(!isset($_POST['inscribirse'])){
    $_SESSION['error'] = 'No se puedo inscribir al taller';
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
}

// Obtener datos para la consulta
$id = $_POST['id'];
$matricula = $_SESSION['idEstudiante'];

$query = "INSERT INTO inscripciones(matricula, id_taller, asistencia, envio_constancia)
    VALUES (?, ?, ?, ?);
";

$falso = 0;

// Introducir los valores
$stmt = $conexion->prepare($query);
$stmt->bind_param("iiii", $matricula, $id, $falso, $falso);

if(!$stmt->execute()){
    $_SESSION["error"] = "Hubo un error al registrarse en el taller";
    header("Location: ". $_SERVER['HTTP_REFERER']);
    exit();
}

$stmt->close();

// Actualizar los cupos del taller
$query = "UPDATE talleres SET cupo = cupo - 1 WHERE id = ?";

$stmt = $conexion->prepare($query);
$stmt->bind_param("i", $id);

if(!$stmt->execute()){
    $_SESSION["error"] = "Hubo un error al registrarse en el taller 1";
    header("Location: ". $_SERVER['HTTP_REFERER']);
    exit();
}

$stmt->close();

$_SESSION['success'] = 'Te has registrado de manera correcta';
header('Location: '. $_SERVER['HTTP_REFERER']);
exit();