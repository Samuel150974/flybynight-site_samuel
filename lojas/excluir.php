
<?php
require_once "../src/loja-crud.php";
$id = $_GET['id'];
excluirLoja($conexao, $id);
header("location:listar.php");
exit;
?>