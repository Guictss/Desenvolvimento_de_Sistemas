<?php
include 'sessao.php';
include 'conexao.php';

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$id = $_GET['id'];
$sql = "SELECT * FROM tarefas WHERE id = :id";
$stmt = $conexao->prepare($sql);
$stmt->bindParam(':id', $id);
$stmt->execute();
$tarefa = $stmt->fetch(PDO::FETCH_OBJ);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo    = $_POST['titulo'];
    $descricao = $_POST['descricao'];
    $status    = $_POST['status'];

    $sql = "UPDATE tarefas SET titulo = :titulo, descricao = :descricao, status = :status WHERE id = :id";
    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(':titulo',    $titulo);
    $stmt->bindParam(':descricao', $descricao);
    $stmt->bindParam(':status',    $status);
    $stmt->bindParam(':id',        $id);
    $stmt->execute();
    header('Location: index.php');
    exit;
}

include 'layout.php';
?>

<div class="container" style="max-width: 600px">
    <h4 class="mb-3">Editar Tarefa</h4>
    <form method="post">
        <div class="mb-3">
            <label class="form-label">Título: *</label>
            <input type="text" name="titulo" class="form-control"
                value="<?php echo $tarefa->titulo ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Descrição:</label>
            <textarea name="descricao" class="form-control" rows="4"><?php echo $tarefa->descricao ?></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Status:</label>
            <select name="status" class="form-select">
                <option value="pendente"  <?php echo $tarefa->status == 'pendente'  ? 'selected' : '' ?>>Pendente</option>
                <option value="concluida" <?php echo $tarefa->status == 'concluida' ? 'selected' : '' ?>>Concluída</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Salvar</button>
        <a href="index.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

</body>
</html>