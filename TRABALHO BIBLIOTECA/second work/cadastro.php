<?php
require 'connection.php';

$aviso = '';
$color = '';
$titulo = '';
$autor = '';
$ano = '';
$categoria = '';
$quantidade = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    

    $titulo_raw = trim($_POST['titulo']); 
    $autor_raw = trim($_POST['autor']);
    $ano_raw = trim($_POST['ano']);
    $categoria_raw = trim($_POST['categoria']);
    $quantidade_raw = trim($_POST['quantidade']);

    
    $titulo = mysqli_real_escape_string($conn, $_POST['titulo']);
    $autor = mysqli_real_escape_string($conn, $_POST['autor']);
    $ano = mysqli_real_escape_string($conn, $_POST['ano']);
    $categoria = mysqli_real_escape_string($conn, $_POST['categoria']);
    $quantidade = mysqli_real_escape_string($conn, $_POST['quantidade']);

    if (empty($titulo) ) {
        $aviso = 'Escreve o título arrombado!!';
        $color = 'erro';
    } elseif (empty($categoria)) {
        $aviso = 'Seleciona essa merda!!!!!';
        $color = 'erro';

    } elseif (empty($autor)) {
        $aviso = 'Preencha o Dono vagabundo!';
        $color = 'erro';
    } elseif (empty($ano)) {
        $aviso = 'Preencha o ano arro!';
        $color = 'erro';
    } elseif (empty($quantidade) || !is_numeric($quantidade) || $quantidade < 1) {
        $aviso = 'A quantidade deve ser um número maior que zero!';
        $color = 'erro';
    } 
    // validação do espaço
    elseif ($titulo_raw === '' || $autor_raw === '' || $ano_raw === '' || $categoria_raw === '' || $quantidade_raw === ''){
        $aviso = 'escreve algo além de espaço ';
        $color = 'erro';
    }
 else {
        $sql = "INSERT INTO livros (titulo, autor, ano, categoria, quantidade)
                        VALUES ('$titulo', '$autor', '$ano', '$categoria', '$quantidade')";

        if (mysqli_query($conn, $sql)) {
            $aviso = 'Livro "' . $titulo . '" cadastrado com sucesso!';
            $color = 'sucesso';

            $titulo = $autor = $ano = $categoria = $quantidade = '';
        } else {
            $aviso = 'Erro ao cadastrar: ' . mysqli_error($conn);
            $color = 'erro';
        }
    }
}

$categorias = array('Romance', 'Didático', 'Fantasia', 'Ficção Científica', 'História', 'Biografia', 'Autoajuda', 'Infantil');
?>
 
<!DOCTYPE html>
<html lang="pt-BR">
<head>
     <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>qualquer coisa</title>
    <link rel="stylesheet" href="style.css">
    <!-- o lugar da onde vem os icones -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"></head>
<body>



    <div class="page-container">
        <header class="header">
            <h1><i class="fas fa-book"></i> Cadastro de Livros</h1>
            <a href="index.php" class="btn-voltar">
                <i class="fas fa-arrow-left"></i> Voltar
            </a>
        </header>



        <main class="main-content">
            <div class="cadastro-card">
                <div class="cadastro-icon">
                    <i class="fas fa-book-medical"></i>
                </div>
                <h2 class="card-title">Cadastre um Livro/Altere</h2>
                <p class="card-subtitle">Preencha os campos abaixo</p>

                <!-- AVISO AO CADASTRAR UM LIVRO -->

                <?php if (!empty($aviso)): ?>
                    <div class="mensagem <?= $color ?>">
                        <span class="mensagem-icon">
                            <?= $color == 'sucesso' ? '<i class="fas fa-check-circle"></i>' : '<i class="fas fa-exclamation-circle"></i>' ?>
                        </span>
                        <span class="mensagem-texto"><?= htmlspecialchars($aviso) ?></span>
                    </div>
                <?php endif; ?>

                <!-- AUTOR -->

                <form method="POST" class="book-form">
                    <div class="form-group">
                        <label for="titulo">
                            <i class="fas fa-book label-icon"></i>
                            Título <span class="obrigatorio">*</span>
                        </label>
                        <input type="text" id="titulo" name="titulo" placeholder="Digite o título" maxlength="120" class="form-control" value="<?= htmlspecialchars($titulo) ?>">
                    </div>

                    <!-- AUTOR -->

                    <div class="form-group">
                        <label for="autor">
                            <i class="fas fa-user-edit label-icon"></i>
                            Autor <span class="obrigatorio">*</span>
                        </label>
                        <input type="text" id="autor" name="autor" placeholder="Digite o autor" maxlength="100" class="form-control" value="<?= htmlspecialchars($autor) ?>">
                    </div>

                    <!-- ANO -->

                    <div class="form-row">
                        <div class="form-group">
                            <label for="ano">
                                <i class="fas fa-calendar-alt label-icon"></i>
                                Ano <span class="obrigatorio">*</span>
                            </label>
                            <input type="number" id="ano" name="ano" placeholder="Ex: 1945" min="1" max="2099" class="form-control" value="<?= htmlspecialchars($ano) ?>">
                        </div>

                    <!-- QUANTIDADE -->

                        <div class="form-group">
                            <label for="quantidade">
                                <i class="fas fa-sort-numeric-up label-icon"></i>
                                Quantidade <span class="obrigatorio">*</span>
                            </label>
                            <input type="number" id="quantidade" name="quantidade" placeholder="Digite a quantidade" min="1" max="999999" class="form-control" value="<?= htmlspecialchars($quantidade) ?>">
                        </div>
                    </div>

                    <!-- CATEGORIA -->

                    <div class="form-group">
                        <label for="categoria">
                            <i class="fas fa-tags label-icon"></i>
                            Categoria <span class="obrigatorio">*</span>
                        </label>


                        <select id="categoria" name="categoria" class="form-control" required>
                            <option value="">Selecione uma categoria</option>
                            <?php for ($i = 0; $i < count($categorias); $i++): ?>
                                <option value="<?php echo $categorias[$i]; ?>"
                                    <?php if ($categoria == $categorias[$i]) echo 'selected'; ?>>
                                    <?php echo $categorias[$i]; ?>
                                </option>
                            <?php endfor; ?>
                        </select>
                    </div>

                    <!-- BOTOES DE ENVIAR E LIMPAR -->

                    <div class="form-buttons">
                        <button type="submit" class="btn-cadastrar-form">
                            <i class="fas fa-save"></i> Cadastrar
                        </button>
                        
                        <button type="reset" class="btn-limpar-form">
                            <i class="fas fa-eraser"></i> Limpar
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>
</body>
</html>