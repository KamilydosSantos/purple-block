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
    <link rel="stylesheet" href="../../assets/css/index.css">
    <link rel="stylesheet" href="../../assets/css/adminDashboard.css">
    <title>Editar Grupo</title>
</head>
<body>
    <div class="card">
        <div class="titulo">
            <h1>Editar Grupo</h1>
        </div>

        <form action="backend/editarGrupo.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $grupo['id'];?>">
            <div>
                <label for="nome">Nome do Grupo:</label>
                <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($grupo['nome']); ?>" required>
            </div>

            <div>
                <label for="descricao">Descrição:</label>
                <textarea id="descricao" name="descricao" rows="4" required><?php echo htmlspecialchars($grupo['descricao'] ?? ''); ?></textarea>
            </div>

            <div class="botoes">
                <a href="../adminDashboard.php">Cancelar</a>
                <button type="submit">Salvar Alterações</button>
            </div>
        </form>

    </div>
</body>
</html>
