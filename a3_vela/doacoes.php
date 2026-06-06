<?php
include 'sessao.php';
include 'conexao.php';

if ($_SESSION['papel'] !== 'professor') {
    header('Location: painel.php');
    exit;
}

$titulo = 'Doações';
$forma  = isset($_GET['forma']) && $_GET['forma'] !== '' ? $_GET['forma'] : null;

$sql = "SELECT * FROM doacoes WHERE 1=1";
if ($forma) $sql .= " AND forma_pagamento = :forma";
$sql .= " ORDER BY doado_em DESC";

$stmt = $conexao->prepare($sql);
if ($forma) $stmt->bindParam(':forma', $forma);
$stmt->execute();

$doacoes = $stmt->fetchAll(PDO::FETCH_OBJ);
$total   = array_sum(array_column($doacoes, 'valor'));

include 'includes/layout.php';
?>

    <h4 class="fw-bold mb-4" style="color: var(--azul-dark);">💰 Doações Recebidas</h4>

    <!-- Filtro -->
    <div class="card mb-4 shadow-sm">
        <div class="card-body py-3">
            <form method="get" class="row g-3 align-items-end">
                <div class="col-md-6">
                    <label class="form-label fw-semibold">💳 Filtrar por forma de pagamento</label>
                    <select name="forma" class="form-select">
                        <option value="">Todas as formas</option>
                        <option value="pix"           <?php echo $forma === 'pix'           ? 'selected' : '' ?>>Pix</option>
                        <option value="transferencia" <?php echo $forma === 'transferencia' ? 'selected' : '' ?>>Transferência</option>
                        <option value="paypal"        <?php echo $forma === 'paypal'        ? 'selected' : '' ?>>PayPal</option>
                    </select>
                </div>
                <div class="col-md-6 d-flex gap-2">
                    <button type="submit" class="btn btn-primary flex-grow-1">🔍 Filtrar</button>
                    <a href="doacoes.php" class="btn btn-outline-secondary">Limpar</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Total -->
    <div class="card mb-4" style="background: linear-gradient(135deg, var(--azul-med), var(--azul-dark));">
        <div class="card-body text-white text-center py-3">
            <small class="opacity-75">Total <?php echo $forma ? "(" . ucfirst($forma) . ")" : "(todas)" ?></small>
            <h3 class="mb-0 fw-bold">R$ <?php echo number_format($total, 2, ',', '.') ?></h3>
        </div>
    </div>

    <?php if (count($doacoes) === 0): ?>
        <div class="alert alert-info">Nenhuma doação encontrada.</div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead style="background-color: var(--azul-med); color: white;">
                    <tr>
                        <th>Doador</th>
                        <th>Valor</th>
                        <th>Forma de Pagamento</th>
                        <th>Data</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($doacoes as $d): ?>
                    <tr>
                        <td><?php echo $d->nome_doador ?></td>
                        <td class="fw-bold" style="color: var(--azul-dark);">
                            R$ <?php echo number_format($d->valor, 2, ',', '.') ?>
                        </td>
                        <td>
                            <?php
                                $cores = ['pix' => 'success', 'transferencia' => 'primary', 'paypal' => 'info'];
                                $cor   = $cores[$d->forma_pagamento] ?? 'secondary';
                            ?>
                            <span class="badge bg-<?php echo $cor ?>">
                                <?php echo ucfirst($d->forma_pagamento) ?>
                            </span>
                        </td>
                        <td><?php echo date('d/m/Y H:i', strtotime($d->doado_em)) ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>

</div>
</body>
</html>