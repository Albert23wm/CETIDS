<?php
session_start();

if(isset($_POST['enviada'])){
    $_SESSION['filtro'] = 1;
}

if(isset($_POST['sinEnviar'])){
    $_SESSION['filtro'] = 0;
}

if(isset($_POST['todos'])){
    unset($_SESSION['filtro']);
}

header('Location: ' . $_SERVER['HTTP_REFERER']);
exit();