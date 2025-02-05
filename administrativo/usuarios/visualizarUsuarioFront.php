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
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../adminDashboard.css">
    <title>Visualizar Usuário</title>
</head>
<body>
    <div class="card">
        <div class="titulo">
            <h1>Detalhes do Usuário</h1>
        </div>

        <div class="detalhes">
            <p><strong>ID:</strong> <?php echo $usuario['id']; ?></p>
            <p><strong>Nome:</strong> <?php echo $usuario['nome_completo']; ?></p>
            <p><strong>Email:</strong> <?php echo $usuario['email']; ?></p>
            <p><strong>Grupo Colaborativo ID:</strong> <?php echo $usuario['grupo_id']; ?></p>
        </div>

        <div class="botoes">
            <a href="../adminDashboard.php">Voltar</a>
        </div>
    </div>
</body>
</html>