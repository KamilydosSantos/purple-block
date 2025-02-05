<?php
session_start();

if(!isset($_SESSION['email'])) {
    header("Location: autenticacao/login.php");
    exit();
}

if($_SESSION['admin'] == 1) {
    header("Location: administrativo/adminDashboard.php");
    exit();
}

header("Location: notas/notas.php");
exit();