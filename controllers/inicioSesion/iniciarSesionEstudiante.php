<?php
session_start();

include "../../config/php/conexion.php";

if (!isset($_POST['iniciar'])) {
    $_SESSION['error'] = "No se ha podido iniciar sesión.";
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
}

$clave = trim($_POST['matricula']);
$contrasena = trim($_POST['contrasena']);

// Validación inicial
if (empty($clave) || empty($contrasena)) {
    $_SESSION['error'] = "Por favor, completa todos los campos.";
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
}

// Verificar si es administrador
$query = "SELECT id, clave, contrasena FROM administrador WHERE clave = ?";
$stmt = $conexion->prepare($query);

if ($stmt === false) {
    $_SESSION['error'] = "Error en la consulta.";
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
}

$stmt->bind_param("s", $clave);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {
    $fila = $resultado->fetch_assoc();
    $stmt->close();

    if ($fila['clave'] == $clave && $fila['contrasena'] == $contrasena) {
        $_SESSION['idAdmin'] = $fila['id'];
        header('Location: ../../administrador/talleres.php');
        exit();
    } else {
        $_SESSION['error'] = "Credenciales incorrectas.";
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    }
}
$stmt->close();

// Verificar si es estudiante
$query = "SELECT matricula, contrasena FROM estudiantes WHERE matricula = ?";
$stmt = $conexion->prepare($query);

if ($stmt === false) {
    $_SESSION['error'] = "Error en la consulta.";
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
}

$stmt->bind_param("s", $clave);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {
    $fila = $resultado->fetch_assoc();
    $stmt->close();

    if ($fila['matricula'] == $clave && $fila['contrasena'] == $contrasena) {
        $_SESSION['idEstudiante'] = $fila['matricula'];
        header('Location: ../../estudiante/misTalleres.php');
        exit();
    } else {
        $_SESSION['error'] = "Credenciales incorrectas.";
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    }
}

$stmt->close();

// Si no es administrador ni estudiante
$_SESSION['error'] = "Usuario no encontrado.";
header("Location: " . $_SERVER['HTTP_REFERER']);
exit();
