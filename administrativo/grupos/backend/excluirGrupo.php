<?php
session_start();
if ($_SESSION['admin'] !== 1) {
    header('Location: ../../../index.php');
    exit();
}

require '../../../conexao.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    $queryGrupo = $conexao->prepare("SELECT * FROM grupo WHERE id = :id");
    $queryGrupo->bindParam(':id', $id, PDO::PARAM_INT);
    $queryGrupo->execute();
    $grupo = $queryGrupo->fetch(PDO::FETCH_ASSOC);

    if (!$grupo) {
        echo "Grupo não encontrado!";
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $queryDelete = $conexao->prepare("DELETE FROM grupo WHERE id = :id");
        $queryDelete->bindParam(':id', $id, PDO::PARAM_INT);

        if ($queryDelete->execute()) {
            echo "Grupo excluído com sucesso!";
            header("Location: ../../adminDashboard.php");
            exit();
        } else {
            echo "Erro ao excluir o grupo.";
        }
    }
} else {
    echo "ID inválido!";
    exit();
}
?>