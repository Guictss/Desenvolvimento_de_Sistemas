<?php

$host   = "localhost";
$dbname = "vela_para_todos";
$user   = "root";
$pass   = "ReapperOW31.";

try {
    $conexao = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}

?>