<?php
session_start();
require '../../conexao.php';

if (!isset($_SESSION['id'])) {
    header('Location: ../../index.php');
    exit();
}

if (!isset($_POST['id'])) {
    echo "Nota não encontrada!";
    exit();
}

$notaId = $_POST['id'];
$userId = $_SESSION['id'];

$queryNota = $conexao->prepare("SELECT * FROM nota WHERE id = :id");
$queryNota->bindParam(':id', $notaId);
$queryNota->execute();
$nota = $queryNota->fetch(PDO::FETCH_ASSOC);

if (!$nota) {
    echo "Nota não encontrada!";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'];
    $conteudo = $_POST['conteudo'];

    $queryUpdate = $conexao->prepare("UPDATE nota SET titulo = :titulo, conteudo = :conteudo WHERE id = :id");
    $queryUpdate->bindParam(':titulo', $titulo);
    $queryUpdate->bindParam(':conteudo', $conteudo);
    $queryUpdate->bindParam(':id', $notaId);

    if ($queryUpdate->execute()) {
        header('Location: ../notas.php');
        exit();
    } else {
        echo "Erro ao editar a nota.";
    }
}
?>