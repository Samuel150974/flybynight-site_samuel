<?php
require_once "../src/produto-crud.php";
require_once "../src/loja-crud.php";
require_once "../src/loja_produto-crud.php";

$lojas = buscarLojas($conexao);
$produtos = buscarProdutos($conexao);
$erroCadastro = null;

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $loja_id = $_POST['loja'];
    $produto_id = $_POST['produto'];
    $estoque = $_POST['estoque'];

    if (inserirLojaProduto($conexao, $loja_id, $produto_id, $estoque)) {
        header("location:listar.php");
        exit;
    }

    $erroCadastro = 'Este produto já está vinculado a esta loja. Escolha uma combinação diferente.';
}?>











<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar produto a uma loja - Fly By Night</title>
    <link rel="stylesheet" href="../css/estilos.css">
</head>

<body>
    <?php
    $caminhoBase = '../';
    $secaoAtual = 'lojas_produtos';
    require '../componentes/cabecalho.php';
    ?>
    <main>
        <h2>Adicionar produto a uma loja</h2>
        <?php if ($erroCadastro !== null): ?>
            <p role="alert"><?= htmlspecialchars($erroCadastro, ENT_QUOTES, 'UTF-8') ?></p>
        <?php endif; ?>
        <!-- Modelo visual: os campos não são enviados nem persistidos. -->
        <form action="" method="post">

            <div>
                <label for="loja">Loja:</label>
                <select name="loja" id="loja" required>
                    <option value="">Selecione</option>

                 <?php foreach ($lojas as $loja): ?>
                    <option value="<?= $loja['id'] ?>">
                        <?= $loja['nome'] ?>
                    </option>
                    
                    
                   
                    <?php endforeach ?>

                </select>
            </div>

            <div>
                <label for="produto">Produto:</label>
                <select name="produto" id="produto" required>
                    <option value="">Selecione</option>

                     <?php foreach ($produtos as $produto): ?>

                      <option value="<?= $produto['id'] ?>">
                        <?= $produto['nome_produto'] ?>

                      </option>


                    


                    <?php endforeach ?>
                    
                </select>
            </div>
            <div>
                <label for="estoque">Estoque:</label>
                <input type="number" name="estoque" id="estoque" min="0" step="1" required>
            </div>
            <button type="submit">Salvar</button>
        </form>
        <a href="listar.php">← Voltar</a>
    </main>
</body>

</html>