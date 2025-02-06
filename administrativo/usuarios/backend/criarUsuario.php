<?php
session_start();
if ($_SESSION['admin'] !== 1) {
    header('Location: ../../../index.php');
    exit();
}

require '../../../conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $admin = isset($_POST['administrador']) && $_POST['administrador'] === 'on' ? 1 : 0;
    $grupo = $_POST['grupo'];

    $queryInsert = $conexao->prepare("INSERT INTO usuario (nome_completo, email, senha, admin, grupo_id) VALUES (:nome, :email, :senha, :administrador, :grupo)");
    $queryInsert->bindParam(':nome', $nome, PDO::PARAM_STR);
    $queryInsert->bindParam(':email', $email, PDO::PARAM_STR);
    $queryInsert->bindParam(':senha', $senha, PDO::PARAM_STR);
    $queryInsert->bindParam(':administrador', $admin, PDO::PARAM_INT);
    $queryInsert->bindParam(':grupo', $grupo, PDO::PARAM_INT);

    if ($queryInsert->execute()) {
        echo "Usuário criado com sucesso!";
        header("Location: ../../adminDashboard.php");
        exit();
    } else {
        echo "Erro ao criar usuário.";
        header("Location: ../../adminDashboard.php");
        exit();
    }
}
?>
