<?php
session_start();

header('Content-Type: text/html; charset=UTF-8');

require('../../vendor/setasign/fpdf/fpdf.php');
include("../../config/php/conexion.php");

if(!isset($_POST['generar'])){
    $_SESSION['error'] = 'No se pudo generar el reconocimiento';
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
}

$matricula = $_POST['id'];

$query = "SELECT nombre, apellido FROM estudiantes WHERE matricula = ?";

$stmt = $conexion->prepare($query);
$stmt->bind_param("i", $matricula);

if (!$stmt->execute()) {
  $_SESSION['error'] = 'Hubo un error al consultar los datos de la inscripcion';
}

$resultado = $stmt->get_result();

$fila = $resultado->fetch_assoc();

$stmt->close();

// Datos para el reconocimiento
$nombre = $fila['nombre'];
$apellido = $fila['apellido'];

// Crea el PDF con formato carta
$pdf = new FPDF('P', 'mm', 'Letter'); // 'P' para orientación vertical y 'Letter' para tamaño carta
$pdf->AddPage();

// Agrega la imagen de fondo
$pdf->Image('../../assets/img/contenido/ReconocimientoFondo.png', 0, 0, 216, 279); // Ajusta el tamaño de la imagen al tamaño carta (216x279 mm)
$pdf->SetFont('Arial', 'B', 100);
$pdf->Ln(10);
$pdf->SetFont('Arial', '', 20);

// Texto del reconocimiento
$texto1 = utf8_decode("" . mb_strtoupper($nombre, 'UTF-8') . " " . mb_strtoupper($apellido, 'UTF-8') . "");
$anchoTexto = $pdf->GetStringWidth($texto1);

// Calcula la posición horizontal para centrar
$posX = ($pdf->GetPageWidth() - $anchoTexto) / 2;

// Calcula la posición vertical para centrar
$posY = ($pdf->GetPageHeight() - 20) / 2; // Suponiendo una altura de línea de 8 unidades

$pdf->SetXY($posX, $posY);
$pdf->MultiCell(0, 20, $texto1);

// Guarda el PDF en el servidor o lo muestra en el navegador
$pdf->Output('reconocimiento.pdf', 'I'); // 'D' para descargar, 'I' para mostrar en el navegador

$conexion->close(); // Cierra la conexión a la base de datos
