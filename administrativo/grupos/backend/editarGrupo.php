<?php
session_start();
if ($_SESSION['admin'] !== 1) {
    header('Location: ../../../index.php');
    exit();
}

require '../../../conexao.php';

if (!isset($_POST['id']) || empty($_POST['id'])) {
    echo "Grupo não encontrado.";
    exit();
}

$idGrupo = $_POST['id'];

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
        header("Location: ../../adminDashboard.php");
        exit();
    } else {
        echo "Erro ao atualizar o grupo.";
    }
}
?>