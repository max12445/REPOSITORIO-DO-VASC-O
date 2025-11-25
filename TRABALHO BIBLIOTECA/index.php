<?php
// Conexão com o banco de dados
include 'connection.php';

// Lógica de busca
//    seleciona os livros de maneira descrecente
$termoBusca = "";
$sql = "SELECT * FROM livros ORDER BY id DESC";

if (!empty($_GET['busca'])) {
    $termoBusca = $conn->real_escape_string($_GET['busca']);
    $sql = "SELECT * FROM livros 
            WHERE titulo LIKE '%$termoBusca%' 
               OR categoria LIKE '%$termoBusca%'";
}

$resultado = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca Escolar - Listagem</title>
    <link rel="stylesheet" href="index.css">
</head>

<body>

    <!-- Cabeçalho -->
    <header>
        <h1>📚 Biblioteca Escolar</h1>
        <a href="cadastro.php" class="btn-top">+ Cadastrar Livro</a>
    </header>

    <div class="container">

        <!-- Formulário de Busca -->
        <form class="search-box" method="GET" action="index.php">
            <input
                type="text"
                name="busca"
                placeholder="Pesquise por título ou categoria..."
                value="<?php echo htmlspecialchars($termoBusca); ?>">
            <button type="submit">Buscar</button>

            <?php if ($termoBusca): ?>
                <a href="index.php" class="btn-clear">Limpar</a>
            <?php endif; ?>
        </form>

        <!-- Tabela de Resultados -->
        <table>
            <thead>
                <tr>
                    <th width="5%">ID</th>
                    <th width="40%">Título</th>
                    <th width="20%">Autor</th>
                    <th width="10%">Ano</th>
                    <th width="15%">Categoria</th>
                    <th width="10%">Qtd.</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($resultado && $resultado->num_rows > 0): ?>
                    <?php while ($livro = $resultado->fetch_assoc()): ?>
                        <tr>
                            <td><?= $livro['id'] ?></td>
                            <td><strong><?= $livro['titulo'] ?></strong></td>
                            <td><?= $livro['autor'] ?></td>
                            <td><?= $livro['ano'] ?></td>
                            <td><span class="tag-categoria"><?= $livro['categoria'] ?></span></td>
                            <td><?= $livro['quantidade'] ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="empty-msg">Nenhum livro encontrado no acervo.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

    </div>

</body>

</html>