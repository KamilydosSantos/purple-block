<?php
session_start();
if ($_SESSION['admin'] !== 1) {
    header('Location: index.php');
    exit();
}

require 'conexao.php';

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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];

    $queryUpdate = $conexao->prepare("UPDATE grupo SET nome = :nome, descricao = :descricao WHERE id = :id");
    $queryUpdate->bindParam(':nome', $nome, PDO::PARAM_STR);
    $queryUpdate->bindParam(':descricao', $descricao, PDO::PARAM_STR);
    $queryUpdate->bindParam(':id', $idGrupo, PDO::PARAM_INT);

    if ($queryUpdate->execute()) {
        echo "Grupo atualizado com sucesso!";
        header("Location: adminDashboard.php");
        exit();
    } else {
        echo "Erro ao atualizar o grupo.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="adminDashboard.css">
    <title>Editar Grupo</title>
</head>
<body>
    <div class="card">
        <div class="titulo">
            <h1>Editar Grupo</h1>
        </div>

        <form method="POST">
            <div>
                <label for="nome">Nome do Grupo:</label>
                <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($grupo['nome']); ?>" required>
            </div>

            <div>
                <label for="descricao">Descrição:</label>
                <textarea id="descricao" name="descricao" rows="4" required><?php echo htmlspecialchars($grupo['descricao'] ?? ''); ?></textarea>
            </div>

            <div class="botoes">
                <a href="adminDashboard.php">Cancelar</a>
                <button type="submit">Salvar Alterações</button>
            </div>
        </form>

    </div>
</body>
</html>
