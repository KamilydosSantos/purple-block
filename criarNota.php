<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="adminDashboard.css">
    <title>Criar Nota</title>
</head>
<body>
    <div class="container">
        <div class="titulo">
            <h1>Criar Nova Nota</h1>
        </div>

        <form method="POST" action="backend/criarNota.php">
            <label for="titulo">Título da Nota:</label>
            <input type="text" id="titulo" name="titulo" required>

            <label for="conteudo">Conteúdo da Nota:</label>
            <textarea id="conteudo" name="conteudo" required></textarea>

            <button type="submit">Criar Nota</button>
        </form>

        <div class="botoes">
            <a href="notas.php">Cancelar</a>
        </div>
    </div>
</body>
</html>
