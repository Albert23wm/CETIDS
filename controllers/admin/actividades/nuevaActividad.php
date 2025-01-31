<?php
session_start();
// Incluir el archivo de conexión a la base de datos
include '../../../config/php/conexion.php';

// Verificar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger los datos del formulario
    $dia = $_POST['dia'];
    $nombre = $_POST['nombre'];
    $cuatrimestre = $_POST['cuatrimestre'];
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $lugar = $_POST['lugar'];
    $idPonente = $_POST['ponente'];

    // Preparar la consulta SQL para insertar datos en la tabla "actividades"
    $query = "INSERT INTO actividades (id_ponente, nombre, asistentes, fecha, dia, hora, ubicacion) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $result = $conexion->prepare($query);
    $result->bind_param('isssiss', $idPonente, $nombre, $cuatrimestre, $fecha, $dia, $hora, $lugar);   
    

    if ($result->execute()) {
        header("Location: " . $_SERVER['HTTP_REFERER']);
        $_SESSION['success'] = "Actividad guardada correctamente";
        exit();

    } else {
        header("Location: " . $_SERVER['HTTP_REFERER']);
        $_SESSION['error'] = "Hubo un error al almacenar los datos";
        exit();
    }

    // Cerrar la conexión a la base de datos
    $conexion->close();
} else {
    header("Location: " . $_SERVER['HTTP_REFERER']);
    $_SESSION['error'] = "Hubo un error al enviar el formulario";
    exit();
}