<?php
session_start();

if (isset($_POST['enviar'])) {
    include '../../../vendor/phpqrcode/qrlib.php';
    include '../../../config/php/conexion.php';

    // Datos del formulario
    $nombreTaller = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $cupo = $_POST['cupo'];
    $cuatrimestre = $_POST['cuatrimestre'];
    $idPonente = $_POST['ponente'];
    $idTaller = $_POST['id'];

    // Consultar rutas de archivos antiguos
    $query = "SELECT ruta_imagen, ruta_qr FROM talleres WHERE id = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("i", $idTaller);
    $stmt->execute();
    $result = $stmt->get_result();

    $oldFiles = $result->fetch_assoc();
    $rutaImagen = $oldFiles['ruta_imagen']; // Ruta existente en la BD
    $rutaQr = $oldFiles['ruta_qr'];         // Ruta QR existente en la BD

    $stmt->close();

    // Manejo de la imagen
    if (isset($_FILES['imagenTaller']) && $_FILES['imagenTaller']['error'] === UPLOAD_ERR_OK) {
        $imagenTmp = $_FILES['imagenTaller']['tmp_name'];
        $imagenNombre = $_FILES['imagenTaller']['name'];
        $nuevaRutaImagen = 'assets/img/talleres/' . $imagenNombre;

        // Guardar la nueva imagen del taller
        if (move_uploaded_file($imagenTmp, '../../../' . $nuevaRutaImagen)) {
            // Solo eliminar la imagen anterior si la nueva es diferente
            if ($nuevaRutaImagen !== $rutaImagen && file_exists('../../../' . $rutaImagen)) {
                unlink('../../../' . $rutaImagen);
            }
            $rutaImagen = $nuevaRutaImagen; // Actualizar la ruta a la nueva imagen
        } else {
            $_SESSION['error'] = "Error al guardar la nueva imagen.";
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit();
        }
    }

    // Obtener nombre completo del ponente
    $query = "SELECT CONCAT(nombre, ' ', apellido) AS nombreCompleto FROM ponentes WHERE id = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("i", $idPonente);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        $_SESSION['error'] = "Ponente no encontrado.";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    }

    $nombreCompleto = $result->fetch_assoc()['nombreCompleto'];
    $stmt->close();

    // Generar código QR
    $formData = "Nombre del taller: $nombreTaller\nDescripción: $descripcion\nCupo: $cupo\nCuatrimestre: $cuatrimestre\nTallerista: $nombreCompleto";
    $nuevaRutaQr = 'assets/img/codigosQR/talleres/' . $nombreTaller . ".png";

    QRcode::png($formData, '../../../' . $nuevaRutaQr, 'H', 6, 2);

    // Solo eliminar el QR anterior si la nueva ruta es diferente
    if ($nuevaRutaQr !== $rutaQr && file_exists('../../../' . $rutaQr)) {
        unlink('../../../' . $rutaQr);
    }
    $rutaQr = $nuevaRutaQr; // Actualizar la ruta al nuevo QR

    // Actualizar datos del taller
    $sql = "UPDATE talleres
            SET id_ponente = ?, nombre = ?, descripcion = ?, cupo = ?, cuatrimestre = ?, ruta_imagen = ?, ruta_qr = ?
            WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("issiissi", $idPonente, $nombreTaller, $descripcion, $cupo, $cuatrimestre, $rutaImagen, $rutaQr, $idTaller);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Taller actualizado correctamente.";
    } else {
        $_SESSION['error'] = "Error al actualizar el taller. " . $stmt->error;
    }

    $stmt->close();

    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
} else {
    $_SESSION['error'] = "Acceso no permitido.";
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
}
