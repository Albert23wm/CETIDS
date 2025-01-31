<?php
session_start();

include '../../../config/php/conexion.php';

if (!isset($_POST['eliminar']) || !isset($_POST['id']) || !is_numeric($_POST['id'])) {
    $_SESSION['error'] = "Solicitud inválida. No se pudieron eliminar los datos del ponente.";
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
}

$id = (int) $_POST['id'];

// Verificar coincidencias en actividades y talleres
$query = "
    SELECT 
        (SELECT COUNT(*) FROM actividades WHERE id_ponente = ?) AS total_actividades,
        (SELECT COUNT(*) FROM talleres WHERE id_ponente = ?) AS total_talleres;
";
$stmt = $conexion->prepare($query);
$stmt->bind_param("ii", $id, $id);

if (!$stmt->execute()) {
    $_SESSION['error'] = "Hubo un error al verificar los datos del ponente.";
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
}

// Obtener resultados
$stmt->bind_result($totalActividades, $totalTalleres);
$stmt->fetch();
$stmt->close();

// Validar resultados
if ($totalActividades > 0 || $totalTalleres > 0) {
    $_SESSION['error'] = "El ponente ya está registrado en un taller o actividad.";
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
}

try {
    // Obtener ruta de los ficheros
    $query = "SELECT url_foto FROM ponentes WHERE id = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("i", $id);

    if (!$stmt->execute()) {
        throw new Exception("Error al obtener los datos del ponente.");
    }

    $stmt->bind_result($foto);
    if (!$stmt->fetch()) {
        throw new Exception("No se encontraron datos del ponente.");
    }

    $stmt->close();

    // Eliminar ficheros si existen
    if (file_exists('../../../' . $foto)) {
        unlink('../../../' . $foto);
    }

    // Eliminar el registro en la base de datos
    $query = "DELETE FROM ponentes WHERE id = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("i", $id);

    if (!$stmt->execute()) {
        throw new Exception("Error al eliminar los datos del ponente en la base de datos.");
    }

    $stmt->close();

    $_SESSION['success'] = "Se han eliminado los datos del ponente de manera correcta.";
} catch (Exception $e) {
    $_SESSION['error'] = $e->getMessage();
}

header("Location: " . $_SERVER['HTTP_REFERER']);
exit();
