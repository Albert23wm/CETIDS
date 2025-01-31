<?php
if(!isset($_SESSION['idAdmin'])){
    header('Location: ../login.php');
}