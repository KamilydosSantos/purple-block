<?php
include '../menu/menu.php';

if ($_SESSION['admin'] !== 1) {
    header('Location: ../index.php');
    exit();
}
require '../conexao.php';

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
    <link rel="stylesheet" href="../assets/css/index.css">
    <link rel="stylesheet" href="../assets/css/adminDashboard.css">
    <link rel="stylesheet" href="../menu/menu.css">
    <title>PurpleBlock | Painel Administrativo</title>
</head>
<body>
    <div class="container">
        <h1 class="titulo">Painel Administrativo</h1>

        <div class="tabela">
            <h2>Grupos Colaborativos</h2>
            <table>
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($grupos as $grupo): ?>
                        <tr>
                            <td><?php echo $grupo['id']; ?></td>
                            <td><?php echo $grupo['nome']; ?></td>
                            <td><?php echo $grupo['descricao']; ?></td>
                            <td>
                                <a class="acao" href="grupos/visualizarGrupo.php?id=<?php echo $grupo['id']; ?>"><img src="../assets/icons/visualizarIcon.svg" alt=""></a> 
                                <a class="acao" href="grupos/editarGrupo.php?id=<?php echo $grupo['id']; ?>"><img src="../assets/icons/editarIcon.svg" alt=""></a>
                                <a class="acao" href="grupos/excluirGrupo.php?id=<?php echo $grupo['id']; ?>"><img src="../assets/icons/excluirIcon.svg" alt=""></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="botoes">
                <a href="grupos/criarGrupo.php">Criar novo grupo</a>
            </div>
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
                                <a class="acao" href="usuarios/visualizarUsuarioFront.php?id=<?php echo $usuario['id']; ?>"><img src="../assets/icons/visualizarIcon.svg" alt=""></a>
                                <a class="acao" href="usuarios/editarUsuarioFront.php?id=<?php echo $usuario['id']; ?>"><img src="../assets/icons/editarIcon.svg" alt=""></a>
                                <?php if ($usuario['id'] != $_SESSION['id']) { ?>
                                    <a class="acao" href="usuarios/excluirUsuarioFront.php?id=<?php echo $usuario['id']; ?>"><img src="../assets/icons/excluirIcon.svg" alt=""></a>
                                <?php }?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="botoes">
                <a href="usuarios/criarUsuario.php">Criar novo usuário</a>
            </div>
        </div>

    </div>
</body>
</html>