<?php


require_once "conecta.php";

function buscarLojasProdutos(PDO $conexao)
{
    $sql = "SELECT  
            lojas.id,
            lojas.nome as nome_loja,
            produtos.quantidade,
            produtos.nome as nome_produto

       FROM produtos JOIN lojas 
       ON lojas.id = produtos_nome
       ORDER BY nome_lojas";

    $consulta = $conexao->query($sql);
    return $consulta->fetchAll();
}

function inserirLojaProduto(PDO $conexao, string $lojaNome, string $produtoNome, int $lojaId, int $produtoId, int $estoque): void
{
    $sql = "INSERT INTO lojas(lojaNome, produto, estoque, loja_id, produto_id)
                VALUES(:lojaNome, :produtoNome, :estoque, :loja_id, :produto_id)";

    $consulta = $conexao->prepare($sql);

    $consulta->bindValue(':lojaNome', $lojaNome);

    $consulta->bindValue(':produtoNome', $produtoNome);

    $consulta->bindValue(':estoque', $estoque);

    $consulta->bindValue(':loja_id', $lojaId);

    $consulta->bindValue(':produto_id', $produtoId);

    $consulta->execute();
}
