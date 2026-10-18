<?php
// src/conecta.php

// Parâmetros de conexão ao servidor MySQL

$servidor = "localhost";
$banco = "flybynight_completo";
$usuario = "root";
$senha = "senac";
try {
    $conexao = new PDO(
        "mysql:host=$servidor;dbname=$banco;charset=utf8mb4",
        $usuario,
        $senha,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]
    );
} catch (PDOException $erro) {
    error_log($erro->getMessage());
    http_response_code(500);
    exit("Não foi possível conectar ao banco. Contate o administrador.");
}
