<?php
session_start();
if ($_SESSION['admin'] !== 1) {
    header('Location: ../../index.php');
    exit();
}

require '../../conexao.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "Usuário não encontrado.";
    exit();
}

$idUsuario = $_GET['id'];

$queryUsuario = $conexao->prepare("SELECT * FROM usuario WHERE id = :id");
$queryUsuario->bindParam(':id', $idUsuario, PDO::PARAM_INT);
$queryUsuario->execute();
$usuario = $queryUsuario->fetch(PDO::FETCH_ASSOC);

if (!$usuario) {
    echo "Usuário não encontrado.";
    exit();
}
?>