<?php
session_start();
if ($_SESSION['tipo'] !== 'admin') {
    header('Location: index.php');
    exit();
}

require 'conexao.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    $queryGrupo = $conexao->prepare("SELECT * FROM grupo WHERE id = :id");
    $queryGrupo->bindParam(':id', $id, PDO::PARAM_INT);
    $queryGrupo->execute();
    $grupo = $queryGrupo->fetch(PDO::FETCH_ASSOC);

    if (!$grupo) {
        echo "Grupo não encontrado!";
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $queryDelete = $conexao->prepare("DELETE FROM grupo WHERE id = :id");
        $queryDelete->bindParam(':id', $id, PDO::PARAM_INT);

        if ($queryDelete->execute()) {
            echo "Grupo excluído com sucesso!";
            header("Location: adminDashboard.php");
            exit();
        } else {
            echo "Erro ao excluir o grupo.";
        }
    }
} else {
    echo "ID inválido!";
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="adminDashboard.css">
    <title>Excluir Grupo</title>
</head>
<body>
    <div class="container">
        <div class="titulo">
            <h1>Excluir Grupo</h1>
        </div>

        <p>Tem certeza que deseja excluir o grupo <strong><?php echo htmlspecialchars($grupo['nome']); ?></strong>?</p>

        <form method="POST">
            <button type="submit">Confirmar Exclusão</button>
            <a href="adminDashboard.php">Cancelar</a>
        </form>
    </div>
</body>
</html>
