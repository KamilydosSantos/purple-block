<?php
session_start();
if ($_SESSION['admin'] !== 1) {
    header('Location: ../../index.php');
    exit();
}

require '../../conexao.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    $queryUsuario = $conexao->prepare("SELECT * FROM usuario WHERE id = :id");
    $queryUsuario->bindParam(':id', $id, PDO::PARAM_INT);
    $queryUsuario->execute();
    $usuario = $queryUsuario->fetch(PDO::FETCH_ASSOC);

    if (!$usuario) {
        echo "Usuário não encontrado!";
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $queryDelete = $conexao->prepare("DELETE FROM usuario WHERE id = :id");
        $queryDelete->bindParam(':id', $id, PDO::PARAM_INT);

        if ($queryDelete->execute()) {
            echo "Usuário excluído com sucesso!";
            header("Location: ../adminDashboard.php");
            exit();
        } else {
            echo "Erro ao excluir o usuário.";
        }
    }
} else {
    echo "ID inválido!";
    header("Location: ../adminDashboard.php");
    exit();
}
?>
