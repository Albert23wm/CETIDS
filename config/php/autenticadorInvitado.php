<?php
if(!isset($_SESSION['idInvitado'])){
    header('Location: ../login.php');
}