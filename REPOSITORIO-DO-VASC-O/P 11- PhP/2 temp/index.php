<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Cadastro</title>
    <link rel="stylesheet" href="design.css">
</head>
<body>
    <div class="container-web">

        <!-- Tela de cadastro -->
        <form action ="process.php" method="POST" class="tela-cadastro">
            <h2>Crie sua conta</h2>

            <input type="email" placeholder="email" name="email">
            <input type="password" placeholder="Senha" name="password">
            <input type="password" placeholder="confirmar.-" name="confirmar">

            <input type="submit" value="Enviar" >
        </form>

    </div>
</body>
</html>
