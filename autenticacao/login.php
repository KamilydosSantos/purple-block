<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/login.css">
    <title>PurpleBlock | Login</title>
</head>
<body>
    <form id="form" action="processaLogin.php" method="POST" onsubmit="validarFormulario(event)">
        <div class="titulo">
            <h1>Faça o seu login</h1>
        </div>

        <div class="campos">
            <div class="campos__campo">
                <label for="email">E-mail</label>
                <input type="text" name="email" id="email">
            </div>

            <div class="campos__campo">
                <label for="senha">Senha</label>
                <input type="password" name="senha" id="senha">
            </div>
            <input class="submit" type="submit" value="Entrar">
        </div>
    </form>
    <script src="../assets/js/login.js"></script>
</body>
</html>