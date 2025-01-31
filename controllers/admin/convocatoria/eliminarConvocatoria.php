<?php
session_start();

include '../../../config/php/conexion.php';

if (!isset($_POST['Eliminar']) || !isset($_POST['id']) || !is_numeric($_POST['id'])) {
    $_SESSION['error'] = "Solicitud inválida. No se pudo eliminar la convocatoria.";
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
}

$id = (int)$_POST['id'];

try {
    // Obtener ruta de los ficheros
    $query = "SELECT ruta_documento, ruta_imagen FROM convocatorias WHERE id = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("i", $id);

    if (!$stmt->execute()) {
        throw new Exception("Error al obtener los datos de la convocatoria.");
    }

    $stmt->bind_result($rutaDocumento, $rutaImagen);
    if (!$stmt->fetch()) {
        throw new Exception("No se encontró la convocatoria especificada.");
    }

    $stmt->close();

    // Eliminar ficheros si existen
    if (file_exists('../../../' . $rutaImagen)) {
        unlink('../../../' . $rutaImagen);
    }

    if (file_exists('../../../' . $rutaDocumento)) {
        unlink('../../../' . $rutaDocumento);
    }

    // Eliminar el registro en la base de datos
    $query = "DELETE FROM convocatorias WHERE id = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("i", $id);

    if (!$stmt->execute()) {
        throw new Exception("Error al eliminar la convocatoria en la base de datos.");
    }

    $stmt->close();
    $_SESSION['success'] = "Se ha eliminado la convocatoria de manera correcta.";
} catch (Exception $e) {
    $_SESSION['error'] = $e->getMessage();
}

header("Location: " . $_SERVER['HTTP_REFERER']);
exit();
