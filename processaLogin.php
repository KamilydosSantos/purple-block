<?php
session_start();
require 'conexao.php';

if(isset($_POST['email']) && isset($_POST['senha'])) {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    try {
        $query = $conexao->prepare("SELECT * FROM usuario WHERE email = :email LIMIT 1");
        $query->bindParam(':email', $email);
        $query->execute();
        $usuario = $query->fetch(PDO::FETCH_ASSOC);

        if($usuario && $senha === $usuario['senha']) {
            $_SESSION['email'] = $usuario['email'];
            $_SESSION['tipo'] = $usuario['tipo'];

            if ($_SESSION['tipo'] === 'admin') {
                header('Location: adminDashboard.php');
            } else {
                header('Location: index.php');
            }
            exit();
        } else {
            $_SESSION['erro'] = "Email ou senha inválidos.";
            header('Location: index.php');
            echo "Deu erro";
            exit();
        }
    } catch(PDOException $erro) {
        echo "Erro ao logar o usuario: ".$erro->getMessage();
    }
}
?>
