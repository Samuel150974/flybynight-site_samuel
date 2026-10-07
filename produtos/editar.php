<?php
// 1) Importar os arquivos de função de fornecedores e p
require_once "../src/fornecedor-crud.php";


require_once "../src/produto-crud.php";

// 2) Capturar e guardar o id do produto que será carregado/atualizado

$id = $_GET['id'];



// 3) Chamar a função buscarFornecedores e receber a lista de fornecedores (guarde em um variável chamada $fornecedores)

$fornecedores = buscarFornecedores($conexao);

// 4) Chamar a função buscarProdutoPorId e receber os dados do produto (guarde em uma variável chamada $produto)

$produto = buscarProdutoPorId($conexao, $id);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

   $fornecedor = $_POST['fornecedor'];


    header("location:listar.php");

    exit;
}




?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar produto - Fly By Night</title>
    <link rel="stylesheet" href="../css/estilos.css">
</head>

<body>
    <?php
    $caminhoBase = '../';
    $secaoAtual = 'produtos';
    require '../componentes/cabecalho.php';
    ?>
    <main>
        <h2>Editar produto</h2>
        <!-- Modelo visual: os campos não são enviados nem persistidos. -->
        <!-- Os campos serão preenchidos com os dados do registro selecionado. -->
        <form action="" method="post">

            <input type="hidden" name="id" value="<?= $produto['id'] ?>">

            <div>
                <label for="nome">Nome:</label>
                <input value="<?= $produto['nome']  ?>" type="text" name="nome" id="nome" maxlength="100" required>
            </div>

            <div>
                <label for="descricao">Descrição:</label>
                <textarea name="descricao" id="descricao" rows="5"><?= $produto['descricao'] ?></textarea>
            </div>
            <div>
                <label for="preco">Preço:</label>
                <input value="<?= $produto['preco'] ?>" type="number" name="preco" id="preco" min="0" step="0.01" required>
            </div>
            <div>
                <label for="quantidade">Quantidade:</label>
                <input value="<?= $produto['quantidade'] ?>" type="number" name="quantidade" id="quantidade" min="0" step="1" required>
            </div>
            <div>
                <label for="fornecedor">Fornecedor:</label>

                <select name="fornecedor" id="fornecedor" required>
                    <option value=" ">Selecione</option>



                    <?php foreach ($fornecedores as $fornecedor): ?>

                         <!--Se PK de fornecedor for igual á FK de produto, selecioneo fornecedor  -->

                        <option 

                        <?= $fornecedor["id"] === $produto["fornecedor_id"] ? 'selected' : '' ?>
                        
                        value="<?= $fornecedor['id'] ?>">
                            <?= $fornecedor['nome'] ?>
                        </option>

                    <?php endforeach ?>

                </select>
            </div>
            <button type="submit">Atualizar</button>
        </form>
        <a href="listar.php">← Voltar</a>
    </main>
</body>

</html>