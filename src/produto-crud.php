<?php

require_once "conecta.php";

function buscarProdutos(PDO $conexao):array
{
    $sql = "SELECT id, nome, preco, quantidade, fornecedor_id FROM produtos";

    $consulta = $conexao->query($sql);
    
    return $consulta->fetchAll();
    
    }

function inserirProdutos(PDO $conexao, string $nome):void
{
    $sql = "INSERT INTO produtos (nome)
    VALUES(:nome)";

    $consulta = $conexao->prepare($sql);

    $consulta->bindValue(":nome", $nome);

    $consulta->execute();
}    






















































?>