<?php

require('../../../vendor/setasign/fpdf/fpdf.php');
include('../../../vendor/phpqrcode/qrlib.php');
include '../../../vendor/barcode-master/barcode.php';
include("../../../config/php/conexion.php");

// Recupera el ID de suscripción
if(!isset($_POST['Enviar'])){
    $_SESSION['error'] = 'La contancia no pudo ser generada correctamente';
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
}

$id_sub = $_POST['id'];

// Validación del ID de suscripción (puedes agregar más validación si es necesario)
if (!is_numeric($id_sub)) {
    die('ID de suscripción no válido.');
}

// Establece la codificación de caracteres de la conexión a UTF-8
$conexion->set_charset("utf8");

try {
    // Consulta para obtener la información del estudiante
    $consulta = "SELECT CONCAT(e.nombre, ' ', e.apellido) AS nombreCompleto, t.nombre, e.matricula, i.id AS idInscripcion
        FROM inscripciones i
        INNER JOIN estudiantes e ON i.matricula = e.matricula
        INNER JOIN talleres t ON i.id_taller = t.id
        WHERE e.matricula = ?;
    ";

    $stmt = $conexion->prepare($consulta);
    $stmt->bind_param('i', $id_sub);

    if(!$stmt->execute()){
        $_SESSION['error'] = 'No se pudo obtener la información del usuario';
        header('Location: '. $_SERVER['HTTP_REFERER']);
        exit();
    }

    $result = $stmt->get_result();

    $fila = $result->fetch_assoc();

    if ($result->num_rows > 0) {
        // Directorio donde se almacenarán los archivos PDF
        $directorio_destino = '../../../assets/pdf/constanciasAlumnos/';

        // Verificar si el directorio de destino existe, si no, crearlo
        if (!is_dir($directorio_destino)) {
            mkdir($directorio_destino, 0777, true);
        }

        // Datos para el código QR
        $formData = "Nombre: {$fila["nombreCompleto"]}\nNombre del Taller: {$fila["nombre"]}\nMatricula: {$fila["matricula"]}";

        //BARCODE 
        $symbology = "qr";
        $options = []; // Puede modificarse en caso de necesitar opciones

        $generador = new barcode_generator();

        $qrBarcode = $generador->render_image($symbology, $formData, $options);

        

        // Directorio para almacenar el QR
        $qrPath = '../../../assets/img/codigosQR/constancias/' . $id_sub . '.png';

        // Almacenar el QR
        // file_put_contents($qrPath,$qrBarcode);
        imagepng($qrBarcode, $qrPath);

        // Agregar la fuente Nunito 
        $pdf = new FPDF();
        $pdf->SetTitle('Constancias');
        $pdf->AddFont('Nunito', '', 'Nunito-VariableFont_wght.php');
        $pdf->AddFont('Agbalumo', '', 'Agbalumo-Regular.php');

        // Genera el PDF
        $pdf->AddPage();

        $pdf->SetFont('Nunito', '', 15);

        $pdf->Image('../../../assets/img/contenido/plantillaConstancia.png', 0, 0, 210);

        $nombre_completo = $fila["nombreCompleto"];

        $nombre_taller = $fila["nombre"];

        $texto = "Por su participación en el Taller $nombre_taller, llevado a cabo en el marco de las actividades del Primer Congreso Estatal Tecnologías de la Información y Desarrollo de Software 2024, realizado el 14 de marzo del presente año.";

        $pdf->SetXY(10, 154);

        $pdf->SetFont('Arial', '', 12); // Fuente normal para el texto principal

        // Texto antes de la variable $nombre_taller
        $pdf->Write(10, utf8_decode('Por su participación en el Taller '));

        // Cambiamos la fuente a negrita solo para $nombre_taller
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Write(10, utf8_decode($nombre_taller));

        $pdf->SetFont('Arial', '', 12);
        $pdf->Write(10, utf8_decode(', llevado a cabo en el marco de las actividades del Primer Congreso Estatal Tecnologías de la Información y Desarrollo de Software 2024, realizado el 14 de marzo del presente año.'));

        $pdf->SetXY(10, 140);

        $pdf->SetFont('Agbalumo', '', 35);
        $pdf->Cell(190, 10, utf8_decode("$nombre_completo"), 0, 1, 'C');

        $pdf->SetFont('Nunito', '', 12);

        $pdf->SetXY(90, 238);

        // Ajusta las coordenadas y el tamaño de la imagen del código QR
        $qrX = 16;
        $qrY = 220.5;
        $qrWidth = 28;
        $qrHeight = 28;

        // Agregar la imagen del código QR al PDF
        $pdf->Image($qrPath, $qrX, $qrY, $qrWidth);

        $pdf_content = $pdf->Output('', 'S');

        // Nombre del archivo PDF basado en el ID de suscripción
        $nombre_archivo = 'constancia_' . $id_sub . '.pdf';

        $ruta_pdf = "/assets/pdf/constanciasAlumnos/" . $nombre_archivo;

        // Guardar el PDF en la carpeta Constancias y los QR
        $pdf->Output('../../../' . $ruta_pdf, 'F');

        // Comprobar las coincidencias en la base de datos
        $idInscripcion = $fila['idInscripcion'];
        $verificar_datos = "SELECT * FROM constancias WHERE id_inscripcion = $idInscripcion";

        $resultados = mysqli_query($conexion, $verificar_datos);

        $resultados->num_rows == 0
        ? $insertar = "INSERT INTO constancias (id_inscripcion, ruta_archivo) VALUES ($idInscripcion, '$ruta_pdf')" 
        : $insertar = "UPDATE constancias SET ruta_archivo = '$ruta_pdf' WHERE id_inscripcion = $id_sub;";

        if (mysqli_query($conexion, $insertar)) {
            // Muestra un mensaje de éxito 
            echo "Registro en constancias insertado correctamente.";

            // Establece el tipo de encabezado del PDF
            header('Content-Type: application/pdf');

            // Envia el PDF al navegador
            echo $pdf_content;

        } else {
            // Muestra un mensaje de error
            echo "Error al insertar registro en constancias: " . $conexion->error;

        }
    } else {
        echo "No se encontraron registros.";

    }
    $conexion->close(); 

} catch (Exception $e) {
    die($e->getMessage());
}