<?php 

// fornecedores/excluir.php

require_once "../src/fornecedor-crud.php";
$id = $_GET['id'];
excluirFornecedor($conexao, $id);
header("location:listar.php");
exit;
?>
