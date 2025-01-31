<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

#Revisar funcionamiento
require '../PHPMailer/Exception.php';
require '../PHPMailer/PHPMailer.php';
require '../PHPMailer/SMTP.php';

include '../../../config/php/conexion.php';


$consulta_correos = "SELECT suscripcion.id_sub, CONCAT(estudiantes.nombre_estudiante, ' ', estudiantes.apellido) AS nombre_completo, estudiantes.correo_electronico, suscripcion.matricula, suscripcion.fecha, talleres.nombre_taller, suscripcion.asistencia
            FROM suscripcion
            INNER JOIN estudiantes ON suscripcion.matricula = estudiantes.matricula
            INNER JOIN talleres ON suscripcion.id_taller = talleres.id_taller
            WHERE suscripcion.asistencia = 1 AND suscripcion.constancia_enviada IS NULL";


$resultado_correos = $conexion->query($consulta_correos);

$contador = 0;
$contador_negativo = 0;
$contador_positivo = 0;
if ($resultado_correos && $resultado_correos->num_rows > 0) {
    while ($fila_correo = $resultado_correos->fetch_assoc()) {
        $contador++;
        if ($resultado_correos->num_rows > 0) {

            $correo_destino = $fila_correo['correo_electronico'];
            $id_sub = $fila_correo['id_sub'];

            // Obtener todas las rutas de los archivos PDF
            $consulta_constancias = "SELECT url_archivo FROM constancias WHERE id_sub='$id_sub'";
            $resultado_constancias = $conexion->query($consulta_constancias);

            if ($resultado_constancias && $resultado_constancias->num_rows > 0) {
                while ($fila_constancia = $resultado_constancias->fetch_assoc()) {
                    $ruta_pdf = $fila_constancia["url_archivo"];

                    // Procesar el formulario si se envió
                    if ($id_sub != '') {


                        // Verificar si el usuario ya existe
                        $check_id_query = "SELECT * FROM constancias WHERE id_sub = ' $id_sub'";
                        $result = $conexion->query($check_id_query);

                        // Enviar el código por correo electrónico
                        $mail = new PHPMailer(true);
                        // Insertar el nuevo estudiante en la base de datos

                        try {
                            $mail->isSMTP();
                            $mail->Host = 'smtp.gmail.com'; // Servidor SMTP de Gmail
                            $mail->SMTPAuth = true;
                            $mail->Username = 'congresoti@utvm.edu.mx';
                            $mail->Password = 'zusdecbpuqntjqrt';
                            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                            $mail->Port = 587;
                            $mail->setFrom('congresoti@utvm.edu.mx', 'CONGRESO ESTATAL UTVM 2024');
                            $mail->addAddress($correo_destino);

                            $mail->isHTML(true);
                            $mail->CharSet = 'UTF-8';
                            $mail->Subject = 'Constancia';

                            // Mensaje personalizado
                            $mensaje = 'Estimado/a ,<br><br>';
                            $mensaje .= '¡Felicidades por haber completado exitosamente el curso! ';
                            $mensaje .= 'Adjuntamos la constancia de terminación.<br><br>';
                            $mensaje .= 'Atentamente,<br>';
                            $mensaje .= '1er. CONGRESO ESTATAL DE TI';

                            $mail->Body = $mensaje;
                            $mail->isHTML(true);
                            $mail->CharSet = 'UTF-8';

                            // Adjuntar el PDF al mensaje
                            while ($fila = $result->fetch_assoc()) {
                                $archivo_pdf = $fila['url_archivo'];
                                // Adjuntar el archivo al correo
                                $mail->addAttachment($archivo_pdf, 'constancia.pdf');
                            }


                            $mail->send();
                            $mensaje = 'Correo enviado con éxito a ' . $correo_destino;
                            echo "<script>
                                                    Swal.fire('Éxito');
                                                    //swal('Éxito', '$mensaje', 'success').then(() => {
                                                        // Redirecciona o realiza alguna acción adicional si es necesario
                                                    //});
                                                </script>";         // Eliminar archivos temporales después del envío

                        } catch (Exception $e) {
                            //echo "No se envió la constancia al correo del participante... Revisa por favor.";

                            echo "<script>
                                                    Swal.fire('No se envió la constancia al correo del participante... Revisa por favor.');
                                                </script>";         // Eliminar archivos temporales después del envío

                        }


                    }
                }
                $actualizar_consulta = "UPDATE suscripcion SET constancia_enviada = 1 WHERE id_sub = $id_sub";
                $stmt_update = $conexion->prepare($actualizar_consulta);
                //   $stmt_update->bind_param("s", $qrImageData);
                $stmt_update->execute();
                $contador_positivo++;
            } else {
                $contador_negativo++;
                // echo "No se encontraron constancias para enviar.";
            }
        }
    }
}

echo "<script>
    alert('Se han enviado todos las constancias encontradas exitosamente',
       ).then(() => {
        window.location.href = '../../../administrador/contanscias.php'; // Redirigir a constancias.php
    });
</script>";
echo 'contador final:', $contador;
echo 'contador final de constancias enviadas exitosamente:', $contador_positivo;
echo 'contador final de constancias no encontradas o ya enviadas:', $contador_negativo;

// Cerrar la conexión a la base de datos al final del script
$conexion->close();
