<?php
include 'sessao.php';
include 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo    = $_POST['titulo'];
    $descricao = $_POST['descricao'];

    $stmt = $conexao->prepare("INSERT INTO tarefas (titulo, descricao) VALUES (?, ?)");
    $stmt->execute([$titulo, $descricao]);
    header('Location: index.php');
    exit;
}

include 'layout.php';
?>

<div class="container" style="max-width: 600px">
    <h4 class="mb-3">Nova Tarefa</h4>
    <form method="post">
        <div class="mb-3">
            <label class="form-label">Título: *</label>
            <input type="text" name="titulo" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Descrição:</label>
            <textarea name="descricao" class="form-control" rows="4"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Salvar</button>
        <a href="index.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

</body>
</html>