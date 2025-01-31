<?php
session_start();

include '../../../config/php/conexion.php';

if (!isset($_POST['eliminar']) || !isset($_POST['id']) || !is_numeric($_POST['id'])) {
    $_SESSION['error'] = "Solicitud inválida. No se pudo eliminar el taller.";
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
}

$id = (int)$_POST['id'];

try {
    // Obtener ruta de los ficheros
    $query = "SELECT ruta_imagen, ruta_qr FROM talleres WHERE id = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("i", $id);

    if (!$stmt->execute()) {
        throw new Exception("Error al obtener los datos del taller.");
    }

    $stmt->bind_result($rutaImagen, $rutaQr);
    if (!$stmt->fetch()) {
        throw new Exception("No se encontró el taller especificado.");
    }

    $stmt->close();

    // Eliminar ficheros si existen
    if (file_exists('../../../' . $rutaImagen)) {
        unlink('../../../' . $rutaImagen);
    }

    if (file_exists('../../../' . $rutaQr)) {
        unlink('../../../' . $rutaQr);
    }

    // Eliminar el registro en la base de datos
    $query = "DELETE FROM talleres WHERE id = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("i", $id);

    if (!$stmt->execute()) {
        throw new Exception("Error al eliminar la convocatoria en la base de datos.");
    }

    $stmt->close();
    $_SESSION['success'] = "Se ha eliminado el taller de manera correcta.";
} catch (Exception $e) {
    $_SESSION['error'] = $e->getMessage();
}

header("Location: " . $_SERVER['HTTP_REFERER']);
exit();
