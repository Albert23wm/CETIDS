<?php
if(!isset($_SESSION['idEstudiante'])){
    header('Location: ../login.php');
}