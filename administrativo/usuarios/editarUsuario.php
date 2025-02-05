<?php
session_start();
if ($_SESSION['admin'] !== 1) {
    header('Location: ../../index.php');
    exit();
}

require '../../conexao.php';

if (!isset($_POST['id']) || empty($_POST['id'])) {
    echo "Usuário não encontrado.";
    exit();
}

$idUsuario = $_POST['id'];

$queryUsuario = $conexao->prepare("SELECT * FROM usuario WHERE id = :id");
$queryUsuario->bindParam(':id', $idUsuario, PDO::PARAM_INT);
$queryUsuario->execute();
$usuario = $queryUsuario->fetch(PDO::FETCH_ASSOC);

if (!$usuario) {
    echo "Usuário não encontrado.";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome_completo'];
    $email = $_POST['email'];
    $grupo = $_POST['grupo_id'];
    $id = $_POST['id'];

    $queryUpdate = $conexao->prepare("UPDATE usuario SET nome_completo = :nome, email = :email, grupo_id = :grupo WHERE id = :id");
    $queryUpdate->bindParam(':nome', $nome, PDO::PARAM_STR);
    $queryUpdate->bindParam(':email', $email, PDO::PARAM_STR);
    $queryUpdate->bindParam(':grupo', $grupo, PDO::PARAM_INT);
    $queryUpdate->bindParam(':id', $idUsuario, PDO::PARAM_INT);

    if ($queryUpdate->execute()) {
        echo "Usuário atualizado com sucesso!";
        header("Location: ../adminDashboard.php");
        exit();
    } else {
        echo "Erro ao atualizar os dados do usuário.";
    }
}

include 'editarUsuarioFront.php';
?>

