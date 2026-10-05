<?php

require_once "../src/fornecedor-crud.php";
require_once "../src/produto-crud.php";

$fornecedores = buscarFornecedores($conexao);

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $quantidade = $_POST['quantidade'];
    $fornecedorId = $_POST['fornecedor_id'];

    inserirProduto($conexao, $nome, $descricao, $preco, $quantidade, $fornecedorId);
    header("location:listar.php");
}

exit;

// 1) Detectar o acionamento do formulário de inserção

// 2) Capturar os dados do formulário

// 3) Chamar a função de inserir e passar os dados para ela

// 4) Redirecionar para a página que mostra os produtos

// 5) Cadastre pelo menos 4 produtos (aleatórios)

?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar produto - Fly By Night</title>
    <link rel="stylesheet" href="../css/estilos.css">
</head>

<body>
    <?php
    $caminhoBase = '../';
    $secaoAtual = 'produtos';
    require '../componentes/cabecalho.php';
    ?>
    <main>
        <h2>Cadastrar produto</h2>
        <!-- Modelo visual: os campos não são enviados nem persistidos. -->
        <form action="" method="post">
            <div>
                <label for="nome">Nome:</label>
                <input type="text" name="nome" id="nome" maxlength="100" required>
            </div>
            <div>
                <label for="descricao">Descrição:</label>
                <textarea name="descricao" id="descricao" rows="5"></textarea>
            </div>
            <div>
                <label for="preco">Preço:</label>
                <input type="number" name="preco" id="preco" min="0" step="0.01" required>
            </div>
            <div>
                <label for="quantidade">Quantidade:</label>
                <input type="number" name="quantidade" id="quantidade" min="0" step="1" required>
            </div>
            <div>
                <label for="fornecedor">Fornecedor:</label>
                <select name="fornecedor" id="fornecedor" required>
                    <option value="">Selecione</option>
                    <?php foreach ($fornecedores as $fornecedor): ?>
                        <option value="<?= $fornecedor['id'] ?>">
                            <?= $fornecedor['nome'] ?>
                        </option>
                    <?php endforeach ?>
                </select>
            </div>
            <button type="submit">Salvar</button>
        </form>
        <a href="listar.php">← Voltar</a>
    </main>
</body>

</html>