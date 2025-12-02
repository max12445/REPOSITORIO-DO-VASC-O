<?php
// Conexão com o banco de dados
require_once 'connection.php';

// Função para formatar quantidade
function formatarQuantidade($quantidade) {
    return $quantidade > 1 ? $quantidade . ' unidades' : $quantidade . ' unidade';
}

// Função para truncar texto longo
function truncarTexto($texto, $limite = 30) {
    return strlen($texto) > $limite ? substr($texto, 0, $limite) . '...' : $texto;
}

// Lógica de busca com filtro adicional
$termoBusca = isset($_GET['busca']) ? trim($_GET['busca']) : '';
$filtroCategoria = isset($_GET['categoria']) ? $_GET['categoria'] : '';
$ordenacao = isset($_GET['ordenar']) ? $_GET['ordenar'] : 'id_desc';

// Construção da consulta SQL
$sql = "SELECT * FROM livros";
$condicoes = [];
$params = [];

if (!empty($termoBusca)) {
    $condicoes[] = "(titulo LIKE ? OR autor LIKE ? OR categoria LIKE ?)";
    $params[] = "%$termoBusca%";
    $params[] = "%$termoBusca%";
    $params[] = "%$termoBusca%";
}

if (!empty($filtroCategoria)) {
    $condicoes[] = "categoria = ?";
    $params[] = $filtroCategoria;
}

if (!empty($condicoes)) {
    $sql .= " WHERE " . implode(" AND ", $condicoes);
}

// Ordenação
switch ($ordenacao) {
    case 'titulo_asc':
        $sql .= " ORDER BY titulo ASC";
        break;
    case 'titulo_desc':
        $sql .= " ORDER BY titulo DESC";
        break;
    case 'ano_asc':
        $sql .= " ORDER BY ano ASC";
        break;
    case 'ano_desc':
        $sql .= " ORDER BY ano DESC";
        break;
    case 'id_asc':
        $sql .= " ORDER BY id ASC";
        break;
    default:
        $sql .= " ORDER BY id DESC";
}

