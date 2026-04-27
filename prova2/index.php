<?php
include 'sessao.php';
include 'conexao.php';

$sql = "SELECT * FROM tarefas";
$consulta = $conexao->query($sql);

include 'layout.php';
?>

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Minhas Tarefas</h4>
        <a href="nova.php" class="btn btn-success">+ Nova Tarefa</a>
    </div>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Título</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($linha = $consulta->fetch(PDO::FETCH_OBJ)): ?>
            <tr>
                <td><?php echo $linha->titulo ?></td>
                <td>
                    <span class="badge <?php echo $linha->status == 'concluida' ? 'bg-success' : 'bg-warning text-dark' ?>">
                        <?php echo $linha->status ?>
                    </span>
                </td>
                <td>
                    <a href="editar.php?id=<?php echo $linha->id ?>" class="btn btn-sm btn-warning">Editar</a>
                    <a href="concluir.php?id=<?php echo $linha->id ?>" class="btn btn-sm btn-success">Concluir</a>
                    <a href="excluir.php?id=<?php echo $linha->id ?>" class="btn btn-sm btn-danger"
                       onclick="return confirm('Excluir esta tarefa?')">Excluir</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>

</body>
</html>