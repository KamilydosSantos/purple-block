<?php
session_start();
require '../../conexao.php';

if (!isset($_SESSION['id'])) {
    header('Location: ../../autenticacao/login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['nota_id'])) {
        $nota_id = $_POST['nota_id'];

        $queryDelete = $conexao->prepare("DELETE FROM nota WHERE id = :nota_id AND usuario_id = :usuario_id");
        $queryDelete->bindParam(':nota_id', $nota_id);
        $queryDelete->bindParam(':usuario_id', $_SESSION['id']);
        
        if ($queryDelete->execute()) {
            echo "Nota excluída com sucesso!";
            header('Location: ../frontend/notas.php');
            exit();
        } else {
            echo "Erro ao excluir a nota.";
        }
    } else {
        echo "ID da nota não encontrado.";
    }
}
?>