// Preparar e executar a consulta
$stmt = $conn->prepare($sql);
if (!empty($params)) {
    $types = str_repeat('s', count($params));
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$resultado = $stmt->get_result();

// Obter categorias únicas para o filtro
$categorias = [];
$categoriasQuery = $conn->query("SELECT DISTINCT categoria FROM livros ORDER BY categoria");
while ($row = $categoriasQuery->fetch_assoc()) {
    $categorias[] = $row['categoria'];
}

// Contagem de livros
$totalLivros = $resultado->num_rows;
$livrosPorCategoria = [];
if ($totalLivros > 0) {
    $contagemQuery = $conn->query("SELECT categoria, COUNT(*) as total FROM livros GROUP BY categoria");
    while ($row = $contagemQuery->fetch_assoc()) {
        $livrosPorCategoria[$row['categoria']] = $row['total'];
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca Digital - Acervo</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="index.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="app-container">
        <!-- Cabeçalho -->
        <header class="app-header">
            <div class="header-content">
                <div class="logo-container">
                    <i class="fas fa-book-open logo-icon"></i>
                    <h1>Biblioteca Digital</h1>
                </div>
                <div class="header-actions">
                    <a href="cadastro.php" class="btn btn-primary">
                        <i class="fas fa-plus-circle"></i> Novo Livro
                    </a>
                    <div class="theme-toggle">
                        <i class="fas fa-moon"></i>
                    </div>
                </div>
            </div>
        </header>

        <!-- Filtros e Busca -->
        <div class="filters-container">
            <div class="search-filter">
                <form method="GET" action="index.php" class="search-form">
                    <div class="search-input-group">
                        <i class="fas fa-search search-icon"></i>
                        <input
                            type="text"
                            name="busca"
                            placeholder="Buscar por título, autor ou categoria..."
                            value="<?php echo htmlspecialchars($termoBusca); ?>">
                    </div>
                    <input type="hidden" name="categoria" value="<?php echo htmlspecialchars($filtroCategoria); ?>">
                    <input type="hidden" name="ordenar" value="<?php echo htmlspecialchars($ordenacao); ?>">
                    <button type="submit" class="btn btn-search">
                        <i class="fas fa-search"></i> Buscar
                    </button>
                    <?php if (!empty($termoBusca) || !empty($filtroCategoria)): ?>
                        <a href="index.php" class="btn btn-clear">
                            <i class="fas fa-times"></i> Limpar
                        </a>
                    <?php endif; ?>
                </form>
            </div>

            <div class="filter-options">
                <div class="filter-group">
                    <label for="categoria">Filtrar por Categoria:</label>
                    <select name="categoria" id="categoria" class="filter-select" onchange="this.form.submit()">
                        <option value="">Todas as Categorias</option>
                        <?php foreach ($categorias as $cat): ?>
                            <option value="<?php echo $cat; ?>"
                                <?php echo $filtroCategoria === $cat ? 'selected' : ''; ?>>
                                <?php echo $cat; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="filter-group">
                    <label for="ordenar">Ordenar por:</label>
                    <select name="ordenar" id="ordenar" class="filter-select" onchange="this.form.submit()">
                        <option value="id_desc" <?php echo $ordenacao === 'id_desc' ? 'selected' : ''; ?>>Mais Recentes</option>
                        <option value="id_asc" <?php echo $ordenacao === 'id_asc' ? 'selected' : ''; ?>>Mais Antigos</option>
                        <option value="titulo_asc" <?php echo $ordenacao === 'titulo_asc' ? 'selected' : ''; ?>>Título (A-Z)</option>
                        <option value="titulo_desc" <?php echo $ordenacao === 'titulo_desc' ? 'selected' : ''; ?>>Título (Z-A)</option>
                        <option value="ano_desc" <?php echo $ordenacao === 'ano_desc' ? 'selected' : ''; ?>>Ano (Mais Novo)</option>
                        <option value="ano_asc" <?php echo $ordenacao === 'ano_asc' ? 'selected' : ''; ?>>Ano (Mais Antigo)</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Estatísticas -->
        <div class="stats-container">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-book"></i>
                </div>
                <div class="stat-info">
                    <h3>Total de Livros</h3>
                    <p><?php echo $totalLivros; ?></p>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-layer-group"></i>
                </div>
                <div class="stat-info">
                    <h3>Categorias</h3>
                    <p><?php echo count($categorias); ?></p>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-sort-amount-up"></i>
                </div>
                <div class="stat-info">
                    <h3>Mais Popular</h3>
                    <p>
                        <?php
                        if (!empty($livrosPorCategoria)) {
                            $categoriaPopular = array_search(max($livrosPorCategoria), $livrosPorCategoria);
                            echo $categoriaPopular;
                        } else {
                            echo "Nenhuma";
                        }
                        ?>
                    </p>
                </div>
            </div>
        </div>

        <!-- Lista de Livros -->
        <div class="books-container">
            <?php if ($totalLivros > 0): ?>
                <div class="books-grid">
                    <?php while ($livro = $resultado->fetch_assoc()): ?>
                        <div class="book-card">
                            <div class="book-cover">
                                <i class="fas fa-book"></i>
                                <span class="book-id">#<?php echo $livro['id']; ?></span>
                            </div>
                            <div class="book-info">
                                <h3 class="book-title" title="<?php echo htmlspecialchars($livro['titulo']); ?>">
                                    <?php echo truncarTexto(htmlspecialchars($livro['titulo'])); ?>
                                </h3>
                                <p class="book-author">
                                    <i class="fas fa-user-edit"></i>
                                    <?php echo htmlspecialchars($livro['autor']); ?>
                                </p>
                                <div class="book-meta">
                                    <span class="book-year">
                                        <i class="fas fa-calendar-alt"></i>
                                        <?php echo $livro['ano']; ?>
                                    </span>
                                    <span class="book-category">
                                        <i class="fas fa-tag"></i>
                                        <?php echo htmlspecialchars($livro['categoria']); ?>
                                    </span>
                                </div>
                                <div class="book-footer">
                                    <span class="book-quantity">
                                        <i class="fas fa-boxes"></i>
                                        <?php echo formatarQuantidade($livro['quantidade']); ?>
                                    </span>
                                    <div class="book-actions">
                                        <a href="#" class="btn-action" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="#" class="btn-action" title="Excluir">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php else: ?>
                <div class="empty-state">
                    <div class="empty-icon">
                        <i class="fas fa-book-dead"></i>
                    </div>
                    <h3>Nenhum livro encontrado</h3>
                    <p>Não encontramos livros que correspondam aos seus critérios de busca.</p>
                    <?php if (!empty($termoBusca)): ?>
                        <p>Tente buscar por outro termo ou <a href="index.php" class="btn-clear">limpe os filtros</a>.</p>
                    <?php else: ?>
                        <p>Comece cadastrando seu primeiro livro!</p>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script>
        // Função para alternar tema (claro/escuro)
        document.querySelector('.theme-toggle').addEventListener('click', function() {
            document.body.classList.toggle('dark-mode');
            const icon = this.querySelector('i');
            if (document.body.classList.contains('dark-mode')) {
                icon.classList.replace('fa-moon', 'fa-sun');
                localStorage.setItem('theme', 'dark');
            } else {
                icon.classList.replace('fa-sun', 'fa-moon');
                localStorage.setItem('theme', 'light');
            }
        });

        // Verificar tema salvo no localStorage
        document.addEventListener('DOMContentLoaded', function() {
            const savedTheme = localStorage.getItem('theme');
            if (savedTheme === 'dark') {
                document.body.classList.add('dark-mode');
                document.querySelector('.theme-toggle i').classList.replace('fa-moon', 'fa-sun');
            }
        });

        // Confirmação antes de excluir
        document.querySelectorAll('.btn-action .fa-trash-alt').forEach(button => {
            button.closest('.btn-action').addEventListener('click', function(e) {
                e.preventDefault();
                if (confirm('Tem certeza que deseja excluir este livro?')) {
                    // Aqui você implementaria a lógica de exclusão
                    console.log('Livro excluído');
                }
            });
        });
    </script>
</body>
</html>