<?php
session_start();
if ($_SESSION['admin'] !== 1) {
    header('Location: index.php');
    exit();
}

require 'conexao.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "Usuário não encontrado.";
    exit();
}

$idUsuario = $_GET['id'];

$queryUsuario = $conexao->prepare("SELECT * FROM usuario WHERE id = :id");
$queryUsuario->bindParam(':id', $idUsuario, PDO::PARAM_INT);
$queryUsuario->execute();
$usuario = $queryUsuario->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="adminDashboard.css">
    <title>Excluir Usuário</title>
</head>
<body>
    <div class="card">
        <div class="titulo">
            <h1>Excluir Usuário</h1>
        </div>

        <p>Tem certeza que deseja excluir o usuário <strong><?php echo htmlspecialchars($usuario['nome_completo']); ?></strong>?</p>

        <form action="excluirUsuario.php?id=<?=$usuario['id']?>" method="POST">
            <div class="botoes">
                <a href="adminDashboard.php">Cancelar</a>
                <button type="submit">Confirmar Exclusão</button>
            </div>
        </form>
    </div>
</body>
</html>