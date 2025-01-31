<?php
/**
 * 
 * Datos para la conexión a la base de datos
 * 
 * */
$host = "localhost";
$dbuser = "root";
$dbpwd = "";
$db = "congreso_utvm";

//Conexión directa a la base de datos
$conexion = mysqli_connect($host, $dbuser, $dbpwd, $db); 

//Verifica la conexión a la base de datos
if (!$conexion) {
    die("No se ha podido conectar a la base de datos: " . mysqli_connect_error());
}
