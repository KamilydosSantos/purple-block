<?php
session_start();

if(!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

if($_SESSION['admin'] == 1) {
    header("Location: adminDashboard.php");
    exit();
}

header("Location: notas/frontend/notas.php");
exit();