<?php


require_once "conecta.php";

function buscarLojasProdutos(PDO $conexao)
{
    $sql = "SELECT
            loja_id,
            produto_id,
            estoque
    

            
       FROM lojas_produtos 
       INNER JOIN lojas
       ON lojas_produtos.loja_id = lojas.id
       INNER JOIN produtos ON lojas_produtos.produto_id = produtos.id";

    $consulta = $conexao->query($sql);
    return $consulta->fetchAll(PDO::FETCH_ASSOC);
}

function inserirLojaProduto(PDO $conexao, string $loja_id, string $produto_id): void
{
    $sql = "INSERT INTO lojas_produtos( loja_id, produto_id)
                VALUES( :loja_id, :produto_id)";

    $consulta = $conexao->prepare($sql);

    $consulta->bindValue(':loja_id', $loja_id);

    $consulta->bindValue(':produto_id', $produto_id);

    $consulta->execute();
}

function buscarLojasProdutosPorId(PDO $conexao, int $id, $produto_id)
{
    $sql = "SELECT * FROM lojas_produtos WHERE id = :id";

    $consulta = $conexao->prepare($sql);

    $consulta->bindValue(":id", $id);

    $consulta->execute();

    return $consulta->fetch();
}


function atualizarProdutoLoja(
    PDO $conexao,

)
