
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
     <div class="container flex between">
    
        <div class="retangulo1"></div>
        <div class="retangulo2 flex colum center ">

        <form action="processa.php" method="$_POST">
            <input type="text" name="nome" placeholder="nome" >
            <input type="text" name="email" placeholder="email">
            <input type="password" name="senha" placeholder="senha">
            <input type="text" name="cpf" placeholder="cpf" maxlength="12">
            <input type="date" name="nasc" placeholder="data nascimento">
            <input type="submit" value="enviar">

        </form>

        </div>
        
     </div>

</body>
</html>