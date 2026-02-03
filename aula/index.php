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

        <div class="retangulo1">
            <img class="bat-" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSivWWNZG9tvRDbx2tf3Oy4BwCxd6PeEXn6wa-glLVFr4Osc_UmXrMXVbPIG0iAmmn9I2kL6z9cOsRcwCmBLPY8M68yDpTNVeLGIeqcqYY&s=10" alt="">
        </div>

        <div class="retangulo2 flex colum center ">

            <form action="processa.php" method="post">
                <input type="text" name="nome" placeholder="nome">
                <input type="text" name="email" placeholder="email">
                <input type="password" name="senha" placeholder="senha">
                <input type="text" name="cpf" placeholder="cpf" maxlength="12">
                <input type="date" name="nasc" placeholder="nascimento" min="1900-01-01" max="2100-12-31">

                <input type="submit" value="enviar">

            </form>

        </div>

    </div>

</body>

</html>