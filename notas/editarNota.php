<?php
session_start();
require '../conexao.php';

if (!isset($_SESSION['id'])) {
    header('Location: ../index.php');
    exit();
}

if (!isset($_GET['id'])) {
    echo "Nota não encontrada!";
    exit();
}

$notaId = $_GET['id'];
$userId = $_SESSION['id'];

$queryNota = $conexao->prepare("SELECT * FROM nota WHERE id = :id");
$queryNota->bindParam(':id', $notaId);
$queryNota->execute();
$nota = $queryNota->fetch(PDO::FETCH_ASSOC);

if (!$nota) {
    echo "Nota não encontrada!";
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Nota</title>
    <link rel="stylesheet" href="../assets/css/index.css">
    <link rel="stylesheet" href="../assets/css/notas.css">
</head>
<body>
    <div class="container">
        <div class="card">
            <h1>Editar Nota</h1>
    
            <form action="backend/editarNota.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $nota['id'];?>">
                <div class="campos">
                    <div class="campos__campo">
                        <label for="titulo">Título:</label>
                        <input type="text" id="titulo" name="titulo" value="<?php echo htmlspecialchars($nota['titulo']); ?>" required>
                    </div>
    
                    <div class="campos__campo">
                        <label for="conteudo">Conteúdo:</label>
                        <textarea id="conteudo" name="conteudo" required><?php echo htmlspecialchars($nota['conteudo']); ?></textarea>
                    </div>
    
                    <div class="botoes">
                        <a href="notas.php">Cancelar</a>
                        <button type="submit" class="submit">Salvar Alterações</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
