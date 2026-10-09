<?php

require_once "conecta.php";

function buscarProdutos(PDO $conexao): array
{
  $sql = "SELECT
                produtos.id,
                produtos.nome as nome_produto,
                produtos.preco,
                produtos.quantidade,
                fornecedores.nome as nome_fornecedor
            FROM produtos JOIN fornecedores
            ON fornecedores.id = produtos.fornecedor_id
            ORDER BY nome_produto";
  $consulta = $conexao->query($sql);
  return $consulta->fetchAll();
}

function inserirProduto(
  PDO $conexao, string $nome,
   string $descricao, float $preco,
    int $quantidade, int $fornecedorId
    ):void
{
  $sql = "INSERT INTO produtos(nome, descricao, preco, quantidade, fornecedor_id)
VALUES(:nome, :descricao, :preco, :quantidade, :fornecedor_id)";

  $consulta = $conexao->prepare($sql);

  $consulta->bindValue(':nome', $nome);

  $consulta->bindValue(':descricao', $descricao);

  $consulta->bindValue(':preco', $preco);

  $consulta->bindValue(':quantidade', $quantidade);

  $consulta->bindValue(':fornecedor_id', $fornecedorId);

  $consulta->execute();
}






function buscarProdutoPorId(PDO $conexao, int $id)
{
  $sql = "SELECT * FROM produtos WHERE id= :id";

  $consulta = $conexao->prepare($sql);

  $consulta->bindValue(":id", $id);

  $consulta->execute();

  return $consulta->fetch();
}


function atualizarProduto(
  PDO $conexao,
  int $id,
  string $nome,
  string $descricao,
  float $preco,
  int $quantidade,
  int $fornecedorId
): void
{




  // Comando SQL
  $sql = "UPDATE produtos SET 
  nome = :nome,
  descricao = :descricao,
  preco = :preco,
  quantidade = :quantidade,
  fornecedor_id = :fornecedor_id
  WHERE id = :id";

  // Preparar comando SQL

  $consulta = $conexao->prepare($sql);

  // Atribuir valores aos campos
  $consulta->bindValue(':nome', $nome);
  $consulta->bindValue(':descricao', $descricao);
  $consulta->bindValue(':preco', $preco);
  $consulta->bindValue(':quantidade', $quantidade);
  $consulta->bindValue(':id', $id);
  $consulta->bindValue(':fornecedor_id', $fornecedorId);


  // Executar

  $consulta->execute();
}

function excluirProduto(PDO $conexao, int $id):void
{
  $sql = "DELETE FROM produtos WHERE id = :id";

  $consulta = $conexao->prepare($sql);

  $consulta->bindValue(":id", $id);
  
  $consulta->execute();
}
