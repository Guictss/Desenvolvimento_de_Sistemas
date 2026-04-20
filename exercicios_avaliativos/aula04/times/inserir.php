<?php

    include '../conexao.php';

    $id = isset($_GET['id']) ? $_GET['id'] : null;
    $nome = $_GET['txtNome'];
    $estado = $_GET['txtEstado'];
    $fundacao = $_GET['numFundacao'];

    if($id) {
        $sql = "UPDATE times SET nome = :nome, estado = :estado, fundacao = :fundacao WHERE id = :id";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':id', $id);
    } else {
        $sql = "INSERT INTO times (nome, estado, fundacao) VALUES (:nome, :estado, :fundacao)";
        $stmt = $conexao->prepare($sql);
    }
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':estado', $estado);
    $stmt->bindParam(':fundacao', $fundacao);
    $stmt->execute();
    header('Location:index.php');
    exit;
    
?>