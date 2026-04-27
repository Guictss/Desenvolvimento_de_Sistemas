<?php

    include '../conexao.php';

    $id       = isset($_POST['id']) ? $_POST['id'] : null;
    $titulo   = $_POST['txtTitulo'];
    $descricao = $_POST['txtDescricao'];
    $status   = $_POST['selStatus'];

    if($id) {
        $sql = "UPDATE tarefas SET titulo = :titulo, descricao = :descricao, status = :status WHERE id = :id";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':id', $id);
    } else {
        $sql = "INSERT INTO tarefas (titulo, descricao, status) VALUES (:titulo, :descricao, :status)";
        $stmt = $conexao->prepare($sql);
    }
    $stmt->bindParam(':titulo',    $titulo);
    $stmt->bindParam(':descricao', $descricao);
    $stmt->bindParam(':status',    $status);
    $stmt->execute();
    header('Location:index.php');
    exit;
    
?>