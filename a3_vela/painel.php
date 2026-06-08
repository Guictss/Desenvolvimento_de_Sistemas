<?php
include 'sessao.php';
include 'conexao.php';

$titulo = 'Aulas';

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
$aulas = $stmt->fetchAll(PDO::FETCH_OBJ);

include 'includes/layout.php';
?>

<div class="page-container">

    <!-- Header da página -->
    <div class="page-header">
        <div>
            <h1 class="page-title">Aulas Disponíveis</h1>
            <p class="page-subtitle">Visualize e gerencie as sessões de vela adaptada</p>
        </div>
        <?php if ($_SESSION['papel'] === 'professor'): ?>
            <a href="nova.php" class="btn-vela-primary">+ Nova Aula</a>
        <?php endif; ?>
    </div>

    <!-- Filtro -->
    <div class="filter-card">
        <div class="filter-card-title">🔍 Filtrar por período</div>
        <form method="get" class="row g-3 align-items-end">
            <div class="col-md-4">
                <label class="form-label">Data inicial</label>
                <input type="date" name="data_inicio" class="form-control"
                       value="<?php echo $data_inicio ?>">
            </div>
            <div class="col-md-4">
                <label class="form-label">Data final</label>
                <input type="date" name="data_fim" class="form-control"
                       value="<?php echo $data_fim ?>">
            </div>
            <div class="col-md-4 d-flex gap-2">
                <button type="submit" class="btn-vela-primary flex-grow-1">Aplicar</button>
                <a href="painel.php" class="btn-vela-ghost">Limpar</a>
            </div>
        </form>
    </div>

    <!-- Tabela ou estado vazio -->
    <?php if (count($aulas) === 0): ?>
        <div class="empty-state">
            <div class="empty-state-icon">⛵</div>
            <h3 class="empty-state-title">Nenhuma aula encontrada</h3>
            <p class="empty-state-text">Tente ajustar os filtros ou cadastrar uma nova aula.</p>
        </div>
    <?php else: ?>
        <div class="modern-table-wrapper">
            <table class="modern-table">
                <thead>
                    <tr>
                        <th>Data</th>
                        <th>Horário</th>
                        <th>Duração</th>
                        <th>Professor</th>
                        <th>Vagas</th>
                        <th>Descrição</th>
                        <?php if ($_SESSION['papel'] === 'professor'): ?>
                            <th style="text-align: right;">Ações</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($aulas as $aula): ?>
                    <tr>
                        <td style="font-weight: 600;"><?php echo date('d/m/Y', strtotime($aula->data)) ?></td>
                        <td><?php echo substr($aula->horario, 0, 5) ?></td>
                        <td><?php echo $aula->duracao_min ?> min</td>
                        <td><?php echo $aula->professor ?></td>
                        <td>
                            <span class="status-pill status-info">
                                <?php echo $aula->vagas ?> vagas
                            </span>
                        </td>
                        <td style="color: var(--gray); max-width: 280px;">
                            <?php echo $aula->descricao ?: '—' ?>
                        </td>
                        <?php if ($_SESSION['papel'] === 'professor'): ?>
                            <td style="text-align: right; white-space: nowrap;">
                                <a href="editar.php?id=<?php echo $aula->id ?>" class="action-btn action-edit">
                                    ✏️ Editar
                                </a>
                                <a href="excluir.php?id=<?php echo $aula->id ?>" class="action-btn action-delete"
                                   onclick="return confirm('Excluir esta aula?')">
                                    🗑️ Excluir
                                </a>
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>

</div>

</body>
</html>