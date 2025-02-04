<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="adminDashboard.css">
    <title>Criar Novo Usuário</title>
</head>
<body>
    <div class="card">
        <div class="titulo">
            <h1>Criar Novo Usuário</h1>
        </div>

        <form method="POST">
            <label for="nome">Nome Completo:</label>
            <input type="text" id="nome" name="nome" required>

            <label for="email">Email:</label>
            <input type="text" id="email" name="email" required>

            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required>

            <label for="admin-sim">Usuário Administrador:</label>

            <input type="radio" id="admin-sim" name="administrador" value="1" <?= isset($admin) && $admin == 1 ? 'checked' : ''; ?>>
            <label for="admin-sim">Sim</label>
            <input type="radio" id="admin-nao" name="administrador" value="0" <?= isset($admin) && $admin == 0 ? 'checked' : ''; ?>>
            <label for="admin-nao">Não</label>
         
            <label for="grupo">Grupo Colaborativo ID:</label>
            <input type="text" id="grupo" name="grupo" required>
          
            <div class="botoes">
                <a href="adminDashboard.php">Cancelar</a>
                <button type="submit">Criar Usuário</button>
            </div>
        </form>

    </div>
</body>
</html>