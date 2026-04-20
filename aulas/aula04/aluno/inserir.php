<?php

    include '../conexao.php';

    $id = isset($_GET['id']) ? $_GET['id'] : null;
    $nome = $_GET['txtNome'];
    $idade = $_GET['numIdade'];

    if($id) {
        $sql = "UPDATE aluno SET nome = :nome, idade = :idade WHERE id = :id";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':id', $id);
    } else {
        $sql = " INSERT INTO aluno (nome, idade) VALUES (:nome, :idade)";
        $stmt = $conexao->prepare($sql);
    }
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':idade', $idade);
    $stmt->execute();
    header('Location:index.php');
    exit;
    
?>