<?php 
// fornecedores/editar.php
require_once "../src/fornecedor-crud.php";
// Acessar a URL e "pegar" o valor do parâmetro (id) existente nela
$id = $_GET['id'];

// Chamamos a função e passamos o id para ela
// 2 Ao término, a função DEVOLVE (retorna) um array com os dados do Fornecedor

$fornecedor = buscarFornecedorPorId($conexao, $id);

 var_dump($fornecedor);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar fornecedor - Fly By Night</title>
    <link rel="stylesheet" href="../css/estilos.css">
</head>

<body>
    <?php
    $caminhoBase = '../';
    $secaoAtual = 'fornecedores';
    require '../componentes/cabecalho.php';
    ?>
    <main>
        <h2>Editar fornecedor</h2>
        <!-- Modelo visual: os campos não são enviados nem persistidos. -->
        <!-- Os campos serão preenchidos com os dados do registro selecionado. -->
        <form action="" method="post">
            <div>
                <label for="nome">Nome:</label>
                <input type="text" name="nome" id="nome" maxlength="100" required>
            </div>
            <button type="submit">Atualizar</button>
        </form>
        <a href="listar.php">← Voltar</a>
    </main>
</body>

</html>