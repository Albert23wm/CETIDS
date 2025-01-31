<?php
require('../../../vendor/setasign/fpdf/fpdf.php');

// Obtén el id del taller desde la URL
$id_taller = isset($_GET['id_taller']) ? $_GET['id_taller'] : 0;

// Asegúrate de que $id_taller sea un entero positivo
$id_taller = intval($id_taller);

// Verifica si $id_taller es válido
if ($id_taller <= 0) {
    die('ID de taller no válido.');
}

// Configuración de la conexión a la base de datos
include("../../../config/php/conexion.php");

// Verificar la conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Consulta para obtener la ruta del QR y el nombre del taller desde la base de datos
$sql = "SELECT ruta_qr, nombre_taller FROM talleres WHERE id_taller = $id_taller";

$result = $conexion->query($sql);

// Verificar si se obtuvieron resultados
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $ruta_qr_completa = "../../../" . $row['ruta_qr'];
    $nombre_taller = $row['nombre_taller'];

    // Crear un nuevo objeto FPDF
    $pdf = new FPDF();
    $pdf->AddPage();

    // Añadir fondo al PDF
    $pdf->Image('../../../assets/img/contenido/FondoTallerQR.png', 0, 0, 210, 297);

    // Colocar el código QR más abajo en la página
    $ancho_pagina = $pdf->GetPageWidth();
    $alto_pagina = $pdf->GetPageHeight();
    $ancho_imagen_qr = 80; // Ajusta el ancho de la imagen según sea necesario
    $alto_imagen_qr = 80; // Ajusta el alto de la imagen según sea necesario
    $coordenada_x_qr = ($ancho_pagina - $ancho_imagen_qr) / 2;
    $coordenada_y_qr = ($alto_pagina - $alto_imagen_qr) / 2 + 20; // Ajusta la posición vertical según sea necesario

    $pdf->Image($ruta_qr_completa, $coordenada_x_qr, $coordenada_y_qr, $ancho_imagen_qr, $alto_imagen_qr);

    // Agregar el nombre del taller más abajo de la imagen del QR
    $pdf->SetFont('Arial', 'B', 14);
    $coordenada_y_nombre = $coordenada_y_qr + $alto_imagen_qr + 40; // Ajusta la posición vertical según sea necesario
    $pdf->SetXY($coordenada_x_qr, $coordenada_y_nombre);

    // Ajuste de nombre del taller en múltiples líneas
    $pdf->MultiCell($ancho_imagen_qr, 8, utf8_decode($nombre_taller), 0, 'C');

    // Salida del PDF
    $pdf->Output();
} else {
    echo "No se encontraron datos para el ID de taller proporcionado.";
}

// Cerrar la conexión
$conexion->close();