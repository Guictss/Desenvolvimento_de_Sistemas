<?php
include 'sessao.php';
include 'conexao.php';

// Apenas alunos podem se inscrever
if ($_SESSION['papel'] !== 'aluno') {
    header('Location: index.php');
    exit;
}

$titulo  = 'Inscrições';
$aluno_id = $_SESSION['usuario_id'];
$msg     = '';
$tipo    = '';

// Inscrever em uma aula
if (isset($_GET['inscrever'])) {
    $aula_id = $_GET['inscrever'];

    // Verifica se já está inscrito
    $sqlCheck = "SELECT id FROM inscricoes WHERE aluno_id = :aluno_id AND aula_id = :aula_id";
    $stmtCheck = $conexao->prepare($sqlCheck);
    $stmtCheck->bindParam(':aluno_id', $aluno_id);
    $stmtCheck->bindParam(':aula_id',  $aula_id);
    $stmtCheck->execute();

    if ($stmtCheck->rowCount() > 0) {
        $msg  = 'Você já está inscrito nesta aula.';
        $tipo = 'warning';
    } else {
        $sql  = "INSERT INTO inscricoes (aluno_id, aula_id) VALUES (:aluno_id, :aula_id)";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':aluno_id', $aluno_id);
        $stmt->bindParam(':aula_id',  $aula_id);
        $stmt->execute();
        $msg  = 'Inscrição realizada com sucesso!';
        $tipo = 'success';
    }
}

// Cancelar inscrição
if (isset($_GET['cancelar'])) {
    $aula_id = $_GET['cancelar'];
    $sql  = "DELETE FROM inscricoes WHERE aluno_id = :aluno_id AND aula_id = :aula_id";
    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(':aluno_id', $aluno_id);
    $stmt->bindParam(':aula_id',  $aula_id);
    $stmt->execute();
    $msg  = 'Inscrição cancelada.';
    $tipo = 'info';
}

// Busca todas as aulas com status de inscrição do aluno
$sql = "SELECT a.*, u.nome AS professor,
        (SELECT COUNT(*) FROM inscricoes i WHERE i.aula_id = a.id) AS inscritos,
        (SELECT COUNT(*) FROM inscricoes i WHERE i.aula_id = a.id AND i.aluno_id = :aluno_id) AS inscrito
        FROM aulas a
        JOIN usuarios u ON u.id = a.professor_id
        ORDER BY a.data ASC, a.horario ASC";
$stmt = $conexao->prepare($sql);
$stmt->bindParam(':aluno_id', $aluno_id);
$stmt->execute();

include 'includes/layout.php';
?>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold" style="color: var(--azul-dark);">🏄 Inscrição em Aulas</h4>
    </div>

    <?php if ($msg): ?>
        <div class="alert alert-<?php echo $tipo ?> alert-dismissible fade show">
            <?php echo $msg ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead style="background-color: var(--azul-med); color: white;">
                <tr>
                    <th>Data</th>
                    <th>Horário</th>
                    <th>Duração</th>
                    <th>Professor</th>
                    <th>Vagas</th>
                    <th>Inscritos</th>
                    <th>Situação</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
            <?php while ($aula = $stmt->fetch(PDO::FETCH_OBJ)): ?>
                <?php
                    $vagas_restantes = $aula->vagas - $aula->inscritos;
                    $lotada = $vagas_restantes <= 0 && !$aula->inscrito;
                ?>
                <tr>
                    <td><?php echo date('d/m/Y', strtotime($aula->data)) ?></td>
                    <td><?php echo substr($aula->horario, 0, 5) ?></td>
                    <td><?php echo $aula->duracao_min ?> min</td>
                    <td><?php echo $aula->professor ?></td>
                    <td><?php echo $aula->vagas ?></td>
                    <td><?php echo $aula->inscritos ?></td>
                    <td>
                        <?php if ($aula->inscrito): ?>
                            <span class="badge bg-success">Inscrito</span>
                        <?php elseif ($lotada): ?>
                            <span class="badge bg-danger">Lotada</span>
                        <?php else: ?>
                            <span class="badge bg-secondary">Disponível</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if ($aula->inscrito): ?>
                            <a href="inscricoes.php?cancelar=<?php echo $aula->id ?>"
                               class="btn btn-sm btn-outline-danger"
                               onclick="return confirm('Cancelar inscrição?')">Cancelar</a>
                        <?php elseif (!$lotada): ?>
                            <a href="inscricoes.php?inscrever=<?php echo $aula->id ?>"
                               class="btn btn-sm btn-primary">Inscrever</a>
                        <?php else: ?>
                            <button class="btn btn-sm btn-secondary" disabled>Indisponível</button>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
    </div>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>