<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
// use PHPMailer\PHPMailer\SMTP;

require '../../../vendor/phpmailer/phpmailer/src/Exception.php';
require '../../../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require '../../../vendor/phpmailer/phpmailer/src/SMTP.php';
require '../../../vendor/autoload.php';

include '../../../config/php/conexion.php';

if (!$conexion) {
    die("Error al conectar con la base de datos: " . mysqli_connect_error());
}

if(!isset($_POST["Enviar"])){
    echo '
        <script>   
            alert("La constancia no se ha podido enviar");
        </script>
    ';

    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
}

$id_sub = $_POST['id_sub'];

$query = "SELECT
    e.correo_electronico,
    c.url_archivo
FROM 
    estudiantes e
INNER JOIN suscripcion s ON s.matricula = e.matricula
INNER JOIN constancias c ON s.id_sub = c.id_sub
WHERE 
    s.id_sub = $id_sub
LIMIT 1;";

$result = mysqli_query($conexion, $query);

if (!$result) {
    die("Error en la consulta: " . mysqli_error($conexion));
}

if ($result->num_rows == 0) {
    echo "<script>alert('No existen coincidencias');</script>";
    echo "<script>window.location.href = '{$_SERVER['HTTP_REFERER']}';</script>";
    exit();
}

$row = mysqli_fetch_assoc($result);

$correo_destino = $row['correo_electronico'];
$url_archivo = $row['url_archivo'];
$ruta_archivo = '../../../' . $url_archivo;

if (!file_exists($ruta_archivo)) {
    die("El archivo adjunto no existe: $ruta_archivo");
}

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

    echo '
    <script>   
        alert("La constancia ha sido enviada de manera correcta");
    </script>
    ';

    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();

} catch (Exception $e) {
    echo '
    <script>   
        alert("La constancia no se ha podido enviar: '. $mail->ErrorInfo .' " );
    </script>
    ';

    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
}
