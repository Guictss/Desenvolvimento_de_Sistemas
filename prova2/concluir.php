<?php
include 'sessao.php';
include 'conexao.php';

if (isset($_GET['id'])) {
    $id  = $_GET['id'];
    $sql = "UPDATE tarefas SET status = 'concluida' WHERE id = :id";
    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
}

header('Location: index.php');
exit;
?>