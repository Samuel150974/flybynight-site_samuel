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

function inserirLojaProduto(PDO $conexao, int $loja_id, int $produto_id, int $estoque): bool
{

    $sql = "INSERT INTO lojas_produtos (loja_id, produto_id, estoque) VALUES (:loja_id, :produto_id, :estoque)";

    $consulta = $conexao->prepare($sql);

    $consulta->bindValue(':loja_id', $loja_id);

    $consulta->bindValue(':produto_id', $produto_id);

    $consulta->bindValue(':estoque', $estoque);

    try {
        $consulta->execute();
        return true;
    } catch (PDOException $erro) {
        $codigoSql = $erro->errorInfo[0] ?? null;
        $codigoMySql = (int) ($erro->errorInfo[1] ?? 0);

        if ($codigoSql === '23000' && $codigoMySql === 1062) {
            return false;
        }

        throw $erro;
    }
}







function buscarLojasProdutosPorId(PDO $conexao, int $loja_id, int $produto_id): array
{
    $sql = "SELECT * FROM lojas_produtos WHERE loja_id = :loja_id AND produto_id = :produto_id";
    
    $consulta = $conexao->prepare($sql);
    
    $consulta->bindValue(":loja_id", $loja_id);
    
    $consulta->bindValue(":produto_id", $produto_id);
    
    $consulta->execute();
    
    return $consulta->fetch();
}




function atualizarLojaProduto(PDO $conexao, int $loja, int $produto, int $loja_id, int $produto_id, int $estoque): bool
{
    $sql = "UPDATE lojas_produtos SET loja_id = :novo_loja_id, produto_id = :novo_produto_id, estoque = :estoque WHERE loja_id = :loja_id AND produto_id = :produto_id";
    
    $consulta = $conexao->prepare($sql);
    
    $consulta->bindValue(":novo_loja_id", $loja);
    
    $consulta->bindValue(":novo_produto_id", $produto);
    
    $consulta->bindValue(":loja_id", $loja_id);
    
    $consulta->bindValue(":produto_id", $produto_id);
    
    $consulta->bindValue(":estoque", $estoque);
    
    try {
        $consulta->execute();
        return true;
    } catch (PDOException $erro) {
        $codigoSql = $erro->errorInfo[0] ?? null;
        $codigoMySql = (int) ($erro->errorInfo[1] ?? 0);

        if ($codigoSql === '23000' && $codigoMySql === 1062) {
            return false;
        }

        throw $erro;
    }
}

function excluirLojaProduto(PDO $conexao, int $loja_id, int $produto_id): void
{
    $sql = "DELETE FROM lojas_produtos WHERE loja_id = :loja_id AND produto_id = :produto_id";
    $consulta = $conexao->prepare($sql);
    $consulta->bindValue(':loja_id', $loja_id);
    $consulta->bindValue(':produto_id', $produto_id);
    $consulta->execute();
}
