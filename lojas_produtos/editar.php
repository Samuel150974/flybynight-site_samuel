<?php
require_once "../src/loja-crud.php";
require_once "../src/produto-crud.php";
require_once "../src/loja_produto-crud.php";



$id_loja = $_GET['loja_id'];

$id_produto = $_GET['produto_id'];

$loja_produto = buscarLojasProdutosPorId($conexao, $id_loja, $id_produto);

$produtos = buscarProdutos($conexao);

$lojas = buscarLojas($conexao);
$erroAtualizacao = null;

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    $loja = $_POST['loja'];

    $produto = $_POST['produto'];

    $estoque = $_POST['estoque'];

    if (atualizarLojaProduto($conexao, $loja, $produto, $id_loja, $id_produto, $estoque)) {
        header("location:listar.php");
        exit;
    }

    $erroAtualizacao = 'Este produto já está vinculado à loja selecionada. Escolha outra combinação.';
}
?>






<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar produto em uma loja - Fly By Night</title>
    <link rel="stylesheet" href="../css/estilos.css">
</head>

<body>
    <?php
    $caminhoBase = '../';
    $secaoAtual = 'lojas_produtos';
    require '../componentes/cabecalho.php';
    ?>
    <main>
        <h2>Editar produto em uma loja</h2>
        <?php if ($erroAtualizacao !== null): ?>
            <p role="alert"><?= htmlspecialchars($erroAtualizacao, ENT_QUOTES, 'UTF-8') ?></p>
        <?php endif; ?>
        <!-- Modelo visual: os campos não são enviados nem persistidos. -->
        <!-- Os campos serão preenchidos com os dados do registro selecionado. -->
        <form action="" method="post">

            <div>
                <label for="loja">Loja:</label>
                <select name="loja" id="loja" required>
                    <?php foreach ($lojas as $loja): ?>
                        <option value="<?= $loja['id'] ?>" <?= (int) $loja_produto['loja_id'] === (int) $loja["id"] ? "selected" : "" ?>>
                            <?= $loja['nome'] ?>
                        </option>
                    <?php endforeach ?>
                </select>
            </div>

            <div>
                <label for="produto">Produto:</label>
                <select name="produto" id="produto" required>
                    <!-- As opções serão preenchidas com os registros do banco de dados. -->
                    <?php foreach ($produtos as $produto): ?>
                        <option value="<?= $produto['id'] ?>" <?= (int) $loja_produto['produto_id'] === (int) $produto["id"] ? "selected" : "" ?>>
                            <?= $produto['nome_produto'] ?>
                        </option>
                    <?php endforeach ?>
                </select>
            </div>
            <div>
                <label for="estoque">Estoque:</label>
                <input type="number" name="estoque" id="estoque" min="0" step="1" value="<?= htmlspecialchars((string) $loja_produto['estoque'], ENT_QUOTES, 'UTF-8') ?>" required>
            </div>
            <button type="submit">Atualizar</button>
        </form>
        <a href="listar.php">← Voltar</a>
    </main>
</body>

</html>