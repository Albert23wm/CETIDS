<?php
session_start();
include '../../../vendor/phpqrcode/qrlib.php';
include '../../../config/php/conexion.php';
include '../../../vendor/barcode-master/barcode.php';

if (isset($_POST['submit'])) {
    if (isset($_FILES['imagenTaller']) && $_FILES['imagenTaller']['error'] === UPLOAD_ERR_OK) {
        $imagenNombre = $_FILES['imagenTaller']['name'];
        $imagenTmp = $_FILES['imagenTaller']['tmp_name'];

    } else {
        die("Error al subir la imagen del curso.");
    }

    // Datos para el código QR
    $nombreTaller = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $cupo = $_POST['cupo'];
    $cuatrimestre = $_POST['cuatrimestre'];
    $idPonente = $_POST['ponente'];

    // Obtener el nombre completo del panelista para el QR
    $query = "SELECT CONCAT(nombre, ' ', apellido) AS nombreCompleto FROM ponentes WHERE id = $idPonente;";

    $result = mysqli_query($conexion, $query);

    $resultado = $result->fetch_assoc();

    $nombreCompleto = $resultado['nombreCompleto'];

    // URL para el código qr
    $tallerCodificado = urlencode($nombreTaller);

    $registrarAsistencia = "https://lavender-sparrow-832247.hostingersite.com/controllers/estudiantes/registarAsistencia.php?nombre_taller=$tallerCodificado"; 

    $formData = $registrarAsistencia;

    // Generar el código QR
    //BARCODE 
    $symbology = "qr";
    $options = []; // Puede modificarse en caso de necesitar opciones

    $generador = new barcode_generator();

    $qrBarcode = $generador->render_image($symbology, $formData, $options);

    // Definir la ruta completa del archivo QR con el nombre del taller y la imagen para el taller
    $rutaQr = 'assets/img/codigosQR/talleres/' . $nombreTaller . '.png';

    $rutaImagen = 'assets/img/talleres/' . $imagenNombre;

    // Guardar el código QR en el archivo
    imagepng($qrBarcode, '../../../' . $rutaQr);
    move_uploaded_file($imagenTmp, '../../../' . $rutaImagen);

    // Insertar los datos en la base de datos
    $sql = "INSERT INTO talleres (nombre, id_ponente, descripcion, cupo, cuatrimestre, ruta_imagen, ruta_qr) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("sisiiss", $nombreTaller, $idPonente, $descripcion, $cupo, $cuatrimestre, $rutaImagen, $rutaQr);
    $stmt->execute();

    $insertedId = $stmt->insert_id;

    $stmt->close();

    $_SESSION['success'] = "El talle ha sido agregado correctamente";
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();

} else {
    $_SESSION['error'] = "El taller no puedo ser almacenado de manera correcta";
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
}