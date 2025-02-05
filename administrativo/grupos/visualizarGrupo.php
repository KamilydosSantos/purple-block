<?php
session_start();
if ($_SESSION['admin'] !== 1) {
    header('Location: ../../index.php');
    exit();
}

require '../../conexao.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "Grupo não encontrado.";
    exit();
}

$idGrupo = $_GET['id'];

$queryGrupo = $conexao->prepare("SELECT * FROM grupo WHERE id = :id");
$queryGrupo->bindParam(':id', $idGrupo, PDO::PARAM_INT);
$queryGrupo->execute();
$grupo = $queryGrupo->fetch(PDO::FETCH_ASSOC);

if (!$grupo) {
    echo "Grupo não encontrado.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../adminDashboard.css">
    <title>Visualizar Grupo</title>
</head>
<body>
    <div class="card">
        <div class="titulo">
            <h1>Detalhes do Grupo</h1>
        </div>

        <div class="detalhes">
            <p><strong>ID:</strong> <?php echo $grupo['id']; ?></p>
            <p><strong>Nome:</strong> <?php echo $grupo['nome']; ?></p>
            <p><strong>Descrição:</strong> <?php echo $grupo['descricao'] ?? 'Sem descrição'; ?></p>
        </div>

        <div class="botoes">
            <a href="../adminDashboard.php">Voltar</a>
        </div>
    </div>
</body>
</html>
