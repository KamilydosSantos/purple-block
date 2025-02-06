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

$queryGrupos = $conexao->prepare("SELECT id, nome FROM grupo");
$queryGrupos->execute();
$grupos = $queryGrupos->fetchAll(PDO::FETCH_ASSOC)
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/index.css">
    <link rel="stylesheet" href="../../assets/css/adminDashboard.css">
    <title>Editar Usuário</title>
</head>
<body>
    <div class="card">
        <div class="titulo">
            <h1>Editar Usuário</h1>
        </div>

        <form action="backend/editarUsuario.php" method="POST">
            <div>
                <input type="hidden" name="id" value="<?php echo $usuario['id'];?>">
                <label for="nome_completo">Nome do Usuário:</label>
                <input type="text" id="nome_completo" name="nome_completo" value="<?php echo htmlspecialchars($usuario['nome_completo']); ?>" required>
            </div>

            <div>
                <label for="email">Email:</label>
                <input type="text" id="email" name="email" value="<?php echo htmlspecialchars($usuario['email']); ?>" required>
            </div>

            <div>
                <label for="grupo_id">Grupo Colaborativo:</label>
                <select id="grupo_id" name="grupo_id" required>
                    <?php foreach ($grupos as $grupo): ?>
                        <option value="<?php echo $grupo['id']; ?>" <?php echo ($usuario['grupo_id'] == $grupo['id']) ? 'selected' : ''; ?>>
                            <?php echo $grupo['id'] . ' - ' . $grupo['nome']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="botoes">
                <a href="../adminDashboard.php">Cancelar</a>
                <button type="submit">Salvar Alterações</button>
            </div>
        </form>

    </div>
</body>
</html>