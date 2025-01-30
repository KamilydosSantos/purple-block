<?php
session_start();
if ($_SESSION['tipo'] !== 'admin') {
    header('Location: index.php');
    exit();
}
require 'conexao.php';

$queryGrupos = $conexao->prepare("SELECT * FROM grupo");
$queryGrupos->execute();
$grupos = $queryGrupos->fetchAll(PDO::FETCH_ASSOC);

$queryUsuarios = $conexao->prepare("SELECT * FROM usuario");
$queryUsuarios->execute();
$usuarios = $queryUsuarios->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="adminDashboard.css">
    <title>PurpleBlock | Painel Administrativo</title>
</head>
<body>
    <div class="container">
        <div class="titulo">
            <h1>Painel Administrativo</h1>
        </div>

        <div class="tabela">
            <h2>Grupos Colaborativos</h2>
            <table>
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nome</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($grupos as $grupo): ?>
                        <tr>
                            <td><?php echo $grupo['id']; ?></td>
                            <td><?php echo $grupo['nome']; ?></td>
                            <td>
                                <a href="visualizarGrupo.php?id=<?php echo $grupo['id']; ?>"><img src="visualizarIcon.svg" alt=""></a> 
                                <a href="editarGrupo.php?id=<?php echo $grupo['id']; ?>"><img src="editarIcon.svg" alt=""></a>
                                <a href="excluirGrupo.php?id=<?php echo $grupo['id']; ?>"><img src="excluirIcon.svg" alt=""></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="botoes">
            <a href="criarGrupo.php">Criar Novo Grupo</a>
        </div>

        <div class="tabela">
            <h2>Usuários</h2>
            <table>
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($usuarios as $usuario): ?>
                        <tr>
                            <td><?php echo $usuario['id']; ?></td>
                            <td><?php echo $usuario['nome_completo']; ?></td>
                            <td><?php echo $usuario['email']; ?></td>
                            <td>
                                <a href="visualizarUsuario.php?id=<?php echo $usuario['id']; ?>"><img src="visualizarIcon.svg" alt=""></a>
                                <a href="editarUsuario.php?id=<?php echo $usuario['id']; ?>"><img src="editarIcon.svg" alt=""></a>
                                <a href="excluirUsuario.php?id=<?php echo $usuario['id']; ?>"><img src="excluirIcon.svg" alt=""></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="botoes">
            <a href="criarUsuario.php">Criar Novo Usuário</a>
        </div>
    </div>
</body>
</html>