<?php
include 'sessao.php';
include 'conexao.php';

$titulo = 'Início';

// Filtros
$data_inicio = isset($_GET['data_inicio']) && $_GET['data_inicio'] !== '' ? $_GET['data_inicio'] : null;
$data_fim    = isset($_GET['data_fim'])    && $_GET['data_fim']    !== '' ? $_GET['data_fim']    : null;

$sql = "SELECT a.*, u.nome AS professor 
        FROM aulas a 
        JOIN usuarios u ON u.id = a.professor_id
        WHERE 1=1";

if ($data_inicio) $sql .= " AND a.data >= :data_inicio";
if ($data_fim)    $sql .= " AND a.data <= :data_fim";
$sql .= " ORDER BY a.data ASC, a.horario ASC";

$stmt = $conexao->prepare($sql);
if ($data_inicio) $stmt->bindParam(':data_inicio', $data_inicio);
if ($data_fim)    $stmt->bindParam(':data_fim',    $data_fim);
$stmt->execute();

include 'includes/layout.php';
?>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold" style="color: var(--azul-dark);">📋 Aulas Disponíveis</h4>
        <?php if ($_SESSION['papel'] === 'professor'): ?>
            <a href="nova.php" class="btn btn-primary">+ Nova Aula</a>
        <?php endif; ?>
    </div>

    <!-- Filtro -->
    <div class="card mb-4 shadow-sm">
        <div class="card-body py-3">
            <form method="get" class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label class="form-label fw-semibold">📅 Data inicial</label>
                    <input type="date" name="data_inicio" class="form-control"
                           value="<?php echo $data_inicio ?>">
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">📅 Data final</label>
                    <input type="date" name="data_fim" class="form-control"
                           value="<?php echo $data_fim ?>">
                </div>
                <div class="col-md-4 d-flex gap-2">
                    <button type="submit" class="btn btn-primary flex-grow-1">🔍 Filtrar</button>
                    <a href="painel.php" class="btn btn-outline-secondary">Limpar</a>
                </div>
            </form>
        </div>
    </div>

    <?php if ($stmt->rowCount() === 0): ?>
        <div class="alert alert-info">Nenhuma aula encontrada com os filtros aplicados.</div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead style="background-color: var(--azul-med); color: white;">
                    <tr>
                        <th>Data</th>
                        <th>Horário</th>
                        <th>Duração</th>
                        <th>Professor</th>
                        <th>Vagas</th>
                        <th>Descrição</th>
                        <?php if ($_SESSION['papel'] === 'professor'): ?>
                            <th colspan="2">Ações</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                <?php while ($aula = $stmt->fetch(PDO::FETCH_OBJ)): ?>
                    <tr>
                        <td><?php echo date('d/m/Y', strtotime($aula->data)) ?></td>
                        <td><?php echo substr($aula->horario, 0, 5) ?></td>
                        <td><?php echo $aula->duracao_min ?> min</td>
                        <td><?php echo $aula->professor ?></td>
                        <td>
                            <span class="badge" style="background-color: var(--azul-med);">
                                <?php echo $aula->vagas ?> vagas
                            </span>
                        </td>
                        <td><?php echo $aula->descricao ?? '—' ?></td>
                        <?php if ($_SESSION['papel'] === 'professor'): ?>
                            <td>
                                <a href="editar.php?id=<?php echo $aula->id ?>" 
                                   class="btn btn-sm btn-warning">Editar</a>
                            </td>
                            <td>
                                <a href="excluir.php?id=<?php echo $aula->id ?>"
                                   class="btn btn-sm btn-danger"
                                   onclick="return confirm('Excluir esta aula?')">Excluir</a>
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>

</div>
</body>
</html>