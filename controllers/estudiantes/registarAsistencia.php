<?php
session_start();

include("../../config/php/conexion.php");

// Limpiar variables de sesión para mensajes anteriores
unset($_SESSION['success']);
unset($_SESSION['error']);

// Verificar si el usuario está autenticado y la matrícula está disponible
if (!isset($_SESSION['idEstudiante'])) {
    $_SESSION['error'] = "Acceso no autorizado.";
    header("Location: https://lavender-sparrow-832247.hostingersite.com/");
    exit;
}

$matricula = $_SESSION['idEstudiante'];

// Verificar si el nombre del taller está presente en la URL
if (!isset($_GET['nombre_taller']) || empty($_GET['nombre_taller'])) {
    $_SESSION['error'] = "El nombre del taller no fue proporcionado.";
    header("Location: ../../estudiante/talleres/registrarAsistencia.php");
    exit;
}

$nombreDelTaller = $_GET['nombre_taller'];

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Buscar el ID del taller usando el nombre proporcionado
    $stmt = $conexion->prepare("SELECT id FROM talleres WHERE nombre = ?");
    $stmt->bind_param("s", utf8_decode($nombreDelTaller));
    $stmt->execute();
    $stmt->bind_result($idDelTaller);
    $stmt->store_result();

    if ($stmt->num_rows == 0) {
        $_SESSION['error'] = "El taller no existe.";
        $stmt->close();
        header("Location: ../../estudiante/talleres/registrarAsistencia.php");
        exit;
    }

    $stmt->fetch();
    $stmt->close();

    // Buscar la inscripción del estudiante al taller
    $query = "SELECT id, asistencia FROM inscripciones WHERE matricula = ? AND id_taller = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("ii", $matricula, $idDelTaller);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        $_SESSION['error'] = "No se encontró una inscripción para este taller.";
        $stmt->close();
        header("Location: ../../estudiante/talleres/registrarAsistencia.php");
        exit;
    }

    $inscripcion = $result->fetch_assoc();
    $stmt->close();

    // Validar si la asistencia ya está registrada
    if ($inscripcion['asistencia'] > 0) {
        $_SESSION['error'] = "La asistencia ya está registrada para este taller.";
        header("Location: ../../estudiante/talleres/registrarAsistencia.php");
        exit;
    }

    // Actualizar la asistencia
    $updateQuery = "UPDATE inscripciones SET asistencia = 1 WHERE id = ?";
    $stmt = $conexion->prepare($updateQuery);
    $stmt->bind_param("i", $inscripcion['id']);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Asistencia registrada exitosamente.";
    } else {
        $_SESSION['error'] = "Error al registrar la asistencia: " . $stmt->error;
    }

    $stmt->close();

    // Enviar constancia
    include 'generarConstancia.php';

    header("Location: ../../estudiante/talleres/registrarAsistencia.php");
    exit;
} else {
    $_SESSION['error'] = "Esta página sólo funciona con solicitudes POST.";
    header("Location: ../../estudiante/talleres/registrarAsistencia.php");
    exit;
}
