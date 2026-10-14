<?php
require_once "../src/produto-crud.php";
require_once "../src/loja-crud.php";
require_once "../src/loja_produto-crud.php";

$id = $_GET['id'];

$lojas = buscarLojas($conexao);

$produtos = buscarProdutos($conexao);

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $loja = $_POST['loja'];
    $produto = $_POST['produto'];
    $estoque = $_POST['estoque'];

    atualizarProdutoLoja($conexao, $id, $loja, $produto, $estoque);
    


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
        <!-- Modelo visual: os campos não são enviados nem persistidos. -->
        <!-- Os campos serão preenchidos com os dados do registro selecionado. -->
        <form action="" method="post">

            <div>
                <label for="loja">Loja:</label>
                <select name="loja" id="loja" required>
                    <option value="">Selecione</option>
                    <!-- As opções serão preenchidas com os regist ros do banco de dados. -->
                </select>
            </div>

            <div>
                <label for="produto">Produto:</label>
                <select name="produto" id="produto" required>
                    <option value="">Selecione</option>
                    <!-- As opções serão preenchidas com os registros do banco de dados. -->
                </select>
            </div>
            <div>
                <label for="estoque">Estoque:</label>
                <input type="number" name="estoque" id="estoque" min="0" step="1" required>
            </div>
            <button type="submit">Atualizar</button>
        </form>
        <a href="listar.php">← Voltar</a>
    </main>
</body>

</html>