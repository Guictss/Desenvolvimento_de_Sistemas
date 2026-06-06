<?php
include 'sessao.php';
include 'conexao.php';

if ($_SESSION['papel'] !== 'professor') {
    header('Location: painel.php');
    exit;
}

if (!isset($_GET['id'])) {
    header('Location: painel.php');
    exit;
}

$id = $_GET['id'];

// Verifica se a aula existe
$sql  = "SELECT * FROM aulas WHERE id = :id";
$stmt = $conexao->prepare($sql);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$aula = $stmt->fetch(PDO::FETCH_OBJ);

if (!$aula) {
    header('Location: painel.php');
    exit;
}

try {
    // Remove inscrições vinculadas antes de excluir a aula
    $sqlInsc = "DELETE FROM inscricoes WHERE aula_id = :id";
    $stmtInsc = $conexao->prepare($sqlInsc);
    $stmtInsc->bindParam(':id', $id, PDO::PARAM_INT);
    $stmtInsc->execute();

    // Exclui a aula
    $sql  = "DELETE FROM aulas WHERE id = :id";
    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    header('Location: painel.php');
    exit;

} catch (PDOException $e) {
    header('Location: painel.php');
    exit;
}
?>