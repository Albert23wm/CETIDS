<?php
session_start();

include "../../../config/php/conexion.php";

if (!isset($_POST['eliminar'])) {
    header("Location: " . $_SERVER['HTTP_REFERER']);
    $_SESSION['error'] = "No ha podido eliminarse la actividad correctamente";
    exit();
}

$id = $_POST['id'];

$query = "DELETE FROM actividades WHERE id = $id";

if($conexion->query($query)){
    header("Location: " . $_SERVER['HTTP_REFERER']);
    $_SESSION['success'] = "La actividad ha sido eliminada de manera correcta";
    exit();
}