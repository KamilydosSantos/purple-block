<?php
session_start();
require '../../conexao.php';

if (!isset($_SESSION['id'])) {
    header('Location: ../../autenticacao/login.php');
    exit();
}

$usuario_id = $_SESSION['id'];

$queryGrupo = $conexao->prepare("SELECT grupo_id FROM usuario WHERE id = :usuario_id");
$queryGrupo->bindParam(':usuario_id', $usuario_id);
$queryGrupo->execute();
$grupo = $queryGrupo->fetch(PDO::FETCH_ASSOC);

if (!$grupo) {
    echo "Erro ao encontrar o grupo do usuário.";
    exit();
}

$grupo_id = $grupo['grupo_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'];
    $conteudo = $_POST['conteudo'];

    $queryInsert = $conexao->prepare("INSERT INTO nota (titulo, conteudo, usuario_id, grupo_id) VALUES (:titulo, :conteudo, :usuario_id, :grupo_id)");
    $queryInsert->bindParam(':titulo', $titulo);
    $queryInsert->bindParam(':conteudo', $conteudo);
    $queryInsert->bindParam(':usuario_id', $usuario_id);
    $queryInsert->bindParam(':grupo_id', $grupo_id);

    if ($queryInsert->execute()) {
        header('Location: ../notas.php');
        exit();
    } else {
        echo "Erro ao criar a nota.";
    }
}
?>
