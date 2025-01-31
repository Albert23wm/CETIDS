<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
// use PHPMailer\PHPMailer\SMTP;

include '../config/php/conexion.php';

require '../vendor/phpmailer/phpmailer/src/Exception.php';
require '../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require '../vendor/phpmailer/phpmailer/src/SMTP.php';
require '../vendor/autoload.php';

// Configuración de los parametros del horario
date_default_timezone_set('America/Mexico_City'); // Ajusta a tu zona horaria

// Obtener la fecha y hora actual
$hora_actual = date('Y-m-d H:i:s');

// Calcular 1 hora después de la hora actual
$hora_limite = date('Y-m-d H:i:s', strtotime('+1 hour'));

// Consulta el horario de los eventos
$query = "SELECT ";

$mail = new PHPMailer(true);

try {
    // Configuración del servidor SMTP
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'congresoti@utvm.edu.mx';
    $mail->Password = 'zusdecbpuqntjqrt';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // Destinatarios
    $mail->setFrom('congresoti@utvm.edu.mx', 'CONGRESO ESTATAL UTVM 2024');
    $mail->addAddress($correo_destino);

    // Contenido del correo
    $mail->isHTML(true);
    $mail->CharSet = 'UTF-8';
    $mail->Subject = 'Constancia';
    $mail->Body = 'Estimado/a,<br><br>¡Felicidades por haber completado exitosamente el curso! Adjuntamos la constancia de terminación.<br><br>Atentamente,<br>1er. CONGRESO ESTATAL DE TI';

    // Adjuntar archivo
    $mail->addAttachment($ruta_archivo);

    $mail->send();

} catch (Exception $e) {
    echo $e->getMessage();
}
