<?php
include '../menu/menu.php';

require '../conexao.php';

if (!isset($_SESSION['id'])) {
    header('Location: ../index.php');
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
    <link rel="stylesheet" href="../assets/css/notas.css">
    <link rel="stylesheet" href="../menu/menu.css">
</head>
<body>
    <div class="container">
        <h1>Notas Colaborativas do Grupo</h1>

        <a href="criarNota.php" class="btn-criar">Criar Nova Nota</a>

        <div class="notas">
            <?php foreach ($notas as $nota): ?>
                <?php
                date_default_timezone_set('America/Sao_Paulo');
                $tempoAtual = date("Y-m-d H:i:s");
                
                $ultimaEdicao = $nota['ultima_edicao'];

                $timestampAtual = strtotime($tempoAtual);
                $timestampUltimaEdicao = strtotime($ultimaEdicao);
                
                $diferenca = $timestampAtual - $timestampUltimaEdicao;

                if ($diferenca < 60) {
                    $tempoPassado = 'há menos de 1 minuto';
                } elseif ($diferenca < 3600) {
                    $tempoPassado = 'há ' . floor($diferenca / 60) . ' minutos';
                } elseif ($diferenca < 86400) {
                    $tempoPassado = 'há ' . floor($diferenca / 3600) . ' horas';
                } else {
                    $tempoPassado = 'há ' . floor($diferenca / 86400) . ' dias';
                }
                ?>
                <div class="nota">
                    <a href="editarNota.php?id=<?php echo $nota['id']; ?>" class="nota-link">
                        <p class="ultima-edicao"><?php echo $tempoPassado; ?></p>
                        <h2 class="titulo"><?php echo htmlspecialchars($nota['titulo']); ?></h2>
                        <hr>
                        <p class="conteudo"><?php echo nl2br(htmlspecialchars($nota['conteudo'])); ?></p>
                    </a>
                    <form method="POST" action="backend/excluirNota.php" class="form-excluir">
                        <input type="hidden" name="nota_id" value="<?php echo $nota['id']; ?>">
                        <button type="submit" class="btn-excluir">
                            <span class="fechar">X</span>
                        </button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>