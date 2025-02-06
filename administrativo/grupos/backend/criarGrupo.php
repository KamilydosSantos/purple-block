<?php
session_start();
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== 1) {
    header('Location: ../../../index.php');
    exit();
}

require '../../../conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome']);
    $descricao = trim($_POST['descricao']);

    if (!empty($nome) && !empty($descricao)) {
        $queryInsert = $conexao->prepare("INSERT INTO grupo (nome, descricao) VALUES (:nome, :descricao)");
        $queryInsert->bindParam(':nome', $nome, PDO::PARAM_STR);
        $queryInsert->bindParam(':descricao', $descricao, PDO::PARAM_STR);

        if ($queryInsert->execute()) {
            $_SESSION['mensagem'] = "Grupo criado com sucesso!";
            header("Location: ../../adminDashboard.php");
            exit();
        } else {
            $_SESSION['mensagem'] = "Erro ao criar o grupo.";
            header("Location: ../criarGrupo.php");
            exit();
        }
    } else {
        $_SESSION['mensagem'] = "Preencha todos os campos!";
        header("Location: ../criarGrupo.php");
        exit();
    }
}
?>