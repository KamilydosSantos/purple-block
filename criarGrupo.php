<?php
session_start();
if ($_SESSION['tipo'] !== 'admin') {
    header('Location: index.php');
    exit();
}

require 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];

    $queryInsert = $conexao->prepare("INSERT INTO grupo (nome, descricao) VALUES (:nome, :descricao)");
    $queryInsert->bindParam(':nome', $nome, PDO::PARAM_STR);
    $queryInsert->bindParam(':descricao', $descricao, PDO::PARAM_STR);

    if ($queryInsert->execute()) {
        echo "Grupo criado com sucesso!";
        header("Location: adminDashboard.php");
        exit();
    } else {
        echo "Erro ao criar o grupo.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="adminDashboard.css">
    <title>Criar Novo Grupo</title>
</head>
<body>
    <div class="container">
        <div class="titulo">
            <h1>Criar Novo Grupo</h1>
        </div>

        <form method="POST">
            <label for="nome">Nome do Grupo:</label>
            <input type="text" id="nome" name="nome" required>

            <label for="descricao">Descrição:</label>
            <textarea id="descricao" name="descricao" required></textarea>

            <button type="submit">Criar Grupo</button>
        </form>

        <div class="botoes">
            <a href="adminDashboard.php">Cancelar</a>
        </div>
    </div>
</body>
</html>
