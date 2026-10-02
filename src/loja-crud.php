<?php

require_once "conecta.php";

function buscarLojas(PDO $conexao)
{

    $sql = "SELECT * FROM lojas ORDER BY nome";

    $consulta = $conexao->query($sql);

    return $consulta->fetchAll();
}

// Usada em lojas/inserir.php

function inserirLojas(PDO $conexao, string $nome): void
{
    $sql = " INSERT INTO lojas (nome) VALUES(:nome)";

    $consulta = $conexao->prepare($sql);

    $consulta->bindValue(":nome", $nome);

    $consulta->execute();
}


// Usada em lojas/editar.php

function buscarLojaPorId(PDO $conexao, int $id){

    $sql = "SELECT * FROM lojas WHERE id = :id";

    $consulta = $conexao->prepare($sql);

    $consulta->bindValue(":id", $id);

    $consulta->execute();

    return $consulta->fetch();
}




// Usada em lojas/editar.php

function atualizarLoja(PDO $conexao, int $id, string $nome): void
{
    $sql = "UPDATE lojas SET nome =:nome WHERE id= :id";

    $consulta = $conexao->prepare($sql);

    $consulta->bindValue(":nome", $nome);
    $consulta->bindValue(":id", $id);

    $consulta->execute();
}


// Usada em lojas/excluir.php

function excluirLoja(PDO $conexao, int $id) : void 
{ 
    $sql = "DELETE FROM lojas WHERE id = :id";

    $consulta = $conexao->prepare($sql);

   
    $consulta->bindValue(":id", $id);

    $consulta->execute();

}