<?php
session_start();

if (isset($_POST['Enviar'])) {
    $nombre_ponente = $_POST['nombre_ponente'];
    $apellido_ponente = $_POST['apellido_ponente'];
    $descripcion_ponente = $_POST['descripcion_ponente'];
    $rol = $_POST['rol'];

    // Manejar la carga de la imagen
    $nombre_imagen = $_FILES['imagen_curso']['name'];
    $tipo_imagen = $_FILES['imagen_curso']['type'];
    $tamaño_imagen = $_FILES['imagen_curso']['size'];
    $tmp_imagen = $_FILES['imagen_curso']['tmp_name'];

    // Conexión a la base de datos
    include("../../../config/php/conexion.php");

    // Consulta SQL para insertar el nuevo taller con la imagen
    $consulta = "INSERT INTO ponentes (nombre, apellido, descripcion, rol, url_foto) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conexion, $consulta);

    try{
        // Almacenar la fotografía del ponente en el directorio de ponentes
        $dir = "assets/img/ponentes/";
        $archivo = $dir . $nombre_imagen;
        
        move_uploaded_file($tmp_imagen, '../../../' . $archivo);

    } catch (Exception $e) {
        echo $e->getMessage();
    }

    // Verificar si la consulta preparada fue exitosa
    if ($stmt) {
        // Bindear los parámetros
        mysqli_stmt_bind_param($stmt, "sssss", $nombre_ponente, $apellido_ponente, $descripcion_ponente, $rol, $archivo);

        // Ejecutar la consulta
        $resultado = mysqli_stmt_execute($stmt);

        // Verificar si la inserción fue exitosa
        if ($resultado) {
            $_SESSION['success'] = "Los datos del ponente han sido guardados correctamente";
            header('Location: ' . $_SERVER['HTTP_REFERER']);

        } else {
            $_SESSION['error'] = "No pudo guardarse la información del ponente";
            echo 'Error al agregar el ponente: ' . mysqli_error($conexion);
        }

        // Cerrar la consulta preparada
        mysqli_stmt_close($stmt);
    } else {
        $_SESSION['error'] = "No pudo guardarse la información del ponente";
        echo 'Error al preparar la consulta: ' . mysqli_error($conexion);
    }

    // Cerrar conexión a la base de datos
    mysqli_close($conexion);
}