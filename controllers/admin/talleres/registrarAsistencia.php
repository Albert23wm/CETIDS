<?php
session_start();

include("../../../config/php/conexion.php");

// Verificar si el usuario está autenticado
if (!isset($_SESSION['matricula'])) {
    header('Location:../../login.php'); // Redirige a la página de inicio de sesión si no está autenticado
    exit();
}

$matricula = $_SESSION['matricula'];

// echo $matricula;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Verificar si qrData ha sido enviada
    if (isset($_POST['qrData'])) {
        // Suponiendo que $qrData es la cadena de texto que obtuviste del código QR
        $qrData = $_POST['qrData'];

        // Separar por líneas
        $lines = explode("\n", $qrData);

        // Preparar un array para almacenar los datos extraídos
        $qrFields = [];

        // Recorrer cada línea y extraer la información
        foreach ($lines as $line) {
            // Separar la clave del valor
            $parts = explode(": ", $line, 2);
            if (count($parts) === 2) {
                $qrFields[trim($parts[0])] = trim($parts[1]);
            }
        }

        // Ahora, $qrFields contiene los datos del código QR que puedes usar
        // Por ejemplo, imprimirlos:
        if (!empty($qrFields)) {
            // echo "Nombre del taller: " . $qrFields['Nombre del taller'] . "<br>";
            $nombre_del_taller = $qrFields['Nombre del taller'];
            // echo $nombre_del_taller;

            // Preparar la consulta para buscar el ID del taller

            $stmt = $conexion->prepare("SELECT id_taller FROM talleres WHERE nombre_taller = ?");
            $stmt->bind_param("s", utf8_decode($nombre_del_taller)); // 's' especifica que el parámetro es una cadena (string)

            // Ejecutar la consulta
            $stmt->execute();

            // Vincular los resultados a variables
            $stmt->bind_result($id_del_taller);

            // Obtener los resultados
            if ($stmt->fetch()) {
                //echo "El ID del taller es: " . $id_del_taller;
                $id_del_taller_anterior = $id_del_taller;
                $stmt->close();

                 
                // Ahora, buscar la suscripción por matrícula
               $query = "SELECT id_sub,asistencia FROM suscripcion WHERE matricula='$matricula' AND id_taller='$id_del_taller_anterior'";
                $result = mysqli_query($conexion, $query);

                if (!$result) {
                    die("Error en la consulta: " . mysqli_error($conexion));
                } else {
                    // echo "Consulta exitosa de suscripción"; // Este mensaje indica que la consulta se realizó con éxito
                }

                if ($result->num_rows > 0) {
                    while ($consulta = $result->fetch_assoc()) {
                        $id_sub_cita = $consulta['id_sub'];
                        $asistencia = $consulta['asistencia'];
                        // echo "ID de suscripción: " . $id_sub_cita;
                        // echo "asistencia: " . $asistencia;
                        if($asistencia > 0){

                            echo "La asistencia de este código QR ya está registrada. Por favor, verifica si el QR corresponde a tu taller.";
                        }else{
                          
                        // // Actualizar el registro para asignarle el valor 1 al campo asistencia
                          $query_update = "UPDATE suscripcion SET asistencia = 1 WHERE id_sub = $id_sub_cita";
                          $stmt_update = $conexion->prepare($query_update);
                        //   $stmt_update->bind_param("s", $qrImageData);
                          $stmt_update->execute();

                          if (!$stmt_update) {
                              die("Error al actualizar el registro: " . mysqli_error($conexion));
                          } else {
                              echo "Se ha registrado su asistencia exitosamente";
                          }
                        }
                       
                    }

                    // Liberar los resultados de la consulta de suscripción antes de ejecutar otra consulta
                    mysqli_free_result($result);
                } else {
                    echo "No se encontró una suscripción con esa matrícula.";
                }
            } else {//marlem
                /*var_dump($qrFields);   
                echo "taller:" ,$id_del_taller_anterior;
                 echo "matricula" ,$matricula;
                 echo "UPDATE suscripcion SET asistencia = 1 WHERE id_sub = $id_sub_cita";*/
                echo "Intente de nuevo";
            }

            // Cerrar la consulta preparada
           
        } else {
            echo "No se pudo extraer la información del código QR.";
        }
    } else {
        echo "No se recibió la variable qrData.";
    }
} else {
    echo "Esta página sólo funciona con solicitudes POST.";
}
?>