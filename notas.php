<?php
session_start();
require 'conexao.php';

if (!isset($_SESSION['id'])) {
    header('Location: index.php');
    exit();
}

$userId = $_SESSION['id'];
$queryNotas = $conexao->prepare("SELECT * FROM nota WHERE usuario_id = :usuario_id");
$queryNotas->bindParam(':usuario_id', $userId);
$queryNotas->execute();
$notas = $queryNotas->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minhas Notas</title>
    <link rel="stylesheet" href="notas.css">
</head>
<body>
    <div class="container">
        <h1>Notas Colaborativas do Grupo</h1>

        <a href="criarNota.php" class="btn-criar">Criar Nova Nota</a>

        <div class="notas">
          <?php foreach ($notas as $nota): ?>
              <div class="nota">
                  <a href="editarNota.php?id=<?php echo $nota['id']; ?>" class="nota-link">
                      <h2 class="titulo"><?php echo htmlspecialchars($nota['titulo']); ?></h2>
                      <hr>
                      <p class="conteudo"><?php echo nl2br(htmlspecialchars($nota['conteudo'])); ?></p>
                  </a>
                  <!-- Botão de excluir, inicialmente oculto -->
                  <form method="POST" action="excluirNota.php" class="form-excluir">
                      <input type="hidden" name="nota_id" value="<?php echo $nota['id']; ?>">
                      <button type="submit" class="btn-excluir">Excluir</button>
                  </form>
              </div>
          <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
