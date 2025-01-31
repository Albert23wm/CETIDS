<?php
session_start();

include("../../../config/php/conexion.php");

if (isset($_POST['guardar'])) {
  // Obtener los datos 
  $id = $_POST['id'];
  $nombre = $_POST['nombre'];
  $apellido = $_POST['apellido'];
  $descripcion = $_POST['descripcion'];
  $rol = $_POST['rol'];

  if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
    // Obtener los datos de la foto
    $foto = $_FILES['foto']['tmp_name'];
    $nombreFoto = $_FILES['foto']['name'];

    $url_foto = 'assets/img/ponentes/' . $nombreFoto;

    move_uploaded_file($foto, '../../../' . $url_foto);

    $consulta = "UPDATE ponentes SET nombre = ?, apellido = ?, descripcion = ?, rol = ?, url_foto = ? WHERE id = ?";
    $stmt = mysqli_prepare($conexion, $consulta);

    $stmt->bind_param("sssssi", $nombre, $apellido, $descripcion, $rol, $url_foto, $id);

    if ($stmt->execute()) {
      $_SESSION['success'] = "Datos guardados correctamente.";
      header('Location: ' . $_SERVER['HTTP_REFERER']);

    } else {
      $_SESSION['error'] = "Error al editar los datos del ponente.";
      header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    $stmt->close();
    exit();

  } else {
    $consulta = "UPDATE ponentes SET nombre = ?, apellido = ?, descripcion = ?, rol = ? WHERE id = ?";
    $stmt = $conexion->prepare($consulta);

    $stmt->bind_param("ssssi", $nombre, $apellido, $descripcion, $rol, $id);

    if ($stmt->execute()) {
      $_SESSION['success'] = "Datos guardados correctamente.";
      header('Location: ' . $_SERVER['HTTP_REFERER']);

    } else {
      $_SESSION['error'] = "Error al editar los datos del ponente.";
      header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    $stmt->close();
    exit();
  }

} else {
  $_SESSION['error'] = "Error al editar los datos del ponente.";
  header('Location: ' . $_SERVER['HTTP_REFERER']);
  exit();
}