<?php
require_once 'connection.php';

// 1. Captura de filtros e ordenação
$busca = isset($_GET['busca']) ? $_GET['busca'] : '';
$categoria_selecionada = isset($_GET['categoria']) ? $_GET['categoria'] : '';
$ordenar = isset($_GET['ordenar']) ? $_GET['ordenar'] : 'titulo_asc';

// 2. Base da query SQL
$sql = "SELECT * FROM livros WHERE 1=1";

// 3. Adiciona filtros se existirem
if (!empty($busca)) {
    $sql .= " AND (titulo LIKE '%$busca%' OR autor LIKE '%$busca%')";
}
if (!empty($categoria_selecionada)) {
    $sql .= " AND categoria = '$categoria_selecionada'";
}

// 4. Lógica de Ordenação (Funcionando)
switch ($ordenar) {
    case 'titulo_asc':  $sql .= " ORDER BY titulo ASC"; break;
    case 'titulo_desc': $sql .= " ORDER BY titulo DESC"; break;
    case 'ano_asc':     $sql .= " ORDER BY ano ASC"; break;
    case 'ano_desc':    $sql .= " ORDER BY ano DESC"; break;
    default:            $sql .= " ORDER BY titulo ASC";
}

$resultado = $conn->query($sql);

// 5. Busca categorias para o select
$categorias = $conn->query("SELECT DISTINCT categoria FROM livros ORDER BY categoria");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Minha Biblioteca</title>
</head>
<body>
    <div class="app-container">
        <header class="app-header">
            <div class="header-content">
                <h1>📚 Biblioteca</h1>
                <a href="cadastro.php" class="btn btn-primary">+ Adicionar</a>
            </div>
        </header>

        <!-- Formulário unificado (Busca + Filtro + Ordem) -->
        <div class="filters-container">
            <form method="GET" action="index.php" class="search-form">
                
                <input type="text" name="busca" placeholder="Pesquisar..." value="<?php echo $busca; ?>" class="filter-select">

                <select name="categoria" class="filter-select" onchange="this.form.submit()">
                    <option value="">Todas Categorias</option>
                    <?php while($cat = $categorias->fetch_assoc()): ?>
                        <option value="<?php echo $cat['categoria']; ?>" <?php if($categoria_selecionada == $cat['categoria']) echo 'selected'; ?>>
                            <?php echo $cat['categoria']; ?>
                        </option>
                    <?php endwhile; ?>
                </select>

                <select name="ordenar" class="filter-select" onchange="this.form.submit()">
                    <option value="titulo_asc"  <?php if($ordenar == 'titulo_asc') echo 'selected'; ?>>Título (A-Z)</option>
                    <option value="titulo_desc" <?php if($ordenar == 'titulo_desc') echo 'selected'; ?>>Título (Z-A)</option>
                    <option value="ano_asc"     <?php if($ordenar == 'ano_asc') echo 'selected'; ?>>Ano (Mais Antigo)</option>
                    <option value="ano_desc"    <?php if($ordenar == 'ano_desc') echo 'selected'; ?>>Ano (Mais Novo)</option>
                </select>

                <button type="submit" class="btn btn-search">Filtrar</button>
                <a href="index.php" class="btn btn-clear">Limpar</a>
            </form>
        </div>

        <main class="books-container">
            <div class="books-grid">
                <?php if ($resultado->num_rows > 0): ?>
                    <?php while($livro = $resultado->fetch_assoc()): ?>
                        <div class="book-card">
                            <div class="book-cover">
                                <i class="fas fa-book"></i>
                            </div>
                            <div class="book-info">
                                <h3><?php echo $livro['titulo']; ?></h3>
                                <p><strong>Autor:</strong> <?php echo $livro['autor']; ?></p>
                                <p><strong>Ano:</strong> <?php echo $livro['ano']; ?></p>
                                <div class="book-footer">
                                    <span class="book-category"><?php echo $livro['categoria']; ?></span>
                                    <div class="book-actions">
                                        <a href="cadastro.php?id=<?php echo $livro['id']; ?>"><i class="fas fa-edit"></i></a>
                                        <a href="excluir.php?id=<?php echo $livro['id']; ?>" onclick="return confirm('Deseja excluir?')"><i class="fas fa-trash"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p>Nenhum livro encontrado.</p>
                <?php endif; ?>
            </div>
        </main>
    </div>
</body>
</html>