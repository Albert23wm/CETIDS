<?php
session_start();

// Conexion a BD
include '../../../config/php/conexion.php';

// Información
$categoria = $_POST['categoria'];
$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];
// Imagen
$imagen = $_FILES['imagen']['tmp_name'];
$nombreImagen = $_FILES['imagen']['name'];
// Documento
$archivo = $_FILES['archivo']['tmp_name'];
$tipoArchivo = $_FILES['archivo']['type'];
$pesoArchivo = $_FILES['archivo']['size'];
$nombreArchivo = $_FILES['archivo']['name'];

strtolower($tipoArchivo);



// Guardar los  archivo en el directorio asignado
$dirArchivo = 'assets/pdf/convocatorias/' . $nombreArchivo;
$dirImangen = 'assets/img/convocatorias/' . $nombreImagen;

if(!move_uploaded_file($archivo, '../../../' . $dirArchivo)){
    $_SESSION['error'] = "La imagen de la convocatoria no puedo ser guardada";
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
}

if(!move_uploaded_file($imagen, '../../../' . $dirImangen)){
    $_SESSION['error'] = "La imagen de la convocatoria no puedo ser guardada";
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
}

// Preparación de consulta 
$query = "INSERT INTO convocatorias(nombre, categoria, ruta_documento, nombre_documento, ruta_imagen) 
    VALUES (?, ?, ?, ?, ?);
";

$stmt = $conexion->prepare($query);

$stmt->bind_param('sssss', $nombre, $categoria, $dirArchivo, $nombreArchivo, $dirImangen);

// Ejecución de la consulta
if(!$stmt->execute()){
    $_SESSION['error'] = "Hubo un error al guardar la convocatoria";
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
}

$_SESSION['success'] = "Convocatoria guardada correctamente";
header("Location: " . $_SERVER['HTTP_REFERER']);
exit();